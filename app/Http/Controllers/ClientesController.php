<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use GuzzleHttp\Client;
use App\Http\Requests\ClientesRequest;
use Illuminate\Support\Facades\Cache;
use Exception;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ClientesController extends Controller
{
    public function index()
    {

        $clientes = Cache::remember('clientes_all', 60, function () {
            return Clientes::all();
        });

        return response()->json(['data' => $clientes]);


    }

    public function store(ClientesRequest $request)
    {
        
        try{

            $cliente = new Clientes();

            foreach ($request->all() as $key => $value) {

                if($key != '_token'){

                    $cliente[$key] = $value;
                
                }
                
            }

            $cnpj = $this->validateCnpj($cliente['cnpj']);
            if($cnpj['error']){
                return response()->json([
                    'message' => $cnpj['message'],
                ], 404);
            }

            $cliente->save();
            Cache::forget('clientes_all');

            return response()->json([
                'message' => 'Cliente criado'
            ], 200);

        } catch (Exception $e){

            return response()->json([
                'message' => $e->getMessage(),
            ], 422);

        }

    }

    public function edit($id)
    {

        try{

            if (!$id) {
                return response()->json([
                    'message' => 'ID do cliente não informado!',
                ], 403);
            }

            $cliente = Clientes::FindOrFail($id);

            return response()->json([
                'dados' => $cliente
            ], 200);

        } catch(Exception $e) {

            return response()->json([
                'message' => $e->getMessage(),
            ], 422);
        }

    }

    public function update(ClientesRequest $request)
    {

        try{
            
            if (!$request->id) {
                return response()->json([
                    'message' => 'ID do cliente não informado!',
                ], 403);
            }

            $cnpj = $this->validateCnpj($request->cnpj);
            if($cnpj['error']){
                return response()->json([
                    'message' => $cnpj['message'],
                ], 404);
            }

            Clientes::FindOrFail($request->id)->update($request->all());
            Cache::forget('clientes_all');

            return response()->json([
                'message' => 'Cliente editado com sucesso',
            ], 200);

        } catch(Exception $e) {

            return response()->json([
                'message' => $e->getMessage(),
            ], 422);

        }

    }

    public function destroy($id)
    {
        
        try{

            if (!$id) {
                return response()->json([
                    'message' => 'ID do cliente não informado!',
                ], 403);
            }
            
            Clientes::FindOrFail($id)->delete();
            Cache::forget('clientes_all');

            return response()->json([
                'dados' => 'Cliente deletado com sucesso',
            ], 200);

        } catch(Exception $e) {

            return response()->json([
                'message' => $e->getMessage(),
            ], 422);
        }

    }

    public function validateCnpj($cnpj)
    {

        $cnpjFormat = preg_replace("/[^0-9]/", "", $cnpj);

        try {

            $response = Http::get("https://brasilapi.com.br/api/cnpj/v1/$cnpjFormat")->json();

            if(isset($response['type'])){
                return [
                    'error' => true,
                    'message' => $response['message'],
                ];
            } else {
                return [
                    'error' => false,
                    'message' => $response,
                ];
            }


        } catch (Exception $e) {
            return [
                'error' => true,
                'message' => $response['message'],
            ];
            
        }

    }

}