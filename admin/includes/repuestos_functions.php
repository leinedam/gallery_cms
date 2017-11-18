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

function countImagesInDatabase(){
    
         global $connection;

    
         $result = mysqli_prepare($connection, "SELECT image_id FROM gallery_images");
         mysqli_stmt_execute($result);
         mysqli_stmt_bind_result($result, $id);
         mysqli_stmt_store_result($result);
         $final_result = mysqli_stmt_num_rows($result);
    
         return $final_result;   
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

            $the_cat_id = escape($_GET['delete']);


            $stmt = mysqli_prepare($connection,  "DELETE FROM categories WHERE cat_id = ? " );
             
            mysqli_stmt_bind_param($stmt,"i", $the_cat_id );    
            mysqli_stmt_execute($stmt);
            mysqli_stmt_fetch($stmt);
          
            // refresh page
            header("Location: categories.php");

          
     }
}




############################################
#
# IMAGES.PHP
#
#############################################

function findAllImages($order_type){
    
      global $connection;
    
    
      switch($order_type){
                case 'Order';
                $order = "gallery_images.image_order DESC";
                break;

                case 'Newest';
                $order = "gallery_images.image_date";
                break;

                case 'Oldest';
                $order =  'gallery_images.image_date DESC';
                break;

                case 'Name';
                $order = 'gallery_images.image_title';
                break;

                case 'Category';
                $order = 'gallery_images.image_category DESC';
                break;

            default:
                $order = "gallery_images.image_order DESC";
                break;
        }

        $stmt =  mysqli_prepare($connection, "SELECT gallery_images.image_id, gallery_images.image_file, gallery_images.image_title, gallery_images.image_category, gallery_images.image_date, gallery_images.image_status, categories.cat_title, categories.cat_id FROM gallery_images LEFT JOIN categories ON gallery_images.image_category = categories.cat_id ORDER BY $order");
             
    
    
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
             echo "<td><a href='images.php?orderup={$image_id}' class='btn btn-info' ><i class='fa fa-chevron-up' aria-hidden='true'></i> </a></td>";
             echo "<td><a href='images.php?orderdown={$image_id}' class='btn btn-info' ><i class='fa fa-chevron-down' aria-hidden='true'></i> </a></td>";
             echo "<td><a rel='{$image_id}'  href='javascript:void(0)' class='delete_link btn btn-danger'>Delete</a></td>";  
             echo "<td><a href='images.php?source=edit_image&edit={$image_id}' class='btn btn-secondary'>Edit</a></td>";
             echo "</tr>";   
                    
    }
    

    
      if(isset($_GET['delete'])){ 
      
                $the_image_id = mysqli_real_escape_string($connection, $_GET['delete']);
           
                $stmt = mysqli_prepare($connection,  "DELETE FROM gallery_images WHERE image_id = ? " );

                mysqli_stmt_bind_param($stmt,"i", $the_image_id );    
                mysqli_stmt_execute($stmt);
                mysqli_stmt_fetch($stmt);

                 // refresh page
                header("Location: images.php");
      }
    
    
    if(isset($_GET['orderup'])){
        
        $the_image_id = escape($_GET['orderup']);

        $final_result = countImagesInDatabase();

                // select next image
        $query3 = " SELECT image_order from gallery_images  WHERE image_id = {$the_image_id} ";
        
        $order_query3 = mysqli_query($connection, $query3);

        
          while($row = mysqli_fetch_array($order_query3)){
          
                    $next_order = $row['image_order'];
                    $next_order = $next_order + 1;
          
         }
        
        if($final_result >= $next_order){
            
                        // update the next image
            $query2 = " UPDATE gallery_images 
                            SET image_order = ($final_result * image_order / $final_result) - 1
                            WHERE image_order = $next_order ";

            $order_query2 = mysqli_query($connection, $query2);


            $query = " UPDATE gallery_images 
                            SET image_order = ($final_result * image_order / $final_result) + 1
                            WHERE image_id = {$the_image_id} ";

            $order_query = mysqli_query($connection, $query);


            header("Location: images.php");
            
        }else{
            
            echo "This image is already the first";
            
        }
        
    }
    
    
    
        if(isset($_GET['orderdown'])){
        
        $the_image_id = escape($_GET['orderdown']);

        $final_result = countImagesInDatabase();

                // select next image
        $query3 = " SELECT image_order from gallery_images  WHERE image_id = {$the_image_id} ";
        
        $order_query3 = mysqli_query($connection, $query3);

        
          while($row = mysqli_fetch_array($order_query3)){
          
                    $next_order = $row['image_order'];
                    $next_order = $next_order - 1;
          
         }
        

            if( $next_order > 0 ){
                       
            // update the next image
            $query2 = " UPDATE gallery_images 
                            SET image_order = ($final_result * image_order / $final_result) + 1
                            WHERE image_order = $next_order ";

            $order_query2 = mysqli_query($connection, $query2);
            

            $query = " UPDATE gallery_images 
                            SET image_order = ($final_result * image_order / $final_result) - 1
                            WHERE image_id = {$the_image_id} ";

            $order_query = mysqli_query($connection, $query);
            
           


            header("Location: images.php");
                
            }else{
                
                echo "This image is already the Last";
            }
            
      
        
    }
    

  

}



############################################
#
# INDEX.PHP   // VIEWS COUNTER
#
#############################################



function userViewsQueryResult($year, $month, $day, $page, $type){

    global $connection;
    
     if($type == 'day'){

        $result = mysqli_prepare($connection, "SELECT id FROM pageview WHERE page= ?  and year= ?  and month= ?  and day= ?  ");
        mysqli_stmt_bind_param($result, "ssss", $page, $year, $month , $day );
   
        
    }elseif($type == 'month'){
         
         $result = mysqli_prepare($connection, "SELECT id FROM pageview WHERE page = ? and year = ? and month = ? " );
         mysqli_stmt_bind_param($result,"sss", $page, $year,$month );
         
     }elseif($type == 'year'){
         
        $result = mysqli_prepare($connection, "SELECT id FROM pageview WHERE page = ? and year = ? " ); 
        mysqli_stmt_bind_param($result,"ss", $page, $year );

     }elseif($type == 'total'){
         
         $result = mysqli_prepare($connection, "SELECT id FROM pageview WHERE page=  ?  ");
         mysqli_stmt_bind_param($result,"s", $page );

     }
    
         mysqli_stmt_execute($result);
         mysqli_stmt_bind_result($result, $id);
         mysqli_stmt_store_result($result);
         $final_result = mysqli_stmt_num_rows($result);
         
         return $final_result;  
}



    


?>

