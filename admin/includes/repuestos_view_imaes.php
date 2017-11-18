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
   
                    <div class="row">
                        <div class="col-md-12">
                             <form method="post">
                                 <table class="table">
                                     <tr>
                                         <td>
                                              <select class="form-control" id="image_order" name="image_order">
                                                <option value=''>
                                                 <?php 
                                                     if(isset($_POST['change_order'])){

                                                        echo "Order by ". escape($_POST['image_order']);

                                                      }else{

                                                         echo "Select an Order Option";
                                                      } 
                                                  ?> 
                                                </option>
                                                 <option value='Newest'> Order by Newest</option>
                                                 <option value='Oldest'>Order by Oldest</option>
                                                 <option value='Order'>Order by Order</option>
                                                 <option value='Name'>Order by Name</option>
                                                 <option value='Category'>Order by Category</option>
                                               </select>
                                         </td>
                                         <td>
                                               <button type="submit" name="change_order" class="btn btn-default">Search</button>
                                         </td>
                                         <td>
                                              <h5 class="text-right text-success">Total Images <?php echo $total_images ;?></h5>
                                         </td>
                                     </tr>
                                 </table>
                            </form>
                        </div>
                    </div>
                    
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
                                <th>Move</th>
                                <th></th>
                                <th></th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php

                                if(isset($_POST['change_order'])){
                                    
                                    $image_order = escape($_POST['image_order']);

                                    findAllImages($image_order);

                                }
                                 else{
                                        
                                    findAllImages('Order');
                                }
  
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
