    <?php
     include 'Header.php';

      $sql = "SELECT * FROM about_us";
   $result_about = mysqli_query($con, $sql);
   $result_about_details= mysqli_fetch_assoc($result_about);

    $sql2 = "SELECT * FROM glass_management";
   $result_glass_management = mysqli_query($con, $sql2);
   $glass_management_arr= mysqli_fetch_assoc($result_glass_management);

   $sql3 = "SELECT * FROM animation_management LIMIT 0,5";
   $result_animation_management = mysqli_query($con, $sql3);
   $animation_management_arr= mysqli_fetch_assoc($result_animation_management);
 

   // $sql2 = "SELECT * FROM comproject";
  // $result_comproject = mysqli_query($con, $sql2);

   $showRecordPerPage = 12;
if(isset($_GET['page']) && !empty($_GET['page'])){
$currentPage = $_GET['page'];
}else{
$currentPage = 1;
}
$startFrom = ($currentPage * $showRecordPerPage) - $showRecordPerPage;
$totalEmpSQL = "select * from comproject order by id desc";
$allEmpResult = mysqli_query($con, $totalEmpSQL);
$totalEmployee = mysqli_num_rows($allEmpResult);
$lastPage = ceil($totalEmployee/$showRecordPerPage);
$firstPage = 1;
$nextPage = $currentPage + 1;
$previousPage = $currentPage - 1;
$empSQL = "select * from comproject order by id desc LIMIT $startFrom, $showRecordPerPage";
$empResult = mysqli_query($con, $empSQL);





$showRecordPerPage2 = 12;
if(isset($_GET['page']) && !empty($_GET['page'])){
$currentPage2 = $_GET['page'];
}else{
$currentPage2 = 1;
}
$startFrom2 = ($currentPage2 * $showRecordPerPage2) - $showRecordPerPage2;
$totalEmpSQL2 = "select * from comproject order by id desc";
$allEmpResult2 = mysqli_query($con, $totalEmpSQL2);
$totalEmployee2 = mysqli_num_rows($allEmpResult2);
$lastPage2 = ceil($totalEmployee2/$showRecordPerPage2);
$firstPage2 = 1;
$nextPage2 = $currentPage2 + 1;
$previousPage2 = $currentPage2 - 1;
$empSQL2 = "select * from comproject order by id desc LIMIT $startFrom2, $showRecordPerPage2";
$empResult2 = mysqli_query($con, $empSQL2);




      ?>

   <!-- Banner Start -->
<div id="myCarousel" class="carousel slide carausel-custom-c" data-ride="carousel">       
    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <img src="images/about_us/<?=$result_about_details['image']?>" alt="Chania">
      </div> 
   
  </div>
<!-- Banner End -->

    <!-- Head Intro Section Start -->
      <div class="product-main-header">
          <div class="container">
              Projects Completed
          </div>
      </div>
    <!-- Head Intro Section End -->

    <!-- Product section Start -->
    <div class="product-complete-wrapper-cont clearfix">
        <div class="container">
          

           <!--  <div class="col-md-3 col-sm-4">
                <div class="product-com-item">
                    <div class="prod-com-image">
                        <img src="images/a1.jpg" alt="image">
                    </div>
                    <div class="prod-com-content">
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#myModal">Elita Garden Vista Keppel Magus Development Pvt. Ltd (Singapore)</a>
                    </div>
                </div>
            </div> -->

             <?php
                    $empResult_count=1;
                     while($row_data=mysqli_fetch_assoc($empResult)){
            
                        ?>


            <div class="col-md-3 col-sm-4">
                <div class="product-com-item">
                    <div class="prod-com-image">
                       <?php if(@$row_data['image'] !=''){ ?> <img style="height: 400px; width: 400px;" src="images/comproject/<?=$row_data['image']?>" alt="image">
                       <?php } else{?><img style="height: 400px; width: 400px;" src="images/seris-4.jpg" alt="image">
                   <?php } ?>
                    </div>
                    <div class="prod-com-content">
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#myModal<?php echo $empResult_count;?>" ><?php echo $row_data['project_name'];?></a>
                    </div>
                </div>
            </div>
        <?php $empResult_count=$empResult_count+1;} ?>
            
           



        </div>
    </div>
    <!-- Product section End -->

    <!-- Lightbox popup Modal -->
<?php
          $detempResult_count=1;
          while($row_data=mysqli_fetch_assoc($empResult2)) { ?>

            


           
     
    <div id="myModal<?php echo $detempResult_count;?>" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
    
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $row_data['project_group'];?></h4>
            </div>
            <div class="modal-body pop-up-modal-body">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="prod-com-image">
                             <?php if(@$row_data['image'] !=''){ ?> <img style="height: 300px; width: 300px" src="images/comproject/<?=$row_data['image']?>" alt="image">
                       <?php } else{?><img src="images/seris-4.jpg" alt="image">
                   <?php } ?>
                   
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="pop-up-modal-content">
                            <h3><?php echo $row_data['project_name'];?></h3>
                            <p>
<?php echo $row_data['project_description'];?>
</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <hr>
                        <h3><b>Topology</b></h3>
                    </div>

                    <?php
          
          while($row_data=mysqli_fetch_assoc($result_animation_management)) { ?>


                    <div class="col-sm-2">
                        <div class="topo-products">
                            <div class="topo-image">
                                <?php if(@$row_data['animation_image'] !=''){ ?> <img style="height: 300px; width: 300px" src="images/animationimage/<?=$row_data['animation_image']?>" alt="image">
                       <?php } else{?><img src="images/seris-4.jpg" alt="image">
                   <?php } ?>
                            </div>
                            <div class="topo-content"><?php echo $row_data['animation_name']; ?></div>
                        </div>
                    </div>

                <?php } ?>

                   


                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <hr>
                        <h3><b>Glass Options</b></h3>
                    </div>

                    <?php

                    
          
          while($row_data=mysqli_fetch_assoc($result_glass_management)) { 
           


            ?>



                    <div class="col-sm-2">
                        <div class="seris-image">
                            <?php if(@$row_datag['glass_image'] !=''){ ?> <img style="height: 300px; width: 300px" src="images/glassimage/<?=$row_datag['glass_image']?>" alt="image">
                       <?php } else{?><img src="images/seris-4.jpg" alt="image">
                   <?php } ?>
                            
                        </div>
                    </div>

                <?php } ?>

                 


                    <div class="col-sm-12">
                        <hr><!-- Use for line -->
                    </div>
                </div>
                
                
            </div>
        </div>
    
        </div>
    </div>

     <?php $detempResult_count=$detempResult_count+1; } ?>


  

    <!-- Pagination Start -->
    <div class="container">
        <div class="pagination-wrapper-c">
            <ul class="pagination">

                <?php if($currentPage != $firstPage) { ?>
                            <li>
                                <a class="page-link" href="?page=<?php echo $firstPage; ?>" tabindex="-1" aria-label="Previous">
                                <span aria-hidden="true">First</span>
                                </a>
                            </li>
                            <?php } ?>
                            <?php if($currentPage >= 2) { ?>
                                <li><a class="page-link" href="?page=<?php echo $previousPage; ?>"><?php echo $previousPage; ?></a></li>
                                <?php } ?>
                                <li class="active"><a class="page-link" href="?page=<?php echo $currentPage; ?>"><?php echo $currentPage; ?></a>
                                </li>
                                <?php if($currentPage != $lastPage) { ?>
                                <li><a class="page-link" href="?page=<?php echo $nextPage; ?>"><?php echo $nextPage; ?></a></li>
                                <li class="page-item">
                                <a class="page-link" href="?page=<?php echo $lastPage; ?>" aria-label="Next">
                                <span aria-hidden="true">Last</span>
                                </a>
                                </li>
                                <?php } ?>


               <!--  <li><a href="#">1</a></li>
                <li class="active"><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li> -->
            </ul>
        </div>
    </div>
    <!-- Pagination End -->

</div>



   <?php
     include 'Footer.php'; ?>

