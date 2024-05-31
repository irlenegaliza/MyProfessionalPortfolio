<?php

// Tratando os dados do formulário de contato do meu portfolio
$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$mensagem = $_POST['mensagem'];
$data_atual = date('d/m/Y');
$hora_atual = date('H:i:s');

// Configurações de credenciais
$server = 'localhost';
$usuario = 'root';
$senha = '';
$bancoDados = 'formulario_portfolio';

// Conexão com a Base de Dados 
$conn = new mysqli($server, $usuario, $senha, $bancoDados);

// Verificando a conexão
if($conn->connect_error){
    die("Falha ao se comunicar com a base de dados: ".$conn->connect_error);
}

// Colocando nas colunas os valores correspondentes aos dados coletados
$smtp = $conn->prepare("INSERT INTO mensagens (nome, telemovel, email, mensagem, data, hora) VALUES (?,?,?,?,?,?)");
$smtp->bind_param("sissss", $nome, $telefone, $email, $mensagem, $data_atual, $hora_atual);

if($smtp->execute()){
    echo "Mensagem enviada com sucesso!";
}
else {
    echo "Erro no envio da mensagem: ".$smtp->error;
}

$smtp->close();
$conn->close();

?>