<?php

############################################
#
# GENERAL HELPER FUNCTIONS
#
#############################################


// escaping queires for security
function escape($string){
    
   global $connection;
    
   return mysqli_real_escape_string($connection, trim($string));
}


// query failed message
function confirmQuery($result){
    
    global $connection;
    
    if(!$result){
            die("QUERY FAILED ." . mysqli_error($connection));
    }
   
}

############################################
#
# CATEGORIES.PHP
#
#############################################

function insert_categories(){
    
      global $connection;
    
      if(isset($_POST['submit'])){
                                
            $cat_title = $_POST['cat_title'];

            if($cat_title == "" || empty($cat_title)){
                
  
                echo "<div class='alert alert-danger' role='alert'><strong>This field should not be empty</strong></div>";
                
                
            }else{
                
               
                    $stmt = mysqli_prepare($connection, "INSERT INTO categories(cat_title) VALUES(?) ");

                    mysqli_stmt_bind_param($stmt, 's', $cat_title);
                
                    mysqli_stmt_execute($stmt);

                    if(!$stmt){

                        die('QUERY FAILED' . mysqli_error($connection));

                    }
                
                mysqli_stmt_close($stmt);
                
                header("Location: categories.php");
                

                
            }

        }
        ?>
        
       <form action="" method="post">
            <div class="form-group">
             <label for="cat_title">Category Name</label>
             <input type="text" class="form-control" id="cat_title" name="cat_title" aria-describedby="emailHelp" placeholder="Enter a category">
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Save</button>
       </form>

          <?php 
            if(isset($_GET['edit'])){
                $cat_id = escape($_GET['edit']);
                include "includes/update_categories.php";
            }
}


function findAllCategories(){
    
        global $connection;

         $stmt =  mysqli_prepare($connection, "SELECT cat_id, cat_title FROM categories");

         mysqli_stmt_execute($stmt);
         mysqli_stmt_bind_result($stmt, $cat_id, $cat_title);

         while(mysqli_stmt_fetch($stmt)){


             echo "<tr>";
             echo "<td>{$cat_id}</td>";
             echo "<td>{$cat_title}</td>";
             echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
             echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
             echo "</tr>";
    }

}


function deleteCategories(){
    
      global $connection;

      if(isset($_GET['delete'])){

            $the_cat_id = $_GET['delete'];

            $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";

            $delete_query = mysqli_query($connection,$query);
            // refresh page
            header("Location: categories.php");
     }
}




############################################
#
# IMAGES.PHP
#
#############################################

function findAllImages(){
    
        global $connection;
    
    
         $stmt =  mysqli_prepare($connection, "SELECT gallery_images.image_id, gallery_images.image_file, gallery_images.image_title, gallery_images.image_category, gallery_images.image_date, gallery_images.image_status, categories.cat_title, categories.cat_id FROM gallery_images LEFT JOIN categories ON gallery_images.image_category = categories.cat_id ORDER BY gallery_images.image_id DESC ");

         mysqli_stmt_execute($stmt);
         mysqli_stmt_bind_result($stmt, $image_id, $image_file, $image_title, $image_category, $image_date, $image_status, $cat_title, $cat_id);
           

         while(mysqli_stmt_fetch($stmt)){


             echo "<tr>";
             echo "<td>{$image_id}</td>";
             echo "<td><img src='../images/{$image_file}' width='130px'></td>";
             echo "<td>{$image_title}</td>";
             echo "<td>{$cat_title}</td>";
             echo "<td>{$image_date}</td>";
             echo "<td>{$image_status}</td>";
             echo "<td><a rel='{$image_id}' href='javascript:void(0)' class='delete_link'>Delete</a></td>";  
             echo "<td><a href='images.php?source=edit_image&edit={$image_id}'>Edit</a></td>";
             echo "</tr>";   
                    
    }
    

       if(isset($_GET['delete'])){ 
      
                $the_image_id = mysqli_real_escape_string($connection, $_GET['delete']);
                $query = "DELETE FROM gallery_images WHERE image_id = {$the_image_id}";
                $delete_query = mysqli_query($connection, $query);

                confirmQuery($delete_query);

                 // refresh page
                header("Location: images.php");
      }
    
  

}


############################################
#
# LOG IN
#
#############################################


?>

