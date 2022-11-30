<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="icon" type="image/x-icon" href="./images/logo1.png">
     <title>Upload Job | Jobs Portal</title>
     <?php

     include('header_link.php');
     include('dbconnect.php');
     
     ?>
</head>

<body>

     <?php

     include('header.php');

     if (!isset($_SESSION['userid'])) {
          header('Location: login.php');
     }


     $empid = $_SESSION['userid'];

     ?>
     <div class="container">



          <div class="single">
               <h1>Add Jobs</h1>
               <div class="col-md-6">
                    <form action="uploadjob.php" method="post">

                         <div class="form-group">
                              <input type="text" placeholder="enter a name" name="name" class="form-control">
                         </div>

                         <div class="form-group">
                    
                              <select name="catid" class="form-control">
                                   <option value="">Select Categories</option>
                                   <?php
                                        $sql = "select * from categories";
                                        $data = mysqli_query($con, $sql);
                                   if (mysqli_num_rows($data) > 0) 
                                   {
                                        while ($rs = mysqli_fetch_array($data)) {
                                   ?>
                                   <option value="<?= $rs['catid'] ?>"><?= $rs['name'] ?></option>
                                   <?php
                                   }
                                   } else {
                                   ?>
                                   <option>No category found</option>
                                   <?php  
                                   }
                                   ?>

                              </select>
                         </div>


                         <div class="form-group">
                              <input type="text" placeholder="enter a desc" name="desc" class="form-control">
                         </div>

                         <div class="form-group">
                              <input type="text" placeholder="enter a salary" name="salary" class="form-control">
                         </div>

                         <div class="form-group">
                              <input type="text" placeholder="enter a location" name="location" class="form-control">
                         </div>

                         <div class="form-group">
                              <input type="text" placeholder="enter a timing" name="timing" class="form-control">
                         </div>

                         <input type="submit" name="postjob" value="Post Job" class="btn btn-primary">

                    </form>


               </div>

               

          </div>


          <?php

          if (isset($_POST['postjob'])) {


               $empid = $_SESSION['userid'];



               $name = $_POST['name'];
               //   $categories = $_POST['categories'];
               $catid = $_POST['catid'];
               $desc = $_POST['desc'];
               $salary = $_POST['salary'];
               $timing = $_POST['timing'];
               $location = $_POST['location'];

               $sql = "INSERT INTO `jobs`( `title`, `catid`, `description`, `salary`, `timing`, `location`, `empid`) 
               VALUES ('$name', '$catid', '$desc','$salary','$timing','$location','$empid')";
               mysqli_query($con, $sql);



               echo "<script>alert('Add Job')</script>";
          }
          ?>

     </div>

     

     <br><br>
     <?php include('footer.php'); ?>


</body>

</html>