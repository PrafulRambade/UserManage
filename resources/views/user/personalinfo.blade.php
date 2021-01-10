<!DOCTYPE html>
<html>

<head>
  <title>User</title>
</head>

<body>
<ul class="navbar-nav ml-auto">
        <li>    
            <div class="card-body">
            <a class="small" href="{{url('logout')}}">Logout</a>
            </div>
        </li>
    </ul>
  <div>
  <h4>Welcome {{Auth::user()->fname}}</h4>
  <form id="productForm" name="productForm" class="form-horizontal">
                  {{ csrf_field() }}
                  <div class="form-label-group">
                  <label for="inputName">First Name</label>
                  <input type="text" id="inputName" name="fname" value="{{$userDetails->fname}}" class="form-control" placeholder="First name" value="{{old('fname')}}" autofocus>
                  
                  @if ($errors->has('fname'))
                  <span class="error">{{ $errors->first('fname') }}</span>
                  @endif       
                  </div>
                  <div class="form-label-group">
                  <label for="lname">Last Name</label>
                  <input type="text" id="lname" name="lname" value="{{$userDetails->lname}}" class="form-control" placeholder="Last name" value="{{old('lname')}}" autofocus>
                  
                  @if ($errors->has('lname'))
                  <span class="error">{{ $errors->first('lname') }}</span>
                  @endif       
                  </div> 
                  <div class="form-label-group">
                  <label for="inputEmail">Email address</label>
                  <input type="email" name="email" id="inputEmail" value="{{$userDetails->email}}" class="form-control" value="{{old('email')}}" placeholder="Email address" >
                  
                  @if ($errors->has('email'))
                  <span class="error">{{ $errors->first('email') }}</span>
                  @endif    
                  </div> 

                  <div class="form-label-group">
                  <label for="inputusername">User Name</label>
                  <input type="text" id="inputusername" name="username" class="form-control" value="{{$userDetails->username}}" value="{{old('username')}}" placeholder="User name" autofocus>
                  
                  @if ($errors->has('username'))
                  <span class="error">{{ $errors->first('username') }}</span>
                  @endif       
                  </div>

                  <div class="form-label-group">
                  <label for="inputusername">User Role</label>
                  <select class="form-control" name="state" id="state-dropdown">
                    <option value="{{$userDetails->role}}">{{$userDetails->role_name}}</option>
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

</body>
</html>