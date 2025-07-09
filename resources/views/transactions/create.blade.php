<h2>Form Transaksi</h2>

@if(session('error'))
    <p style="color: red;">{{ session('error') }}</p>
@endif

<form action="{{ route('transactions.store') }}" method="POST">
    @csrf

    <label>Pilih Barang:</label>
    <select name="product_id" id="product_id" onchange="showInfo()" required>
        <option value="">--Pilih--</option>
        @foreach($products as $product)
            <option value="{{ $product->id }}"
                data-price="{{ $product->price }}"
                data-stock="{{ $product->stock }}"
                data-category="{{ $product->category->name }}"
            >
                {{ $product->name }}
            </option>
        @endforeach
    </select>

    <br><br>

    <label>Harga:</label>
    <input type="text" id="price" disabled>

    <br><br>

    <label>Stok:</label>
    <input type="text" id="stock" disabled>

    <br><br>

    <label>Kategori:</label>
    <input type="text" id="category" disabled>

    <br><br>

    <label>Jumlah:</label>
    <input type="number" name="quantity" required>

    <br><br>

    <button type="submit">Insert</button>
</form>

<script>
    function showInfo() {
        let select = document.getElementById('product_id');
        let selected = select.options[select.selectedIndex];

        document.getElementById('price').value = selected.getAttribute('data-price');
        document.getElementById('stock').value = selected.getAttribute('data-stock');
        document.getElementById('category').value = selected.getAttribute('data-category');
    }
</script>
