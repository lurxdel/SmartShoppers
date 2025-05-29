<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Products PDF</title>
    <link rel="stylesheet" href="{{ public_path('css/entities.css') }}">
</head>
<body>
    <div class="pdf-container">
        <h3>Customer Details</h3>
        <div class="profile">
        @php
            $avatarPath = Auth::user()->avatar 
                ? public_path('storage/' . Auth::user()->avatar)
                : public_path('images/default-avatar.png');
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
        <div>
            <h3>Product List</h3>
        </div>

        <table class="pdf-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $index => $product)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category }}</td>
                    <td>₱{{ number_format((float) $product->price, 2, '.', ',') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
