<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function registerPage(Request $request)
    {
        return view('content.auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
           'first_name' => 'required|string|max:255',
           'last_name'  => 'required|string|max:255',
           'email'      => 'required|email|unique:users,email',
           'password'   => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create New User
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name  = $request->last_name;
        $user->email      = $request->email;
        $user->password   = Hash::make($request->password); // Encrypt Password
        $execute = $user->save();

        if (!$execute) {
            return redirect()->route('register.page')->with('error_message', 'Internal Server error.');
        }

        return redirect()->route('register.page')->with('success_message', 'Registration successful! You can now log in.');
    }

    public function loginPage(Request $request)
    {
        return view('content.auth.login');
    }

    public function login(Request $request)
    {
        try {
            if ($request->isMethod('get')) {
                if ($request->session()->has('email')) {
                    return redirect('/categories');
                } else {
                    return view('content.auth.login');
                }
            } else {

                $rules = array(
                    'email'     => 'required',
                    'password'  => 'required',
                );

                $messages = array(
                    'required' => 'The :attribute field is required',
                );

                $validator = Validator::make($request->all(), $rules, $messages);
                if ($validator->fails()) {
                    return back()->withInput($request->all())->withErrors($validator->errors());
                } else {
                    $user = User::where(['email' => $request->email])->first();
                    if ($user) {
                        if (Hash::check($request->password, $user->password, [])) {
                            Auth::guard('web')->login($user);
                            return redirect('/categories');
                        } else {
                            return redirect()->back()->withInput($request->all())->with('error_message', 'You entered wrong password. Please enter correct password.');
                        }
                    } else {
                        return redirect()->back()->withInput($request->all())->with('error_message', 'Account not found with this credentials.');
                    }
                }
            }
        } catch (Exception $e) {
            dd($e);
            return redirect()->back()
                ->with('error_message', 'Oops!Internal Server Error.Please Try Again Later.', $e);
        }
    }

    public function logout(Request $request)
    {
        try {
            Auth::guard('web')->logout();
            return redirect('/');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error_message', 'Oops!Internal Server Error.Please Try Again Later.');
        }
    }
}
