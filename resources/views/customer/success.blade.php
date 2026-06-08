@extends('customer.layouts.master')

@section('title', 'Pesanan Berhasil')

@section('content')

<style>
    .success-wrap {
        min-height: calc(100vh - var(--cafe-navbar-h));
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 3rem 1rem;
        background: var(--cafe-bg);
    }

    .receipt-card {
        background: var(--cafe-surface);
        border: 1px solid var(--cafe-border);
        border-radius: 20px;
        width: 100%;
        max-width: 460px;
        overflow: hidden;
        box-shadow: 0 8px 40px rgba(26,18,7,0.07);
    }

    /* Top ribbon */
    .receipt-ribbon {
        background: linear-gradient(135deg, var(--cafe-dark) 0%, var(--cafe-dark-2) 100%);
        padding: 2rem 1.5rem 1.75rem;
        text-align: center;
        position: relative;
    }
    .receipt-ribbon::after {
        content: '';
        position: absolute;
        bottom: -1px; left: 0; right: 0;
        height: 20px;
        background: var(--cafe-surface);
        clip-path: ellipse(55% 100% at 50% 100%);
    }
    .receipt-check {
        width: 52px; height: 52px;
        background: var(--cafe-amber);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 0.75rem;
        font-size: 22px;
        color: var(--cafe-dark-2);
    }
    .receipt-ribbon h2 {
        font-family: 'Playfair Display', serif;
        font-size: 1.2rem;
        font-weight: 500;
        color: var(--cafe-gold);
        margin: 0 0 0.5rem;
    }

    /* Status badge */
    .status-badge {
        display: inline-block;
        font-size: 12px;
        font-weight: 600;
        padding: 5px 14px;
        border-radius: 99px;
    }
    .status-pending-cash { background: #fee2e2; color: #991b1b; }
    .status-pending-qris { background: #dcfce7; color: #166534; }
    .status-success      { background: #dcfce7; color: #166534; }

    /* Order code */
    .order-code-block {
        text-align: center;
        padding: 1.25rem 1.5rem 1rem;
        border-bottom: 1px dashed var(--cafe-border);
    }
    .order-code-label {
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--cafe-muted);
        display: block;
        margin-bottom: 6px;
    }
    .order-code-value {
        font-family: 'DM Sans', sans-serif;
        font-size: 1.7rem;
        font-weight: 700;
        color: var(--cafe-amber);
        letter-spacing: 0.06em;
    }

    /* Items list */
    .receipt-items {
        padding: 1rem 1.5rem;
        border-bottom: 1px dashed var(--cafe-border);
    }
    .receipt-item-row {
        display: flex;
        justify-content: space-between;
        align-items: baseline;
        font-size: 13.5px;
        padding: 5px 0;
        color: var(--cafe-text);
    }
    .receipt-item-row span:first-child { color: #555; }
    .receipt-item-row span:last-child { font-weight: 500; }

    /* Totals */
    .receipt-totals {
        padding: 1rem 1.5rem;
        border-bottom: 1px dashed var(--cafe-border);
    }
    .receipt-total-row {
        display: flex;
        justify-content: space-between;
        font-size: 13.5px;
        padding: 4px 0;
        color: var(--cafe-muted);
    }
    .receipt-total-row.grand {
        font-size: 15px;
        font-weight: 700;
        color: var(--cafe-text);
        padding-top: 10px;
        margin-top: 6px;
        border-top: 1px solid var(--cafe-border);
    }

    /* Footer note */
    .receipt-note {
        padding: 1rem 1.5rem;
        font-size: 12.5px;
        color: var(--cafe-muted);
        text-align: center;
        line-height: 1.6;
        border-bottom: 1px solid var(--cafe-border);
    }

    /* CTA */
    .receipt-cta {
        padding: 1.25rem 1.5rem;
    }
</style>

<div class="success-wrap">
    <div class="receipt-card">

        {{-- Ribbon --}}
        <div class="receipt-ribbon">
            <div class="receipt-check"><i class="fa fa-check"></i></div>
            <h2>Pesanan Berhasil Dibuat!</h2>
            @if ($order->payment_method == 'tunai' && $order->status == 'pending')
                <span class="status-badge status-pending-cash"><i class="fa fa-clock me-1"></i>Menunggu Pembayaran</span>
            @elseif ($order->payment_method == 'qris' && $order->status == 'pending')
                <span class="status-badge status-pending-qris"><i class="fa fa-clock me-1"></i>Menunggu Konfirmasi Pembayaran</span>
            @else
                <span class="status-badge status-success"><i class="fa fa-check-circle me-1"></i>Pembayaran Berhasil</span>
            @endif
        </div>

        {{-- Order Code --}}
        <div class="order-code-block">
            <span class="order-code-label">Kode Bayar</span>
            <div class="order-code-value">{{ $order->order_code }}</div>
        </div>

        {{-- Items --}}
        <div class="receipt-items">
            @foreach ($orderItems as $orderItem)
                <div class="receipt-item-row">
                    <span>{{ Str::limit($orderItem->item->name, 28) }} &times;{{ $orderItem->quantity }}</span>
                    <span>{{ 'Rp'. number_format($orderItem->price, 0, ',','.') }}</span>
                </div>
            @endforeach
        </div>

        {{-- Totals --}}
        <div class="receipt-totals">
            <div class="receipt-total-row">
                <span>Subtotal</span>
                <span>{{ 'Rp'. number_format($order->subtotal, 0, ',','.') }}</span>
            </div>
            <div class="receipt-total-row">
                <span>Pajak (10%)</span>
                <span>{{ 'Rp'. number_format($order->tax, 0, ',','.') }}</span>
            </div>
            <div class="receipt-total-row grand">
                <span>Total</span>
                <span>{{ 'Rp'. number_format($order->grand_total, 0, ',','.') }}</span>
            </div>
        </div>

        {{-- Note --}}
        <div class="receipt-note">
            @if ($order->payment_method == 'tunai')
                <i class="fa fa-info-circle me-1" style="color:var(--cafe-amber);"></i>
                Tunjukkan kode bayar ini ke kasir untuk menyelesaikan pembayaran. Terima kasih!
            @elseif ($order->payment_method == 'qris')
                <i class="fa fa-check-circle me-1" style="color:#16a34a;"></i>
                Pembayaran sukses. Duduk manis ya, pesanan kamu segera kami proses!
            @endif
        </div>

        {{-- CTA --}}
        <div class="receipt-cta">
            <a href="{{ route('menu') }}" class="btn-cafe-primary" style="width:100%;justify-content:center;padding:13px;">
                <i class="fa fa-utensils"></i> Kembali ke Menu
            </a>
        </div>

    </div>
</div>

@endsection