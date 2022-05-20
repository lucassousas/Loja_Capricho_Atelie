<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutoController extends Controller
{
    public function index()
    {
        $produto = new Produto();
        $produtos = Produto::All();
        return view("produto.index", [
            "produto" => $produto,
            "produtos" => $produtos
        ]);
    }

    public function store(Request $request)
    {
        if($request->get("id") != ""){     //checa se o id já existe (se já tem produto)
            $produto = Produto::Find($request->get("id")); //busca o produto pelo id 
        } else {
            $produto = new Produto();   //Cria o novo
        }
        $produto->descricao = $request->get("descricao");
        $produto->preco = $request->get("preco");
        $produto->save();
        $request->session()->flash("status", "salvo");
        return redirect("/produto");
    }

    public function edit($id)
    {
        $produto = Produto::Find($id); //Busca o produto selecionado pelo id
        $produtos = Produto::All();     //lista todos e retorna a index com o dictionary
        return view("produto.index", [  //retorna o dictionary
            "produto" => $produto,
            "produtos" => $produtos
        ]);
    }

    public function destroy($id, Request $request)
    {
        Produto::destroy($id);  //Destroi pelo id
        $request->sessio()->flash("status", "excluído");    //sessão de status excluído
        return redirect("/produto");
    }
}
