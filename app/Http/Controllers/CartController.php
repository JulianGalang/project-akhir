<?php

namespace App\Http\Controllers;

use App\Models\P;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $cartItems = Cart::all()->where('user_id', $userId);

    // Debugging untuk melihat apakah data berhasil diambil
        // dd($cartItems);
        return view('cart.index',compact('cartItems'));
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
            'products_id' => 'integer|required',
            'quantity' => 'integer|required|min:1',
        ]);

        $userId = Auth::id();
        $product = Product::findOrFail($request->products_id); // Ambil data produk berdasarkan ID

        // Cek apakah produk sudah ada di keranjang
        $existingItem = Cart::where('user_id', $userId)
                            ->where('products_id', $request->products_id)
                            ->first();

        // Jika ada, hitung total quantity
        $currentQuantityInCart = $existingItem ? $existingItem->quantity : 0;
        $newQuantityRequest = $request->quantity;

        // Total quantity yang akan dimasukkan ke keranjang (quantity yang ada di keranjang ditambah quantity yang diminta)
        $totalQuantity = $currentQuantityInCart + $newQuantityRequest;

        // Mengecek apakah total quantity melebihi stok yang ada
        if ($totalQuantity > $product->stock) {
            // Jika lebih dari stok, hanya ambil sisa stok yang ada
            $availableStock = $product->stock - $currentQuantityInCart;
            $newQuantityRequest = $availableStock; // Set quantity yang bisa ditambahkan sesuai stok yang tersedia
        }

        // Cek apakah produk sudah ada di keranjang
        if ($existingItem) {
            // Jika ada, update quantity
            $existingItem->quantity += $newQuantityRequest;
            $existingItem->save();
        } else {
            // Jika tidak ada, buat item baru di keranjang
            Cart::create([
                'user_id' => $userId,
                'products_id' => $request->products_id,
                'quantity' => $newQuantityRequest,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();
        return redirect('/cart')->with('success','');
    }
}
