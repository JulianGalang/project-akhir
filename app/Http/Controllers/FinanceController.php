<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Finance;
use App\Models\Transaction;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    $today = Carbon::today();
    // Ambil nomor halaman dari query parameter
    $fundPage = $request->query('fund_page', 1); // Default ke halaman 1 jika tidak ada parameter
    $outPage = $request->query('out_page', 1);

    $in = Transaction::whereIn('status', ['packing','shipping','delivered'])
    ->whereDate('created_at', $today);

    // Pagination untuk tipe 'fund'
    $fund = Finance::where('type', 'fund')
        ->whereDate('created_at', $today)
        ->paginate(5, ['*'], 'fund_page')
        ->withQueryString(); // Menjaga query parameter


    // Pagination untuk tipe 'out'
    $out = Finance::where('type', 'out')
    ->whereDate('created_at', $today)
        ->paginate(10, ['*'], 'out_page')
        ->withQueryString();

    $modal = Finance::where('type','fund')
    ->whereDate('created_at' , $today);
    $pengeluaran = Finance::where('type','out')
    ->whereDate('created_at' , $today);

    return view("finance.index",compact("out","fund","in","modal","pengeluaran",'fundPage', 'outPage'));
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
            "type"=> "required|string",
            "amount"=> "required|numeric",
            "description"=> "required|string",
        ]);
        // dd($request->all());
        Finance::create([
            'type' => $request->input('type'),
            'amount' => $request->input('amount'),
            'description' => $request->input('description'),
        ]);
        return redirect()->route('finance.index')->with('success','Success');
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
        Finance::destroy($id);
        return redirect()->route('finance.index')->with('success','Success');
    }
}
