<!DOCTYPE html>
<html lang="en"> 
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>SE-Store</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href = "css/style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<style>
body {
    margin :0;
    padding :0;
    font-family: 'Prompt', sans-serif;
}

.menubar {
    width:100%;
    height: 50px;
    background: #728bb1;
    box-shadow: 0 0 10px #d1d1d1;
}

.menubar .logo {
    float: left;
    color : #fff;
}

.menubar h1 {
    margin : 0;
    font-size: 18px;
    font-weight : bold;
    padding: 5px;
}

.menubar ul.menu {
     list-style: none;
     float : right;
     
}

.menubar ul.menu li {
    float: left;
    margin-right : 10px;  
     
}

.menubar ul.menu li a {
    text-decoration: none;
    color : #fff;
    border-bottom : 2px solid  transparent;
    padding-bottom: 10px;
    transition : all 0.3s ease;
}

.menubar ul.menu li a:hover {
    border-bottom : 2px solid #c5fff5;
    padding-bottom: 0px;
      
}


</style>
<body class="body">
    <div class="menubar">
        <div class="container">
            <div class="logo mt-2">
                <h5>Admin Management</h5>               
            </div>
            <ul class="menu mt-3">
                <li>
                    <a href ="Employee.php">Employee</a>                   
                </li>
                <li>
                    <a href="Member.php">Member</a>
                </li>
                <li>
                    <a href="EditProduct.php">Product</a>
                </li>
                <li>
                    <a href="orderED.php">Order</a>
                </li>
                <li>
                    <a href ="Logout.php" class="bi bi-box-arrow-right"><b>Logout</b></a>
                </li>
            </ul>
        </div>
    </div>
</body>
</html>
