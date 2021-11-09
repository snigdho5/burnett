<!-- Body -->
<div class="container-fluid pt-5 pb-5">
    <div class="container">
        <div class="row"> 
      
      <!--   <div class="col-xl-3 col-md-3 pt-3">
        <form class="form-horizontal" id="log_in_registration_form" action="<?php echo base_url();?>login/submit_data" method="post" enctype="multipart/form-data">

                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Username or email address <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                   <input type="text" class="form-control" name="phone_or_email" id="phone_or_email" placeholder="Username or email address" />
                                            </div>
                                        </div>
                                    </div>
                                                                                                                                           
                                    <div class="form-group">
                                        <label for="password" class="cols-sm-2 control-label">Password <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                              
                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter your Password" />
                                            </div>
                                        </div>
                                    </div>
                                                                       
                                    <div class="form-group ">
                                        <button type="submit" onclick="return log_in_form_validation()" class="btn btn-primary btn-lg login-button">Login</button>
                                    </div> 


                                    <div class="form-group ">
                                        <button id="login" type="Button" onclick="return fb_login()" class="btn btn-primary btn-lg login-button">Facebook Login</button>
                                    </div> 




                                     <div class="form-group">
                                   <div class="cols-sm-10">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Remember Me
                                        </label><br/>
                                        <a href="#">Lost your password?</a>
                                    </div>
                                </div>
                            </div> 
                                                        
                                </form>
        </div>
 -->

        <div class="col-xl-9 col-md-9 pt-3">
  <!-- <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#user-registration">User Registration</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#doctor-registration">Doctor Registration</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#distributor-egistration">Distributor Registration</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#stockist-registration">Stockist Registration</a>
    </li>
  </ul> -->

  <!-- Tab panes -->
  <div class="tab-content">

                    <small>
                        <?php
                              $succ_add=$this->session->flashdata('exist');
                              if($succ_add){
                                ?>
                                <br><span style="color:red">
                                  <?php echo $succ_add; ?>
                                </span>
                                <?php
                                  }
                        ?>
                   </small>
                    <small>
                        <?php
                              $succ_add=$this->session->flashdata('succ');
                              if($succ_add){
                                ?>
                                <br><span style="color:green">
                                  <?php echo $succ_add; ?>
                                </span>
                                <?php
                                  }
                        ?>
                   </small>


    <div id="user-registration" class="container tab-pane active"><br>
      <form class="form-horizontal" id="cu_registration_form" action="<?php echo base_url();?>Forgot_password/password_reset" method="post" enctype="multipart/form-data">

                                    

                                     <div class="form-group">
                                        <label for="password" class="cols-sm-2 control-label">Password <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                              
                                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter your Password" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="confirm" class="cols-sm-2 control-label">Confirm Password <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                                <input type="password" class="form-control" name="confirm" id="confirm" placeholder="Confirm your Password" />
                                            </div>
                                        </div>
                                    </div>

                                     <input type="hidden" class="form-control" name="user_id" id="user_id" value="<?php echo $this->uri->segment(2);?>" placeholder="" />
                                
                                    <div class="form-group ">
                                        <button type="submit" onclick="return forgot_form_validation()" class="btn btn-primary btn-lg login-button">Register</button>
                                    </div>                                  
                                </form>
    </div>



   
    











  </div>
  
        </div>
    </div>
   </div>
   </div>

<!-- Body -->



<script type="text/javascript">

function cu_data_Submit_fm()
{
       
          var password=$("#password").val();       
        if (password=="") 
        {
            $('#password').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#password').removeClass('red_border').addClass('black_border');               
        }


        var confirm=$("#confirm").val();
        if (confirm=="" || confirm!=password) 
        {
            $('#confirm').removeClass('black_border').addClass('red_border');            
        } 
        else 
        {
            $('#confirm').removeClass('red_border').addClass('black_border');
        }

       

}

function forgot_form_validation()
  {
    //alert('ok');

          // var cat_ids=[];
          //   $(':checkbox[id^="chk_bx"]:checked').each(function(){        
          //    cat_ids.push($(this).val());              
          // });



        $('#cu_registration_form').attr('onchange', 'cu_data_Submit_fm()');
        $('#cu_registration_form').attr('onkeypress', 'cu_data_Submit_fm()');

        cu_data_Submit_fm();

      //  alert($('#user_registration_form_id .red_border').size());

        if ($('#cu_registration_form .red_border').length > 0)
        {

            $('#cu_registration_form .red_border:first').focus();
            $('#cu_registration_form .alert-error').show();
            return false;
        }

        // else if(cat_ids.length==0){              
        //   alert("Please agree with our terms and conditions.");              
        //   return false;            
        // }

        else {

        $("#cu_registration_form").submit();
      } 
  }
</script> 




