   <!--footer-->
        <footer class="sticky-footer">
            <div class="container">
                <div class="text-center">
                    <small>Copyright &copy; Sistem Pos Integrated 2018</small>
                </div>
            </div>
        </footer>
        <!--/footer-->
    </div>
    <!--/main content wrapper-->

    
    <script type="text/javascript">
        function includeHTML() {
          var z, i, elmnt, file, xhttp;
          /*loop through a collection of all HTML elements:*/
          z = document.getElementsByTagName("*");
          for (i = 0; i < z.length; i++) {
            elmnt = z[i];
            /*search for elements with a certain atrribute:*/
            file = elmnt.getAttribute("w3-include-html");
            if (file) {
              /*make an HTTP request using the attribute value as the file name:*/
              xhttp = new XMLHttpRequest();
              xhttp.onreadystatechange = function() {
                if (this.readyState == 4) {
                  if (this.status == 200) {elmnt.innerHTML = this.responseText;}
                  if (this.status == 404) {elmnt.innerHTML = "Page not found.";}
                  /*remove the attribute, and call this function once more:*/
                  elmnt.removeAttribute("w3-include-html");
                  includeHTML();
                }
              } 
              xhttp.open("GET", file, true);
              xhttp.send();
              /*exit the function:*/
              return;
            }
          }
        }

        includeHTML();
    </script>

</body>

   <!-- tutup footer -->
  
  <script type="text/javascript" src="<?php echo $this->config->item('url_plugins') ?>select2/select2.min.js"></script>

<script type="text/javascript" src="<?php echo $this->config->item('url_plugins') ?>icheck/icheck.min.js"></script>

  <script type="text/javascript" src="<?php echo $this->config->item('url_plugins') ?>datepicker/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="<?php echo $this->config->item('url_plugins') ?>datepicker/locales/bootstrap-datepicker.id.js"></script>
  <script type="text/javascript" src="<?php echo $this->config->item('url_plugins') ?>JQuery-validation/dist/jquery.validate.js"></script>
  <script type="text/javascript" src="<?php echo $this->config->item('url_plugins') ?>JQuery-validation/dist/localization/messages_id.js"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('url_plugins') ?>JQuery-validation/css/cmxform.css">

</html>