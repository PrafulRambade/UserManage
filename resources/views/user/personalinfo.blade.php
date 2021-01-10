@extends('admin.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Users List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Users List</li>
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
                <button class="btn btn-info btn-block text-left textv" data-toggle="collapse" data-target="#demo">Click To Search User Details</button><br>

                <div id="demo" class="collapse">
                    <form id="contactForm11" name="contactForm11" class="form-horizontal">
                        @csrf
                      <div class="row">
                        <div class="col">
                          <input type="text" class="form-control" id="firstsearchname" name="firstsearchname" placeholder="Enter First Name">
                        </div>
                        <div class="col">
                          <input type="text" class="form-control" id="lastsearchname" name="lastsearchname" placeholder="Enter Last Name">
                        </div>
                        <div class="col">
                          <button type="button" name="search_button1" id="search_button" class="btn btn-primary backlist">SEARCH</button>        
                        </div>
                      </div>
                    </form>
                </div>
                <h3 class="card-title">User Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example21" class="table table-bordered table-hover">
                    <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>User Name</th>
                                <th>Created On</th>
                                <th colspan="2">Action</th>
                            </tr>
                    </thead>
                    <tbody id="example222">
                      
                            <tr>
                                <td>{{$userDetails->fname}} {{$userDetails->lname}}</td>
                                <td>{{$userDetails->email}}</td>
                                <td>{{$userDetails->role_name}}</td>
                                <td>{{$userDetails->username}}</td>
                                <td>{{$userDetails->created_at}}</td>
                                <td><a class="edit-user btn btn-primary btn-sm" id="{{$userDetails->id}}" data-toggle="modal" data-target="#EditModalForm">Edit</button></td>
                            </tr>
                       
                    </tbody>
                </table>
                
              </div>
              <div class="d-flex justify-content-right">
                    
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
      <!-- /.container-fluid -->
    </section>
    <!-- Modal -->
<div class="modal fade" id="EditModalForm" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Edit User
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                
                <form id="productForm" name="productForm" class="form-horizontal">
                  <!-- @csrf -->
                      <!-- {{ csrf_field() }} -->
                      <div class="form-label-group">
                      <label for="inputName">First Name</label>
                      <input type="hidden" name="userid" id="userid">
                      <input type="text" id="inputName" name="fname" class="form-control" placeholder="First name" autofocus>
                      
                      @if ($errors->has('fname'))
                      <span class="error">{{ $errors->first('fname') }}</span>
                      @endif       
                      </div>
                      <div class="form-label-group">
                      <label for="lname">Last Name</label>
                      <input type="text" id="lname" name="lname" class="form-control" placeholder="Last name" autofocus>
                      
                      @if ($errors->has('lname'))
                      <span class="error">{{ $errors->first('lname') }}</span>
                      @endif       
                      </div> 
                      <div class="form-label-group">
                      <label for="inputEmail">Email address</label>
                      <input type="email" name="email" id="inputEmail" class="form-control"  placeholder="Email address" >
                      
                      @if ($errors->has('email'))
                      <span class="error">{{ $errors->first('email') }}</span>
                      @endif    
                      </div> 

                      <div class="form-label-group">
                      <label for="inputusername">User Name</label>
                      <input type="text" id="inputusername" name="username" class="form-control"   placeholder="User name" autofocus>
                      
                      @if ($errors->has('username'))
                      <span class="error">{{ $errors->first('username') }}</span>
                      @endif       
                      </div>

                      <div class="form-label-group">
                      <label for="inputusername">User Role</label>
                      <select class="form-control" name="role" id="role-dropdown">
                        <option value="">Select Role</option>
                      </select> 
                      @if ($errors->has('username'))
                      <span class="error">{{ $errors->first('username') }}</span>
                      @endif       
                      </div>

                      
                      <br>
                      <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary edit_form" id="btn-save">Save changes
                    </button>
                      <!-- <button type="submit" class="btn btn-danger" id="btn-cancel" value="create">Cancel
                    </button> -->
                  </div>

                    </form>
                
                
            </div>
            
            <!-- Modal Footer -->
           
        </div>
    </div>
</div>
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
                        success: function (data) 
                        {
                            $("#example21").load(window.location + " #example21");    
                        },
                        error: function (data) 
                        {

                        }
                    });
        }
    });
    $('body').on('click', '.edit-user', function () {
        var user_id = $(this).attr('id');

        $.get('user-list/' + user_id +'/edit', function (data) {
                 console.log(data);
                var countryoption = "";
                $.each(data.roles, function(index, value) {

                    selectedVal = data.role;
                    isSelected = selectedVal == value.id ? 'selected' : '';

                    countryoption += "<option value='" + value.id + "' " + isSelected + ">" + value.role_name + "</option>";
                    });
                $('#role-dropdown').html(countryoption);
                 $('#title-error').hide();
                 $('#product_code-error').hide();
                 $('#description-error').hide();
                 $('#productCrudModal').html("Edit Product");
                  // $('#btn-save').val("edit-product");
                  $('#ajax-product-modal').modal('show');
                  $('#userid').val(data.id);
                  $('#inputName').val(data.fname);
                  $('#lname').val(data.lname);
                  $('#inputEmail').val(data.email);
                  $('#inputusername').val(data.username);
                  
          });
    });

    $('body').on('click', '.edit_form', function (e) {
      e.preventDefault();
    var formdata = $('#productForm').serialize();
    //  alert(data);
    //  console.log(data);
                    $.ajax({

                              url:"{{url('store')}}",
                              type: "POST",
                              data: {
                                      formdata : formdata,
                                      _token: '{{csrf_token()}}' 
                                    },
                              dataType : 'json',
                              success: function (data) {
                                // console.log(data);
                                // $('#productForm').trigger("reset");
                                // $('#example2').ajax.reload();
                                $("#example21").load(window.location + " #example21");
                                $('#EditModalForm').modal('hide');
                                // $('#EditModalForm').modal('hide');
                              },
                              error: function (data) {

                              }
                    })
    
    });

    $('body').on('click', '#search_button', function () {
      var formdata = $('#contactForm11').serialize();
       $.ajax({
                  url:"{{url('searchdetails')}}",
                  type: "POST",
                  data: {
                          formdata : formdata,
                          _token: '{{csrf_token()}}' 
                        },
                  dataType : 'json',
                  success: function (data)
                  {
                    $("#example222").remove();
                    // $("#example21").load(window.location + " #example21");
                    trHTML ='';
                    console.log(data);
                    
                    // $('#EditModalForm').modal('hide');
                    $.each(data, function(i, item) {
                    
                      trHTML += '<tbody id="example222"><tr><td>' + item.fname +" "+ item.lname + '</td><td>' + item.email + '</td><td>' + item.username + '</td><td>' + item.role + '</td><td>' + item.created_at + '</td><td><a class="edit-user btn btn-primary btn-sm" id="' + item.id + '" data-toggle="modal" data-target="#EditModalForm">Edit</button></td><td><a href="javascript:void(0)" id="' + item.id + '" class="delete btn btn-danger btn-sm">Delete</a></td></tr></tbody>';
                    
                    });
                    $('#example21').append(trHTML);
                    
                  },
                  error: function (data) 
                  {

                  }
             })
    });
});
</script>