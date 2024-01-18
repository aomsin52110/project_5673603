<?php session_start(); ?>
<!DOCTYPE html>

<?php
require_once('scripts/Myscript.php');
$db_handle = new myDBControl();

if (isset($_SESSION["UT"])) {
    $userLogin = $_SESSION["UN"];
    $userFname = $_SESSION["UF"];
} else {
			echo "<script type = 'text/javascript'>";
			echo "alert('You are not Admin');";
			echo "window.location = 'Login.php';";
			echo "</script>";
}

if(isset($_GET['Eid'])){
    $Ecode = $_GET['Eid'];
} else{
    $Ecode = 'E0001';
   
}

if(isset($_GET['work'])){
    $work = $_GET['work'];
} else{
    $work = 'V';
   
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css
" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap
" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
		<style>
table, td, th {
    border: 1px solid  #e5ccff;
    
}

table {
        width: 100%;
}

th {
    text-align: center;
}

.button1 {
    background-color: #728bb1;
    border-radius: 12px;
    color: white;
    padding: 10px 28px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 4px 2px;
    cursor: pointer;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
}
.button1:hover {
    box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
}

.button2 {
    background-color: #e56f67;;
    border-radius: 12px;
    color: white;
    padding: 10px 28px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 4px 2px;
    cursor: pointer;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
}
.button2:hover {
    box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
}
.em th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #728bb1;
  color: #ffffff;
}
.em tr:nth-child(even){background-color: #f2f2f2;}
.em tr:hover {background-color: #ffffb2;}



</style>


</head>
<body>

	<div class="menubar">
        <?php include('Menubarem.php')?> 
    </div>
	

    <div class="container mt-4" >
        <div class="row">
        <div class="col text-center mt-4">
          <div><h1>Employee Management</h1></div>
        </div>
        </div>
        <div class="row">
            <div class="col-7" style="text-align: center; border-radius : 2rem; margin-bottom:5px; ">
		<div class="border p-1 text-center" style= "background-color:#728bb1; color:#570f0f;margin-top: 10px; text-align: center ; border-radius:2rem;  font-size: 18px;">Display All Data </div>
        <div class="col text-right mt-2 ml-2"style = " margin-bottom:15px;">
       <a class="btn" style=" background-color:  #728bb1; color:#ffffff;"href="Employee.php?&work=A" role="button">New data</a>
	<a class="btn "style=" background-color:  #C4D7E0; color:#ffffff;" href="Employee.php" role="button">Refresh</a>
	
        </div>
 		<?php $Employee_Data = $db_handle->Textquery("SELECT * FROM EMPLOYEE ");
 		if (!empty($Employee_Data)) { ?>
           		 <div class="clearfix" ></div>
            		<table class ="em" style = " margin-bottom:15px;" >
					<tr>
					<th>ID</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>View/Delete</th>

					</tr>
				<?php
				foreach($Employee_Data as $key=>$value){ ?>
				<tr>
					<td><?php echo$Employee_Data[$key]["Emp_id"]; ?></td>
					<td><?php echo$Employee_Data[$key]["Emp_firstname"]; ?></td>
					<td><?php echo$Employee_Data[$key]["Emp_lastname"]; ?></td>
					<td>
                    <a href="Employee.php?Eid=<?php echo$Employee_Data[$key]["Emp_id"]; ?>&work=V"   class="button1" role = "button1" >แสดง</button>
                    <a href="EmployeeProcess.php?Eid=<?php echo$Employee_Data[$key]["Emp_id"]; ?>&work=D"  class="button2" 
                    onclick = "return confirm('please confirm ?')" role = "button"  style = " text-align:center;" >ลบ</button>			
					</td>
				</tr>

				<?php } ?>
 
				</table>
		        <?php } ?>
            </div>

           <?php 
                $empdetail = $db_handle->Textquery("SELECT * FROM EMPLOYEE WHERE Emp_id = '".$Ecode."' ");
            ?>



       
            <div class="col-5 p-0"   >
            <form action="EmployeeProcess.php?work=<? echo $work; ?>" method="POST" enctype="multipart/form-data">
              <div class="" style ="margin-top:10px; margin-left:10px; border-radius : 2rem; width:95%;">

<div class="border p-1 text-center text-white bg-success" style= "margin-top: 1px; text-align: center ; border-radius:2rem;  font-size: 18px;">Employee Description : </div>
                    <p></p>

                    <div class ="row ">
                        <div class="col-5" >
                         <label class=" m-0 pl-3 text-right" stlye = "font-size: 7px;"> EmployeeID :</label>
                        </div>
                        <div class="col-7"  >
                      
                            <input class="form-control input-sm" id="inputsm" type="text"  name ="Eid" <?php if ($work <> 'A') {echo 'readonly';} ?> value = "<?php if ($work <> 'A') { echo $empdetail[0]["Emp_id"]; } ?>" >
                        </div>
                    </div>

                    <div class ="row ">
                        <div class="col-5">
                            <label class=" m-0 pl-3 text-right"> User Name :</label>
                        </div>
                        <div class="col-7">
                            
                            <input class="form-control input-sm" id="inputsm" type="text" name ="Eun" value = "<?php if ($work <> 'A') { echo $empdetail[0]["Emp_UN"]; } ?>">
                        </div>
                    </div>

                    <div class ="row ">
                        <div class="col-5">
                            <label class=" m-0 pl-3 text-right"> PassWord :</label>
                        </div>
                        <div class="col-7">
                            <input class="form-control input-sm" id="inputsm" type="text" name ="Epw" value = "<?php if ($work <> 'A') { echo  $empdetail[0]["Emp_PW"]; } ?>">
                        </div>
                    </div>

                    <div class ="row ">
                        <div class="col-5">
                            <label class=" m-0 pl-3 text-right"> Prename :</label>
                        </div>
                        <div class="col-7">
                            <input class="form-control input-sm" id="inputsm" type="text" name ="Epname" value = "<?php if ($work <> 'A') { echo  $empdetail[0]["Emp_prename"]; } ?>" >
                        </div>
                    </div>

                    <div class ="row ">
                        <div class="col-5">
                            <label class=" m-0 pl-3 text-right"> Name :</label>
                        </div>
                        <div class="col-3">
                            <input class="form-control input-sm" id="inputsm" type="text" name ="Efname" value = "<?php if ($work <> 'A') { echo  $empdetail[0]["Emp_firstname"]; } ?>" >
                        </div>
                        <div class="col-4">
                            <input class="form-control input-sm" id="inputsm" type="text" name ="Elname" value = "<?php if ($work <> 'A') { echo  $empdetail[0]["Emp_lastname"]; } ?>">
                        </div>
                    </div>


                    <div class ="row ">
                        <div class="col-5">
                            <label class=" m-0 pl-3 text-right"> Position :</label>
                        </div>
                        <div class="col-7">
                            <input class="form-control input-sm" id="inputsm" type="text" name ="Epos" value = "<?php if ($work <> 'A') { echo  $empdetail[0]["Emp_pos_id"]; } ?>" >
                        </div>
                    </div>

                    <div class ="row ">
                        <div class="col-5">
                            <label class=" m-0 pl-3 text-right"> Person-Code :</label>
                        </div>
                        <div class="col-7">
                            <input class="form-control input-sm" id="inputsm" type="text" name ="Ecode1" value = "<?php if ($work <> 'A') { echo  $empdetail[0]["Emp_code1"]; } ?>" >
                        </div>
                    </div>

                    <div class ="row ">
                        <div class="col-5">
                            <label class=" m-0 pl-3 text-right"> Person-Code 2:</label>
                        </div>
                        <div class="col-7">
                            <input class="form-control input-sm" id="inputsm" type="text" name ="Ecode2" value = "<?php if ($work <> 'A') { echo $empdetail[0]["Emp_code2"]; } ?>" >
                        </div>
                    </div>

                    <div class ="row ">
                        <div class="col-5">
                            <label class=" m-0 pl-3 text-right"> Bank Acc :</label>
                        </div>
                        <div class="col-7">
                            <input class="form-control input-sm" id="inputsm" type="text" name ="Ebank" value ="<?php if ($work <> 'A') { echo  $empdetail[0]["Emp_bank"]; } ?>" >
                        </div>
                    </div>

                    <div class ="row ">
                        <div class="col-5">
                            <label class=" m-0 pl-3 text-right"> Salary :</label>
                        </div>
                        <div class="col-7">
                            <input class="form-control input-sm" id="inputsm" type="text" name ="Esalary" value ="<?php if ($work <> 'A') { echo  $empdetail[0]["Emp_salary"]; } else{echo '0.00';} ?>" >
                        </div>
                    </div>

                    <div class ="row " >
                        <div class="col" >
                            <img src="<?php if ($work <> 'A'){echo  $empdetail[0]["Emp_picture"];} else{echo 'img/2.png';}  ?>"  style="margin-left:15px; width: 100px; border-radius:1rem;height: 100px;"
>
                        </div>
                        <div class="col text-center mt-3">
                            <input type="submit" class="btn " style ="background-color: #D9F8C4; width:150px; text-align: center ; border-radius:2rem; " value="Submit">
                        </div> 
                    </div>
               
		            <p></p>

            </form>
            </div>
        </div>   
    </div>
 

</body>
</html>