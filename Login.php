<?php session_start(); ?>
<!DOCTYPE html>
<!-- พื้นที่สำหรับประกาศการใช้ Script เพื่อจัดการฐานข้อมูล -->


<?php
require_once 'scripts/Myscript.php';
$db_handle = new myDBControl();

if (isset($_POST['username'])) {
    $UN = $_POST['username'];
    $PW = $_POST['password'];

    //echo "SELECT * FROM AuthenData WHERE UsrName = '".$UN."' and UsrPW = '".$PW."' ";

    $AuthenSE = $db_handle->Textquery(
        "SELECT * FROM AuthenData WHERE UsrName = '" .
            $UN .
            "' and UsrPW = '" .
            $PW .
            "' "
    );
    if (!empty($AuthenSE)) {
        $_SESSION['UN'] = $AuthenSE[0]['UsrName'];
        $_SESSION['UT'] = $AuthenSE[0]['UsrType'];
        $_SESSION['UF'] = $AuthenSE[0]['UsrFname'];

        $UsrType = $AuthenSE[0]['UsrType'];
        if ($UsrType == '1') {
            echo "<script type='text/javascript'>";
            echo "alert('คุณคือ Admin');";
            echo "window.location = 'Employee.php'; ";
            echo '</script>';
        } else {
            echo "<script type='text/javascript'>";
            echo "alert('คุณคือ สมาชิก');";
            echo "window.location = 'Personal.php'; ";
            echo '</script>';
        }
    } else {
        echo "<script type='text/javascript'>";
        echo "alert('User หรือ Password ไม่ถูกต้อง...กรุณาตรวจสอบ');";
        echo "window.location = 'Login.php'; ";
        echo '</script>';
    }
}
?>


<html lang="en">
<!-- พื้นที่สำหรับประกาศแหล่งอ้างอิง เช่น การมาตรฐาน Html, fonts, css, images เป็นต้น-->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://kit.fontawesome.com/1a24e19881.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <style>
    body {
        font-family: 'Kanit', sans-serif;
    }

    .center {
        position: absolute;
        left: 50%;
        top: 20%;
        transform: translate(-50%, -50%);
        width: 400px;
        height: 100px;
        background: white;
        border-radius: 10px;
    }

    .center p {
        text-align: center;
        font-size: 30;
    }

    .center form {
        padding: 0 40px;
        box-sizing: border-box;
    }

    form .txt_field {
        position: relative;
        border-bottom: 2px solid #abcdff;
        margin: 30px 0;
    }

    .txt_field input {
        width: 100%;
        padding: 0 5px;
        height: 40px;
        font-size: 16px;
        border: none;
        background: none;
        outline: none;
    }

    .txt_field label {
        position: absolute;
        top: 50%;
        left: 5px;
        color: gray;
        transform: translateY(-50%);
        font-size: 16px;
        pointer-events: none;
        transition: .5s;
    }

    .txt_field input:focus~label,
    .txt_field input:valid~label {
        top: -5px;
        color: #abcdff;
    }

    .txt_field input:focus~span::before,
    .txt_field input:valid~span::before {
        width: 100%;
    }

    input[type="submit"] {
        text-align: center;
        width: 100%;
        height: 50px;
        border: 1px solid;
        background: #728bb1;
        border-radius: 25px;
        font-size: 18px;
        color: white;
        font-weight: 700;
        cursor: pointer;
        outline: none;

    }

    input[type="submit"]:hover {
        border-color: #abcdff;
        background: #fff;
        transition: .5s;
        color: #abcdff;
    }
    </style>

    <title>Log in</title>
</head>

<body class="body">

    <div class="menubar">
        <div class="container">
            <?php include 'Menubar.php'; ?>
        </div>
    </div>

    <div class="clearfix"></div>


    <form action="Login.php" method="POST">

        <div class="center">

            <p style="font-weight:bolder; font-size:30px; color:#728bb1;">WELCOME TO</p>
            <img src="img/Logo.png" alt="Logo Image"
                style="width : 320px; height: 200px; padding-top: 10px; display: block; margin: auto;">
            <h1 style="text-align: center; font-size: 20px; font-weight:bolder; margin-top: 50px; color:#728bb1;">Log In
            </h1>
            <form method="post">
                <form action="Login.php" method="POST" enctype="multipart/form-data">
                    <div class="txt_field">
                        <input type="text" required name="username" id="usname" value="E0006">
                        <label>Username</label>
                    </div>
                    <div class="txt_field">
                        <input type="password" required name="password" id="passwd" value="qwerty">
                        <label>Password</label>
                    </div>
                    <input type="submit" value="Log-in">
                </form>
            </form>
            <div class="text">
                <p style="margin-top: 50px; font-size: 10px; font-weight:bolder; margin-bottom: 10px;"></p>

            </div>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>

</body>

</html>