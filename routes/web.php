<?php

use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Halaman Utama Publik (Landing Page QRIS Mahasiswa IDN)
Route::get('/', function (Request $request) {
    $search = trim((string) $request->input('q', ''));

    $merchants = Merchant::query()
        ->select(['id', 'user_id', 'name', 'slug', 'phone', 'qris_image', 'description', 'keywords', 'location', 'is_open', 'schedule'])
        ->with(['products' => function ($q) {
            $q->select(['id', 'merchant_id', 'name', 'price', 'description', 'is_available'])
                ->where('is_available', true)
                ->latest();
        }])
        ->search($search)
        ->latest()
        ->get();

    return view('welcome', compact('merchants', 'search'));
})->name('home');
