<!DOCTYPE html>
<!-- พื้นที่สำหรับประกาศการใช้ Script เพื่อจัดการฐานข้อมูล -->
<?php
require_once('scripts/Myscript.php');
$db_handle = new myDBControl();
if(isset($_GET['Pid'])){
    $Proid = $_GET['Pid'];
    $No    = $_GET['No'];
} else{
    $Proid = 'S01';
    $No    =1;
}
?>



<html lang="en">
<!-- พื้นที่สำหรับประกาศแหล่งอ้างอิง เช่น การมาตรฐาน Html, fonts, css, images เป็นต้น-->
<html xmlns="http://www.w3.org/1999/xhtml
">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Product Gallary</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css
" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap
" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="body">
    <!-- 1. เมนูบาร์ และ Banner (ถ้ามี) -->
    <!-- แสดงเมนูบาร์ -->
    <div class="menubar">
        <?php include('Menubar.php')?> 
    </div>

    <div class="container">

        <header class="header2 mt-1">
            <div class="header_area2">
            </div>
        </header>
   
        <!-- 2. สืบค้นข้อมูลสินค้าทั้งหมด SELECT  -->
        <?php $product_array = $db_handle->Textquery("SELECT PRODUCT.*, LEFT(PRODUCT.Product_name,20) AS Pname, Type_name, SUM(INVOICE_DETAIL.Product_num) AS Product_Sale FROM INVOICE_DETAIL INNER JOIN PRODUCT ON (INVOICE_DETAIL.Product_id = PRODUCT.Product_id) INNER JOIN PRODUCT_TYPE ON (PRODUCT.Product_type=PRODUCT_TYPE.Type_no) GROUP BY PRODUCT.Product_id  ORDER BY Product_Sale DESC, Product_id LIMIT 5 ");
        
        if (!empty($product_array)) 
        { ?>
            <div class="clearfix"></div>
            <table class="table1">
                <!-- 3.1 Loop -->
                
                <?php
                foreach ($product_array as $key => $value) 
                { ?>
                 <?php if (($key+1)%5==1){?><tr><?php } ?>
                         <td>
                            <div class="card mt-3 mr-3 " style="width: 170px; box-shadow: 0 0 15px #d3d3d3;">
                                
                                <img src="<?php echo $product_array[$key]["Product_picture"]; ?>" style="margin:auto; width:120px; height:120px;">
                                <div class="card-title" style="text-align: center; padding-left 20px; font-size:16px; color:red;"><b>id : <?php echo $product_array[$key]["Product_id"]; ?></div>
                                <div class="card-text" style=" text-align: center; font-size:16px; font-weight:bolder;"><?php echo $product_array[$key]["Pname"]; ?>ฯ</div>
                                <div class="card-text" style=" text-align: center; color:blue; font-weight:bold;"><?php echo $product_array[$key]["Type_name"]; ?></div>
                                <div class="card-text" style="text-align: center;" >ราคาขาย : <?php echo $product_array[$key]["Product_price"]; ?> บาท</div>
                                <div class="card-text"style="text-align: center;" >คงเหลือ :<?php echo $product_array[$key]["Product_count"]; ?> หน่วย</div>
                                <a class="btn btn-sm" style="width:100%;text-align:center; background-color:#ffff89;" href="BestSeller2.php?Pid=<?php echo $product_array[$key]["Product_id"];?>&No=<?php echo $key +1 ?>">รายละเอียด</a>
                            </div>
                            <!--end-card -->
                        </td>
                    <?php if (($key+1)%5==0){ ?> </tr> <?php } ?>
                <?php /*end-for*/ } ?>
            </table>
        <?php }/*end-if !empty*/ ?>

        <?php $product_detail = $db_handle->Textquery("SELECT * FROM PRODUCT INNER JOIN PRODUCT_TYPE ON (PRODUCT.Product_type=PRODUCT_TYPE.Type_no) WHERE Product_id= '".$Proid."' ");
        if (!empty($product_detail)) 
        { ?>
            <div class="clearfix"></div>
            <table class="table1">
                <!-- 3.1 Loop -->
                
                <?php
                foreach ($product_detail as $key => $value) 
                { ?>
                    <td>
                            <div class="card mt-3 mr-3 " style="width: 280px; box-shadow: 0 0 15px #d3d3d3;">
            <div class="card-title" style="padding-top :10px; padding-left : 120px; font-size:16px; color:red;"><b>id : <?php echo $product_detail[$key]["Product_id"]; ?></b></div>
                                <img src="<?php echo $product_detail[$key]["Product_picture"];?>" style="margin:auto; width:250px; height:250px;">
                            </div>
                         </td>
                         <td>
                            <div class="card mt-3 mr-3 " style="padding-top :30px; width:620px; height:300px; box-shadow: 0 0 15px #d3d3d3;background-color:#efe0ff;">
                              <div class="card-title" style="padding-left :20px; font-size:16px; color:red;"><b>ขายดีอันดับ <?php echo $No ?> </b></div>
                              <div class="card-text" style=" padding-left :20px; font-size:16px; font-weight:bolder;"> ชื่อสินค้า :<?php echo $product_detail[$key]["Product_name"]; ?>ฯ</div>
                              <div class="card-text" style=" padding-left :20px; color:blue; font-weight:bold;"> ประเภทสินค้า :<?php echo $product_detail[$key]["Type_name"]; ?></div>
                              <div class="card-text" style=" padding-left :20px; " >ราคาขาย : <?php echo $product_detail[$key]["Product_price"]; ?> บาท</div>
                              <div class="card-text" style=" padding-left :20px; " >รายละเอียด :<?php echo $product_detail[$key]["Product_detail"]; ?> หน่วย</div>
                            </div>
                            <!--end-card -->
                        </td></tr> 
                <?php /*end-for*/ } ?>
            </table>
        <?php }/*end-if !empty*/ ?>
    </div>
    <!--end-container -->
</body>

</html>