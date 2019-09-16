@extends('admin.layouts.app') 

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Product <small>Create</small></h1> 
      <ol class="breadcrumb">
      <li><a href="{{ route('product.index') }}"><i class="fa fa-users"></i> Products</a></li>
        <li class="active">Create</li> 
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">    

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
    
        <!-- /.col -->
        <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data"> 

        <div class="col-md-8"> 
            <div class="panel panel-primary">
                <div class="panel-heading bg-primary">Create New Product</div> 
                <div class="panel-body">
                      
                    <!-- errors -->
                    @include('admin.partials.errors')  
                  
                      @csrf 

                      <div class="form-group">
                          <label class="form-control-label">Title</label>
                          <input type="text" id="txturl" name="title" class="form-control " value="{{ old('title') }}">
                      </div>
                        
                      <div class="form-group">
                          <label class="form-control-label">Slug</label>
                          <input type="text" id="slug" name="slug" class="form-control " value="{{ old('slug') }}">
                      </div>

                      <div class="form-group"> 
                          <label class="form-control-label">Excerpt </label>
                          <textarea name="short_description" id="editor" class="form-control " rows="5" cols="5">{{ old('short_description') }}</textarea>
                      </div>  

                      <div class="form-group"> 
                          <label class="form-control-label">Description </label>
                          <textarea name="description" id="editor" class="form-control " rows="6" cols="6">{{ old('description') }}</textarea>
                      </div>

                    <div class="form-group">
                      <label class="form-control-label">SEO Title</label>
                      <input type="text" name="meta_title" id="meta_title" class="form-control" placeholder="SEO Title" value="{{ old('meta_title') }}"> 
                    </div> 
                
                    <div class="form-group">
                      <label class="form-control-label">SEO Keywords</label>
                      <textarea name="meta_keywords" id="meta_keywords" cols="3" rows="3" class="form-control" placeholder="SEO Keywords">{{ old('meta_keywords') }}</textarea>
                    </div> 
                
                    <div class="form-group">
                      <label class="form-control-label">SEO Description</label> 
                       <textarea name="meta_description" id="meta_description" cols="3" rows="3" class="form-control" placeholder="SEO Description"> {{ old('meta_description') }}</textarea> 
                    </div> 

                  </div>
            </div>
        </div>
        <!-- /.col -->

        <!-- col -->
        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading bg-primary">Document</div> 
                <div class="panel-body"> 
    
                      <div class="form-group"> 
                          <label class="form-control-label">Thumbnail</label>
                          <input type="file" name="thumbnail" id="thumbnail" accept="image/*"> 
                      </div>

                      <div class="form-group">
                          <label class="form-control-label">Publish</label>
                          <select name="is_active" id="is_active" class="form-control">
                            <option value="1">Yes</option>
                            <option value="0">No</option> 
                          </select>
                      </div>

                      <div class="form-group">
                          <button type="submit" class="btn btn-success btn-block">Add Product</button>
                      </div>
                        

                      <div class="form-group">
                        @php 
                          $ids = (isset($category->parents) && $category->parents->count() > 0 ) ? array_pluck($category->parents, 'id') : null
                        @endphp

                          <label class="form-control-label">Select Category: </label>
                          <select name="category_id[]" id="category_id" class="select2 form-control" multiple="multiple">   
                            @if(isset($categories)) 
                            <option value="0">Top Level</option>
                            @foreach($categories as $cat)
                            <option value="{{$cat->id}}" @if(!is_null($ids) && in_array($cat->id, $ids)) {{'selected'}} @endif>{{$cat->title}}
                                 
                                @if($cat->childrens()->count() > 0) 
                                ( 
                                @foreach($cat->childrens as $children)
                                  <span style="margin-left: 15px;display:inline-block;"><br>{{ $children->title }},</span> 
                                @endforeach    
                                )
                                @endif

                            </option>
                            @endforeach
                            @endif
                          </select>
                       
                      </div>

                      <div class="form-group">
                        <label class="form-control-label">Price</label>
                        <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}">
                      </div>   

                      <div class="form-group">
                        <label class="form-control-label">Quantity</label>
                        <input type="number" name="qty" id="qty" class="form-control" placeholder="Quantity" value="{{ old('qty') }}"> 
                      </div>  

                      <div class="form-group">
                        <label class="form-control-label">Stock Keeping Unit </label>
                        <input type="number" name="sku" id="sku" class="form-control" placeholder="SKU" value="{{ old('sku') }}">
                      </div>  

                      <div class="form-group">
                        <label class="form-control-label">Special Price</label>
                        <input type="number" name="special_price" id="price" class="form-control" placeholder="Special Price" value="{{ old('special_price') }}">
                      </div>   

                      <div class="form-group">
                        <label class="form-control-label">Special Price Start</label>
                        <input type="text" name="special_price_start" id="special_price_start" class="form-control datepicker" placeholder="Special Price Start" value="{{ old('special_price_start') }}"> 
                      </div>   

                      <div class="form-group">
                        <label class="form-control-label">Special Price End</label>
                        <input type="text" name="special_price_end" id="special_price_end" class="form-control datepicker" placeholder="Special Price End" value="{{ old('special_price_end') }}"> 
                      </div>    

                      <div class="form-group">
                        <label class="form-control-label">New Form Date</label>
                        <input type="text" name="new_from" id="new_from" class="form-control datepicker" placeholder="New from date" value="{{ old('new_from') }}">
                      </div>   

                      <div class="form-group">
                        <label class="form-control-label">New To Date</label>
                        <input type="text" name="new_to" id="new_to" class="form-control datepicker" placeholder="New Date End" value="{{ old('new_to') }}">
                      </div> 

                      <div class="form-group">
                          <label class="form-control-label">Stock Available</label>
                          <select name="in_stock" id="in_stock" class="form-control">
                            <option value="1">Yes</option>
                            <option value="0">No</option>  
                          </select>
                      </div> 

                      <div class="form-group">
                          <label class="form-control-label">Tax</label>
                          <select name="tax_id" id="tax_id" class="form-control">
                            <option value="" selected disabled>Select Tax</option>
                            @foreach($taxes as $tax) 
                            <option value="{{ $tax->id }}">{{ $tax->name }}</option> 
                            @endforeach       
                          </select>  
                      </div> 
                  </div>
            </div>
        </div>
        <!-- /col --> 

        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading bg-primary">Product Attributes</div>  
                <div class="panel-body">
                    <div class="form-group">
                          <label class="form-control-label">Product Attrubutes</label>
                          <button id="attributebtn" class="pull-right btn btn-success"><i class="fa fa-plus"></i> Add New Attribute</button>
                    </div>  
                  
                   <div class="form-group row" id="attributeDiv"> 

                    <div id="attBox">  
                      <div class="form-group col-md-5">
                        <label class="form-control-label">Attrubute Key</label>
                        <select name="attribute_key[]" id="attribute_key" class="form-control">
                          <option value="" selected disabled>Select Attribute</option>
                          @foreach($attributes as $attribute)
                          <option value="{{ $attribute->name }}">{{ $attribute->name }}</option>
                          @endforeach
                        </select> 
                      </div>

                      <div class="form-group col-md-5">
                        <label class="form-control-label">Attrubute Value</label>
                        <input type="text" name="attribute_value[]" id="attribute_value" placeholder="Value" class="form-control">  
                      </div>

                      <div class="form-group col-md-2"> 
                         <label class="form-control-label">Action</label><br>
                         <button id="attRemoveBtn" class="btn btn-danger btn-block col-md-2"> X </button>
                      </div>    
                      
                    </div>

                   </div>
                </div>
            </div>
          </div>
        </div>

         <div class="row">
          <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading bg-primary">Product Images</div>  
                <div class="panel-body">
                
                   <div class="form-group">
                          <label class="form-control-label">Multiple Image Upload</label>
                          <button id="imagebtn" class="pull-right btn btn-success"><i class="fa fa-plus"></i> Add New Image</button> 
                    </div>  

                    <div class="form-group" id="image_div">
                          <input type="file" name="image[]" class="form-control-file col-md-10" style="margin-bottom: 30px" accept="image/*" multiple> 
                          <button id="imgRemoveBtn" class="btn btn-xs btn-danger col-md-2">X</button>  
                    </div> 

                </div>
            </div>
          </div>
        </div>
        
        
        </form>
    </section>
    <!-- /.content -->
  </div>
<!-- /.content-wrapper -->
@endsection 

@section('title', 'Add New Product')   

@section('scripts') 
<script src="http://cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script>
   
  var options = {
    filebrowserImageBrowseUrl: '{{ url('/')}}/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '{{ url('/')}}/laravel-filemanager/upload?type=Images&_token=',
    filebrowserBrowseUrl: '{{ url('/')}}/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '{{ url('/')}}/laravel-filemanager/upload?type=Files&_token='
  };

  CKEDITOR.replace('description', options);  
</script>

<script>
  $(document).ready(function() {

     //Date picker
    $( ".datepicker" ).datepicker({ format: 'yyyy-mm-dd', autoclose: true }); 

      
      // attrubutes 
       $(document).on('click', '#attributebtn', function(event) { 
        event.preventDefault();
        /* Act on the event */
        var attrivuteHtml = `<div id="attBox"><div class="form-group col-md-5 removeDiv">
                        <label class="form-control-label">Attrubute Key</label>
                        <select name="attribute_key[]" id="attribute_key" class="form-control">
                          <option value="" selected disabled>Select Attribute</option>
                          @foreach($attributes as $attribute)
                          <option value="{{ $attribute->name }}">{{ $attribute->name }}</option>
                          @endforeach
                        </select> 
                      </div>

                      <div class="form-group col-md-5 removeDiv">
                        <label class="form-control-label">Attrubute Value</label>
                        <input type="text" name="attribute_value[]" id="attribute_value" placeholder="Value" class="form-control">  
                      </div>

                      <div class="form-group col-md-2 removeDiv"> 
                         <label class="form-control-label">Action</label><br>
                         <button id="attRemoveBtn" class="btn btn-danger btn-block col-md-2"> X </button>
                      </div></div>`;
        $('#attributeDiv').append(attrivuteHtml);            
      });

      $(document).on('click', '#attRemoveBtn', function(event) {
        event.preventDefault();
        /* Act on the event */
          $('#attributeDiv #attBox').last().remove();                    
      });

      
      // images 
      $(document).on('click', '#imagebtn', function(event) {
        event.preventDefault();
        /* Act on the event */
        $('#image_div').append('<input type="file" name="image[]" class="form-control-file col-md-10" style="margin-bottom:30px" accept="image/*" multiple> <button id="imgRemoveBtn" class="btn btn-xs btn-danger col-md-2">X</button>');          
      });

      $(document).on('click', '#imgRemoveBtn', function(event) {
        event.preventDefault();
        /* Act on the event */
              
          $('#image_div input').last().remove();   
          $('#image_div #imgRemoveBtn').last().remove();     
      });  

  });
</script>
@endsection