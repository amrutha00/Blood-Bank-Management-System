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
        .blood{
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
    <body > 

        <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
			<a class="navbar-brand" href="../index.html">Home</a>
			<ul class="navbar-nav">
				<li class="nav-item">
				<a class="nav-link" href="database.php">Database</a>
				</li>
				<li class="nav-item">
				<a class="nav-link" href="orders.php">Orders</a>
				</li>
				<li class="nav-item">
				<a class="nav-link" href="patient.php">Patients</a>
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
                
                $h=mysqli_real_escape_string($conn,$_POST['hospital_id']);
                $n=mysqli_real_escape_string($conn,$_POST['h_name']);
                $a=mysqli_real_escape_string($conn,$_POST['location']);
                $p=mysqli_real_escape_string($conn,$_POST['phone_no']);
                   
               
                $sql = "SELECT hospital_id FROM hospital where h_name='$n' and phone_no='$p'";
                
                $check=$conn->query($sql);
                 
                $flag=0;
                if ($check->num_rows <= 0)
                {
                    $sql="INSERT INTO hospital VALUES('$h','$n','$a','$p')";

                        if ($conn->query($sql) === true) 
                        {
                            echo "<script>
                            alert('Insert Successful');
                                </script>";
                        
                        }
                        else 
                        {
                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                         }
                          
                    
                
                }
                
                else{
                    echo "<script>
                    alert('Id Exists');
                        </script>";
                
                }
                

            }

        
            $conn->close();
            ?>
        </div>



    <div class="blood" >
        <form action="hospital.php" method="post" if="myForm" onSubmit = "return check(this)">
            <h3 style="text-align:center">HOSPITAL</h3><br>
            <label><b>Hospital Id</b></label>
            <input type="text" name="hospital_id" placeholder="..." size=15 required autocomplete="off" style="margin-left:3vw">   <br>        
            <label><b>Name</b></label>
            <input type="text" name="h_name" placeholder="..." size=15 required autocomplete="off" style="margin-left:6.2vw"><br>
            
            <label><b>Location</b></label>
            <input type="text" name="location" placeholder="..." size=15 required autocomplete="off" style="margin-left:4.3vw"><br>
            
            <label><b>Phone No</b></label>
            <input type="text" name="phone_no" placeholder="..." size=15 required autocomplete="off" style="margin-left:3.7vw"><br>

            
           <br> <input type="submit" value="ADD" class="button" ><br>
            
        </form>
    </div>


        </body>
</html>