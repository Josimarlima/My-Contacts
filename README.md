<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
</head>
<body>

<h1>My Contacts</h1>

<p>
    My Contacts é uma aplicação web simples de gerenciamento de contatos desenvolvida em PHP. Os usuários podem criar, visualizar, atualizar e excluir contatos, tornando-se uma ferramenta útil para organizar e gerenciar suas informações de contato pessoais e profissionais. A aplicação consulta uma API externa para obter dados adicionais sobre os contatos.
</p>

<h2>Tecnologias utilizadas</h2>

<ul>
    <li>PHP 7.x</li>
    <li>MySQL</li>
    <li>HTML, CSS e JavaScript</li>
    <li>API externa para consulta de dados adicionais</li>
</ul>

<h2>Requisitos</h2>

<ul>
    <li>PHP 7.x ou superior</li>
    <li>Servidor Web (Apache, Nginx, etc.)</li>
    <li>MySQL</li>
    <li>Chave de API para acesso à API externa (se necessário)</li>
</ul>

<h2>Instalação</h2>

<ol>
    <li>Clone o repositório:</li>
    <pre><code>git clone https://github.com/Josimarlima/My-Contacts.git</code></pre>
    <li>Navegue até a pasta do projeto:</li>
    <pre><code>cd My-Contacts</code></pre>
    <li>Crie um banco de dados MySQL e importe o arquivo <code>database.sql</code> para criar as tabelas necessárias.</li>
    <li>Configure a conexão do banco de dados, atualizando as informações de conexão no arquivo <code>config.php</code>.</li>
    <li>Insira sua chave de API para acessar a API externa no arquivo de configuração apropriado (se necessário).</li>
    <li>Configure seu servidor web para apontar para a pasta <code>public</code> como o diretório raiz da aplicação.</li>
    <li>Acesse a aplicação no navegador utilizando a URL configurada para o servidor web.</li>
</ol>

<h2>Funcionalidades</h2>

<ul>
    <li>Adicionar novo contato</li>
    <li>Editar contatos existentes</li>
    <li>Excluir contatos</li>
    <li>Consultar API externa para obter dados adicionais sobre os contatos</li>

</ul>
<h2>Contribuindo</h2>
<p>
    Contribuições são sempre bem-vindas! Sinta-se à vontade para enviar um Pull Request para propor melhorias ou corrigir problemas.
</p>
<h2>Licença</h2>
<p>
    Este projeto é licenciado sob a licença MIT - consulte o arquivo <a href="LICENSE">LICENSE</a> para obter detalhes.
</p>
</body>
</html>
