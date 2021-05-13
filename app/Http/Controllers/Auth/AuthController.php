<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Laravel\Passport\Client;

class AuthController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function authenticate(Request $request){
        if(!isset($request->email) || !isset($request->senha)){
            abort(400, 'Dados inválidos');
        }
        
        $usuario = Usuario::where('email', $request->email)->first();

        $tokenRequest = $request->create('/oauth/token', 'post');

        $client = Client::where('provider', 'users')->first();

        $tokenRequest->request->add([
            'grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'username' => $request->email,
            'password' => $request->senha
        ]);

        return app()->handle($tokenRequest);
    }

    public function logado(){
        $usuarioLogado = Usuario::where('id', auth()->user()->id)->first();

        return response()->json($usuarioLogado, 200);
    }
}
