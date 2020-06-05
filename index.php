  <?php
    session_start();
    error_reporting(0);
    if(!isset($_SESSION['logged_in']) && $_SESSION['logged_in'] !== true){
    $title = "HOME";
    include 'template/indexheader.php'; 
    ?>
    <body>

      <!-- new content -->
        <div class="gtco-loader"></div>

        <div id="page">
          <?php include 'template/nav.php';?>
          <?php include 'template/headers/headerhome.php';?>
          <?php include 'places.php';?>

<!--==============================footer=================================-->
        <?php include 'template/footer.php'; ?>
    <?php } else {
       header("Location: site/dashboard.php");
    }
      ?>
    
    </body>
</html>