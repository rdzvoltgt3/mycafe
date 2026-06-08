@include('customer.layouts.__header')

<body>

    <!-- Spinner Start -->
    <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50 d-flex align-items-center justify-content-center" style="z-index:9999;">
        <div style="text-align:center;">
            <div style="width:40px;height:40px;border:3px solid #ede8e0;border-top-color:#EF9F27;border-radius:50%;animation:spin 0.7s linear infinite;margin:0 auto 10px;"></div>
            <span style="font-family:'DM Sans',sans-serif;font-size:13px;color:#888;">Memuat...</span>
        </div>
    </div>
    <style>
        @keyframes spin { to { transform: rotate(360deg); } }
    </style>
    <!-- Spinner End -->

    <!-- Navbar -->
    @include('customer.layouts.__navbar')

    @yield('content')

    <!-- Footer -->
    @include('customer.layouts.__footer')

    <!-- Back to Top -->
    <a href="#" class="back-to-top" id="backToTop"><i class="fa fa-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/customer/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('assets/customer/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/customer/lib/lightbox/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('assets/customer/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/customer/js/main.js') }}"></script>

    <script>
        // Year
        document.getElementById('currentYear').textContent = new Date().getFullYear();

        // Spinner
        window.addEventListener('load', function () {
            const s = document.getElementById('spinner');
            if (s) { s.style.opacity = '0'; s.style.transition = 'opacity 0.3s'; setTimeout(() => s.remove(), 350); }
        });

        // Back to top
        const btt = document.getElementById('backToTop');
        window.addEventListener('scroll', function () {
            btt.style.opacity = window.scrollY > 300 ? '1' : '0';
        });
        btt.addEventListener('click', function(e) { e.preventDefault(); window.scrollTo({ top: 0, behavior: 'smooth' }); });
    </script>

    @yield('script')
</body>
</html>