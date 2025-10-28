<?php 

include_once('conexao.php');

$postjson = json_decode(file_get_contents('php://input'), true);


$query = $pdo->prepare("SELECT * from produtos");

$query->execute();

$res = $query->fetchAll(PDO::FETCH_ASSOC);

for ($i=0; $i < count($res); $i++) { 
    foreach ($res[$i] as $key => $value) {  }      

    $dados[] = array(
        'id' => $res[$i]['id'],
        'nome' => $res[$i]['nome'],
        'preco' => $res[$i]['preco'],      
        'quantidade_estoque' => $res[$i]['quantidade_estoque'],  
        'marca' => $res[$i]['marca'],  
        'validade' => $res[$i]['validade'],  
       
                         
    );

    }

   if(count($res) > 0){
           $result = json_encode(array('success'=>true, 'result'=>$dados));

       }else{
           $result = json_encode(array('success'=>false, 'result'=>'0'));

       }

echo $result;

?>