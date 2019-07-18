<?php 

class TableRows extends RecursiveIteratorIterator { 
    function __construct($it) { 
        parent::__construct($it, self::LEAVES_ONLY); 
    }

    function current() {
        return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() { 
        echo "<tr>"; 
    } 

    function endChildren() { 
        echo "</tr>" . "\n";
    } 
} 
try{

$conn=new PDO("mysql:host=127.0.0.1;dbname=myDB","root","");

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    /*$sql = "CREATE DATABASE mYDB";

$conn->exec($sql);
echo "database created...";
*/

//created table
    /*
$sql = "CREATE TABLE misafir (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(30) NOT NULL,
surname VARCHAR(35) NOT NULL,
email VARCHAR(50),
tel VARCHAR(10)
)";

$conn->exec($sql);

echo "Table created succesfully";

*/
 /*
    for ($i=0;$i<5;$i++){
        

$sql = "INSERT INTO misafir (name,surname,email,tel) VALUES ('misafir$i','konuk$i','email$i@outlook.com','$i$i$i')";
$conn->exec($sql);  
            } */
    
        $islem = "";
        if(isset($_GET["islem"]))
            $islem = $_GET["islem"];
    
        $sonuc = "";
        if(isset($_GET["sonuc"]))
            $sonuc = $_GET["sonuc"];
        $m = "";
        if($sonuc=="ok")
        $m.="<h3>Process handled...</h3>";
    
    switch($islem){
            
        case "append":
?>
    <form action="?islem=appendnsave" method="post" onsubmit="return kaydet()" name="form1">
            <table>
            <tr>
                <td>Ad:</td>
                <td><input type="text" name="name"></td>
                </tr>
             <tr>
                <tr>
                <td>Soyad:</td>
                <td><input type="text" name="surname"></td>
                </tr>
             <tr>
                <td>email:</td>
                <td><input type="text" name="email"></td>
                </tr>
             <tr>
                <td>tel:</td>
                <td><input type="text" name="tel"></td>
                </tr>
             <tr>
                 <td><button type="submit" name="submit">Kaydet</button></td>
                </tr>
            </table>
            
        </form>
<script type="text/javascript">
    function kaydet(){
       var ad=document.forms["form1"]["adi"].value;
       var soyad=document.forms["form1"]["soyadi"].value;
       var numara=document.forms["form1"]["numara"].value;
        
        if ((ad==null||ad=="")||(soyad==null||soyad=="")||(numara==null||numara=="")){
            alert("you should fill all the blanks!");
        }
             
        else{
            if (confirm("do you really wanna save?"))
                return true;
        }
                       
        return false;
    }

</script>

        <?php
        break;

        case "appendnsave":
        $adi=$_POST["name"];
        $soyadi=$_POST["surname"];
        $email=$_POST["email"];
        $tel=$_POST["tel"];
        
        $sql = "INSERT INTO misafir(name,surname,email,tel) VALUES ('$adi','$soyadi','$email','$tel')";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$adi,$soyadi,$email,$tel]);
            break;
        default:
            echo "<table style='border: solid 1px black;'>";
            echo "<tr><th>Id</th><th>Firstname</th><th>Firstname</th><th>Email</th><th>Tel</th></tr>";
            
            
        $stmt = $conn->prepare("SELECT id, name, surname, email, tel FROM misafir"); 
        $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
        echo $v;
    }
        echo "<a href='?islem=append'><button>Ekleme yap</button></a>";      
        break;
    }
}


catch(PDOException $e){
    echo $sql. "<br>" . $e->getMessage();
}


$conn=null;

?>