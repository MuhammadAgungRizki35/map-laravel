<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller {
    public function index() {
        $images = Image::latest()->get();
        return view('admin.images.index', compact('images'));
    }

    public function create() {
        return view('admin.images.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'description' => 'nullable|string',
    ]);

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images', 'public');
    } else {
        $imagePath = null;
    }

    Image::create([
        'image_path' => $imagePath,
        'description' => $request->description,
    ]);

    return redirect()->route('admin.images.index')->with('success', 'Gambar berhasil ditambahkan.');
}


    public function show(Image $image) {
        return view('admin.images.show', compact('image'));
    }

    public function edit(Image $image) {
        return view('admin.images.edit', compact('image'));
    }

    public function update(Request $request, Image $image) {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $image->update(['image_path' => $imagePath]);
        }

        $image->update(['description' => $request->description]);

        return redirect()->route('admin.images.index')->with('success', 'Gambar berhasil diperbarui.');
    }

    public function destroy(Image $image) {
        $image->delete();
        return redirect()->route('admin.images.index')->with('success', 'Gambar berhasil dihapus.');
    }
}