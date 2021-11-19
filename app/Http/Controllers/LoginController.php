<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Models\User;

use App\Mail\PasswordResetMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use mysql_xdevapi\Session;

class LoginController extends Controller
{
// {
//     public function __construct(\AdminTableSeeder $adminTableSeeder)
//     {
//        $user = User::count();

//         if ($user<1) {
//             $adminTableSeeder->run();
//         }
//     }

    public function loginpage()
    {
        return view('login.user.index');
    }

    public function loginCheck(Request $request)
    {
        $request->validate(['email' => 'required|email', 'password' => 'required']);
        $email = $request->email;
        $password = $request->password;
        if (Auth::attempt(['email'=>$email,'password'=>$password])){
            if ($request->user()->is_verified){
                return redirect('dashboard');
            }else{
                Auth::logout();
                return back()->with('message', 'User is not activated');
            }
        }else{
            Auth::logout();
            return back()->with('message', 'Your credentials do not match our records');
        }

    }

    public function dashboardpage()
    {
        if (Auth::user()->is_admin) {
            $employee = User::where('is_employee', true)->count();
            $verified_employee = User::where(['is_employee' => true, 'is_verified' => true])->count();
            return view('backend.dashboard.index', compact('employee', 'verified_employee'));
        } elseif (Auth::user()->is_employee) {
          return view('backend.dashboard.index');
        }
        else{
            $total_food_items = Food::count();
            $total_category=2;
            return view('backend.dashboard.index', compact('total_food_items', 'total_category'));

        }
    }



        public function checkEmail(Request $request){
        $email = $request->email;
        $checkEmail = \App\Models\User::where('email',$email)->first();
        if($checkEmail){
            $resetToken = str_random(40);
            $checkEmail->password_reset_token = $resetToken;
            $checkEmail->save();
            Mail::to($email)->send(new PasswordResetMail($checkEmail));
            return response()->json('1');
        }
        else{
            return response()->json('0');

        }

    }





    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function passwordReset(Request $request)
    {
        $currentPassword = $request->currentPassword;
        $newPassword = $request->newPassword;

        if (Hash::check($currentPassword, $request->user()->password)) {
            $request->user()->password = bcrypt($newPassword);
            $request->user()->update();
            return 'password changed';
        }else{
            return 'not matched';
        }
    }
}
