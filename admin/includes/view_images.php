<?php include("includes/delete_modal.php"); ?>
             
         <?php

                $total_images_query = mysqli_prepare($connection, "SELECT image_id FROM gallery_images");

                mysqli_stmt_execute($total_images_query);
                mysqli_stmt_bind_result($total_images_query, $id );
                mysqli_stmt_store_result($total_images_query);

                $total_images = mysqli_stmt_num_rows($total_images_query);

        ?>    
               <!-- /.container -->

                <div class="admin-content">

                   <h1>Images</h1>
                   <br>
   
               
                      <h5 class="text-right text-info">Total Images <?php echo $total_images ;?></h5>
                   <div class="row">
                     <div class="col-md-12">
                       <table class="table">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Columns</th>
                                <th>Order</th>
                                <th></th>
                                <th></th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php

                                    findAllImages();
                               
                               ?> 
                            </tbody>
                          </table>
                     </div>
                   </div>

      </div>
      <!-- /#page-content-wrapper -->
      
        <script>
            $(document).ready(function(){

                $(".delete_link").on('click', function(){

                    var id = $(this).attr("rel");

                    var delete_url = "images.php?delete="+ id +" ";

                    $(".modal_delete_link").attr("href", delete_url);

                    $("#myModal").modal('show');

                });
            });

        </script>
