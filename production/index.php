<?php
 // A sessão precisa ser iniciada em cada página diferente
 if (!isset($_SESSION)) session_start();
 include("protect.php");
 protect(basename(__FILE__, '.php').".php");
 $mensagem ='';

?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> Adsumus </title>

    <?php

    include("bibliotecas.php");

    ?>

    <style>
      
      #map {
        width: 100%;
		height: 600px; 
      }
    </style>

  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">

        <?php

        include("sidebar.php");

        ?>
            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="logout.php">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

    <?php

    include("top.php");

    ?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-left top_search">

                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
              <?php if ($mensagem != '') echo $mensagem;?>
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Mapa</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                <div id="map"></div><br><br>

                    <script>
                      var customLabel = {
                        restaurant: {
                          label: 'R'
                        },
                        bar: {
                          label: 'B'
                        }
                      };

                        function initMap() {
                        var map = new google.maps.Map(document.getElementById('map'), {
                          center: new google.maps.LatLng(-26.256349, -49.372953),
                          zoom: 15
                        });
                        var infoWindow = new google.maps.InfoWindow;

                          // Change this depending on the name of your PHP or XML file
                          downloadUrl('resultado.php', function(data) {
                            var xml = data.responseXML;
                            var markers = xml.documentElement.getElementsByTagName('marker');
                            Array.prototype.forEach.call(markers, function(markerElem) {
                              var name = markerElem.getAttribute('name');
                              var address = markerElem.getAttribute('address');
                              var type = markerElem.getAttribute('type');
                              var point = new google.maps.LatLng(
                                  parseFloat(markerElem.getAttribute('lat')),
                                  parseFloat(markerElem.getAttribute('lng')));

                              var infowincontent = document.createElement('div');
                              var strong = document.createElement('strong');
                              strong.textContent = name
                              infowincontent.appendChild(strong);
                              infowincontent.appendChild(document.createElement('br'));

                              var text = document.createElement('text');
                              text.textContent = address
                              infowincontent.appendChild(text);
                              var icon = customLabel[type] || {};
                              var marker = new google.maps.Marker({
                                map: map,
                                position: point,
                                label: icon.label
                              });
                              marker.addListener('click', function() {
                                infoWindow.setContent(infowincontent);
                                infoWindow.open(map, marker);
                              });
                            });
                          });
                        }



                      function downloadUrl(url, callback) {
                        var request = window.ActiveXObject ?
                            new ActiveXObject('Microsoft.XMLHTTP') :
                            new XMLHttpRequest;

                        request.onreadystatechange = function() {
                          if (request.readyState == 4) {
                            request.onreadystatechange = doNothing;
                            callback(request, request.status);
                          }
                        };

                        request.open('GET', url, true);
                        request.send(null);
                      }

                      function doNothing() {}
                        </script>
                    <script async defer
                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBxoNIoua6QoQ2DBkog2OvIngK3r2I69nU&callback=initMap">
                    </script>



                      

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
        </div>
       
        <!-- /page content -->

    <?php

    include("footer.php");

    ?>

  </body>
</html>
