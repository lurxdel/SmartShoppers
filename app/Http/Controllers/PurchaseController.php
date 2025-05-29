<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Purchase::with(['product', 'customer', 'user']);

        if ($request->filled('product_name')) {
            $query->whereHas('product', fn($q) => $q->where('name', 'like', '%' . $request->product_name . '%'));
        }

        if ($request->filled('customer_name')) {
            $query->whereHas('customer', fn($q) => $q->where('name', 'like', '%' . $request->customer_name . '%'));
        }

        $purchases = $query->latest()->paginate(3)->withQueryString();
        $totalQuantity = $query->sum('quantity');

        $products = Product::pluck('name', 'id');
        $customers = Customer::pluck('name', 'id');

        return view('purchases.index', compact('purchases', 'totalQuantity', 'products', 'customers'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Since creation is integrated into the index page, this method is no longer needed.
        // You can either remove this method or redirect to the index page.
        return redirect()->route('purchases.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'customer_id' => 'required|exists:customers,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $validated['user_id'] = auth()->id();

        Purchase::create($validated);

        return redirect()->route('purchases.index')->with('success', 'Purchase created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        return view('purchases.show', compact('purchase'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase)
    {
        $products = Product::pluck('name', 'id');
        $customers = Customer::pluck('name', 'id');

        return view('purchases.edit', compact('purchase', 'products', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purchase $purchase)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'customer_id' => 'required|exists:customers,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $purchase->update($validated);

        return redirect()->route('purchases.index')->with('success', 'Purchase updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        $purchase->delete();

        return redirect()->route('purchases.index')->with('success', 'Purchase deleted successfully.');
    }

    public function generatePDF(Request $request)
    {
        $query = Purchase::with(['product', 'customer']);
        
        if ($request->filled('product_name')) {
            $query->whereHas('product', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->product_name . '%');
            });
        }

        if ($request->filled('customer_name')) {
            $query->whereHas('customer', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->customer_name . '%');
            });
        }

        $purchases = $query->latest()->get();

        $filters = [
            'product_name' => $request->product_name,
            'customer_name' => $request->customer_name,
        ];

        $totalQuantity = $purchases->sum('quantity');

        $pdf = Pdf::loadView('purchases.pdf', compact('purchases', 'filters', 'totalQuantity'));

        return $pdf->stream('purchases.pdf');
    }
}
