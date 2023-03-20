<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <!-- Mobile Device Compatibility -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
		
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>

		<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
			<a class="navbar-brand" href="../index.html">Home</a>
			<ul class="navbar-nav">
				<li class="nav-item">
				<a class="nav-link active" href="#">Database</a>
				</li>
				
			</ul>
		</nav>

		<div class = "container" style="margin-top:100px">
			<?php
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "BloodBank";

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}

			$sql = "SELECT * FROM employee;";
			$employee = $conn->query($sql);

			$sql = "SELECT * FROM donar;";
			$donar = $conn->query($sql);

			$sql = "SELECT * FROM health;";
			$health = $conn->query($sql);

			$sql = "SELECT * FROM blood;";
			$blood = $conn->query($sql);

			$sql = "SELECT * FROM stock;";
			$stock = $conn->query($sql);

			$sql = "SELECT * FROM compatible;";
			$co = $conn->query($sql);

			$sql = "SELECT * FROM hospital;";
			$hospital = $conn->query($sql);

			$sql = "SELECT * FROM patient;";
			$patient = $conn->query($sql);

			$sql = "SELECT * FROM receiver;";
			$receiver = $conn->query($sql);

			$sql = "SELECT * FROM cost;";
			$cost = $conn->query($sql);

			if ($employee->num_rows > 0) {
				echo "<br/><h5><kbd>Employees</kbd></h5>
				<div class=\"table-responsive\">
				<table class = \"table table-bordered table-dark table-striped table-hover\">
				<tr>
					<th>#</th>
					<th>Employee ID</th>
					<th>Name</th>
					<th>Address</th>
					<th>Phone Number</th>
					<th>Email Id</th>
					
				</tr>
				";
				// output data of each row
				$sl = 1;
				while($row = $employee->fetch_assoc()) {
					echo "		<tr><td>" . $sl . "</td><td>" . $row["emp_id"]. "</td><td>" . $row["e_name"]. "</td><td>" . $row["address"]. "</td><td>" . $row["phone_no"]. "</td><td>" . $row["email_id"]. "</td></tr>";
					$sl++;
				}
				echo "</table></div>";
			} else {
				echo "0 results";
			}

			if ($donar->num_rows > 0) {
				echo "<br/><h5><kbd>Donar</kbd></h5>
				<div class=\"table-responsive\">
				<table class = \"table table-bordered table-dark table-striped table-hover\">
				<tr>
					<thead>
					<th>#</th>
					<th>Donar Id</th>
					<th>Name</th>
					<th>Address</th>
					<th>Phone Number</th>
					<th>Email Id</th>
					<th>Age</th>
					<th>Height</th>
					<th>Weight</th>
					<th>Blood Group</th>
					<th>Employee ID</th>				
					</thead>
				</tr>
				";
				// output data of each row
				$sl = 1;
				while($row = $donar->fetch_assoc()) {
					echo "		<tr><td>" . $sl . "</td><td>" . $row["donar_id"]. "</td><td>" . $row["donar_name"] . "</td><td>" . $row["address"] . "</td><td>" . $row["phone_no"] . "</td><td>" . $row["email_id"] . "</td><td>" . $row["age"] . "</td><td>" . $row["height"] . "</td><td>" . $row["weight"] . "</td><td>" . $row["blood_group"] . "</td><td>" . $row["emp_id"] . "</td></tr>";
					$sl++;
				}
				echo "</table></div>";
			} else {
				echo "0 results";
			}

			if ($health->num_rows > 0) {
				echo "<br/><h5><kbd>Donar_Health</kbd></h5>
				<div class=\"table-responsive\">
				<table class = \"table table-bordered table-dark table-striped table-hover\">
				<tr>
					<thead>
					<th>#</th>
					<th>Donar Id</th>
					<th>Smoking</th>
					<th>Drinking</th>
					<th>Cancer Treatment</th>
					<th>Anemia</th>
					<th>Operated Recently</th>
					<th>Last Donation</th>
					</thead>
				</tr>
				";
				// output data of each row
				$sl = 1;
				while($row = $health->fetch_assoc()) {
					echo "		<tr><td>" . $sl . "</td><td>" . $row["donar_id"]. "</td><td>" . $row["smoking"] . "</td><td>" . $row["alcohol"] . "</td><td>" . $row["cancer"] . "</td><td>" . $row["anemia"] . "</td><td>" . $row["surgery"] . "</td><td>" . $row["last_donated"] . "</td></tr>";
					$sl++;
				}
				echo "</table></div>";
			} else {
				echo "0 results";
			}





			if ($stock->num_rows > 0) {
				echo "<br/><h5><kbd>STOCK</kbd></h5>
				<div class=\"table-responsive\">
				<table class = \"table table-bordered table-dark table-striped table-hover\">
				<tr>
					<thead>
					<th>#</th>
					<th>Blood Group</th>
					<th>Volume</th>
					<th>Refill</th>
					<th>Cost</th>
									
					</thead>
				</tr>
				";
                // output data of each row
                $sl = 1;
                while($row = $stock->fetch_assoc()) {
                    echo "		<tr><td>" . $sl . "</td><td>" . $row["blood_group"]. "</td><td>" . $row["volume"] . "</td><td>" . $row["refill"] . "</td><td>" . $row["cost"] . "</td></tr>";
					$sl++;
                }
                echo "</table></div>";
            } else {
			   echo "0 results";
			}
			
			if ($co->num_rows > 0) {
				echo "<br/><h5><kbd>COMPATIBLE</kbd></h5>
				<div class=\"table-responsive\">
				<table class = \"table table-bordered table-dark table-striped table-hover\">
				<tr>
					<thead>
					<th>#</th>
					<th>Blood Group</th>
					<th>Compatible Bood Groups</th>
					
									
					</thead>
				</tr>
				";
                // output data of each row
                $sl = 1;
                while($row = $co->fetch_assoc()) {
                    echo "		<tr><td>" . $sl . "</td><td>" . $row["blood_group"]. "</td><td>" . $row["c"] . "</td></tr>";
					$sl++;
                }
                echo "</table></div>";
            } else {
                echo "0 results";
			}
			

			if ($hospital->num_rows > 0) {
				echo "<br/><h5><kbd>HOSPITALS</kbd></h5>
				<div class=\"table-responsive\">
				<table class = \"table table-bordered table-dark table-striped table-hover\">
				<tr>
					<thead>
					<th>#</th>
					<th>Id</th>
					<th>Name</th>
					<th>Address</th>
					<th>Phone Number</th>
					
									
					</thead>
				</tr>
				";
                // output data of each row
                $sl = 1;
                while($row = $hospital->fetch_assoc()) {
                    echo "		<tr><td>" . $sl . "</td><td>" . $row["hospital_id"]. "</td><td>" . $row["h_name"] . "</td><td>" . $row["location"] . "</td><td>" . $row["phone_no"] . "</td></tr>";
					$sl++;
                }
                echo "</table></div>";
            } else {
                echo "0 results";
			}
			
			if ($patient->num_rows > 0) {
				echo "<br/><h5><kbd>PATIENTS</kbd></h5>
				<div class=\"table-responsive\">
				<table class = \"table table-bordered table-dark table-striped table-hover\">
				<tr>
					<thead>
					<th>#</th>
					<th>Patient ID</th>
					<th>Hospital ID</th>
					<th>Patient HID</th>
					<th>Name</th>
					<th>Reason</th>
					<th>Blood Group</th>
					<th>Bottles Required</th>
					<th>Request Date</th>
					
									
					</thead>
				</tr>
				";
                // output data of each row
                $sl = 1;
                while($row = $patient->fetch_assoc()) {
                    echo "		<tr><td>" . $sl . "</td><td>" . $row["patient_id"]. "</td><td>" . $row["hospital_id"] . "</td><td>" . $row["h_pid"] . "</td><td>" . $row["name"] . "</td><td>" . $row["reason"] . "</td><td>" . $row["blood_group"] . "</td><td>" . $row["bottles"] . "</td><td>" . $row["date"] . "</td></tr>";
					$sl++;
                }
                echo "</table></div>";
            } else {
                echo "0 results";
			}
			
			if ($receiver->num_rows > 0) {
				echo "<br/><h5><kbd>RECEIVER</kbd></h5>
				<div class=\"table-responsive\">
				<table class = \"table table-bordered table-dark table-striped table-hover\">
				<tr>
					<thead>
					<th>#</th>
					<th>Receiver ID</th>
					<th>Patient ID</th>
					<th>Payment</th>
					<th>Received Date</th>
					
									
					</thead>
				</tr>
				";
                // output data of each row
                $sl = 1;
                while($row = $receiver->fetch_assoc()) {
                    echo "		<tr><td>" . $sl . "</td><td>" . $row["rec_id"]. "</td><td>" . $row["patient_id"] . "</td><td>" . $row["payment"] . "</td><td>" . $row["received_on"] . "</td></tr>";
					$sl++;
                }
                echo "</table></div>";
            } else {
                echo "0 results";
			}
			


			
			if ($cost->num_rows > 0) {
				echo "<br/><h5><kbd>COST</kbd></h5>
				<div class=\"table-responsive\">
				<table class = \"table table-bordered table-dark table-striped table-hover\">
				<tr>
					<thead>
					<th>#</th>
					<th>Receiver ID</th>
					<th>Patient ID</th>
					<th>Cost</th>
					
					
									
					</thead>
				</tr>
				";
                // output data of each row
                $sl = 1;
                while($row = $cost->fetch_assoc()) {
                    echo "		<tr><td>" . $sl . "</td><td>" . $row["rec_id"]. "</td><td>" . $row["patient_id"] . "</td><td>" . $row["cost"] . "</td></tr>";
					$sl++;
                }
                echo "</table></div>";
            } else {
                echo "0 results";
			}
			


			$conn->close();
			?>
		</div>
		<footer class = "footer p-2" style = "position: relative;">
			<p class = "lead  m-0">Done By Amrutha U</p>
			
		</footer>
	</body>
</html>