<?php
require("connection.php");
$conn = mysqli_connect('localhost','root','','crud_store');
function image_upload($img){
    $temp_loc = $img['tmp_name'];
    // echo $temp_loc;
    $new_name = random_int(11111,99999).$img['name'];
    // echo $new_name;
    $new_loc = UPLOAD_SRC.$new_name;
    // echo $new_loc;

    if(!move_uploaded_file($temp_loc,$new_loc)){
        header("Location: index.php?alert=img_upload");
        exit;
    }
    else{
        return $new_name;
    }

}


// C:\Users\SEN\Downloads\InstallXamppHere\htdocs\PHP_practics\crud\store\uploads_files45582rouph.PNG

function image_remove($img) {

    if (!unlink(UPLOAD_SRC.$img)) {
        header("Location: index.php?alert=img_rem_fail");
        exit;
    } 
}


if(isset($_POST['addproduct'])){
foreach($_POST as $key => $value){
    $_POST[$key]  = mysqli_real_escape_string($conn,$value);

}

$imgpath = image_upload($_FILES['image']);
$query = "INSERT INTO `crud` (`name`, `price`, `description`, `image`) VALUES ('$_POST[name]', '$_POST[price]', '$_POST[desc]','$imgpath');";
if(mysqli_query($conn,$query)){
    header("Location: index.php?success=added");
}
else{
    header("Location: index.php?alert=add_failed");
}

}

if(isset($_GET['rem']) && $_GET['rem']>0){
    
    $query = "SELECT * FROM  crud WHERE `id`='$_GET[rem]'";
    
    $result = mysqli_query($conn,$query);
    
    $fetch = mysqli_fetch_assoc($result);
//    echo var_dump($fetch);
// echo"image: ". $fetch['image'];
// echo "<br>";
    image_remove($fetch['image']);
    $query  = "DELETE  FROM `crud` WHERE `id`='$_GET[rem]'";
    if(mysqli_query($conn,$query)){
        header("location: index.php?success=removed");
    }
    else{
        header("location: index.php?alert=removed_failed");
    }
}


if(isset($_POST['editproduct'])){
    foreach($_POST as $key => $value){
        $_POST[$key] = mysqli_real_escape_string($conn, $value);
    }



    if(file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['tmp_name'])){
     $query = "SELECT * FROM  `crud` WHERE `id`='$_POST[editpid]'";
    $result = mysqli_query($conn,$query);
    $fetch = mysqli_fetch_assoc($result);
    
    image_remove($fetch['image']);
    $imgpath = image_upload($_FILES['image']);
    
    $update = "UPDATE `crud` SET `name`='$_POST[name]',`price`='$_POST[price]',`description`='$_POST[desc]',`image`='$imgpath' WHERE `id`=$_POST[editpid]";


    }
    else{
        $update = "UPDATE `crud` SET `name`='$_POST[name]',`price`='$_POST[price]',`description`='$_POST[desc]' WHERE `id`=$_POST[editpid]";

    }
    if(mysqli_query($conn,$update)){
        header("location: index.php?success=update");
    }
    else{
        header("location: index.php?alert=update_faild");
    }



}

// if(isset($_POST['editproduct'])){
//     foreach($_POST as $key => $value){
//         $_POST[$key] = mysqli_real_escape_string($conn, $value);
//     }

//     if(file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['tmp_name'])){
//         $query = "SELECT * FROM  crud WHERE `id`='$_GET[rem]'";
//         $result = mysqli_query($conn, $query);
//         $fetch = mysqli_fetch_assoc($result);
    
//         image_remove($fetch['image']);
//         $imgpath = image_upload($_FILES['image']);
    
//         $update = "UPDATE `crud` SET `name`='$_POST[name]',`price`='$_POST[price]',`description`='$_POST[desc]',`image`='$imgpath' WHERE `id`=$_POST[editpid]";
//     }
//     else{
//         $update = "UPDATE `crud` SET `name`='$_POST[name]',`price`='$_POST[price]',`description`='$_POST[desc]' WHERE `id`=$_POST[editpid]";
//     }

//     if(mysqli_query($conn, $update)){
//         header("location: index.php?success=update");
//     }
//     else{
//         header("location: index.php?alert=update_failed");
//     }
// }


?>