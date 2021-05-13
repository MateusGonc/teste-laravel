<?php

namespace App\Http\Controllers;

use App\services\UsuarioServices\UsuarioService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{


    /** @var UsuarioService */
    protected $service;

    public function __construct(UsuarioService $service, Request $request)
    {
        $this->service = $service;
        parent::__construct($request);
    }

    public function create(){

        $validator = Validator::make($this->request->all(), [
            'nome' => 'required',
            'email' => 'required | email',
            'senha'=> 'required'
        ]);
        
        if(!$validator->fails()){
            $usuario = $this->service->Cadastro($this->request->all());
            return response()->json($usuario, 201);
        } else {
            $erros = $validator->errors();
            return response()->json($erros, 400);
        }

        
    }


}
