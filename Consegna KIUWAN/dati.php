<?php
include("init.php");
$val = array();

if( isset($_GET['key'])){
    
    if( isset($_GET['impianto'])){
        
        if( isset($_GET['tipo'] )) {
            
            $val[]=($_GET['key']);
            $val[]=substr($_GET['tipo'],1,-1);
            $val[]=substr($_GET['impianto'],1,-1);
            
            
            $query= $con->prepare( "SELECT r.Azienda,r.Impianto,r.CodiceS,r.Data,r.Ora,r.Misurazione,r.Limite,r.Messaggio FROM Dati_clienti d,Rilevazioni r,Sensori s WHERE d.Azienda = r.Azienda AND d.Pubblici = ? AND r.CodiceS = s.CodiceS AND s.Tipo = ? AND r.Impianto= ?;");
        
            $query -> execute ( $val);
            
            echo json_encode($query->fetchAll(PDO::FETCH_ASSOC));
            
            
        
        }
    
        $val[]=($_GET['key']);
        $val[]=substr($_GET['impianto'],1,-1);
        
        $query= $con->prepare( "SELECT r.Azienda,r.Impianto,r.CodiceS,r.Data,r.Ora,r.Misurazione,r.Limite,r.Messaggio FROM Dati_clienti d,Rilevazioni r WHERE d.Azienda = r.Azienda AND d.Pubblici = ? AND r.Impianto= ?;");
        
        $query -> execute ( $val);
        
        echo json_encode($query->fetchAll(PDO::FETCH_ASSOC));

    
}
else{
    
    array_push($val, $_GET['key']);
    $query= $con->prepare( "SELECT Impianto,a.Azienda FROM Dati_clienti d,Ambienti a WHERE d.Azienda = a.Azienda AND Pubblici = ?;");
    $query -> execute ( $val);
    echo json_encode($query->fetchAll(PDO::FETCH_ASSOC));
}
}
?>