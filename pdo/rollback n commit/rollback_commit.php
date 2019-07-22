<?php
try{
    $connectionhandler = new PDO("mysql:host=127.0.0.1;dbname=mypdo;charset=utf8", "root", ""); 
    $connectionhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); //exception throwlamak için yazıyoruz.
    echo "connected successfully <br>";
}
catch (PDOException $e){
    echo "Error handler here...: ".$e->getMessage()."<br>";
    die();
}
    
 /*$i=0;
    $databs="INSERT INTO pdolist_rollback (name,surname,number) VALUES ('user$i','lastname$i','$i' )";
    while ($i < 14){
        $databs="INSERT INTO pdolist_rollback (name,surname,number) VALUES ('user$i','lastname$i','$i' )";
        $connectionhandler->exec($databs);
        $i++;    
    }
    echo "data inserted"; */

    echo "before EVERYTHING <br>";
    $databs=("SELECT * FROM pdolist_rollback ORDER BY id asc");
    $statement=$connectionhandler->prepare($databs);
    $statement->execute();
    $i=0;
while ( $result = $statement->fetch()){
    $i++;
    echo "$result[name] <br>";
}
    $connectionhandler->beginTransaction();

    $databs=("DELETE FROM pdolist_rollback where id=6 ");
    $statement=$connectionhandler->prepare($databs);
    $statement->execute();

echo "<br> before <br>";
    $databs=("SELECT * FROM pdolist_rollback ORDER BY id asc");
    $statement=$connectionhandler->prepare($databs);
    $statement->execute();
    $i=0;
while ( $result = $statement->fetch()){
    $i++;
    echo "$result[name] <br>";
}


    $connectionhandler->rollBack();

    echo "<br> after <br>";
    $databs=("SELECT * FROM pdolist_rollback ORDER BY id asc");
    $statement=$connectionhandler->prepare($databs);
    $statement->execute();
    $i=0;
while ( $result = $statement->fetch()){
    $i++;
    echo "$result[name] <br>";
}
?>

