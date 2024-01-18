<!DOCTYPE html>
<html lang="en">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>SE-Store</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link
        href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<body>
    <div class="menubar">
        <div class="container">
            <div class="logo mt-2">
                <h5>Member Profile</h5>
            </div>
            <ul class="menu mt-3">
                <li>
                    <a href="Personal.php">Member</a>
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
                    <a href="Logout.php" class="bi bi-box-arrow-right"><b>Logout</b></a>
                </li>
            </ul>
        </div>
    </div>
</body>

</html>