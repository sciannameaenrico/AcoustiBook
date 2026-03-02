<?php
	$host="localhost";
    $dbname="my_enricosciannamea";
    $dbuser="enricosciannamea";
    $dbpass="";
    
    try{
    $pdo=new PDO("mysql:host=$host;dbname=$dbname",$dbuser,$dbpass);
    
    }catch(PDOexception $e)
    {
    	print "errore!" .$e->GetMessage()."<br>";
        die();
    }
    
    if(!$pdo){
    	echo "errore di connessione al database ";
        die();
    }	
?>