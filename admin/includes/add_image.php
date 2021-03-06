

    <?php 
 
         if(empty($image_height)){

               $image_height = 200;
         }

        if(isset($_POST['add_image'])){
            
            $image_title = escape($_POST['image_title']);
            $image_column = escape($_POST['image_column']);
            $image_height = escape($_POST['image_height']);
            $image_status = escape($_POST['image_status']);
            $image_cat_id = escape($_POST['image_category']);
            $image_category = escape($_POST['image_category']);
            $image_file = escape($_FILES['image_file']['name']);
            $image_file_temp = escape($_FILES['image_file']['tmp_name']);                          
            $image_date = escape(date('d-m-y'));    
            $image_order = 0 ;    
     
            
             move_uploaded_file($image_file_temp , "../images/$image_file");


             if($image_title == "" || empty($image_title) || $image_file == "" || empty($image_file) || $image_height == "" || empty($image_height)){
                
              
                 echo "<div class='alert alert-danger' role='alert'><strong>Please complete all the fields</strong></div>";
                
            }else{
                
                $stmt = mysqli_prepare($connection, "INSERT INTO gallery_images( image_title,image_column,image_height,image_status,image_category,image_file,image_order,image_date) VALUES(?,?,?,?,?,?,?,NOW()) ");

                mysqli_stmt_bind_param($stmt, 'ssisisi', $image_title, $image_column,$image_height,$image_status,$image_category,$image_file,$image_order);
                
                mysqli_stmt_execute($stmt);

                if(!$stmt){
                    
                    die('QUERY FAILED' . mysqli_error($connection));
                    
                }
               
                mysqli_stmt_close($stmt);
                 

                echo "<div class='alert alert-success' role='alert'><strong>Image Uploaded Successfully </strong> <a href='images.php'>View all Images </a></div>";
                 
                 
                // IMAGE ORDER FUNCTION
                //GET IMAGE ID
                $stmt2 = mysqli_prepare($connection, "SELECT image_id FROM gallery_images WHERE image_title = ? " );
                mysqli_stmt_bind_param($stmt2, "s", $image_title );
                mysqli_stmt_execute($stmt2);
                mysqli_stmt_bind_result($stmt2, $image_id);
                mysqli_stmt_fetch($stmt2);
                mysqli_stmt_close($stmt2);
                 
                 // COUNT ALL ELELEMTNS IN DATABASE
                 
                $final_result = countImagesInDatabase();
                 
              

                // UPDATING IMAGE ORDER
                $stmt3 = mysqli_prepare($connection, "UPDATE gallery_images SET image_order = ?  WHERE image_title = ? ");
                mysqli_stmt_bind_param($stmt3, 'is', $final_result, $image_title );
                mysqli_stmt_execute($stmt3);
                mysqli_stmt_close($stmt3);

                 
            }
                     
        }


    ?>

             
              <!-- /.container -->

                <div class="admin-content">

                   <h1>Edit Image</h1>
                   <br>

                   <div class="row">
                     <div class="col-md-12">

                       <form action="" method="post" enctype="multipart/form-data">
                          <div class="row">
                            <div class="form-group col-md-6">
                             <label for="image_title">Title</label>
                             <input type="text" class="form-control" name="image_title"  placeholder="Enter a title">
                             <small class="form-text text-muted">Enter a title</small>
                            </div>
                            <div class="form-group col-md-6">
                             
                             <label for="image_file">File input</label>
                             <input type="file" class="form-control-file" id="image_file" name="image_file" aria-describedby="fileHelp">
                             <small class="form-text text-muted">Enter an Image.</small>
                            </div>
                          </div>
                            <div class="row">
                               <div class="form-group col-md-6">
                             <label for="image_status">Status</label>
                             <select class="form-control" id="image_status" name="image_status">
                               <option value="active" >Visible</option>
                               <option value="hidden" >Hidden</option>
                             </select>
                            </div>
                             
                              <div class="form-group col-md-6">
                               <label for="image_category">Category</label>
                               <select class="form-control" id="image_category" name="image_category">
                                    <?php
                                         $stmt= mysqli_prepare($connection, "SELECT cat_id, cat_title FROM categories ");
                                         mysqli_stmt_execute($stmt);
                                         mysqli_stmt_bind_result($stmt, $cat_id, $cat_title);

                                          while(mysqli_stmt_fetch($stmt)){

                                                  echo "<option value='$cat_id'>{$cat_title}</option>";
                                         } 
                                    ?>
                               </select>
                              </div>
                          </div>
                            <div class="row">
                             <div class="form-group col-md-6">
                               <label for="image_column">Column Size</label>
                               <select class="form-control" id="image_column" name="image_column">
                                 <option value="col-md-4">col-md-4 (Small)</option>
                                 <option value="col-md-6">col-md-6 (Medium)</option>
                                 <option value="col-md-12">col-md-12 (Large)</option>
                               </select>
                              </div>
                              <div class="form-group col-md-6">
                               <label for="image_height">Image Height</label>
                                <input class="form-control"  type="number" name="image_height" min="100" max="650" 
                                    value="<?php echo $image_height;?>">
                                <small class="form-text text-muted">Enter a value within 100 and 650px.</small>
                              </div>
                            </div>
                            <button type="submit" name="add_image" class="btn btn-primary">Save</button>
                        </form>
                     </div>
                   </div>

      </div>
      <!-- /#page-content-wrapper -->

