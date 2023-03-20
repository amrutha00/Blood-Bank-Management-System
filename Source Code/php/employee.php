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
        height:430px;
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
                
                $eid=mysqli_real_escape_string($conn,$_POST['emp_id']);
                $n=mysqli_real_escape_string($conn,$_POST['e_name']);
                $addr=mysqli_real_escape_string($conn,$_POST['addr']);
                $p=mysqli_real_escape_string($conn,$_POST['phone_no']);
                $e=mysqli_real_escape_string($conn,$_POST['email_id']);
               /* $sql = "SELECT emp_id FROM employee where phone_no='$p' and email_id='$e'";*/
               
                $check=$conn->query("SELECT * from employee where emp_id='$eid'");
                $flag=0;
                if ($check->num_rows > 0)
                {
                   
                     
                    $sql1="UPDATE employee set phone_no='$p',email_id='$e',`address`='$addr' where emp_id='$eid' and e_name='$n'";  
                    $check1=$conn->query($sql1);
                    if ($check1 === true)
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
                
                else{
                   $res=$conn->query("INSERT INTO employee VALUES('$eid','n','$addr','$p','$e')");
                   if($res === true)
                   {
                    echo "<script>
                    alert('Insert Successful');
                        </script>";
                   }
                
                }
                

            }

        
            $conn->close();
            ?>
        </div>



    <div class="donar1" >
        <form action="employee.php" method="post" if="myForm" onSubmit = "return check(this)">
            <h3 style="text-align:center">EMPLOYEE</h3><br>
            <label><b>Id</b></label>
            <input type="text" name="emp_id" placeholder="..." size=15 required autocomplete="off" style="margin-left:10vw">   <br>        
            <label><b>Name</b></label>
            <input type="text" name="e_name" placeholder="..." size=15 required autocomplete="off" style="margin-left:7.6vw"><br>
            
            <label><b>Address</b></label>
            <input type="text" name="addr" placeholder="..." size=15 required autocomplete="off" style="margin-left:5.9vw"><br>
            
            <label><b>Phone No</b></label>
            <input type="text" name="phone_no" placeholder="..." size=15 required autocomplete="off" style="margin-left:5vw"><br>
            <label><b>Email Id</b></label>
            <input type="text" name="email_id" placeholder="..." size=15 required autocomplete="off" style="margin-left:6.2vw"><br>

            
           <br> <input type="submit" value="ADD" class="button" ><br>
            
        </form>
    </div>


        </body>
</html>