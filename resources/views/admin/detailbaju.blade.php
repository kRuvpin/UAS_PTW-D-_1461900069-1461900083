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
                    <li><a href="/admin/laporan">Laporan</a></li>
                    <li><a href="/admin/user">User</a></li>
                </ul>
            </nav>
            <!-- Button Group -->
            <div class="amado-btn-group mt-30 mb-100">
                <a href="/logout" class="btn amado-btn active">Logout</a>
            </div>
            <!-- Cart Menu -->
            <div class="cart-fav-search mb-100">
                <a href="/costumer/search" class="search-nav"><img src="img/core-img/search.png" alt=""> Search</a>
            </div>
        </header>
        <!-- Header Area End -->

        <!-- Product Details Area Start -->
        <div class="single-product-area section-padding-100 clearfix">
            <div class="container-fluid">


                @foreach($baju as $bajus)
                <div class="row">
                    <div class="col-12 col-lg-7">
                        <div class="single_product_thumb">
                            <div id="product_details_slider" class="carousel slide" data-ride="carousel">
                                <li class="active" data-target="#product_details_slider" data-slide-to="0" style="background-image: url(/img/product-img/pro-big-1.jpg);">
                                </li>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <a class="gallery_img" href="img/product-img/pro-big-1.jpg">
                                            <img class="d-block w-100" src="{{ url('/baju/'.$bajus->gambar) }}" alt="First slide">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-5">
                        <div class="single_product_desc">
                            <!-- Product Meta Data -->
                            <div class="product-meta-data">
                                <div class="line"></div>
                                <p class="product-price">Rp{{$bajus->harga}}</p>
                                <a href="product-details.html">
                                    <h6>{{$bajus->nama}}</h6>
                                    <p>{{$bajus->kodebaju}}</p>
                                </a>
                                <!-- Avaiable -->
                                <p class="avaibility"><i class="fa fa-circle"></i> In Stock({{$bajus->stok}})</p>
                            </div>

                            <div class="short_overview my-5">
                                <p>{{$bajus->deskripsi}}</p>
                            </div>

                            <!-- Add to Cart Form -->
                            <input type="hidden" name="id" value="{{ $bajus->idbaju }}">
                            <input type="hidden" name="harga" value="{{ $bajus->harga }}">
                            <input type="hidden" name="kodebaju" value="{{ $bajus->kodebaju }}">
                            <a href="/admin/baju/edit/{{$bajus->idbaju}}" name="addtocart" value="5" class="btn amado-btn mb-15 info">Edit</a>
                            <a href="/admin/baju/hapus/{{$bajus->idbaju}}" name="addtocart" value="5" class="btn amado-btn mb-15">Hapus</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!-- Product Details Area End -->
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