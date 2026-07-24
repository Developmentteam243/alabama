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

        // Find the Excel file dynamically
        $file_path = env('SEEDER_EXCEL_PATH');
        if (!$file_path || !file_exists($file_path)) {
            $possible_paths = [
                base_path('Alabama_Master SKU.xlsx'),
                database_path('seeders/Alabama_Master SKU.xlsx'),
                storage_path('app/Alabama_Master SKU.xlsx'),
                "C:/Users/AGL IT/Downloads/Alabama_Master SKU.xlsx" // Fallback
            ];
            foreach ($possible_paths as $path) {
                if (file_exists($path)) {
                    $file_path = $path;
                    break;
                }
            }
        }

        if (!$file_path || !file_exists($file_path)) {
            $this->command->error("Excel file not found. Please upload 'Alabama_Master SKU.xlsx' to the project root directory or set SEEDER_EXCEL_PATH in your .env file.");
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

        // Update category descriptions
        $descriptions = [
            'Hot Water System' => 'Gas boilers, solar and electric water heaters and calorifiers for villas, towers and industrial plants.',
            'Plumbing Materials' => 'Pipes, fittings, valves, pumps and pressure control for every system.',
            'Sanitaryware' => 'WCs, wash basins and shattafs for residential and commercial washrooms.',
            'Bathroomware' => 'Shower mixers, taps and accessories that finish the bathroom right.',
            'Kitchen' => 'Sinks and sink taps built for daily use in UAE homes and facilities.',
        ];

        foreach ($descriptions as $name => $desc) {
            $cat = \App\Models\Category::where('name', $name)->first();
            if ($cat) {
                $cat->update(['description' => $desc]);
            }
        }

        // Update brand details
        $brandDetails = [
            'LAM' => [
                'description' => 'Italian heating engineering from Lamborghini CaloreClima — glasslined electric storage water heaters across the TAURUS, E-Glasstech and Glass Thermal families, with tank warranties up to 7 years.',
                'logo_url' => 'https://alabamauae.com/wp-content/uploads/2026/01/20.png',
            ],
            'ZEN' => [
                'description' => 'Zenith Water Heaters offer reliable, highly efficient thermosyphonic solar hot water systems and premium storage heaters designed specifically for G.C.C. climate requirements.',
                'logo_url' => 'https://alabamauae.com/wp-content/uploads/2026/01/13.png',
            ],
            'ARI' => [
                'description' => 'Ariston is a global specialist in water heating and heating products, providing people all over the world with efficient and high-quality Italian solutions for their comfort.',
                'logo_url' => 'https://alabamauae.com/wp-content/uploads/2026/01/20.png',
            ],
            'VER' => [
                'description' => 'VERA provides durable plumbing materials, valves, and water accessories built to international standards for commercial and residential installations.',
                'logo_url' => 'https://alabamauae.com/wp-content/uploads/2026/01/13.png',
            ],
            'PEG' => [
                'description' => 'Pegler is a leading manufacturer of high-quality taps, mixers, valves, and fittings, combining state of the art design with exceptional performance.',
                'logo_url' => 'https://alabamauae.com/wp-content/uploads/2026/01/20.png',
            ],
        ];

        foreach ($brandDetails as $code => $details) {
            $brand = \App\Models\Brand::where('code', $code)->first();
            if ($brand) {
                $brand->update($details);
            }
        }

        // Seed default blogs
        \App\Models\Blog::firstOrCreate(
            ['slug' => 'electric-vs-solar-water-heaters-what-uae-villas-actually-need'],
            [
                'title' => 'Electric vs. solar water heaters: what UAE villas actually need',
                'tag' => 'Hot water',
                'content' => "Selecting the right water heating system for a villa in the UAE is one of the most critical decisions during construction or renovation. The tropical desert climate offers an abundance of sunlight, which makes solar water heaters an attractive, eco-friendly option. However, electric water heaters remain popular due to their low initial cost and straightforward installation.\n\nWhen deciding between the two, home owners must consider three primary factors: installation costs, operational efficiency, and maintenance. Solar water heaters can offset up to 70% of water-heating energy bills, but they require proper roof space, regular maintenance of collector panels, and a backup electric heating element for cloudy days or high-demand periods.\n\nOn the other hand, electric water heaters (both storage and instant) are compact and highly reliable but contribute significantly to the monthly utility bills. For most standard UAE villas, a hybrid solution or a high-efficiency electric system is the most practical choice.",
                'image_url' => 'https://alabamauae.com/wp-content/uploads/2026/01/hot-water-system.webp',
                'is_active' => true,
            ]
        );

        \App\Models\Blog::firstOrCreate(
            ['slug' => 'how-to-choose-the-right-pump-for-multi-storey-buildings'],
            [
                'title' => 'How to choose the right pump for multi-storey buildings',
                'tag' => 'Plumbing',
                'content' => "In multi-storey residential and commercial buildings, maintaining optimal water pressure on the upper floors is a common engineering challenge. Standard municipal pressure is rarely sufficient to lift water beyond the second floor, necessitating robust boosting and pumping systems.\n\nChoosing the right pump involves understanding three types: multistage, self-priming, and booster sets. Multistage centrifugal pumps are the industry standard for high-rise buildings because they use multiple impellers to build pressure incrementally, ensuring high efficiency and reliable flow even at extreme heights.\n\nIt is crucial to correctly calculate the static head (height difference) and dynamic head (friction loss in pipes) before purchase. Installing an oversized pump leads to wasted energy and pipe stress, while an undersized pump results in weak flow for top-floor residents.",
                'image_url' => 'https://alabamauae.com/wp-content/uploads/2026/01/plumbing-materials.webp',
                'is_active' => true,
            ]
        );

        \App\Models\Blog::firstOrCreate(
            ['slug' => 'brass-vs-zinc-fittings-why-the-material-behind-the-finish-matters'],
            [
                'title' => 'Brass vs. zinc fittings: why the material behind the finish matters',
                'tag' => 'Sanitaryware',
                'content' => "When buying faucets and plumbing fittings, it is easy to get distracted by a flawless chrome, matte black, or brushed gold finish. However, the beauty of a fitting is only skin-deep; what lies beneath the plating determines whether it will last fifteen years or fail in two.\n\nHigh-quality sanitaryware utilizes solid brass as the core material. Brass is highly resistant to rust, corrosion, and calcification from hard water, making it ideal for the high-temperature and humid conditions of the Gulf. It is also physically durable and handles constant water pressure without cracking.\n\nIn contrast, cheaper fittings often use zinc alloy (zamak). While zinc is inexpensive to cast, it is far more susceptible to corrosion when exposed to moisture. Over time, zinc fittings corrode from the inside out, leading to leaks, pinholes, and chrome peeling off. Always ask for certified lead-free brass for drinking water outlets.",
                'image_url' => 'https://alabamauae.com/wp-content/uploads/2026/01/sanitary-ware.webp',
                'is_active' => true,
            ]
        );

        $this->command->info("Blog Posts Seeded Successfully!");
    }
}
