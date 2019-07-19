<?php

try{
    $connectionhandler = new PDO("mysql:host=127.0.0.1;dbname=mypdo;charset=utf8", "root", ""); 
    $connectionhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); //exception throwlamak için yazıyoruz.
    echo "connected successfully <br>";
    
    /*
    //db creation
    $databs="CREATE DATABASE mypdo";
    $connectionhandler->exec($databs);
    echo "db created successfully <br>";
    */
    
    /*
    //table creation
    $databs="
    CREATE TABLE pdolist_param(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(20) NOT NULL,
    surname VARCHAR(25) NOT NULL,
    number VARCHAR(10)
    )";
    $connectionhandler->exec($databs);
    echo "table created succesfully";
    */
    
    /*
    //data insertion
    $i=0;
    $databs="INSERT INTO pdolist (name,surname,number) VALUES ('user$i','lastname$i','$i' )";
    while ($i < 14){
        $databs="INSERT INTO pdolist (name,surname,number) VALUES ('user$i','lastname$i','$i' )";
        $connectionhandler->exec($databs);
        $i++;    
    }
    echo "data inserted successfully";
    */
    
    /*
    //data insertion with prepared statements
    $statement = $connectionhandler->prepare("INSERT INTO pdolist_param (name,surname,number) VALUES  (:name,:surname,:number)");
    $statement->bindParam(':name',$name);
    $statement->bindParam(':surname',$surname);
    $statement->bindParam(':number',$number);
    
    $i=0;
    while ($i<6){
        $name="Name$i";
        $surname="Surname$i";
        $number="$i";
        $i++;
        $statement->execute();
    }
    echo "data inserted successfully with prepared statements";
    */
    
    /*
    //last recorded id check
    $last_id = $connectionhandler->lastInsertId();
    echo "Last recorded id:".$last_id;
    */
    
    
    
}


catch (PDOException $e){
    echo "Error handler here...: ".$e->getMessage()."<br>";
    die();
}

/*honorable mentions: persistent connections:https://www.w3resource.com/php/pdo/php-pdo.php
*/
?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>DATABASE APPLICATIONS</title>
    </head>
    <body>
        
    <?php
        $headerpage="";
        if(isset($_GET["headerpage"]))
            $headerpage = $_GET["headerpage"];
         
        $m="";
        
        $process="";
        if (isset($_GET["process"]))
            $process=$_GET["process"];
        if($headerpage=="ok")
        $m.="<h2>Processed...</h2>";
        
        switch ($process){
                
                
            case "edit":
                $id= $_GET["id"];//href den gelen id yi bu case için bir değişkene atıyoruz.
                $statement = $connectionhandler->prepare("SELECT * FROM pdolist_param WHERE id=$id");
                $statement->execute();
                
                if($result  = $statement->fetch()){
                    $name = $result["name"];
                    $surname = $result["surname"];
                    $number = $result["number"];
                
                
                ?>
            <div class="col-md-3">
                <form method="post" action="?process=editnsave&id=<?php echo $id?>">
                    
                    <div class="form-group">
                        <label>Name:</label>
                        <input class="form-control" type="text" name="name" value="<?php echo $name?>">
                    </div>
                    
                    <div class="form-group">
                        <label>Surname:</label>
                        <input class="form-control" type="text" name="surname" value="<?php echo $surname?>">
                    </div>
                    
                    <div class="form-group">
                        <label>Number:</label>
                        <input class="form-control" type="text" name="number" value="<?php echo $number?>">
                    </div>
                    
                    <div class="form-group">
                        <input  class="form-control" type="submit" name="edit" value="Submit">
                    </div>
                    
                </form>
            </div>
                <?php
                } else {
                    echo "no data found.";
                }
                break;
                
            case "editnsave":
                $id=$_GET["id"];
                $name=$_POST["name"];
                $surname=$_POST["surname"];
                $number=$_POST["number"];
                
                $statement = $connectionhandler->prepare("UPDATE pdolist_param SET name = '$name', surname='$surname', number='$number' WHERE id=$id");
                $statement->execute();
                header("Location: ?headerpage=ok");
                break;
               
            case "delete":
                $id = $_GET["id"];
                $statement = $connectionhandler->prepare("DELETE FROM pdolist_param WHERE id=$id");
                $statement->execute();
                
                header("Location: ?headerpage=ok");           
                break;
                
            case "append":
                ?>
                <div class="col-md-3">
                <form name="forma" method="post" action="?process=appendnsave" onsubmit="return emptyhandler()">
                    <div class="form-group">
                        <label>Name:</label>
                        <input class="form-control" type="text" name="name" >
                    </div>
                    
                    <div class="form-group">
                        <label>Surname:</label>
                        <input class="form-control" type="text" name="surname" >
                    </div>
                    
                    <div class="form-group">
                        <label>Number:</label>
                        <input class="form-control" type="text" name="number" >
                    </div>
                    
                    <div class="form-group">
                        <input  class="form-control" type="submit" name="append" value="Insert">
                    </div>
                </form>
                </div>
        <script>
        function emptyhandler(){
        var name=document.forms["forma"]["name"].value;
        var surname=document.forms["forma"]["surname"].value;
        var number=document.forms["forma"]["number"].value;
            
            if ((name==null||name=="")||(surname==null||surname=="")||(number==null||number=="")){
            alert("you should fill all the blanks!");
        }
            else {
                if (confirm("Sure to save?"))
                    return true;
            }
            return false;
        }
        </script>
                <?php
                break;
                
            case "appendnsave":
                $name=$_POST["name"];
                $surname=$_POST["surname"];
                $number=$_POST["number"];
                
                $statement=$connectionhandler->prepare("INSERT INTO pdolist_param (name,surname,number) VALUES ('$name','$surname','$number' ) ");
                $statement->execute();
                header("Location: ?headerpage=ok");
                break;
                
            default:
                
                $m .= "
                <div class=\"col-md-6\">
                <table class=\"table text-center\">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Number</th>
                        <th>Process</th>
                    </tr>
                    </div>
                    ";
                    
                $statement = $connectionhandler->prepare("SELECT * FROM pdolist_param ORDER BY name asc");
                $statement->execute();
                /*
                //FETCH ASSOC Sütun isimlerine göre indisli bir dizi döner.
                $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
                */
                $i=0; 
                
                while ($result =  $statement->fetch() ){
                    $i++;
                    $id = $result["id"];
                    $m.="<tr>
                    <td>$i</td>
                    <td>$result[name]</td>
                    <td>$result[surname]</td>
                    <td>$result[number]</td>
                    <td> 
                    
                    <a href='?process=edit&id=$id'><button class=\"btn btn-primary\">Edit</button></a>
                    
                    <button></button>
                    
                    <a href='javascript:delet($id)'><button class=\"btn btn-danger\">Delete</button></a>
                    
                    </td>
                    </tr>";
                }
                
                
                $m.="</table>
                <script>
                    function delet(id){
                        if (confirm('Are you really gonna delete?')){
                            location.href='?process=delete&id='+id;
                        }
                    } 
                </script>
                ";
                //js koduyla beraber id yi de delete case ine pass ediyoruz.
                echo $m;
                echo "
                <div class='col-md-12 text-center'>
                <a href='?process=append'><button class='btn btn-block btn-warning'>Insert Element</button></a>
                </div>
                ";
                break;
        }
        
        ?>
    </body>
</html>

