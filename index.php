
    <?php include "includes/header.php"; ?>
    <?php include "includes/navigation.php"; ?>
    
    
        <!-- Page Menu -->
        <div id="page-content-wrapper">
        <div class="container-fluid top-menu-fix">
            <div class="filter-panel" >
               <a href="#menu-toggle" class="btn-menu" id="menu-toggle"><i class="fa fa-bars" aria-hidden="true"></i></a>
               <div class="container-brand" id="title-toggle">
                   <a href="#" >DIA Gallery</a>
               </div>
                 <?php include "includes/nav-categories.php"; ?>
            </div>
            <br/>
        </div>
               
        <!-- /.container -->
        <section>
          <div class="container">
             <div class="row zoom-gallery">
                   
                       <?php
                            
                        if(empty($image_height)){
                                $image_height = 200;
                        }
                 
                 
                          $stmt = mysqli_prepare($connection, "SELECT image_title,image_file,image_status,image_category,image_column,image_height  FROM gallery_images ORDER BY image_order DESC");
                 
                           mysqli_stmt_execute($stmt);
                           mysqli_stmt_bind_result($stmt,$image_title,$image_file,$image_status,$image_category,$image_column,$image_height);


                        while(mysqli_stmt_fetch($stmt)){
                             
                             if($image_status == 'active'){
                               
                            
                         ?>
                         
                             <div class="<?php echo $image_column ; ?> filter <?php echo $image_category; ?>">
                                   <div class="gallery_product" style="height:<?php echo $image_height;?>px">
                                         <a href="images/<?php echo $image_file ;?>" class="image-popup" title="Image caption">
                                           <div class="img-overlay">
                                            <div class="img-text" name="image_title"><?php echo $image_title ;?></div>
                                            </div>
                                            <img src="images/<?php echo $image_file ;?>" class="img-fluid img-image">
                                         </a>
                                    </div>
                            </div>

                    <?php  } } ?>
                    
                    
                </div>
            </div>
        </section>


   <?php include "includes/footer.php"; ?>

