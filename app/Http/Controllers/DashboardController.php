<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\DetailTransaction;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
        */

public function index()
{
    // Ambil transaksi berdasarkan hari ini
    $transactions = Transaction::whereDate('created_at', Carbon::today())
    ->whereIn('status', ['packing', 'shipping', 'delivered'])
    ->get();

    // Ambil transaksi yang terjadi pada hari ini

    // Hitung total quantity dari detail transaksi
    $totalItemsSold = $transactions->sum(function($transaction) {
        return $transaction->details->sum('quantity'); // jumlahkan semua quantity dari detail transaksi
    });

    // dd($totalItemsSold);
    // Ambil rentang tanggal awal dan akhir bulan ini
    $startOfMonth = Carbon::now()->startOfMonth()->toDateString();
    $endOfMonth = Carbon::now()->endOfMonth()->toDateString();
    $today = Carbon::today();

    // Total Pendapatan Bulan Ini
    $totalRevenue = DB::table('transactions')
        ->whereIn('status', ['packing', 'shipping', 'delivered'])
        ->whereBetween('updated_at', [$startOfMonth, $endOfMonth])
        ->sum('total');

    // Total Item Terjual Bulan Ini (Menggunakan `code` sebagai relasi)
    $totalSales = DB::table('detail_transactions')
        ->join('transactions', 'detail_transactions.code', '=', 'transactions.code')
        ->whereIn('status', ['packing', 'shipping', 'delivered'])
        ->whereBetween('transactions.updated_at', [$startOfMonth, $endOfMonth])
        ->sum('detail_transactions.quantity');

    // Data Pendapatan Harian dalam Bulan Ini
    $monthlyRevenue = DB::table('transactions')
        ->whereIn('status', ['packing', 'shipping', 'delivered'])
        ->whereBetween('updated_at', [$startOfMonth, $endOfMonth])
        ->selectRaw("DATE(updated_at) as date, SUM(total) as revenue")
        ->groupBy('date')
        ->pluck('revenue', 'date');

    // Data Penjualan Harian dalam Bulan Ini (Menggunakan `code` sebagai relasi)
    $monthlySales = DB::table('detail_transactions')
        ->join('transactions', 'detail_transactions.code', '=', 'transactions.code')
        ->whereIn('status', ['packing', 'shipping', 'delivered'])
        ->whereBetween('transactions.updated_at', [$startOfMonth, $endOfMonth])
        ->selectRaw("DATE(transactions.updated_at) as date, SUM(detail_transactions.quantity) as sales")
        ->groupBy('date')
        ->pluck('sales', 'date');

    // Debugging untuk melihat apakah data sudah benar
    // dd($totalRevenue, $totalSales, $monthlyRevenue, $monthlySales);

    return view('dashboard', compact('transactions','totalItemsSold','totalRevenue', 'totalSales', 'monthlyRevenue', 'monthlySales'));
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
        //
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
