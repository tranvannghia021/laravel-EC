<header>
    <!-- Header desktop -->
    @php 
    $num_noti_cart=\App\Helpers\Helper::getNumberCart();
    @endphp
    <div class="container-menu-desktop">
     
        <div class="wrap-menu-desktop">
            <nav class="limiter-menu-desktop container">
                
                <!-- Logo desktop -->		
                <h4 href="/" class="logo">
                    TRESÓR
                </h4>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li class="title-menu-narbar ">
                         <a href="/" class="mtext-100 cl2 cl-w">TRANG CHỦ</a>
                           
                        </li>

                        <li class="title-menu-narbar">
                            <a href="{{Route('home.products')}}">CỬA HÀNG</a>
                           
                        </li>

                        <li class="title-menu-narbar">
                            <a href="{{Route('home.about')}}">VỀ CỬA HÀNG</a>
                        </li>

                        <li class="title-menu-narbar">
                            <a href="{{Route('home.contact')}}">LIÊN HỆ</a>
                        </li>
                    </ul>
                </div>	

                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m">
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                        <i class="zmdi zmdi-search"></i>
                    </div>

                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="{{$num_noti_cart}}">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>

                  
                        {!! \App\Helpers\Helper::renderUserLogin()!!}
                       
                  
                </div>
            </nav>
        </div>	
    </div>

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->		
        <div class="logo-mobile">
            <a href="index.html"><img src="images/icons/logo-01.png" alt="IMG-LOGO"></a>
        </div>

        <!-- Icon header -->
        <div class="wrap-icon-header flex-w flex-r-m m-r-15">
            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                <i class="zmdi zmdi-search"></i>
            </div>

            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="2">
                <i class="zmdi zmdi-shopping-cart"></i>
            </div>

            <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti" data-notify="0">
                <i class="zmdi zmdi-favorite-outline"></i>
            </a>
        </div>

        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </div>
    </div>


    <!-- Menu Mobile -->
    <div class="menu-mobile">
              <ul class="main-menu-m">
            <li>
                <a href="{{Route('home.products')}}">Cửa Hàng</a>
                <ul class="sub-menu-m">
                    {!! \App\Helpers\Helper::renderGroupProducts($group_products )!!}
                </ul>
               
                <span class="arrow-main-menu-m">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </span>
            </li>
         

            <li>
                <a href="{{Route('home.contact')}}">Liên Hệ</a>
            </li>
        </ul>
    </div>

    <!-- Modal Search -->
    <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
        <div class="container-search-header">
            <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                <img src="{{asset('/template/images/icons/icon-close2.png')}}" alt="CLOSE">
            </button>

            <form class="wrap-search-header flex-w p-l-15">
                <button class="flex-c-m trans-04">
                    <i class="zmdi zmdi-search"></i>
                </button>
                <input class="plh3" type="text" name="search" placeholder="Tìm Sản Phẩm">
            </form>
        </div>
    </div>
</header>