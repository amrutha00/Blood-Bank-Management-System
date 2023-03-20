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
        .donar1{
        width:400px;
        height:500px;
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
				<a class="nav-link" href="register.php">Register</a>
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
                $sql = "SELECT donar_id FROM donar where donar_id='$d'";
                $check=$conn->query($sql);
                $flag=0;
                if ($check->num_rows > 0)
                {
                    $sql1="SELECT donar_id FROM  health where donar_id='$d'";
                    $check1=$conn->query($sql1);
                    if ($check1->num_rows <= 0)
                    {
                        $d=mysqli_real_escape_string($conn,$_POST['donar_id']);
                        $s=mysqli_real_escape_string($conn,$_POST['smoking']);
                        $al=mysqli_real_escape_string($conn,$_POST['alcohol']);
                        $c=mysqli_real_escape_string($conn,$_POST['cancer']);
                        $a=mysqli_real_escape_string($conn,$_POST['anemia']);
                        $op=mysqli_real_escape_string($conn,$_POST['surgery']);
                        $ld=mysqli_real_escape_string($conn,$_POST['last_donated']);


                        $sql="INSERT INTO health VALUES('$d','$s','$al','$c','$a','$op','$ld')";

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
                    else
                    {
                        $d=mysqli_real_escape_string($conn,$_POST['donar_id']);
                        $s=mysqli_real_escape_string($conn,$_POST['smoking']);
                        $al=mysqli_real_escape_string($conn,$_POST['alcohol']);
                        $c=mysqli_real_escape_string($conn,$_POST['cancer']);
                        $a=mysqli_real_escape_string($conn,$_POST['anemia']);
                        $op=mysqli_real_escape_string($conn,$_POST['surgery']);
                        $ld=mysqli_real_escape_string($conn,$_POST['last_donated']);


                        $sql="UPDATE health SET smoking='$s',alcohol='$al', cancer='$c', anemia='$a', surgery='$op', last_donated='$ld'
                        where donar_id='$d'";
                        $exists=$conn->query($sql);
                        if ($conn->query($sql) === true) 
                        {
                            echo "<script>
                            alert('Update Successful');
                                </script>";
                        
                        }
                        else 
                        {
                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                         }


                    }

                }
                
                else{
                    echo "<script>
                    alert('Please Register');
                        </script>";
                
                }
                

            }

        
            $conn->close();
            ?>
        </div>



    <div class="donar1" >
        <form action="health.php" method="post" if="myForm" onSubmit = "return check(this)">
            <h3 style="text-align:center">HEALTH</h3>
            <label><b>Donar Id</b></label>
            <input type="text" name="donar_id" placeholder="Enter ID" size=15 required autocomplete="off" style="margin-left:4.8vw">   <br>        
            <label><b>Smoking</b></label>
            <input type="text" name="smoking" placeholder="..." size=15 required autocomplete="off" style="margin-left:4.5vw"><br>
            
            <label><b>Alcohol</b></label>
            <input type="text" name="alcohol" placeholder="..." size=15 required autocomplete="off" style="margin-left:5.3vw"><br>
            
            <label><b>Cancer</b></label>
            <input type="text" name="cancer" placeholder="..." size=15 required autocomplete="off" style="margin-left:5.7vw"><br>

            <label><b>Anemia</b></label>
            <input type="text" name="anemia" placeholder="..." size=15 required autocomplete="off" style="margin-left:5.4vw"><br>
            
            <label><b>Surgery</b></label>
            <input type="text" name="surgery" placeholder="..." size=15 required autocomplete="off" style="margin-left:5.3vw"><br>
            
            <label><b>Last Donated</b></label>
            <input type="text" name="last_donated" placeholder="..." size=15 required autocomplete="off" style="margin-left:2vw"><br>
            
            <input type="submit" value="ADD" class="button" ><br>
            
        </form>
    </div>


        </body>
</html>