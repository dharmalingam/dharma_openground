    <div id="footer">
          <div class="container">
            <p class="muted credit">Example courtesy <a href="http://martinbean.co.uk">Martin Bean</a> and <a href="http://ryanfait.com/sticky-footer/">Ryan Fait</a>.</p>
          </div>
     </div>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/femqueen.js"></script>
    <script src="../assets/js/bootstrap/bootstrap.min.js"></script>
    <script src="../assets/js/bootstrap/bootstrap-transition.js"></script>
    <script src="../assets/js/bootstrap/bootstrap-alert.js"></script>
    <script src="../assets/js/bootstrap/bootstrap-modal.js"></script>
    <script src="../assets/js/bootstrap/bootstrap-dropdown.js"></script>
    <script src="../assets/js/bootstrap/bootstrap-scrollspy.js"></script>
    <script src="../assets/js/bootstrap/bootstrap-tab.js"></script>
    <script src="../assets/js/bootstrap/bootstrap-tooltip.js"></script>
    <script src="../assets/js/bootstrap/bootstrap-popover.js"></script>
    <script src="../assets/js/bootstrap/bootstrap-button.js"></script>
    <script src="../assets/js/bootstrap/bootstrap-collapse.js"></script>
    <script src="../assets/js/bootstrap/bootstrap-carousel.js"></script>
    <script src="../assets/js/bootstrap/bootstrap-typeahead.js"></script>
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>-->
    <script src="../assets/js/jquery.countdown.min.js"></script>
     <script>
      !function ($) {
        $(function(){
          // carousel demo
          $('#myCarousel').carousel()
          
          //Search filter dropdown
        $('#example').popover(data-animation=true);
          //Counter
            $(".digits").countdown({
            image: "../assets/imgs/digits.png",
            format: "mm:ss",
            startTime: "25:14"
            });
            
        })
      }(window.jQuery)
    </script>
      
    <script src="../assets/js/bootstrap/holder/holder.js"></script>

</body>
</html>