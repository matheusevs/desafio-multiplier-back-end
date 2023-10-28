$(function () {

    let inputCnpj = document.getElementById('cnpj');
    let inputCnpjEditar = document.getElementById('cnpjEditar');
    let inputTelefone = document.getElementById('telefone');
    let inputTelefoneEditar = document.getElementById('telefoneEditar');


    let tabela = $('#cliente-table').DataTable({
        ajax: {
            url: '/cliente'
        }, 
        columns: [
            {data: 'id'},
            {data: 'nomeFantasia'},
            {data: 'cnpj'},
            {data: 'endereco'},
            {data: 'cidade'},
            {data: 'estado'},
            {data: 'pais'},
            {data: 'telefone'},
            {data: 'email'},
            {data: 'areaAtuacao'},
            {data: 'quadroSocietario'},
            {data: null,  render: function (data, type, row) {
                return `
                    <div class="btn-group btn-group-sm" role="group">
                        <button class="btn btn-primary btn-edit" value="${data.id}" data-bs-toggle="modal" data-bs-target="#editarClienteModal">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-danger btn-delete" value="${data.id}" data-bs-toggle="modal" data-bs-target="#confirm-delete">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                    `;
                }
            },
        ],
        oLanguage: {
            sProcessing:   "Processando...",
            sLengthMenu:   "Mostrar _MENU_ registros",
            sZeroRecords:  "Não foram encontrados resultados",
            sInfo:         "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            sInfoEmpty:    "Mostrando de 0 até 0 de 0 registros",
            sInfoFiltered: "",
            sInfoPostFix:  "",
            sSearch:       "Buscar:",
            sUrl:          "",
            oPaginate: {
                sFirst:    "Primeiro",
                sPrevious: "Anterior",
                sNext:     "Seguinte",
                sLast:     "Último"
            }
        },
        order: [[0, 'desc']],
    });

    $("#form").on("submit", event => {

        event.preventDefault();

        const formulario = document.getElementById("form");
        const formData = new FormData(formulario);
        const form = Object.fromEntries(new URLSearchParams(formData).entries());

        let data = JSON.stringify(getData(form));
    
        $.ajax({
            type: "post",
            url: "/cliente/create",
            data: data,
            headers: {
                'X-CSRF-TOKEN': form._token
            },
            dataType: 'json',
            contentType: 'application/json',
            success: res => {

                $("#fechar").click();
                toastr.success(res.message,'Sucesso!');
                tabela.ajax.reload();

            },
            error: error => {

                if(error.responseJSON.errors){
                    const primeiraChave = Object.keys(error.responseJSON.errors)[0];
                    const mensagem = error.responseJSON.errors[primeiraChave];
    
                    toastr.error(mensagem,'Erro!');
                } else {
                    toastr.error(error.responseJSON.message,'Erro!');
                }

            }

        });

    });

    $(document).on('click', '.btn-edit', function() {
        
        let id = $(this).val();

        $.ajax({
            type: "get",
            url: `/cliente/edit/${id}`,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            contentType: 'application/json',
            success: res => {

                if(!res.error){

                    $('#id').val(res.dados.id);
                    $('#nomeFantasiaEditar').val(res.dados.nomeFantasia);
                    $('#cnpjEditar').val(res.dados.cnpj);
                    $('#enderecoEditar').val(res.dados.endereco);
                    $('#cidadeEditar').val(res.dados.cidade);
                    $('#estadoEditar').val(res.dados.estado);
                    $('#paisEditar').val(res.dados.pais);
                    $('#telefoneEditar').val(res.dados.telefone);
                    $('#emailEditar').val(res.dados.email);
                    $('#areaAtuacaoEditar').val(res.dados.areaAtuacao);
                    $('#quadroSocietarioEditar').val(res.dados.quadroSocietario);

                } else {

                    toastr.error(res.message,'Erro!');

                }
            }

        });
        
    });

    $("#formEdit").on("submit", event => {

        event.preventDefault();

        const formulario = document.getElementById("formEdit");
        const formData = new FormData(formulario);
        const form = Object.fromEntries(new URLSearchParams(formData).entries());

        let data = JSON.stringify(getData(form));
        let id = $('#id').val();
    
        $.ajax({
            type: "put",
            url: `/cliente/edit/${id}`,
            headers: {
                'X-CSRF-TOKEN': form._token
            },
            data: data,
            dataType: 'json',
            contentType: 'application/json',
            success: res => {
                
                $("#fecharEditar").click();
                toastr.success(res.message,'Sucesso!');
                tabela.ajax.reload();

            },
            error: error => {

                if(error.responseJSON.errors){
                    const primeiraChave = Object.keys(error.responseJSON.errors)[0];
                    const mensagem = error.responseJSON.errors[primeiraChave];
    
                    toastr.error(mensagem,'Erro!');
                } else {
                    toastr.error(error.responseJSON.message,'Erro!');
                }

            }

        });

    });

    $(document).on('click', '.btn-delete', function() {
        
        let id = $(this).val();
        let btnConfirmDelete = document.getElementById("btn-confirm-delete");
        btnConfirmDelete.setAttribute("data-id", id);
        
    });

    $("#formDelete").on("submit", event => {

        event.preventDefault();

        const formulario = document.getElementById("formDelete");
        const formData = new FormData(formulario);
        const form = Object.fromEntries(new URLSearchParams(formData).entries());
        let btnConfirmDelete = document.getElementById("btn-confirm-delete");
        let id = btnConfirmDelete.getAttribute("data-id");

        $.ajax({
            type: "delete",
            url: `/cliente/delete/${id}`,
            headers: {
                'X-CSRF-TOKEN': form._token
            },
            dataType: 'json',
            contentType: 'application/json',
            success: res => {

                toastr.success(res.message,'Sucesso!');
                $('#confirm-delete').modal('hide');
                tabela.ajax.reload();

            },
            error: error => {

                if(error.responseJSON.errors){
                    const primeiraChave = Object.keys(error.responseJSON.errors)[0];
                    const mensagem = error.responseJSON.errors[primeiraChave];
    
                    toastr.error(mensagem,'Erro!');
                } else {
                    toastr.error(error.responseJSON.message,'Erro!');
                }

            }

        });

    });    
    
    function getData(form){

        let data = {};
        let formInfo = Object.entries(form);

        formInfo.forEach(([key, value]) => {
                
            if(value){

                data[key] = value;
                
            }

        });

        return data;

    }

    function formatAndValidateCnpj(inputElement) {
        $(inputElement).on('input', function() {
            formatCnpj(this);
        });
    
        inputElement.onkeypress = function(event) {
            return apenasNumeros(event);
        };
    }
    
    function formatCnpj(input) {

        const value = input.value.replace(/\D/g, '');
        const maxLength = 14;
    
        if(value.length > maxLength){

            input.value = value.slice(0, maxLength);

        } else if(value.length === maxLength){

            input.value = value.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5");

        }

    }

    function apenasNumeros(event){

        let charCode = event.charCode ? event.charCode : event.keyCode;

        if(charCode < 48 || charCode > 57){

          return false;

        }

    }
    
    function formatTelefone(value){
        let formattedValue = '';
    
        if(value.length >= 2){
            formattedValue = `(${value.slice(0, 2)}`;
        }else if(value.length < 2){
            formattedValue = `(${value}`;
        }
    
        if(value.length > 2){
            formattedValue += `) ${value.slice(2, 7)}`;
        } else if (value.length <= 2 && value.length > 0) {
            formattedValue += `) ${value.slice(2)}`;
        }
    
        if(value.length > 7){
            formattedValue += `-${value.slice(7, 11)}`;
        }else if (value.length <= 7 && value.length > 2) {
            formattedValue += `-${value.slice(7)}`;
        }

        return formattedValue;
    }
    
    $("#fechar,#fecharIcone").on("click", event => {

        $('#nomeFantasia').val('');
        $('#cnpj').val('');
        $('#endereco').val('');
        $('#cidade').val('');
        $('#estado').val('');
        $('#pais').val('');
        $('#telefone').val('');
        $('#email').val('');
        $('#areaAtuacao').val('');
        $('#quadroSocietario').val('');

    });

    $("#fecharEditar,#fecharIconeEditar").on("click", event => {
        
        $('#nomeFantasiaEditar').val('');
        $('#cnpjEditar').val('');
        $('#enderecoEditar').val('');
        $('#cidadeEditar').val('');
        $('#estadoEditar').val('');
        $('#paisEditar').val('');
        $('#telefoneEditar').val('');
        $('#emailEditar').val('');
        $('#areaAtuacaoEditar').val('');
        $('#quadroSocietarioEditar').val('');
        
    });
  
    formatAndValidateCnpj('#cnpj');
    formatAndValidateCnpj('#cnpjEditar');
    formatAndValidateCnpj(inputCnpj);
    formatAndValidateCnpj(inputCnpjEditar);
    formatAndValidateCnpj(inputTelefoneEditar);
    formatAndValidateCnpj(inputTelefone);

    inputTelefone.addEventListener('input', function() {
        let value = this.value.replace(/\D/g, '');
        this.value = formatTelefone(value);
    });

    inputTelefoneEditar.addEventListener('input', function() {
        let value = this.value.replace(/\D/g, '');
        this.value = formatTelefone(value);
    });

});