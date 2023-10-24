<?php
require("connection.php");


?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

  </head>
  <body>
    <div class="container bg-dark text-light p-3 rounded my-4">
        
    <div class="d-flex align-items-center justify-content-between">
        <a href="index.php" class="text-white text-decoration-none"> <i class="bi bi-bar-chart-line-fill"></i> ROCKRZ PRODUCT</a>
    
        

<?php
if(isset($_GET['alert'])){
  if($_GET['alert']=='img_upload'){
    echo<<<alert
    
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Image Upload Failed! Server failed</strong> You should check in on some of those fields below.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>

    alert;
  }
}
else if(isset($_GET['success'])){
  if($_GET['success']=='udated'){
    echo<<<alert
    
       <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Image Upload Failed! Server failed</strong> You should check in on some of those fields below.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
             </div>

    alert;
  }
}

?>


<!-- Button trigger modal -->
<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addproduct"><i class="bi bi-plus-square"></i>
Add Product
</button>


</div>
<!-- Modal -->

<form action="crud.php" method="POST" enctype="multipart/form-data">
<div class="modal fade" id="addproduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" >Add Prodect</h1>
        
      </div>
      <div class="modal-body">
                    <div class="input-group mb-3">
                <span class="input-group-text" >Name</span>
                <input type="text" class="form-control" name="name" required>
                </div>
                <div class="input-group mb-3">
                <span class="input-group-text" >Price</span>
                <input type="number" class="form-control" name="price" min=1 required>
                </div>
                    <div class="input-group">
                    <span class="input-group-text">Description</span>
                    <textarea class="form-control" aria-label="With textarea" name="desc" required></textarea>
                    </div>
                    <div class="mb-3">
                    <label for="formFile" class="form-label">Image</label>
                    <input class="form-control" type="file" id="formFile" name="image" accept=".jpg,.png,.svg" required>
                    </div>



      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-outline-success" name="addproduct">Add Product</button>
      </div>
    </div>
  </div>
</div>

</form>




















</div>
<!-- Modal -->

<form action="crud.php" method="POST" enctype="multipart/form-data">
<div class="modal fade" id="editproduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" >Edit Prodect</h1>
        
      </div>
      <div class="modal-body">
                    <div class="input-group mb-3">
                <span class="input-group-text" >Name</span>
                <input type="text" class="form-control" name="name" id = "editname"required>
                </div>
                <div class="input-group mb-3">
                <span class="input-group-text" >Price</span>
                <input type="number" class="form-control" name="price" min=1 id="editprice" required>
                </div>
                    <div class="input-group">
                    <span class="input-group-text">Description</span>
                    <textarea class="form-control" aria-label="With textarea" name="desc" id="editdesc" required></textarea>
                    </div>
                    <img src="" alt="" width="250px" height="200px" class="mb-3" id="editimg" name="editpid">
                    <div class="mb-3">
                    <label for="formFile" class="form-label">Image</label>
                    <input class="form-control" type="file" id="formFile" name="image" accept=".jpg,.png,.svg" >
                    </div>




      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-outline-success" name="editproduct">Edit Product</button>
      </div>
    </div>
  </div>
</div>
<input type="hidden" name="editpid" id='editid'>
</form>






        </div>


        <div class="container mt-5 p-0">

<table class="table table-hover text-center">
<thead class="bg-dark text-light">
    <tr>
    <th width="10%"  scope="col">Sr.No.</th>
    <th width="15%" scope="col">Image</th>
    <th width="10%" scope="col">Name</th>
    <th width="10%" scope="col">Price</th>
    <th width="35%" scope="col">Description</th>
    <th width="20%" scope="col">Action</th>
    </tr>
</thead>
<tbody class="bg-white">
<?php
$query = "SELECT * FROM `crud`";
$result = mysqli_query($conn,$query);
$i = 1;

$fetch_src = FETCH_SRC;
// echo $fetch_src;
// echo $fetch[image];
// <img src="$fetch_src$fetch[image]" alt="">
while($fetch = mysqli_fetch_assoc($result)){
echo<<<product
    <tr class="aling-middle">
            <th scope="row">$i</th>
            <td><img src="$fetch_src$fetch[image]" alt="" width="150px" height="100px"></td>
            <td>$fetch[name]</td>
            <td><i class="bi bi-currency-rupee text-bold"></i>$fetch[price]</td>
            <td>$fetch[description]</td>
            <td>
            <a href="?edit=$fetch[id]" class="btn btn-warning me=3"><i class="bi bi-pencil-square text-light">Edit</i></a>
            <button onclick="confirm_rem($fetch[id])" class="btn btn-danger"><i class="bi bi-trash3"></i>Delete</button>
            </td>
    </tr>


product;
$i = $i +1;

}


?>

    

</tbody>
</table>
</div>





<script>
function confirm_rem(id){
    if(confirm("Are you sure, you want to delete this item ?")){
        window.location.href = "crud.php?rem="+id;
    }
}

</script>








    </div>

    <?php
if(isset($_GET['edit']) && $_GET['edit']>0){
  $query = "SELECT * FROM `crud` WHERE `id`='$_GET[edit]'";
  $result = mysqli_query($conn,$query);
  $fetch = mysqli_fetch_assoc($result);
  echo "
  <script>
  let modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('editproduct'));
   // Returns a Bootstrap modal instance
  // Show or hide:
document.querySelector('#editname').value = `$fetch[name]`;
document.querySelector('#editprice').value = `$fetch[price]`;
document.querySelector('#editdesc').value = `$fetch[description]`;

document.querySelector('#editimg').src = `$fetch_src$fetch[image]`;
document.querySelector('#editid').value = `$fetch[id]`;



  modal.show();
  


  </script>
  ";


}

?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  </body>
</html>