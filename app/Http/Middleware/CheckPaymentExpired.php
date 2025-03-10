<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Transaction;

class CheckPaymentExpired
{
    public function handle(Request $request, Closure $next)
    {
        $transaction = Transaction::where('id', $request->route('id'))->first();

        if ($transaction && $transaction->status == 'pending') {
            $createdAt = Carbon::parse($transaction->created_at);
            if ($createdAt->diffInMinutes(now()) > 10) {
                $transaction->update(['status' => 'canceled']);
            }
        }

        return $next($request);
    }
}
