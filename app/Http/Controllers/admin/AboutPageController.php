<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AboutPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $about = DB::table('about_pages')->first();
        return view('themes.admin.about-page.index', compact('about'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $about = DB::table('about_pages')->first();
        return view('themes.admin.about-page.edit', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'hero_description' => 'required|string',
            'badge_text' => 'required|string|max:255',
            'intro_description' => 'required|string',
            'mission' => 'required|string',
            'vision' => 'required|string',
            'years_of_service' => 'required|integer|min:1',
            'service_description' => 'required|string',
        ]);

        $about = DB::table('about_pages')->first();

        if ($about) {
            DB::table('about_pages')->update($validated);
            return admin_redirect('about-page')->with('success', 'About page updated successfully!');
        } else {
            DB::table('about_pages')->insert($validated);
            return admin_redirect('about-page')->with('success', 'About page created successfully!');
        }
    }
}
