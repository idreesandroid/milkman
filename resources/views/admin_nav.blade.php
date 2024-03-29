<div class="sidebar" id="sidebar">
   <div class="sidebar-inner slimscroll">
      <div id="sidebar-menu" class="sidebar-menu">
         <ul>
            <li>
               <a href="{{ url('DashBoard') }}">
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
            @can('See-Collection-Area')
            <li>
               <a href="/collections" class="{{ (request()->segment(1) == 'collections') ? 'active' : '' }}">
               <i class="fa fa-database" aria-hidden="true"></i>
               <span>Collection Areas</span>
               </a>
            </li> 
            @endcan 

            <!-- @can('See-Task-List')
            <li>
               <a href="/task/area" class="{{ (request()->segment(1) == 'task' && request()->segment(2) == 'area') ? 'active' : '' }}">
               <i class="fa fa-map-marker" aria-hidden="true"></i>
               <span>Assigned Areas</span>
               </a>
            </li>  
            @endcan -->
            
            @can('See-Collection-Point')
            <li>
               <a href="/collectionPoint/index" class="{{ (request()->segment(1) == 'collectionPoint' && request()->segment(2) == 'index') ? 'active' : '' }}">
               <i class="fa fa-check-square-o" aria-hidden="true"></i>
               <span>Collection Points</span>
               </a>
            </li>  
            @endcan

         <!-- change permission -->
            @can('See-Milk-Bank')
            <li>
               <a href="/milkBank/index" class="{{ (request()->segment(1) == 'milkBank' && request()->segment(2) == 'index') ? 'active' : '' }}">
               <i class="fa fa-check-square-o" aria-hidden="true"></i>
               <span>Milk Bank</span>
               </a>
            </li>  
            @endcan

            @can('Collect-Milk-From-Collection-Point')
            <li>
               <a href="/milk-point/submission" class="{{ (request()->segment(1) == 'milk-point' && request()->segment(2) == 'submission') ? 'active' : '' }}">
               <i class="fa fa-check-square-o" aria-hidden="true"></i>
               <span>Milk Bank Collection</span>
               </a>
            </li> 
            @endcan 

            @can('See-Specific-Bank-Milk-Request')
            <li>
               <a href="/milk-process/request-index" class="{{ (request()->segment(1) == 'milk-process' && request()->segment(2) == 'request-index') ? 'active' : '' }}">
               <i class="fa fa-check-square-o" aria-hidden="true"></i>
               <span>My Milk Request</span>
               </a>
            </li> 
            @endcan 

            @can('See-All-Milk-Request')
            <li>
               <a href="/milk/request-list" class="{{ (request()->segment(1) == 'milk' && request()->segment(2) == 'request-list') ? 'active' : '' }}">
               <i class="fa fa-check-square-o" aria-hidden="true"></i>
               <span>Milk Request List</span>
               </a>
            </li> 
            @endcan 

            @can('Generate-Milk-Request')
            <li>
               <a href="/milk-process/request-create" class="{{ (request()->segment(1) == 'milk-process' && request()->segment(2) == 'request-create') ? 'active' : '' }}">
               <i class="fa fa-check-square-o" aria-hidden="true"></i>
               <span>Request Milk</span>
               </a>
            </li> 
            @endcan 

            @can('Generate-Task')
            <li>
               <a href="/generate/task" class="{{ (request()->segment(1) == 'generate' && request()->segment(2) == 'task') ? 'active' : '' }}">
               <i class="fa fa-check-square-o" aria-hidden="true"></i>
               <span>Generate Task</span>
               </a>
            </li>  
            @endcan 

            @can('Generate-Task')
            <li>
               <a href="/collectionPoint/collectors" class="{{ (request()->segment(1) == 'collectionPoint' && request()->segment(2) == 'collectors') ? 'active' : '' }}">
               <i class="fa fa-check-square-o" aria-hidden="true"></i>
               <span>Collectors</span>
               </a>
            </li>  
            @endcan 

            @can('Generate-Task')
            <li>
               <a href="/collectionPoint/area" class="{{ (request()->segment(1) == 'collectionPoint' && request()->segment(2) == 'area') ? 'active' : '' }}">
               <i class="fa fa-check-square-o" aria-hidden="true"></i>
               <span>Areas</span>
               </a>
            </li>  
            @endcan 

<!-- Specific to collection Point ----------------------------------->
            @can('My-Point-Collection')
            <li>
               <a href="{{route('point-base.Collections', checkpoint())}}" class="{{ (request()->segment(1) == 'point' && request()->segment(2) == 'base-collection') ? 'active' : '' }}">
               <i class="fa fa-check-square-o" aria-hidden="true"></i>
               <span>Point Collection</span>
               </a>
            </li>  
           @endcan 

           @can('My-Point-Collection')
            <li>
               <a href="{{route('point-base.Submission', checkpoint())}}" class="{{ (request()->segment(1) == 'point' && request()->segment(2) == 'base-submission') ? 'active' : '' }}">
               <i class="fa fa-check-square-o" aria-hidden="true"></i>
               <span>Point Submission</span>
               </a>
            </li>  
           @endcan

            @can('Generate-Task')
            <li>
               <a href="/milk/submission" class="{{ (request()->segment(1) == 'milk' && request()->segment(2) == 'submission') ? 'active' : '' }}">
               <i class="fa fa-check-square-o" aria-hidden="true"></i>
               <span>Collect Milk</span>
               </a>
            </li>  
            @endcan 

            @can('See-My-Task')
            <li>
               <a href="/collector-detail/tasks" class="{{ (request()->segment(1) == 'collector-detail' && request()->segment(2) == 'tasks') ? 'active' : '' }}">
               <i class="fa fa-check-square-o" aria-hidden="true"></i>
               <span>My Task</span>
               </a>
            </li>  
            @endcan

            @can('See-Product')
            <li class="submenu">
               <a href="#">
               <i class="fa fa-product-hunt" aria-hidden="true">
               </i> <span> Product </span>
               <span class="menu-arrow"></span>
               </a>
               <ul class="sub-menus">
                  <li><a href="/product/index" class="{{ (request()->segment(1) == 'product' && request()->segment(2) == 'index') ? 'active' : '' }}">Product Listing</a></li>
                  @can('See-Product-Stock')
                  <li><a href="/product-stock/index" class="{{ (request()->segment(1) == 'product-stock' && request()->segment(2) == 'index') ? 'active' : '' }}">Product Stock</a></li>
                  @endcan
                  <li><a href="/product/analysis" class="{{ (request()->segment(1) == 'product' && request()->segment(2) == 'analysis') ? 'active' : '' }}">Product Analysis</a></li>
               </ul>
            </li>
            @endcan 

             @can('See-Cart')
            <li>
               <a href="/cart/index" class="{{ (request()->segment(1) == 'cart') ? 'active' : '' }}">
                  <i class="fa fa-cart-plus" aria-hidden="true"></i>
                  <span>Sale Record</span>
               </a>
            </li> 
            @endcan

            @can('See-My-Orders')
            <li>
               <a href="/order/myList" class="{{ (request()->segment(1) == 'order' && request()->segment(2) == 'myList') ? 'active' : '' }}">
                  <i class="fa fa-list" aria-hidden="true"></i>
                  <span>My Orders</span>
               </a>
            </li> 
            @endcan

            @can('See-Transactions')
            <li class="submenu">
               <a href="#">
               <i class="fa fa-credit-card-alt" aria-hidden="true"></i>
               <span> Transactions </span>
               <span class="menu-arrow"></span>
               </a>
               <ul class="sub-menus">
                  @can('Make-Transaction')
                  <li>
                     <a href="/transaction/slip" class="{{ (request()->segment(1) == 'transaction' && request()->segment(2) == 'slip') ? 'active' : '' }}">New Transaction </a>
                  </li>
                  @endcan
                  @can('See-All-Transactions')
                  <li>
                     <a href="/transaction/List" class="{{ (request()->segment(1) == 'transaction' && request()->segment(2) == 'List') ? 'active' : '' }}">All Transactions </a>
                  </li>
                  @endcan

                  @can('See-Personal-Transaction')
                  <li>
                     <a href="/my/transactions" class="{{ (request()->segment(1) == 'my' && request()->segment(2) == 'transactions') ? 'active' : '' }}">My Transactions </a>
                  </li>
                  @endcan
                  <!-- <li><a href="/cart/create" class="{{ (request()->segment(1) == 'cart' && request()->segment(2) == 'create') ? 'active' : '' }}">empty</a></li>
                 
                  <li><a href="/cart/reserveInvoice" class="{{ (request()->segment(2) == 'reserveInvoice') ? 'active' : '' }}">empty</a></li>
                  <li><a href="/cart/onHoldInvoice" class="{{ (request()->segment(2) == 'onHoldInvoice') ? 'active' : '' }}">empty</a></li> -->
               </ul>
            </li>
            @endcan

            @can('See-Asset')
            <li class="submenu">
               <a href="#">
               <i class="fa fa-cubes" aria-hidden="true"></i>
               <span> Assets </span>
               <span class="menu-arrow"></span>
               </a>
               <ul class="sub-menus">
                  <li>
                     <a href="/asset/list" class="{{ (request()->segment(1) == 'asset' && request()->segment(2) == 'list') ? 'active' : '' }}">Asset List </a>
                  </li>
                  @can('See-Asset-Type')  
                  <li>
                     <a href="/type/list" class="{{ (request()->segment(1) == 'type' && request()->segment(2) == 'list') ? 'active' : '' }}">Type List </a>
                  </li>
                  @endcan
               </ul>
            </li>
            @endcan
            @can('Create-Role')
            <li class="submenu">
               <a href="#">
                  <i class="fa fa-cog fa-w-16 fa-spin fa-2x" aria-hidden="true"></i>
                  <span> Settings </span>
                  <span class="menu-arrow"></span>
               </a>
               <ul class="sub-menus">
                  @can('See-Role')
                  <li>
                     <a href="/role/index" class="{{ (request()->segment(1) == 'role') ? 'active' : '' }}">Role Settings</a>
                  </li>
                  @endcan
                  @can('See-Permission')
                  <li>
                     <a href="/permission/index" class="{{ (request()->segment(1) == 'permission') ? 'active' : '' }}">Permissions Settings</a>
                  </li>
                  @endcan
               </ul>

               
            </li>
            @endcan
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