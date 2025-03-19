<?php

namespace App\Http\Controllers\Organization_Admin;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Organization;
use App\Models\Event;
use App\Models\Article;
use App\Models\Product;
use App\Models\Invoice;

class OrganizationAdminController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
    
        if (!$user->organization) {
            return redirect()->route('login')->with('error', 'No associated organization found.');
        }
    
        $organization = $user->organization;
    
        $totalEvents = Event::where('organization_id', $organization->id)->count();
        $totalArticles = Article::where('organization_id', $organization->id)->count();
        $totalProducts = Product::where('organization_id', $organization->id)->count();
        $totalInvoices = Invoice::whereHas('details.product', function ($query) use ($organization) {
            $query->where('organization_id', $organization->id);
        })->count();
    
        return view('organization_admin.dashboard', compact('organization', 'totalEvents', 'totalArticles', 'totalProducts', 'totalInvoices'));
    }

    // ✅ Show Edit Profile Form
    public function editProfile()
    {
        $organization = Auth::user()->organization;
        return view('organization_admin.profile.edit', compact('organization'));
    }

    // ✅ Handle Profile Update
    public function updateProfile(Request $request)
    {
        $organization = Auth::user()->organization;

        if (!$organization) {
            return redirect()->route('login')->with('error', 'No associated organization found.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'email' => 'required|email|unique:organizations,email,' . $organization->id,
            'phone' => 'nullable|string|max:15',
            'website' => 'nullable|url',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
        ]);

        // ✅ Initialize all form fields except the image fields
        $organizationData = $request->except(['logo', 'banner_image']);

        // ✅ Store the binary image data
        if ($request->hasFile('logo')) {
            $organizationData['logo'] = file_get_contents($request->file('logo')->getRealPath());
        }

        if ($request->hasFile('banner_image')) {
            $organizationData['banner_image'] = file_get_contents($request->file('banner_image')->getRealPath());
        }

        // ✅ Update the organization (only once!)
        $organization->update($organizationData);

        return redirect()->route('organization_admin.dashboard')->with('success', 'Profil organisasi berhasil diperbarui.');
    }

}