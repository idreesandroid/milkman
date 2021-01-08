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
           <!--  <li class="submenu">
               <a href="#">
               <i class="fa fa-database" aria-hidden="true">
               </i> <span> Collection </span>
               <span class="menu-arrow"></span>
               </a>
               <ul class="sub-menus">
                  <li><a href="/collections" class="{{ (request()->segment(1) == 'collections') ? 'active' : '' }}">Collection Areas</a></li>                  
               </ul>
            </li> -->
            <li>
               <a href="/collections" class="{{ (request()->segment(1) == 'collections') ? 'active' : '' }}">
               <i class="fa fa-database" aria-hidden="true"></i>
               <span>Collection Areas</span>
               </a>
            </li> 
            <li>
               <a href="/tasks" class="{{ (request()->segment(1) == 'tasks') ? 'active' : '' }}">
               <i class="fa fa-check-square-o" aria-hidden="true"></i>
               <span> Tasks </span>
               </a>
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

            @can('See-Transactions')
            <li class="submenu">
               <a href="#">
               <i class="fa fa-cart-plus" aria-hidden="true"></i>
               <span> Transactions </span>
               <span class="menu-arrow"></span>
               </a>
               <ul class="sub-menus">
                  @can('Make-Transaction')
                  <li><a href="/transaction/slip" class="{{ (request()->segment(1) == 'transaction' && request()->segment(2) == 'slip') ? 'active' : '' }}">New Transaction </a></li>
                  @endcan
                  @can('See-All-Transactions')
                  <li><a href="/transaction/List" class="{{ (request()->segment(1) == 'transaction' && request()->segment(2) == 'List') ? 'active' : '' }}">All Transactions </a></li>
                  @endcan

                  @can('See-Personal-Transaction')
                  <li><a href="/my/transactions" class="{{ (request()->segment(1) == 'my' && request()->segment(2) == 'transactions') ? 'active' : '' }}">My Transactions </a></li>
                  @endcan
                  <!-- <li><a href="/cart/create" class="{{ (request()->segment(1) == 'cart' && request()->segment(2) == 'create') ? 'active' : '' }}">empty</a></li>
                 
                  <li><a href="/cart/reserveInvoice" class="{{ (request()->segment(2) == 'reserveInvoice') ? 'active' : '' }}">empty</a></li>
                  <li><a href="/cart/onHoldInvoice" class="{{ (request()->segment(2) == 'onHoldInvoice') ? 'active' : '' }}">empty</a></li> -->
               </ul>
            </li>
            @endcan

            <li class="submenu">
               <a href="#">
               <i class="fa fa-cog fa-w-16 fa-spin fa-2x" aria-hidden="true">
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
<script type="text/javascript">
   $(document).ready(function() {
   $(".submenu").on('click', function(){
   $(".submenu").find('sub-menus').css({"display": "block"});
   });
   });
</script>