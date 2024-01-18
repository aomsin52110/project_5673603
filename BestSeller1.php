<!DOCTYPE html>
<!-- ????????????????????????? Script ???????????????????? -->
<?php
    require_once('scripts/Myscript.php');
    $db_handle = new myDBControl();
?>

<html lang="en">
<!-- ??????????????????????????????? ???? ?????????? Html, fonts, css, images ???????-->
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
    <link rel="stylesheet" href = "css/style.css">
</head>
<body class="body">

<div class="menubar">
        <?php include('Menubar.php'); ?>
    </div>
    <div class="clearfix"></div>
    
    <div class="container">

        <header class="header2 mt-1">
            <div class="header_area2">
            </div>
        </header>
   
	        

    <?php $product_array = $db_handle->Textquery("SELECT PRODUCT.*, Type_name, SUM(INVOICE_DETAIL.Product_num) AS Product_Sale FROM INVOICE_DETAIL INNER JOIN PRODUCT ON (INVOICE_DETAIL.Product_id = PRODUCT.Product_id) INNER JOIN PRODUCT_TYPE ON (PRODUCT.Product_type=PRODUCT_TYPE.Type_no) GROUP BY PRODUCT.Product_id  ORDER BY Product_Sale DESC LIMIT 5");
    if (!empty($product_array))
    {?>
        <div class="clearfix"></div>
        <table class="table1">
        <table>
        <!-- 3.1 Loop -->
        <tr>
        <?php
        foreach($product_array as $key=>$value)
        {?>

		<div class="card mb-3" style=" max-width:auto; box-shadow: 0 0 15px #d3d3d3; margin-top:10px; margin-bottom:10px;border-radius : 2rem;">
  			<div class="row g-0">
    				<div class="col-md-4">
      					<img src="<?php echo $product_array[$key]["Product_picture"];?>" style="margin-top:10px; margin-left:35px; width:250px; height:250px;">
    				</div>
    			<div class="col-md-8" style=" background: #F0F8FF; border-radius  : 1rem;"">
      				<div class="card-body >
        				<h5 class="card-title" style="padding-left:25px; font-size:20px; color:blue;"><div class="card-title" ><b>No: <?php echo $key +1 ?></b></div></h5>
        					<p class="card-text"> 
		<div class="card-title" style="padding-left:20px; font-size:18px; color:red;"><b>id : <?php echo $key +1 ?></b></div>
                <div class="card-text" style="padding-left:20px; font-size:16px; font-weight:bold;">Name: <?php echo $product_array[$key]["Product_name"];?></div>
                <div class="card-text" style="padding-left:20px;  font-size:14px;  color:#BEBEBE;">Type : <?php echo $product_array[$key]["Type_name"];?></div>
                <div class="card-text" style="padding-left:20px; font-size:16px;">Price : <?php echo $product_array[$key]["Product_price"];?>Bath</div>
                <div class="card-text" style="padding-left:20px; font-size:16px;">Detail : <?php echo $product_array[$key]["Product_detail"];?></div></p>
             			</div>
    			</div>
  			</div>
		</div>
        
        <?php } /*end-for */?>
        </table>
    <?php } /*end-for */?>
    
    </div> <!--end-container -->
</body>
</html>