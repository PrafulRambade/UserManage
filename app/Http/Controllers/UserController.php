<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\User;
Use App\ROle;
use DataTables,DB;
use Validator,Redirect,Response;
use Carbon\Carbon;
use App\Mail\VarificationEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function userManage()
    {
        // $userDetails = User::with('role')->get();
        
        $userDetails = DB::table('users')
            ->join('roles', 'users.role', '=', 'roles.id')
            ->select('users.*', 'roles.role_name')
            ->paginate(10);


            

        // $userDetails = User::all();
        // echo "<pre>";
        // print_r($userDetails);
        // die;
        return view('admin.userManage',['userDetails'=>$userDetails]);  
    }
    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();
    }
    public function editUser($id)
    {
        $cid = array('id' => $id);

	    $data  = User::where($cid)->first();

        $user_id = $data->id;
       
        $data['user']  = User::where('id',$user_id)->first();

        $data['roles'] = Role::all();
        return Response::json($data);
    }
    public function userStore(Request $request)
    {
        $data = $request->all();
        $myValue=  array();
        parse_str($data['formdata'], $myValue);

        $user_id = $myValue['userid'];
        $fname = $myValue['fname'];
        $lname = $myValue['lname'];
        $email = $myValue['email'];
        $username = $myValue['username'];
        $role = $myValue['role'];


        $user = User::find($user_id);
        $user->fname = $fname;
        $user->lname = $lname;
        $user->email = $email;
        $user->username = $username;
        $user->role = $role;
        $user->updated_at = date("Y-m-d h:i:s a", time());
        $data = $user->update();

        return Response::json($data);

    }

    public function normalUser()
    {
        $user_id = Auth::user()->id;
        $Userinfo  = User::where('id',$user_id)->first();
        $role_id = $Userinfo->role;
        $role  = ROle::where('id',$role_id)->first();
        $Userinfo['role_name'] = $role->role_name;
        // echo "<pre>";
        // print_r($Userinfo);
        // die;
        return view('user.personalinfo',['userDetails'=>$Userinfo]);
    }
    public function adminUser(){
      $userCount = User::count();
    // die; 
       return view('admin.dashboard',['userTotalCount'=>$userCount]);
    }
    public function searchDetails(Request $request)
    {
        // echo "hii";
        // if ($request->ajax()) 
        // {
            $data = $request->all();
            $myValue=  array();
            parse_str($data['formdata'], $myValue);
            $firstsearchname = $myValue['firstsearchname'];
            $lastsearchname = $myValue['lastsearchname'];
            if(!empty($firstsearchname) && empty($lastsearchname))
            {
                $data = User::where("fname","like","%".$firstsearchname."%")->get();
                // echo $user_id = $data['id'];


                
            }
            if(!empty($lastsearchname) && empty($firstsearchname))
            {
                $data = User::where("lname","like","%".$lastsearchname."%")->get();
                // return $data;
            }
            if(!empty($firstsearchname) && !empty($lastsearchname))
            {
                echo "both name";
            }
            return Response::json($data);
        // }
    }
}
