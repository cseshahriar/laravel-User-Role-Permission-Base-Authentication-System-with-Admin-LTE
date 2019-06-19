@extends('layouts.app')

@section('content')
<div class="container"> 
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">Update your profile</div>

                <div class="card-body"> 

                    @include('admin.partials.errors')   

                    <form class="form-horizontal" method="POST" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
        
                          @csrf 
                        
                            <div class="form-group">
                              <label for="name" class="col-sm-2 control-label">Name</label> 
            
                              <div class="col-sm-10">
                              <input type="text" name="name" class="form-control" id="name" value="{{ Auth::user()->name }}" placeholder="Name"> 
                              </div>
                            </div>  
            
                            <div class="form-group">
                              <label for="designation" class="col-sm-2 control-label">Designation</label>
            
                              <div class="col-sm-10">
                              <input type="text" name="designation" class="form-control" id="designation" value="{{ Auth::user()->designation }}" placeholder="Designation">
                              </div> 
                            </div>
        
                            <div class="form-group">
                                <label for="education" class="col-sm-2 control-label">Education</label>
              
                                <div class="col-sm-10">
                                <input type="text" name="education" class="form-control" id="education" value="{{ Auth::user()->education }}" placeholder="Education"> 
                                </div> 
                            </div>
        
                            <div class="form-group">
                                <label for="image" class="col-sm-2 control-label">Picture</label>
              
                                <div class="col-sm-10">
                                <img id="photo" src="{{ asset(Auth::user()->image) }}" alt="" style="width:120px;height:100px; margin-bottom:10px;border-radius:5px;">
                                <input type="file" name="image" class="form-control-file" id="image"> 
                                </div> 
                            </div>
        
                            <div class="form-group">
                                <label for="mobile" class="col-sm-2 control-label">Mobile Number</label>
              
                                <div class="col-sm-10">
                                <input type="number" name="mobile" class="form-control" id="mobile" value="{{ Auth::user()->mobile }}" placeholder="Mobile Number"> 
                                </div> 
                            </div>
        
                            <div class="form-group"> 
                                <label for="phone" class="col-sm-2 control-label">Phone Number</label>
              
                                <div class="col-sm-10">
                                <input type="number" name="phone" class="form-control" id="mobile" value="{{ Auth::user()->phone }}" placeholder="Phone Number"> 
                                </div> 
                            </div>
                            
            
                            <div class="form-group">
                              <label for="address" class="col-sm-2 control-label">Address</label>
            
                              <div class="col-sm-10">
                                <textarea class="form-control" name="address" id="address" placeholder="Address">{{ Auth::user()->address }}</textarea> 
                              </div> 
                            </div>
            
                            <div class="form-group">
                              <label for="skills" class="col-sm-2 control-label">Skills</label> 
        
                              <div class="col-sm-10">
                                  <textarea class="form-control" name="skills" id="skills" placeholder="Skills">{{ Auth::user()->skills }}</textarea> 
        
                                  <p class="alert alert-warning" role="alert" style="margin-top:10px">
                                      Skills must be comma separated. Example : HTML, CSS, JavaScript, PHP, MySQL, Laravel, Git
                                  </p>
        
                              </div>
                            </div>
        
                            <div class="form-group">
                                <label for="bio" class="col-sm-2 control-label">Bio</label>
              
                                <div class="col-sm-10">
                                  <textarea class="form-control" name="bio" id="bio" placeholder="Bio">{{ Auth::user()->bio }}</textarea>  
                                </div> 
                            </div> 
                            
                            <div class="form-group">
                              <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-success">Save Changes</button>
                              </div>
                            </div>
                          </form> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extjs') 
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#photo').attr('src', e.target.result).height(80).width(80);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#image").change(function () {
        readURL(this); 
    });
</script>
@endsection 
