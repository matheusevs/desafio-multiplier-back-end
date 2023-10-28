<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use GuzzleHttp\Client;
use App\Http\Requests\ClientesRequest;
use Illuminate\Support\Facades\Cache;
use Exception;

use Illuminate\Http\Request;

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
            $cnpjDecode = json_decode($cnpj, true);
            if($cnpjDecode['error']){
                return response()->json([
                    'message' => $cnpjDecode['message'],
                ], 404);
            }

            $estado = $this->validateUF($cliente['estado']);
            $estadoDecode = json_decode($estado, true);
            if($estadoDecode['error']){
                return response()->json([
                    'message' => $estadoDecode['message'],
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
            $cnpjDecode = json_decode($cnpj, true);
            if($cnpjDecode['error']){
                return response()->json([
                    'message' => $cnpjDecode['message'],
                ], 404);
            }

            $estado = $this->validateUF($request->estado);
            $estadoDecode = json_decode($estado, true);
            if($estadoDecode['error']){
                return response()->json([
                    'message' => $estadoDecode['message'],
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
        $client = new Client();
        $url = "https://brasilapi.com.br/api/cnpj/v1/$cnpjFormat";

        try {

            $response = $client->request('GET', $url);
            $data = json_decode($response->getBody());
            return json_encode([
                'error' => false,
                'message' => $data,
            ]);

        } catch (Exception $e) {
            return json_encode([
                'error' => true,
                'message' => 'CNPJ inválido',
            ]);
            
        }

    }

    public function validateUF($estado)
    {

        $client = new Client();
        $url = "https://servicodados.ibge.gov.br/api/v1/localidades/estados";

        try {

            $response = $client->request('GET', $url);
            $data = json_decode($response->getBody());

            foreach($data as $uf){
                if($uf->sigla == strtoupper($estado)){
                    return json_encode([
                        'error' => false,
                        'message' => 'UF válida!',
                    ]);
                }
            }

            return json_encode([
                'error' => true,
                'message' => 'UF inválida!',
            ]);

        } catch (Exception $e) {
            return json_encode([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
            
        }

    }

}