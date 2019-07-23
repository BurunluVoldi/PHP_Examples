<?php 

$cnnct = new PDO("mysql:host=127.0.0.1; dbname=mypdo","root","");
$cnnct->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 

if (isset($_GET["newest_id"]))
{
    $statement=$cnnct->prepare("SELECT * FROM newest WHERE id='".$_GET["newest_id"]."'");
    $statement->execute();
    
    $result = $statement->fetch();
    //echo json_encode($result);
    
    $name=$result["name"];
    $surname=$result["surname"];
    $email=$result["email"];
 
//yav arkadaş yemiyor save'i dürtemiyoruz bir türlü yav...
    
}
?>                    <form id="forum">

            <div class="modal-content">
                <div class="modal-header">
                <h3 class="modal-title">_/**\_</h3>
                    <button type="button" class="close" data-dismiss="modal">KAPPPPAAA!</button>
                </div>
                <div class="modal-body">
                        <div class="container-fluid">
                            <div class="form-group">
                            
                            <label>Name</label>
                            <input class="form-control" type="text" value="<?php echo $name?>" id="name">
                                
                            
                            <label>Surname</label>
                            <input class="form-control" type="text" value="<?php echo $surname?>" id="surname">
                                
                            
                            <label>Email</label> 
                            <input class="form-control" type="text" value="<?php echo $email?>" id="email">
                                   
                                
                            </div>
                            
                        </div>
                       
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-warning btn" data-dismiss="modal">Close</button>
                    <button type="button" class="btn-primary btn" id="submitte" >Save</button>
                    
                </div>
            </div>
 </form>
<script>

$(document).ready(function(){
          $("#submitte").on("click", function modalsave(){
            $.ajax({
                url:"save.php",
                method:"POST",
                data:$("#forum").serialize(),
                success:function(data){
                   $("#myModal").modal("hide");
                    $(".table").html(data);
                }
            });
              return false;
        }) ;
});
</script>
