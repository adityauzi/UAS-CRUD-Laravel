<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // Menampilkan semua transaksi (LOAD)
   public function index()
{
    $transactions = Transaction::with('product.category')->get();
    $products = \App\Models\Product::with('category')->get();

    return view('transactions.index', compact('transactions', 'products'));
}


    // Form insert transaksi
    public function create()
    {
        $products = Product::with('category')->get();
        return view('transactions.create', compact('products'));
    }

    // Menyimpan transaksi (INSERT)
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->stock < $request->quantity) {
            return back()->with('error', 'Stok tidak cukup!');
        }

        $product->stock -= $request->quantity;
        $product->save();

        Transaction::create([
            'product_id' => $product->id,
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil disimpan.');
    }

    // Form edit transaksi (UPDATE)
   public function edit(Transaction $transaction)
{
    $products = Product::with('category')->get();
    $categories = Category::all();

    return view('transactions.edit', compact('transaction', 'products', 'categories'));
}

    public function update(Request $request, Transaction $transaction)
{
    $request->validate([
        'product_id' => 'required',
        'quantity' => 'required|integer|min:1',
        'category_id' => 'required'
    ]);

    $product = Product::findOrFail($request->product_id);
    $product->category_id = $request->category_id;
    $product->save();

    $transaction->update([
        'product_id' => $product->id,
        'quantity' => $request->quantity
    ]);

    return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil diupdate.');
}


    // Hapus transaksi (DELETE)
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return back()->with('success', 'Transaksi berhasil dihapus.');
    }
}
