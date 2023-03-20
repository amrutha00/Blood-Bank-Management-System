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
				<a class="nav-link" href="register.php">Register</a>
				</li>
				<li class="nav-item">
				<a class="nav-link" href="health.php">Health</a>
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
                    $b=mysqli_real_escape_string($conn,$_POST['blood_group']);
                    $dd=mysqli_real_escape_string($conn,$_POST['donated_date']);
                     
                    $sql1="SELECT health.donar_id FROM  health,donar where health.donar_id='$d'and donar.donar_id='$d' and smoking=0 and alcohol=0 and cancer=0 and anemia=0 and surgery=0 and '$dd'>date_add(health.last_donated,INTERVAL 3 MONTH) and  donar.weight>=50 and donar.blood_group='$b'";
                    $check1=$conn->query($sql1);
                    if ($check1->num_rows > 0)
                    {
                        //$d=mysqli_real_escape_string($conn,$_POST['donar_id']);
                        //$b=mysqli_real_escape_string($conn,$_POST['blood_group']);
                        $v=mysqli_real_escape_string($conn,$_POST['volume']);
                        

                        $sql="INSERT INTO blood VALUES('$d','$v','$dd',0,'$b')";

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
                       
                        echo "<script>
                        alert('You are not eligible to donate!');
                            </script>";
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
        <form action="donate.php" method="post" if="myForm" onSubmit = "return check(this)">
            <h3 style="text-align:center">DONATE</h3><br>
            <label><b>Donar Id</b></label>
            <input type="text" name="donar_id" placeholder="Enter ID" size=15 required autocomplete="off" style="margin-left:5vw">   <br>        
            <label><b>Blood Group</b></label>
            <input type="text" name="blood_group" placeholder="..." size=15 required autocomplete="off" style="margin-left:2.4vw"><br>
            
            <label><b>Volume</b></label>
            <input type="text" name="volume" placeholder="..." size=15 required autocomplete="off" style="margin-left:5.8vw"><br>
            
            <label><b>Date</b></label>
            <input type="text" name="donated_date" placeholder="..." size=15 required autocomplete="off" style="margin-left:7.6vw"><br>

            
           <br> <input type="submit" value="ADD" class="button" ><br>
            
        </form>
    </div>


        </body>
</html>