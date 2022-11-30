<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jobs</title>
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

    // get data from id 
    error_reporting(0);
    $jobid = $_SESSION['jobid'];

    $sql = "select * from jobs where jobid='$jobid'";
    $rs = mysqli_query($con, $sql);
    $jobdata = mysqli_fetch_array($rs);

    ?>

    <h1 style="transform: translate(500px,-500px); z-index: 1;">Update Job</h1>
    <div class=" col-md-6" style="transform: translate(500px,-500px); z-index: 1">
        <form action="editJobs.php" method="post">
            <!-- for get data from id in view table -->
            <input type="hidden" name="jobid" value="<?= $jobdata['jobid'] ?>" class="form-control">
            <div class="form-group">
                <input type="text" placeholder="enter a name" name="name" class="form-control" value="<?= $jobdata['title'] ?>">
            </div>

            <div class="form-group">

                <input type="text" placeholder="enter a catid" name="catid" class="form-control" value="<?= $jobdata['catid'] ?>">
            </div>


            <div class="form-group">
                <input type="text" placeholder="enter a desc" name="desc" class="form-control" value="<?= $jobdata['description'] ?>">
            </div>

            <div class="form-group">
                <input type="text" placeholder="enter a salary" name="salary" class="form-control" value="<?= $jobdata['salary'] ?>">
            </div>

            <div class="form-group">
                <input type="text" placeholder="enter a location" name="location" class="form-control" value="<?= $jobdata['location'] ?>">
            </div>

            <div class="form-group">
                <input type="text" placeholder="enter a timing" name="timing" class="form-control" value="<?= $jobdata['timing'] ?>">
            </div>

            <input type="submit" name="updatejob" value="Update Job" class="btn btn-primary">

        </form>
        <?php
        if (isset($_POST['updatejob'])) {

            $jobid = $_POST['jobid'];

            $jobname = $_POST['name'];
            // $jobcatid = $_POST['catid'];
            $jobdesc = $_POST['desc'];
            $jobsalary = $_POST['salary'];
            $joblocation = $_POST['location'];
            $jobtiming = $_POST['timing'];


            $sql = "update jobs set title='$jobname' where jobid='$jobid'";
            // $sql = "update jobs set catid='$catid' where jobid='$jobid'";
            // $sql1 = "update jobs set description='$jobdesc' where jobid='$jobid'";
            // $sql = "update jobs set salary='$jobsalary' where jobid='$jobid'";
            // $sql = "update jobs set location='$joblocation' where jobid='$jobid'";
            // $sql = "update jobs set timing='$jobtiming' where jobid='$jobid'";

            if (mysqli_query($con, $sql)) {
                // echo "<script>alert('Update Successfully')</script>";
                echo "<script>alert('Update Successfully');window.location = 'admin.php';</script>";
            } else {
                echo "<script>alert('Not Updated')</script>";
            }
        }
        ?>

        </div>
</body>

</html>