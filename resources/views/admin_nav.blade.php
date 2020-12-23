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
            <li>
            	<a href="/user/userList" class="{{ (request()->segment(2) == 'userList') ? 'active' : '' }}">
            		<i class="fa fa-users" aria-hidden="true"></i>
            		<span> Users </span>
            	</a>
            </li>
            <li class="submenu">
               <a href="#">
                   <i class="fa fa-database" aria-hidden="true">                       
                   </i> <span> Collection </span> 
                   <span class="menu-arrow"></span>
                </a>
                <ul class="sub-menus">
                  <li><a href="#" class="">Collection Area</a></li>
                  <li><a href="#" class="">Tasks</a></li>                  
                </ul>
            </li>
            <li class="submenu">
               <a href="#">
                   <i class="fa fa-product-hunt" aria-hidden="true">                       
                   </i> <span> Product </span> 
                   <span class="menu-arrow"></span>
                </a>
                <ul class="sub-menus">
                  <li><a href="/product/index" class="{{ (request()->segment(1) == 'product') ? 'active' : '' }}">Product Listing</a></li>
                  <li><a href="/product-stock/index" class="{{ (request()->segment(1) == 'product-stock') ? 'active' : '' }}">Product Stock</a></li>                  
                </ul>
            </li>
            <li class="submenu">
               <a href="#">
               		<i class="fa fa-cart-plus" aria-hidden="true"></i>
               		<span> Sale </span>
               		<span class="menu-arrow"></span>
               	</a>
               	<ul class="sub-menus">
                    <li><a href="/cart/index" class="{{ (request()->segment(1) == 'cart' && request()->segment(2) == 'index') ? 'active' : '' }}">Sale Record </a></li>
                    <li><a href="/cart/reserveInvoice" class="{{ (request()->segment(2) == 'reserveInvoice') ? 'active' : '' }}">Reserve Stock</a></li>
                    <li><a href="/cart/onHoldInvoice" class="{{ (request()->segment(2) == 'onHoldInvoice') ? 'active' : '' }}">On Hold Invoice</a></li>
               </ul>
            </li>            
            <li class="submenu">
               <a href="#">
                   <i class="fa fa-cog" aria-hidden="true">                       
                   </i> <span> Settings </span> 
                   <span class="menu-arrow"></span>
                </a>
                <ul class="sub-menus">
                  <li><a href="/role/index" class="{{ (request()->segment(1) == 'role') ? 'active' : '' }}">Role Settings</a></li>
                  <li><a href="/permission/index" class="{{ (request()->segment(1) == 'permission') ? 'active' : '' }}">Permissions Settings</a></li>                  
                </ul>
            </li>
         </ul>
      </div>
   </div>
</div>

 <script type="text/javascript">
$(document).ready(function() {
   $(".submenu").on('click', function(){
        this.find('sub-menus').css({"display": "block"});       
   });
});
</script>