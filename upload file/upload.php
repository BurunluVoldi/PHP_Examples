<?php
        $current_dir = getcwd();
        $target_dir=$current_dir . "/uploads/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $uploadOk=1;
        $image=basename($_FILES["file"]["name"]);
        $imageFileType= strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
        //from here to other if tree is checking for fake image...
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["file"]["tmp_name"]);
            if($check!==false){
                echo"File is an image - ".$check["mime"].".";
                $uploadOk=1;
            }
            else {
                echo "file bad";
                $uploadOk=0;
            }
        }

        //from here to other if tree is checking if file already exist
        if (file_exists($target_file)) {
            echo "sorry, file already exist";
            $uploadOk=0;
        }

        //from here to other if tree is checking file size
        if ($_FILES["file"]["size"] > 2000000){
            echo "sorry, your file is too large to upload";
            $uploadOk=0;
        }
        //from here to other if tree is checking file format
        if ( $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ){
            echo "sorry, only JPEG, JPG, PNG files allowed";
            $uploadOk=0;
        }

        //finally
        if ($uploadOk== 0){
            echo "sorry, your file was not uploaded";
        } else {
            if ( move_uploaded_file($_FILES["file"]["tmp_name"],$target_file)) {
                echo "the file ". basename($_FILES["file"]["name"]) . " has been uploaded.";
            } else {
                echo "sorry, there was an error uploading your file.";
            }
        }
            
        echo "<img src='./uploads/" . $image . "'>";
        ?>




