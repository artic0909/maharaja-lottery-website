<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class SettingController extends Controller
{
    /**
     * Display the Admin Settings & Profile Management Page.
     */
    public function index(): View
    {
        $user = Auth::user();
        $settings = [
            'hero_banner_image' => Setting::get('hero_banner_image', ''),
            'hero_title' => Setting::get('hero_title', 'Maharaja Lottery'),
            'hero_subtitle' => Setting::get('hero_subtitle', 'Tickets, Results & Support'),
            'hero_description' => Setting::get('hero_description', 'Explore current ticket availability, follow verified draw updates and receive clear guidance for winner verification and prize claims.'),
            'contact_mobile' => Setting::get('contact_mobile', '+91 87439 78796'),
            'contact_email' => Setting::get('contact_email', 'support@maharajalottery.com'),
            'contact_address' => Setting::get('contact_address', 'Lottery Directorate Complex, Vikas Bhavan, Thiruvananthapuram, Kerala 695033'),
            'social_whatsapp' => Setting::get('social_whatsapp', 'https://wa.me/918743978796'),
            'social_facebook' => Setting::get('social_facebook', 'https://facebook.com'),
            'social_instagram' => Setting::get('social_instagram', 'https://instagram.com'),
            'social_twitter' => Setting::get('social_twitter', 'https://twitter.com'),
            'social_telegram' => Setting::get('social_telegram', 'https://t.me'),
        ];

        return view('admin.settings.index', compact('user', 'settings'));
    }

    /**
     * Update Admin Profile (Name, Email, Password).
     */
    public function updateProfile(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'current_password' => ['nullable', 'required_with:new_password', 'current_password'],
            'new_password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if (!empty($validated['new_password'])) {
            $user->password = Hash::make($validated['new_password']);
        }

        $user->save();

        return redirect()->route('admin.settings.index')
            ->with('success', 'Admin profile credentials updated successfully.');
    }

    /**
     * Update Frontend Hero Section Banner & Taglines.
     */
    public function updateHeroBanner(Request $request): RedirectResponse
    {
        $request->validate([
            'hero_title' => ['required', 'string', 'max:255'],
            'hero_subtitle' => ['required', 'string', 'max:255'],
            'hero_description' => ['required', 'string', 'max:1000'],
            'hero_banner_image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:5120'],
        ]);

        Setting::set('hero_title', $request->input('hero_title'));
        Setting::set('hero_subtitle', $request->input('hero_subtitle'));
        Setting::set('hero_description', $request->input('hero_description'));

        if ($request->hasFile('hero_banner_image')) {
            $file = $request->file('hero_banner_image');
            $filename = 'hero_banner_' . time() . '.' . $file->getClientOriginalExtension();
            
            $uploadPath = public_path('uploads/banner');
            if (!File::isDirectory($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true, true);
            }

            // Remove old image if exists
            $oldImage = Setting::get('hero_banner_image');
            if ($oldImage && File::exists(public_path($oldImage))) {
                File::delete(public_path($oldImage));
            }

            $file->move($uploadPath, $filename);
            Setting::set('hero_banner_image', 'uploads/banner/' . $filename);
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Hero banner section updated successfully.');
    }

    /**
     * Remove Hero Banner Image and restore default.
     */
    public function resetHeroBannerImage(): RedirectResponse
    {
        $oldImage = Setting::get('hero_banner_image');
        if ($oldImage && File::exists(public_path($oldImage))) {
            File::delete(public_path($oldImage));
        }

        Setting::set('hero_banner_image', '');

        return redirect()->route('admin.settings.index')
            ->with('success', 'Hero banner reset to default design.');
    }

    /**
     * Update Footer Contact Information.
     */
    public function updateFooterContact(Request $request): RedirectResponse
    {
        $request->validate([
            'contact_mobile' => ['required', 'string', 'max:50'],
            'contact_email' => ['required', 'string', 'email', 'max:100'],
            'contact_address' => ['required', 'string', 'max:500'],
        ]);

        Setting::set('contact_mobile', $request->input('contact_mobile'));
        Setting::set('contact_email', $request->input('contact_email'));
        Setting::set('contact_address', $request->input('contact_address'));

        return redirect()->route('admin.settings.index')
            ->with('success', 'Footer contact details updated successfully.');
    }

    /**
     * Update Topbar Social Media Links.
     */
    public function updateSocialLinks(Request $request): RedirectResponse
    {
        $request->validate([
            'social_whatsapp' => ['nullable', 'string', 'max:255'],
            'social_facebook' => ['nullable', 'string', 'max:255'],
            'social_instagram' => ['nullable', 'string', 'max:255'],
            'social_twitter' => ['nullable', 'string', 'max:255'],
            'social_telegram' => ['nullable', 'string', 'max:255'],
        ]);

        Setting::set('social_whatsapp', $request->input('social_whatsapp', ''));
        Setting::set('social_facebook', $request->input('social_facebook', ''));
        Setting::set('social_instagram', $request->input('social_instagram', ''));
        Setting::set('social_twitter', $request->input('social_twitter', ''));
        Setting::set('social_telegram', $request->input('social_telegram', ''));

        return redirect()->route('admin.settings.index')
            ->with('success', 'Topbar social media links updated successfully.');
    }
}
