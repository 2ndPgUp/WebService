<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

$servername = "localhost";
$username = "root";
$password = "";
$database = "northwind";

try{
    $conn = new PDO("mysql:host=$servername;dbname=$database",
            $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo "Connection Failed : ".$e->getMessage();
}

$sql="SELECT * FROM customers";
$data=$conn->prepare($sql);
$data->execute();
$customers = [];
while($row=$data->fetch(PDO::FETCH_OBJ)){
    $customers[] = ["CustomerID"=>$row->CustomerID,
                    "CompanyName"=>$row->CompanyName,
                    "ContactName"=>$row->ContactName,
                    "ContactTitle"=>$row->ContactTitle,
                    "Address"=>$row->Address,
                    "City"=>$row->City];
}

$val = [
   "took" => 411.79,
   "code"=>200,
   "message"=>"Response succesfully",
   "data"=>$customers
];

$output = json_encode($val);
echo($output);

?>