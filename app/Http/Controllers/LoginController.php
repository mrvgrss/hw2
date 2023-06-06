<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Request;
use Session;
use App\Models\User;



class LoginController extends BaseController
{
    public function register_form(){
        if(Session::has('user_id')){
            return redirect('home');
        }
        return view('register');
    }
    public function login_form(){
        if(Session::has('user_id')){
            return redirect('home');
        }
        return view('login');
    }
    public function do_logout(){
        Session::flush();
        return redirect('home');
    }
    public function do_register(){
        if(Session::has('user_id')){
            return redirect('home');
        }

        $error = array();

        if(!empty(Request::get('name')) && !empty(Request::get('surname')) && !empty(Request::get('email')) && !empty(Request::get('password')) && !empty(Request::get('confirmpassword'))){
            $name = Request::get('name');
            $surname = Request::get('surname');
            $email = Request::get('email');
            $password = Request::get('password');
            $confirmpassword = Request::get('confirmpassword');

            if(strlen($name) > 20 || preg_match('/[0-9\W]/', $name) || $name == ''){
                $error[] = "Nome invalido, max 20 car no caratteri speciali";
            }
            if(strlen($surname) > 20 || preg_match('/[0-9\W]/', $surname) || $surname == ''){
                $error[] = "Cognome invalido, max 20 car no caratteri speciali";
            }
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $error[] = "Email non valida";
            }else{
                if(User::where('email', $email)->first())
                {
                    $error['email'] = "Email già utilizzata";
                }
            }
            if(strlen($password) < 8){
                $error[] = "Password troppo corta, min 8 caratteri";
            }
            if(strcmp($password, $confirmpassword) != 0){
                $error[] = "Le password non coincidono";
            }

            if(count($error) == 0){
                $password = password_hash($password, PASSWORD_DEFAULT);
                $user = new User;
                $user->name = $name;
                $user->surname = $surname;
                $user->email = $email;
                $user->password = $password;
                $user->save();
                Session::put('user_id', $user->id);
                Session::put('name', $user->name);
                return redirect('home');
            }

        }else{
            $error[] = "Campo mancante";
        }
        return redirect('register')->withInput()->withErrors($error);
    }
    public function do_login(){
        if(Session::has('user_id')){
            return redirect('home');
        }
        $error = array();
        $user = null;
        if(!empty(Request::get('email')) && !empty(Request::get('password'))){
            $email = Request::get('email');
            $password = Request::get('password');
            $user = User::where('email', $email)->first();
            if(!$user){
                $error[] = "Credenziali non valide";
            } else {
                if(!password_verify($password, $user->password)){
                    $error[] = "Password errata";
                }
            }
        } else {
            $error[] = "Inserisci username e password";
        }
        if(count($error) == 0){
            Session::put('user_id', $user->id);
            Session::put('name', $user->name);
            return redirect('home');
        }else{
            return redirect('login')->withInput()->withErrors($error);
        }
    }
}
