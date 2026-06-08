<style>
    /* Reset override — pastikan footer tidak tersembunyi oleh main.js/style.css template lama */
    .cafe-footer,
    .cafe-footer * {
        visibility: visible !important;
    }
    .cafe-footer {
        display: block !important;
        background: var(--cafe-dark);
        border-top: 1px solid rgba(250,199,117,0.12);
        padding: 4rem 0 0;
        font-family: 'DM Sans', sans-serif;
        margin-top: 2rem;
        opacity: 1 !important;
        position: relative !important;
    }
    .cafe-footer-inner {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }
    .cafe-footer-top {
        padding-bottom: 2.5rem;
        border-bottom: 1px solid rgba(250,199,117,0.12);
        margin-bottom: 2.5rem;
    }
    .cafe-footer-brand {
        font-family: 'Playfair Display', serif;
        font-size: 1.6rem;
        font-weight: 600;
        color: var(--cafe-gold) !important;
        text-decoration: none !important;
        display: block;
        margin-bottom: 0.3rem;
    }
    .cafe-footer-brand span { color: rgba(250,199,117,0.38); }
    .cafe-footer-tagline {
        font-size: 13px;
        color: rgba(250,199,117,0.40);
        margin: 0;
        letter-spacing: 0.04em;
    }
    .cafe-footer-cols {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 2rem;
        padding-bottom: 2.5rem;
    }
    .cafe-footer-col h4 {
        font-size: 13px;
        font-weight: 600;
        color: var(--cafe-gold);
        letter-spacing: 0.1em;
        text-transform: uppercase;
        margin-bottom: 1rem;
    }
    .cafe-footer-col p,
    .cafe-footer-col address {
        font-size: 13.5px;
        color: rgba(250,199,117,0.45);
        line-height: 1.7;
        margin: 0;
        font-style: normal;
    }
    .cafe-footer-col a {
        display: block;
        font-size: 13.5px;
        color: rgba(250,199,117,0.45) !important;
        text-decoration: none !important;
        padding: 4px 0;
        transition: color 0.15s;
    }
    .cafe-footer-col a:hover { color: var(--cafe-gold) !important; }
    .cafe-pay-badge {
        display: inline-block !important;
        background: rgba(250,199,117,0.10);
        border: 1px solid rgba(250,199,117,0.18);
        color: var(--cafe-gold) !important;
        border-radius: 8px;
        padding: 6px 14px;
        font-size: 12.5px;
        font-weight: 500;
        margin: 0 6px 8px 0;
        text-decoration: none !important;
    }
    .cafe-pay-badge:hover { background: rgba(250,199,117,0.18); }
    .cafe-footer-bottom {
        border-top: 1px solid rgba(250,199,117,0.08);
        padding: 1.25rem 1.5rem;
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 0.5rem;
    }
    .cafe-footer-bottom span {
        font-size: 12.5px;
        color: rgba(250,199,117,0.35);
    }
    .cafe-footer-bottom a { color: rgba(250,199,117,0.50) !important; text-decoration: none !important; }
    .cafe-footer-bottom a:hover { color: var(--cafe-gold) !important; }

    /* Pastikan container-fluid Bootstrap tidak override background */
    footer.cafe-footer.container-fluid {
        background: var(--cafe-dark) !important;
    }
</style>

<footer class="cafe-footer">
    <div class="cafe-footer-inner">

        <!-- Brand -->
        <div class="cafe-footer-top">
            <a href="#" class="cafe-footer-brand">My<span>Cafe</span></a>
            <p class="cafe-footer-tagline">Ngafe di sini sambil belajar!</p>
        </div>

        <!-- Kolom -->
        <div class="cafe-footer-cols">
            <div class="cafe-footer-col">
                <h4>Tentang Kami</h4>
                <p>Tempat belajar yang nyaman dan menyenangkan. Nikmati menu terbaik kami sambil bersantai.</p>
            </div>

            <div class="cafe-footer-col">
                <h4>Hubungi Kami</h4>
                <address>
                    <p><i class="fa fa-map-marker-alt me-2" style="color:var(--cafe-amber);font-size:12px;"></i>Jl. Telekomunikasi No. 1, Terusan Buahbatu, Kabupaten Bandung 40257</p>
                    <p style="margin-top:8px;"><i class="fa fa-envelope me-2" style="color:var(--cafe-amber);font-size:12px;"></i>MyCafe@example.com</p>
                    <p style="margin-top:4px;"><i class="fa fa-phone me-2" style="color:var(--cafe-amber);font-size:12px;"></i>0823-4567-8901</p>
                </address>
            </div>

            <div class="cafe-footer-col">
                <h4>Metode Pembayaran</h4>
                <div>
                    <a href="#" class="cafe-pay-badge"><i class="fa fa-qrcode me-1"></i> Nontunai</a>
                    <a href="#" class="cafe-pay-badge"><i class="fa fa-money-bill me-1"></i> Tunai</a>
                </div>
            </div>
        </div>

    </div>

    <!-- Copyright -->
    <div class="cafe-footer-bottom">
        <span>
            <i class="fas fa-copyright me-1"></i>
            <a href="#">MyCafe</a>
            <span id="currentYear"></span>. All rights reserved.
        </span>
    </div>
</footer>

<script>
    /* Fallback: pastikan footer tetap visible setelah semua script selesai */
    document.addEventListener('DOMContentLoaded', function () {
        var footer = document.querySelector('.cafe-footer');
        if (footer) {
            footer.style.cssText += 'display:block!important;opacity:1!important;visibility:visible!important;';
        }
    });
</script>