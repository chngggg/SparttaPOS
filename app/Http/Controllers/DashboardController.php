<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sparepart;
use App\Models\Transaction;
use App\Models\User;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $totalSparepart = Sparepart::count();
        $lowStockItems = Sparepart::whereColumn('stock', '<=', 'min_stock')->count();
        $todaySales = Transaction::whereDate('created_at', today())->sum('total');
        $todayTransactions = Transaction::whereDate('created_at', today())->count();

        $recentTransactions = Transaction::with('user')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($transaction) {
                return [
                    'invoice' => $transaction->invoice_number,
                    'customer' => $transaction->customer_name ?? 'Umum',
                    'date' => $transaction->created_at,
                    'total' => $transaction->total,
                    'status' => $transaction->status,
                    'kasir' => $transaction->user->name ?? 'Admin'
                ];
            });

        $lowStockSpareparts = Sparepart::with('category')
            ->whereColumn('stock', '<=', 'min_stock')
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'totalSparepart',
            'lowStockItems',
            'todaySales',
            'todayTransactions',
            'recentTransactions',
            'lowStockSpareparts'
        ));
    }
}
