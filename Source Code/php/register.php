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
        .donar{
        width:400px;
        height:580px;
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
				<a class="nav-link" href="health.php">Health</a>
				</li>
				<li class="nav-item">
				<a class="nav-link" href="donate.php">Donate</a>
				</li>
				<!--<li class="nav-item">
				<a class="nav-link active" href="#">Donars</a>
				</li>-->
			</ul>
		</nav>
        
		<div class = "container" style="margin-top: 100px;">
            <?php
           $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "BloodBank";

            //insert a donar and check if he eligible to donate blood and if yes let him donate blood and update stock and refill accordingly.
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) 
            {
                die("Connection failed: " . $conn->connect_error);
            }

            if($_SERVER['REQUEST_METHOD']=="POST")
            {
                    $d=mysqli_real_escape_string($conn,$_POST['donar_id']);
                    $n=mysqli_real_escape_string($conn,$_POST['name']);
                    $a=mysqli_real_escape_string($conn,$_POST['address']);
                    $p=mysqli_real_escape_string($conn,$_POST['phone_no']);
                    $e=mysqli_real_escape_string($conn,$_POST['email_id']);
                    $age=mysqli_real_escape_string($conn,$_POST['age']);
                    $w=mysqli_real_escape_string($conn,$_POST['weight']);
                    $h=mysqli_real_escape_string($conn,$_POST['height']);
                    $bg=mysqli_real_escape_string($conn,$_POST['blood_grp']);
                    $eid=mysqli_real_escape_string($conn,$_POST['emp_id']);
                    $sql="INSERT INTO donar(donar_id,donar_name,address,phone_no,email_id,age,height,weight,emp_id,blood_group) VALUES('$d','$n','$a','$p','$e','$age','$h','$w','$eid','$bg')";

                    if ($conn->query($sql) === true) 
                    {
                        echo "Insertion Successful";
                    }
                    else 
                    {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                        
                     }
                
            }
      $conn->close();
            ?>
        </div>


    <div class="donar" >
        <form action="register.php" method="post" if="myForm" onSubmit = "return check(this)">
            <h3 style="text-align:center">NEW DONAR</h3>
            <label><b>Donar Id</b></label>
            <input type="text" name="donar_id" placeholder="Enter ID" size=20 required autocomplete="off" style="margin-left:3.6vw">   <br>        
            <label><b>Name</b></label>
            <input type="text" name="name" placeholder="Enter Name" size=20 required autocomplete="off" style="margin-left:5.5vw"><br>
            <label><b>Address</b></label>
            <input type="text" name="address" placeholder="Enter Address" size=20 required autocomplete="off" style="margin-left:3.7vw"><br>
            <label><b>Phone No</b></label>
            <input type="text" name="phone_no" placeholder="Enter Phone Number" size=20 required autocomplete="off" style="margin-left:2.8vw"> <br>
            <label><b>Email ID</b></label>
            <input type="email" name="email_id" placeholder="Enter Email Id" size=20 required autocomplete="off" style="margin-left:3.8vw"> <br>
            <label><b>Age</b></label>
            <input type="number" name="age" placeholder="Enter Age" min=18 size=20 required autocomplete="off" style="margin-left:6.7vw"> <br>
            
            <label><b>Weight</b></label>
            <input type="number" name="weight" placeholder="Enter Weight" step="any" size=20 required autocomplete="off" style="margin-left:4.8vw"> <br>
            
            <label><b>Height</b></label>
            <input type="number" name="height" placeholder="Enter Height"  step="any" size=20 required autocomplete="off" style="margin-left:5vw"> <br>
            
            <label><b>Blood Group</b></label>
            <input type="text" name="blood_grp" placeholder="Enter Blood Group"  step="any" size=20 required autocomplete="off" style="margin-left:1vw"> <br>
            
            <label><b>Emp ID</b></label>
            <input type="text" name="emp_id" placeholder="Enter Employee Id" size=20 required autocomplete="off" style="margin-left:4.5vw"> <br>
            
            <input type="submit" value="ADD" class="button" ><br>
            
        </form>
    </div>



    

        </body>
</html>