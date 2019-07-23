    $(document).ready(function (){
        $(document).on("click",".data_edit", function modalopen(){
            var newest_id = $(this).attr("id");
            
            $.ajax({
                url:"edit.php",
                method:"GET",
                data:{newest_id:newest_id},
                success:function(data){
                    
                    $("#getter").html(data);   
                    $("#myModal").modal("show");   
                }
            });
        });
        
        
 
    });
    
