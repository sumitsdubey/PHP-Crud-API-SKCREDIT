<!-- making connection to database start -->
<?php
    
    // define 
    $servername = "localhost";
    $username= "root";
    $password = "";
    $database = "phpcrud";

// connection
$conn = mysqli_connect($servername, $username,$password, $database);

// die if connection was not connect sucessfully

if(!$conn){
  die("Sorry connection failed");
}else{
  // echo "Connection was created Successfully";
}

// post methode implimentation
// echo $_SERVER['REQUEST_METHOD'];
if($_SERVER['REQUEST_METHOD']=="POST"){
  $title = $_POST["title"];
  $description = $_POST["description"];

  $sql ="INSERT INTO `phpcrudopr` (`title`, `description`) VALUES ('$title', '$description')";
  $result = mysqli_query($conn, $sql);
  if($result){
    echo "<p class= 'para'>data inserted successfully</p>";
  }
}
    
?>
<!-- making connection to database start -->


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PHP crud operation</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <style>
      .para{
        width:100%;
        text-align:center;
        background-color:#608b65;
        color: #09cd20;
      } 
    </style>
</head>

<body>
  <h1>This web application for php crud operation</h1>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
    crossorigin="anonymous"></script>

  <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">PHP Crud</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact US</a>
          </li>

        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
<!-- form start  -->


  <div class="container my-4">
    <form action="index.php" method="POST">
    <div class="mb-3">
      <label for="title" class="form-label">Product Title</label>
      <input type="text" it="title" name="title" class="form-control" placeholder="Title Here">
    </div>
    <div class="mb-3">
      <label for="desc" class="form-label">Product Description</label>
      <textarea class="form-control" id="description" name="description" rows="3"></textarea>
    </div>
    <div class="col-auto">
      <input type="submit" class="btn btn-primary mb-3"></button>
    </div>
  </form>
  </div>
  <!-- showing data start
    -->
  <div class="container">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Sr No</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
    // print result from database 
    $sql = "SELECT * FROM `phpcrudopr`";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
      echo "<tr>
      <th scope='row'>". $row['id'] ."</th>
      <td>". $row['title'] ."</td>
      <td>". $row['description'] ."</td>
      <td> Actions </td>
    </tr>";
    }
    ?>

      </tbody>
    </table>
  </div>


</body>

</html>