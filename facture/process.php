<?php    
require_once 'model.php';
$db=new Database();
//création de factures
if(isset($_POST['action']) && $_POST['action']=='create'){

    extract($_POST);
    $returned = (int)$recieved - (int)$amount;
    $db->create($customer,$cashier,(int)$amount,(int)$recieved,(int)$returned,$state);


    echo 'perfect';
}
//affichage de factures
if(isset($_POST['action']) && $_POST['action']=='fetch'){

    $output='';
    if ($db->countBills()>0) {
       $output +='';
    }else{
        echo   '<h1>aucune facture existe</h1>';
    }


    }