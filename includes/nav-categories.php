
          <div align="center">
               <button class="btn btn-default filter-button active" data-filter="all">All</button>
                 
                  <?php
                     $stmt= mysqli_prepare($connection, "SELECT cat_title, cat_id FROM categories ");
                     mysqli_stmt_execute($stmt);
                     mysqli_stmt_bind_result($stmt, $cat_title, $cat_id);

                     while(mysqli_stmt_fetch($stmt)){

                          echo "<button class='btn btn-default filter-button' data-filter='{$cat_id}'>{$cat_title}</button>";
                     }
                   ?>     
           </div>