<?php

namespace App\Http\Controllers;

use view;
use App\Models\Delivery;
use App\Models\Transaction;
use Termwind\Components\Dd;
use Illuminate\Http\Request;
use App\Models\DetailTransaction;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $status = $request->query('status'); // Ambil query status dari URL
    $id = Auth::id(); // Ambil ID user yang login

    // Jika status "all" atau null, tampilkan semua transaksi berdasarkan user_id
    if ($status === 'all' || $status === null) {
        $transactions = Transaction::with(['details.products'])
            ->where('user_id', $id)
            ->latest()
            ->get();
    } else {
        // Jika ada status tertentu, filter berdasarkan status tersebut
        $transactions = Transaction::with(['details.products'])
            ->where('user_id', $id)
            ->where('status', $status)
            ->latest()
            ->get();
    }

    return view("transaction.order.index", compact("transactions"));
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
    public function show(Request $request, Transaction $transaction)

    {

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
    public function update(Request $request, string $transactionId)
{
    $transaction = Transaction::find($transactionId);

    if (!$transaction) {
        return response()->json(['error' => 'Transaction not found'], 404);
    }

    $request->validate([
        'status' => 'required|string|in:pending,packing,shipping,delivered,cancel'
    ]);

    DB::beginTransaction();
    try {
        $transaction->status = $request->status;
        $transaction->save();

        if ($transaction->status == 'packing' && $transaction->details) {
            foreach ($transaction->details as $detail) {
                if ($detail->products) {
                    $product = $detail->products;

                    $product->stock -= $detail->quantity;

                    if ($product->stock < 0) {
                        $product->stock = 0;
                    }

                    $product->save();
                }
            }
        }

        DB::commit();
        return response()->json(['message' => 'Status transaksi diperbarui dan stok dikurangi']);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['error' => 'Gagal memperbarui transaksi', 'details' => $e->getMessage()], 500);
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
            // Menemukan transaksi berdasarkan ID
        $transaction = Transaction::findOrFail($id);

        // Memperbarui status transaksi
        $transaction->status = "cancel";
        $transaction->save();

        return redirect('/order');

    }

    public function markAsDelivered($id)
{
    $transaction = Transaction::find($id);

    if (!$transaction) {
        return response()->json(['message' => 'Transaksi tidak ditemukan!'], 404);
    }

    if ($transaction->status !== 'shipping') {
        return response()->json(['message' => 'Pesanan tidak dapat diperbarui!'], 400);
    }

    $transaction->status = 'delivered';
    $transaction->save();

    return response()->json(['message' => 'Pesanan berhasil diselesaikan!'], 200);
}

}
