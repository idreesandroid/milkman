<li class="submenu">
   <a href="javascript:void(0);"><i class="fa fa-tachometer" aria-hidden="true"></i> <span> Dashboard</span> <span class="menu-arrow"></span></a>
   <ul class="sub-menus">
      @can('Create-User')
      <li><a href="/register" class="active">Register</a></li>
      @endcan
      @can('See-User')
      <li><a href="/user/userList">All User</a></li>
      @endcan
   </ul>
</li>
@can('See-Role')
<li>
   <a href="/role/index"><i class="" aria-hidden="true"></i> <span>Role</span></a>
</li>
@endcan
@can('See-Permission')
<li>
   <a href="/permission/index"><i class="" aria-hidden="true"></i> <span>Permission</span></a>
</li>
@endcan
@can('See-Vendor')
<li>
   <a href="/vendor-detail/index"><i class="" aria-hidden="true"></i> <span>Vendors</span></a>   
</li>
@endcan
@can('See-Distributor')
<li>
   <a href="/distributor-detail/index"><i class="" aria-hidden="true"></i> <span>Distributor</span></a> 
</li>
@endcan
@can('See-Product')
<li>
   <a href="/product/index"><i class="" aria-hidden="true"></i> <span>Products</span></a>   
</li>
@endcan
@can('See-Product-Stock')
<li>
   <a href="/product-stock/index"><i class="" aria-hidden="true"></i> <span>Product Stock</span></a>   
</li>
@endcan
@can('See-Cart')
<li>
   <a href="#"><i class="fa fa-check-square-o" aria-hidden="true"></i> <span>Sale</span></a>
   <ul class="sub-menus">
      @can('Generate-Invoice')
      <li><a href="/Cart/create" class="active">New Invoice</a></li>
      @endcan
      <li><a href="/Cart/index" class="active">Sale Record </a></li>
      <li><a href="/Cart/reserveInvoice" class="active">Reserve Stock</a></li>
      <li><a href="/Cart/onHoldInvoice" class="active">On Hold Invoice</a></li>
   </ul>
</li>
@endcan
<li>
   <a href="{{url('/tasks/create')}}"><i class="" aria-hidden="true"></i> <span>Collection</span></a>   
</li>