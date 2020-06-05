<?php 
    require('../connection.php');
    // error_reporting(0);
    session_start();
    // print_r($_POST['place_name']);
    // die;
    $rs_results = mysqli_query($con,"Select *  from place where place_name LIKE '%".$_GET['place_name']."%'");
    
    // $place_single =  mysqli_fetch_assoc($rs_results);
    // print_r($place_single);
   
?>
<?php 
    $title = 'Searched Place';
    
        include '../template/header.php';
    
        
   
    
?>
    <body>
    <?php include '../template/searchNav.php';?>
<!--==============================Content=================================-->
            <div class="content">
                <div class="container_12">
                <?php include '../template/searchBar.php'; ?>
                    <div class="banners">
                        <h5>Search list for <b><?php echo $_GET['place_name'];?> </b> are :</h5>
                        <?php
                        $i = 0;
                            // var_dump(mysqli_fetch_assoc($rs_resultforrec));
                            while ($rs_res = mysqli_fetch_assoc($rs_results)){
                            $i++;
                        ?>
                    
                        <div class="grid_4">
                            <div class="banner">
                                <img src="../admin/images/<?php echo $rs_res["imageurl"]; ?>" alt="" style="width: 300px; height: 350px;">
                                
                                <div class="label">
                                    <div class="title"><?php echo $i.".  ".$rs_res["place_name"]; ?></div>
                                    <a class="dest" href="detailed.php?id=<?php echo $rs_res["place_id"];?>">LEARN MORE</a>
                                    
                                </div>
                            </div>
                        </div>

                        <?php  
                            }
                        ?>
                    </div>
                </div>
            </div>


        
<!--==============================footer=================================-->
        <?php include '../template/footer.php'; ?>
    </body>
</html>




