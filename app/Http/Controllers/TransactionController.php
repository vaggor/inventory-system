<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the transactions.
     */
    public function index()
    {
        $transactions = Transaction::with(['item', 'user'])->get();
        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new transaction.
     */
    public function create()
    {
        $items = Item::all();
        return view('transactions.create', compact('items'));
    }

    /**
     * Store a newly created transaction in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
            'type' => 'required|string|in:IN,OUT,ADJUSTMENT',
            'reason' => 'nullable|string'
        ]);

        $item = Item::find($validatedData['item_id']);

        if ($validatedData['type'] === 'OUT' && $item->quantity < $validatedData['quantity']) {
            return redirect()->back()->withInput()->with('error', 'Not enough stock available for this transaction.');
        }

        if ($validatedData['type'] === 'IN') {
            $item->quantity += $validatedData['quantity'];
        } elseif ($validatedData['type'] === 'OUT') {
            $item->quantity -= $validatedData['quantity'];
        }

        $item->save();
        
        $validatedData['user_id'] = auth()->id();
        $validatedData['reference_code'] = now()->timestamp . '-' . $validatedData['item_id'] . '-' . $validatedData['type'];
      
        if(!Transaction::create($validatedData)) {
            return redirect()->back()->withInput()->with('error', 'Failed to create transaction. Please try again.');
        }

        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully.');   
    }

    /**
     * Display the specified transaction.
     */
    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified transaction.
     */
    public function edit(Transaction $transaction)
    {
        
    }

    /**
     * Update the specified transaction in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        
    }

    /**
     * Remove the specified transaction from storage.
     */
    public function destroy(Transaction $transaction)
    {
       if ($transaction->delete()) {
            $item = $transaction->item;

            if ($transaction->type === 'IN') {
                $item->quantity -= $transaction->quantity;
            } elseif ($transaction->type === 'OUT') {
                $item->quantity += $transaction->quantity;
            }

            $item->save();
        } else {
            return redirect()->route('transactions.index')->with('error', 'Failed to delete transaction. Please try again.');
       }

        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }
}
