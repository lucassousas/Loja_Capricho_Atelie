<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    public function index()
    {
        $cliente = new Cliente();
        $clientes = Cliente::All();
        return view("cliente.index", [
            "cliente" => $cliente,
            "clientes" => $clientes
        ]);
    }

    public function store(Request $request) //A store cria os novos clientes
    {
        if($request->get("id") != ""){     //checa se o id já existe (se já tem cliente)
            $cliente = Cliente::Find($request->get("id")); //busca o cliente pelo id 
        } else {
            $cliente = new Cliente();   //cria o novo
        }
        $cliente->nome = $request->get("nome");
        $cliente->cpf = $request->get("cpf");
        $cliente->save();
        $request->session()->flash("status", "salvo");
        return redirect("/cliente");
    }

    public function edit($id)
    {
        $cliente = Cliente::Find($id); //Busca o cliente selecionado pelo id
        $clientes = Cliente::All();     //lista todos e retorna a index com o dictionary
        return view("cliente.index", [  //retorna o dictionary
            "cliente" => $cliente,
            "clientes" => $clientes
        ]);
    }

    public function destroy($id, Request $request)
    {
        Cliente::destroy($id);  //Destroi pelo id
        $request->sessio()->flash("status", "excluído");    //sessão de status excluído
        return redirect("/cliente");
    }
}
