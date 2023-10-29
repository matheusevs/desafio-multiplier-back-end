@extends('layouts.app')

@section('links')
@endSection

@section('content')
    <div class="container">
        <table id="cliente-table" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nome Fantasia</th>
                    <th>CNPJ</th>
                    <th>Endereço</th>
                    <th>Cidade</th>
                    <th>Estado</th>
                    <th>País</th>
                    <th>Telefone</th>
                    <th>E-mail</th>
                    <th>Área de Atuação | CNAE</th>
                    <th>Quadro Societário</th>
                    <th>Ações</th>
                </tr>
            </thead>
        </table>

        <div class="text-center">
            <button id="open" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#novoClienteModal">Novo Cliente</button>
        </div>
    </div>

    <div class="modal fade" id="novoClienteModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ModalLabel">Novo Cliente</h1>
                    <button type="button" id="fecharIcone" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <form id="form">
                    @csrf
                    <div class="modal-body">
                        <div>
                            <div class="mb-3">
                                <label class="form-label" for="nomeFantasia">Nome Fantasia</label>
                                <input class="form-control" type="text" id="nomeFantasia" name="nomeFantasia" placeholder="Digite o nome fantasia" maxlength="255" required/>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="cnpj">CNPJ</label>
                                <input class="form-control" type="text" id="cnpj" name="cnpj" placeholder="Digite seu CNPJ" maxlength="18" required/>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="endereco">Endereço</label>
                                <input class="form-control" type="text" id="endereco" name="endereco" placeholder="Digite seu endereço" maxlength="255" required/>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="cidade">Cidade</label>
                                <input class="form-control" type="text" id="cidade" name="cidade" placeholder="Digite sua cidade" maxlength="255" required/>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="estado">Estado/UF</label>
                                <input class="form-control" type="text" id="estado" name="estado" placeholder="Digite seu estado" maxlength="2" required/>
                                </div>
                            <div class="mb-3">
                                <label class="form-label" for="pais">País</label>
                                <input class="form-control" type="text" id="pais" name="pais" placeholder="Digite seu país" maxlength="255" required/>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="telefone">Telefone</label>
                                <input class="form-control" type="text" id="telefone" name="telefone" placeholder="Digite seu telefone" maxlength="15" required/>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input class="form-control" type="email" id="email" name="email" placeholder="Digite seu E-mail" required/>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="areaAtuacao">Área de Atuação | CNAE</label>
                                <input class="form-control" type="text" id="areaAtuacao" name="areaAtuacao" placeholder="Digite sua área de atuação" maxlength="255" required/>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="quadroSocietario">Quadro Societário</label>
                                <input class="form-control" type="text" id="quadroSocietario" name="quadroSocietario" placeholder="Digite seu quadro societário" maxlength="255"/>
                            </div>                           
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="fechar" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button id="save" type="submit" class="btn btn-primary">Salvar Cliente</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editarClienteModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-5" id="ModalLabel">Editar usuário</h5>
                    <button type="button" id="fecharIcone" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <form id="formEdit">
                    @csrf
                    <input type="hidden" id="id" name="id"/>
                    <div class="modal-body">
                        <div>
                            <div class="mb-3">
                                <label class="form-label" for="nomeFantasia">Nome Fantasia</label>
                                <input class="form-control" type="text" id="nomeFantasiaEditar" name="nomeFantasia" placeholder="Digite o nome fantasia" maxlength="255" required/>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="cnpj">CNPJ</label>
                                <input class="form-control" type="text" id="cnpjEditar" name="cnpj" placeholder="Digite seu CNPJ" maxlength="18" required/>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="endereco">Endereço</label>
                                <input class="form-control" type="text" id="enderecoEditar" name="endereco" placeholder="Digite seu endereço" maxlength="255" required/>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="cidade">Cidade</label>
                                <input class="form-control" type="text" id="cidadeEditar" name="cidade" placeholder="Digite sua cidade" maxlength="255" required/>
                            </div>
                            <div class "mb-3">
                                <label class="form-label" for="estado">Estado/UF</label>
                                <input class="form-control" type="text" id="estadoEditar" name="estado" placeholder="Digite seu estado" maxlength="2" required/>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="pais">País</label>
                                <input class="form-control" type="text" id="paisEditar" name="pais" placeholder="Digite seu país" maxlength="255" required/>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="telefone">Telefone</label>
                                <input class="form-control" type="text" id="telefoneEditar" name="telefone" placeholder="Digite seu telefone" maxlength="15" required/>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input class="form-control" type="email" id="emailEditar" name="email" placeholder="Digite seu E-mail" required/>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="areaAtuacao">Área de Atuação | CNAE</label>
                                <input class="form-control" type="text" id="areaAtuacaoEditar" name="areaAtuacao" placeholder="Digite sua área de atuação" maxlength="255" required/>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="quadroSocietario">Quadro Societário</label>
                                <input class="form-control" type="text" id="quadroSocietarioEditar" name="quadroSocietario" placeholder="Digite seu quadro societário" maxlength="255"/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="fecharEditar" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button id="save" type="submit" class="btn btn-primary">Salvar Cliente</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Confirmação de exclusão</h5>
                    <button type="button" id="fecharIcone" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    Tem certeza que deseja excluir esse usuário?
                </div>
                <div class="modal-footer">
                    <form id="formDelete" style="display: inline;">
                        @csrf
                        <button type="button" id="fecharDeletar" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button id="btn-confirm-delete" class="btn btn-danger">Excluir</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
