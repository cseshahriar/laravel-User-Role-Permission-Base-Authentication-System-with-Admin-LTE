 <!-- Left side column. contains the logo and sidebar -->
 <aside class="main-sidebar">

<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">

  <!-- Sidebar user panel (optional) -->
  <div class="user-panel">
    <div class="pull-left image">
      <img src="{{ asset(Auth::user()->image) }}" class="img-circle" alt="User Image">
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
        <span>Manage Users</span>    
      </a>
    </li> 


    <li class="treeview {{ (request()->is('roles*')) ? 'active' : '' }}"> 
      <a href="#">
        <i class="fa fa-shield"></i> 
        <span>Manage Roles</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span> 
      </a>
      <ul class="treeview-menu">
      <!-- <li><a href="{{ route('roles.index') }}">User Roles</a></li> -->
      <li><a href="{{ route('roles.roleuser') }}">Manage User Roles</a></li>   
      </ul> 
    </li>

    <li class="treeview">  
        <a href="#">
          <i class="fa fa-lock"></i> 
          <span>Manage Permissions</span>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
          </span> 
        </a>
        <ul class="treeview-menu">   
            <li><a href="{{ route('permission.index') }}">Permissions</a></li>     
        </ul> 
    </li>

    <li class="treeview"> 
        <a href="#">
          <i class="fa fa-list"></i> 
          <span>Manage Cagegories</span>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
          </span> 
        </a>
        <ul class="treeview-menu"> 
            <li>
            <a href="{{ route('category.index') }}">Categories</a>  
            </li>       
        </ul> 
    </li> 

    <li class="header">Reports</li>  
  </ul>
  <!-- /.sidebar-menu --> 
</section>
<!-- /.sidebar -->
</aside>