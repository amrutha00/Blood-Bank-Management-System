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
        .order{
        width:400px;
        height:520px;
        background:#303030;
        color:#e6e6e6;
        top:56%;
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
				<li class="nav-item">
				<a class="nav-link active" href="patient.php">Patients</a>
				</li>
				<li class="nav-item">
				<a class="nav-link active" href="hospital.php">Hospital</a>
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


#Retrieve details of the blood that is available for the patien_no-1234567890 by the hospital ASTER CMI.
        if($_SERVER['REQUEST_METHOD']=="POST")
        {

             $h=mysqli_real_escape_string($conn,$_POST['hospital_id']);
             $hn=mysqli_real_escape_string($conn,$_POST['h_name']);
            $p=mysqli_real_escape_string($conn,$_POST['h_pid']);
            $bg=mysqli_real_escape_string($conn,$_POST['blood_group']);
            $sql="SELECT hospital_id from hospital where hospital_id='$h' and h_name='$hn'";
            $result=$conn->query($sql);
            if($result->num_rows>0)
            {
                $sql1="SELECT hospital_id,h_pid FROM patient where h_pid='$p' and hospital_id='$h' and blood_group='$bg'";
                $result1=$conn->query($sql1);
                if($result1->num_rows>0)
                {
                    $n=mysqli_real_escape_string($conn,$_POST['name']);
                    $r=mysqli_real_escape_string($conn,$_POST['reason']);
                    $b=mysqli_real_escape_string($conn,$_POST['bottles']);
                    $d=mysqli_real_escape_string($conn,$_POST['date']);
                    $sql2="UPDATE patient set name='$n',reason='$r',bottles='$b',date='$d' where  h_pid='$p' and hospital_id='$h' and '$d'<DATE(NOW())";
                    $result2=$conn->query($sql2);
                    if ($conn->query($sql2) === true) 
                    {
                        echo "<script>
                        alert('Updated Successfully');
                            </script>";
                    
                    }
                    else 
                    {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                         
                     }
                   
                }
                else
                {
                    echo "<script>
                    alert('Register Patient');
                    window.location.href='patient.php';
                        </script>";
                
                    
                }
            }
            else
            {
                echo "<script>
                alert('Register Hospital');
                window.location.href='hospital.php';
                    </script>";
            
                
            }
        }

           /* $sql = "SELECT blood_group,volume,cost FROM stock WHERE blood_group in (SELECT c FROM compatible WHERE blood_group in( SELECT blood_group FROM patient WHERE h_pid='1234567890' and exists ( SELECT hospital_id from hospital where hospital.h_name='ASTER CMI' )))";
            $result = $conn->query($sql);
           

             if($result->num_rows > 0) {
				echo "<br/><h5><kbd>COST</kbd></h5>
				<div class=\"table-responsive\">
				<table class = \"table table-bordered table-dark table-striped table-hover\">
				<tr>
					<thead>
					<th>#</th>
					<th>Blood Group</th>
					<th>Volume</th>
					<th>Cost</th>				
					</thead>
				</tr>
				";
                // output data of each row
                $sl = 1;
                while($row = $result->fetch_assoc()) {
                    echo "		<tr><td>" . $sl . "</td><td>" . $row["blood_group"]. "</td><td>" . $row["volume"] . "</td><td>" . $row["cost"] . "</td></tr>";
					$sl++;
                }
                echo "</table></div>";
            } 
            else {
                echo "0 results";
            }


#A new donar wants to make a donation,register the patient and check if he is eligible for donation, if yes,Update all the tables accordingly.
            $sql="INSERT IGNORE INTO donar VALUES('D0011','Donar11','JP Nagar','9156399876','don11@gmail.com','35','6.1','65','E2000')";
            $sql1="INSERT IGNORE INTO health values('D0011',0,0,0,0,0,'2019:05:01')";
            $sql2="SELECT donar_id,donar_name FROM donar WHERE  donar_id IN (SELECT donar_id FROM health WHERE donar_id='D0011' and smoking=0 and alcohol=0 and cancer=0 and anemia=0 and surgery=0 and last_donated<date_add(NOW(),INTERVAL 3 MONTH) )and weight>=50 ";
            
            $result = $conn->query($sql);
            $result1 = $conn->query($sql1);
            $donar=$conn->query("SELECT * FROM donar");
            $health=$conn->query("SELECT * FROM health");
            $result2 = $conn->query($sql2);

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
					<th>Employee ID</th>				
					</thead>
				</tr>
				";
                // output data of each row
                $sl = 1;
                while($row = $donar->fetch_assoc()) {
                    echo "		<tr><td>" . $sl . "</td><td>" . $row["donar_id"]. "</td><td>" . $row["donar_name"] . "</td><td>" . $row["address"] . "</td><td>" . $row["phone_no"] . "</td><td>" . $row["email_id"] . "</td><td>" . $row["age"] . "</td><td>" . $row["height"] . "</td><td>" . $row["weight"] . "</td><td>" . $row["emp_id"] . "</td></tr>";
					$sl++;
                }
                echo "</table></div>";
            } else {
                echo "0 results";
            }


            if ($health->num_rows > 0) {
				echo "<br/><h5><kbd>Health</kbd></h5>
				<div class=\"table-responsive\">
				<table class = \"table table-bordered table-dark table-striped table-hover\">
				<tr>
					<thead>
					<th>#</th>
					<th>Donar Id</th>
					<th>Smoking</th>
					<th>Alcohol</th>
					<th>Cancer</th>
					<th>Anemia</th>
					<th>Surgery</th>
					<th>Last Donated</th>				
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



            

           if($result2->num_rows>0)
            {
                $sql3="INSERT INTO blood VALUES('D0011','A+',350,'2020:01:25')";
                $sql6="UPDATE health,blood WHERE health.last_donated=blood.date_donated";

                $sql4="UPDATE stock,blood set stock.volume=stock.volume+blood.volume where stock.blood_group in( SELECT blood.blood_group FROM blood where blood.donar_id='D0011')";
                $sql5="UPDATE stock set refill=1 where stock.volume<500";
                
                $result3= $conn->query($sql3);
                $result6= $conn->query($sql6);
                $result4 = $conn->query($sql4);
                $result5 = $conn->query($sql5);
                $blood= $conn->query("SELECT * FROM blood");
                $stock= $conn->query("SELECT * FROM stock");

                if ($blood->num_rows > 0) {
                    echo "<br/><h5><kbd>AVAIL</kbd></h5>
                    <div class=\"table-responsive\">
                    <table class = \"table table-bordered table-dark table-striped table-hover\">
                    <tr>
                        <thead>
                        <th>Donar Id</th>
                        <th>Blood Group</th>
                        <th>Volume</th>
                        <th>Date</th>
                        </thead>
                    </tr>
                    ";
                    // output data of each row
                    $sl = 1;
                    while($row = $blood->fetch_assoc()) {
                        echo "		<tr><td>" . $row['donar_id'] . "</td><td>" . $row['blood_group'] . "</td><td>" . $row['volume'] . "</td><td>" . $row['donated_date'] . "</td></tr>";
                        
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
                        <th>Blood Group</th> 
                        <th>Volume</th>		
                        <th>Refill</th>	
                        </thead>
                    </tr>
                    ";
                    // output data of each row
                    $sl = 1;
                    while($row = $stock->fetch_assoc()) {
                        echo "		<tr><td>" . $row['blood_group'] . "</td><td>" . $row['volume'] . "</td><td>" . $row['refill'] . "</td></tr>";
                        
                        $sl++;
                    }
                    echo "</table></div>";
                } else {
                    echo "0 results";
                }
                

               
            }
            else{
                echo "0 results";
            }
            */
            
            $conn->close();
            ?>
        </div>


        <div class="order" >
        <form action="orders.php" method="post" if="myForm" onSubmit = "return check(this)">
            <h3 style="text-align:center">ORDER</h3>
            <label><b>Hospital Name</b></label>
            <input type="text" name="h_name" placeholder="..." size=15 required autocomplete="off" style="margin-left:0.5vw"><br>
            
            <label><b>Hospital Id</b></label>
            <input type="text" name="hospital_id" placeholder="..." size=15 required autocomplete="off" style="margin-left:3vw">   <br>        
            <label><b>Patient Id</b></label>
            <input type="text" name="h_pid" placeholder="..." size=15 required autocomplete="off" style="margin-left:3.9vw"><br>
            <label><b>Name</b></label>
            <input type="text" name="name" placeholder="..." size=15 required autocomplete="off" style="margin-left:6.3vw"><br>
            <label><b>Reason</b></label>
            <input type="text" name="reason" placeholder="..." size=15 required autocomplete="off" style="margin-left:5.2vw"> <br>
            <label><b>Blood Group</b></label>
            <input type="text" name="blood_group" placeholder="..." size=15 required autocomplete="off" style="margin-left:2vw"> <br>
            <label><b>Bottles</b></label>
            <input type="text" name="bottles" placeholder="..."  size=15 required autocomplete="off" style="margin-left:5.6vw"> <br>
            
            <label><b>Date</b></label>
            <input type="text" name="date" placeholder="..."  size=15 required autocomplete="off" style="margin-left:7.2vw"> <br>
            
            <input type="submit" value="ADD" class="button" ><br>
            
        </form>
    </div>


















        </body>
</html>