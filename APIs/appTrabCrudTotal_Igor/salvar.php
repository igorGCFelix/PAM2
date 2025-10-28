<?php 
require_once("conexao.php");
$tabela = 'produtos';

$postjson = json_decode(file_get_contents('php://input'), true);

$nome = @$postjson['nome'];
$preco = @$postjson['preco'];
$quantidade_estoque = @$postjson['quantidade_estoque'];
$marca = @$postjson['marca'];
$validade = @$postjson['validade'];

$res = $pdo->prepare("INSERT INTO $tabela SET nome = :nome, preco = :preco, quantidade_estoque = :quantidade_estoque, marca = :marca, validade = :validade");	


$res->bindValue(":nome", "$nome");
$res->bindValue(":preco", "$preco");
$res->bindValue(":quantidade_estoque", "$quantidade_estoque");
$res->bindValue(":marca", "$marca");
$res->bindValue(":validade", "$validade");

$res->execute();

$result = json_encode(array('mensagem'=>'Salvo com sucesso!', 'sucesso'=>true));

echo $result;

?>