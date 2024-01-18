<div class="logo mt-2">
    <a href="index.php"><img src="img/Logo.png" alt="Logo Image"></a>
    <form action="product.php" method="POST">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Search" aria-label="product-name"
                aria-describedby="basic-addon2" name="product">
            <div class="input-group-append">
                <button class="btn btn-secondary" type="submit">
                    <i class="fa-solid fa-search"></i>
                </button>
            </div>
        </div>
    </form>
    <div>
        <ul class="menu mt-1">
            <li>
                <a href="product.php?Ptype=T1"><b>บริโภค-สำเร็จรูป</b></a>
            </li>
            <li>
                <a href="product.php?Ptype=T2"><b>บริโภค-เครื่องปรุง</b></a>
            </li>
            <li>
                <a href="product.php?Ptype=T3"><b>บริโภค-เครื่องดื่ม</b></a>
            </li>
            <li>
                <a href="product.php?Ptype=T4"><b>เวชสำอาง</b></a>
            </li>
            <li>
                <a href="product.php?Ptype=T5"><b>เครื่องแต่งกาย</b></a>
            </li>
            <li>
                <a href="product.php?Ptype=T6"><b>เครื่องใช้ไฟฟ้า</b></a>
            </li>
            <li>
                <a href="product.php?Ptype=T7"><b>ยาเวชภัณฑ์</b></a>
            </li>
        </ul>
    </div>
</div>
<ul class="menu mt-3">
    <li>
        <a href="index.php">Home</a>
    </li>
    <li>
        <a href="Cart.php" class="bi bi-basket">Cart</a>
    </li>
    <li>
        <a href="product.php">Product</a>
    </li>
    <li>
        <i class="ri-user-4-line" color:#fb9b42;"><?php if (
            isset($_SESSION['UF'])
        ) {
            echo $_SESSION['UF'];
        } else {
            echo '';
        } ?></i>
    </li>
    <li>
        <a href="Login.php">Login</a>
    </li>
</ul>
</div>
</div>