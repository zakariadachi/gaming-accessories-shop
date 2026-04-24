<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;

class AdminTransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user', 'commande')
            ->latest()
            ->paginate(15);

        return view('admin.transactions.index', compact('transactions'));
    }
}
