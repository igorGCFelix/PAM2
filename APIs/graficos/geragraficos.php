<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$host = "localhost";
$user = "root";
$pass = "";
$db = "graficosbd";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die(json_encode(["erro" => "Falha na conexão"]));
}

$sql = "SELECT nome, quantidade FROM produtos";
$result = $conn->query($sql);

$dados = [];
while ($row = $result->fetch_assoc()) {
    $dados[] = $row;
}

echo json_encode($dados);
$conn->close();
?>
