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
     *          response=400,
     *          description="Bad Requets",
     *      )
     *     )
     */
    public function index()
    {
        $produtos = Produto::with('marca')->get()->toArray();


        return array_reverse($produtos);
    }

    /**
     * @OA\Get(
     *      path="/api/produto/create",
     *      operationId="produto.create",
     *      tags={"Produtos"},
     *      summary="Get list of models for create produto",
     *      description="Returns list of create models",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Requets",
     *      )
     *     )
     */
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
     *      summary="Store new produto",
     *      description="Returns produto data",
     *      * @OA\RequestBody(
     *    required=true,
     *    description="Oasse as informações do produto",
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

        /**
     * @OA\Get(
     *      path="/api/produto/{produto}",
     *      operationId="produto.show",
     *      tags={"Produtos"},
     *      summary="Get produto information",
     *      description="Returns produto data",
     *      @OA\Parameter(
     *          name="produto",
     *          description="Produto id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      )
     * )
     */
    public function show($id)
    {
        $product = Produto::find($id);
        return response()->json($product);
    }
        /**
     * @OA\Put(
     *      path="/api/produto/{produto}",
     *      operationId="produto.update",
     *      tags={"Produtos"},
     *      summary="Update existing produto",
     *      description="Returns updated produto data",
     *      @OA\Parameter(
     *          name="produto",
     *          description="Produto id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *       @OA\RequestBody(
     *    required=true,
     *    description="Oasse as informações do produto",
     *    @OA\JsonContent(
     *       @OA\Property(property="nome", type="string", example="Update Freezer"),
     *       @OA\Property(property="descricao", type="string", example="Update texto longo"),
     *       @OA\Property(property="tensao", type="string", example="220v"),
     *       @OA\Property(property="marca_id", type="integer", example="1"),
     *    ),
     * ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      )
     * )
     */
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


    /**
     * @OA\Delete(
     *      path="/api/produto/{id}",
     *      operationId="produto.destroy",
     *      tags={"Produtos"},
     *      summary="Delete existing produto",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Produto id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad requets",
     *      )
     * )
     */
    public function destroy($id)
    {
        $produto = Produto::find($id);
        $produto->delete();
        return response()->json("Eletrodoméstico <" . $produto->nome . "> removido!");
    }
}
