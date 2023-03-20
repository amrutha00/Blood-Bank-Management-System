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


            if($_SERVER['REQUEST_METHOD']=="POST")
            {
                $rec=mysqli_real_escape_string($conn,$_POST['rec_id']);
                $p=mysqli_real_escape_string($conn,$_POST['patient_id']);
                $pay=mysqli_real_escape_string($conn,$_POST['payment']);
                $date=mysqli_real_escape_string($conn,$_POST['received_on']);                

                $sql="SELECT * from patient where patient_id='$p'";
                
                $res=$conn->query($sql);
                if($res->num_rows>0)  
                {
                    $sql1="SELECT * from donar where donar_id='$rec'";
                    $res1=$conn->query($sql1);
                    if($res1->num_rows>0)
                    {
                        $sql2="SELECT * from receiver where rec_id='$rec' and patient_id='$p'";
                       
                        $res2=$conn->query($sql2);
                        if($res2->num_rows>0)
                        {
                            $sql3="UPDATE receiver set payment='$pay', received_on='$date' where rec_id='$rec' and patient_id='$p'";
                            $res3=$conn->query($sql3);
                            if($res3 === true)
                            {
                                echo "<script>alert('Updated succesfully');</script>";
                                
                            }
                            else
                            {
                                echo "<script>alert('Not Updated');</script>";
                            }
                        }
                        else
                        {
                            $sql3="INSERT INTO receiver VALUES('$rec','$p','$pay','$date')";
                            $res3=$conn->query($sql3);
                            if($res3 === true)
                            {
                                echo "<script>alert('Inserted succesfully');</script>";
                            }
                            else
                            {
                                echo "<script>alert('Not Inserted');</script>";
                            }
                        }

                       /* $sql4="SELECT payment from receiver where rec_id='$rec' and patient_id='$p'";
                        $res4=$conn->query($sql4);*/
                        if($pay === 'REPLACEMENT')
                        {
                            $sql5="SELECT blood_group,bottles from patient where patient_id='$p' ";
                            $res5= $conn->query($sql5);
                            if($res5->num_rows>0)
                            {
                                $row = $res5->fetch_assoc();
                                echo "REPLACEMENT FOR ". $row["bottles"]." units of ". $row["blood_group"]." blood";
                                echo "<script>window.location = 'donate.php'</script>";
                            }
                        }
                        else
                        {
                            $temp_res=$conn->query("DROP TABLE IF EXISTS temp ");
                            $temp_cre=$conn->query("CREATE table temp as SELECT blood_group,volume/250,cost from stock  WHERE blood_group in (SELECT c FROM compatible WHERE blood_group in(SELECT blood_group FROM patient WHERE patient.patient_id='$p'))ORDER BY volume DESC");
                            $bill_res=$conn->query("DROP TABLE IF EXISTS bill ");
                            $bill_create=$conn->query("CREATE TABLE bill (bill_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,cost INT NOT NULL) SELECT R.rec_id,R.patient_id,P.h_pid,P.name,P.reason,P.blood_group,P.bottles,R.payment,R.received_on,R.emp_id FROM receiver as R  join patient as P
                            ON R.patient_id=P.patient_id
                            WHERE R.rec_id='$rec' and R.patient_id='$p'");
                            $up=$conn->query("UPDATE bill,temp SET bill.cost=(temp.cost)*bottles WHERE EXISTS (SELECT cost from temp LIMIT 1)");
                            $update=$conn->query("UPDATE cost,bill set cost.cost=bill.cost where cost.rec_id='$rec' and cost.patient_id='$p'");
                            $one=$conn->query("SELECT blood_group,cost from temp limit 1");
                            $row = $one->fetch_assoc();
                            $bg=$row["blood_group"];
                            
                            $s_up=$conn->query("UPDATE stock,temp,bill set stock.volume=stock.volume-(bill.bottles*250) where stock.blood_group='$bg' ");
                            $s_re=$conn->query("UPDATE stock set stock.refill=1 where stock.volume<500 ");
                            echo "<script>window.location = 'bill.php'</script>";
                        }
                    }
                    else
                    {
                        echo "<script>alert('Please Register');</script>";
                    }
                }
                else
                {
                    echo "<script>alert('No patient with the given Id');</script>";
                               
                }
            }


            

            
            
            $conn->close();
            ?>
        </div>
        

        <div class="receiver" >
        <form action="payment.php" method="post" if="myForm" onSubmit = "return check(this)">
            <h3 style="text-align:center">PAYMENT</h3><br>
            <label><b>Receiver Id</b></label>
            <input type="text" name="rec_id" placeholder="..." size=15 required autocomplete="off" style="margin-left:3.8vw">   <br>        
            <label><b>Patient Id</b></label>
            <input type="text" name="patient_id" placeholder="..." size=15 required autocomplete="off" style="margin-left:5vw">   <br>        
            <label><b>Payment Mode</b></label>
            <input type="text" name="payment" placeholder="..." size=15 required autocomplete="off" style="margin-left:1.5vw"><br>
            
            <label><b>Date</b></label>
            <input type="text" name="received_on" placeholder="..." size=15 required autocomplete="off" style="margin-left:8vw"><br>

            
           <br> <input type="submit" value="CHECK" class="button" ><br>
            
        </form>
    </div>


    </body>
</html>