   
                        </br>
                               
                        <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat-title">Edit Category</label>
                                    <?php 
                                    if(isset($_GET['edit'])){
                                        
                                         $cat_id = $_GET['edit'];
                                        
                                        
                                         $stmt = mysqli_prepare($connection, "SELECT cat_title, cat_id FROM categories WHERE cat_id = $cat_id ");
                                         
                                         mysqli_stmt_execute($stmt);
                                        
                                         mysqli_stmt_bind_result($stmt, $cat_title, $cat_id);

                                         while(mysqli_stmt_fetch($stmt)){
                                    
                                        ?>
                                         
                                         <input value="<?php if(isset($cat_title)){ echo $cat_title; } ?>" type="text" class="form-control" name="cat_title">
                                         
                                     <?php   } } ?>
                                     
                                     <?php
                                    
                                    //updating category
                                      if(isset($_POST['update_category'])){
                                            
                                          $the_cat_title = $_POST['cat_title'];
                                          
                                          $stmt = mysqli_prepare($connection, "UPDATE categories SET cat_title = ? WHERE cat_id = ? " );
                                          
                                           mysqli_stmt_bind_param($stmt, "si", $the_cat_title, $cat_id);
                        
                                           mysqli_stmt_execute($stmt);
                                            
                                          
                                          if(!$stmt){
                                              
                                              die("QUERY FAILED". mysqli_error($connection));
                                              
                                          }
                                          mysqli_stmt_close($stmt);
                                          
                                          header("Location: categories.php");
                                        
                                        }
                                        
                                    ?>
                                    
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
                                </div>
                            </form>