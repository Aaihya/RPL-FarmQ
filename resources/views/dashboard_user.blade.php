<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FarmQ - Dashboard User</title>

    <!-- FONT AWESOME -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial, Helvetica, sans-serif;
        }

        body{
            background:#f4f6f9;
            display:flex;
        }

        /* SIDEBAR */
        .sidebar{
            width:260px;
            height:100vh;
            background:#16a34a;
            color:white;
            position:fixed;
            left:0;
            top:0;
            padding:30px 20px;
        }

        .logo{
            margin-bottom:40px;
        }

        .logo h1{
            font-size:42px;
            font-style:italic;
        }

        .logo p{
            font-size:13px;
            margin-top:5px;
            opacity:0.8;
        }

        .menu{
            margin-top:30px;
        }

        .menu a{
            display:flex;
            align-items:center;
            gap:15px;
            text-decoration:none;
            color:#fff;
            padding:16px;
            border-radius:14px;
            margin-bottom:10px;
            transition:0.3s;
            font-size:18px;
        }

        .menu a:hover,
        .menu .active{
            background:white;
            color:#16a34a;
            font-weight:bold;
        }

        .logout{
            position:absolute;
            bottom:30px;
            width:85%;
        }

        /* MAIN */
        .main{
            margin-left:260px;
            width:100%;
            padding:35px;
        }

        .topbar{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:30px;
        }

        .topbar h2{
            font-size:42px;
            color:#1e293b;
        }

        .topbar p{
            color:gray;
            margin-top:5px;
        }

        .profile{
            display:flex;
            align-items:center;
            gap:15px;
        }

        .profile img{
            width:60px;
            height:60px;
            border-radius:50%;
            object-fit:cover;
        }

        .profile h4{
            color:#1e293b;
        }

        .verified{
            color:#16a34a;
            font-size:13px;
            font-weight:bold;
        }

        /* SEARCH */
        .search-box{
            background:white;
            padding:20px;
            border-radius:20px;
            display:flex;
            gap:15px;
            margin-bottom:30px;
            box-shadow:0 3px 10px rgba(0,0,0,0.05);
        }

        .search-box input,
        .search-box select{
            padding:15px;
            border:1px solid #ddd;
            border-radius:12px;
            width:100%;
            font-size:15px;
        }

        .search-box button{
            background:#16a34a;
            color:white;
            border:none;
            padding:15px 30px;
            border-radius:12px;
            cursor:pointer;
            font-weight:bold;
        }

        /* CARD */
        .cards{
            display:grid;
            grid-template-columns:repeat(3,1fr);
            gap:20px;
            margin-bottom:40px;
        }

        .card{
            background:white;
            padding:30px;
            border-radius:20px;
            box-shadow:0 3px 10px rgba(0,0,0,0.05);
        }

        .card i{
            font-size:28px;
            margin-bottom:15px;
        }

        .card h3{
            color:#64748b;
            margin-bottom:10px;
        }

        .card h1{
            color:#0f172a;
            font-size:42px;
        }

        /* PRODUK */
        .produk-header{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:20px;
        }

        .produk-header h2{
            color:#1e293b;
        }

        .btn{
            background:#16a34a;
            color:white;
            text-decoration:none;
            padding:14px 24px;
            border-radius:12px;
            font-weight:bold;
        }

        .produk-grid{
            display:grid;
            grid-template-columns:repeat(3,1fr);
            gap:25px;
        }

        .produk{
            background:white;
            border-radius:20px;
            overflow:hidden;
            box-shadow:0 3px 10px rgba(0,0,0,0.05);
        }

        .produk img{
            width:100%;
            height:230px;
            object-fit:cover;
        }

        .produk-content{
            padding:20px;
        }

        .produk-content h3{
            margin-bottom:10px;
            color:#1e293b;
        }

        .produk-content p{
            color:#64748b;
            margin-bottom:8px;
        }

        .harga{
            color:#16a34a !important;
            font-size:24px;
            font-weight:bold;
            margin-top:15px;
        }

        .badge{
            background:#16a34a;
            color:white;
            padding:8px 14px;
            border-radius:10px;
            font-size:12px;
            position:absolute;
            margin:15px;
        }

        .img-box{
            position:relative;
        }

        @media(max-width:900px){

            .sidebar{
                display:none;
            }

            .main{
                margin-left:0;
            }

            .cards{
                grid-template-columns:1fr;
            }

            .produk-grid{
                grid-template-columns:1fr;
            }

            .search-box{
                flex-direction:column;
            }

            .topbar{
                flex-direction:column;
                align-items:flex-start;
                gap:20px;
            }
        }

    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <div class="sidebar">

        <div class="logo">
            <h1>FarmQ</h1>
            <p>USER PANEL</p>
        </div>

        <div class="menu">
            <a href="#" class="active">
                <i class="fa-solid fa-house"></i>
                Dashboard
            </a>

            <a href="#">
                <i class="fa-solid fa-cow"></i>
                Katalog Hewan
            </a>

            <a href="#">
                <i class="fa-solid fa-cart-shopping"></i>
                Keranjang
            </a>

            <a href="#">
                <i class="fa-solid fa-clock-rotate-left"></i>
                Riwayat Pesanan
            </a>

            <a href="#">
                <i class="fa-solid fa-user"></i>
                Profil Saya
            </a>
        </div>

        <div class="logout">
            <a href="#">
                <i class="fa-solid fa-right-from-bracket"></i>
                Keluar
            </a>
        </div>

    </div>

    <!-- MAIN -->
    <div class="main">

        <!-- TOPBAR -->
        <div class="topbar">

            <div>
                <h2>Halo, Gusti Putra 👋</h2>
                <p>Temukan hewan qurban terbaik untuk ibadah Anda.</p>
            </div>

            <div class="profile">
                <div>
                    <h4>GUSTI PUTRA</h4>
                    <p class="verified">PEMBELI AKTIF</p>
                </div>

                <img src="https://i.pravatar.cc/100" alt="">
            </div>

        </div>

        <!-- SEARCH -->
        <div class="search-box">

            <input type="text" placeholder="Cari hewan qurban...">

            <select>
                <option>Semua Jenis</option>
                <option>Sapi</option>
                <option>Kambing</option>
                <option>Domba</option>
            </select>

            <select>
                <option>Semua Harga</option>
                <option>1 Juta - 5 Juta</option>
                <option>5 Juta - 10 Juta</option>
                <option>10 Juta+</option>
            </select>

            <button>Filter</button>

        </div>

        <!-- CARD -->
        <div class="cards">

            <div class="card">
                <i class="fa-solid fa-cow"></i>
                <h3>Total Hewan</h3>
                <h1>24</h1>
            </div>

            <div class="card">
                <i class="fa-solid fa-cart-shopping"></i>
                <h3>Pesanan Saya</h3>
                <h1>5</h1>
            </div>

            <div class="card">
                <i class="fa-solid fa-wallet"></i>
                <h3>Total Pengeluaran</h3>
                <h1>Rp 25jt</h1>
            </div>

        </div>

        <!-- PRODUK -->
        <div class="produk-header">
            <h2>Katalog Hewan Qurban</h2>

            <a href="#" class="btn">
                Lihat Semua
            </a>
        </div>

        <div class="produk-grid">

            <!-- PRODUK 1 -->
            <div class="produk">

                <div class="img-box">
                    <span class="badge">TERSEDIA</span>

                    <img src="https://images.unsplash.com/photo-1516467508483-a7212febe31a?q=80&w=1200&auto=format&fit=crop" alt="">
                </div>

                <div class="produk-content">
                    <h3>Sapi Limosin Premium</h3>

                    <p>Berat : 500kg</p>
                    <p>Umur : 3 Tahun</p>
                    <p>Kesehatan : Sehat</p>

                    <p class="harga">Rp 28.000.000</p>
                </div>

            </div>

            <!-- PRODUK 2 -->
            <div class="produk">

                <div class="img-box">
                    <span class="badge">TERSEDIA</span>

                    <img src="https://images.unsplash.com/photo-1484557985045-edf25e08da73?q=80&w=1200&auto=format&fit=crop" alt="">
                </div>

                <div class="produk-content">
                    <h3>Kambing Etawa</h3>

                    <p>Berat : 45kg</p>
                    <p>Umur : 1.5 Tahun</p>
                    <p>Kesehatan : Sehat</p>

                    <p class="harga">Rp 4.500.000</p>
                </div>

            </div>

            <!-- PRODUK 3 -->
            <div class="produk">

                <div class="img-box">
                    <span class="badge">TERSEDIA</span>

                    <img src="https://images.unsplash.com/photo-1517849845537-4d257902454a?q=80&w=1200&auto=format&fit=crop" alt="">
                </div>

                <div class="produk-content">
                    <h3>Domba Garut</h3>

                    <p>Berat : 38kg</p>
                    <p>Umur : 1 Tahun</p>
                    <p>Kesehatan : Sehat</p>

                    <p class="harga">Rp 3.800.000</p>
                </div>

            </div>

        </div>

    </div>

</body>
</html>