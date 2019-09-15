@extends('admin.layouts.app') 

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Tax<small>Update</small></h1> 
      <ol class="breadcrumb">
      <li><a href="{{ route('tax.index') }}"><i class="fa fa-users"></i> Tax</a></li>
        <li class="active">Update</li> 
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
                <div class="panel-heading bg-primary">Update Tax</div> 
                <div class="panel-body">
                      
                    <!-- errors -->
                    @include('admin.partials.errors') 
                    @can('permission-write') 
                  
                    <form action="{{route('tax.update', $tax->id)}}" method="post">
                      
                      @csrf 
                      @method('PUT') 

                      <div class="form-group">
                          <label class="form-control-label">Tax Class</label>
                          <input type="text" id="tax_class" name="tax_class" class="form-control " value="{{ $tax->tax_class }}"> 
                      </div>

                      <div class="form-group">
                          <label class="form-control-label">Name</label>
                          <input type="text" id="name" name="name" class="form-control " value="{{ $tax->name }}"> 
                      </div>

                      <div class="form-group">
                          <label class="form-control-label">Country</label>
                          <input type="text" id="country" name="country" class="form-control " value="{{ $tax->country }}"> 
                      </div>

                      <div class="form-group">
                          <label class="form-control-label">State</label>
                          <input type="text" id="state" name="state" class="form-control " value="{{ $tax->state }}">  
                      </div>

                      <div class="form-group">
                          <label class="form-control-label">City</label>
                          <input type="text" id="city" name="city" class="form-control " value="{{ $tax->city }}">   
                      </div> 

                      <div class="form-group">
                          <label class="form-control-label">Zip</label>
                          <input type="text" id="zip" name="zip" class="form-control " value="{{ $tax->zip }}">  
                      </div>

                      <div class="form-group">
                          <label class="form-control-label">Rate</label>
                          <input type="text" id="rate" name="rate" class="form-control " value="{{ $tax->rate }}">  
                      </div> 

                      <div class="form-group">
                          <label class="form-control-label">Based On</label>
                          <select name="based_on" id="based_on" class="form-control">
                            <option value="" selected disabled>Select Based On Tax</option>  
                            <option value="store-address" {{ $tax->based_on == 'store-address' ? 'selected' : ''}}>Store Address</option>
                            <option value="shipping-address" {{ $tax->based_on == 'shipping-address' ? 'selected' : ''}}>Shipping Address</option>
                            <option value="billing-address" {{ $tax->based_on == 'billing-address' ? 'selected' : ''}}>Billing Address</option>  
                          </select>
                      </div>  

                      <div class="form-group">
                          <label class="form-control-label">Active</label>
                          <select name="is_active" id="is_active" class="form-control">
                            <option value="1" {{ $tax->is_active == 1 ? 'selected' : ''}}>Yes</option>
                            <option value="0" {{ $tax->is_active == 0 ? 'selected' : ''}}>No</option> 
                          </select>
                      </div> 

                      <div class="form-group">
                          <button type="submit" class="btn btn-primary">Update Tax</button> 
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

@section('title', 'Update Tax')      
