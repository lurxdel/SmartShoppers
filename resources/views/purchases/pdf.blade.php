<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Purchases PDF</title>
    <link rel="stylesheet" href="{{ public_path('css/entities.css') }}">
</head>
<body>
    <div class="pdf-container">
        <h3>Employee Details</h3>
        <div class="profile">
        @php
            $avatarPath = Auth::user()->avatar 
                ? public_path('storage/' . Auth::user()->avatar)
                : public_path('images/default-avatar.jpg');
            $avatarData = base64_encode(file_get_contents($avatarPath));
            $avatarMime = mime_content_type($avatarPath);
            $avatarSrc = 'data:' . $avatarMime . ';base64,' . $avatarData;
        @endphp
        <img src="{{ $avatarSrc }}"
            alt="User Profile"
            style="width: 100px; height: 100px; border-radius: 50%; margin-right: 15px; border: 1px solid #ccc;">
            <div>
                <strong>{{ Auth::user()->name }}</strong><br>
                <small>{{ Auth::user()->email }}</small>
            </div>
        </div>
        <h3>Customer Purchase</h3>
        <p><b>Filtered by:</b> {{ $filters['search'] ?? 'None' }}</p>
        <table class="pdf-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Purchase Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($purchases as $index => $purchase)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $purchase->customer->name }}</td>
                    <td>{{ $purchase->product->name }}</td>
                    <td>{{ $purchase->quantity }}</td>
                    <td>₱{{ $purchase->total_price }}</td>
                    <td>{{ $purchase->created_at->format('Y-m-d') }}</td>
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