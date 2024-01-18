<?php
session_start();
require_once 'scripts/Myscript.php';
$db_handle = new myDBControl();

if (isset($_SESSION['UT'])) {
    $userLogin = $_SESSION['UN'];
} else {
    echo "<script type = 'text/javascript'>";
    echo "alert('คุณไม่มีสิทธิ์เข้าถึง');";
    echo "window.location = 'Login.php';";
    echo '</script>';
}

if (isset($_GET['work'])) {
    $wk = $_GET['work'];

    if ($wk == 'A') {
        if (isset($_GET['Pid'])) {
            $Pid = $_GET['Pid'];
        }
        $check = $db_handle->Textquery(
            "SELECT COUNT(*) AS countrow FROM BASKET_DETAIL WHERE Product_id = '$Pid' AND Basket_status = '0'"
        ); //นับรายการสินค้าในตะกร้า
        if ($check[0]['countrow'] > 0) {
            $update = $db_handle->Execquery(
                "UPDATE BASKET_DETAIL SET Product_num = Product_num+1 WHERE Product_id = '$Pid' AND Cust_id = '$userLogin' "
            );
            echo "<script type = 'text/javascript'>";
            echo "alert('คุณมีสินค้านี้อยู่ในตะกร้าแล้ว');";
            echo "window.location = 'Cart.php';";
            echo '</script>';
            exit();
        } else {
            $data1 = $db_handle->Textquery(
                'SELECT MAX(Basket_id) AS Bid FROM BASKET_DETAIL'
            );
            $Bid = $data1[0]['Bid'] + 1;

            $data2 = $db_handle->Textquery(
                "SELECT * FROM PRODUCT WHERE Product_id = '$Pid'"
            );
            $Pprice = $data2[0]['Product_price'];
            $Pun = $data2[0]['Product_unit'];

            $Cartwork = $db_handle->Execquery(
                "INSERT INTO BASKET_DETAIL VALUES ('$Bid','$userLogin','$Pid',1,'$Pun','$Pprice','0')"
            );

            if ($Cartwork) {
                echo "<script type = 'text/javascript'>";
                echo "alert('เพิ่มสินค้าเรียบร้อย');";
                echo "window.location = 'Cart.php';";
                echo '</script>';
            } else {
                echo "<script type = 'text/javascript'>";
                echo "alert('เพิ่มสินค้าไม่สำเร็จ');";
                echo "window.location = 'Cart.php';";
                echo '</script>';
            }
        }
    } // work = A
    if ($wk == 'B') {
        //ยืนยันการซื้อสินค้า
        // 1. ตรวจสอบว่ามีสินค้าถูกเลือกหรือไม่
        if (empty($_POST['chk'])) {
            echo "<script type = 'text/javascript'>";
            echo "alert('ไม่พบการเลือกสินค้า');";
            echo "window.location = 'Cart.php';";
            echo '</script>';
        } else {
            // 2. กำหนดใบคำสั่งซื้อ S0000-
            $Invid = $db_handle->GetInvoiceNumber();
            // 3. เรียกดูข้อมูลจาก $_GET("Pro_Chk[]") ว่ามีรหัสไหนถูกเลือก
            foreach ($_POST['chk'] as $Pid) {
                $Pdetial = $db_handle->Textquery(
                    "SELECT * FROM BASKET_DETAIL WHERE (Cust_id = '" .
                        $userLogin .
                        "') AND (Product_id = '" .
                        $Pid .
                        "')"
                );
                $Pnum = $Pdetial[0]['Product_num'];
                $Punit = $Pdetial[0]['Product_unit'];
                $Pprice = $Pdetial[0]['Product_price'];

                //3.1 INSERT INTO invoice_detail
                $InsCf = $db_handle->Execquery(
                    "INSERT INTO INVOICE_DETAIL (Inv_no, Product_id, Product_num, Product_unit, Product_price) VALUES ('" .
                        $Invid .
                        "','" .
                        $Pid .
                        "'," .
                        $Pnum .
                        ",'" .
                        $Punit .
                        "'," .
                        $Pprice .
                        ')'
                );
                if (!$InsCf) {
                }
                //3.2 DELETE FROM basket_detail
                $DelCf = $db_handle->Execquery(
                    "DELETE FROM BASKET_DETAIL WHERE (Cust_id = '" .
                        $userLogin .
                        "') AND (Product_id = '" .
                        $Pid .
                        "')"
                );
                if (!$DelCf) {
                }

                //3.3 UPDATE SET product ลบจำนวนสินค้า
                $UpCf = $db_handle->Execquery(
                    'UPDATE PRODUCT SET Product_count = Product_count-' .
                        $Pnum .
                        " WHERE (Product_id = '" .
                        $Pid .
                        "')"
                );
                if (!$UpCf) {
                }
            }
            // 4. สร้างใบคำสั่งซื้อ Invoice_head
            $Date = date('d/m/Y');

            $InsCf = $db_handle->Execquery(
                "INSERT INTO INVOICE (Inv_no, Inv_date, Inv_cust, Inv_emp, Inv_status, Inv_shipping) VALUES ('" .
                    $Invid .
                    "','" .
                    $Date .
                    "','" .
                    $userLogin .
                    "','-','0','0')"
            );
            if ($InsCf) {
                echo "<script type = 'text/javascript'>";
                echo "alert('เพิ่มสินค้าเรียบร้อย');";
                echo "window.location = 'Cart.php';";
                echo '</script>';
            } else {
                echo "<script type = 'text/javascript'>";
                echo "alert('เกิดข้อผิดพลาดในการเพิ่มสินค้า');";
                echo "window.location = 'Cart.php';";
                echo '</script>';
            }
        }
    } ///work=B
    if ($wk == 'D') {
        $Bid = $_GET['Bid'];
        //echo "DELETE FROM PRODUCT WHERE (Product_id = '$Pid')";
        $Cartwork = $db_handle->Execquery(
            "DELETE FROM BASKET_DETAIL WHERE (Basket_id = '$Bid')"
        );

        if ($Cartwork) {
            echo "<script type = 'text/javascript'>";
            echo "alert('ลบสินค้าของท่านรียบร้อย');";
            echo "window.location = 'Cart.php';";
            echo '</script>';
        } else {
            echo "<script type = 'text/javascript'>";
            echo "alert('ลบสินค้าไม่สำร็จ');";
            echo "window.location = 'Cart.php';";
            echo '</script>';
        }
    }
}

?>