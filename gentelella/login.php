<?php
include './function/function.php';

?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Gentelella Alela! | </title>
      <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
      <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
      <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
      <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">
      <link href="../build/css/custom.min.css" rel="stylesheet">
      <style>
      	#content form .submit, .login_content form input[type=submit] {
     float: none; 
     margin-left: 0; 
		}
      .form-control-feedback {
    background: #fff;
}
.form-control-feedback {
    margin-top: 5px;
    height: 23px;
     color: unset; 
}
      </style>
   </head>
   <body class="login">
      <div>
         <a class="hiddenanchor" id="signup"></a>
         <a class="hiddenanchor" id="signin"></a>
         <div class="login_wrapper">
            
            <div id="register" class="animate form registration_form" style="display: block;">
               <section class="login_content">
                  <form action="./signup.php" method="post" class="reg-form" novalidate="novalidate">
                     <h1>Login</h1>
                     
                     <div>
                        <input type="text" class="form-control adp-validate" placeholder="Username" required="" />
                     </div>
                    
                     <div>
                        <input type="password" class="form-control adp-validate pass" placeholder="Password" required="" />
                     </div>
                     
                     <div>
                        <input type="submit" class="btn btn-success submit btn-block" value="Submit" href="index.html">
                        
                     </div>
                     <div class="clearfix"></div>
                     <div class="separator">
                        <p class="change_link">Don't have an account ?
                           <a href="signup.php" class="to_register"> Sign Up </a>
                        </p>
                        <div class="clearfix"></div>
                        <br />
                        <div>
                           <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                           <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                        </div>
                     </div>
                  </form>
               </section>
            </div>
         </div>
      </div>
      <script src="../vendors/jquery/dist/jquery.min.js"></script>
      <script>
         let inp = $('.adp-validate');
         $.each(inp,(e,v) =>{
               v.after(document.createElement('span'));
            });
         $('.cpass').keyup(function(){
            if($('.pass').val() == $('.cpass').val()){
               $('.form-control-feedback').removeClass('fa fa-times text-danger').addClass('fa fa-check text-success');
            }else{
               $('.form-control-feedback').removeClass('fa fa-check text-success').addClass('fa fa-times text-danger');
            }
         });
      	$('.reg-form').on('submit',(e)=>{
      		
            let proceed = false;
      		let err_msg = `<span class="text-danger err_msg"></span>`;
      		
      		let regBundle = [/^[a-zA-Z ]+$/,/^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/];
      		for(let i=0;i<inp.length;i++){

      			if(inp.eq(i).val() == ''){
      				inp.eq(i).css('margin-bottom',5+'px').siblings().addClass('text-danger err_msg').html(`* Please Enter your ${inp.eq(i).attr('placeholder')}`);
                  e.preventDefault();
      			}
      			else if(!inp.eq(i).val().match(new RegExp(regBundle[i]))){
      				inp.eq(i).css('margin-bottom',5+'px').siblings().addClass('text-danger err_msg').html(`* Please Enter a valid ${inp.eq(i).attr('placeholder')}`);
                  e.preventDefault();
      			}else{
                  inp.eq(i).css('margin-bottom',20+'px').siblings().html('');
                  proceed = true;
               }
      		}
            // if(proceed){
            //    $('.reg-form').submit();
            // }
      	});
      </script>
   </body>
</html>
