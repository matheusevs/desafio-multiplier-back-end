<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nomeFantasia'      => "required|max:255",
            'cnpj'              => "required|unique:clientes,cnpj,$this->id|max:18",
            'endereco'          => "required|max:255",
            'cidade'            => "required|max:255",
            'estado'            => "required|max:2",
            'pais'              => "required|max:255",
            'telefone'          => "required|max:15",
            'email'             => "required|unique:clientes,email,$this->id|email|max:255",
            'areaAtuacao'       => "required|max:255",
            'quadroSocietario'  => "max:255"
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nomeFantasia.required'     => 'Nome Fantasia não informado!',
            'nomeFantasia.max'          => 'É permitido somente 255 caracteres no campo Nome Fantasia!',
            'cnpj.required'             => 'CNPJ não informado!',
            'cnpj.unique'               => 'O CNPJ já está cadastrado no sistema!',
            'cnpj.max'                  => 'É permitido somente 18 caracteres no campo CNPJ!',
            'endereco.required'         => 'Endereço não informado!',
            'endereco.max'              => 'É permitido somente 255 caracteres no campo Endereço!',
            'cidade.required'           => 'Cidade não informado!',
            'cidade.max'                => 'É permitido somente 255 caracteres no campo Cidade!',
            'estado.required'           => 'Estado não informado!',
            'estado.max'                => 'É permitido somente 2 caracteres no campo Estado!',
            'pais.required'             => 'País não informado!',
            'pais.max'                  => 'É permitido somente 255 caracteres no campo País!',
            'telefone.required'         => 'Telefone não informado!',
            'telefone.max'              => 'É permitido somente 15 caracteres no campo Telefone!',
            'email.required'            => 'E-mail não informado!',
            'email.unique'              => 'O E-mail já está cadastrado no sistema!',
            'email.email'               => 'Informe um e-mail válido!',
            'email.max'                  => 'É permitido somente 255 caracteres no campo E-mail!',
            'areaAtuacao.required'      => 'Área de atuação não informado!',
            'areaAtuacao.max'           => 'É permitido somente 255 caracteres no campo Área de Atuação!',
            'quadroSocietario.max'      => 'É permitido somente 255 caracteres no campo Quadro Societário!',
        ];
    }
}
