@extends('customer.layouts.master')

@section('content')

<style>
    /* ── Cart table ── */
    .cart-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        font-size: 14px;
    }
    .cart-table thead th {
        font-size: 11.5px;
        font-weight: 600;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: var(--cafe-muted);
        padding: 0 16px 14px;
        border-bottom: 1px solid var(--cafe-border);
    }
    .cart-table tbody tr {
        transition: background 0.15s;
    }
    .cart-table tbody tr:hover td { background: #faf7f2; }
    .cart-table tbody td {
        padding: 16px;
        border-bottom: 1px solid var(--cafe-border);
        vertical-align: middle;
        color: var(--cafe-text);
    }
    .cart-item-img {
        width: 68px;
        height: 68px;
        border-radius: 12px;
        object-fit: cover;
        border: 1px solid var(--cafe-border);
    }
    .cart-item-name {
        font-weight: 500;
        font-size: 14.5px;
        color: var(--cafe-text);
    }
    .cart-price {
        font-weight: 500;
        color: var(--cafe-text);
        white-space: nowrap;
    }
    .cart-total-price {
        font-weight: 600;
        color: var(--cafe-dark-2);
        white-space: nowrap;
    }

    /* Qty control */
    .qty-ctrl {
        display: inline-flex;
        align-items: center;
        gap: 0;
        border: 1px solid var(--cafe-border);
        border-radius: 99px;
        overflow: hidden;
        background: #fff;
    }
    .qty-ctrl button {
        width: 32px;
        height: 32px;
        background: none;
        border: none;
        cursor: pointer;
        color: var(--cafe-muted);
        font-size: 11px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.12s, color 0.12s;
    }
    .qty-ctrl button:hover { background: #f9f6f1; color: var(--cafe-dark); }
    .qty-ctrl input {
        width: 38px;
        height: 32px;
        border: none;
        border-left: 1px solid var(--cafe-border);
        border-right: 1px solid var(--cafe-border);
        text-align: center;
        font-size: 13.5px;
        font-weight: 600;
        color: var(--cafe-text);
        background: transparent;
        outline: none;
        font-family: 'DM Sans', sans-serif;
    }

    /* Delete button */
    .btn-delete {
        width: 34px;
        height: 34px;
        background: #fee2e2;
        border: none;
        border-radius: 50%;
        color: #dc2626;
        font-size: 13px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.15s;
    }
    .btn-delete:hover { background: #fecaca; }

    /* Summary card */
    .summary-card {
        background: var(--cafe-surface);
        border: 1px solid var(--cafe-border);
        border-radius: var(--cafe-radius);
        overflow: hidden;
        position: sticky;
        top: calc(var(--cafe-navbar-h) + 1rem);
    }
    .summary-header {
        padding: 20px 22px 16px;
        border-bottom: 1px solid var(--cafe-border);
    }
    .summary-header h2 {
        font-family: 'Playfair Display', serif;
        font-size: 1.25rem;
        font-weight: 500;
        color: var(--cafe-text);
        margin: 0;
    }
    .summary-body { padding: 16px 22px; }
    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 14px;
        padding: 8px 0;
        color: var(--cafe-text);
    }
    .summary-row.muted { color: var(--cafe-muted); font-size: 13px; }
    .summary-row.total {
        font-size: 15px;
        font-weight: 700;
        padding-top: 14px;
        margin-top: 6px;
        border-top: 1px solid var(--cafe-border);
    }
    .summary-footer {
        padding: 16px 22px 20px;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    /* Empty state */
    .cart-empty {
        text-align: center;
        padding: 5rem 1rem;
        color: var(--cafe-muted);
    }
    .cart-empty i { font-size: 3rem; color: #ddd; display: block; margin-bottom: 1rem; }
    .cart-empty p { font-size: 15px; margin-bottom: 1.5rem; }
</style>

{{-- ── Hero ── --}}
<div class="cafe-page-hero">
    <h1>Keranjang</h1>
    <p>Silakan periksa pesanan Anda</p>
</div>

{{-- ── Content ── --}}
<div class="cafe-section">

    @if (session('success'))
        <div class="cafe-alert-success">
            <span><i class="fa fa-check-circle me-2"></i>{{ session('success') }}</span>
            <button onclick="this.parentElement.remove()" aria-label="Tutup">&times;</button>
        </div>
    @endif

    @if (empty($cart))
        <div class="cart-empty">
            <i class="fa fa-shopping-bag"></i>
            <p>Keranjang Anda masih kosong.</p>
            <a href="{{ route('menu') }}" class="btn-cafe-primary">
                <i class="fa fa-utensils"></i> Lihat Menu
            </a>
        </div>

    @else

        <div class="row g-4">

            {{-- ── Table ── --}}
            <div class="col-lg-8">
                <div class="cafe-card" style="overflow:hidden;">
                    <div class="table-responsive">
                        <table class="cart-table">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $subTotal = 0; @endphp
                                @foreach ($cart as $item)
                                    @php
                                        $itemTotal = $item['price'] * $item['qty'];
                                        $subTotal += $itemTotal;
                                    @endphp
                                    <tr>
                                        {{-- Image + Name --}}
                                        <td>
                                            <div style="display:flex;align-items:center;gap:14px;">
                                                <img src="{{ asset('img_item_upload/'. $item['image']) }}"
                                                     class="cart-item-img"
                                                     alt="{{ $item['name'] }}"
                                                     onerror="this.onerror=null;this.src='{{ $item['image'] }}';">
                                                <span class="cart-item-name">{{ $item['name'] }}</span>
                                            </div>
                                        </td>
                                        {{-- Price --}}
                                        <td><span class="cart-price">{{ 'Rp'. number_format($item['price'], 0, ',','.') }}</span></td>
                                        {{-- Qty --}}
                                        <td>
                                            <div class="qty-ctrl">
                                                <button onclick="updateQuantity('{{ $item['id'] }}', -1)" aria-label="Kurang"><i class="fa fa-minus"></i></button>
                                                <input id="qty-{{ $item['id'] }}" type="text" value="{{ $item['qty'] }}" readonly>
                                                <button onclick="updateQuantity('{{ $item['id'] }}', 1)" aria-label="Tambah"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </td>
                                        {{-- Total --}}
                                        <td><span class="cart-total-price">{{ 'Rp'. number_format($itemTotal, 0, ',','.') }}</span></td>
                                        {{-- Delete --}}
                                        <td>
                                            <button class="btn-delete"
                                                    onclick="if(confirm('Apakah anda yakin ingin menghapus item ini?')){ removeItemFromCart('{{ $item['id'] }}') }"
                                                    aria-label="Hapus">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- Clear cart --}}
                    <div style="padding:14px 20px;display:flex;justify-content:flex-end;border-top:1px solid var(--cafe-border);">
                        <a href="{{ route('cart.clear') }}"
                           class="btn-cafe-danger"
                           onclick="return confirm('Apakah Anda yakin ingin mengosongkan keranjang?')">
                            <i class="fa fa-trash-alt"></i> Kosongkan Keranjang
                        </a>
                    </div>
                </div>
            </div>

            {{-- ── Summary ── --}}
            @php
                $tax   = $subTotal * 0.1;
                $total = $subTotal + $tax;
            @endphp
            <div class="col-lg-4">
                <div class="summary-card">
                    <div class="summary-header">
                        <h2>Ringkasan Pesanan</h2>
                    </div>
                    <div class="summary-body">
                        <div class="summary-row muted">
                            <span>Subtotal</span>
                            <span>Rp{{ number_format($subTotal, 0, ',','.') }}</span>
                        </div>
                        <div class="summary-row muted">
                            <span>Pajak (10%)</span>
                            <span>Rp{{ number_format($tax, 0, ',','.') }}</span>
                        </div>
                        <div class="summary-row total">
                            <span>Total</span>
                            <span>Rp{{ number_format($total, 0, ',','.') }}</span>
                        </div>
                    </div>
                    <div class="summary-footer">
                        <a href="{{ route('checkout') }}" class="btn-cafe-primary" style="justify-content:center;">
                            <i class="fa fa-credit-card"></i> Lanjut ke Pembayaran
                        </a>
                        <a href="{{ route('menu') }}" style="text-align:center;font-size:13px;color:var(--cafe-muted);text-decoration:none;padding:4px 0;">
                            ← Kembali ke Menu
                        </a>
                    </div>
                </div>
            </div>

        </div>
    @endif
</div>

@endsection

@section('script')
<script>
    /* ── Original JS — tidak diubah ── */
    function updateQuantity(itemId, change) {
        var qtyInput = document.getElementById('qty-' + itemId);
        var currentQty = parseInt(qtyInput.value);
        var newQty = currentQty + change;
        if (newQty <= 0) {
            if (confirm('Apakah anda yakin ingin menghapus item ini?')) {
                removeItemFromCart(itemId);
            }
            return;
        }
        fetch("{{ route('cart.update') }}", {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify({ id: itemId, qty: newQty })
        })
        .then(r => r.json())
        .then(data => { if (data.success) { qtyInput.value = newQty; location.reload(); } else { alert(data.message); } })
        .catch(e => { console.error('Error:', e); alert('Terjadi kesalahan saat mengupdate keranjang'); });
    }

    function removeItemFromCart(itemId) {
        fetch("{{ route('cart.remove') }}", {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify({ id: itemId })
        })
        .then(r => r.json())
        .then(data => { if (data.success) { location.reload(); } else { alert(data.message); } })
        .catch(e => { console.error('Error:', e); alert('Terjadi kesalahan saat menghapus item dari keranjang'); });
    }
</script>
@endsection