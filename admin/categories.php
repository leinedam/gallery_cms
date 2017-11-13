
    <?php include "includes/header.php"; ?>
    <?php include "includes/navigation.php"; ?>



              <!-- /.container -->

                <div class="admin-content">

                   <h1>Categories</h1>
                   <br>

                   <div class="row">

                     <div class="col-md-6">
                       <table class="table">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Category</th>
                                <th>Edit</th>
                                <th>Delete</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                                
                                findAllCategories();
                                    
                                ?>
                            </tbody>
                          </table>
                     </div>

                     <div class="col-md-6">
                        <?php 
                                insert_categories();
                         
                                deleteCategories();
                        ?>
                     </div>
                </div>

      </div>
      <!-- /#page-content-wrapper -->
      
    

    <?php include "includes/footer.php"; ?>
