@extends('admin.layouts.app') 

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Tax<small>Create</small></h1> 
      <ol class="breadcrumb">
      <li><a href="{{ route('tax.index') }}"><i class="fa fa-users"></i> Tax</a></li>
        <li class="active">Create</li> 
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">    

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
    
        <!-- /.col -->
        <div class="col-md-10 col-sm-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading bg-primary">Create New Tax</div> 
                <div class="panel-body">
                      
                    <!-- errors -->
                    @include('admin.partials.errors') 
                    @can('permission-write') 
                  
                    <form action="{{route('tax.store')}}" method="post">
                      @csrf 
                      <div class="form-group">
                          <label class="form-control-label">Tax Class</label>
                          <input type="text" id="tax_class" name="tax_class" class="form-control " value="{{ old('tax_class') }}"> 
                      </div>

                      <div class="form-group">
                          <label class="form-control-label">Name</label>
                          <input type="text" id="name" name="name" class="form-control " value="{{ old('name') }}">
                      </div>

                      <div class="form-group">
                          <label class="form-control-label">Country</label>
                          <input type="text" id="country" name="country" class="form-control " value="{{ old('country') }}"> 
                      </div>

                      <div class="form-group">
                          <label class="form-control-label">State</label>
                          <input type="text" id="state" name="state" class="form-control " value="{{ old('state') }}">  
                      </div>

                      <div class="form-group">
                          <label class="form-control-label">City</label>
                          <input type="text" id="city" name="city" class="form-control " value="{{ old('city') }}">  
                      </div>

                      <div class="form-group">
                          <label class="form-control-label">Zip</label>
                          <input type="text" id="zip" name="zip" class="form-control " value="{{ old('zip') }}">  
                      </div>

                      <div class="form-group">
                          <label class="form-control-label">Rate</label>
                          <input type="text" id="rate" name="rate" class="form-control " value="{{ old('rate') }}">  
                      </div> 

                      <div class="form-group">
                          <label class="form-control-label">Based On</label>
                          <select name="based_on" id="based_on" class="form-control">
                            <option value="" selected disabled>Select Based On Tax</option>  
                            <option value="store-address">Store Address</option>
                            <option value="shipping-address">Shipping Address</option>
                            <option value="billing-address">Billing Address</option> 
                          </select>
                      </div>  

                      <div class="form-group">
                          <label class="form-control-label">Active</label>
                          <select name="is_active" id="is_active" class="form-control">
                            <option value="1">Yes</option>
                            <option value="0">No</option> 
                          </select>
                      </div> 

                      <div class="form-group">
                          <button type="submit" class="btn btn-primary">Add Tax</button> 
                      </div>

                    </form>
                    @else 
                    <tr>
                      <td colspan="8">
                          <h3 class="text-danger">Oops! You have no permission for this action!</h3>
                      </td>
                    </tr>
                    @endcan
                  </div>
            </div>
        </div>
        <!-- /.col -->

    </section>
    <!-- /.content -->
  </div>
<!-- /.content-wrapper -->
@endsection 

@section('title', 'Create Tax')     
