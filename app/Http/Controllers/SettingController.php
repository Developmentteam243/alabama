<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Services\CloudinaryService;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display settings form.
     */
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        return view('settings.index', compact('settings'));
    }

    /**
     * Update settings.
     */
    public function update(Request $request)
    {
        $data = $request->except(['_token', '_method', 'hero_image', 'who_we_are_image']);

        foreach ($data as $key => $value) {
            Setting::set($key, $value, $request->input('group', 'general'));
        }

        // Handle hero image upload
        if ($request->hasFile('hero_image')) {
            $imageUrl = CloudinaryService::upload($request->file('hero_image'));
            if ($imageUrl) {
                Setting::set('hero_image_url', $imageUrl, 'homepage');
            }
        }

        // Handle Who We Are / Built on Quality image upload
        if ($request->hasFile('who_we_are_image')) {
            $imageUrl = CloudinaryService::upload($request->file('who_we_are_image'));
            if ($imageUrl) {
                Setting::set('who_we_are_image_url', $imageUrl, 'homepage');
            }
        }

        return redirect()->route('settings.index')->with('success', 'Settings updated successfully.');
    }
}
