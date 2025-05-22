<?php

namespace App\Http\Controllers\Admin;

use App\Models\Organization;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function index()
    {
        $organizations = Organization::all();
        return view('admin.organizations.index', compact('organizations'));
    }

    public function create()
    {
        return view('admin.organizations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'email' => 'required|email|unique:organizations,email',
            'phone' => 'nullable|string|max:15',
            'website' => 'nullable|url',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        $organizationData = $request->except(['logo', 'banner_image']);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $mime = $file->getMimeType();
            $base64 = base64_encode(file_get_contents($file));
            $organizationData['logo'] = "data:$mime;base64,$base64";
        }

        if ($request->hasFile('banner_image')) {
            $file = $request->file('banner_image');
            $mime = $file->getMimeType();
            $base64 = base64_encode(file_get_contents($file));
            $organizationData['banner_image'] = "data:$mime;base64,$base64";
        }

        Organization::create($organizationData);

        return redirect()->route('admin.organizations.index')->with('success', 'Organization added successfully.');
    }

    public function edit($id)
    {
        $organization = Organization::findOrFail($id);
        return view('admin.organizations.edit', compact('organization'));
    }

    public function update(Request $request, $id)
    {
        $organization = Organization::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'email' => 'required|email|unique:organizations,email,' . $organization->id,
            'phone' => 'nullable|string|max:15',
            'website' => 'nullable|url',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        $organizationData = $request->except(['logo', 'banner_image']);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $mime = $file->getMimeType();
            $base64 = base64_encode(file_get_contents($file));
            $organizationData['logo'] = "data:$mime;base64,$base64";
        }

        if ($request->hasFile('banner_image')) {
            $file = $request->file('banner_image');
            $mime = $file->getMimeType();
            $base64 = base64_encode(file_get_contents($file));
            $organizationData['banner_image'] = "data:$mime;base64,$base64";
        }

        $organization->update($organizationData);

        return redirect()->route('admin.organizations.index')->with('success', 'Organization updated successfully.');
    }

    public function destroy($id)
    {
        $organization = Organization::findOrFail($id);
        $organization->delete();

        return redirect()->route('admin.organizations.index')->with('success', 'Organization successfully deleted.');
    }
}
