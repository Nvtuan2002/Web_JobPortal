<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="./images/logo1.png">
    <title>Register | Jobs Portal</title>
    <?php

    include('header_link.php');
    include('dbconnect.php');



    ?>
</head>

<body>
    <?php

    include('header.php');

    ?>
    <div class="container">


        <div class="single">

            <div class="col-md-6">
                <h1>Employer Register</h1>

                <form action="register.php" method="post">

                    <div class="form-group">
                        <input type="text" placeholder="enter a name" name="company" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="email" placeholder="enter a email" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="enter a password" name="password" class="form-control">
                    </div>
                    <input type="submit" name="empregister" value="Register Employer" class="btn btn-primary">

                </form>


            </div>

            <div class="col-md-6">
                <h1>User Register</h1>
                <form action="register.php" method="post">

                    <div class="form-group">
                        <input type="text" placeholder="enter a name" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="email" placeholder="enter a email" name="email" class="form-control ">
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="enter a password" name="password" class="form-control">
                    </div>

                    <input type="submit" name="userregister" value="Register User" class="btn btn-primary">

                </form>


            </div>
        </div>


        <?php

        if (isset($_POST['empregister'])) {

            $company = $_POST['company'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $sql = "INSERT INTO `employer`( `company`, `email`, `password`, `type`) VALUES ('$company','$email','$password','1')";
            mysqli_query($con, $sql);

            echo "<script>alert('Registation Successfully');window.location = 'login.php';</script>";

            
        }

        if (isset($_POST['userregister'])) {

            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];


            $sql2 = "INSERT INTO `user`(`name`, `email`, `password`, `type`) VALUES ('$name','$email','$password','2')";
            mysqli_query($con, $sql2);


            echo "<script>alert('User Register');window.location = 'login.php';</script>";

            // $exist  = "no";

            // try{
            //     $sql2 = "INSERT INTO `user`(`name`, `email`, `password`, `type`) VALUES ('$name','$email','$password','2')";
            //     mysqli_query($con, $sql2);
            // }
            // catch( PDOException $e ) {
            //     error_log($e -> getMessage());
            //     if($e->getCode()==23000){ 
            //         echo "<script>alert('Error User Register')</script>";
            //         $exist  = "yes";
                    
            //     }
               
            // }

            // if ($exist == "no") {
            //     echo "<script>alert('User Register');window.location = 'login.php';</script>";      
            // }
        }

        ?>

    </div>
    <br><br>
    <?php include('footer.php'); ?>

</body>

</html>