<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CrudUasLaravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f2f2f2;
            padding: 30px;
        }
        .form-panel {
            background: #5e6e7e;
            padding: 20px;
            border-radius: 10px;
            color: white;
        }
        .btn-insert {
            background: #28a745;
            color: white;
        }
        .btn-load {
            background: #dcdcdc;
            color: purple;
        }
        .btn-edit {
            background: #ffc107;
            color: white;
        }
        .btn-delete {
            background: #dc3545;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container bg-white p-4 rounded shadow">
        <div class="row">
            <!-- Tabel Transaksi -->
            <div class="col-md-7">
                <h4>Data Transaksi</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $tr)
                        <tr>
                            <td>{{ $tr->id }}</td>
                            <td>{{ $tr->product->name }}</td>
                            <td>{{ $tr->product->category->name }}</td>
                            <td>{{ $tr->quantity }}</td>
                            <td>
                                <form action="{{ route('transactions.destroy', $tr->id) }}" method="POST" style="display:inline-block;">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-delete btn-sm">Delete</button>
                                </form>
                                <a href="{{ route('transactions.edit', $tr->id) }}" class="btn btn-edit btn-sm">Update</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Form Transaksi -->
            <div class="col-md-5">
                <div class="form-panel">
                    <h5>Form Insert Transaksi</h5>
                    <form action="{{ route('transactions.store') }}" method="POST">
                        @csrf
                        <label>Nama Barang</label>
                        <select name="product_id" id="product_id" class="form-control" onchange="showInfo()" required>
                            <option value="">--Pilih--</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}"
                                    data-price="{{ $product->price }}"
                                    data-stock="{{ $product->stock }}"
                                    data-category="{{ $product->category->name }}">
                                    {{ $product->name }}
                                </option>
                            @endforeach
                        </select>

                        <label class="mt-2">Jumlah</label>
                        <input type="number" name="quantity" class="form-control" required>

                        <label class="mt-2">Harga</label>
                        <input type="text" id="price" class="form-control" disabled>

                        <label class="mt-2">Stock</label>
                        <input type="text" id="stock" class="form-control" disabled>

                        <label class="mt-2">Nama Kategori Barang</label>
                        <input type="text" id="category" class="form-control" disabled>

                        <button class="btn btn-insert mt-3" type="submit">Insert</button>
            <a href="{{ route('transactions.index') }}" class="btn btn-load mt-3">Load</a>
                    </form>
                </div>
            </div>
        </div>



    <script>
        function showInfo() {
            let select = document.getElementById('product_id');
            let selected = select.options[select.selectedIndex];
            document.getElementById('price').value = selected.getAttribute('data-price');
            document.getElementById('stock').value = selected.getAttribute('data-stock');
            document.getElementById('category').value = selected.getAttribute('data-category');
        }
    </script>
</body>
</html>
