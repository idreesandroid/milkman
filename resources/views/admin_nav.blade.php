<div class="sidebar" id="sidebar">
   <div class="sidebar-inner slimscroll">      
      <div id="sidebar-menu" class="sidebar-menu">
         <ul>
            <li>
               <a href="javascript:void(0);">
               		<i class="fa fa-tachometer" aria-hidden="true">               		
               		</i> <span> Dashboard </span>
               </a>
            </li>
            @can('See-User')           
            <li>
            	<a href="/user/userList" class="{{ (request()->segment(2) == 'userList') ? 'active' : '' }}">
            		<i class="fa fa-users" aria-hidden="true"></i>
            		<span> Users </span>
            	</a>
            </li>
            @endcan
            <li class="submenu">
               <a href="#">
                   <i class="fa fa-database" aria-hidden="true">                       
                   </i> <span> Collection </span> 
                   <span class="menu-arrow"></span>
                </a>
                <ul class="sub-menus">
                  <li><a href="/collections" class="{{ (request()->segment(1) == 'collections') ? 'active' : '' }}">Collection Areas</a></li>
                  <li><a href="/collections">Tasks</a></li>                  
                </ul>
            </li>
            @can('See-Product')
                <li class="submenu">
                    <a href="#">
                    <i class="fa fa-product-hunt" aria-hidden="true">                       
                    </i> <span> Product </span> 
                    <span class="menu-arrow"></span>
                    </a>
                    <ul class="sub-menus">
                    <li><a href="/product/index" class="{{ (request()->segment(1) == 'product') ? 'active' : '' }}">Product Listing</a></li>
                    @can('See-Product-Stock')
                        <li><a href="/product-stock/index" class="{{ (request()->segment(1) == 'product-stock') ? 'active' : '' }}">Product Stock</a></li>                  
                    @endcan
                    </ul>
                </li>
            @endcan
            @can('See-Cart')
                <li class="submenu">
                <a href="#">
                        <i class="fa fa-cart-plus" aria-hidden="true"></i>
                        <span> Sale </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="sub-menus">
                        <li><a href="/cart/index" class="{{ (request()->segment(1) == 'cart' && request()->segment(2) == 'index') ? 'active' : '' }}">Sale Record </a></li>
                        <li><a href="/cart/create" class="{{ (request()->segment(1) == 'cart' && request()->segment(2) == 'create') ? 'active' : '' }}">New Invoice</a></li>
                        <li><a href="/cart/reserveInvoice" class="{{ (request()->segment(2) == 'reserveInvoice') ? 'active' : '' }}">Reserve Stock</a></li>
                        <li><a href="/cart/onHoldInvoice" class="{{ (request()->segment(2) == 'onHoldInvoice') ? 'active' : '' }}">On Hold Invoice</a></li>
                    </ul>
                </li>
            @endcan            
            <li class="submenu">
               <a href="#">
                   <i class="fa fa-cog" aria-hidden="true">                       
                   </i> <span> Settings </span> 
                   <span class="menu-arrow"></span>
                </a>
                <ul class="sub-menus">
                    @can('See-Role')
                        <li><a href="/role/index" class="{{ (request()->segment(1) == 'role') ? 'active' : '' }}">Role Settings</a></li>
                    @endcan
                    @can('See-Permission')
                        <li><a href="/permission/index" class="{{ (request()->segment(1) == 'permission') ? 'active' : '' }}">Permissions Settings</a></li>                  
                    @endcan
                </ul>
            </li>
         </ul>
      </div>
   </div>
</div>



<!-- <li class="menu-title">
<span>Main</span>
</li> -->
<li class="submenu">
<a href="javascript:void(0);"><i class="fa fa-tachometer" aria-hidden="true"></i> <span> Dashboard</span> <span class="menu-arrow"></span></a>
<ul class="sub-menus">
@can('Register-User')
<li><a href="/register" class="active">Register</a></li>
@endcan
<!-- <li><a href="/profile">Profile</a></li> -->
@can('See-User')
<li><a href="/user/userList">All User</a></li>
@endcan
</ul>
</li>
<!-- ============================================================================ -->
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
<!-- <ul class="sub-menus">
<li><a href="/VendorDetail/create" class="active">Enter Vendor Detail</a></li>
<li><a href="/vendorLedger" class="active">Vendors Ledger</a></li>
</ul>-->
</li>
@endcan
@can('See-Distributor')
<li>
<a href="/distributor-detail/index"><i class="" aria-hidden="true"></i> <span>Distributor</span></a>
<!-- <ul class="sub-menus">
<li><a href="/VendorDetail/create" class="active">Enter Vendor Detail</a></li>
<li><a href="/vendorLedger" class="active">Vendors Ledger</a></li>
</ul>-->
</li>
@endcan
<!-- <li>
<a href="#"><i class="fa fa-check-square-o" aria-hidden="true"></i> <span>Tasks</span></a>
<ul class="sub-menus">
<li><a href="/set_task" class="active">Set Task</a></li>
<li><a href="/task_list" class="active">Tasks List</a></li>



</ul>
</li> -->
@can('See-Product')
<li>
<a href="/product/index"><i class="" aria-hidden="true"></i> <span>Products</span></a>
<!-- <ul class="sub-menus">
<li><a href="/Product/create" class="active">New Product</a></li>
<li><a href="/Product/index" class="active">Product List</a></li>

</ul> -->
</li>
@endcan
@can('See-Product-Stock')
<li>
<a href="/product-stock/index"><i class="" aria-hidden="true"></i> <span>Product Stock</span></a>
<!-- <ul class="sub-menus">
<li><a href="/ProductStock/create" class="active">New Stock</a></li>
<li><a href="/ProductStock/index" class="active">Stock List</a></li>

</ul> -->
</li>
@endcan
<!-- <li>
<a href="#"><i class="fa fa-check-square-o" aria-hidden="true"></i> <span>Routs</span></a>
<ul class="sub-menus">

<li><a href="/VendorRoute/create" class="active">New Rout</a></li>
<li><a href="/VendorRoute/index" class="active">Routs List</a></li>

</ul>
</li> -->
@can('See-Cart')
<li>
<a href="#"><i class="fa fa-check-square-o" aria-hidden="true"></i> <span>Sale</span></a>
<ul class="sub-menus">
@can('Generate-Invoice')
<li><a href="/cart/create" class="active">New Invoice</a></li>
@endcan
<li><a href="/cart/index" class="active">Sale Record </a></li>
<li><a href="/cart/reserveInvoice" class="active">Reserve Stock</a></li>
<li><a href="/cart/onHoldInvoice" class="active">On Hold Invoice</a></li>
</ul>
</li>
@endcan
<li><a href="/collection/create">Create Collection</a></li>
<!-- <li>
<a href="#"><i class="fa fa-check-square-o" aria-hidden="true"></i> <span>Payments</span></a>
<ul class="sub-menus">
<li><a href="/payment" class="active">Payment Entry</a></li>
</ul>
</li> -->
<!-- <li class="submenu">
<a href="javascript:void(0);"><i class="fa fa-retweet" aria-hidden="true"></i> <span>Multi Level</span> <span class="menu-arrow"></span></a>
<ul class="sub-menus">
<li class="submenu">
<a href="javascript:void(0);"> <span>Level 1</span> <span class="menu-arrow"></span></a>
<ul class="sub-menus">
<li><a href="javascript:void(0);"><span>Level 2</span></a></li>
<li class="submenu">
<a href="javascript:void(0);"> <span> Level 2</span> <span class="menu-arrow"></span></a>
<ul class="sub-menus">
<li><a href="javascript:void(0);">Level 3</a></li>
<li><a href="javascript:void(0);">Level 3</a></li>
</ul>
</li>
<li><a href="javascript:void(0);"> <span>Level 2</span></a></li>
</ul>
</li>
<li>
<a href="javascript:void(0);"> <span>Level 1</span></a>
</li>
</ul>
</li> -->
<!-- <script type="text/javascript">

 <script type="text/javascript">
r
$(document).ready(function() {
   $(".submenu").on('click', function(){
    $(".submenu").find('sub-menus').css({"display": "block"});       
   });
});

</script>

