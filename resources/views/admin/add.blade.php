<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>{{config('app.name')}}</title>

    <!-- Favicon  -->
    <link rel="icon" href="/assets/logo.png">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="/css/core-style.css">
    <link rel="stylesheet" href="/style.css">

</head>

<body>
    <!-- Search Wrapper Area Start -->
    <div class="search-wrapper section-padding-100">
        <div class="search-close">
            <i class="fa fa-close" aria-hidden="true"></i>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="search-content">
                        <form action="/admin/index/cari" method="get">
                            <input type="search" name="cari" id="search" placeholder="Type your keyword...">
                            <button type="submit"><img src="/img/core-img/search.png" alt=""></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Search Wrapper Area End -->

    <!-- ##### Main Content Wrapper Start ##### -->
    <div class="main-content-wrapper d-flex clearfix">

        <!-- Header Area Start -->
        <header class="header-area clearfix">
            <!-- Close Icon -->
            <div class="nav-close">
                <i class="fa fa-close" aria-hidden="true"></i>
            </div>
            <!-- Logo -->
            <div class="logo">

                <a href="index.html"><img src="/assets/logo.png" alt=""></a>
            </div>
            <!-- Amado Nav -->
            <nav class="amado-nav">
                <ul>
                    <li><a href="/admin/index">Home</a></li>
                    <li class="active"><a href="/admin/baju/add">Add Baju</a></li>
                    <li><a href="/admin/report">Laporan</a></li>
                    <li><a href="/admin/user">User</a></li>


                </ul>
            </nav>
            <!-- Button Group -->
            <div class="amado-btn-group mt-30 mb-100">
                <a href="/logout" class="btn amado-btn active">Logout</a>
            </div>
            <!-- Cart Menu -->
            <div class="cart-fav-search mb-100">
                <a href="/costumer/search" class="search-nav"><img src="/img/core-img/search.png" alt=""> Search</a>
            </div>
        </header>
        <!-- Header Area End -->

        <!-- ##### Main Content Wrapper Start ##### -->
        <div class="cart-table-area section-padding-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-20">
                        <div class="checkout_details_area mt-50 clearfix">
                            <div class="cart-title">
                                <h2>Add Baju</h2>
                            </div>
                            <form action="/admin/baju/add/proses" method="post" enctype="multipart/form-data">
                                {{csrf_field('')}}
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <input type="file" class="form-control" name="gambar" id="gambar" required>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input type="text" class="form-control" name="nama" id="nama" value="" placeholder="Nama baju">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input type="text" name="harga" class="form-control" id="harga" placeholder="harga" value="">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input type="text" name="stok" class="form-control mb-3" id="stok" placeholder="Stok" value="">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <textarea name="deskripsi" class="form-control w-100" id="deskripsi" cols="30" rows="10" placeholder="Deskripsi"></textarea>
                                    </div>
                                    <div class="cart-btn col-12 mb-3">
                                        <button type="submit" class="btn amado-btn">Add</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ##### Main Content Wrapper End ##### -->
    </div>
    <!-- ##### Main Content Wrapper End ##### -->

    <!-- ##### jQuery (Necessary for All JavaScript Plugins) ##### -->
    <script src="/js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="/js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="/js/bootstrap.min.js"></script>
    <!-- Plugins js -->
    <script src="/js/plugins.js"></script>
    <!-- Active js -->
    <script src="/js/active.js"></script>

</body>

</html>