<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Dashboard stats
        $stats = [
            'total_items'       => Item::count(),
            'low_stock_items'   => Item::whereColumn('quantity', '<=', 'min_stock_level')->count(),
            'total_transactions'=> Transaction::count(),
            'total_out'         => Transaction::where('type', 'OUT')->sum('quantity'),
            'total_in'          => Transaction::where('type', 'IN')->sum('quantity'),
        ];

        // Low stock items for bar chart
        $lowStockChart = Item::select('name', 'quantity', 'min_stock_level')
            ->whereColumn('quantity', '<=', 'min_stock_level')  // ✅
            ->orderBy('quantity', 'asc')
            ->take(5)
            ->get();
        
        // Prepare data for chart
        $chartLabels  = $lowStockChart->pluck('name');
        $chartQty     = $lowStockChart->pluck('quantity');
        $chartMinStock = $lowStockChart->pluck('min_stock_level');

        // Top issued items for pie chart
        $topIssuedItems = Transaction::select('item_id', DB::raw('SUM(quantity) as total_issued'))
            ->where('type', 'OUT')
            ->groupBy('item_id')
            ->orderBy('total_issued', 'desc')
            ->take(4)
            ->with('item:id,name')  // eager load only id and name
            ->get();

        // Prepare data for chart
        $pieChartLabels = $topIssuedItems->pluck('item.name');
        $pieChartData   = $topIssuedItems->pluck('total_issued');
        
        // Today's transactions
        $todayTransactions = Transaction::whereDate('created_at', now()->toDateString())->get();
        
        return view('dashboard.index', compact('stats', 'chartLabels', 'chartQty', 'chartMinStock', 'pieChartLabels', 'pieChartData', 'todayTransactions'));
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
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        //
    }
}
