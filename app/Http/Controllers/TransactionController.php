<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use App\Models\Cart;
use Midtrans\Config;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\DetailTransaction;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("transaction.index");
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
         // Validasi data yang diterima
         $validated = $request->validate([
            'code' => 'required|string|max:255',
            'total_item' => 'required|integer',
            'total' => 'required|numeric',
            'payment_method' => 'required|string',
            'status' => 'required|string',
            'products' => 'required|array',
            'products.*' => 'required',
        ]);


        // Simpan data transaksi ke database
        $transaction = Transaction::create([
            'code' => $validated['code'],
            'user_id' => Auth::id(),
            'total_item' => $validated['total_item'],
            'total' => $validated['total'],
            'payment_method' => $validated['payment_method'],
            'status' => $validated['status'],
        ]);

        foreach ($validated['products'] as $product) {
            // $product = Product::find($product['products_id']);
            $detail = DetailTransaction::create([
                'code' => $validated['code'],
                'product_id' => $product['products_id'],
                'quantity' => $product['quantity'],
                'total_price' => $product['total_price'],
            ]);

            // Kurangi stok produk
            Cart::where('id', $product['cart_id'])->delete();
        }

        return response()->json([
            'message' => 'Transaksi berhasil disimpan',
            'transaction' => $transaction, $detail
        ], 201);
    }



    /**
     * Display the specified resource.
     */
    public function show(transaction $transaction, Request $request)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $code)
{
    $id = Auth::id();
    $transaction = Transaction::findOrFail(id: $code);
    $transaction->status = $request->status;

    // Cek jika transaksi berhasil atau tidak
    if ($transaction->status == 'packing') {
        // Mengurangi stok berdasarkan detail transaksi
        foreach ($transaction->details as $detail) {

            $product = $detail->product;
            // Pastikan stok cukup
            if ($product->stock >= $detail->quantity) {
                // Mengurangi stok produk sesuai quantity yang ada di transaksi
                $product->stock -= $detail->quantity;
                $product->save();
            } else {
                // Jika stok tidak cukup, bisa mengirimkan pesan atau mengubah status transaksi menjadi gagal
                return response()->json(['error' => 'Stok produk tidak mencukupi.'], 400);
            }
        }
    }
    // Menyimpan status transaksi yang sudah diperbarui
    $transaction->save();

    return response()->json(['message' => 'Transaction status updated successfully.']);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(transaction $transaction)
    {
        //
    }

public function ship(Request $request, $id)
{
    $request->validate([
        'resi' => 'required|string|max:255',
    ]);

    $transaction = Transaction::findOrFail($id); // Pastikan ID valid

    if ($transaction->status !== 'packing') {
        return response()->json(['error' => 'Transaksi tidak dalam status packing'], 400);
    }

    $transaction->update([
        'status' => 'shipping',
        'resi' => $request->resi,
    ]);

    return response()->json(['message' => 'Pesanan berhasil dikirim']);
}

    public function cancel(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string|max:500',
        ]);

        $transaction = Transaction::findOrFail($id);

        if (!in_array($transaction->status, ['pending','shipping', 'packing'])) {
            return response()->json(['error' => 'Transaksi tidak dapat dibatalkan'], 400);
        }

        $transaction->update([
            'status' => 'cancel',
            'description' => $request->reason,
        ]);

        return response()->json(['message' => 'Pesanan berhasil dibatalkan']);
    }
}
