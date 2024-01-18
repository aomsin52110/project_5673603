<!DOCTYPE html>
<!-- พื้นที่สำหรับประกาศการใช้ Script เพื่อจัดการฐานข้อมูล -->
<?php
require_once('scripts/Myscript.php');
$db_handle = new myDBControl();
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

 <style>
        boby {
            color: 	# FFC0CB;
        }
        .center{
            position: absolute;
            margin-top: 20%;
 	    margin-bottom: 27%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
	    hight: 100px;
            background: white;
            border-radius: 10px;
            }
        .center p{
            text-align: center;
            font-size: 30;
            }
        .center form{
            padding: 0 40px;
            box-sizing: border-box;
            }
        form .txt_field{
            position: relative;
            border-bottom: 2px solid #997950;
            margin: 30px 0;
            }
        .txt_field input{
            width: 100%;
            padding: 0 5px;
            height: 40px;
            font-size: 16px;
            border: none;
            background: none;
            outline: none;
            }
        .txt_field label{
            position: absolute;
            top: 50%;
            left: 5px;
            color: 	#CA8462;
            transform: translateY(-50%);
            font-size: 16px;
            pointer-events: none;
            transition: .5s;
            }
        .txt_field input:focus ~ label,
        .txt_field input:valid ~ label{
            top: -5px;
            color: black;
            }
        .txt_field input:focus ~ span::before,
        .txt_field input:valid ~ span::before{
            width: 100%;
            }
        input[type="submit"]{
	text-align: center;
	    width: 100%;
            height: 50px;
            border: 1px solid;
            background: #A16B34;
            border-radius: 25px;
            font-size: 18px;
            color: white;
            font-weight: 700;
            cursor: pointer;
            outline: none;

            }
        input[type="submit"]:hover{   
            border-color:: #4a3989;
            transition : .5s;
            }
    </style>

    </head>

<body class="body">
    <!-- 1. เมนูบาร์ และ Banner (ถ้ามี) -->
    <!-- แสดงเมนูบาร์ -->
    <div class="menubar">
        <?php include('Menubar.php')?> 
    </div>

    <div class="container">

        <header class="header mt-1">
            <div class="header_area">
            </div>
        </header>

       


        <!-- 2. สืบค้นข้อมูลสินค้าทั้งหมด SELECT  -->
        <?php $product_array = $db_handle->Textquery("SELECT *, LEFT(PRODUCT.Product_name,18) AS Pname FROM PRODUCT INNER JOIN PRODUCT_TYPE ON (PRODUCT.Product_type=PRODUCT_TYPE.Type_no)");
        if (!empty($product_array)) { ?>
            <div class="clearfix"></div>
            <table class="table1">
                <!-- 3.1 Loop -->
                
                <?php
                foreach ($product_array as $key => $value) 
                { ?>
                    <?php if (($key+1)%4==1){?><tr><?php } ?>
                         <td>

				<div class="property-card " style="width: 220px; box-shadow: 0 0 5px #d3d3d3; padding: auto;">
						<div class="property-image">
        					 <div class="property-image-title">
         					    <img src="<?php echo $product_array[$key]["Product_picture"]; ?>"style="margin:auto; width:150px; height:150px;">
       						 </div>
      					</div>
				        <div class="property-description">
      					 <h5>   <div class="card-title" style="padding-left 20px; text-align: center; font-size:18px; color:blue;"><b>id : <?php echo $product_array[$key]["Product_id"]; ?></div>
                                <div class="card-text" style=" font-size:16px; text-align: center; font-weight:bolder;"><?php echo $product_array[$key]["Pname"]; ?>ฯ</div>
                                <div class="card-text" style=" font-size:16px; text-align: center;font-weight:bold;"><?php echo $product_array[$key]["Type_name"]; ?></div>
                                <div class="card-text" style=" font-size:16px; text-align: center;" >ราคาขาย : <?php echo $product_array[$key]["Product_price"]; ?> บาท</div>
                                <div class="card-text" style=" font-size:16px; text-align: center;">คงเหลือ :<?php echo $product_array[$key]["Product_count"]; ?> หน่วย</div>
                            </h5>
      				    </div>

                </div>
                            <!--end-card -->
                        </td>
                    <?php if (($key+1)%4==0){ ?> </tr> <?php } ?>
                <?php /*end-for*/ } ?>
               
            </table>
        <?php }/*end-if !empty*/ ?>


    </div>
    <!--end-container -->
</body>

</html>