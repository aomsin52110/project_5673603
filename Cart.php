<?php session_start(); ?>
<!DOCTYPE html>

<?php
require_once 'scripts/Myscript.php';
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
            <?php include 'Membermenu.php' ?>
    </div>
    <form action="CartProcess.php?work=B" method="POST" enctype="multipart/form-data">
        <?php 
            $custdetail = $db_handle->Textquery("SELECT * FROM MEMBER WHERE Cust_id = '".$userLogin."' ");
            ?> 
        <div class="container mt-4">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                <p><span class="h2">Shopping Cart </span><span class="h4"></span></p>
                <p class="lead fw-normal mb-0"><?php echo  $custdetail[0]["Cust_firstname"]; ?></p>
                <div class="card mb-4">
                    <div class="card-body p-4">
                        
                        <?php $SUM=0; $Product_Data = $db_handle->Textquery("SELECT A.Product_num * A.Product_price AS Ptoal, A.*, B.* FROM BASKET_DETAIL A INNER JOIN PRODUCT B ON (A.Product_id = B.Product_id) WHERE Cust_id = '$userLogin'");
                        foreach($Product_Data as $key=>$value){
                        ?>
                        
                        <div class="row align-items-center">
                            <div class="col-md d-flex justify-content-center form-check">
                                <input class="form-check-input" type="checkbox" name="chk[]" value="<?php echo $Product_Data[$key]["Product_id"]; ?>">
                                <label class="form-check-label" for="flexCheckDefault">
                                </label>
                            </div>
                            <div class="col-md-2 d-flex justify-content-center">
                                <img src="<?php echo  $Product_Data[$key]["Product_picture"]; ?>"
                                class="img-fluid" alt="Generic placeholder image">
                            </div>
                            <div class="col-md-2 d-flex justify-content-center">
                                <div>
                                    <label class="small text-muted mb-4 pb-2"></label>
                                    <p class="lead fw-normal mb-0" name = "Pid"><?php echo $Product_Data[$key]["Product_id"]; ?></p>
                                </div>
                            </div>
                            <div class="col-md-2 d-flex justify-content-center">
                                <div>
                                    <label class="small text-muted mb-1 pb-1"></label>
                                    <p class="lead fw-normal mb-0" name = "Pna"><?php echo $Product_Data[$key]["Product_name"]; ?></p>
                                </div>
                            </div>
                            <div class="col-md d-flex justify-content-center">
                                <div>
                                <label class="small text-muted mb-4 pb-2"></label> 
                                <input id="form1" min="0" onkeypress="return enter(event)" name="Pnum" value="<?php echo $Product_Data[$key]["Product_num"]; ?>" type="number"
                                class="form-control form-control-sm" style="width: 50px;" />
                
                                </div>
                            </div>
                            <div class="col-md-2 d-flex justify-content-center">
                                <div>
                                    <label class="small text-muted mb-4 pb-2"></label>
                                    <p class="lead fw-normal mb-0" name="Pprice"><?php echo $Product_Data[$key]["Product_price"]; ?> บาท</p>
                                </div>
                            </div>
                            <div class="col-md-1 d-flex justify-content-center">
                                <div>
                                    <label class="small text-muted mb-4 pb-2"></label>
                                    <p class="lead fw-normal mb-0" name="Ptotal"><?php echo $Product_Data[$key]["Ptoal"]; ?> บาท</p>
                                </div>
                            </div>
                            <div class="col-md-1 d-flex justify-content-center">
                                <div>
                                <p class="small text-muted mb-4 pb-2"></p>
                                    <a href="CartProcess.php?Bid=<?php echo$Product_Data[$key]["Basket_id"]; ?>&work=D" onclick="return confirm('กรุณยืนยันการลบข้อมูล')" class="text-danger"><i class="fas fa-trash fa-lg"></i></a>
                                </div>
                            </div>
                        </div>
                        <?php $SUM=$SUM+$Product_Data[$key]["Ptoal"];
                    } ?>
                    </div>
                        

                </div>

                <div class="card mb-5">
                    <div class="card-body p-4">

                        <div class="float-end">
                            <p class="mb-0 me-5 d-flex align-items-center">
                                <span class="small text-muted me-2">Order total:</span> <span
                                class="lead fw-normal"><?PHP echo $SUM; ?> บาท</span>
                            </p>
                        </div>

                    </div>
                </div>
                
                <div class="d-flex justify-content-end">
                    <a class ="btn btn-light btn-lg me-2" href="product.php" role="button">Continue shopping</a>
                    <button type="submit" class="btn btn-primary btn-lg">Buy</button>
                </div>
    
                </div>
            </div>
        </div>
    </form>                 
    <script>
    function enter(e) {
        if ( e.keyCode == 13 ) {
            alert("ยืนยันที่จะเพิ่มจำนวน");
            return false;
        }
    }
</script>
    <footer>
            <p>Copyright © 2021 | Software Engineering - Lampang Rajabhat University.</p>
    </footer>
</body>
</html>