<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PreviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $name)
    {
                // Ambil semua ukuran berdasarkan nama produk yang sama dan stok yang masih ada
            $productVariants = Product::where('name', $name)->where('stock', '>', 0)->get();

            // Jika tidak ada stok produk yang tersedia, tampilkan 404
            if ($productVariants->isEmpty()) {
                abort(404, "Produk tidak tersedia.");
            }
            // dd($productVariants);
            return view('preview.index', compact('productVariants'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
