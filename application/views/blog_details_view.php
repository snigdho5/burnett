<!--Body -->
<div class="container-fluid pt-4 pb-4">
<div class="container pt-4 pb-4">
      <div class="row">
    
    </div>
 <div class="row">
    <div class="col-md-12">

          <!-- Title -->
          <h1 class="mt-4"><?php echo @$blog_details[0]->blog_title;?></h1>

          <!-- Author -->
          <p>
            by
            <a href="#"><?php 

              

            $reg_user_details=  $this->common_my_model->common($table_name ='register_users', $field = array(), $where = array('user_id'=>@$blog_details[0]->added_by), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

           echo @$reg_user_details[0]->firstname.' '.@$reg_user_details[0]->lastname;?></a>
          </p>

          <hr>

          <!-- Date/Time -->
          <p>Posted on <?php echo $date=date('M j, Y', strtotime(@$blog_details[0]->added_date)); ?> at <?php echo $date=date('h:i A', strtotime(@$blog_details[0]->added_date)); ?></p>
          <!-- <p>Posted on November 20, 2020 at 12:00 PM</p> -->

          <hr>

          <!-- Preview Image -->
          <img class="card-img-top" src="<?php echo base_url();?>uploads/blog/large/<?php echo $blog_details[0]->image;?>" alt="Card image cap">

          <hr>

          <!-- Post Content -->
          <!-- <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus, vero, obcaecati, aut, error quam sapiente nemo saepe quibusdam sit excepturi nam quia corporis eligendi eos magni recusandae laborum minus inventore?</p>

          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, tenetur natus doloremque laborum quos iste ipsum rerum obcaecati impedit odit illo dolorum ab tempora nihil dicta earum fugiat. Temporibus, voluptatibus.</p>

          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, doloribus, dolorem iusto blanditiis unde eius illum consequuntur neque dicta incidunt ullam ea hic porro optio ratione repellat perspiciatis. Enim, iure!</p>

          <blockquote class="blockquote">
            <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
            <footer class="blockquote-footer">Someone famous in
              <cite title="Source Title">Source Title</cite>
            </footer>
          </blockquote>

          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error, nostrum, aliquid, animi, ut quas placeat totam sunt tempora commodi nihil ullam alias modi dicta saepe minima ab quo voluptatem obcaecati?</p>

          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum, dolor quis. Sunt, ut, explicabo, aliquam tenetur ratione tempore quidem voluptates cupiditate voluptas illo saepe quaerat numquam recusandae? Qui, necessitatibus, est!</p> -->

          <?php  
            
           echo @$blog_details[0]->description;?>



          <hr>
</div>
<div class="col-md-8">
    <small><?php
            $succ_message=$this->session->flashdata('succ');
            if($succ_message){
              ?>
              <br><span style="color:green;font-size:20px">
                <?php echo $succ_message; ?>
              </span>
              <?php
              }
              ?></small>

              <small><?php
            $err_message=$this->session->flashdata('exist');
            if($err_message){
              ?>
              <br><span style="color:red;font-size:20px">
                <?php echo $err_message; ?>
              </span>
              <?php
              }
              ?></small>

          <!-- Comments Form -->
          <div class="card my-4">
            <h5 class="card-header">Leave a Comment:</h5>
            <div class="card-body">
              <form id="cu_registration_form" action="<?php echo base_url();?>blog/blog_review_submit" method="post" enctype="multipart/form-data" >
                <div class="form-group">
                  <textarea class="form-control" name="message" id="message" rows="3"></textarea>
                  <input type="hidden" name="blog_hidden_id" id="blog_hidden_id" class="form-control" placeholder="" value="<?php echo $this->uri->segment(2);?>">
                </div>
                <button type="submit" onclick="return form_validation()" class="btn round-black-btn">Submit</button>
              </form>
            </div>
          </div>

          <!-- Single Comment -->

          <?php foreach($blog_review_list as $row ){

            $blog_user_details=  $this->common_my_model->common($table_name ='register_users', $field = array(), $where = array('user_id'=>$row->user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

           ?>


          <div class="media mb-4">
            <img class="d-flex mr-3 rounded-circle" style="height:100px;width: 100px" src="<?php echo base_url();?>uploads/profile_picture/<?php echo $blog_user_details[0]->profile_picture;?>" alt="">
            <div class="media-body">
              <h5 class="mt-0"><?php echo @$blog_user_details[0]->firstname.' '.@$blog_user_details[0]->lastname;?></h5>
              <?php echo @$row->message;?>
            </div>
          </div>

        <?php } ?>

          <!-- Comment with nested comments -->
         <!--  <div class="media mb-4">
            <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
            <div class="media-body">
              <h5 class="mt-0">Commenter Name</h5>
              Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.

              <div class="media mt-4">
                <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                <div class="media-body">
                  <h5 class="mt-0">Commenter Name</h5>
                  Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                </div>
              </div>

              <div class="media mt-4">
                <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                <div class="media-body">
                  <h5 class="mt-0">Commenter Name</h5>
                  Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                </div>
              </div>

            </div>
          </div> -->




        </div>
    </div>

</div>
</div>

<!-- Body -->

<script type="text/javascript">

function cu_data_Submit_fm()
{
        /*var name=$("#name").val();       
        if (name=="") 
        {
            $('#name').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#name').removeClass('red_border').addClass('black_border');               
        }

          var email_id=$("#email_id").val();       
        if (!isEmail(email_id)) 
        {
            $('#email_id').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#email_id').removeClass('red_border').addClass('black_border');               
        }*/

         var message=$("#message").val();       
        if (message=="") 
        {
            $('#message').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#message').removeClass('red_border').addClass('black_border');               
        }



       


}

function form_validation()
  {
   

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