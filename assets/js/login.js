var if_record_exist = false;
                                
            
                    $(function(){
                        $('#login').click(function(e){
                        //    console.log($('#email-new').val());
                            e.preventDefault();
                            //get the values
                            
                           
                            var username = $('#username').val();
                            var password = $('#password').val();
                            //validate the form
                            if(password == '' || username == ''){
                                $('.loginmsg').text('Please fill the form');
                            }else{
                                
        		
                                //jQuery ajax post method with 
                                $.ajax({
                                    type: "POST",
                                    url: "checklogin.php",
                                    data: "username="+username+"&password="+password,
                                    beforeSend: function() {
                                    $('.loginmsg').html(
                                    '<img src="register/loading.gif" width="25" height="25"/>'
                                    );
                                    },		 
                                    success: function(data){
                                        if(data == "LoggedIn"){
                                            setTimeout(function() {
                                            var markup = `<span style='color:green; font-weight:bold;'>
                                            Logged In! Redirecting...
                                            </span>`;
                                            $('.loginmsg').html(markup);
                                            
                                            }, 1000);
                                            setTimeout(() => {
                                            location.href = 'site/dashboard.php';
                                            }, 1500);
                                            
                                            
                                        } else {
                                            setTimeout(function() {
                                            $('.loginmsg').html(data);
                                            }, 1000);
                                        }
                                    }
                                });
                                
                                
                                }
                            });
    
                        //check if the email is already registered!!
                        $('#email-new').blur(function(){
                            var email  = $('#email-new').val();
                            // console.log($('#email-new').val());
                            
                            
                            //checking email
                            $.post('register/check-email-registered.php', {email:email}, function(resp){
                                
                                if(resp == 'invalid'){
                                    $('.email_err').text('Invalid Email');			
                                    if_record_exist = true;
                                }
                                else if(resp == 'bad'){
                                    // console.log(resp);
                                    $('.email_err').text('Email Already registered');			
                                    if_record_exist = true;
                                }else{
                                    $('.email_err').text('');			
                                    if_record_exist = false;
                                }	
                            });	
                        });	

                        //checking username availability
                        $('#username-new').blur(function(){
                            var username  = $('#username-new').val();
                            if(username.length < 5){
                                $('.username_err').text('Username length must be greater or equal to 5');
                            }
                            
                            //checking username
                            $.post('register/check-username-registered.php', {username:username}, function(resp){
                                if(resp == 'length'){
                                    $('.username_err').text('Username must be greater or equal to 5');			
                                    if_record_exist = true;
                                }
                                else if(resp == 'bad'){
                                    $('.username_err').text('Username not available');			
                                    if_record_exist = true;
                                }else{
                                    $('.username_err').text('');			
                                    if_record_exist = false;
                                }	
                            });	
                        });	
                        
                        //when click Signup button
                        $('#signup').click(function(e){
                        //    console.log($('#email-new').val());
                            e.preventDefault();
                            //get the values
                            
                            var email = $('#email-new').val();
                            var username = $('#username-new').val();
                            var password = $('#password-new').val();
                            //validate the form
                            if(email == '' || password == '' || username == ''){
                                $('.msg').text('Please fill the form');
                            }else{
                                if(if_record_exist == false){
        		
                                //jQuery ajax post method with 
                                $.ajax({
                                    type: "POST",
                                    url: "register/registration.php",
                                    data: "username="+username+"&email="+email+"&password="+password,
                                    beforeSend: function() {
                                    $('.msg').html(
                                    '<img src="register/loading.gif" width="25" height="25"/>'
                                    );
                                    },		 
                                    success: function(data)
                                    {
                                
                                    setTimeout(function() {
                                        
                                    $('.msg').html(data);
                                    setTimeout(() => {
                                    document.getElementById('username-new').value = '';
                                    document.getElementById('email-new').value = '';
                                    document.getElementById('password-new').value = '';
                                    },5)
                                    
                                    }, 2500);
                                
                                    }
                                    });
                                
                                    
                                } else{
                                    $('.msg').html('Please fix the above error!');			
                                }
                            }   
                            }); 	
                            
                            
                        });

                   