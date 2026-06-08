@extends('customer.layouts.master')

@section('content')

{{-- ===================== INLINE STYLES ===================== --}}
<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600&family=DM+Sans:wght@400;500&display=swap');

    .menu-page {
        font-family: 'DM Sans', sans-serif;
        background: #f9f6f1;
        min-height: 100vh;
    }

    /* ── Hero ── */
    .menu-hero {
        background: linear-gradient(135deg, #1a1207 0%, #2d1f0a 60%, #3d2c10 100%);
        padding: 5.5rem 1.5rem 3rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .menu-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse at 50% 130%, rgba(239,159,39,0.20) 0%, transparent 65%);
        pointer-events: none;
    }
    .menu-hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(2rem, 5vw, 3rem);
        font-weight: 600;
        color: #FAC775;
        margin: 0 0 0.5rem;
        position: relative;
        letter-spacing: -0.5px;
    }
    .menu-hero p {
        color: rgba(250, 199, 117, 0.55);
        font-size: 0.82rem;
        margin: 0;
        position: relative;
        letter-spacing: 0.12em;
        text-transform: uppercase;
    }

    /* ── Filter Bar ── */
    .filter-bar {
        display: flex;
        gap: 8px;
        padding: 1.25rem 1.5rem;
        overflow-x: auto;
        scrollbar-width: none;
        background: #fff;
        border-bottom: 1px solid #ede8e0;
        position: sticky;
        top: 64px;
        z-index: 10;
    }
    .filter-bar::-webkit-scrollbar { display: none; }

    .filter-pill {
        flex-shrink: 0;
        padding: 6px 18px;
        border-radius: 99px;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        border: 1.5px solid #ddd;
        background: transparent;
        color: #888;
        transition: all 0.15s ease;
        font-family: 'DM Sans', sans-serif;
    }
    .filter-pill:hover,
    .filter-pill.active {
        background: #EF9F27;
        border-color: #EF9F27;
        color: #2d1f0a;
    }

    /* ── Grid ── */
    .menu-section {
        padding: 2rem 1.5rem 3rem;
        max-width: 1200px;
        margin: 0 auto;
    }
    .menu-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 20px;
    }

    /* ── Card ── */
    .menu-card {
        background: #fff;
        border: 1px solid #ede8e0;
        border-radius: 16px;
        overflow: hidden;
        transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
    }
    .menu-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(0,0,0,0.08);
        border-color: #d4c4a8;
    }

    .card-img-wrapper {
        width: 100%;
        aspect-ratio: 4 / 3;
        overflow: hidden;
        position: relative;
        background: #f3ede3;
    }
    .card-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.4s ease;
    }
    .menu-card:hover .card-img-wrapper img {
        transform: scale(1.04);
    }

    /* Category badge on image */
    .cat-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        font-size: 11px;
        font-weight: 500;
        padding: 4px 11px;
        border-radius: 99px;
        z-index: 1;
    }
    .cat-badge.makanan  { background: #FAEEDA; color: #633806; }
    .cat-badge.minuman  { background: #E1F5EE; color: #085041; }
    .cat-badge.other    { background: #E6F1FB; color: #0C447C; }

    /* Card body */
    .card-body {
        padding: 16px 18px 18px;
    }
    .card-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.05rem;
        font-weight: 500;
        color: #1a1207;
        margin: 0 0 6px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .card-desc {
        font-size: 13px;
        color: #888;
        line-height: 1.55;
        margin: 0 0 14px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .card-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }
    .item-price {
        font-size: 1rem;
        font-weight: 600;
        color: #1a1207;
        white-space: nowrap;
    }
    .btn-add-cart {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 15px;
        background: #EF9F27;
        color: #2d1f0a;
        border: none;
        border-radius: 99px;
        font-size: 12.5px;
        font-weight: 500;
        cursor: pointer;
        transition: background 0.15s ease, transform 0.1s ease;
        font-family: 'DM Sans', sans-serif;
        white-space: nowrap;
        text-decoration: none;
    }
    .btn-add-cart:hover  { background: #FAC775; color: #2d1f0a; }
    .btn-add-cart:active { transform: scale(0.96); }
    .btn-add-cart i      { font-size: 14px; }

    /* Empty state */
    .menu-empty {
        grid-column: 1 / -1;
        text-align: center;
        padding: 4rem 1rem;
        color: #aaa;
        font-size: 14px;
    }
</style>

{{-- ── Hero ── --}}
<div class="menu-hero">
    <h1>Menu Kami</h1>
    <p>Berbagai pilihan menu terbaik</p>
</div>

{{-- ── Filter Pills (purely visual, no JS required) ── --}}
<div class="filter-bar">
    <button class="filter-pill active" onclick="filterMenu(this,'all')">Semua</button>
    <button class="filter-pill" onclick="filterMenu(this,'Makanan')">Makanan</button>
    <button class="filter-pill" onclick="filterMenu(this,'Minuman')">Minuman</button>
    <button class="filter-pill" onclick="filterMenu(this,'Lainnya')">Lainnya</button>
</div>

{{-- ── Menu Grid ── --}}
<div class="menu-page">
    <div class="menu-section">
        <div class="menu-grid" id="menuGrid">

            @forelse ($items as $item)

                @php
                    $cat = $item->category->cat_name;
                    $badgeClass = match($cat) {
                        'Makanan' => 'makanan',
                        'Minuman' => 'minuman',
                        default   => 'other',
                    };
                @endphp

                <div class="menu-card" data-category="{{ $cat }}">

                    {{-- Image --}}
                    <div class="card-img-wrapper">
                        <img
                            src="{{ asset('img_item_upload/' . $item->img) }}"
                            alt="{{ $item->name }}"
                            onerror="this.onerror=null;this.src='{{ $item->img }}';"
                        >
                        <span class="cat-badge {{ $badgeClass }}">{{ $cat }}</span>
                    </div>

                    {{-- Body --}}
                    <div class="card-body">
                        <div class="card-title">{{ $item->name }}</div>
                        <p class="card-desc">{{ $item->description }}</p>
                        <div class="card-footer">
                            <span class="item-price">
                                {{ 'Rp' . number_format($item->price, 0, ',', '.') }}
                            </span>
                            {{-- onclick preserved exactly from original --}}
                            <a href="#" onclick="addToCart({{ $item->id }})" class="btn-add-cart">
                                <i class="fa fa-shopping-bag"></i> Tambah
                            </a>
                        </div>
                    </div>

                </div>

            @empty
                <div class="menu-empty">Belum ada menu tersedia.</div>
            @endforelse

        </div>
    </div>
</div>

@endsection


@section('script')
<script>
    {{-- ── Original addToCart function — NOT modified ── --}}
    function addToCart(menuId) {
        fetch("{{ route('cart.add') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ id: menuId })
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    }

    {{-- ── Filter pills (UI only, client-side) ── --}}
    function filterMenu(pill, category) {
        document.querySelectorAll('.filter-pill').forEach(p => p.classList.remove('active'));
        pill.classList.add('active');

        document.querySelectorAll('.menu-card').forEach(card => {
            const match = category === 'all' || card.dataset.category === category;
            card.style.display = match ? '' : 'none';
        });
    }
</script>
@endsection