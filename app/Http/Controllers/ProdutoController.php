<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Marca;
use App\Models\Produto;
use Illuminate\Support\Facades\Validator;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::with('marca')->get()->toArray();


        return array_reverse($produtos);
    }
    public function create()
    {
        $marcas = Marca::all();
        return response()->json($marcas);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:256',
            "descricao" => 'required|string',
            "tensao" => 'required|string|max:256',
            "marca_id" => 'required|exists:App\Models\Marca,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        };

        Produto::create($request->all());
        return response()->json('Eletodoméstico criado!');
    }

    public function show($id)
    {
        $product = Produto::find($id);
        return response()->json($product);
    }
    public function update($id, Request $request)
    {
        $produto = Produto::find($id);
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:256',
            "descricao" => 'required|string',
            "tensao" => 'required|string|max:256',
            "marca_id" => 'required|exists:App\Models\Marca,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        };
        $produto->update($request->all());
        return response()->json('Eletodoméstico atualizado!');
    }
    public function destroy($id)
    {
        $produto = Produto::find($id);
        $produto->delete();
        return response()->json("Eletodoméstico <" . $produto->nome . "> removido!");
    }
}
