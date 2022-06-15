{{-- dashboard --}}


<li class="nav-item">
    <a href="{{Route('admin.dashboard')}}" class="nav-link ">
        <i class="nav-icon fas fa-tachometer-alt"></i>
      <p>
        Tổng Quan
        {{-- <span class="badge badge-info right">2</span> --}}
      </p>
    </a>
</li>
{{-- danh mục --}}
<li class="nav-item nav-item-li" id="nav-item-group-products">
  <a href="#" class="nav-link ">
    <i class="nav-icon fas fa-tachometer-alt"></i>
  <p>
    Danh Mục Sản Phẩm
    {{-- <span class="badge badge-info right">2</span> --}}
  </p>
  <i class="fas fa-angle-left right"></i>
</a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{Route('admin.categories.list')}}" class="nav-link" id='group-products'>
        <i class="far fa-circle nav-icon"></i>
        <p>Danh Sách Danh Mục</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{Route('admin.categories.add')}}" class="nav-link" id='group-products' >
        <i class="far fa-circle nav-icon"></i>
        <p>Thêm Danh Mục</p>
      </a>
    </li>
  </ul>
</li>
{{-- QL-san pham --}}
<li class="nav-item nav-item-li " id="nav-item-products" >
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-tachometer-alt"></i>
    <p>
      Sản Phẩm
      {{-- <span class="badge badge-info right">2</span> --}}
    </p>
    <i class="fas fa-angle-left right"></i>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{Route('admin.products.list')}}" class="nav-link" id='products'>
        <i class="far fa-circle nav-icon"></i>
        <p>Danh Sách Sản Phẩm</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{Route('admin.product.add')}}" class="nav-link" id='products'>
        <i class="far fa-circle nav-icon"></i>
        <p>Thêm Sản Phẩm</p>
      </a>
    </li>
  </ul>
</li>
    
{{-- QL-mã giảm giá --}}
<li class="nav-item nav-item-li " id="nav-item-discounts">
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-tachometer-alt"></i>
    <p>
      Khuyến Mãi
      {{-- <span class="badge badge-info right">2</span> --}}
    </p>
    <i class="fas fa-angle-left right"></i>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{Route('admin.discounts.list')}}" class="nav-link" id="discounts">
        <i class="far fa-circle nav-icon"></i>
        <p>Danh Sách Mã Giảm Giá</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{Route('admin.discounts.add')}}" class="nav-link" id="discounts">
        <i class="far fa-circle nav-icon"></i>
        <p>Thêm Mã Giảm Giá</p>
      </a>
    </li>
  </ul>
</li>
{{-- QL-nhap hang--}}

<li class="nav-item nav-item-li " id="nav-item-imports" >
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-tachometer-alt"></i>
    <p>
      Nhập Hàng
     
    </p><i class="fas fa-angle-left right"></i>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{Route('admin.imports.list')}}" class="nav-link" id="imports">
        <i class="far fa-circle nav-icon"></i>
        <p>Hóa đơn Nhập hàng</p>
      </a>
    </li>
    <li class="nav-item ">
      <a href="{{Route('admin.imports.add')}}" class="nav-link" id="imports">
        <i class="far fa-circle nav-icon"></i>
        <p>Thêm Hóa đơn nhập hàng</p>
      </a>
    </li>
  </ul>
</li>

{{-- QL nhà cung cấp --}}

<li class="nav-item nav-item-li" id="nav-item-providers" >
  <a href="{{Route('admin.providers.list')}}" class="nav-link">
    <i class="nav-icon fas fa-tachometer-alt"></i>
    <p>
      Nhà cung cấp
  
    </p>
  </a>
</li>
{{-- QL đơn hàng --}}

   
<li class="nav-item nav-item-li" id="nav-item-orders">
  <a href="{{Route('admin.orders')}}" class="nav-link">
    <i class="nav-icon fas fa-tachometer-alt"></i>
    <p>
      Đơn Hàng
      <span class="badge badge-info right">{{count($notification_order)==0?"": count($notification_order) }}</span>
    </p>
  </a>
</li>

{{-- QL-nhan vien --}}
<li class="nav-item nav-item-li " id="nav-item-staffs" >
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-tachometer-alt"></i>
    <p>
      Nhân Viên
      {{-- <span class="badge badge-info right">2</span> --}}
    </p>
    <i class="fas fa-angle-left right"></i>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="/admin/staffs/list" class="nav-link" id='staffs'>
        <i class="far fa-circle nav-icon"></i>
        <p>Danh Sách Nhân Viên</p>
      </a>
    </li>
    <li class="nav-item ">
      <a href="/admin/staffs/add" class="nav-link" id='staffs'>
        <i class="far fa-circle nav-icon"></i>
        <p>Thêm Nhân Viên</p>
      </a>
    </li>
  </ul>
</li>
{{-- QL-khach hang --}}
<li class="nav-item nav-item-li " id="nav-item-customers" >
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-tachometer-alt"></i>
    <p>
      Khách Hàng
      {{-- <span class="badge badge-info right">2</span> --}}
    </p>
    <i class="fas fa-angle-left right"></i>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="/admin/customers/list" class="nav-link" id='customers'>
        <i class="far fa-circle nav-icon"></i>
        <p>Danh Sách Khách Hàng</p>
      </a>
    </li>
    <li class="nav-item ">
      <a href="/admin/customers/add" class="nav-link" id='customers'>
        <i class="far fa-circle nav-icon"></i>
        <p>Thêm Khách Hàng</p>
      </a>
    </li>
  </ul>
</li>

{{-- đánh giá --}}
<li class="nav-item nav-item-li" id="nav-item-ratings">
  <a href="{{Route('admin.ratings.list')}}" class="nav-link">
    <i class="nav-icon fas fa-tachometer-alt"></i>
    <p>
      Đánh giá
      
    </p>
  </a>
</li>
{{---Phân Quyền--}}
<li class="nav-item nav-item-li" id="nav-item-roles" >
  <a href="{{Route('admin.roles')}}" class="nav-link">
    <i class="nav-icon fas fa-tachometer-alt"></i>
    <p>
     Phân Quyền
  
    </p>
  </a>
</li>

{{-- Ql-silders --}}
<li class="nav-item nav-item-li " id="nav-item-sliders" >
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-tachometer-alt"></i>
    <p>
      Ảnh Trình Chiếu
      {{-- <span class="badge badge-info right">2</span> --}}
    </p>
    <i class="fas fa-angle-left right"></i>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{Route('admin.sliders.list')}}" class="nav-link" id='sliders'>
        <i class="far fa-circle nav-icon"></i>
        <p>Danh Sách Ảnh</p>
      </a>
    </li>
    <li class="nav-item ">
      <a href="{{Route('admin.sliders.add')}}" class="nav-link" id='sliders'>
        <i class="far fa-circle nav-icon"></i>
        <p>Thêm Ảnh</p>
      </a>
    </li>
  </ul>
</li>












<li class="nav-item">
 <a type="button" class="btn btn-danger center btn-logout-admin" href="{{route('logout.admin')}}">Đăng Xuất</a>
</li>