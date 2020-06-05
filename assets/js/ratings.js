function showRestaurantData(url, placeId)
    	{
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200)
            {
                document.getElementById("restaurant_list").innerHTML = this.responseText;
            }
        };
        xhttp.open("POST", url, true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				var param = "place_id=" + placeId;
				xhttp.send(param);

    	}
			
			function mouseOverRating(placeId, rating) {

					resetRatingStars(placeId);

					for (var i = 1; i <= rating; i++)
					{
							var ratingId = placeId + "_" + i;
							document.getElementById(ratingId).style.color = "#ff6e00";

					}
					}

					function resetRatingStars(placeId)
					{
					for (var i = 1; i <= 5; i++)
					{
							var ratingId = placeId + "_" + i;
							document.getElementById(ratingId).style.color = "#9E9E9E";
					}
					}

					function mouseOutRating(placeId, userRating) {
					var ratingId;
					if(userRating !=0) {
							for (var i = 1; i <= userRating; i++) {
										ratingId = placeId + "_" + i;
									document.getElementById(ratingId).style.color = "#ff6e00";
							}
					}
					if(userRating <= 5) {
							for (var i = (userRating+1); i <= 5; i++) {
								ratingId = placeId + "_" + i;
							document.getElementById(ratingId).style.color = "#9E9E9E";
					}
					}
					}

					function addRating (placeId, ratingValue) {
							var xhttp = new XMLHttpRequest();

							xhttp.onreadystatechange = function ()
							{
									if (this.readyState == 4 && this.status == 200) {

											showRestaurantData('rating/getRatingData.php',placeId);
											
											if(this.responseText != "success") {
													alert("You havenot logged in or Already Voted!");
											}
									}
							};

							xhttp.open("POST", "rating/insertRating.php", true);
							xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
							var parameters = "index=" + ratingValue + "&place_id=" + placeId;
							xhttp.send(parameters);
					}