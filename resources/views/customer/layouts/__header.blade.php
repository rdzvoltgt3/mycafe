<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>MyCafe</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Fonts: Playfair Display + DM Sans (tema konsisten) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Icon Font -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries -->
    <link href="{{ asset('assets/customer/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/customer/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="{{ asset('assets/customer/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template -->
    <link href="{{ asset('assets/customer/css/style.css') }}" rel="stylesheet">


    <!-- ===================== GLOBAL DESIGN TOKENS ===================== -->
    <style>
        :root {
            --cafe-dark:      #1a1207;
            --cafe-dark-2:    #2d1f0a;
            --cafe-dark-3:    #3d2c10;
            --cafe-gold:      #FAC775;
            --cafe-gold-dim:  rgba(250,199,117,0.55);
            --cafe-amber:     #EF9F27;
            --cafe-bg:        #f9f6f1;
            --cafe-surface:   #ffffff;
            --cafe-border:    #ede8e0;
            --cafe-text:      #1a1207;
            --cafe-muted:     #888;
            --cafe-radius:    16px;
            --cafe-navbar-h:  64px;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--cafe-bg);
            color: var(--cafe-text);
            padding-top: var(--cafe-navbar-h) !important;
            margin: 0;
        }

        /* ── Shared page-hero ── */
        .cafe-page-hero {
            background: linear-gradient(135deg, var(--cafe-dark) 0%, var(--cafe-dark-2) 60%, var(--cafe-dark-3) 100%);
            padding: 4rem 1.5rem 3rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .cafe-page-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at 50% 130%, rgba(239,159,39,0.18) 0%, transparent 65%);
            pointer-events: none;
        }
        .cafe-page-hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.8rem, 4vw, 2.6rem);
            font-weight: 600;
            color: var(--cafe-gold);
            margin: 0 0 0.4rem;
            position: relative;
        }
        .cafe-page-hero p {
            color: var(--cafe-gold-dim);
            font-size: 0.8rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            margin: 0;
            position: relative;
        }

        /* ── Shared section container ── */
        .cafe-section {
            padding: 2.5rem 1.5rem 4rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* ── Shared card ── */
        .cafe-card {
            background: var(--cafe-surface);
            border: 1px solid var(--cafe-border);
            border-radius: var(--cafe-radius);
        }

        /* ── Shared primary button ── */
        .btn-cafe-primary {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 10px 22px;
            background: var(--cafe-amber);
            color: var(--cafe-dark-2) !important;
            border: none;
            border-radius: 99px;
            font-size: 13.5px;
            font-weight: 600;
            text-decoration: none !important;
            cursor: pointer;
            transition: background 0.15s ease, transform 0.1s ease;
            font-family: 'DM Sans', sans-serif;
            white-space: nowrap;
        }
        .btn-cafe-primary:hover  { background: var(--cafe-gold); }
        .btn-cafe-primary:active { transform: scale(0.97); }

        /* ── Shared danger button ── */
        .btn-cafe-danger {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 20px;
            background: #fee2e2;
            color: #991b1b !important;
            border: 1px solid #fca5a5;
            border-radius: 99px;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none !important;
            cursor: pointer;
            transition: background 0.15s ease;
            font-family: 'DM Sans', sans-serif;
        }
        .btn-cafe-danger:hover { background: #fecaca; }

        /* ── Alert ── */
        .cafe-alert-success {
            background: #f0fdf4;
            border: 1px solid #86efac;
            color: #166534;
            border-radius: 12px;
            padding: 14px 18px;
            font-size: 14px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }
        .cafe-alert-success button {
            background: none;
            border: none;
            cursor: pointer;
            color: #166534;
            font-size: 16px;
            padding: 0;
            line-height: 1;
        }

        /* ── Back to top ── */
        .back-to-top {
            position: fixed;
            bottom: 24px;
            right: 24px;
            width: 42px;
            height: 42px;
            background: var(--cafe-amber) !important;
            border: none !important;
            border-radius: 50% !important;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--cafe-dark-2) !important;
            font-size: 15px;
            text-decoration: none;
            opacity: 0;
            transition: opacity 0.3s;
            z-index: 999;
        }
        .back-to-top:hover { background: var(--cafe-gold) !important; }
    </style>
</head>