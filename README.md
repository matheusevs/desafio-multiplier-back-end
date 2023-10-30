<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# Instalação

Clonar o projeto
```
git clone https://github.com/matheusevs/desafio-multiplier-back-end.git
```
Entrar no projeto
```
cd desafio-multiplier-back-end/
```
Criar os arquivos .env
```
cp .env.example .env
```
Rodar comando para inicialização do docker
```
docker compose up --build
```
Abra outro terminal e rode o comando para a criação do banco de dados via docker
```
docker compose run --rm multiplier php artisan migrate
```
Criação dos dados para população do ambiente via docker
```
ocker compose run --rm multiplier php artisan db:seed --class=ClientesTableSeeder
```
Após rodar todos os comandos, acesse a url [localhost:81](http://localhost:81) para ter acesso a aplicação

# Documentação da API

Esta documentação descreve as rotas e endpoints da API do projeto.

## Segurança da API

- Todas as rotas da API do projeto requerem um token CSRF (Cross-Site Request Forgery) para autenticação. O token CSRF é uma medida de segurança para proteger contra ataques de falsificação de solicitação entre sites. Certifique-se de incluir o token CSRF válido em todas as suas solicitações para as rotas da API.

**Exemplo de uso do token CSRF em uma solicitação:**

```js
{
    headers: {
        'X-CSRF-TOKEN': form._token
    }
}
```

## Rotas

### Listar Clientes

- **Endpoint:** `/cliente`
- **Método:** GET
- **Descrição:** Esta rota lista todos os clientes cadastrados no sistema.

**Exemplo de Resposta de Sucesso:**

```json
{
    "data": [
        {
            "id": 1,
            "nomeFantasia": "Empresa A",
            "cnpj": "00.000.000/0001-01",
            "endereco": "Rua A, 123",
            "cidade": "Cidade A",
            "estado": "UF",
            "pais": "Brasil",
            "telefone": "(11) 1234-5678",
            "email": "empresa@example.com",
            "areaAtuacao": "Tecnologia",
            "quadroSocietario": "Sócio A, Sócio B"
        },
        {
            "id": 2,
            "nomeFantasia": "Empresa B",
            "cnpj": "00.000.000/0001-02",
            "endereco": "Rua B, 456",
            "cidade": "Cidade B",
            "estado": "UF",
            "pais": "Brasil",
            "telefone": "(22) 9876-5432",
            "email": "contato@empresaB.com",
            "areaAtuacao": "Serviços",
            "quadroSocietario": "Sócio C"
        }
    ]
}
```

### Criar Cliente

- **Endpoint:** `/cliente/create`
- **Método:** POST
- **Descrição:** Esta rota permite criar um novo cliente.

**Parâmetros de Requisição:**

- `nomeFantasia` (string, obrigatório): Nome fantasia da empresa.
- `cnpj` (string, obrigatório): CNPJ da empresa no formato "00.000.000/0001-01".
- `endereco` (string, obrigatório): Endereço da empresa.
- `cidade` (string, obrigatório): Cidade da empresa.
- `estado` (string, obrigatório): UF da empresa (ex: "SP").
- `pais` (string, obrigatório): País da empresa.
- `telefone` (string, obrigatório): Número de telefone da empresa no formato "(11) 1234-5678".
- `email` (string, obrigatório): Endereço de e-mail da empresa.
- `areaAtuacao` (string, obrigatório): Área de atuação da empresa.
- `quadroSocietario` (string): Informações sobre o quadro societário da empresa.

**Exemplo de Requisição:**

```json
{
    "nomeFantasia": "Nova Empresa",
    "cnpj": "00.000.000/0001-03",
    "endereco": "Rua C, 789",
    "cidade": "Cidade C",
    "estado": "UF",
    "pais": "Brasil",
    "telefone": "(33) 5555-5555",
    "email": "nova@empresa.com",
    "areaAtuacao": "Comércio",
    "quadroSocietario": "Sócio D"
}
```

**Exemplo de Resposta de Sucesso:**

```json
{
    "status": 200,
    "message": "Cliente criado"
}
```

**Exemplo de Resposta de Erro (CNPJ inválido):**

```json
{
    "status": 404,
    "message": "CNPJ inválido"
}
```

### Atualizar Cliente

- **Endpoint:** `/cliente/edit/{id}`
- **Método:** PUT
- **Descrição:** Esta rota permite atualizar as informações de um cliente existente com base em seu ID.

**Parâmetros de Requisição:**

- `id ` (integer, obrigatório): ID do cliente a ser editado.

**Exemplo de Requisição:**

```json
{
    "id": 1,
    "nomeFantasia": "Empresa Editada",
    // Outros parâmetros editados
}
```

**Exemplo de Resposta de Sucesso:**

```json
{
    "status": 200,
    "message": "Cliente editado com sucesso"
}
```

**Exemplo de Resposta de Erro (CNPJ inválido):**

```json
{
    "status": 404,
    "message": "CNPJ inválido"
}
```

**Exemplo de Resposta de Erro (ID de cliente não informado):**

```json
{
    "error": true,
    "message": "ID do cliente não informado"
}
```

### Deletar Cliente

- **Endpoint:** `/cliente/delete/{id}`
- **Método:** DELETE
- **Descrição:** Esta rota permite excluir um cliente existente com base em seu ID.

**Parâmetros de Requisição:**

- `id ` (integer, obrigatório): ID do cliente a ser excluído.

**Exemplo de Requisição:**

```json
{
    "id": 1
}
```

**Exemplo de Resposta de Sucesso:**

```json
{
    "status": 200,
    "message": "Cliente deletado com sucesso"
}
```

**Exemplo de Resposta de Erro (ID de cliente não informado):**

```json
{
    "status": 403,
    "message": "ID do cliente não informado"
}
```
