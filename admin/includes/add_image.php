

    <?php 
 
         if(empty($image_height)){

               $image_height = 200;
         }

        if(isset($_POST['add_image'])){
            
            $image_title = $_POST['image_title'];
            $image_column = $_POST['image_column'];
            $image_height = $_POST['image_height'];
            $image_status = $_POST['image_status'];
            $image_cat_id = $_POST['image_category'];
            $image_category = $_POST['image_category'];
            $image_file = $_FILES['image_file']['name'];
            $image_file_temp = $_FILES['image_file']['tmp_name'];                          
            $image_date = escape(date('d-m-y'));                  
            
             move_uploaded_file($image_file_temp , "../images/$image_file");
           
            

             if($image_title == "" || empty($image_title) || $image_file == "" || empty($image_file) || $image_height == "" || empty($image_height)){
                
              
                 echo "<div class='alert alert-danger' role='alert'><strong>Please complete all the fields</strong></div>";
                
            }else{
                
                $stmt = mysqli_prepare($connection, "INSERT INTO gallery_images(image_title,image_column,image_height,image_status,image_category,image_file,image_date) VALUES(?,?,?,?,?,?,NOW()) ");

                mysqli_stmt_bind_param($stmt, 'ssisis', $image_title, $image_column,$image_height,$image_status,$image_category,$image_file);
                
                mysqli_stmt_execute($stmt);

                if(!$stmt){
                    
                    die('QUERY FAILED' . mysqli_error($connection));
                    
                }
               
                mysqli_stmt_close($stmt);
                 
                echo "<div class='alert alert-success' role='alert'><strong>Image Uploaded Successfully </strong> <a href='images.php'>View all Images </a></div>";
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

