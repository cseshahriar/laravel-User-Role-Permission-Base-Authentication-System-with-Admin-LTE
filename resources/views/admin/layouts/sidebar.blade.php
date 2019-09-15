 <!-- Left side column. contains the logo and sidebar -->
 <aside class="main-sidebar">

<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">

  <!-- Sidebar user panel (optional) -->
  <div class="user-panel">
    <div class="pull-left image">
      <img src="{{ asset('storage/'.Auth::user()->image) }}" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
      <p>{{ Auth::user()->name }}</p> 
      <!-- Status -->
    <a href="javascript:void(0);"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
  </div>  

  <!-- search form (Optional) -->
  <!-- /.search form -->

  <!-- Sidebar Menu -->
  <ul class="sidebar-menu" data-widget="tree">  
    <li class="header">HEADER</li> 
    <!-- Optionally, you can add icons to the links -->
    
    <li>
      <a href="{{ route('dashboard') }}"><i class="fa fa-tachometer"></i> 
        <span>Dashboard</span>  
      </a>
    </li>
 
    <li class="{{ (request()->is('users*')) ? 'active' : '' }}">  
      <a href="{{ route('users.index') }}"> 
        <i class="fa fa-users"></i> 
        <span>Users</span>     
      </a>
    </li> 
    
    <li class="{{ (request()->is('permission.index')) ? 'active' : '' }}">
      <a href="{{ route('permission.index') }}"><i class="fa fa-lock"></i> 
        <span>Permissions</span>  
      </a>
    </li>    

    <li class="{{ (request()->is('role.index')) ? 'active' : '' }}">
      <a href="{{ route('role.index') }}"><i class="fa fa-shield"></i> 
        <span>Roles</span>  
      </a>
    </li>   

    <li class="{{ (request()->is('media')) ? 'active' : '' }}">
      <a href="{{ route('media') }}"><i class="fa fa-camera"></i>  
        <span>Media</span>  
      </a>
    </li>  

    <li class="treeview"> 
        <a href="#">
          <i class="fa fa-list"></i> 
          <span>Categories</span>   
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
          </span> 
        </a>
        <ul class="treeview-menu"> 
            <li>
            <a href="{{ route('category.index') }}">All Categories</a>  
            </li>       
        </ul> 
    </li>    

    <li class="treeview"> 
        <a href="#">
          <i class="fa fa-shopping-bag"></i> 
          <span>Products</span>   
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
          </span> 
        </a>
        <ul class="treeview-menu"> 
          <li><a href="{{ route('product.index') }}">Products</a></li>           
          <li><a href="{{ route('attribute.index') }}">Attributes</a></li>                      
          <li><a href="{{ route('tax.index') }}">Tax</a></li>                      
        </ul> 
    </li> 
   
    <li class="treeview">  
        <a href="#">
          <i class="fa fa-cog"></i> 
          <span>Settings</span>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
          </span> 
        </a>
        <ul class="treeview-menu"> 
            <li><a href="{{ route('menu.index') }}">Menu Builder</a></li>       
            <li><a href="{{ route('social.index') }}">Social Profiles</a></li>        
        </ul> 
    </li> 

    <li class="header">Reports</li>  
  </ul>
  <!-- /.sidebar-menu --> 
</section>
<!-- /.sidebar -->
</aside>