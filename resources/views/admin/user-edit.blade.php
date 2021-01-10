@extends('admin.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>EDIT USER</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">EDIT USER</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Edit User</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body col-6 ">
              <form id="productForm" name="productForm" class="form-horizontal">
                  {{ csrf_field() }}
                  <div class="form-label-group">
                  <label for="inputName">First Name</label>
                  <input type="text" id="inputName" name="fname" class="form-control" placeholder="First name" value="{{old('fname')}}" autofocus>
                  
                  @if ($errors->has('fname'))
                  <span class="error">{{ $errors->first('fname') }}</span>
                  @endif       
                  </div>
                  <div class="form-label-group">
                  <label for="lname">Last Name</label>
                  <input type="text" id="lname" name="lname" class="form-control" placeholder="Last name" value="{{old('lname')}}" autofocus>
                  
                  @if ($errors->has('lname'))
                  <span class="error">{{ $errors->first('lname') }}</span>
                  @endif       
                  </div> 
                  <div class="form-label-group">
                  <label for="inputEmail">Email address</label>
                  <input type="email" name="email" id="inputEmail" class="form-control" value="{{old('email')}}" placeholder="Email address" >
                  
                  @if ($errors->has('email'))
                  <span class="error">{{ $errors->first('email') }}</span>
                  @endif    
                  </div> 

                  <div class="form-label-group">
                  <label for="inputusername">User Name</label>
                  <input type="text" id="inputusername" name="username" class="form-control"  value="{{old('username')}}" placeholder="User name" autofocus>
                  
                  @if ($errors->has('username'))
                  <span class="error">{{ $errors->first('username') }}</span>
                  @endif       
                  </div> 

                  <div class="form-label-group">
                  <label for="inputPassword">Password</label>
                  <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password">
                  
                  @if ($errors->has('password'))
                  <span class="error">{{ $errors->first('password') }}</span>
                  @endif  
                  </div>
                  <div class="form-label-group">
                  <label for="inputcPassword">Confirm Password</label>
                  <input type="password" name="cpassword" id="inputcPassword" class="form-control" placeholder="Confirm Password">
                  
                  @if ($errors->has('cpassword'))
                  <span class="error">{{ $errors->first('cpassword') }}</span>
                  @endif  
                  </div><br>
                  <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit">Edit User</button>
                  </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
      <!-- /.container-fluid -->
    </section>
</div>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $(document).on('click', '.delete', function(){
        user_id = $(this).attr('id');
        var msg_result=confirm("Do you really want to Delete this details?");
	    if(msg_result)
        {
            $.ajax({
                        url:"contact/deleteuser/"+user_id,
            });
        }
    });
});
</script>