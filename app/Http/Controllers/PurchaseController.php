<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class PurchaseController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::pluck('name', 'id');
        $customers = User::pluck('name', 'id');

        $search = $request->input('search');

        $query = Purchase::with(['product', 'customer']);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('product', function ($q1) use ($search) {
                    $q1->where('name', 'like', '%' . $search . '%');
                })->orWhereHas('customer', function ($q2) use ($search) {
                    $q2->where('name', 'like', '%' . $search . '%');
                });
            });
        }

        $purchases = $query->paginate(3)->withQueryString();

        return view('purchases.index', compact('purchases', 'products', 'customers', 'search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        $totalPrice = $product->price * $request->quantity;

        Purchase::create([
            'product_id'   => $request->product_id,
            'customer_id'  => auth()->id(),  
            'quantity'     => $request->quantity,
            'status'       => 'Pending',
            'user_id'      => auth()->id(), 
            'total_price'  => $totalPrice,
            'staff_id'     => null,          
        ]);

        return redirect()->route('customer.purchases')->with('success', 'Purchase submitted successfully.');
    }


    public function customerView()
    {
        $purchases = Purchase::with(['product'])
            ->where('customer_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(3);

        $products = Product::pluck('name', 'id');

        return view('purchases.customer', compact('purchases', 'products'));
    }

    public function generatePDF(Request $request)
    {
        $search = $request->input('search');

        $query = Purchase::with(['product', 'customer']);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('product', fn($q1) => $q1->where('name', 'like', '%' . $search . '%'))
                  ->orWhereHas('customer', fn($q2) => $q2->where('name', 'like', '%' . $search . '%'));
            });
        }

        $purchases = $query->latest()->get();

        $filters = ['search' => $search];

        $totalQuantity = $purchases->sum('quantity');

        $pdf = Pdf::loadView('purchases.pdf', compact('purchases', 'filters', 'totalQuantity'));

        return $pdf->stream('purchases.pdf');
    }

    public function staffView(Request $request)
    {
        $search = $request->input('search');

        $purchases = Purchase::with(['product', 'customer', 'staff'])
            ->when($search, function ($query, $search) {
                return $query->whereHas('customer', function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                })->orWhereHas('product', function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                });
            })
            ->orderByDesc('created_at')
            ->paginate(2);

        // This line fixes the error:
        $products = Product::pluck('name', 'id');

        return view('purchases.staff', compact('purchases', 'products'));
    }

    public function staffUpdate(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $purchase = Purchase::findOrFail($id);
        $purchase->status = $request->status;

        // ✅ Assign the currently logged-in staff user
        $purchase->staff_id = auth()->id();

        $purchase->save();

        return redirect()->back()->with('success', 'Purchase status updated successfully.');
    }

}
