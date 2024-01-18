<!DOCTYPE html>

<?php
require_once('scripts/Myscript.php');
$db_handle = new myDBControl();
$T = "SELECT *, LEFT(PRODUCT.Product_name,18) AS Pname FROM PRODUCT INNER JOIN PRODUCT_TYPE ON (PRODUCT.Product_type=PRODUCT_TYPE.Type_no)";

if (isset($_POST['product'])) {
    $T = $T . "WHERE Product_name LIKE '%" . $_POST['product'] . "%'";
}
if (isset($_GET['Ptype'])) {
    $T = $T . "WHERE PRODUCT_TYPE='" . $_GET['Ptype'] . "'";
}
// echo $T;
if (isset($_SESSION["UT"])) {
    $userLogin = $_SESSION["UN"];
    $userFname = $_SESSION["UF"];
} else {
}

?>

<html lang="en">

<head>
    <script src="https://kit.fontawesome.com/1a24e19881.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- insert bootstap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title>รายการสินค้า</title>
</head>

<body>
    <div class="menubar">
        <div class="container">
            <?php include 'Menubarpro.php' ?>
        </div>
        <!-- 2. สืบค้นข้อมูลสินค้าทั้งหมด SELECT  -->
        <?php $product_array = $db_handle->Textquery($T);
        if (!empty($product_array)) { ?>
            <div class="clearfix"></div>
            <table class="table1">
                <table>
                    <!-- 3.1 Loop -->
                    <tr>
                        <?php
                        foreach ($product_array as $key => $value) { ?>
                            <?php if (($key + 1) % 4 == 1) { ?>
                    <tr><?php } ?>
                    <td>
                        <div class="card mt-2 mr-2" style="width:225px; box-shadow: 0 0 15px #d3d3d3;">
                            <!-- 3.1.1 ตรวจสอบการแสดงต่อแถว (4 รายการสินค้า/แถว) -->
                            <!-- 3.1.2 แสดงสินค้าใน กล่องพื้นที่ -->
                            <img src="<?php echo $product_array[$key]["Product_picture"]; ?>" style="margin: auto; width:100px; height:100px;">
                            <div class="card-title" style="margin: auto; font-size:11px; color:red;"><?php echo $product_array[$key]["Product_id"]; ?></div>
                            <div class="card-text" style="margin: auto; font-size:11px; font-weight:Bold;"><?php echo $product_array[$key]["Pname"]; ?></div>
                            <div class="card-text" style="font-size:7px; color:#BEBEBE;"><?php echo $product_array[$key]["Type_name"]; ?></div>
                            <div class="card-text" style="padding-left:130px; font-size:13px; color:red;"><?php echo $product_array[$key]["Product_price"]; ?>บาท</div>
                            <div class="card-text" style="font-size:10px;">คงเหลือ : <?php echo $product_array[$key]["Product_count"]; ?>หน่วย</div>
                            <a class="btn btn-primary" style=" color:#fff;" href="CartProcess.php?Pid=<?php echo $product_array[$key]["Product_id"]; ?>&work=A" role="button">เพิ่มลงตะกร้า</a>
                        </div>
                        <!--end-card -->
                    </td>
                    <?php if (($key + 1) % 4 == 0) { ?>
                    </tr><?php } /*end-for */ ?>
            <?php } /*end-for */ ?>
                </table>
            <?php } /*end-for */ ?>

            <footer>
                <p>Copyright © 2021 | Software Engineering - Lampang Rajabhat University.</p>
            </footer>

    </div>
    <!--end-container -->
</body>

</html>