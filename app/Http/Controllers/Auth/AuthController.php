<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Citizen;
use App\Models\Lawyer;

class AuthController extends Controller
{

    public function loginGet()
    {
        return view('pages.login');
    }

    public function loginPost(Request $oRequest)
    {

        $oValidator =  Validator::make($oRequest->all(),[
            'username'          => 'required|min:6',
            'password'          => 'required|min:8',
            'role'              => 'required'
        ]);

        if ($oValidator->fails()) {

            return redirect()->route('login')->withErrors($oValidator)->withInput();

        } else {

            if (Auth::attempt(['username' => $oRequest->input('username'), 'password' => $oRequest->input('password'), 'role' => $oRequest->input('role')])) {

                return redirect()->route('homeLogged');

            } else {

                return redirect()->route('login')->with('loginFailed','Login failed, please try again with correct details !');

            }
        }
    }

    public function registerGet()
    {
        return view('pages.register');
    }

    public function registerPost(Request $oRequest)
    {

        $oValidator =  Validator::make($oRequest->all(),[
            'role'              => 'required|in:citizen,lawyer',
            'firstName'         => 'required|min:3',
            'lastName'          => 'required|min:3',
            'username'          => 'required|min:4|unique:users',
            'email'             => 'required|email|unique:users',
            'password'          => 'required|min:8',
            'confirm-password'  => 'required|same:password'
        ]);

        if ($oValidator->fails()) {

            return redirect()->route('register')->withErrors($oValidator)->withInput();

        } else {

            $sPassword = Hash::make($oRequest->input('password'));

            $oInsertedUser = User::create([
                'username' => $oRequest->input('username'),
                'email'    =>$oRequest->input('email'),
                'role'     => $oRequest->input('role'),
                'password' => $sPassword
            ]);


            switch ($oInsertedUser->role) {

                case User::ROLE_CITIZEN:

                    Citizen::create([
                        'user_id' => $oInsertedUser->id,
                        'firstname' => $oRequest->input('firstName'),
                        'lastname' => $oRequest->input('lastName')
                    ]);

                    break;

                case User::ROLE_LAWYER:

                    Lawyer::create([
                        'user_id' => $oInsertedUser->id,
                        'firstname' => $oRequest->input('firstName'),
                        'lastname' => $oRequest->input('lastName')
                    ]);

                    break;

                default:

                    return redirect()->route('register')->withErrors($oValidator)->withInput();

            }

            return redirect()->route('login')->with('loginSuccess', 'Congratulations! Your registration was successful. You can now log in.');
        }
    }

    public function redirectToProfile()
    {

        switch (Auth::user()->getUserType()) {

            case User::ROLE_CITIZEN:
                return redirect()->route('citizenProfile');

                break;

            case User::ROLE_LAWYER:

                return redirect()->route('lawyerProfile');

                break;

            default:

                return redirect()->route('login');

        }

    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }

}
