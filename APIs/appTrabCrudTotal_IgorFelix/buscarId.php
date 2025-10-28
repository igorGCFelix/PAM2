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
    $marca = $res[$i]['marca'];
    $preco = $res[$i]['preco'];
    $quantidade_estoque = $res[$i]['quantidade_estoque'];
    $descricao = $res[$i]['descricao'];


 		}

        if(count($res) > 0){
                $result = json_encode(array('success'=>true, 'id'=>$id, 'nome'=>$nome, 'marca'=>$marca, 'preco'=>$preco, 'quantidade_estoque'=>$quantidade_estoque, 'descricao'=>$descricao));

            }else{
                $result = json_encode(array('success'=>false, 'result'=>'0'));

            }
            echo $result;

 ?>