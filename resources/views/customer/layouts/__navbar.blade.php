<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600&family=DM+Sans:wght@400;500;600&display=swap');

    /* ── Navbar wrapper ── */
    .cafe-navbar-wrap {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1050;
        background: rgba(26, 18, 7, 0.95);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        border-bottom: 1px solid rgba(250, 199, 117, 0.10);
        font-family: 'DM Sans', sans-serif;
    }

    /* Brand */
    .cafe-navbar-wrap .navbar-brand h1 {
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        font-weight: 600;
        color: #FAC775 !important;
        margin: 0;
        letter-spacing: -0.3px;
        line-height: 1;
    }
    .cafe-navbar-wrap .navbar-brand h1 span {
        color: rgba(250, 199, 117, 0.40);
    }

    /* Toggler */
    .cafe-navbar-wrap .navbar-toggler {
        border: 1.5px solid rgba(250, 199, 117, 0.30);
        border-radius: 8px;
        padding: 6px 10px;
        color: #FAC775;
    }
    .cafe-navbar-wrap .navbar-toggler:focus { box-shadow: none; }
    .cafe-navbar-wrap .navbar-toggler .fa-bars { color: #FAC775; }

    /* Collapse bg on mobile */
    .cafe-navbar-wrap .navbar-collapse {
        background: rgba(26, 18, 7, 0.98);
    }
    @media (min-width: 1200px) {
        .cafe-navbar-wrap .navbar-collapse {
            background: transparent;
        }
    }

    /* Nav links */
    .cafe-navbar-wrap .navbar-nav .nav-link {
        font-size: 13.5px;
        font-weight: 500;
        color: rgba(250, 199, 117, 0.55) !important;
        padding: 8px 14px;
        border-radius: 8px;
        transition: color 0.15s, background 0.15s;
        font-family: 'DM Sans', sans-serif;
    }
    .cafe-navbar-wrap .navbar-nav .nav-link:hover,
    .cafe-navbar-wrap .navbar-nav .nav-link.active {
        color: #FAC775 !important;
        background: rgba(250, 199, 117, 0.08);
    }

    /* Cart button */
    .btn-cafe-cart {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 20px;
        background: #EF9F27;
        color: #2d1f0a !important;
        border-radius: 99px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none !important;
        transition: background 0.15s ease;
        font-family: 'DM Sans', sans-serif;
        white-space: nowrap;
        border: none;
    }
    .btn-cafe-cart:hover { background: #FAC775; color: #2d1f0a !important; }
    .btn-cafe-cart i { font-size: 14px; }

    /* Mobile cart spacing */
    @media (max-width: 1199px) {
        .cafe-cart-wrap { padding: 0.75rem 0.5rem 1rem; }
    }

    /* Push page content below fixed navbar */
    body { padding-top: 64px !important; }
</style>

<div class="container-fluid cafe-navbar-wrap">
    <div class="container px-0">
        <nav class="navbar navbar-expand-xl py-0" style="min-height:64px;">

            {{-- Brand --}}
            <a href="#" class="navbar-brand py-0">
                <h1>MyCafe</h1>
            </a>

            {{-- Toggler --}}
            <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse"
                    aria-controls="navbarCollapse"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="fa fa-bars"></span>
            </button>

            {{-- Links --}}
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="/" class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">Menu</a>
                </div>

                {{-- Cart CTA --}}
                <div class="cafe-cart-wrap d-flex align-items-center ms-xl-3">
                    <a href="{{ route('cart') }}" class="btn-cafe-cart">
                        <i class="fa fa-shopping-bag"></i>
                        Keranjang
                    </a>
                </div>
            </div>

        </nav>
    </div>
</div>