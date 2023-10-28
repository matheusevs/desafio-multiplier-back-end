<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Multiplier') }}</title>

    <!-- Styles -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/clientes.js')}}" defer></script>

</head>
<body>
    <div id="app">

        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Multiplier') }}
                </a>
            </div>
        </nav>

        <main class="py-4">
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
        </main>
    </div>
</body>
</html>