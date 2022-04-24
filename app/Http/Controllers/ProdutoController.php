<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Marca;
use App\Models\Produto;
use Illuminate\Support\Facades\Validator;

class ProdutoController extends Controller
{

    /**
     * @OA\Get(
     *      path="/api/produto",
     *      operationId="index",
     *      tags={"Produtos"},
     *      summary="Get list of produtos",
     *      description="Returns list of produtos",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
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

    /**
     * @OA\Post(
     *      path="/api/produto",
     *      operationId="produto.store",
     *      tags={"Produtos"},
     *      summary="Store new project",
     *      description="Returns project data",
     *      * @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     *    @OA\JsonContent(
     *       required={"nome"},
     *       @OA\Property(property="nome", type="string", example="Freezer"),
     *       @OA\Property(property="descricao", type="string", example="texto longo"),
     *       @OA\Property(property="tensao", type="string", example="220v"),
     *       @OA\Property(property="marca_id", type="integer", example="1"),
     *    ),
     * ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      )
     * )
     */
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
        return response()->json('Eletrodoméstico criado!');
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
        return response()->json('Eletrodoméstico atualizado!');
    }
    public function destroy($id)
    {
        $produto = Produto::find($id);
        $produto->delete();
        return response()->json("Eletrodoméstico <" . $produto->nome . "> removido!");
    }
}
