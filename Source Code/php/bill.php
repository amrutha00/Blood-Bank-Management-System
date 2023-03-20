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
    <style>

        input {
        padding: 3px 10px;
        margin-top:5px;
        margin-bottom:5px;
        display: inline-block;
        box-sizing: border-box;
        border: 1.5px solid #ccc;
         
        }
        .receiver{
        width:400px;
        height:400px;
        background:#303030;
        color:#e6e6e6;
        top:53%;
        left:50%;
        position: absolute;
        transform: translate(-50%,-50%);
        box-sizing: border-box;
        padding: 40px 30px;
        border-radius: 15px;
        }
       
        label{
            
            font-family: Arial, sans-serif;
            font-size:17px;
        }
       
        .button{
            background-color: white;
            text-align: center;
            padding: 10px 8px;
            margin: 12px 28px;
            border: none;
            cursor: pointer;
            width: 80%;
            border-radius: 18px;
        }
        
    </style>
    
    <body>

        <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
			<a class="navbar-brand" href="../index.html">Home</a>
			<ul class="navbar-nav">
				<li class="nav-item">
				<a class="nav-link" href="database.php">Database</a>
				</li>
				
			</ul>
		</nav>

		<div class = "container" style="margin-top: 100px;">
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

            $result=$conn->query("SELECT * from bill");
             if($result->num_rows > 0) {
				echo "<br/><h5><kbd>BILL</kbd></h5>
				<div class=\"table-responsive\">
				<table class = \"table table-bordered table-dark table-striped table-hover\">
				<tr>
					<thead>
					<th>#</th>
					<th>Receiver Id</th>
					<th>Receiver Name</th>
					<th>Patient Id</th>
					<th>H_Pid</th>
					<th>Patient Name</th>
					<th>Reason</th>
					<th>Blood Group</th>
					<th>Units</th>
					<th>Cost</th>
					<th>Date</th>				
					<th>Employee</th>				
					</thead>
				</tr>
				";
                // output data of each row
                $sl = 1;
                
                while($row = $result->fetch_assoc()) 
                {
                    $id=$row["rec_id"];
                    $n=$conn->query("SELECT donar_name from donar where donar_id='$id'");
                    $row1=$n->fetch_assoc();
            
                    echo "		<tr><td>" . $sl . "</td><td>" . $row["rec_id"]. "</td><td>" . $row1["donar_name"]. "</td><td>" . $row["patient_id"] . "</td><td>" . $row["h_pid"] . "</td><td>" . $row["name"] . "</td><td>" . $row["reason"] . "</td><td>" . $row["blood_group"] . "</td><td>" . $row["bottles"] . "</td><td>" . $row["cost"] . "</td><td>" . $row["received_on"] . "</td><td>" . $row["emp_id"] . "</td></tr>";
					$sl++;
                }
                echo "</table></div>";
            } 
            else {
                echo "0 results";
            }


            
            $conn->close();
            ?>
        </div>
        


    </body>
</html>