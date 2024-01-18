<?php 
 session_start();
 require_once('scripts/Myscript.php');
 $db_handle = new myDBControl();

if(isset($_GET['work'])){
    $wk = $_GET['work'];

    if($wk == 'A'){
        $Pid = $_POST['Pid'];
        $Pna = $_POST['Pna'];
        $Pun = $_POST['Pun'];
        $Ptype = $_POST['Ptype'];
        $Pprice = $_POST['Pprice'];
        $Pcost = $_POST['Pcost'];
        $Pdet = $_POST['Pdet'];
        
          
        $prowork = $db_handle->Execquery("INSERT INTO 'PRODUCT' ('Product_id', 'Product_name', 'Product_type', 'Product_unit', 'Product_cost', 'Product_price', 'Product_detail') VALUES ('$Pid','$Pna','$Ptype','$Pun','$Pcost','$Pprice','$Pdet'");

        if($prowork){
            echo "<script type = 'text/javascript'>";
			echo "alert('Saved successfully');";
			echo "window.location = 'EditProduct.php';";
			echo "</script>";
        }else{
            echo "<script type = 'text/javascript'>";
			echo "alert('Failed to save');";
			echo "window.location = 'EditProduct.php';";
			echo "</script>";
        }
    }

    if($wk == 'V'){
        $Pid = $_POST['Pid'];
        $Pna = $_POST['Pna'];
        $Pun = $_POST['Pun'];
        $Ptype = $_POST['Ptype'];
        $Pprice = $_POST['Pprice'];
        $Pcost = $_POST['Pcost'];
        $Pdet = $_POST['Pdet'];
        

        $prowork = $db_handle->Execquery("UPDATE PRODUCT  SET 
	    Product_unit = '$Pun',
	    Product_name = '$Pna',
        Product_type = '$Ptype' 

	WHERE(Product_id='$Pid')");

        if($prowork){
            echo "<script type = 'text/javascript'>";
			echo "alert('Saved successfully');";
			echo "window.location = 'EditProduct.php';";
			echo "</script>";
        }else{
            echo "<script type = 'text/javascript'>";
			echo "alert('Failed to save');";
			echo "window.location = 'EditProduct.php';";
			echo "</script>";
        }
    }

    if($wk == 'D'){
        $Pid = $_GET['Pid'];
        //echo "DELETE FROM PRODUCT WHERE (Product_id = '$Pid')";
        
        $prowork = $db_handle->Execquery("DELETE FROM PRODUCT WHERE (Product_id = '$Pid')");

        if($prowork){
            echo "<script type = 'text/javascript'>";
			echo "alert(' successfully');";
			echo "window.location = 'EditProduct.php';";
			echo "</script>";
        }else{
            echo "<script type = 'text/javascript'>";
			echo "alert('Failed');";
			echo "window.location = 'EditProduct.php';";
			echo "</script>";
        }
    }
}else{
            echo "<script type = 'text/javascript'>";
			echo "alert('NO!!!');";
			echo "window.location = 'EditProduct.php';";
			echo "</script>";
}


?>