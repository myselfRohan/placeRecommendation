<?php
    // echo "HI";die;
    require('../connection.php');
    error_reporting(0);
    session_start();
    $category= $_GET['optradio'];
    $title = "Recommended Places"
   
?>
<?php
//this file contains the landing page
$user_id =  $_SESSION['user_id'] ;

// $user_id = $_SESSION["user_id"];//storing the user info in session variables
//echo "The user id os "+ $user_id;
//die;
$rec_pro_id = calculateUserSimilarity($con,$user_id);
//echo "This is it ";
$ids = array($rec_pro_id);
$ids = join(',',$rec_pro_id);
$arr=array_values($rec_pro_id);
// print_r($arr);
// print_r($ids);
// die;
// 



//categories
$rs_results = mysqli_query($con,"Select place_id,place_name from place");

$query = "Select  place_id,place_name,imageurl from place WHERE place_id IN(".implode(',', $arr).")"." AND category_name ='$category' ORDER BY FIELD(place_id,".implode(',', $arr).") LIMIT 6";
// echo $query;
// die;
$rs_resultforrec =mysqli_query($con,$query) or die("Error");




?>

<?php
    function filter($similarity) {
        return $similarity[1] > 0;
    }

?>



<?php
function calculateUserSimilarity($con,$user_id_sess ){
//    echo "THis fucntion calculates user similarity";

    $user = array();

    $query_user = "Select * from users";
    $result = mysqli_query($con,$query_user);


    while ($user_one = mysqli_fetch_assoc($result)) {
        $user[] = $user_one;

    }


//    echo "<pre>";
//    print_r($user);
//    die;

    $score_array = array();

    
        for ($j=0; $j <sizeof($user); $j++){
            if($user_id_sess!= $user[$j]['id'] ){
//                 echo $user[$i]['username'];
//                echo "----------";
//                 echo $user[$j]['username';
                //  echo $user_id_sess;
                // echo  $user[$j]['id']."     ";
                $score_array[] = PearsonSimilarity($user_id_sess,$user[$j]['id'],$con);
            }

        }

        $filteredSimilarity = array_filter($score_array, 'filter');

        
        

//--------------------------------------------------------------
        // This is the pearson correaltion score 
    //    echo "<pre>";
    //    print_r($filteredSimilarity);
    //    die;


       $rec_pro_id =  WeightedMatrix($con,$user_id_sess,$filteredSimilarity);
    //     echo "<pre>";
    //    print_r($rec_pro_id);
    //    die;

        return  $rec_pro_id ;


    







}
?>
<?php
function PearsonSimilarity($user_id1 , $user_id2, $con)
{

    // echo $user_id1;
    // echo $user_id2;
    // die;
    $user1_rated_pro = array();
    $user2_rated_pro = array();

    $query1 = "Select  place_id,rating from place_user where user_id = $user_id1 ";
    $result1 = mysqli_query($con, $query1);

    $query2 = "Select  place_id,rating from place_user where user_id = $user_id2 ";
    $result2 = mysqli_query($con, $query2);
  

    while ($place_id1 = mysqli_fetch_assoc($result1)) {

        $user1_rated_pro[] = $place_id1;
        
    }

    while ($place_id2 = mysqli_fetch_assoc($result2)) {
        $user2_rated_pro[] = $place_id2;
    }

    //    print_r($user1_rated_pro);
       
    // print_r($user2_rated_pro);
    //    die;


    $n = 0 ;
    for ($i = 0 ; $i < sizeof($user1_rated_pro); $i++) {
        for ($j = 0; $j < sizeof($user2_rated_pro); $j++) {
            if ($user1_rated_pro[$i]['place_id'] == $user2_rated_pro[$j]['place_id']) {
                $n++;
            }
        }
    }
    // print_r($n);
    // die;


    $x =0; $y = 0; $sum_x = 0; $sum_y = 0;
    $xy =  1; $x_sq = 1; $y_sq = 1;
    $sum_xy = 0;
    $sum_xsq = 0;
    $sum_ysq = 0;





    for ($i = 0 ; $i < sizeof($user1_rated_pro); $i++){
        for ($j = 0; $j < sizeof($user2_rated_pro); $j++){

            if($user1_rated_pro[$i]['place_id'] == $user2_rated_pro[$j]['place_id']){
                   
                $x = $user1_rated_pro[$i]['rating'];
                $y = $user2_rated_pro[$j]['rating'];
                $sum_x = $sum_x + $x;
                $sum_y = $sum_y + $y;

                $x_sq = $x * $x ;
                $y_sq = $y * $y ;
                $sum_xsq = $sum_xsq + $x_sq;
                $sum_ysq = $sum_ysq + $y_sq;

                $xy = $x * $y ;
                $sum_xy = $sum_xy + $xy;

            }

        }
    }



    $numerator = $n* $sum_xy - $sum_x*$sum_y;
    if($numerator == 0){
        $numerator = 1;
    }
    
    $denomerator = sqrt($n*$sum_xsq - $sum_x*$sum_x) * sqrt($n*$sum_ysq - $sum_y*$sum_y);

    try{
        $pscore = $numerator / $denomerator;
        if(is_infinite($pscore)){
            $pscore = 0;
        }
    }
    catch (Exception $exception){
        echo "Divide by zero";
   }

   


    //   echo "The score between ". $pscore ."<br/>";
      
    return $score_array[] = array($user_id2,$pscore);
}

function WeightedMatrix($con,$user_id,$filteredSimilarity)
{

//        echo "Score array is ";
//        print_r($score_array);
//        die;

    $not_rated_product = [];
    $query1 = "Select place.place_id from place WHERE place.place_id NOT IN (Select place.place_id from place join place_user on place_user.place_id = place.place_id WHERE user_id = {$user_id})";
    $result1 = mysqli_query($con, $query1);

    while ($not_rated_place_id = mysqli_fetch_assoc($result1)) {
        $not_rated_product[] = $not_rated_place_id;

    }
    
//    print_r($not_rated_product);
//    die;

    $not_rated_product_map = [];
    $recommended_places = [];

    for ($i = 0; $i < sizeof($not_rated_product); $i++) {
        $id = $not_rated_product[$i]['place_id'];
        $query_rate = "Select user_id,rating,place_id from place_user WHERE place_id = '$id'  AND user_id != '$user_id'";
    //    echo $query_rate;
    //    die;
        $result = mysqli_query($con, $query_rate);

        //  echo "</br>";
        // print_r($result);
        // die;
        // echo "Rating by other user";
        $rate_from_user = array();

        while ($rating = mysqli_fetch_assoc($result)) {
            $rate_from_user[] = $rating;
        }

       
       
    //     echo " </br> rating is </br>";
    //     foreach($rate_from_user as $rate => $lol){
    //    print_r($lol['rating']);
    //    echo "</br>";
        // }
       
    //    echo "</br> score array is </br>";
    //    print_r($score_array);
       
       
    
       


        /// MAtching the user id from rate_from_user and score array

        $sum_sim_mul_rate = 0;
        $sim_mul_rate = 0;
        $sum_sim = 0;
        
        

        for ($k = 0; $k < sizeof($rate_from_user); $k++) {
            for ($j = 0; $j < sizeof($filteredSimilarity); $j++) {
                if ($rate_from_user[$k]['user_id'] == $filteredSimilarity[$j][0]) {
                   
                    
                    $sum_sim = $sum_sim + $filteredSimilarity[$j][1];
                    $sim_mul_rate = $rate_from_user[$k]['rating'] * $filteredSimilarity[$j][1];
                    $sum_sim_mul_rate = $sum_sim_mul_rate + $sim_mul_rate;


                }
                // echo $sum_sim_mul_rate;
               
            }
        }
        ;
       
        if ($sum_sim == 0) {
            $sum_sim = 0.01;
        }
        $ratio = $sum_sim_mul_rate / $sum_sim;
        //$recommended_places[] = array($id,$ratio);
        $recommended_places[$id] = $ratio;


    }
    


//    echo "</br> The recommened place are => </br>";
//     echo  json_encode($recommended_places) ;

    //print_r(arsort($recommended_places));

//    echo "THe sorted";


//    for($i = 0; $i < sizeof($recommended_places); $i++){
//        //$rec_pro_id[] = $recommended_places[$i][0];
//        $rec_pro_id[] = $recommended_places[$i][0];
//
//    }

    //
    arsort($recommended_places);

    //--------------------------------------------------------------
    // This is the recommended place with their score
    // echo "<pre>";
    // print_r($recommended_places);
    // die;


    $rec_pro_id = [];
    // $count = 0;
    foreach ($recommended_places as $key => $value) {
        if ($value != 0) {
            $rec_pro_id[] = $key;
            // $count++;
           
        }
        // if ($count == 5) {
        //     break;
        // }

    }
    //echo "The id are ";
    //$arr=array();


    foreach ( $rec_pro_id as $abc){
        //print_r($abc);
        $arr[$i]=$abc;
        //array_push($arr,$abc);
    }
    // print_r($rec_pro_id);
    $arr=array_values($rec_pro_id);
    // print_r($arr);
    // die;

    return $rec_pro_id;



}



?>

<?php include '../template/loggedheader.php' ?>
    <body>
    <div class="gtco-loader"></div>

    <div id="page">
    <?php include '../template/loggednav.php';?>
    <!--==============================Content=================================-->
    <?php include '../template/headers/headerrecommend.php';?>
<!--==============================footer=================================-->
       

<div class="gtco-section">
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
					
					<p>These are the top 6 destination based on user-user based collaborative filtering.</p>
				</div>
            </div>
            

			<div class="row">

                        <?php
                        $i = 0;
                            // var_dump(mysqli_fetch_assoc($rs_resultforrec));
                            while ($rs_ratingres = mysqli_fetch_assoc($rs_resultforrec)){
                            $i++;
                        ?>

				<div class="col-lg-4 col-md-4 col-sm-6">
			
					<a href="detailed.php?id=<?php echo $rs_ratingres["place_id"];?>" class="fh5co-card-item">
						<figure>
							<div class="overlay"><i class="ti-plus"></i></div>
							<img src="../admin/images/<?php echo $rs_ratingres["imageurl"]; ?>" alt="Image" class="img-responsive">
						</figure>
						<div class="fh5co-text">
							<h2><?php echo $i.".  ".$rs_ratingres["place_name"]; ?></h2>
							
							<p><span class="btn btn-primary">Read More</span></p>
						</div>
					</a>
                </div>
                        <?php  
                            }
                        ?>
				
            </div>
            

            
		</div>
	</div>
    

    <!--==============================footer=================================-->
    <?php include '../template/loggedfooter.php'; ?>
            
    </body>
</html>




