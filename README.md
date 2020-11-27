<p align="center"><img height="150px" widht="200px" src="https://miro.medium.com/max/1292/1*y5_uGkNdD6h6pN2aU1RPGw.png"></p>

## :computer: Projeto

O projeto consiste em criar uma API com autenticação, utilizando como base a estrutura MVC.

### :heavy_check_mark: Requisitos 

Para o funcionamento do projeto, será necessário:

- composer / laravel
  
### :rocket: Tecnologias

- <a href="https://laravel.com/docs/5.4">Laravel Framework 5.4.36</a>

<p align="center">
  <img height="100px" widht="100px" src="https://laravel.com/assets/img/components/logo-laravel.svg">
</p>

### :mega: Utilização 

1. Entrar na pasta raiz do projeto.
2. Edite o arquivo `.env` para o seu banco de dados.
3. Rode o comando `composer install`.
4. Após o passo anterior terminar, execute o comando `php artisan serve` para rodar o seu projeto no seu computador.
5. Em outro cmd, execute `php artisan route:list` para visualizar todas as URLs.

### :newspaper: Documentação

#### API URIs

<details hidden>
  <summary>:hamster: Animal</summary>

  > [Listar todos os Animais](documentation/animal_by_id.md) <br>
  > Listar todos os Animais - por Ordem Alfabética <br>
  > Listar todos os Animais - por Ordem de Raça <br>
  > Atualizar Animal <br> 
  > Deletar Animal <br> 
  > Criar Animal <br>

</details>

<details hidden>
  <summary>:family: Cliente</summary>
  
  > Listar todos os Clientes <br>
  > Listar todos os Clientes - por Ordem Alfabética <br>
  > Listar todos os Clientes - por Ordem de Idade <br>
  > Atualizar Cliente <br> 
  > Deletar Cliente <br> 
  > Criar Cliente <br>
  
</details>

<details hidden>
  <summary>:lock: Usuário</summary>
  
  > Login <br> 
  > Registrar Usuário <br>
  
</details>

#### Autenticação

- <a href="https://laravel.com/docs/5.0/session#session-usage">Laravel Session Facade</a>

Para acessar algumas URIs, é necessário que o usuário esteja autenticado e esteja cadastrado como administrador.

---

<p align="center">
  <a href="https://github.com/thrnkk" ><img src="https://img.shields.io/badge/github-thrnkk-24292e"></a>
</p>
