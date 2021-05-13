<?php 
namespace App\services\UsuarioServices;

use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuarioService{
    public function Cadastro(array $request){

        if(!isset($request['email']) || !isset($request['senha']) || !isset($request['nome'])){

        }

        $usuarioExistente = $this->EmailExistente($request['email']);

        if(isset($usuarioExistente)){
            abort(400, 'Esse email já foi cadastrado.');
        }

        $usuario = Usuario::create([
            'nome' => $request['nome'],
            'email' => $request['email'],
            'senha' => Hash::make($request['senha'])
        ]);
    
        return $usuario;
    }

    public function EmailExistente(string $email){
        $usuarioExistente = Usuario::where('email', $email)->first();

        return $usuarioExistente;
    }

    
}



