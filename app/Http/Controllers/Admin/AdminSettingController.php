<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminSettingController extends Controller
{
    public function index()
    {
        $settings = Setting::orderBy('group')->get();
        return view('backend.admin.settings.index', compact('settings'));
    }

    public function create()
    {
        return view('backend.admin.settings.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'key'   => 'required|string|unique:settings,key',
            'type'  => 'required|in:text,image,color',
            'group' => 'required|string',
        ];

        if ($request->type === 'image') {
            $rules['value'] = 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048';
        } elseif ($request->type === 'color') {
            $rules['value'] = 'nullable|string|regex:/^#[0-9A-Fa-f]{6}$/';
        } else {
            $rules['value'] = 'nullable|string';
        }

        $validated = $request->validate($rules);

        $data = $request->only(['key', 'type', 'group']);

        if ($request->type === 'image' && $request->hasFile('value')) {
            $data['value'] = $request->file('value')->store('settings', 'public');
        } else {
            $data['value'] = $request->value;
        }

        Setting::create($data);

        return redirect()->route('backend.admin.settings.index')->with('success', 'Setting created successfully.');
    }

    public function edit(Setting $setting)
    {
        return view('backend.admin.settings.edit', compact('setting'));
    }

    public function update(Request $request, Setting $setting)
    {
        $rules = [];

        if ($setting->type === 'image') {
            $rules['value'] = 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048';
        } elseif ($setting->type === 'color') {
            $rules['value'] = 'nullable|string|regex:/^#[0-9A-Fa-f]{6}$/';
        } else {
            $rules['value'] = 'nullable|string';
        }

        $validated = $request->validate($rules);

        if ($setting->type === 'image' && $request->hasFile('value')) {
            if ($setting->value && Storage::disk('public')->exists($setting->value)) {
                Storage::disk('public')->delete($setting->value);
            }
            $setting->value = $request->file('value')->store('settings', 'public');
        } else {
            $setting->value = $request->value;
        }

        $setting->save();

        return redirect()->route('backend.admin.settings.index')->with('success', 'Setting updated successfully.');
    }

    public function destroy(Setting $setting)
    {
        if ($setting->type === 'image' && $setting->value) {
            Storage::disk('public')->delete($setting->value);
        }

        $setting->delete();

        return redirect()->route('backend.admin.settings.index')->with('success', 'Setting deleted successfully.');
    }
}
