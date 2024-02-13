<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function sign_up(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            foreach ($errors as $error) {
                Alert::warning('Validation Error', $error);
            }
            return redirect()->back()->withInput();
        }
        $User = new User;
        $User->name= $request->name;
        $User->email= $request->email;
        $User->password= $request->password;
        $saved_user =$User->save();
        if ( $saved_user) {
            $my_user = User::where('email', $User->email)->first();
            $user_id=$my_user->id;
            $username = $my_user->name;
            $email = $my_user->email;
            $role_id= $my_user->role_id;
            session()->put(['user_id'=>$user_id,'username'=>$username,'email'=>$email,'role_id'=>$role_id]);
            Alert::success('Registration Successful', 'Welcome ' . $username . ' You Have Registered Successfully');
            return redirect()->route('user_dashboard');
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            foreach ($errors as $error) {
                Alert::warning('Validation Error', $error);
            }
            return redirect()->back()->withInput();
        }
        $email = $request->email;
        $password = $request->password;
        $user = User::where('email', $email)->first();
        if($user == null){
            Alert::warning('Error', 'Please check the email.');
            return redirect()->back()->withInput();
        }else {
            $hashed_pass = $user->password;
            $user_id=$user->id;
            $username = $user->name;
            $email = $user->email;
            $role_id= $user->role_id;
            if (Hash::check($password, $hashed_pass)) {
                session()->put(['user_id'=>$user_id,'username' =>$username, 'email' => $email,'role_id'=>$role_id ]);
                 if ($role_id == 1) {
                    Alert::success('Login Successfull', 'Welcome ' . $username . ' You Have Logged In Successfully');
                    return redirect()->route('user_dashboard');
                 }
                //  elseif ($role_id == 3) {
                //      return redirect()->route('vendor_dash');
                //  } else {
                //      return redirect()->route('home');
                //  }
           } else{
               return redirect()->back()->with('error','Password Or Email-Address is not correct.');
             }
        }
    }

    public function logout()
    {
        session()->flush();
        Alert::success("Logout Successful", "Thank you for your visit.\nWe hope to see you soon.");
        return redirect()->route('home');
    }

    public function vendor_login_signup()
    {
        return view('vendor.login');
    }

    public function vendor_sign_up(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            foreach ($errors as $error) {
                Alert::warning('Validation Error', $error);
            }
            return redirect()->back()->withInput();
        }
        $User = new User;
        $User->name= $request->name;
        $User->email= $request->email;
        $User->password= $request->password;
        $User->role_id= $request->role_id;
        $saved_user =$User->save();
        if ( $saved_user) {
            $my_user = User::where('email', $User->email)->first();
            $user_id=$my_user->id;
            $username = $my_user->name;
            $email = $my_user->email;
            $role_id= $my_user->role_id;
            session()->put(['user_id'=>$user_id,'username'=>$username,'email'=>$email,'role_id'=>$role_id]);
            Alert::success('Registration Successful', 'Welcome ' . $username . ' You Have Registered Successfully');
            return redirect()->route('vendor_dashboard');
        }
    }

    public function vendor_login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            foreach ($errors as $error) {
                Alert::warning('Validation Error', $error);
            }
            return redirect()->back()->withInput();
        }
        $email = $request->email;
        $password = $request->password;
        $user = User::where('email', $email)->first();
        if($user == null){
            Alert::warning('Error', 'Please check the email.');
            return redirect()->back()->withInput();
        }else {
            $hashed_pass = $user->password;
            $user_id=$user->id;
            $username = $user->name;
            $email = $user->email;
            $role_id= $user->role_id;
            if (Hash::check($password, $hashed_pass)) {
                session()->put(['user_id'=>$user_id,'username' =>$username, 'email' => $email,'role_id'=>$role_id ]);
                 if ($role_id == '2' || $role_id == '4') {
                    Alert::success('Login Successfull', 'Welcome ' . $username . ' You Have Logged In Successfully');
                    return redirect()->route('vendor_dashboard');
                 } elseif ($role_id == '3') {
                    Alert::success('Login Successfull', 'Welcome ' . $username . ' You Have Logged In Successfully');
                    return redirect()->route('admin_dashboard');
                 }
           } else{
                Alert::warning("Error",'Password Or Email-Address is not correct.');
               return redirect()->back();
             }
        }

    }
}
