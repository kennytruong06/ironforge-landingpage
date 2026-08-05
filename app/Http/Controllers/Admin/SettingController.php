<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function edit()
    {
        $settings = Schema::hasTable('settings')
            ? Setting::pluck('value', 'key')->all()
            : [];

        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        if (! Schema::hasTable('settings')) {
            return redirect()
                ->route('admin.settings.edit')
                ->with('error', 'Bảng settings chưa tồn tại. Hãy chạy migrate trước khi cấu hình thanh nổi.');
        }

        $validated = $request->validate([
            'site_name' => ['required', 'string', 'max:255'],
            'site_logo' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'hero_background_color' => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'hero_background_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:6144', 'dimensions:min_width=1200,min_height=600'],
            'remove_hero_background_image' => ['nullable', 'boolean'],
            'hero_eyebrow' => ['required', 'string', 'max:150'],
            'hero_title' => ['required', 'string', 'max:255'],
            'hero_description' => ['required', 'string', 'max:2000'],

            'stat_1_value' => ['required', 'string', 'max:30'],
            'stat_1_label' => ['required', 'string', 'max:100'],
            'stat_2_value' => ['required', 'string', 'max:30'],
            'stat_2_label' => ['required', 'string', 'max:100'],
            'stat_3_value' => ['required', 'string', 'max:30'],
            'stat_3_label' => ['required', 'string', 'max:100'],
            'stat_4_value' => ['required', 'string', 'max:30'],
            'stat_4_label' => ['required', 'string', 'max:100'],
            'about_eyebrow' => ['required', 'string', 'max:100'],
            'about_title' => ['required', 'string', 'max:255'],
            'about_description_1' => ['required', 'string', 'max:2000'],
            'about_description_2' => ['nullable', 'string', 'max:2000'],
            'about_point_1' => ['nullable', 'string', 'max:255'],
            'about_point_2' => ['nullable', 'string', 'max:255'],
            'about_point_3' => ['nullable', 'string', 'max:255'],
            'about_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096', 'dimensions:min_width=600,min_height=300'],
            'floating_phone' => ['nullable', 'string', 'max:50'],
            'floating_zalo' => ['nullable', 'string', 'max:255'],
            'floating_facebook' => ['nullable', 'string', 'max:255'],
            'floating_chat' => ['nullable', 'string', 'max:255'],
            'floating_cart_badge' => ['nullable', 'string', 'max:20'],
            'show_floating_cart' => ['nullable'],
            'show_floating_zalo' => ['nullable'],
            'show_floating_phone' => ['nullable'],
            'show_floating_chat' => ['nullable'],
            'show_floating_facebook' => ['nullable'],
            'show_floating_bar' => ['nullable'],
        ]);

        $currentSettings = Setting::pluck('value', 'key')->all();

        $siteLogo = $currentSettings['site_logo'] ?? null;
        $heroBackgroundImage = $currentSettings['hero_background_image'] ?? null;
        $aboutImage = $currentSettings['about_image'] ?? null;

        if ($request->hasFile('site_logo')) {
            if ($siteLogo) {
                Storage::disk('public')->delete($siteLogo);
            }

            $siteLogo = $request->file('site_logo')->store('brand', 'public');
        }

        if ($request->hasFile('about_image')) {
            if ($aboutImage) {
                Storage::disk('public')->delete($aboutImage);
            }

            $aboutImage = $request->file('about_image')->store('about', 'public');
        }

        if ($request->boolean('remove_hero_background_image') && $heroBackgroundImage) {
            Storage::disk('public')->delete($heroBackgroundImage);
            $heroBackgroundImage = null;
        }

        if ($request->hasFile('hero_background_image')) {
            if ($heroBackgroundImage) {
                Storage::disk('public')->delete($heroBackgroundImage);
            }

            $heroBackgroundImage = $request->file('hero_background_image')->store('hero', 'public');
        }

        $payload = [
            'site_name' => $validated['site_name'],
            'site_logo' => $siteLogo,
            'hero_background_color' => strtoupper($validated['hero_background_color']),
            'hero_background_image' => $heroBackgroundImage,
            'hero_eyebrow' => $validated['hero_eyebrow'],
            'hero_title' => $validated['hero_title'],
            'hero_description' => $validated['hero_description'],

            'stat_1_value' => $validated['stat_1_value'],
            'stat_1_label' => $validated['stat_1_label'],
            'stat_2_value' => $validated['stat_2_value'],
            'stat_2_label' => $validated['stat_2_label'],
            'stat_3_value' => $validated['stat_3_value'],
            'stat_3_label' => $validated['stat_3_label'],
            'stat_4_value' => $validated['stat_4_value'],
            'stat_4_label' => $validated['stat_4_label'],
            'about_eyebrow' => $validated['about_eyebrow'],
            'about_title' => $validated['about_title'],
            'about_description_1' => $validated['about_description_1'],
            'about_description_2' => $validated['about_description_2'] ?? null,
            'about_point_1' => $validated['about_point_1'] ?? null,
            'about_point_2' => $validated['about_point_2'] ?? null,
            'about_point_3' => $validated['about_point_3'] ?? null,
            'about_image' => $aboutImage,
            'floating_phone' => $validated['floating_phone'] ?? null,
            'floating_zalo' => $validated['floating_zalo'] ?? null,
            'floating_facebook' => $validated['floating_facebook'] ?? null,
            'floating_chat' => $validated['floating_chat'] ?? null,
            'floating_cart_badge' => $validated['floating_cart_badge'] ?? null,
            'show_floating_cart' => $request->boolean('show_floating_cart') ? '1' : '0',
            'show_floating_zalo' => $request->boolean('show_floating_zalo') ? '1' : '0',
            'show_floating_phone' => $request->boolean('show_floating_phone') ? '1' : '0',
            'show_floating_chat' => $request->boolean('show_floating_chat') ? '1' : '0',
            'show_floating_facebook' => $request->boolean('show_floating_facebook') ? '1' : '0',
            'show_floating_bar' => $request->boolean('show_floating_bar') ? '1' : '0',
        ];

        foreach ($payload as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return redirect()
            ->route('admin.settings.edit')
            ->with('success', 'Cài đặt website đã được cập nhật.');
    }
}
