<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Seeder;
use ZipArchive;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create default admin user
        User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'),
            ]
        );

        $file_path = "C:/Users/AGL IT/Downloads/Alabama_Master SKU.xlsx";
        if (!file_exists($file_path)) {
            $this->command->error("Excel file not found at: $file_path");
            return;
        }

        $zip = new ZipArchive;
        if ($zip->open($file_path) !== TRUE) {
            $this->command->error("Failed to open Excel file.");
            return;
        }

        // Load shared strings
        $sharedStrings = [];
        if (($index = $zip->locateName('xl/sharedStrings.xml')) !== false) {
            $xml = simplexml_load_string($zip->getFromIndex($index));
            foreach ($xml->si as $val) {
                $sharedStrings[] = (string)$val->t;
            }
        }

        // First parse sheet3.xml to populate base Brands and Subcategories
        if (($index = $zip->locateName('xl/worksheets/sheet3.xml')) !== false) {
            $xml = simplexml_load_string($zip->getFromIndex($index));
            $rows = [];
            foreach ($xml->sheetData->row as $row) {
                $rowData = [];
                foreach ($row->c as $cell) {
                    $rAttr = (string)$cell['r'];
                    $colLetter = preg_replace('/[0-9]/', '', $rAttr);
                    $colIndex = 0;
                    $len = strlen($colLetter);
                    for ($i = 0; $i < $len; $i++) {
                        $colIndex = $colIndex * 26 + (ord($colLetter[$i]) - 64);
                    }
                    $colIndex = $colIndex - 1;

                    $val = (string)$cell->v;
                    $type = (string)$cell['t'];
                    if ($type == 's') {
                        $val = $sharedStrings[(int)$val] ?? '';
                    }
                    $rowData[$colIndex] = $val;
                }
                $rows[] = $rowData;
            }
            
            $inBrands = false;
            $inCategories = false;
            foreach ($rows as $row) {
                if (empty($row)) continue;
                $firstVal = trim($row[0] ?? '');
                if ($firstVal == 'Brand Code') {
                    $inBrands = true;
                    $inCategories = false;
                    continue;
                }
                if ($firstVal == 'Category Code') {
                    $inBrands = false;
                    $inCategories = true;
                    continue;
                }
                if ($firstVal == 'CATEGORIES & SUBCATEGORIES') {
                    $inBrands = false;
                    $inCategories = false;
                    continue;
                }

                if ($inBrands && count($row) >= 2 && !empty($row[0])) {
                    Brand::updateOrCreate(
                        ['code' => trim($row[0])],
                        [
                            'name' => trim($row[1] ?? $row[0]),
                            'manufacturer' => trim($row[2] ?? ''),
                            'country_of_origin' => trim($row[3] ?? ''),
                        ]
                    );
                }

                if ($inCategories && count($row) >= 4 && !empty($row[0])) {
                    $cat = Category::updateOrCreate(
                        ['code' => trim($row[0])],
                        ['name' => trim($row[1])]
                    );
                    Subcategory::updateOrCreate(
                        [
                            'category_id' => $cat->id,
                            'code' => trim($row[2])
                        ],
                        ['name' => trim($row[3])]
                    );
                }
            }
        }

        // Now parse sheet2.xml for products
        if (($index = $zip->locateName('xl/worksheets/sheet2.xml')) !== false) {
            $xml = simplexml_load_string($zip->getFromIndex($index));
            $headers = [];
            $rowCount = 0;
            foreach ($xml->sheetData->row as $row) {
                $rowCount++;
                $rowData = [];
                foreach ($row->c as $cell) {
                    $rAttr = (string)$cell['r'];
                    $colLetter = preg_replace('/[0-9]/', '', $rAttr);
                    $colIndex = 0;
                    $len = strlen($colLetter);
                    for ($i = 0; $i < $len; $i++) {
                        $colIndex = $colIndex * 26 + (ord($colLetter[$i]) - 64);
                    }
                    $colIndex = $colIndex - 1;

                    $val = (string)$cell->v;
                    $type = (string)$cell['t'];
                    if ($type == 's') {
                        $val = $sharedStrings[(int)$val] ?? '';
                    }
                    $rowData[$colIndex] = $val;
                }

                if ($rowCount < 3) {
                    continue; // Skip title rows
                }

                if ($rowCount == 3) {
                    $headers = $rowData;
                    continue;
                }

                if (empty($rowData[0])) {
                    continue;
                }

                $mapped = [];
                foreach ($headers as $idx => $header) {
                    if (!empty($header)) {
                        $mapped[$header] = trim($rowData[$idx] ?? '');
                    }
                }

                // Brand
                $brand = null;
                if (!empty($mapped['Brand Code'])) {
                    $brand = Brand::where('code', $mapped['Brand Code'])->first();
                }
                if (!$brand && !empty($mapped['Brand'])) {
                    $brand = Brand::firstOrCreate(
                        ['name' => $mapped['Brand']],
                        [
                            'code' => $mapped['Brand Code'] ?? strtoupper(substr($mapped['Brand'], 0, 3)),
                            'manufacturer' => $mapped['Manufacturer / Principal'] ?? null,
                            'country_of_origin' => $mapped['Country of Origin'] ?? null,
                        ]
                    );
                }

                // Category
                $category = null;
                if (!empty($mapped['Category'])) {
                    $category = Category::firstOrCreate(['name' => $mapped['Category']]);
                }

                // Subcategory
                $subcategory = null;
                if ($category && !empty($mapped['Subcategory'])) {
                    $subcategory = Subcategory::firstOrCreate(
                        [
                            'category_id' => $category->id,
                            'name' => $mapped['Subcategory']
                        ],
                        [
                            'code' => $mapped['Subcategory Code'] ?? null
                        ]
                    );
                }

                if (!$brand || !$subcategory) {
                    continue;
                }

                Product::updateOrCreate(
                    ['sku_code' => $mapped['SKU Code']],
                    [
                        'brand_id' => $brand->id,
                        'subcategory_id' => $subcategory->id,
                        'item_code' => $mapped['Item Code'] ?? null,
                        'product_type' => $mapped['Product Type'] ?? null,
                        'product_family' => $mapped['Product Family'] ?? null,
                        'model_name' => $mapped['Model Name'] ?? null,
                        'capacity_l' => $mapped['Capacity (L)'] ?? null,
                        'orientation_mounting' => $mapped['Orientation / Mounting'] ?? null,
                        'heating_power_kw' => $mapped['Heating Power (kW)'] ?? null,
                        'voltage' => $mapped['Voltage'] ?? null,
                        'max_working_pressure_bar' => $mapped['Max Working Pressure (bar)'] ?? null,
                        'height_length_mm' => $mapped['Height / Length (mm)'] ?? null,
                        'diameter_width_mm' => $mapped['Diameter / Width (mm)'] ?? null,
                        'tank_protection_lining' => $mapped['Tank Protection / Lining'] ?? null,
                        'heating_element' => $mapped['Heating Element'] ?? null,
                        'warranty_yrs' => $mapped['Warranty (yrs)'] ?? null,
                        'mfr_part_code' => $mapped['Mfr Part Code'] ?? null,
                        'source_catalogue' => $mapped['Source Catalogue'] ?? null,
                        'notes' => $mapped['Notes'] ?? null,
                    ]
                );
            }
        }

        $zip->close();
        $this->command->info("SKU Database Seeded Successfully!");
    }
}
