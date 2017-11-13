    <?php include "includes/header.php"; ?>
    <?php include "includes/navigation.php"; ?>
                 
                 
                        <?php 
                            if(isset($_GET['source'])){
                                $source = $_GET['source'];
                            }else{
                                  $source = '';
                            }
                        
                            switch($source){
                                    case 'add_image';
                                    include "includes/add_image.php";
                                    break;
                                    
                                    case 'edit_image';
                                    include "includes/edit_image.php";
                                    break;

                                default:
                                    include "includes/view_images.php";
                                    break;
                            }
                        
                        ?>
                        
    <?php include "includes/footer.php"; ?>