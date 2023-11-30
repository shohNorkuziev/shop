<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public $user_id;
    public $user_role;

    public function auth_user(){
      if(Auth::check())
      {
        $user= Auth::user();
        $this->user_id=$user->id;
        $this->user_role=$user->role;
      }
      else{
        $this->user_role='guest';
      }
    }

    public function index(){
      $this->auth_user();
      $data=(object)[
        'role'=>$this->user_role
      ];
      return view('layout.layouts')->with(['data'=>$data]);
    }

    public function info(){
      $this->auth_user();
      $data=(object)[
        'role'=>$this->user_role
      ];
      return view('layout.info')->with(['data'=>$data]);
    }

    public function create(){
      $this->auth_user();
      $data=(object)[
        'role'=>$this->user_role
      ];
      return view('auth.reg')->with(['data'=>$data]);
    }

    public function store(Request $request){
      $validator=Validator::make($request->all(),[
        'firstname'=>['required','alpha'],
        'lastname'=>['required','alpha'],
        'patronomyc'=>'nullable',
        'email'=>['email','unique:users'],
        'password'=>['required','min:6','confirmed'],
      ]);
      if($validator->fails()){
        return redirect()->route('create')->with('success','Ощибка регистрации');
      } 
      else{
        User::create([
          'password'=>Hash::make($request->password)
        ]+$request->all());
        return redirect()->route('login')->with('success','Регистрация прошла успешно');
      }     
    }
    public function login(){
      $this->auth_user();
      $data=(object)[
        'role'=>$this->user_role
      ];
      return view('auth.auth')->with(['data'=>$data]);
    }
    public function signup(Request $request){

      if(Auth::attempt($request->only(['email','password']))){
        return redirect()->route('index')->with('success','Вы авторизовались');
      };
    }
    public function logout(){
      if(Auth::check())
      {
        Auth::logout();
      }
      return redirect()->route('index');
    }
}
