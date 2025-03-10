<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Categories;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(10);
        $data = Categories::all();

        return view('products.index', compact('products','data'));
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
        $request->validate([
            'name' => 'required|string|max:255',
            'group'=> 'required|string|max:255',
            'categories_id' => 'required|string|max:255',
            'description' => 'required|string',
            'picture' => 'required|image|mimes:png,jpg,jpeg|max:4096',
            'size' => 'required|array|min:1', // Wajib memilih minimal 1 checkbox
            'size.*' => 'string', // Semua elemen dalam array size harus string
            'stock' => 'required|array',
            'price' => 'required|array',
            'stock.*' => 'nullable|numeric|min:0', // Stok harus angka
            'price.*' => 'nullable|numeric|min:0', // Harga harus angka
        ]);

        $sizes = $request->input('size');
        $fileName = Str::random(16) . '.' . $request->file('picture')->getClientOriginalExtension();
        $request->file('picture')->storeAs('public/products', $fileName);

        foreach ($sizes as $size) {
            $stock = $request->input("stock.{$size}");
            $price = $request->input("price.{$size}");

            $product = Product::where('name', $request->input('name'))
                ->where('group', $request->input('group'))
                ->where('size', $size)
                ->first();

            if ($product) {
                $product->increment('stock', $stock);
                $product->price = $price;
                $product->save();
            } else {
                Product::create([
                    'name' => $request->input('name'),
                    'categories_id' => $request->input('categories_id'),
                    'group' => $request->input('group'),
                    'size' => $size,
                    'stock' => $stock,
                    'price' => $price,
                    'picture' => $fileName,
                    'description' => $request->input('description'),
                ]);
            }
        }
        return redirect()->route('products.index')->with('success', 'Products created or updated successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $product = Product::find($product->id);
        $data = Categories::all();
        return view('products.edit.index', compact('data','product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'group'=> 'required|string|max:255',
            'categories_id' => 'required|string|max:255',
            'description' => 'required|string',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
            'stock' => 'required|numeric|min:0', // Stok harus angka
            'price' => 'required|numeric|min:0',
        ]);



        $product = Product::find($product->id);



        // Tentukan folder penyimpanan gambar
            $folder = 'public/products'; // Ganti dengan folder Anda

            // Cek apakah ada file gambar baru yang diunggah
            if ($request->hasFile('picture')) {
                // Hapus file lama dari storage jika ada
                if ($product->picture && Storage::exists("$folder/{$product->picture}")) {
                    Storage::delete("$folder/{$product->picture}");
                }

                // Simpan file baru ke storage
                $file = $request->file('picture');
                $fileName = Str::random(16) . '.' . $request->file('picture')->getClientOriginalExtension();
                $file->storeAs($folder, $fileName); // Simpan ke folder

                // Perbarui nama file di database
                $product->picture = $fileName;
            }
            $product->name = $request->name;
            $product->group = $request->group;
            $product->categories_id = $request->categories_id;
            $product->description = $request->description;
            $product->stock = $request->stock;
            $product->price = $request->price;
            $product->save();
            return redirect()->route('products.index')->with('success','');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product = Product::find($product->id);
        Storage::delete("public/products/{$product->picture}");
        $product->delete();
        return redirect()->route('products.index')->with('success','Product deleted successfully');
    }
}
