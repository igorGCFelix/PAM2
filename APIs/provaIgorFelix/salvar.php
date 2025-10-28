<?php 
require_once("conexao.php");
// TROQUE O NOME DA SUA TABELA
$tabela = 'timefutebol';

$postjson = json_decode(file_get_contents('php://input'), true);


//COLOQUE O NOME DOS SEUS ATRIBUTOS
$nome = @$postjson['nome'];
$ano = @$postjson['ano'];
$num_torcedores = @$postjson['num_torcedores'];
$estadio = @$postjson['estadio'];

//TROQUE O NOME DOS ATRIBUTOS DA SUA TABELA DO BD
$res = $pdo->prepare("INSERT INTO $tabela SET nome = :nome,num_torcedores = :num_torcedores, estadio = :estadio, ano = :ano, ");	


$res->bindValue(":nome", "$nome");
$res->bindValue(":ano", "$ano");
$res->bindValue(":num_torcedores", "$num_torcedores");
$res->bindValue(":estadio", "$estadio");

$res->execute();

$result = json_encode(array('mensagem'=>'Salvo com sucesso!', 'sucesso'=>true));

echo $result;

?>