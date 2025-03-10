<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller


{

    public function __construct() {
        \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds = config('services.midtrans.is3ds');
    }
    public function pay(Request $request, $transactionId)
{
    // Find the transaction by ID
    $transaction = Transaction::findOrFail($transactionId);

    // Define transaction details
    $transactionDetails = [
        'order_id' =>  $transaction->code,  // Order ID should be unique
        'gross_amount' => $transaction->total,     // Amount to be paid
    ];

    // Create the transaction
    $params = [
        'transaction_details' => $transactionDetails,
    ];

    try {
        $snapToken = Snap::getSnapToken($params);
        return response()->json([
            'snap_token' => $snapToken
        ]);
    } catch (\Exception $e) {
        // If an error occurs, return the error message
        return response()->json(['error' => $e->getMessage()]);
    }
}

public function getPaymentToken($code)
    {
        $transaction = Transaction::where('code', $code)->firstOrFail();
        $transactionDetails = [
            'order_id' =>  $transaction->code,
            'gross_amount' => $transaction->total,
        ];

        $params = [
            'transaction_details' => $transactionDetails,
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            return response()->json(['snap_token' => $snapToken]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal mendapatkan token pembayaran'], 500);
        }
    }

public function callback(Request $request)
{
    $data = $request->all();

    // Cek signature
    if ($this->verifySignature($data)) {
        $transactionId = $data['order_id'];
        $transaction = Transaction::findOrFail($transactionId);

        // Cek status pembayaran dari data callback
        if ($data['transaction_status'] == 'capture' && $data['payment_type'] == 'credit_card') {
            // Pembayaran sukses
            $transaction->status = 'success';
        } elseif ($data['transaction_status'] == 'settlement') {
            // Pembayaran sukses (settlement)
            $transaction->status = 'success';
        } elseif ($data['transaction_status'] == 'pending') {
            // Pembayaran tertunda
            $transaction->status = 'pending';
        } else {
            // Pembayaran gagal
            $transaction->status = 'failed';
        }

        $transaction->save();  // Simpan status transaksi yang baru



        return response()->json(['message' => 'Transaction status updated successfully.']);
    }

    return response()->json(['message' => 'Invalid signature'], 400);
}

// Fungsi untuk memverifikasi signature dari Midtrans
private function verifySignature($data)
{
    $serverKey = config('services.midtrans.serverKey');  // Ambil serverKey dari konfigurasi Midtrans
    $signatureKey = $data['signature_key'];  // Signature key yang diterima dari Midtrans

    // Membuat string yang berisi data yang digunakan untuk verifikasi
    $params = [
        'order_id' => $data['order_id'],
        'gross_amount' => $data['gross_amount']
    ];

    // Membuat signature menggunakan SHA-512 dan secret key
    $generatedSignature = hash('sha512', implode('', $params) . $serverKey);

    // Bandingkan signature yang diterima dengan yang dihasilkan
    if ($generatedSignature === $signatureKey) {
        return true;
    }

    // Jika signature tidak valid, log kesalahan
    Log::error('Invalid Midtrans signature', [
        'generated_signature' => $generatedSignature,
        'received_signature' => $signatureKey,
    ]);

    return false;
}
}
