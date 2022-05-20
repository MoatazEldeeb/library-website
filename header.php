<?php
    
    if(isset($_SESSION['id'])){
        $isLogged = $_SESSION['id'];
    }else{
        $isLogged =false;
    }
    
?>
<head>
    <title> My Library</title>
    <link type="text/css" rel="stylesheet" href="index.css">
    
</head>

<body>
    <nav>
        <div class="nav-head">
            
            <img class="icon logo"src="images/logo.png" alt="logo not available">
            <a href="home.php"><img class= "icon" src="images/home.png" alt="home not available"></a>
            
            
            <a href="login.php" class="log-in" >
                <?php if($isLogged ):?>
                    <?php echo "Logout";?>
                <?php else: echo "Login";?>
                <?php endif; ?>
            </a>
            
        </div>
    </nav>
