<?php 

include_once('conexao.php');

$postjson = json_decode(file_get_contents("php://input"), true);

 $query = $pdo->prepare("UPDATE produtos SET nome = :nome, marca = :marca, preco = :preco, quantidade_estoque = :quantidade_estoque, descricao = :descricao WHERE id = :id ");
  
       $query->bindValue(":nome", $postjson['nome']); 
       $query->bindValue(":marca", $postjson['marca']);
       $query->bindValue(":preco", $postjson['preco']);
       $query->bindValue(":quantidade_estoque", $postjson['quantidade_estoque']);
       $query->bindValue(":descricao", $postjson['descricao']);
       $query->bindValue(":id", $postjson['id']);
      
       $query->execute();
  
             
  
      if($query){
        $result = json_encode(array('success'=>true));
  
        }else{
        $result = json_encode(array('success'=>false));
    
        }
     echo $result;


?>

