<div class="container-fluid pt-4 pb-4">
    <div class="container pt-4 pb-4">
        <div class="col-md-12 text-center pt-4 pb-4">

            <?php
            if ($order_status == 1) {
            ?>
                <a href="<?php echo base_url(); ?>my-account"><img src="<?php echo $img_icon_url; ?>" width="100" alt="" /><br />
                    <img src="<?php echo $img_status_url; ?>" alt="" class="pt-4 pb-4 img-fluid" /></a>
                <h4><?php echo $order_msg; ?></h4>
            <?php
            } else {
            ?>
                <a href="<?php echo base_url(); ?>my-account"><img src="<?php echo $img_icon_url; ?>" width="100" alt="" /><br />
                    <img src="<?php echo $img_status_url; ?>" alt="" class="pt-4 pb-4 img-fluid" /></a>
                    <h4><?php echo $order_msg; ?></h4>
            <?php
            }
            ?>

        </div>
    </div>
</div>