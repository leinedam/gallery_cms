
        <!-- Footer -->
        <footer class="py-5 bg-white">
          <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-12 text-left ">Copyright &copy; Your Potfolio 2017</div>
                <div class="col-lg-6 col-sm-12 text-right">By <a href="#">Madeleine Sangoi</a></div>
            </div>
          </div>
          <!-- /.container -->
        </footer>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
      <script src="js/popup.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#wrapper").addClass("toggled");
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
        $(".btn-menu").toggleClass("active");
        $("#title-toggle").toggleClass("hide-brand");
    });
    </script>

</body>
</html>
