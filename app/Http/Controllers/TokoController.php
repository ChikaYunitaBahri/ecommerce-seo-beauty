<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class TokoController extends Controller
{
    /**
     * Menampilkan halaman toko dengan daftar produk.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mengambil semua produk dari database
        $products = Product::all();

        // Mengirim data produk ke tampilan toko
        return view('toko', compact('products'));
    }

    /**
     * Menampilkan detail produk berdasarkan ID.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Mencari produk berdasarkan ID, jika tidak ditemukan akan menampilkan error 404
        $product = Product::findOrFail($id);

        // Mengirim data produk ke tampilan detail produk
        return view('products.show', compact('product'));
    }
}
