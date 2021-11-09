<div class="container-fluid pt-4 pb-4">
  <div class="container pt-4 pb-4">
    <div class="row">

    </div>
    <div class="row">
      <div class="col-md-12">

        <!-- Title -->
        <h1 class="mt-4">Contact Us</h1>

        <small>
          <?php
          $succ_add = $this->session->flashdata('exist');
          if ($succ_add) {
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
          $succ_add = $this->session->flashdata('succ');
          if ($succ_add) {
          ?>
            <br><span style="color:green">
              <?php echo $succ_add; ?>
            </span>
          <?php
          }
          ?>
        </small>

        <?php echo @$seo_content_details[0]->meta_description; ?>

        <!-- 
<div class="row">
    	<div class="col-md-4 mt-4">
        <h4>Main Laboratory</h4>
        <div class="cont_address">
        	<span>Kalachandpara<br/>
Duttapukur<br/>
North 24 Parganas<br/>
743248</span>
        </div>
        <br clear="all">
        <a href="tel:03325360426" class="cont_phone">+91(33)2536-0426</a>
        <br clear="all">
        <a href="tel:9836934286" class="cont_mobile">9836934286</a>
        <br clear="all">
        <a href="tel:7980843676" class="cont_mobile">7980843676</a>
        <br clear="all">
        <a href="tel:9830826022" class="cont_mobile">9830826022</a>
        <br clear="all">
        <a href="tel:9830214159" class="cont_mobile">9830214159</a>
        <br clear="all">
        <a href="mailto:admin@burnettresearchlab.com" class="cont_email">admin@burnettresearchlab.com</a>
        </div>
        <div class="col-md-4 mt-4">
        <h4>Branch Office</h4>
        <div class="cont_address">
        	<span>132/1a Rajarammohan Sarani<br/>
Kolkata-700009</span>
        </div>
        <br clear="all">
        <a href="tel:9051033622" class="cont_mobile">9051033622</a>
        <br clear="all">
        <a href="mailto:admin@burnettresearchlab.com" class="cont_email">admin@burnettresearchlab.com</a>
        </div>
        <div class="col-md-4 mt-4">
        <h4>Corporate Office</h4>
		<div class="cont_address">
        	<span>165, B.B. Ganguly Street<br/>
Kolkata-700012</span>
        </div>
        <br clear="all">
        <a href="tel:9051033622" class="cont_mobile">9051033622</a>
        <br clear="all">
        <a href="mailto:admin@burnettresearchlab.com" class="cont_email">admin@burnettresearchlab.com</a>
    </div>
</div> -->




        <div class="row mt-4">

          <div class="col-md-3">
          </div>
          <div class="col-md-6">
            <div class="contact-form">
              <form name="contact_registration_form" id="contact_registration_form" action="<?php echo base_url(); ?>contact_us/mail_submit" method="post" enctype="multipart/form-data">
                <input type="text" name="name" id="name" placeholder="Name" />
                <input type="text" name="email" id="email" placeholder="E-mail" />
                <input type="text" onkeypress="validate(event)" name="phone" id="phone" placeholder="Phone" />
                <textarea name="message" id="message" rows="8" placeholder="Message"></textarea>
                <input type="submit" onclick="return contact_form_validation();" value="Submit" class="btn-submit">
              </form>
            </div>
          </div>
          <div class="col-md-3">
          </div>
        </div>
      </div>

    </div>

  </div>
</div>

<script>
 function validate(evt) {
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
  // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}
</script>

<script type="text/javascript">
  function cu_data_Submit_fm() {
    var name = $("#name").val();

    //  alert(name); 
    if (name == "") {
      $('#name').removeClass('black_border').addClass('red_border');
    } else {
      $('#name').removeClass('red_border').addClass('black_border');
    }

    var email = $("#email").val();
    if (!isEmail(email)) {
      $('#email').removeClass('black_border').addClass('red_border');
    } else {
      $('#email').removeClass('red_border').addClass('black_border');
    }

    var phone = $("#phone").val();
    if (phone == "" && phone < 10) {
      $('#phone').removeClass('black_border').addClass('red_border');
    } else {
      $('#phone').removeClass('red_border').addClass('black_border');
    }

    var message = $("#message").val();
    if (message == "") {
      $('#message').removeClass('black_border').addClass('red_border');
    } else {
      $('#message').removeClass('red_border').addClass('black_border');
    }



  }

  function contact_form_validation() {
    // alert('ok');

    // var cat_ids=[];
    //   $(':checkbox[id^="chk_bx"]:checked').each(function(){        
    //    cat_ids.push($(this).val());              
    // });



    $('#contact_registration_form').attr('onchange', 'cu_data_Submit_fm()');
    $('#contact_registration_form').attr('onkeypress', 'cu_data_Submit_fm()');

    cu_data_Submit_fm();

    // alert($('#contact_registration_form .red_border').length);

    if ($('#contact_registration_form .red_border').length > 0) {

      $('#contact_registration_form .red_border:first').focus();
      $('#contact_registration_form .alert-error').show();
      return false;
    }

    // else if(cat_ids.length==0){              
    //   alert("Please agree with our terms and conditions.");              
    //   return false;            
    // }
    else {

      $("#contact_registration_form").submit();
    }
  }
</script>