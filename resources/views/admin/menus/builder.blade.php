@extends('admin.layouts.app') 

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Menu
        <small>Builder</small>
      </h1>
      <ol class="breadcrumb">
      @can('permission-write')
      <li><a href=""><i class="fa fa-users"></i>Menu Builder</a></li>
      @endcan

      <li class="active">Menu Builder</li>  
      </ol>
    </section> 

    <!-- Main content -->
    <section class="content container-fluid">    

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        <div class="box">
                <div class="box-header">
                  <h3 class="box-title" style="display:block">Menu Builder ({{ $menu->name}})
                      <span class="pull-right" style="display:inline-block">
                      <a class="btn btn-success btn-sm" href="{{ route('menu.builder.create', $menu->id) }}"> <i class="fa fa-plus"></i> Add Menu Item</a>  
                      </span> 
                  </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                  <ul class="list-group">
                    @if(!is_null($menuItems))
                    @foreach($menuItems as $menuItem)
                    
                    @php 
                      $childMenuItems = DB::table('menu_items')->where('menu_id', $menu->id)->where('parent_id', '=', $menuItem->id)->get(); 
                    @endphp 

                    <li class="list-group-item" style="{{ count($childMenuItems) > 0 ? '': 'height: 50px'}}"> 
                      <span style="display: inline-block;float: right;padding: 0;margin:0"> 
                         <a href="{{ route('menu.builder.edit', $menuItem->id) }}" class="text-white btn btn-sm btn-info"><i class="fa fa-pencil-square text-info"></i> Edit</a>

                          <form id="delete-form" action="{{ route('menu.builder.destroy', $menuItem->id) }}" method="post" style="display: inline;border:0">  
                              @csrf    
                              @method('DELETE')       
    
                              <button class="delete btn btn-sm btn-danger" type="submit">   
                                <i class="fa fa-trash"> Delete</i>    
                              </button>     
                          </form> 
                      </span>
                      <strong>{{ $menuItem->title }}</strong> &nbsp; &nbsp; {{ $menuItem->url != null ? $menuItem->url : $menuItem->route }}
                  

                        {{-- child  --}}
                        @if($menuItem)
                        <ul class="list-unstyled list-group" style="margin-left:30px;margin-top: 20px">
                            @foreach($childMenuItems as $child)   
                             <li class="list-group-item" style="height: 50px">
                              <span style="display: inline-block;float: right;padding: 0;margin:0"> 
                                 <a href="{{ route('menu.builder.edit', $child->id) }}" class="text-white btn btn-sm btn-info"><i class="fa fa-pencil-square text-info"></i> Edit</a>

                                  <form id="delete-form" action="{{ route('menu.builder.destroy', $child->id) }}" method="post" style="display: inline;border:0">  
                                      @csrf    
                                      @method('DELETE')       
            
                                      <button class="delete btn btn-sm btn-danger" type="submit">   
                                        <i class="fa fa-trash"> Delete</i>    
                                      </button>     
                                  </form> 
                              </span>
                              <strong>{{ $child->title }}</strong> &nbsp; &nbsp; {{ $child->url != null ? $child->url : $child->route }} 
                            </li>
                            @endforeach
                        </ul>
                        @endif
                    </li>

                    @endforeach
                    @endif
                  </ul>

                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
<!-- /.content-wrapper -->
@endsection 

@section('title', 'Viewing Menu Builder')      

@section('scripts') 
<script> 
  $(document).on('click', '.delete', function(e) {  
          
          var form = $(this).parents('form:first'); 

         var confirmed = false;

           e.preventDefault();
          
           swal({
               title : 'Are you sure want to delete?',
               text : "Onec Delete, This will be permanently delete!",
               icon : "warning",
               buttons: true,
               dangerMode : true
           }).then((willDelete) => { 
               if (willDelete) {
                   // window.location.href = link;
                   confirmed = true;

               form.submit();         

               } else {
                   swal("Safe Data!");   
               }
           });
       });
</script> 
@endsection  
