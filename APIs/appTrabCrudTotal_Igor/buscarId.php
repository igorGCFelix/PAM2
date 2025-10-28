<?php 

include_once('conexao.php');

$id = $_GET['id'];

$query = $pdo->query("SELECT * from produtos where id = '$id'");

 $res = $query->fetchAll(PDO::FETCH_ASSOC);

 	for ($i=0; $i < count($res); $i++) { 
      foreach ($res[$i] as $key => $value) {
      }
 		
    $id = $res[$i]['id'];
    $nome = $res[$i]['nome'];
    $preco = $res[$i]['preco'];
    $quantidade_estoque = $res[$i]['quantidade_estoque'];
    $marca = $res[$i]['marca'];
    $validade = $res[$i]['validade'];


 		}

        if(count($res) > 0){
                $result = json_encode(array('success'=>true, 'id'=>$id, 'nome'=>$nome, 'preco'=>$preco, 'quantidade_estoque'=>$quantidade_estoque, 'marca'=>$marca,'validade'=>$validade));

            }else{
                $result = json_encode(array('success'=>false, 'result'=>'0'));

            }
            echo $result;

 ?>