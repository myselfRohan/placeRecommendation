<?php 
    require('connection.php');
    // error_reporting(0);
    session_start();
    $user_id = $_SESSION['user_id'];
    echo "The user id is";
    // print_r($user_id);
    echo "<pre>";
    // print_r($_POST);

    $place_idk = array_keys($_POST);
    // print_r($place_idk);

    for ($i=0; $i < count($_POST)-1; $i+=2) { 
                $one_row = array_slice($_POST,$i,1);
                if (!(in_array(null, $one_row))) {
                 
                    print_r($one_row);
                    $place_id = $place_idk[$i];
                    $k = array_keys($one_row);
                    $data = $one_row[$k[0]];
                    // print_r($k);
                    // print_r($k[0]);
                    echo "THe place id and ratings are==>";
                    // print_r($place_id);
                    // print_r($data);
                    $result_insert = mysqli_query($con,"insert into place_user(place_id,user_id,rating) values(".$place_id.",".$user_id.",".$data.")");

                }
            }
    header('Location: dashboard.php');
   
?>
<html lang="en">
    <head>
        <title>Hot Tours</title>
        <meta charset="utf-8">
        <meta name="format-detection" content="telephone=no" />
        <link rel="icon" href="images/favicon.ico">
        <link rel="shortcut icon" href="images/favicon.ico" />
        <link rel="stylesheet" href="css/style.css">
        <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
        <!-- <link rel="stylesheet" href="css/bootstrap.css"> -->
        <script src="js/jquery.js"></script>
        <script src="js/jquery-migrate-1.2.1.js"></script>
        <script src="js/script.js"></script>
        <script src="js/superfish.js"></script>
        <script src="js/jquery.ui.totop.js"></script>
        <script src="js/jquery.equalheights.js"></script>
        <script src="js/jquery.mobilemenu.js"></script>
        <script src="js/jquery.easing.1.3.js"></script>

        <script>
        $(document).ready(function(){
            $().UItoTop({ easingType: 'easeOutQuart' });
        });
        </script>
    </head>
    <body>
        <header>
            <div class="container_12">
                <div class="grid_12">
                    <div class="menu_block">
                        <nav class="horizontal-nav full-width horizontalNav-notprocessed">
                            <ul class="sf-menu">
                                <li><a href="dashboard.php">Home</a></li>
                                <li class="current"><a href="#">About</a></li>
                                <li><a href="../index.php">Logout</a></li>
                                
                            </ul>
                        </nav>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="grid_12">
                    <h1>
                        <a href="index.html">
                            <!-- <img src="images/logo.png" alt="Your Happy Family"> -->
                        </a>
                    </h1>
                </div>
            </div>
        </header>
<!--==============================Content=================================-->
        <div class="content"><div class="ic">More Website Templates @ TemplateMonster.com - February 10, 2014!</div>
            <div class="container_12">
               
                    
                   <form method="post" action="rate_success.php">
                        <div class="container">
                            <div class="body">
                                 <?php
                    $i = 0;
                     while ($rs_res = mysqli_fetch_assoc($rs_results))
                            {
                                $i++;
                    ?>
                    <br/>
                     <div class="title"><?php echo $i.".  ".$rs_res["place_name"]; ?></div>
                     <input type="text" name="<?php echo $rs_res["place_name"]; ?>">
                     
                     <br/>
                  

                    <?php  
                        }
                    ?>

                                </div>
                            </div>
                            <br/>
                             <input type="submit" name="Rate it!">
                        </div>

                    </form>
                   
                
            </div>
        </div>
<!--==============================footer=================================-->
        <footer>
            <div class="container_12">
                <div class="grid_12">
                    <div class="socials">
                        <a href="#" class="fa fa-facebook"></a>
                        <a href="#" class="fa fa-twitter"></a>
                        <a href="#" class="fa fa-google-plus"></a>
                    </div>
                    <div class="copy">
                        Your Trip (c) 2014 | <a href="#">Privacy Policy</a> | Website Template Designed by <a href="http://www.templatemonster.com/" rel="nofollow">TemplateMonster.com</a>
                    </div>
                </div>
            </div>
        </footer>
        <script>
        $(function (){
            $('#bookingForm').bookingForm({
                ownerEmail: '#'
            });
        })
        </script>
    </body>
</html>




