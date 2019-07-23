<?php 

$cnnct = new PDO("mysql:host=127.0.0.1; dbname=mypdo","root","");
$cnnct->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 
?>

<html>
<head>
    <title>NEWEST TEST</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="ajaxcodes.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    
   
    
    </head>
<body>
    <div class="container">
        <div class="col-xl-12">
            <table class="table">
                <tr>
                    <th class="w-15">NAME</th>
                    <th class="w-25">SURNAME</th>
                    <th class="w-35">EMAIL</th>
                    <th class="w-25">PROCESS</th>
                </tr>
                <?php 
                    $statement=$cnnct->prepare("SELECT * FROM newest ORDER BY id");
                    $statement->execute();
                    while ($result=$statement->fetch()){
                        ?>
                    <tr>
                        <td><?php echo $result["name"] ?></td>
                        <td><?php echo $result["surname"] ?></td>
                        <td><?php echo $result["email"] ?></td>
                        <td><button type="button" class="btn-xs btn-info btn-primary data_edit" id="<?php echo $result["id"] ?>" >EDIT</button></td>
                    </tr>
                <?php
                            //her bir buton için o satırın id sini çekme özelliği çok hoş handled...
                    }
                ?>
                    
                
            </table>
        </div>
    </div>
    
    <div class="modal fade" id="myModal">
        
        <div class="modal-dialog" id="getter">
            
        </div>
    </div>
    
    </body>
</html>