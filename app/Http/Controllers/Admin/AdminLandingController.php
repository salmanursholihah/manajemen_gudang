<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminLandingController extends Controller
{
    public function index()
    {

        $contents = LandingContent::orderBy('section')->orderBy('id')->get();

        $hero       = LandingContent::where('section', 'hero')->first();
        $features   = LandingContent::where('section', 'fitur')->get();
        $demo       = LandingContent::where('section', 'demo')->first();
        $integrasi  = LandingContent::where('section', 'integrasi')->get();
        $testimoni  = LandingContent::where('section', 'testimoni')->get();
        $faq        = LandingContent::where('section', 'faq')->get();
        $kontak     = LandingContent::where('section', 'kontak')->first();
        $footer     = LandingContent::where('section', 'footer')->first();

        return view('backend.admin.landings.index', compact(
            'hero',
            'features',
            'demo',
            'integrasi',
            'testimoni',
            'faq',
            'kontak',
            'footer',
            'contents'
        ));
    }


    public function create()
    {
        return view('backend.admin.landings.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'section' => 'required|string',
            'title'   => 'nullable|string',
            'content' => 'nullable|string',
            'image'   => 'nullable|image|max:2048',
            'order'   => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('landing', 'public');
        }

        LandingContent::create($data);

        return redirect()->route('backend.admin.landings.index')->with('success', 'Konten ditambahkan');
    }

    public function edit(LandingContent $landingContent)
    {
        return view('backend.landings.edit', compact('landingContent'));
    }

    public function update(Request $request, LandingContent $landingContent)
    {
        $data = $request->validate([
            'title'   => 'nullable|string',
            'content' => 'nullable|string',
            'image'   => 'nullable|image|max:2048',
            'order'   => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            if ($landingContent->image) {
                Storage::disk('public')->delete($landingContent->image);
            }
            $data['image'] = $request->file('image')->store('landing', 'public');
        }

        $landingContent->update($data);

        return redirect()->route('backend.admin.landings.index')->with('success', 'Konten diperbarui');
    }

    public function destroy(LandingContent $landingContent)
    {
        if ($landingContent->image) {
            Storage::disk('public')->delete($landingContent->image);
        }
        $landingContent->delete();

        return redirect()->route('abackend.admin.landings.index')->with('success', 'Konten dihapus');
    }
}