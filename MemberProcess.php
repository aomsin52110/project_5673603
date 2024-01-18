<?php 
 session_start();
 require_once('scripts/Myscript.php');
$db_handle = new myDBControl();
// รับค่า สถนะการทำงาน  A V D
if(isset($_GET['work'])){
    $wk = $_GET['work'];

    if($wk == 'A'){
        //
        $Cid = $_POST['Cid'];
        $Cun = $_POST['Cun'];
        $Cpw = $_POST['Cpw'];
        $Cpname = $_POST['Cpname'];
        $Cfname = $_POST['Cfname'];
        $Clname = $_POST['Clname'];
        $Clev = $_POST['Clev'];
        $Cbirth = $_POST['Cbirth'];
        $Caddress = $_POST['Caddress'];
        $Ctel = $_POST['Ctel'];
        

       // echo "INSERT INTO EMPLOYEE VALUES ('$Eun','$Epw','$Eid','$Epname','$Efname','$Elname','$Epos',
       // '$Ecode1','$Ecode2','$Ebank','$Esalary','img/1.png')";
  
        
        $Memwork = $db_handle->Execquery("INSERT INTO MEMBER VALUES ('$Cun','$Cpw','$Cid','$Cpname','$Cfname','$Clname','$Clev',
       '$Cbirth', '$Caddress','$Ctel','img/1.png')");

        if($Memwork){
            echo "<script type = 'text/javascript'>";
			echo "alert('Saved successfully');";
			echo "window.location = 'Member.php';";
			echo "</script>";
        }else{
            echo "<script type = 'text/javascript'>";
			echo "alert('Failed to save');";
			echo "window.location = 'Member.php';";
			echo "</script>";
        }
    }

    if($wk == 'V'){
        //แก้ไขข้อมูล
        $Cid = $_POST['Cid'];
        $Cun = $_POST['Cun'];
        $Cpw = $_POST['Cpw'];
        $Cpname = $_POST['Cpname'];
        $Cfname = $_POST['Cfname'];
        $Clname = $_POST['Clname'];
        $Clev = $_POST['Clev'];
        $Cbirth = $_POST['Cbirth'];
        $Caddress = $_POST['Caddress'];
        $Ctel = $_POST['Ctel'];

        //echo "UPDATE EMPLOYEE VALUES SET Emp_prename = '$Epname',Emp_firstname = '$Efname',Emp_lastname='$Elname',
        //Emp_salary = '$Esalary' WHERE(Emp_id='$Eid')";
        
        $Memwork = $db_handle->Execquery("UPDATE MEMBER  SET 
        Cust_prename = '$Cpname',Cust_firstname = '$Cfname',Cust_lastname='$Clname',
        Cust_address = '$Caddress',Cust_birth-'$Cbirth' WHERE(Cmp_id='$Cid')");

        if($Memwork){
            echo "<script type = 'text/javascript'>";
			echo "alert('Saved successfully');";
			echo "window.location = 'Member.php';";
			echo "</script>";
        }else{
            echo "<script type = 'text/javascript'>";
			echo "alert('Failed to save');";
			echo "window.location = 'Member.php';";
			echo "</script>";
        }
    }

    if($wk == 'D'){
        $Cid = $_GET['Cid'];
        // echo "DELETE FROM EMPLOYEE WHERE (Emp_id = '$Eid')";
        
        $Memwork = $db_handle->Execquery("DELETE FROM  MEMBER WHERE (Cust_id = '$Cid')");

        if($Memwork){
            echo "<script type = 'text/javascript'>";
			echo "alert(' successfully');";
			echo "window.location = 'Member.php';";
			echo "</script>";
        }else{
            echo "<script type = 'text/javascript'>";
			echo "alert('Failed');";
			echo "window.location = 'Member.php';";
			echo "</script>";
        }
    }
}else{
            echo "<script type = 'text/javascript'>";
			echo "alert('NO!!!');";
			echo "window.location = 'Member.php';";
			echo "</script>";
}


?>
