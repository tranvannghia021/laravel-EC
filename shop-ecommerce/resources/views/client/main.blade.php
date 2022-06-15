
<!DOCTYPE html>
<html lang="en">
<head>
	@include('client.head')
</head>
<body class=""><!--"animsition">  này loaad chậm-->
	
	<!-- Header -->
@include('client.header')

	<!-- Cart  sẽ include cart vào nếu tìm dc cách hiện popup tất cả trang-->

@include('client.cart')


	<!-- Product -->
@yield('content')
	

	<!-- Footer -->
@include('client.footer')
<div class="btn-back-to-top" id="myBtn">
    <span class="symbol-btn-back-to-top">
        <i class="zmdi zmdi-chevron-up"></i>
    </span>
</div>

<!-- Modal1 -->
<div class="wrap-modal1 js-modal1 p-t-60 p-b-20">

</body>
</html>