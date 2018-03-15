<?php
//namespace src\be\kunstmaan\multichain;
include "backend/connection.php";?>
<?php include
    "backend/functions.php";
    session_start();

         if(isset($_POST['logout']))
             logout();
?>
<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="style.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Blockchain Voting</title>
    <style>
      .sstyle{
        margin-top:50px;
      }
      label{
      	font-weight: bold;
      }
      #create2{
      	display: none;
      }
      #create3{
      	display: none;
      }
      .dot {
  height: 20px;
  width: 20px;
  border: solid 1px #FFC107;
  border-radius: 50%;
  display: inline-block;
}

  </style>
  </head>
  <body>
     <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">

        <a href="index.php" class="navbar-brand text-center">Voting with Blockchain</a> <!-- LOGO -->
        
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

         <form action="create_camp.php" class="form-inline" method="post">
          <div class="dots d-inline mr-5 mt-2">
          <span class="dot" id="1Sel"></span>
          <span class="dot" id="2Sel"></span>
          <span class="dot" id="3Sel"></span>
          </div>
         <div class="dropdown">
        <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown"><?php echo $_COOKIE['name']; ?></button>
        <div class="dropdown-menu dropdown-menu-right">
            <button class="dropdown-item" type="button" name="edit">Edit Profile</button>
            <button class="dropdown-item" type="button" name="create_camp" onclick="window.location.href='create_camp.php'">Create Campaign</button>
            <button class="dropdown-item" type="submit" name="logout">Logout</button>
        </div>
        </div>
         </form>
      </nav>

      <!-- ONSTART -->
      <script type="text/javascript">
        document.getElementById('1Sel').style.background='#FFC107';
      </script>

	<!-- FIRST PAGE	 -->
     <div class="container mt-5" id="create1">	
     			
     	<div class="display-4 d-inline sstyle col-12">Create Campaign</div>
      
     <form class="form col-8 mt-4" action="create_camp.php" method="POST">
     	<div class="form-group">
     		<label for="campN">Campaign Name:</label>
     		<input class="form-control" type="text" id="campN" name="campName" placeholder="Enter Campaign Name Here">
     	</div>

     	<div class="form-group">
     		<label for="campCt">Campaign Category:</label>
     		<select class="form-control" name="campCat">
     			<option value="Political">Political</option>
     			<option value="Social">Social</option>
     			<option value="Personal">Personal</option>
     			<option value="Organisational">Organisational</option>
     		</select>
     	</div>
     	<div class="form-group">
     		<label for="campCd">Number of Candidates</label>
     		<input class="form-control" type="Number" id="campCd" name="candNum" placeholder="Enter Number of Candidate Here">
     	</div>
     	<div class="form-group">
     		<label for="campUa">User Accessibility:</label>
	     	<select class="form-control" name="candUa" id="ua">
     			<option value="All">All Users</option>
     			<option value="Verified">Verified</option>
     		</select>
     	</div>
     	<button type="Submit" class="btn btn-primary d-inline offset-10 col-2" name="Next">Next</button>
     </form>
     </div>
	
     <!-- SECOND PAGE -->
     <div class="container" id="create2">	
     	<div class="sstyle col-12"><h3>Enter Candidate Details</h3></div>
     <form class="form col-8 mt-4" action="create_camp.php" method="POST">
     	<table class="table table-hover table-bordered text-center">
     		<thead class="thead-dark">
     			<th>Candidate Number</th>
     			<th>Candidate Name </th>
     			<th>Candidate Age </th>
     			<th>Candidate Photo </th>
     		</thead>
     	
                  <!-- PHP FOR NEXT1 -->
        <?php
          // AUTO TABLE GENERATION
          $rows = $_POST['candNum'];
          $i=1;
          while($i<=$rows)
          {
            echo "<tr>
            <td>" .$i. "</td>
            <td><input type='text' name='cN" .$i."'></input></td>
            <td><input type='Number' name='cAg" .$i."'></input></td>
            <td><input type='file' name='cImg".$i."'></input></td>
            </tr>";
            $i++;
          }
          if(isset($_POST['Next']))
          {
            $_SESSION['ua'] = $_POST['candUa'];
            echo "<script>document.getElementById('create1').style.display='none'</script>";
            echo "<script>document.getElementById('create2').style.display='block'</script>";
            echo "<script>document.getElementById('1Sel').style.background='#FFC107'</script>";
            echo "<script>document.getElementById('2Sel').style.background='#FFC107'</script>";
            echo "<script>document.getElementById('2Sel').style.transition='2s ease-out'</script>";            
          }

        ?>
     	</table>
     	<button type="Submit" class="btn btn-primary mt-5 offset-10 col-2" name="Next2">Next</button>
     </form>
     </div>

     <!-- THIRD PAGE -->
     <div class="container" id="create3">
     	<div class="sstyle col-12"><h3>Other Details</h3></div>
     	<form class="form col-8 mt-4" action="create_camp.php" method="POST">
		<div class="form-group">
     		<label for="campDd">Campaign Due Date:</label>
     		<input class="form-control" type="Number" id="campDd" name="campDued" placeholder="Enter Campaign Due Date">
     	</div>
     	<div class="form-group" id="vProof">
     		<label for="campDd">Verification Proof:</label>
     		<!-- <input class="form-control" type="Number" id="campDd" name="campDued"> -->
        <select class="form-control" name="candVP"">
          <option value="Aadhar">Aadhar</option>
          <option value="PAN">PAN CARD</option>
          <option value="Driving">Driving License</option>
        </select>
     	</div>
     	<button type="Submit" class="btn btn-primary mt-5 offset-10 col-2" name="Submit">Submit</button>
     	</form>
     </div>

	<!-- PHP FOR NEXT2 -->
	<?php
    // GLOBAL $count;
		// print_r($_SESSION);
    if(isset($_POST['Next2']))
		{
      if($_SESSION['ua'] == 'Verified')
      {
        echo "<script>document.getElementById('vProof').style.display='Block'</script>"; 
      }else{
        echo "<script>document.getElementById('vProof').style.display='None'</script>";
      }
			echo "<script>document.getElementById('create1').style.display='none'</script>";
			echo "<script>document.getElementById('create2').style.display='none'</script>";
			echo "<script>document.getElementById('create3').style.display='block'</script>";
		  echo "<script>document.getElementById('2Sel').style.background='#FFC107'</script>";
      echo "<script>document.getElementById('3Sel').style.background='#FFC107'</script>";
      echo "<script>document.getElementById('3Sel').style.transition='2s ease-out'</script>";

    }
    if(isset($_POST['Submit']))
    {
      $_SESSION['ua'] = '';
    }
	?>
      <!-- Optional JavaScript -->
    <!-- <script type="text/javascript">
    	function next() {
    		
    	}
    </script> -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      </body>
      </html>