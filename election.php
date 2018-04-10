<?php
//namespace src\be\kunstmaan\multichain;
  session_start();
  $_SESSION['crPage'] = 'election.php';
  include "backend/connection.php";
?>
<?php 
  include "backend/functions.php";
  include "backend/index.php";
  
  print_r($_SESSION);
  if(isset($_POST['logout']))
	logout();  
?>
<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<title>Blockchain Voting</title>
	</head>
	<body>
		 <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">

				<a href="index.php" class="navbar-brand">Voting with Blockchain</a> <!-- LOGO -->
				
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">   <span class="navbar-toggler-icon"></span> 
				</button>
				<div class="collapse navbar-collapse" id="collapsibleNavbar">  <!-- Collapsible Navbar -->
					<ul class="offset-sm-1 navbar-nav">
					<li class="nav-item">
						<a href="index.php" class="nav-link">Home</a>
					</li>
					<li class="nav-item">
						<a href="#" class="nav-link">About us</a>
					</li>
					</ul>  
				</div>
				 <form action="loginSuccess.php" method="post">
				 <div class="dropdown">
				<button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown"><?php echo $_COOKIE['name']; ?></button>
				<div class="dropdown-menu dropdown-menu-right">
						<button class="dropdown-item" type="submit" name="edit">Edit Profile</button>
						<button class="dropdown-item" type="submit" name="logout">Logout</button>
				</div>
				</div>
				 </form>

			</nav>
		 <div>
				 
		 </div>
			<div class="table-responsive col-12 offset-md-3 col-md-6 offset-lg-2 col-lg-8 offset-xl-3 col-xl-6 mt-5">
			<form class="form" method="POST">
				<table class="table table-hover table-bordered text-center">
					<thead class="thead-dark">
						<th>Candidate</th>
						<th>Age</th>
					</thead>
					<tbody>
					<?php
					$id = $_GET['id'];
					$_SESSION['uID'] = $id;
			// TODO: Make a function
						$query = "select * from candidate where campId = $id";
						$result = $conn->query($query);
						query_test($result);
						if($result){
							foreach($result as $i)
							{
								echo "<tr>";
								echo "<td>" . $i['candName'] . "</td>";
								echo "<td>" . $i['candAge'] . "</td>";
								echo "</tr>";
							}
						}
					?>
					</tbody>
				</table>
			<div class="col-12 form-group row">
			<select name="selectedCand" class="form-control col-8 offset-sm-2 col-sm-6 offset-md-3 col-md-4 mr-2" id="sel1">
		<?php
			$id = $_GET['id'];
			$query = "select * from candidate where campId = $id";
		$result = $conn->query($query);
		query_test($result);
		if($result)
		{
			foreach($result as $i)
			{
				echo "<option value=".$i['candName'] .">".$i['candName'] ."</option>";
			}
		}
		?>
				<!-- <option>Manik</option>
				<option>Akshat</option>
				<option>Ashwin</option>
				<option>Chahat</option> -->
			</select>
 
			<!-- <input type="text" id="candidate" class="col-8 offset-sm-2 col-sm-6 offset-md-3 col-md-4" /> -->
			<button type="submit" name="voteFC" class="btn btn-warning col-3 col-sm-3 col-md-2">Vote</button>
			</form>
			</div>
			</div>

		<?php
			if(isset($_POST['voteFC']))
			{
				$sql = "Select * from users where email = '" . $_COOKIE['email']."'";
                 if($result = $conn->query($sql))
                 {
	                 while($row = $result->fetch_assoc()){
	                  $uwad = $row['uwaddress'];
	                 }
             	 }
                 
                 $sql = "Select * from candidate where candName = '".$_POST['selectedCand']."'";	
                 if($result = $conn->query($sql))
                 {
                 		while($row = $result->fetch_assoc()){
                 	 	$cwad = $row['cwAddress'];
                 		}
                 }
                 echo $_POST['selectedCand'];
                 echo $uwad,$cwad;
                 sendvCoin($uwad,$cwad,1); 
			}
				
		?>
		<!-- Optional JavaScript -->
		<script src="./index.js"></script>
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</body>
</html>