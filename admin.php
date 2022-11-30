<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="./images/logo1.png">
    <title>Dashboard | Jobs Portal</title>
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

    //Delete Job
    if (isset($_GET['deljobid'])) {
        $jobid = $_GET['deljobid'];
        $sql = "delete from jobs where jobid='$jobid'";
        mysqli_query($con, $sql);
        header('Location: admin.php');
    }
    ?>

    <h1>Dashboard Employer</h1>
    <div class="col-md-6">
        <div class="form-group">
            <input type="text" id="myinput" placeholder="search ......" class="form-control">
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th style="width: 25px;">ID</th>
                    <th >Title</th>
                    <th>Categories</th>
                    <th >Description</th>
                    <th>Timing</th>
                    <th>Salary</th>
                    <th>Location</th>
                    <th>Company</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody id="mytable">
                <?php

                $sql = "select jobs.*, employer.company, categories.name as 'categories'
                              from jobs
                              inner join employer on employer.empid = jobs.empid
                              inner join  categories on categories.catid = jobs.catid
                              where jobs.empid = '$empid';
                              ";
                $rs = mysqli_query($con, $sql);
                while ($data = mysqli_fetch_array($rs)) {
                ?>

                    <tr>
                        <td><?= $data['jobid'] ?></td>
                        <td><?= $data['title'] ?></td>
                        <td><?= $data['categories'] ?></td>
                        <td><?= $data['description'] ?></td>
                        <td><?= $data['timing'] ?></td>
                        <td><?= $data['salary'] ?></td>
                        <td><?= $data['location'] ?></td>
                        <td><?= $data['company'] ?></td>
                        <td style="display: flex">
                            <a href="editJobs.php?jobid=<?= $data['jobid'] ?>" class="btn btn-info" style="width: 70px; margin-right: 5px"> Edit</a>
                            <a href="admin.php?deljobid=<?= $data['jobid'] ?>" class="btn btn-danger" style="width: 70px"> Delete</a>
                        </td>
                    </tr>

                <?php
                }
                ?>
            </tbody>
        </table>

    </div>
    <script>
        $(document).ready(function() {
            $("#myinput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#mytable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
    <br><br>
    <?php include('footer.php'); ?>

</body>

</html>