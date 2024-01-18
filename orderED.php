<?php session_start(); ?>
<!DOCTYPE html>
<!-- พื้นที่สำหรับประกาศการใช้ Script เพื่อจัดการฐานข้อมูล -->
<?php
require_once('scripts/Myscript.php');
$db_handle = new myDBControl();

if (isset($_SESSION["UT"])) {
    $userLogin = $_SESSION["UN"];
    $userFname = $_SESSION["UF"];
} else {
  echo "<script type = 'text/javascript'>";
  echo "alert('คุณไม่มีสิทธิ์เข้าถึง');";
  echo "window.location = 'Login.php';";
  echo "</script>";
}

$Oid = $db_handle->GetOrderNumber();
//$Oid = "xxxx";


//T ส่วนงานแสดงรายการสินค้า และการค้นหา
$T = "SELECT *, LEFT(PRODUCT.Product_name,10) AS Pname FROM PRODUCT INNER JOIN PRODUCT_TYPE ON (PRODUCT.Product_type=PRODUCT_TYPE.Type_no)";
//echo $T;


if (isset($_GET['Ptype'])) {
    if ($_GET['Ptype'] != "00") {
        $T = $T . " WHERE (Product_Type = '" . $_GET['Ptype'] . "')";
    }
} else {
    $Ptype  = '00';
}

if (isset($_POST['Proname'])) {
    $PN  = $_POST['Proname'];
    $T = $T . " WHERE (Product_name LIKE '%" . $_POST['Proname'] . "%')";
} else {
    $PN  = '';
}

//ส่วนงานจัดการสั่งซื้อสินค้า Array
if (isset($_GET["wk"])) {
    switch ($_GET["wk"]) {
        case "a":
            $pid = $_POST['pid'];
            if (!empty($_POST["qty"])) {
                $qty = $_POST['qty'];
                //echo "SELECT *, CONCAT(Left(Product_name,15),'..') AS Pname FROM PRODUCT WHERE Product_id ='" . $_POST["pid"] . "'";
                $productByCode = $db_handle->Textquery("SELECT *, CONCAT(Left(Product_name,15),'..') AS Pname FROM PRODUCT WHERE Product_id ='" . $_POST["pid"] . "'");
                
                $itemArray = array($productByCode[0]["Product_id"] => (array(
                    'pname' => $productByCode[0]["Pname"],
                    'pid'   => $productByCode[0]["Product_id"],
                    'qty'   => $_POST["qty"],
                    'price' => $productByCode[0]["Product_price"],
                    'image' => $productByCode[0]["Product_picture"]
                )));
            }
            if (isset($_SESSION["cart_item"])) {
                if (in_array($productByCode[0]["Product_id"], array_keys($_SESSION["cart_item"]))) {
                    foreach ($_SESSION["cart_item"] as $k => $v) {
                        //echo "<script> console.log('$k'); </script>";
                        if ($productByCode[0]["Product_id"] == $k) {
                            if (empty($_SESSION["cart-item"][$k]["qty"])) {
                                $_SESSION["cart_item"][$k]["qty"] = 1;
                            }
                            $_SESSION["cart_item"][$k]["qty"] += $_POST["qty"];
                        }
                    }
                } else {
                    $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
                }
            } else {
                $_SESSION["cart_item"] = $itemArray;
            }
            break;
        case "d":
            if (!empty($_SESSION["cart_item"])) {
                foreach ($_SESSION["cart_item"] as $k => $v) {
                    if ($_GET["pid"] == $k)
                        unset($_SESSION["cart_item"][$k]);
                    if (empty($_SESSION["cart_item"]))
                        unset($_SESSION["cart_item"]);
                }
            }
            break;
        case "c":
            if (!empty($_SESSION["cart_item"])) {
                $osid   = $_POST["Orsup"];
                $odate  = date_format(date_create($_POST["Ordate"]), "d/m/Y");
                $oid    = $_POST["Orid"];
                //echo $osid, '=', $odate, '=', $oid, '<br>';
                foreach ($_SESSION["cart_item"] as $k => $v) {
                    //INSERT INTO ORDER_DETAIL                  
                    $pid = $k;
                    $num = $_SESSION["cart_item"][$k]["qty"];
                    //echo "INSERT INTO ORDER_DETAIL VALUES ('$oid','$pid','$num') <br>";
                    $insOrderDt = $db_handle->Execquery("INSERT INTO ORDER_DETAIL VALUES ('$oid','$pid','$num')");

                    //UPDATE Qty PRODUCT
                    //echo "UPDATE PRODUCT SET Product_count = Product_count+'$num' WHERE Product_id = '$pid' <br>";
                    $updOrderDt = $db_handle->Execquery("UPDATE PRODUCT SET Product_count = Product_count+'$num' WHERE Product_id = '$pid'");
                }
                //INSERT INTO ORDER
                //echo "INSERT INTO `ORDER` VALUES ('$oid','$odate','$osid','$userLogin' <br>)";
                $insOrder = $db_handle->Execquery("INSERT INTO `ORDER` VALUES ('$oid','$odate','$osid','$userLogin')");
                unset($_SESSION["cart_item"]);
            }
            break;
    }
}

// echo "<pre>";
// print_r($_SESSION["cart_item"]);
// echo "</pre>";
?>

<html lang="en">
<!-- พื้นที่สำหรับประกาศแหล่งอ้างอิง เช่น การมาตรฐาน Html, fonts, css, images เป็นต้น-->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Stock Management</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://unpkg.com/feather-icons"></script>
</head>


<!-- พื้นที่สร้างงาน -->

<body class="body">
<?php include 'Menubarem.php' ?>
    <!-- แสดงพื้นที่ทำงาน-->
    <div class="container mt-2">
        <div class="card text-dark" style="height:600px;">
            <!-- style="height:600px;" -->
            <div class="card text-center text-white m-2 pt-2" style="margin:5px;background-color:#728bb1">
                <h5 m-0><strong>Stock Management</strong></h5>
            </div>
            <div class="row mt-2">
                <!--Zone : 1.Display all -->
                <div class="col-7">
                    <div class="row mt-2">
                        <!-- Search and Selected -->
                        <div class="col-6 m-0 p-0 pl-4 mt-1">
                            <form action="orderED.php" method="post" enctype="multipart/form-data">
                                <div class="input-group p-1" >
                                    <!-- <div class="form-outline"> -->
                                    <input type="search" style="font-size: 10pt;  " class="form-control p-1" name="Proname" size="30" placeholder="ค้นหาสินค้า" />
                                    <!-- </div> -->
                                    <input type="Submit" class="btn btn-sm ml-1" value="Search" style="background-color:#728bb1; color:#FFFF; ">
                                </div>
                            </form>
                        </div>
                        <div class="col-6 mt-1">
                            <div class="row float-right">
                                <div class="input-group p-1" style="font-size:14px;margin-left: 200px;">
                                    <!-- <div class="form-outline"> -->
                                    <select class="btn  dropdown-toggle" name="Ptype" onchange="window.location='orderED.php?Ptype='+this.value+''" style="Font-size:10pt;">
                                        <option value="00">ประเภทสินค้า</option>
                                        <?php
                                        $Typerow = $db_handle->Textquery("SELECT Type_no, Type_name FROM PRODUCT_TYPE");
                                        foreach ($Typerow as $key => $value) { ?>
                                            <option value="<?php echo $Typerow[$key]["Type_no"]; ?>"><?php echo $Typerow[$key]["Type_name"]; ?></option>
                                        <?php } ?>
                                        <option value="00">แสดงทั้งหมด</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>                        

                    <!-- end search and select type------ -->

                    <?php $product_array = $db_handle->Textquery($T);
                    if (!empty($product_array)) { ?>
                        <div class="clearfix"></div>
                        <div style="margin-left:1px; height:425px; overflow:auto; margin:0;">
                            <!-- 475px -->
                            <table class="table1 ml-2">
                                <!-- 3.1 Loop -->
                                <?php
                                foreach ($product_array as $key => $value) { ?>
                                    <?php if (($key + 1) % 4 == 1) { ?><tr><?php } ?>
                                        <td>
                                            <div class="card mt-2 mr-2 pb-2" style="font-size:12px; width:115px; ">
                                                <!-- 3.1.1 ตรวจสอบการแสดงต่อแถว (4 รายการสินค้า/แถว) -->
                                                <!-- 3.1.2 แสดงสินค้าใน กล่องพื้นที่ -->
                                                <img src="<?php echo $product_array[$key]["Product_picture"]; ?>" style="margin:auto; width:50px; height:50px;">
                                                <div class="card-title text-center m-0" style="color:red;"><b>id : <?php echo $product_array[$key]["Product_id"]; ?></b></div>
                                                <div class="card-text pl-2"><?php echo $product_array[$key]["Pname"]; ?>ฯ</div>
                                                <div class="card-text pl-2">คงเหลือ : <?php echo $product_array[$key]["Product_count"]; ?>หน่วย</div>
                                                <div class="card-text pl-2">
                                                    <form action="orderED.php?wk=a" method="POST" enctype="multipart/form-data">
                                                        <input type="text" name="pid" value="<?php echo $product_array[$key]["Product_id"]; ?>" hidden>
                                                        <input type="number" class="ml-2 p-0 text-center" name="qty" value="1" min="1" max="100">
                                                        <button type="submit" class="btn btn-sm p-0" style="width: 30px; height:23px;background-color: #728bb1;"><i data-feather="check" style="width:15px;"></i></button>
                                                    </form>
                                                </div>
                                            </div>
                                            <!--end-card -->
                                        </td>
                                        <?php if (($key + 1) % 4 == 0) { ?>
                                        </tr> <?php } ?>
                                <?php } /*end-for */ ?>
                            </table>
                        </div>
                    <?php } /*end-if !empty */ ?>
                </div>
                <!-- Close Zone : 1.Display all product -->
                
                <div class="col-5 p-0" style="font-size:10pt;">

                    <div class="col p-0 pr-4">
                        <div class="card mt-2 mr-0 mb-2" style="background-color:  #FFFFFF; height:520px;">
                            <div class="row">
                                <div class="col-7">
                                    <p class="m-1 pt-2 pl-2 fw-bold" style="font-size:16px;"><strong>รายการสินค้าสั่งซื้อ</strong></p>
                                </div>
                            </div>

                            <div style="height:211px; overflow:auto; margin:0;">
                                <table class="table table-sm bg-light" style="border-radius:.50rem; ">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>id</th>
                                            <th>Product name</th>
                                            <th>Price</th>
                                            <th>Count</th>
                                            <th>Total</th>
                                            <th width="5%">Del</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $total = 0;
                                        $count = 0;
                                        if (isset($_SESSION["cart_item"])) {
                                            foreach ($_SESSION["cart_item"] as $item) {
                                                $count++;
                                                $total += ($item["price"] * $item["qty"]);
                                        ?>
                                                <tr>
                                                    <td><img src="<?php echo $item["image"]; ?>" style="width:30px; height:30px;" round></td>
                                                    <td><?php echo $item["pid"]; ?></td>
                                                    <td class="text-left"><?php echo $item["pname"]; ?></td>
                                                    <td><?php echo number_format($item["price"]); ?></td>
                                                    <td><?php echo $item["qty"]; ?></td>
                                                    <td><?php echo number_format($item["price"] * $item["qty"]) ?></td>
                                                    <td class="text-center"><a href="orderED.php?wk=d&pid=<?php
                                                                                                        echo $item["pid"]; ?>" onclick="return confirm('กรุณายืนยันการลบข้อมูล ?')" role="button"><i data-feather="trash-2" style="color: Red; width:15px;"></i></a></td>
                                                </tr>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <tr>
                                                <td colspan="8" class="text-center">- No Data -</td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="row  m-0 text-right text-light" style="font-size :10pt; background-color: #728bb1;">
                                <div class="col-4"><b>Total</b></div>
                                <div class="col-3"><b><?php echo $count; ?> รายการ</b></div>
                                <div class="col-4"><b><?php echo number_format($total, 2); ?> บาท</b></div>
                            </div>

                            <form action="orderED.php?wk=c" method="POST">
                                <div class="card" style="background-color: #D2DAFF;">
                                    <p class="m-1 pt-2 pl-2 fw-bold" style="font-size:16px;"><strong>ดำเนินการสั่งซื้อสินค้า</strong></p>
                                    <div class="card-text">
                                        <div class="row m-0 ml-2">
                                            <label>จัดซื้อจากบริษัท/ผู้ผลิต : </label>
                                            <select class="form-control mr-2" name="Orsup" style="font-size:10pt;">
                                                <?php
                                                $Sup_row = $db_handle->Textquery("SELECT * FROM SUPPLIER ORDER BY Sup_id");
                                                if (!empty($Sup_row)) {
                                                    foreach ($Sup_row as $key => $value) { ?>
                                                        <option value="<?php echo $Sup_row[$key]["Sup_id"]; ?>"><?php echo $Sup_row[$key]["Sup_name"]; ?></option>
                                                <?php }
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row m-0 ml-2">
                                        <div class="col-sm-6 p-0">
                                            <div class="form-group mt-1 mr-2">
                                                <label>วันที่จัดซื้อ</label>
                                                <input type="datetime" name="Ordate" class="form-control" style="font-size:10pt;" value="<?php echo date('d-m-Y'); ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 p-0">
                                            <div class="form-group mt-1 mr-2">
                                                <label>เลขที่จัดซื้อ</label>
                                                <input type="text" name="Orid" class="form-control" style="font-size:10pt;" value="<?php echo $Oid; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row align-items-center ml-3 mb-4">
                                        <div class="col-sm-5">
                                            <button type="button" class="btn  btn-sm" style="width: 80px;height:35px; text-align:center;background-color:#728bb1; color:#FFFF;margin-left: 65px;">Confirm</button>
                                        </div>
                                        <div class="col-sm-3">
                                            <button type="button" class="btn  btn-sm" style="width:80px; height:35px; text-align:center;background-color:#AF0118; color:#FFFF;margin-left: 65px; ">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>




        </div>
        <!-- Close Zone : 2.order detail -->
    </div>
    <!--end-container -->
    <script>
        feather.replace()
    </script>
</body>

</html>