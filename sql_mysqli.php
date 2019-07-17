<?php 

$mysqli = mysqli_connect("127.0.0.1","root","","deneme") or die("bağlantı hatası oluştu");
mysqli_set_charset($mysqli,"utf8");

//for($i=0;$i<10;$i++)
  // $mysqli->query("insert into ogrenci(adi,soyadi,numara) Values('Mehmet $i','Soyad $i','$i')");
?>


<?php
$islem = "";
if(isset($_GET["islem"]))
    $islem = $_GET["islem"];
$sonuc = "";
if(isset($_GET["sonuc"]))
    $sonuc = $_GET["sonuc"];
$m = "";
if($sonuc=="ok")
    $m.="<h2>işlem yapıldı</h2>";

switch($islem){
    case "duzenle":
        $id= $_GET["id"];
        $sql = "select * from ogrenci where id=$id";
        $result = $mysqli->query($sql);
        if(mysqli_num_rows($result)){
            $row = mysqli_fetch_array($result);
            $adi = $row["adi"];
            $soyadi = $row["soyadi"];
            $numara = $row["numara"];
        

?><form action="?islem=duzenle_save&id=<?php echo $id?>" method="post">
<table>
    <tr>
        <td>Adı</td>
        <td><input type="text" name="adi" value="<?php echo $adi?>"></td>
    </tr>
   <tr>
        <td>Soyadı</td>
        <td><input type="text" name="soyadi" value="<?php echo $soyadi?>"></td>
    </tr>
   <tr>
        <td>Numara</td>
        <td><input type="text" name="numara" value="<?php echo $numara?>"></td>
    </tr>
   <tr>
        <td> </td>
        <td><input type="submit" name="kaydet" value="kaydet">
       
       </td>
    </tr>

</table>
    </form>

<?php
}else{
            echo "kayıt yok";
        }
        
        break;
    case "duzenle_save":
        $id = $_GET["id"];
            $adi = $_POST["adi"];
            $soyadi = $_POST["soyadi"];
            $numara = $_POST["numara"];
        $mysqli -> query("update ogrenci set adi='$adi', soyadi='$soyadi', numara='$numara' where id=$id");
        header("Location: ?sonuc=ok");

        
        break;
    case "sil":
        $id = $_GET["id"];
        $mysqli->query("delete from ogrenci where id=$id");
        header("Location: ?sonuc=ok");
        break;
        
    case "ekle":
        ?>
        <form action="?islem=ekle_save" method="post" onsubmit="return kaydet()" name="form1">
            <table>
            <tr>
                <td>Ad:</td>
                <td><input type="text" name="adi"></td>
                </tr>
             <tr>
                <td>Soyad:</td>
                <td><input type="text" name="soyadi"></td>
                </tr>
             <tr>
                <td>Numara:</td>
                <td><input type="text" name="numara"></td>
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
    
    case "ekle_save":
        $adi=$_POST["adi"];
        $soyadi=$_POST["soyadi"];
        $numara=$_POST["numara"];
        
        $mysqli->query("insert into ogrenci(adi,soyadi,numara) Values('$adi','$soyadi','$numara')");
        
        header("Location: ?sonuc=ok");
        break;
    
    
    
    default:
        
  
        $sql = "select * from ogrenci order by adi asc";
        $result = $mysqli->query($sql);
        $m .= "<table>
        <tr>
            <th>#</th>
            <th>Adı</th>
            <th>Soyadı</th>
            <th>Numara</th>
            <th>işlem</th>
        </tr>";

        if(mysqli_num_rows($result)){
            $i =0;
            while($row = mysqli_fetch_array($result)){
                $i++;
                $id=$row["id"];
                $m.= "<tr>
                    <td>$i</td>
                    <td>".$row["adi"]."</td>
                    <td>$row[soyadi]</td>
                    <td>$row[numara]</td>
                    <td> <a href='?islem=duzenle&id=$id'>düzenle</a>| <a href='javascript:sil($id)'>sil </a></td>

                </tr>";
            }

        }else{
                $m.= "<tr>
                    <td colspan='5'> Kayıt yok</td>
                </tr>";}
        $m.="</table>
       
        <script>
        function sil(id){
        
        if(confirm('silinecek emin misin?')){
            location.href = '?islem=sil&id='+id;
        }
        }
        
        </script>
        
        ";
        echo $m;  
        
        echo "<a href='?islem=ekle'><button>Ekleme yap</button></a>";
        
}

