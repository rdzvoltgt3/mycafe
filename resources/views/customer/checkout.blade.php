@extends('customer.layouts.master')

@section('content')

<style>
    /* ── Form fields ── */
    .cafe-label {
        display: block;
        font-size: 12.5px;
        font-weight: 600;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        color: var(--cafe-muted);
        margin-bottom: 6px;
    }
    .cafe-input {
        width: 100%;
        padding: 11px 14px;
        border: 1px solid var(--cafe-border);
        border-radius: 10px;
        font-size: 14px;
        font-family: 'DM Sans', sans-serif;
        color: var(--cafe-text);
        background: var(--cafe-surface);
        outline: none;
        transition: border-color 0.15s;
    }
    .cafe-input:focus { border-color: var(--cafe-amber); }
    .cafe-input:disabled { background: #f9f6f1; color: var(--cafe-muted); cursor: not-allowed; }
    .cafe-textarea {
        resize: vertical;
        min-height: 100px;
    }

    /* ── Order items mini-table ── */
    .order-mini-table { width: 100%; font-size: 13.5px; border-collapse: separate; border-spacing: 0; }
    .order-mini-table thead th {
        font-size: 11px; font-weight: 600; letter-spacing: 0.08em;
        text-transform: uppercase; color: var(--cafe-muted);
        padding: 0 12px 10px; border-bottom: 1px solid var(--cafe-border);
    }
    .order-mini-table tbody td {
        padding: 12px; border-bottom: 1px solid var(--cafe-border);
        vertical-align: middle; color: var(--cafe-text);
    }
    .order-mini-table tbody tr:last-child td { border-bottom: none; }
    .order-item-img {
        width: 52px; height: 52px; border-radius: 10px;
        object-fit: cover; border: 1px solid var(--cafe-border);
    }

    /* ── Summary card (reused) ── */
    .summary-card {
        background: var(--cafe-surface);
        border: 1px solid var(--cafe-border);
        border-radius: var(--cafe-radius);
        overflow: hidden;
        position: sticky;
        top: calc(var(--cafe-navbar-h) + 1rem);
    }
    .summary-header { padding: 20px 22px 16px; border-bottom: 1px solid var(--cafe-border); }
    .summary-header h2 { font-family: 'Playfair Display', serif; font-size: 1.2rem; font-weight: 500; margin: 0; }
    .summary-body { padding: 16px 22px; }
    .summary-row { display: flex; justify-content: space-between; font-size: 14px; padding: 8px 0; }
    .summary-row.muted { color: var(--cafe-muted); font-size: 13px; }
    .summary-row.total { font-size: 15px; font-weight: 700; padding-top: 14px; margin-top: 6px; border-top: 1px solid var(--cafe-border); }
    .summary-footer { padding: 16px 22px 20px; display: flex; flex-direction: column; gap: 10px; }

    /* ── Payment method ── */
    .pay-method-group { display: flex; flex-direction: column; gap: 8px; }
    .pay-method-label {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 13px 16px;
        border: 1.5px solid var(--cafe-border);
        border-radius: 12px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 500;
        color: var(--cafe-text);
        transition: border-color 0.15s, background 0.15s;
    }
    .pay-method-label:hover { border-color: var(--cafe-amber); background: #fefaf4; }
    .pay-method-label input[type="radio"] { accent-color: var(--cafe-amber); width: 16px; height: 16px; margin: 0; }
    .pay-method-label input[type="radio"]:checked + span { color: var(--cafe-dark); }
    .pay-method-label:has(input:checked) { border-color: var(--cafe-amber); background: #fefaf4; }
    .pay-icon { font-size: 18px; color: var(--cafe-amber); }

    /* ── Section heading ── */
    .section-heading {
        font-family: 'Playfair Display', serif;
        font-size: 1.2rem;
        font-weight: 500;
        color: var(--cafe-text);
        margin: 0 0 1.25rem;
    }
</style>

{{-- ── Hero ── --}}
<div class="cafe-page-hero">
    <h1>Checkout</h1>
    <p>Silakan isi detail pemesanan Anda</p>
</div>

{{-- ── Content ── --}}
<div class="cafe-section">
    <form id="checkout-form" action="{{ route('checkout.store') }}" method="POST">
        @csrf
        <div class="row g-4">

            {{-- ── Left: Customer info + order items ── --}}
            <div class="col-lg-7">

                {{-- Customer info --}}
                <div class="cafe-card" style="padding:24px;margin-bottom:20px;">
                    <h2 class="section-heading">Informasi Pemesan</h2>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="cafe-label">Nama Lengkap <sup style="color:#dc2626;">*</sup></label>
                            <input type="text" name="fullname" class="cafe-input" placeholder="Nama Anda" required>
                        </div>
                        <div class="col-md-4">
                            <label class="cafe-label">Nomor WhatsApp <sup style="color:#dc2626;">*</sup></label>
                            <input type="text" name="phone" class="cafe-input" placeholder="08xx-xxxx-xxxx" required>
                        </div>
                        <div class="col-md-4">
                            <label class="cafe-label">Nomor Meja</label>
                            <input type="text" class="cafe-input" value="{{ $tableNumber ?? 'Tidak ada nomor meja' }}" disabled>
                        </div>
                        <div class="col-12">
                            <label class="cafe-label">Catatan Pesanan <span style="font-weight:400;text-transform:none;letter-spacing:0;">(opsional)</span></label>
                            <textarea name="note" class="cafe-input cafe-textarea" placeholder="Contoh: kurang pedas, tanpa bawang..."></textarea>
                        </div>
                    </div>
                </div>

                {{-- Order items --}}
                <div class="cafe-card" style="overflow:hidden;">
                    <div style="padding:20px 22px 14px;border-bottom:1px solid var(--cafe-border);">
                        <h2 class="section-heading" style="margin:0;">Detail Pesanan</h2>
                    </div>
                    <div class="table-responsive">
                        <table class="order-mini-table">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $subTotal = 0; @endphp
                                @foreach (session('cart') as $item)
                                    @php
                                        $itemTotal = $item['price'] * $item['qty'];
                                        $subTotal += $itemTotal;
                                    @endphp
                                    <tr>
                                        <td>
                                            <div style="display:flex;align-items:center;gap:12px;">
                                                <img src="{{ asset('img_item_upload/'. $item['image']) }}"
                                                     class="order-item-img" alt="{{ $item['name'] }}"
                                                     onerror="this.onerror=null;this.src='{{ $item['image'] }}';">
                                                <span style="font-weight:500;font-size:14px;">{{ $item['name'] }}</span>
                                            </div>
                                        </td>
                                        <td>{{ 'Rp'. number_format($item['price'], 0, ',','.') }}</td>
                                        <td>{{ $item['qty'] }}</td>
                                        <td style="font-weight:600;">{{ 'Rp'. number_format($itemTotal, 0, ',','.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            {{-- ── Right: Summary + payment ── --}}
            @php
                $tax   = $subTotal * 0.1;
                $total = $subTotal + $tax;
            @endphp
            <div class="col-lg-5">
                <div class="summary-card">
                    <div class="summary-header">
                        <h2>Ringkasan Pembayaran</h2>
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

                    {{-- Payment method --}}
                    <div style="padding:0 22px 20px;">
                        <div style="font-size:12.5px;font-weight:600;letter-spacing:0.05em;text-transform:uppercase;color:var(--cafe-muted);margin-bottom:10px;">Metode Pembayaran</div>
                        <div class="pay-method-group">
                            <label class="pay-method-label">
                                <input type="radio" name="payment_method" value="qris">
                                <i class="fa fa-qrcode pay-icon"></i>
                                <span>Nontunai</span>
                            </label>
                            <label class="pay-method-label">
                                <input type="radio" name="payment_method" value="tunai">
                                <i class="fa fa-money-bill-wave pay-icon"></i>
                                <span>Tunai</span>
                            </label>
                        </div>
                    </div>

                    <div class="summary-footer" style="border-top:1px solid var(--cafe-border);padding-top:18px;">
                        <button type="button" id="pay-button" class="btn-cafe-primary" style="justify-content:center;padding:13px 22px;font-size:14px;">
                            <i class="fa fa-check-circle"></i> Konfirmasi Pesanan
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>

{{-- Midtrans + original JS — tidak diubah sama sekali --}}
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const payButton = document.getElementById("pay-button");
        const form = document.querySelector("form");

        payButton.addEventListener("click", function () {
            let paymentMethod = document.querySelector('input[name="payment_method"]:checked');
            if (!paymentMethod) {
                alert("Pilih Metode Pembayaran Terlebih Dahulu!");
                return;
            }
            paymentMethod = paymentMethod.value;
            let formData = new FormData(form);

            if (paymentMethod === "tunai") {
                form.submit();
            } else {
                fetch("{{ route('checkout.store') }}", {
                    method: "POST",
                    body: formData,
                    headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.snap_token) {
                        snap.pay(data.snap_token, {
                            onSuccess: function(result) { window.location.href = "/checkout/success/" + data.order_code; },
                            onPending: function(result) { alert("Menunggu Pembayaran"); },
                            onError:   function(result) { alert("Pembayaran Gagal"); }
                        });
                    } else {
                        alert("Terjadi kesalahan, silakan coba lagi.");
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("Terjadi kesalahan, silakan coba lagi ya.");
                });
            }
        });
    });
</script>

@endsection