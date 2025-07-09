<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h4>Edit Transaksi</h4>
    <form method="POST" action="{{ route('transactions.update', $transaction->id) }}">
        @csrf
        @method('PUT')

        <label>Nama Barang</label>
        <select name="product_id" class="form-control" required>
            @foreach($products as $product)
                <option value="{{ $product->id }}" {{ $transaction->product_id == $product->id ? 'selected' : '' }}>
                    {{ $product->name }}
                </option>
            @endforeach
        </select>

        <label class="mt-2">Jumlah</label>
        <input type="number" name="quantity" class="form-control" value="{{ $transaction->quantity }}" required>

        <label class="mt-2">Kategori Barang</label>
        <select name="category_id" class="form-control" required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $transaction->product->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <button class="btn btn-warning mt-3">Simpan Perubahan</button>
        <a href="{{ route('transactions.index') }}" class="btn btn-secondary mt-3">Batal</a>
    </form>
</div>
</body>
</html>
