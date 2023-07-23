<?php
namespace App\Http\Controllers;
use App\Models\Countries;
use App\Models\User;
use App\Events\WelcomeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendForgatePasswordEmail;

class userRegistration extends Controller
{
    
    public function userRegistration(){
        $countries = Countries::all();
        
        return view('user_registraation',compact('countries'));
        
    }
    public function userRegistrationForm(Request $request){
        $this->validate($request,[
            'fname' => 'required|min:5|max:10|string',
            'lname' => 'required|min:5|max:10|string',
            'email' => 'required|email',
            'contact' => 'numeric|nullable',
            'password' => 'required|min:6',
            'gender' => 'required|in:Male,Female',
            'adderess' => 'nullable|string|max:100',
            'country' => 'required|exists:countries,id',
            'profile' => 'required|mimes:jpg,jpeg,png'
        ]);
        $req=$request->except(['_token', 'regist']);
        $imageName = 'lv'.rand().'.'.$request->profile->extension();
        $request->profile->move(public_path('profiles/'),$imageName);
        $req['profile'] = $imageName;
        $req['password'] = Hash::make($request->password);
        $req['role_id'] = User::USER_ROLE;
        $requestData = User::create($req);
        
        event(new WelcomeEmail($requestData));
        return redirect()->route('home')->with('success','Registration successfully!');
    }
    public function userLogin(){
        return view('user_login');
    }
    public function UserLoginForm(Request $request){
        $logindata = $request->except(['_token','loginbtn'] );
        if(Auth::attempt($logindata)){
           
            $user = auth()->user();
           // echo"<pre>"; print_r($user);exit;
            return redirect()->intended('/')->withSuccess('Sucessfulyy login');
           
        } else{
            return redirect()->intended('login')->withSuccess('Sucessfulyy login');
        }
    }
    public function UserResetPassword(){
        return view('resetpassword');
    }

    public function UserResetPasswordForm(Request $request){
                $this->validate($request,[
           
            'email' => 'required|email|exists:users,email',
           
        ]);
        $requestData= $request->except(['_token','submit']);
        $requestData['token'] = Str::random('30');
        $forgatePasswordDate = DB::table('password_resets')->insert($requestData);
        
        Mail::to($requestData['email'])->send(new SendForgatePasswordEmail($requestData));
        
    }

    public function UserLogout(Request $request)
    {
        Session::flush();
        Auth::logout();
        return redirect('login');

    }
}
