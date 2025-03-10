<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\DetailTransaction;
use Illuminate\Support\Facades\Auth;

class DetailTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::all();
        return view("dashboard.transaction",compact("transactions"));
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
    public function show(DetailTransaction $detailTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetailTransaction $detailTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DetailTransaction $detailTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DetailTransaction $detailTransaction)
    {
        //
    }
}
