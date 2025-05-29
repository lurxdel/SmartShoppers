<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Purchases PDF</title>
    <link rel="stylesheet" href="{{ public_path('css/entities.css') }}">
</head>
<body>
    <div class="pdf-container">
        <h1>Purchases Records</h1>
        <p><b>Filtered by:</b>
            @if(!empty($filters['product_name']))
                Product: {{ $filters['product_name'] }}
            @endif
            @if(!empty($filters['customer_name']))
                @if(!empty($filters['product_name']))
                    , 
                @endif
                Customer: {{ $filters['customer_name'] }}
            @endif
            @if(empty($filters['product_name']) && empty($filters['customer_name']))
                None
            @endif
        </p>
        <table class="pdf-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Purchase Date</th>
                    <th>Staff</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($purchases as $index => $purchase)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $purchase->customer->name }}</td>
                    <td>{{ $purchase->product->name }}</td>
                    <td>{{ $purchase->quantity }}</td>
                    <td>{{ $purchase->created_at->format('Y-m-d') }}</td>
                    <td>
                        {{ $purchase->user->name ?? 'N/A' }}
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" style="text-align: right; font-weight: bold;">Total Quantity:</td>
                    <td colspan="3" style="text-align: left;">{{ $totalQuantity }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>
