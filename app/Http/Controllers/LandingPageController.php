<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Categories;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::where('stock', '>', 0)
        ->with('categories') // Mengambil relasi category
        ->get()
        ->groupBy('name'); // Kelompokkan berdasarkan nama produk

        $categories = Categories::all();
        return view("landingpage.index",compact('products','categories'));
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
    public function show(string $id)
    {
        // Ambil produk berdasarkan kategori yang dipilih dan stok lebih dari 0
        $products = Product::where('categories_id', $id)
        ->where('stock', '>', 0) // Pastikan stok lebih dari 0
        ->with('categories') // Mengambil relasi kategori
        ->get();


    // Ambil kategori berdasarkan id yang diberikan
        $category = Categories::findOrFail($id);

        return view('landingpage.categories', compact('products', 'category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
