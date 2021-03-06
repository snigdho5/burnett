<!-- Footer -->
  <footer>
  
   <!--- Footer Yellow -->
 
 <div class="container-fluid bottom_yellow_bar pt-3 pb-3">
  <div class="container">
      <div class="row">
          <div class="col-md-6 pt-3 pb-3">
            <div class="talk_div">
<h5>Talk to an Expert
  <span>Chat Live or call <a href="tel:03325360426">+91(33)2536-0426</a></span></h5>
</div>
            </div>
            <div class="col-md-6 pt-3 pb-3">
            <div class="feel_it">
<h5>Feel it for yourself
  <span>Stores near Kolkata</span></h5>
</div>
            </div>
        </div>
    </div> 
 </div> 
 
  <!--- Footer Yellow -->
  
    <div class="container pt-4 pb-4 footer_style text-center text-md-left">
      <div class="row">
          <div class="col-md-4 pt-2 pb-2">            
            <h4 class="pb-3">About Us</h4>
            <p>Our GMP certified laboratory started in the year 1985, but complete incorporation started in the year 1993</p>
            <img class="img-fluid" src="<?php echo base_url();?>assets/frontend/images/top_logo01.jpg" alt=""/> 
            <p class="pt-3"><strong>A trusted sign for manufacturing, research &amp; analysis of homeopathic medicine</strong></p>
            </div>
            
            <div class="col-md-2 pt-2 pb-2">            
            <h4 class="pb-3">Help</h4>
            <ul>
                <li><a href="#">FAQs</a></li>
                <li><a href="#">Delivery</a></li>
                <li><a href="#">Payment</a></li>
                <li><a href="#">Returns</a></li>
                 <li><a href="<?php echo base_url();?>privacy-policy">Privacy Policy</a></li>
                  <li><a href="<?php echo base_url();?>terms-and-conditions">Terms & Conditions</a></li>
                <li><a href="<?php echo base_url();?>contact-us">Contact Us</a></li>

               

            </ul>

            </div>
            
            <div class="col-md-3 pt-2 pb-2">            
            <h4 class="pb-3">Quick Links</h4>
            <ul>
                <li><a href="<?php echo base_url('seo');?>">Sitemap</a></li>
                <li><a href="#">Homoeopathy</a></li>
                <li><a href="#">Diseahomoeopathy</a></li>
                <li><a href="#">Diseases</a></li>
                <li><a href="#">Speciality Formulations</a></li>
                <li><a href="#">Mother Tinctures</a></li>
                <li><a href="#">Dilutions &amp; Potencies</a></li>
                <li><a href="#">Biochemics</a></li>
                <li><a href="#">Cosmetics</a></li>
                <li><a href="#">Herbal</a></li>
            </ul>
            </div>
            
             <div class="col-md-3 pt-2 pb-2">            
             <h4 class="pb-3">DOWNLOAD APP</h4>
             <img class="img-fluid pb-2" src="<?php echo base_url();?>assets/frontend/images/google_play_01.jpg" alt=""/>
             <img class="img-fluid pb-2" src="<?php echo base_url();?>assets/frontend/images/apps_store01.jpg" alt=""/>
             <div class="social_box">
              <a href="#" target="_blank" rel="nofollow"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href="#" target="_blank" rel="nofollow"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                <a href="#" target="_blank" rel="nofollow"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="#" target="_blank" rel="nofollow"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
             </div> 
            </div>
       </div>
       <div class="row">
        <div class="col-md-12 footer_copyright text-center">
        <p>Copyright 2020. <strong>Burnett Research Laboratory</strong>. All Rights Reserved.</p>
        </div>
       </div>
   </div>
   </footer>
  
  
  <!-- Footer -->
  
  
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" type="text/javascript"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" type="text/javascript"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<script >
(function ($) {
  //Function to animate slider captions
  function doAnimations(elems) {
    //Cache the animationend event in a variable
    var animEndEv = "webkitAnimationEnd animationend";

    elems.each(function () {
      var $this = $(this),
      $animationType = $this.data("animation");
      $this.addClass($animationType).one(animEndEv, function () {
        $this.removeClass($animationType);
      });
    });
  }

  //Variables on page load
  var $myCarousel = $("#carouselExampleIndicators"),
  $firstAnimatingElems = $myCarousel.
  find(".carousel-item:first").
  find("[data-animation ^= 'animated']");

  //Initialize carousel
  $myCarousel.carousel();

  //Animate captions in first slide on page load
  doAnimations($firstAnimatingElems);

  //Other slides to be animated on carousel slide event
  $myCarousel.on("slide.bs.carousel", function (e) {
    var $animatingElems = $(e.relatedTarget).find(
    "[data-animation ^= 'animated']");

    doAnimations($animatingElems);
  });
})(jQuery);
//# sourceURL=pen.js
    </script>


   <!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
   <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" type="text/javascript"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" type="text/javascript"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.js"></script>
 <script src="<?php echo base_url();?>assets/js/base.js"></script> -->





    <link href="<?php echo base_url();?>assets/frontend/custom_script/form_validation.css" rel="stylesheet">
    <script src="<?php echo base_url();?>assets/frontend/custom_script/validation_rulse.js"></script>


   <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script> -->
    <script>
  $(document).ready(function() {
        var slider = $("#slider");
        var thumb = $("#thumb");
        var slidesPerPage = 4; //globaly define number of elements per page
        var syncedSecondary = true;
        slider.owlCarousel({
            items: 1,
            slideSpeed: 2000,
            nav: false,
            autoplay: false, 
            dots: false,
            loop: true,
            responsiveRefreshRate: 200
        }).on('changed.owl.carousel', syncPosition);
        thumb
            .on('initialized.owl.carousel', function() {
                thumb.find(".owl-item").eq(0).addClass("current");
            })
            .owlCarousel({
                items: slidesPerPage,
                dots: false,
                nav: true,
                item: 4,
                smartSpeed: 200,
                slideSpeed: 500,
                slideBy: slidesPerPage, 
              navText: ['<svg width="18px" height="18px" viewBox="0 0 11 20"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M9.554,1.001l-8.607,8.607l8.607,8.606"/></svg>', '<svg width="25px" height="25px" viewBox="0 0 11 20" version="1.1"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M1.054,18.214l8.606,-8.606l-8.606,-8.607"/></svg>'],
                responsiveRefreshRate: 100
            }).on('changed.owl.carousel', syncPosition2);
        function syncPosition(el) {
            var count = el.item.count - 1;
            var current = Math.round(el.item.index - (el.item.count / 2) - .5);
            if (current < 0) {
                current = count;
            }
            if (current > count) {
                current = 0;
            }
            thumb
                .find(".owl-item")
                .removeClass("current")
                .eq(current)
                .addClass("current");
            var onscreen = thumb.find('.owl-item.active').length - 1;
            var start = thumb.find('.owl-item.active').first().index();
            var end = thumb.find('.owl-item.active').last().index();
            if (current > end) {
                thumb.data('owl.carousel').to(current, 100, true);
            }
            if (current < start) {
                thumb.data('owl.carousel').to(current - onscreen, 100, true);
            }
        }
        function syncPosition2(el) {
            if (syncedSecondary) {
                var number = el.item.index;
                slider.data('owl.carousel').to(number, 100, true);
            }
        }
        thumb.on("click", ".owl-item", function(e) {
            e.preventDefault();
            var number = $(this).index();
            slider.data('owl.carousel').to(number, 300, true);
        });


            /*$(".qtyminus").on("click",function(){
                var now = $(".qty").val();
                if ($.isNumeric(now)){
                    if (parseInt(now) -1> 0)
                    { now--;}
                    $(".qty").val(now);
                }
            })            
            $(".qtyplus").on("click",function(){
                var now = $(".qty").val();
                if ($.isNumeric(now)){
                    $(".qty").val(parseInt(now)+1);
                }
            });*/
    });
    </script>


    <script type="text/javascript">
        

        var toggler = document.getElementsByClassName("caret");
var i;

for (i = 0; i < toggler.length; i++) {
toggler[i].addEventListener("click", function() {
this.parentElement.querySelector(".nested").classList.toggle("active");
this.classList.toggle("caret-down");
});
}
    </script>






  </body>
</html>



