<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image; // Import model Image

class dashboardController extends Controller
{
    // public function index(){
    //     return view ('dashboard');
    // }

    public function index()
{
    $images = Image::latest()->get(); // Ambil gambar dari database
    return view('dashboard', compact('images')); // Kirim ke view dashboard user
}
}  