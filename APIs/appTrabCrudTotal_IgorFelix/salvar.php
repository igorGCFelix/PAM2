<?php 
require_once("conexao.php");
$tabela = 'produtos';

$postjson = json_decode(file_get_contents('php://input'), true);

$nome = @$postjson['nome'];
$marca = @$postjson['marca'];
$preco = @$postjson['preco'];
$quantidade_estoque = @$postjson['quantidade_estoque'];
$descricao = @$postjson['descricao'];

$res = $pdo->prepare("INSERT INTO $tabela SET nome = :nome, marca = :marca, preco = :preco, quantidade_estoque = : quantidade_estoque, descricao = : descricao");	


$res->bindValue(":nome", "$nome");
$res->bindValue(":marca", "$marca");
$res->bindValue(":preco", "$preco");
$res->bindValue(":quantidade_estoque", "$quantidade_estoque");
$res->bindValue(":descricao", "$descricao");


$res->execute();

$result = json_encode(array('mensagem'=>'Salvo com sucesso!', 'sucesso'=>true));

echo $result;

?>