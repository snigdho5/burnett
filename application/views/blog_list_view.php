<!-- Body -->
<div class="container-fluid pt-4 pb-4">
<div class="container pt-4 pb-4">
    <h1>Blog</h1>
      <div class="row">
    
    </div>

<div class="row blog_list pt-2">
            
             <?php if(count($blog_list)>0){
                    foreach($blog_list as $row){
                  ?>
            <div class="col-md-4 mb-3">
                <div class="card-content">
                    <div class="card-img">
                       <?php if($row->image !=''){ ?> <img class="img-fluid" src="<?php echo base_url();?>uploads/blog/small/<?php echo $row->image;?>" alt=""/> <?php } ?>                       
                    </div>
                    <div class="card-desc">
                        <h4><?php echo $row->blog_title;?></h4>
                        <p><?php echo character_limiter(@$row->description,60);?></p>
                            <a href="<?php echo base_url();?>blog-details/<?php echo $row->blog_id;?>/<?php echo $row->blog_slug;?>" class="btn-card">Read More</a>   
                    </div>
                </div>
            </div>

        <?php } } ?>

<!-- 
            <div class="col-md-4 mb-3">
                <div class="card-content">
                    <div class="card-img">
                        <img class="img-fluid" src="images/blog02.jpg" alt=""/>                        
                    </div>
                    <div class="card-desc">
                        <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h4>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laboriosam, voluptatum! Dolor quo, perspiciatis
                            voluptas totam</p>
                            <a href="#" class="btn-card">Read More</a>   
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card-content">
                    <div class="card-img">
                        <img class="img-fluid" src="images/blog03.jpg" alt=""/>                        
                    </div>
                    <div class="card-desc">
                        <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h4>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laboriosam, voluptatum! Dolor quo, perspiciatis
                            voluptas totam</p>
                            <a href="#" class="btn-card">Read More</a>   
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card-content">
                    <div class="card-img">
                        <img class="img-fluid" src="images/blog01.jpg" alt=""/>                        
                    </div>
                    <div class="card-desc">
                        <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h4>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laboriosam, voluptatum! Dolor quo, perspiciatis
                            voluptas totam</p>
                            <a href="#" class="btn-card">Read More</a>   
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card-content">
                    <div class="card-img">
                        <img class="img-fluid" src="images/blog02.jpg" alt=""/>                        
                    </div>
                    <div class="card-desc">
                        <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h4>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laboriosam, voluptatum! Dolor quo, perspiciatis
                            voluptas totam</p>
                            <a href="#" class="btn-card">Read More</a>   
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card-content">
                    <div class="card-img">
                        <img class="img-fluid" src="images/blog03.jpg" alt=""/>                        
                    </div>
                    <div class="card-desc">
                        <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h4>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laboriosam, voluptatum! Dolor quo, perspiciatis
                            voluptas totam</p>
                            <a href="#" class="btn-card">Read More</a>   
                    </div>
                </div>
            </div> -->



        </div>
  <div class="col-md-12 mt-3 mb-3">
       <!--  <ul class="pagination pagination-center">
    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item active"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">Next</a></li>
  </ul> -->


  <?php echo @$links; ?>


        </div>
</div>
</div>

<!-- Body