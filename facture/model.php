<?php
class Database{
    //laison avec db
    public $host="mysql:dbname=crud_ajax";
    public $user="root";
    public $pswd="";
    //connexion à la base de donnée
    public function getConnection(){
    
try{
return new PDO($this->host,$this->user,$this->pswd);
}catch(PDOException $e){
   die('error:'.$e->getMessage()) ;
}
}
public function create(string $customer, string $cashier, int $amount, int $recieved, int $returned, string $state){
//insertion dans la abase de donnée
$q=$this->getConnection()->prepare(" INSERT INTO factures(customer,cashier,amount,recieved,returned,state)
 VALUES (:customer, :cashier, :amount, :recieved, :returned, :state)");
return $q->execute([
'customer' => $customer,
'cashier' => $cashier,
'amount' => $amount,
'recieved' => $recieved,
'returned' => $returned,
'state' => $state
]);
}
//recuperer une facture
public function read(){

    return $this->getConnection()->query("SELECT * FROM factures ORDER BY id")->fetchAll(PDO::FETCH_OBJ);
}
public function countBills(): int{

return (int)$this->getConnection()->query("SELECT COUNT(id) as count FROM factures")->fetch()[0];
}
}