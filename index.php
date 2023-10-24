<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "nodes";

$conn = mysqli_connect($servername,$username,$password,$database);

if(isset($_GET['delete'])){
  $sno = $_GET['delete'];
 $sql = "DELETE FROM `nods` WHERE `sr_no`=$sno";
  $result = mysqli_query($conn,$sql);
  if($result){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Holy guacamole!</strong> Data deleted successfully.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   </div>';
  }
  else{
    echo '<div class="alert alert-dark alert-dismissible fade show text-align-center" role="alert">
      <strong>Holy guacamole!</strong> Data not deleted.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>';
  }

}

if(isset($_POST['snoEdit'])){
if(isset($_POST['snoEdit'])){
    $title = $_POST["title"];
  $description = $_POST["description"];
  $id = $_POST["snoEdit"];
  
    $sql = "UPDATE `nods` SET `title` = '$title', `description` = '$description' WHERE `nods`.`sr_no` = $id;";
    $result = mysqli_query($conn,$sql) ;
    if($result){
      echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
      <strong>Holy guacamole!</strong> Data updated successfully.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>';
     
    }else{
      echo '<div class="alert alert-danger alert-dismissible fade show text-align-center" role="alert">
      <strong>Holy guacamole!</strong> Data not updated.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>';
   
    }
  
  }

}
 else if (isset($_POST['addNote'])) {
  // Code for inserting a new note
  $title = $_POST["title"];
  $description = $_POST["description"];
  $sql = "INSERT INTO `nods` (`title`, `description`) VALUES ('$title', '$description');";
  $result = mysqli_query($conn, $sql);
  if($result){
      echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
        <strong>Holy guacamole!</strong> Data inserted into database sucessfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>';
  } else {
      echo '<div class="alert alert-danger alert-dismissible fade show text-align-center" role="alert">
      <strong>Holy guacamole!</strong> Data not inserted into database sucessfully.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>';
  }
  
}


?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iNote</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


    
  </head>
  <body>



<!-- edit modals -->

<div class="modal fade " id="editmodal" tabindex="-1" aria-labelledby="editmodal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editmodal">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="index.php" method ="POST">
        <input type="hidden" name='snoEdit' id='snoEdit'>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label" maxlength="50">add title</label>
          <input type="text" class="form-control" id="title_edit" aria-describedby="emailHelp" name="title">

        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label" maxlength="60">Title description</label>
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" id="description_edit" style="height: 100px" name="description"></textarea>
                <label for="floatingTextarea2">Note description</label>
              </div>
        </div>
        <div class="mb-3 form-check">


        </div>
        
        <button type="submit" class="btn btn-danger">Update now</button>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="editnote" name="editnote" >Save changes</button>
      </div>
    </div>
  </div>
</div>


    
    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand fs-3" href="#"><img src="inote.png" alt="" height="50px"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active fs-4 fw-light text-light" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active fs-4 fw-light text-light" aria-current="page" href="#">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active fs-4 fw-light text-light" aria-current="page" href="#">Contact us</a>
              </li>  
            </ul>



            <form class="d-flex" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success text-light" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>
    

<div class="container my-4">
<h2>Add a Note</h2>
    <form action="index.php?update=true" method ="POST">
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label" maxlength="50">Note Title</label>
          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="title">
  
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label" maxlength="60">Title description</label>
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="description"></textarea>
                <label for="floatingTextarea2">Note description</label>
              </div>
        </div>

        <input type="hidden" name="sr_no" id="sr_no">
        <div class="mb-3 form-check">


        </div>
        <button type="submit" name="addNote">ADD NOTE</button>

        
      </form>
</div>

<div class="container">

    <table class="table" id="myTable"  class="display" >
  <thead>
    <tr>
      <th scope="col">Se.NO.</th>
      <th scope="col">Title</th>
      <th scope="col">description</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    
  <?php

$sql = "SELECT * FROM `nods`";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($result)){
echo "    <tr>
<th scope='row'>".$row['sr_no']."</th>
<td >".$row['title']."</td>
<td >".$row['description']."</td>
<td ><button class='delete btn bg-danger me-3' id =d".$row['sr_no'].">Delete</button><button class='edit btn bg-success' data-srno='".$row['sr_no']."'>Edit</button>
</td>
</tr>";
}



?>
   



  </tbody>
</table>


</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script>
edits = document.getElementsByClassName('edit');
Array.from(edits).forEach((element) => {
  element.addEventListener('click', (e) => {
    console.log('edit', e.target.parentNode.parentNode);
    tr = e.target.parentNode.parentNode;
    title = tr.getElementsByTagName("td")[0].innerText;
    description = tr.getElementsByTagName("td")[1].innerText;
    snoEdit.value = e.target.getAttribute("data-srno"); // Set snoEdit field value
    description_edit.value = description;
    title_edit.value = title;

    $('#editmodal').modal('toggle');
  });
});


delets = document.getElementsByClassName('delete');
Array.from(delets).forEach((element) => {
  element.addEventListener("click", (e) => {
    console.log('delete', );

    sno = e.target.id.substr(1,);
    
    
    if(confirm("Are you sure want to delete?")){
      window.location = `http://localhost/PHP_PRACTICS/crud/index.php?delete=${sno}`;
    }
    else{
      console.log("NO");
    }
  });
});
</script>

<script>
    let table = new DataTable('#myTable');
    $(document).ready( function () {
    $('#myTable').DataTable();
} );

</script>

  </body>
</html>