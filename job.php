<div class="banner">
	<div class="container">
		<div id="search_wrapper">
			<?php
			include('dbconnect.php');
			if ((isset($_GET["search"]) && !empty($_GET["search"])) && (isset($_GET["location"]) && !empty($_GET["location"]))) {
				$key = $_GET["search"];
				$loca = $_GET["location"];
				$sql = "select jobs.jobid, jobs.title, categories.name, jobs.description, jobs.salary, jobs.timing, jobs.location, employer.company
				from jobs 
				inner join categories on categories.catid = jobs.catid 
				inner join employer on employer.empid = jobs.empid 
				where (title LIKE '%$key%' OR categories.name LIKE '%$key%' OR description LIKE '%$key%' OR salary LIKE '%$key%' ) AND location LIKE '%$loca%' ";
			} else {
				$sql = "select jobs.jobid, jobs.title, categories.name, jobs.description, jobs.salary, jobs.timing, jobs.location, employer.company
				from jobs 
				inner join categories on categories.catid = jobs.catid 
				inner join employer on employer.empid = jobs.empid";
			}
			$result = mysqli_query($con, $sql);
			?>
			<h1 style="color: #351969fc;">Start your job search</h1>
			<div id="search_form" class="clearfix">
				
				<form action="" method="GET">
					<input type="text" name="search" placeholder="Enter Keyword(s)" value="<?php if (isset($_GET["search"])) {
																								echo $_GET["search"];
																							} ?>" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Enter Keyword(s)';}">
					<input type="text" name="location" placeholder="Location" value="<?php if (isset($_GET["location"])) {
																							echo $_GET["location"];
																						} ?>" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Location';}">
					<label href="#view" class="btn2 btn-2 btn2-1b"><input type="submit" value="Find Jobs"></label>
					
				</form>
			</div>
			<h2 class="title">top search</h2>
			<div id="city_1" class="clearfix">
				<ul class="orange">

					<?php
					include('dbconnect.php');
					$sql = "select * from jobs";
					$rs = mysqli_query($con, $sql);
					while ($data = mysqli_fetch_array($rs)) {


					?>
						<li>
							<a href="#"><?= $data['location'] ?> </a>
						</li>

					<?php
					}
					?>

				</ul>
			</div>
		</div>
	</div>
</div>

<div style="padding-bottom: 100px;" class="container">

	<div class="single" style="grid-template-columns: 33% 33% 33%; display: grid;">

		<?php


		$userid = $_SESSION['userid'];

		include('dbconnect.php');
		while ($data = mysqli_fetch_array($result)) {


			$_SESSION['jobid'] = $data['jobid'];
			$userid = $_SESSION['userid'];
		?>


			<div id="view" class="col-md-12" style="display: flex; flex-direction: column; justify-content: space-between; margin-bottom: 30px;">

				<h1><?= $data['title'] ?></h1>

				<p>Description : <?= $data['description'] ?></p>
				<h3>Categories : <?= $data['name'] ?></h3>
				<h3>Salary : <?= $data['salary'] ?></h3>
				<h3>Timing : <?= $data['timing'] ?></h3>
				<h3>Location : <?= $data['location'] ?></h3>
				<h3>Company : <?= $data['company'] ?></h3>

				<?php

				$type = $_SESSION['type'];

				if ($type == 2) {

					echo "<a href='apply.php?jobid=" . $data["jobid"] . "' class='btn btn-primary'>Apply Now</a>";
				} else {
					echo '
					<div style="display: flex; justify-content: space-between">
					<a href="login.php" style="width:40%" class="btn btn-primary"> Login </a>
					<a href="register.php" style="width:40%" class="btn btn-primary"> Register </a>
					</div>
					';
				}

				?>

			</div>

		<?php
		}
		?>

	</div>

</div>