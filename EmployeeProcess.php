<?php session_start();
require_once('scripts/Myscript.php');
$db_handle = new myDBControl();

//รับค่าตัวแปร สถานะการทำงาน [A : Add, V : Viwe/Update, D " Delete]
if (isset($_GET['work'])) {
    $wk = $_GET['work'];

    if ($wk=='A'){
        //เพิ่มข้อมูลใหม่
        $Eid        = $_POST['Eid'];
        $Eun        = $_POST['Eun'];
        $Epw        = $_POST['Epw'];
        $Epname     = $_POST['Epname'];
        $Efname     = $_POST['Efname'];
        $Elname     = $_POST['Elname'];
        $Epos       = $_POST['Epos'];
        $Ecode1     = $_POST['Ecode1'];
        $Ecode2     = $_POST['Ecode2'];
        $Ebank      = $_POST['Ebank'];
        $Esalary    = $_POST['Esalary'];

        //echo "INSERT INTO EMPLOYEE VALUES ('$Eun','$Epw','$Eid','$Epname','$Efname','$Elname','$Epos','$Ecode1','$Ecode2','$Ebank','$Esalary','img/ntv.jpg')";
    
        $empwork = $db_handle->Execquery("INSERT INTO EMPLOYEE VALUES ('$Eun','$Epw','$Eid','$Epname','$Efname','$Elname','$Epos','$Ecode1','$Ecode2','$Ebank','$Esalary','img/ntv.jpg')");

        if ($empwork){
            echo "<script type = 'text/javascript'>";
            echo "alert('บันทึกเรียบร้อย');";
            echo "window.location = 'Employee.php';";
            echo "</script>";
        } else{
            echo "<script type = 'text/javascript'>";
            echo "alert('บันทึกสำเร็จ...กรุณาตรวจสอบ');";
            echo "window.location = 'Employee.php';";
            echo "</script>";
        }


    }

    if ($wk=='V'){
        //แก้ไขข้อมูลใหม่
        $Eid        = $_POST['Eid'];
        $Eun        = $_POST['Eun'];
        $Epw        = $_POST['Epw'];
        $Epname     = $_POST['Epname'];
        $Efname     = $_POST['Efname'];
        $Elname     = $_POST['Elname'];
        $Epos       = $_POST['Epos'];
        $Ecode1     = $_POST['Ecode1'];
        $Ecode2     = $_POST['Ecode2'];
        $Ebank      = $_POST['Ebank'];
        $Esalary    = $_POST['Esalary'];

        echo "UPDATE EMPLOYEE SET Emp_prename = '$Epname', Emp_firstname = '$Efname', Emp_lastname = '$Elname', Emp_salary = '$Esalary' WHERE (Emp_id = '$Eid')";
        $empwork = $db_handle->Execquery("UPDATE EMPLOYEE SET Emp_prename = '$Epname', Emp_firstname = '$Efname', Emp_lastname = '$Elname', Emp_salary = '$Esalary' WHERE (Emp_id = '$Eid')");
    
        if ($empwork){
            echo "<script type = 'text/javascript'>";
            echo "alert('ปรับปรุงเรียบร้อย');";
            echo "window.location = 'Employee.php';";
            echo "</script>";
        } else{
            echo "<script type = 'text/javascript'>";
            echo "alert('ปรับปรุงสำเร็จ...กรุณาตรวจสอบ');";
            echo "window.location = 'Employee.php';";
            echo "</script>";
        }
    }

    if ($wk=='D'){
        //ลบข้อมูลใหม่
        $Eid        = $_GET['Eid'];
        echo "DELETE FROM EMPLOYEE WHERE (Emp_id = '$Eid')";

        $empwork = $db_handle->Execquery("DELETE FROM EMPLOYEE WHERE (Emp_id = '$Eid')");
    
        if ($empwork){
            echo "<script type = 'text/javascript'>";
            echo "alert('ลบเรียบร้อย');";
            echo "window.location = 'Employee.php';";
            echo "</script>";
        } else{
            echo "<script type = 'text/javascript'>";
            echo "alert('ลบไม่สำเร็จ...กรุณาตรวจสอบ');";
            echo "window.location = 'Employee.php';";
            echo "</script>";
        }
    }

}else{
    echo "<script type = 'text/javascript'>";
    echo "alert('คำสั่งไม่ถูกต้อง กรุณาตรวจสอบ');";
    echo "window.location = 'Employee.php';";
    echo "</script>";
    }


?>