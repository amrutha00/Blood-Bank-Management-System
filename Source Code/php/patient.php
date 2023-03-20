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
        .patient{
        width:400px;
        height:500px;
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
				<a class="nav-link active" href="orders.php">Orders</a>
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


            if($_SERVER['REQUEST_METHOD']=="POST"){
            
            $h=mysqli_real_escape_string($conn,$_POST['hospital_id']);
            $p=mysqli_real_escape_string($conn,$_POST['h_pid']);
            //echo $h;
            //echo $p;
            //hospital exists
            $sql="SELECT hospital_id from hospital where hospital_id='$h'";
            $result=$conn->query($sql);
            if($result->num_rows>0)
            {
                $sql1="SELECT hospital_id,h_pid FROM patient where h_pid='$p' and hospital_id='$h'";
                $result1=$conn->query($sql1);

                //patient doesnt exists
                if($result1->num_rows<=0)
                {
                    $pid=mysqli_real_escape_string($conn,$_POST['pid']);
                    $n=mysqli_real_escape_string($conn,$_POST['name']);
                    $bg=mysqli_real_escape_string($conn,$_POST['blood_group']);
                    $r=mysqli_real_escape_string($conn,$_POST['reason']);
                    $b=mysqli_real_escape_string($conn,$_POST['bottles']);
                    $d=mysqli_real_escape_string($conn,$_POST['date']);
                    $sql2="INSERT INTO patient VALUES('$pid','$h','$p','$n','$r','$bg','$b','d')";
                    $result2=$conn->query($sql2);
                    if ($conn->query($sql2) === true) 
                    {
                        echo "<script>
                        alert('Inserted Successfully');
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
                    alert('Exists');
                        </script>";
                
                    
                }
            }
            else
            {
                echo "<script>
                alert('Register Hospital');
                    </script>";
            
                
            }

        }
            $conn->close();
            ?>
        </div>


        <div class="patient" >
        <form action="patient.php" method="post" if="myForm" onSubmit = "return check(this)">
            <h3 style="text-align:center">PATIENT</h3>
            <label><b>Id</b></label>
            <input type="text" name="pid" placeholder="..." size=15 required autocomplete="off" style="margin-left:8.5vw"><br>
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