<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
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
                    <li><a href="/admin/baju/add">Add Baju</a></li>
                    <li class="active"><a href="/admin/report">Laporan</a></li>
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

        <!-- Product Catagories Area Start -->
        <div class="cart-table-area section-padding-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-12">
                        <div class="cart-title mt-50">
                            <h2>Laporan</h2>
                            <form method="POST" action="/admin/laporan/bulan">
                                @csrf
                                <label style="color:white;font-size:100%">Bulan </label>
                                <select type="select" name="bulan">
                                    <option value="">-</option>
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                                <button type="submit" name="submit" class="btn">Tampilkan</button>
                            </form>
                        </div>
                        <div class="cart-table clearfix">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>User Id</th>
                                        <th>Kode Pembayaran</th>
                                        <th>Banyak</th>
                                        <th>Biaya</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @php $no=1; @endphp
                                        @foreach($transaksi as $transaksis)
                                        <td class="price">
                                            <span>{{$no++}}</span>
                                        </td>
                                        <td class="cart_product_desc">
                                            <span>{{$transaksis->userid}}</span>
                                        </td>
                                        <td class="price">
                                            <span>{{$transaksis->kodepembayaran}}</span>
                                        </td>
                                        <td class="price">
                                            <span>{{$transaksis->banyak}}</span>
                                        </td>
                                        <td class="price">
                                            <span>{{$transaksis->biaya}}</span>
                                        </td>
                                        <td class="price">
                                            <span>{{$transaksis->tanggal}}</span>
                                        </td>
                                        <td class="price">
                                            <span>{{$transaksis->status}}</span>
                                        </td>
                                        <td class="price">
                                            <a href="/admin/laporan/edit/{{$transaksis->kodepembayaran}}">
                                                <i class="zmdi zmdi-edit"></i>
                                            </a>
                                            <a href="/admin/laporan/delete/{{$transaksis->kodepembayaran}}">
                                                <i class="zmdi zmdi-delete"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @foreach($total as $transaksis)
                            Total Pendapatan: {{$transaksis->total}}
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Product Catagories Area End -->
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