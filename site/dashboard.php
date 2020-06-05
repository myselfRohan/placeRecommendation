<?php
    session_start();
    if(!isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != true){
            header("Location: ../index.php");   
    } else {
    
?> 
    <?php
    $title = "HOME";
    include '../template/loggedheader.php'; 
    ?>
    <body>
    
        <div class="gtco-loader"></div>

        <div id="page">
        <?php include '../template/loggednav.php';?>
<!--==============================Content=================================-->
            <?php include '../template/headers/headerloggedhome.php';?>
                                   
                    <?php include 'siteplaces.php';?>
                   <!-- <div class="clear"></div> -->
           
        
<!--==============================footer=================================-->
        <?php include '../template/loggedfooter.php'; ?>
    <?php } ?> 
    </body>
</html>