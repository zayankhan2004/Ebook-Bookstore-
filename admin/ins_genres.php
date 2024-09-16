<?php
session_start();

// Session verification for access control
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/ee032ea639.js" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="style-.css"> Custom styles -->
    <title>Admin Panel</title>
    <style>
   
    </style>
</head>
<body>
    <?php include('nav_admin.php') ?>
<aside>

<!-- 1st -->






 <div class="inner_asside">
    
<form action="admin.php" method="post" enctype="multipart/form-data">
<div class="sections mt-4 d-flex justify-content-center">

    <div class="card text-center" style="background: #ffffff37; height: 100%">
       
        <div class="card-body">
          <!-- <h2 class="card-title text-white">Home Page Panel</h2> -->
          <h5 class="card-text text-white">Insert Latest Books</h5>


          
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Book Title" 
            name="title" required>
          </div>




          
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Author Name" 
            name="author" required>
          </div>


          <div class="input-group mb-3">
            <input type="Number" class="form-control" placeholder="Price" 
            name="price" required>
          </div>
<!-- ------------------ -->

 <div class="input-group">
  <span class="input-group-text">Book Description
  </span>
  <textarea class="form-control" aria-label="With textarea" name="description" rows="4" cols="50"></textarea>
</div>




<!-- -------------- -->

 <div class="sections mt-4">
<div class="input-group">
       <label class="input-group-text" for="inputGroupFile01">Upload-img</label>
        <input type="file" class="form-control" id="inputGroupFile01" name="coverImage" required>
                </div>


 <p class="card-text text-white"></p>
      <div class="input-group mb-3 ">
        <!-- <div class="input-group">
            <input type="date" class="date" name="podcast_date" required>
          </div> -->
      </div> 


<input type="submit" class="form-control btn btn-dark text-white" value="Add Book" name="home">

        </div>
      </div>


      <button type="button" class="btn btn-dark btn-sm"><a href="manage_books.php" class = "text-white">See what you've Insert</a></button>

<!-- ----------------------------- -->

<!-- -------------------------------->

<!-- --------------------------------- -->
    </div>

    </form>
    
 </div>














<!-- 2nd -->



 <div class="inner_asside">
    
    <form action="admin.php" method="post" enctype="multipart/form-data">
    <div class="sections mt-4 d-flex justify-content-center">
    
        <div class="card text-center" style="background: #ffffff37; height: 100%">
           
            <div class="card-body">
              <!-- <h2 class="card-title text-white">Home Page Panel</h2> -->
              <h5 class="card-text text-white">Insert Latest Books</h5>
    
    
              
              <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Book Title" 
                name="title" required>
              </div>
    
    
    
    
              
              <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Author Name" 
                name="author" required>
              </div>
    
    
              <div class="input-group mb-3">
                <input type="Number" class="form-control" placeholder="Price" 
                name="price" required>
              </div>
    <!-- ------------------ -->
    
     <div class="input-group">
      <span class="input-group-text">Book Description
      </span>
      <textarea class="form-control" aria-label="With textarea" name="description" rows="4" cols="50"></textarea>
    </div>
    
    
    
    
    <!-- -------------- -->
    
     <div class="sections mt-4">
    <div class="input-group">
           <label class="input-group-text" for="inputGroupFile01">Upload-img</label>
            <input type="file" class="form-control" id="inputGroupFile01" name="coverImage" required>
                    </div>
    
    <!-- audio -->
    
    <!-- <div class="input-group mt-4">
           <label class="input-group-text" for="inputGroupFile01">Upload-audio</label>
            <input type="file" class="form-control" id="inputGroupFile01" name="podcast_audio" accept="audio/mp3" required>
                    </div>  -->
    
    
    <!-- ----------- -->
    
     <p class="card-text text-white"></p>
          <div class="input-group mb-3 ">
            <!-- <div class="input-group">
                <input type="date" class="date" name="podcast_date" required>
              </div> -->
          </div> 
    
    
    <input type="submit" class="form-control btn btn-dark text-white" value="Add Book" name="home">
    
            </div>
          </div>
    
    
          <button type="button" class="btn btn-dark btn-sm"><a href="manage_books.php" class = "text-white">See what you've Insert</a></button>
    
    <!-- ----------------------------- -->
    
    <!-- -------------------------------->
    
    <!-- --------------------------------- -->
        </div>
    
        </form>
        
     </div>














<!-- 3rd -->











     <div class="inner_asside">
    
    <form action="admin.php" method="post" enctype="multipart/form-data">
    <div class="sections mt-4 d-flex justify-content-center">
    
        <div class="card text-center" style="background: #ffffff37; height: 100%">
           
            <div class="card-body">
              <!-- <h2 class="card-title text-white">Home Page Panel</h2> -->
              <h5 class="card-text text-white">Insert Latest Books</h5>
    
    
              
              <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Book Title" 
                name="title" required>
              </div>
    
    
    
    
              
              <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Author Name" 
                name="author" required>
              </div>
    
    
              <div class="input-group mb-3">
                <input type="Number" class="form-control" placeholder="Price" 
                name="price" required>
              </div>
    <!-- ------------------ -->
    
     <div class="input-group">
      <span class="input-group-text">Book Description
      </span>
      <textarea class="form-control" aria-label="With textarea" name="description" rows="4" cols="50"></textarea>
    </div>
    
    
    
    
    <!-- -------------- -->
    
     <div class="sections mt-4">
    <div class="input-group">
           <label class="input-group-text" for="inputGroupFile01">Upload-img</label>
            <input type="file" class="form-control" id="inputGroupFile01" name="coverImage" required>
                    </div>
    
    <!-- audio -->
    
    <!-- <div class="input-group mt-4">
           <label class="input-group-text" for="inputGroupFile01">Upload-audio</label>
            <input type="file" class="form-control" id="inputGroupFile01" name="podcast_audio" accept="audio/mp3" required>
                    </div>  -->
    
    
    <!-- ----------- -->
    
     <p class="card-text text-white"></p>
          <div class="input-group mb-3 ">
            <!-- <div class="input-group">
                <input type="date" class="date" name="podcast_date" required>
              </div> -->
          </div> 
    
    
    <input type="submit" class="form-control btn btn-dark text-white" value="Add Book" name="home">
    
            </div>
          </div>
    
    
          <button type="button" class="btn btn-dark btn-sm"><a href="manage_books.php" class = "text-white">See what you've Insert</a></button>
    
    <!-- ----------------------------- -->
    
    <!-- -------------------------------->
    
    <!-- --------------------------------- -->
        </div>
    
        </form>
        
     </div>
    </aside>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="menu.js"></script>
</body>
</html>
