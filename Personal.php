<?php session_start(); ?>
<!DOCTYPE html>

<?php
require_once 'scripts/Myscript.php';
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

if (isset($_GET['Cid'])) {
  $Ccode = $_GET['Cid'];
} else {
  $Ccode = 'C0002';
}

if (isset($_GET['work'])) {
  $work = $_GET['work'];
} else {
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
    <style>
table,
td,
th {
    border: 1px solid #e5ccff;

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
    -webkit-transition-duration: 0.4s;
    /* Safari */
    transition-duration: 0.4s;
}

.button1:hover {
        box-shadow: 0 12px 16px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0 rgba(0, 0, 0, 0.19);
}

.button2 {
    background-color: #e56f67;
    ;
    border-radius: 12px;
    color: white;
    padding: 10px 28px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 4px 2px;
    cursor: pointer;
    -webkit-transition-duration: 0.4s;
    /* Safari */
    transition-duration: 0.4s;
}

.button2:hover {
    box-shadow: 0 12px 16px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0 rgba(0, 0, 0, 0.19);
}

.em th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: center;
    background-color: #728bb1;
    color: #ffffff;
}

.em tr:nth-child(even) {
    background-color: #f2f2f2;
}

.em tr:hover {
    background-color: #ffffb2;
}
    </style>


</head>

<body>

    <div class="menubar">
      <?php include 'Membermenu.php'; ?>
    </div>

    <div class="container mt-4" >
        <div class="row">
        <div class="col text-center mt-4">
            <div><h1>My Profile</h1></div>
        </div>
        </div>

            <?php 
            $custdetail = $db_handle->Textquery("SELECT * FROM MEMBER WHERE Cust_id = '".$userLogin."' ");
            ?>        
        <div class="row">          
        <div class="col-5 p-0"   >
            <form action="MenberProcess.php?work=<? echo $work; ?>" method="POST" enctype="multipart/form-data">
                <div class="" style ="margin-top:10px; margin-left:10px; border-radius : 2rem; width:95%;">

                <div class="border p-1 text-center text-white bg-success" style= "margin-top: 1px; text-align: center ; border-radius:2rem;  font-size: 18px;">Member Description :</div>
                    <p></p>

                    <div class ="row ">
                        <div class="col-5" >
                         <label class=" m-0 pl-3 text-right" stlye = "font-size: 7px;"> UserName :</label>
                        </div>
                        <div class="col-7"  >
                      
                            <input class="form-control input-sm" id="inputsm" type="text"  name ="Uid" <?php if ($work <> 'A') {echo 'readonly';} ?> value = "<?php if ($work <> 'A') { echo $custdetail[0]["Cust_UN"]; } ?>" >
                        </div>
                    </div>

                    <div class ="row ">
                        <div class="col-5">
                            <label class=" m-0 pl-3 text-right"> Password :</label>
                        </div>
                        <div class="col-7">
                            
                            <input class="form-control input-sm" id="inputsm" type="text" name ="Cpw" value = "<?php if ($work <> 'A') { echo $custdetail[0]["Cust_PW"]; } ?>">
                        </div>
                    </div>

                    <div class ="row ">
                        <div class="col-5">
                            <label class=" m-0 pl-3 text-right"> Prename :</label>
                        </div>
                        <div class="col-7">
                            <input class="form-control input-sm" id="inputsm" type="text" name ="Cpname" value = "<?php if ($work <> 'A') { echo  $custdetail[0]["Cust_prename"]; } ?>">
                        </div>
                    </div>


                    <div class ="row ">
                        <div class="col-5">
                            <label class=" m-0 pl-3 text-right"> Menber Name :</label>
                        </div>
                        <div class="col-3">
                            <input class="form-control input-sm" id="inputsm" type="text" name ="Cfname" value = "<?php if ($work <> 'A') { echo  $custdetail[0]["Cust_firstname"]; } ?>" >
                        </div>
                        <div class="col-4">
                            <input class="form-control input-sm" id="inputsm" type="text" name ="Clname" value = "<?php if ($work <> 'A') { echo  $custdetail[0]["Cust_lastname"]; } ?>">
                        </div>
                    </div>


                    <div class ="row ">
                        <div class="col-5">
                            <label class=" m-0 pl-3 text-right"> Menber Level :</label>
                        </div>
                        <div class="col-7">
                            <input class="form-control input-sm" id="inputsm" type="text" name ="Clev" value = "<?php if ($work <> 'A') { echo  $custdetail[0]["Cust_level"]; } ?>" >
                        </div>
                    </div>

                    <div class ="row ">
                        <div class="col-5">
                            <label class=" m-0 pl-3 text-right"> Birthday :</label>
                        </div>
                        <div class="col-7">
                            <input class="form-control input-sm" id="inputsm" type="text" name ="Cbirth" value = "<?php if ($work <> 'A') { echo  $custdetail[0]["Cust_birth"]; } ?>" >
                        </div>
                    </div>

                    <div class ="row ">
                        <div class="col-5">
                            <label class=" m-0 pl-3 text-right"> Adderss :</label>
                        </div>
                        <div class="col-7">
                            <input class="form-control input-sm" id="inputsm" type="text" name ="Caddress" value = "<?php if ($work <> 'A') { echo $custdetail[0]["Cust_address"]; } ?>" >
                        </div>
                    </div>

                    <div class ="row ">
                        <div class="col-5">
                            <label class=" m-0 pl-3 text-right"> Telephone :</label>
                        </div>
                        <div class="col-7">
                            <input class="form-control input-sm" id="inputsm" type="text" name ="Ctel" value ="<?php if ($work <> 'A') { echo  $custdetail[0]["Cust_tel"]; } ?>" >
                        </div>
                    </div>


                    <div class ="row " >
                        <div class="col text-center mt-3">
                            <input type="submit" class="btn " style ="background-color: #D9F8C4; width:150px; text-align: center ; border-radius:2rem; " value="Submit">
                        </div> 
                    </div>

               
		            <p></p>

            </form>
        </div>
        </div>
        <div class="col-7">
            <div class="img">
                <img src="<?php if ($work <> 'A'){echo  $custdetail[0]["Cust_picture"];} else{echo 'img/2.png';} ?>" 
                style="width : 300px; height: 300px; border-radius:50px; display: block; margin: auto; margin-top: 65px; ">
            </div>
        </div>
    </div>


    

</body>

</html>