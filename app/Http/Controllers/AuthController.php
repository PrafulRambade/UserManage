<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Validator,Redirect,Response;
Use App\User;
Use App\Role;
use DataTables,DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use Socialite;
 
class AuthController extends Controller
{
 
    public function index()
    {
        return view('login');
    }  
 
    public function registration()
    {
        return view('registration');
    }
     
    public function postLogin(Request $request)
    {
        request()->validate([
        'email' => 'required',
        'password' => 'required',
        ]);
 
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
           
            $role_id = Auth::user()->role;
            $role  = Role::where('id',$role_id)->first();
            $user_role = $role->role_name;
            if($user_role == 'Admin')
            {
                return redirect('/abc');
            }
            else
            {
                return redirect('/pqr');
            }
            
        }
        return Redirect::to("login")->withSuccess('Oppes! You have entered invalid credentials');
    }
 
    public function postRegistration(Request $request)
    {  
        request()->validate([
        'fname' => 'required',
        'lname' => 'required',
        'email' => 'required|email|unique:users',
        'username' => 'required',
        'password' => 'required|min:8',
        'cpassword' => 'required|min:8|same:password',
        ],
        [
            'fname.required' => 'The first name field is required',
            'lname.required' => 'The last name field is required',
            'email.required' => 'The Email field is required',
            'username.required' => 'The Username field is required',
            'password.required' => 'The password name field is required',
            'cpassword.required' => 'The confirm password name field is required',
            'cpassword.same' => 'Password Confirmation should match the Password'
        ]);

        // $data = $request->all();
        // $check = $this->create($data);
        
        $user= new User;
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->email = $request->email;
        $user->username = $request->username;	
        $user->password = Hash::make($request->password);
        $user->created_at = date("Y-m-d h:i:s a", time());
        $user->remember_token = Str::random(32);
        $data = $user->save();
        
        if($data)
        {
            $this->sendResetEmail($request->email,$request->password);
        }
        // $this->sendResetEmail($request->email, $token,$password1);
        return redirect('login')->with('success', 'User created successfully.');
        // return Redirect::to("dashboard")->withSuccess('Great! You have Successfully loggedin');
    }
     
    public function dashboard()
    {
 
      if(Auth::check()){
        return view('dashboard');
      }
       return Redirect::to("login")->withSuccess('Opps! You do not have access');
    }
 
    public function logout() {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
    
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();
     
            if($finduser){
     
                Auth::login($finduser);
                $role_id = Auth::user()->role;
                $role  = Role::where('id',$role_id)->first();
                $user_role = $role->role_name;
                if($user_role == 'Admin')
                {
                    return redirect('/abc');
                }
                else
                {
                    return redirect('/pqr');
                }    
                // return redirect($this->redirectPath());
                // return view('dashboard');
     
            }
            else{
               
                $newUser = User::create([
                    'fname' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'created_at' => date("Y-m-d h:i:s a", time()),
                    'password' => Hash::make("123456")
                ]);

                // echo "<pre>";
                
    
                Auth::login($newUser);

                $user_id = $newUser->id;
                $Userinfo  = User::where('id',$user_id)->first();
                $role_id = $Userinfo->role;
                $role  = ROle::where('id',$role_id)->first();
                // $role_id = $newUser->role;
                // $role  = Role::where('id',$role_id)->first();
               $user_role = $role->role_name;
            //    die; 
               if($user_role == 'Admin')
                {
                    return redirect('/abc');
                }
                else
                {
                    return redirect('/pqr');
                }
                }
    
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }


    private function sendResetEmail($email,$password1)
	{
			//Retrieve the user from the database
			$user = DB::table('users')->where('email', $email)->select('fname', 'email')->first();
			//Generate, the password reset link. The token generated is embedded in the link
			$loginurl=url("/login");
			// $link1 = url("/password/reset/{$token}");

			// $link = $link1.'?email='.urlencode($user->email);

		    $details = [
		        'title' => 'Hi '.$user->fname.'',
		        'body' => 'Your account has been created successfully. Please find Below Login Credentials',
		        'username' => $user->email,
		        'password' => $password1,
		        'loginurl' =>$loginurl,
		        // 'link' => URL::route('password/reset/'.$token)
		        // 'url' => $link
		    ];
		   
		    \Mail::to($email)->send(new \App\Mail\SendMail($details));
		    //Here send the link with CURL with an external email API 
		   
    }
}