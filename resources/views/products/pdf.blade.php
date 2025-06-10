<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Products PDF</title>
    <link rel="stylesheet" href="{{ public_path('css/entities.css') }}">
</head>
<body>
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