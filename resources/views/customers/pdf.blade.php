<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Customers PDF</title>
    <link rel="stylesheet" href="{{ public_path('css/entities.css') }}">
</head>
<body>
    <div class="pdf-container">
        <h1>Customers List</h1>
        <table class="pdf-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Gender</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $index => $customer)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->address }}</td>
                    <td>{{ $customer->gender }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
