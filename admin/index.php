
    <?php include "includes/header.php"; ?>
    <?php include "includes/navigation.php"; ?>

 <?php                      
         $year = date("Y");
         $month = date("m");
         $monthText = date("M");
         $day = date("d");
         $page = 'gallerypage';

        //total views in current current year
        $year_views = userViewsQueryResult($year, $month, $day, $page, 'year');

        //total views in current current month 
        $month_views = userViewsQueryResult($year, $month, $day, $page, 'month'); 

        //total views in current current day 
        $day_views =  userViewsQueryResult($year, $month, $day, $page, 'day'); 

        //all time views
        $total_views =  userViewsQueryResult($year, $month, $day, $page, 'total'); 
                  
 ?>

                           <!-- /.container -->

                <div class="admin-content">
                  
                   <h1>Welcome</h1>
                   <br>
                  <h2 class="text-center" >Gallery Views</h2>
                   <div class="row card-block-container">
                     <div class="col-md-3">
                       <div class="card-block">
                         <blockquote class="card-blockquote">
                           <h2>YEAR ( <?php echo $year ;?> )</h2>
                           <p><?php echo $year_views ;?></p>
                         </blockquote>
                       </div>
                     </div>
                     <div class="col-md-3">
                       <div class="card-block">
                         <blockquote class="card-blockquote">
                           <h2>MONTH ( <?php echo $monthText ;?> )</h2>
                           <p><?php echo $month_views; ?></p>
                         </blockquote>
                       </div>
                     </div>
                     <div class="col-md-3">
                       <div class="card-block">
                         <blockquote class="card-blockquote">
                           <h2>DAY ( <?php echo $day ;?> )</h2>
                           <p> <?php echo $day_views; ?></p>
                         </blockquote>
                       </div>
                     </div>
                     <div class="col-md-3">
                       <div class="card-block">
                         <blockquote class="card-blockquote">
                           <h2>Total</h2>
                           <p><?php echo $total_views ;?></p>
                         </blockquote>
                       </div>
                     </div>
                   </div>
                   
                   <div class="row ">
                      
                 
                         
                       <div class="col-md-12">
                         
                              <script type="text/javascript">
                                  
                              google.charts.load('current', {'packages':['bar']});
                              google.charts.setOnLoadCallback(drawChart);

                              function drawChart() {
                                var data = google.visualization.arrayToDataTable([
                                
                                ['Last Six Months', 'Views'],
                                  
                                    <?php

                                        //$element_text = ['Year Views','Total Views'];
                                        $element_text = ['Year','Month','Day', 'Total'];


                                        $element_count = [$year_views,$month_views,$day_views, $total_views ];

                                            for($i=0;$i<4;$i++){
                                                
                                                echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
                                                
                                            }
                                    ?>

                                //  ['Post', 1000],
                                ]);

                                var options = {
                                  chart: {
                                    title: '',
                                    subtitle: '',
                                  }
                                };

                                var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                                chart.draw(data, google.charts.Bar.convertOptions(options));
                              }
                            </script>

                            <div id="columnchart_material" style="width: 'auto'; height: 300px;"></div>
                       </div>
                   </div>

      </div>
      <!-- /#page-content-wrapper -->


    <?php include "includes/footer.php"; ?>