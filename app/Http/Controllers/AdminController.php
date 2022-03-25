<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Hash;
use Session;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AdminCadastraPerfil;

class AdminController extends Controller
{
    public function index(){
        //Verifica se o admin tem perfil cadastrado
        $admin_id = null;

        $emailUser = auth()->user()->email; 

        $admin = Admin::where('email','=',$emailUser)->get();

        foreach ($admin as $value) { 
            $admin_id    = $value->id;
        }

        if(!$admin_id){
            return redirect('/admin/perfil');
        }

    	return redirect('/bolsas/admin');
    }

    public function perfil(){
        $id = auth()->user()->id;
        $emailUser = auth()->user()->email;  

        return view('admin/cadastraPerfil', ['id' => $id, 'emailUser' => $emailUser]);
    }

    public function store(AdminCadastraPerfil $request, $id){ 

        $admin = new Admin;

        $admin->nome          = $request->nome;
        $admin->email         = $request->email;
        $admin->cpf           = $request->cpf;
        $admin->nascimento    = $request->nascimento;
        $admin->fone          = $request->fone;
        $admin->nacionalidade = $request->nacionalidade;
        
        $admin->user_id = $id;

        $admin->save();

        return redirect('/admin/home')->with('msg', 'Perfil atualizado com sucesso!');
    }

    public function register(){
    	return view('admin/registerAdm');
    }

    public function registration(Request $request){  
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("/admin/register2")->with('msg', 'Usuário cadastrado com sucesso!');
    }

    public function create(array $data){

        return User::create([
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'isAdmin' => 1,
        ]);
    }  

}
