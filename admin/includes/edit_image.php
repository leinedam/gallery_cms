

    <?php 

        if(isset($_GET['edit'])){
            
            $the_img_id = $_GET['edit'];
                
        
            $stmt = mysqli_prepare($connection, "SELECT image_id,image_title,image_column,image_height,image_status,image_category,image_file,image_date FROM gallery_images WHERE image_id= ?  ");

            mysqli_stmt_bind_param($stmt,"i", $the_img_id );
            
            mysqli_stmt_bind_result($stmt, $image_id, $image_title,$image_column,$image_height,$image_status,$image_category,$image_file, $image_date);

            mysqli_stmt_execute($stmt);

            mysqli_stmt_fetch($stmt);

            if(!$stmt){

                die('QUERY FAILED' . mysqli_error($connection));

            }

            mysqli_stmt_close($stmt);
                         
     

 }

        if(isset($_POST['add_image'])){

              $image_title = escape($_POST['image_title']);
              $image_file = escape($_FILES['image_file']['name']);
              $image_file_temp =  escape($_FILES['image_file']['tmp_name']);
              $image_column = escape($_POST['image_column']);
              $image_height = escape($_POST['image_height']);
              $image_category = escape($_POST['image_category']);
              $image_status = escape($_POST['image_status']);
            
              move_uploaded_file($image_file_temp, "../images/$image_file");
            
              if(empty($image_file)){
             
                    $stmt = mysqli_prepare( $connection, "SELECT image_file FROM gallery_images WHERE image_id = ? ");
                    
                    mysqli_stmt_bind_param($stmt,"i",$the_img_id);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt,$image_file);
                    
                    mysqli_stmt_fetch($stmt);
                    mysqli_stmt_close($stmt);
 
                }

              $stmt = mysqli_prepare($connection, "UPDATE gallery_images SET image_title = ?, image_file = ?, image_column = ?, image_height= ?, image_category = ?, image_status=?  WHERE image_id = ? " );

               mysqli_stmt_bind_param($stmt, "sssiisi", $image_title,$image_file,$image_column,$image_height,$image_category,$image_status, $the_img_id);

               mysqli_stmt_execute($stmt);
            
               echo "<div class='alert alert-success' role='alert'><strong>Image Updated </strong> <a href='images.php'>Update another Image </a></div>";

              if(!$stmt){

                  die("QUERY FAILED". mysqli_error($connection));

              }
              mysqli_stmt_close($stmt);
     
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
                             <input type="text" class="form-control" value="<?php echo $image_title; ?>"  name="image_title"  placeholder="Enter a title">
                             <small class="form-text text-muted">Enter a title</small>
                            </div>
                            <div class="form-group col-md-6">
                             <img src="../images/<?php echo $image_file; ?>" alt="image" width="150">
                             <input type="file" class="form-control-file" id="image_file" name="image_file" aria-describedby="fileHelp">
                            </div>
                          </div>
                            <div class="row">
                              <div class="form-group col-md-6">
                               <label for="image_column">Column Size</label>
                               <select class="form-control" id="image_column" name="image_column">

                                    <?php
                                     $stmt2= mysqli_prepare($connection, "SELECT image_column FROM gallery_images WHERE image_id= ? ");
                                
                                     mysqli_stmt_bind_param($stmt2,"i", $image_id );
                                     mysqli_stmt_execute($stmt2);
                                     mysqli_stmt_bind_result($stmt2, $image_column);
                                   
                                     $small = 'col-md-4';
                                     $medium= 'col-md-6';
                                     $large = 'col-md-12';
                                   
                                    while(mysqli_stmt_fetch($stmt2)){
                                        
                                         echo "<option value='$image_column'>$image_column</option>";
                                            
                           
                                         if($image_column === $small){

                                             echo "<option value=$medium>$medium</option>";
                                             echo "<option value=$large>$large</option>";

                                          } elseif($image_column === $medium){

                                             echo "<option value=$small>$small</option>";
                                             echo "<option value=$large>$large</option>";

                                         }else{
                                             
                                             echo "<option value=$small>$small</option>";
                                             echo "<option value=$medium>$medium</option>";
                                         }
                                        
                                    }
                                 ?>
                               </select>
                              </div>
                              
                            <div class="form-group col-md-6">
                               <label for="image_height">Image Height (px)</label>
                                <input class="form-control"  type="number" name="image_height" min="100" max="650" value="<?php echo $image_height; ?>">
                                <small class="form-text text-muted">Enter a value within 100 and 650px.</small>
                              </div>
                           
                              
                          </div>
                            <div class="row">
                            <div class="form-group col-md-6">
                             <label for="image_status">Status</label>
                             <select class="form-control" id="image_status" name="image_status">
                              
                                <?php
                                     $stmt4= mysqli_prepare($connection, "SELECT image_status FROM gallery_images WHERE image_id= ? ");
                                     
                                     mysqli_stmt_bind_param($stmt4,"i", $image_id );
                                     mysqli_stmt_execute($stmt4);
                                     mysqli_stmt_bind_result($stmt4, $image_status);
 
                                     while(mysqli_stmt_fetch($stmt4)){

                                     echo "<option value='$image_status'>{$image_status}</option>";
                                 
                                     if($image_status === 'active'){

                                          echo "<option value='hidden'>Hidden</option>";

                                      } else{

                                          echo "<option value='active'>Active</option>";
                                      }
                                    }
                                ?>
                                    
                             </select>
                            </div>
                             
                             
                          <div class="form-group col-md-6">
                               <label for="image_category">Category</label>
                               <select class="form-control" id="image_category" name="image_category">
                                 <?php
                                         $stmt3= mysqli_prepare($connection, "SELECT cat_id,cat_title FROM categories WHERE cat_id= ?  ");
                                         mysqli_stmt_bind_param($stmt3,"i", $image_category );
                                         mysqli_stmt_execute($stmt3);
                                         mysqli_stmt_bind_result($stmt3, $cat_id, $cat_title);

                                          while(mysqli_stmt_fetch($stmt3)){

                                                  echo "<option value='$cat_id'>{$cat_title}</option>";
                                         } 
                                   
                                         $stmt5= mysqli_prepare($connection, "SELECT cat_id, cat_title FROM categories");
                                         mysqli_stmt_execute($stmt5);
                                         mysqli_stmt_bind_result($stmt5, $cat_id2, $cat_title2);

                                          while(mysqli_stmt_fetch($stmt5)){

                                            echo "<option value='$cat_id2'>{$cat_title2}</option>";
                                       
                                                  
                                         } 
                                    ?>
                               </select>
                              </div>
                            </div>
                            <button type="submit" name="add_image" class="btn btn-primary">Save</button>
                        </form>
                     </div>
                   </div>

      </div>
      <!-- /#page-content-wrapper -->

