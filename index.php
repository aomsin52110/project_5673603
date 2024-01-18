<!DOCTYPE html>

<?php
    require_once('scripts/Myscript.php');
    $db_handle = new myDBControl();
    
    /// รับค่าตัวแปร
    if(isset($_GET['Pid'])) {
        $Proid = $_GET['Pid'];
        $No    = $_GET['No'];
    } else {
        $Proid = 'S01';
        $No    = 1;
    }
?>


<html lang="en">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <script src="https://kit.fontawesome.com/1a24e19881.js" crossorigin="anonymous"></script>
    <title>SE-Store</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="body">
    <div class="menubar">
        <div class="container">
            <?php include 'Menubar.php' ?>
        </div>

        <div class="clearfix"></div>

        <div class="container">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                        class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="img/slide/P08.png" class="d-block w-100 mx-auto" alt="First Slide">
                    </div>
                    <div class="carousel-item">
                        <img src="img/slide/P09.png" class="d-block w-100 mx-auto" alt="Second Slide">
                    </div>
                    <div class="carousel-item">
                        <img src="img/slide/P07.png" class="d-block w-100 mx-auto" alt="Third Slide">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button " data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <div>
                <img src="img/slide/P01.png" alt="" style="height:390px; width: 465px; margin-top: 15px; ">
                <img src="img/slide/P04.png" alt="" style="height:390px; width: 465px; margin-top: 15px; ">
            </div>
            <div>
                <center><img src="img/Best seller.png" alt="" style="height:160px; width: 210px; margin:auto;"></center>
            </div>

            <!-- 2. สืบค้นข้อมูลสินค้าทั้งหมด SELECT  -->
            <?php $product_array = $db_handle->Textquery("SELECT PRODUCT.*, LEFT(PRODUCT.Product_name,20) AS Pname, Type_name, SUM(INVOICE_DETAIL.Product_num) AS Product_Sale FROM INVOICE_DETAIL INNER JOIN PRODUCT ON (INVOICE_DETAIL.Product_id = PRODUCT.Product_id) INNER JOIN PRODUCT_TYPE ON (PRODUCT.Product_type=PRODUCT_TYPE.Type_no) GROUP BY PRODUCT.Product_id  ORDER BY Product_Sale DESC LIMIT 10");
    if (!empty($product_array))
    {?>
            <table>
                <!-- 3.1 Loop -->
                <tr>
                    <?php
        foreach($product_array as $key=>$value)
        {?>
                    <?php if (($key+1)%5==1){ ?>
                <tr><?php } ?>
                    <td>
                        <div class="card mt-2 mr-2" style="width:178px; box-shadow: 0 0 3px #f2f2f2;">
                            <!-- 3.1.1 ตรวจสอบการแสดงต่อแถว (4 รายการสินค้า/แถว) -->
                            <!-- 3.1.2 แสดงสินค้าใน กล่องพื้นที่ -->
                            <img src="<?php echo $product_array[$key]["Product_picture"];?>"
                                style="margin: auto; width:100px; height:100px;">
                            <div class="card-title" style="margin: auto; font-size:11px; color:red;">
                                <?php echo $product_array[$key]["Product_id"];?></div>
                            <div class="card-text" style="margin: auto; font-size:11px; font-weight:Bold;">
                                <?php echo $product_array[$key]["Pname"];?></div>
                            <div class="card-text" style="font-size:7px; color:#BEBEBE;">
                                <?php echo $product_array[$key]["Type_name"];?></div>
                            <div class="card-text" style="padding-left:130px; font-size:13px; color:red;">
                                <?php echo $product_array[$key]["Product_price"];?>บาท</div>
                            <div class="card-text" style="font-size:10px;">คงเหลือ :
                                <?php echo $product_array[$key]["Product_count"];?>หน่วย</div>
                            <a class="btn" href="Cart.php?Pid=<?php echo $product_array["Product_id"];?>&act=add"
                                role="button">เพิ่มลงตะกร้า <img src="img/Icon/02.png" alt="shopping-cart"></a>
                        </div>
                        <!--end-card -->
                    </td>
                    <?php if (($key+1)%5==0) { ?></tr><?php } /*end-for */?>
                <?php } /*end-for */?>
            </table>
            <?php } /*end-for */?>

            <div class="continue">
                <a href="product.php">
                    <button class="flex">
                        See more...
                        <span>
                            <i class="fa-solid fa-right-long"></i>
                        </span>
                    </button>
                </a>
            </div>



            <section class="Contact">
            </section>
        </div>



        <footer>
            <p>Copyright © 2021 | Software Engineering - Lampang Rajabhat University.</p>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
        </script>
</body>
</body>

</html>