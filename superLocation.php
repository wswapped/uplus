<?php include("template/header.php");?>
<?php
$sql_account = $db->query("SELECT * FROM accounts");
$sql_users = $db->query("SELECT * FROM users");

?>
 <!-- Page -->
    <!--Google map script-->
  <script src="http://maps.google.com/maps/api/js?key=AIzaSyCDseHuiz9DmPFLeQK4FjimzbLDTjj2nQM" type="text/javascript"></script>
   <!--End of the google map-->
  <div class="page animsition">
      <div class="page-content container-fluid"  style="padding-top:2px;padding-bottom:2px;">
        <div class="row">
          <div id="map" style="width: 100%; height: 590px;padding-right:2px;">
    <script type="text/javascript">
    var locations = [
      <?php
      while($fetch_lat_lng = mysqli_fetch_assoc($sql_account))
        {
          $long = $fetch_lat_lng['Glongitude'];
          $lat = $fetch_lat_lng['Glatitude'];
          $id = $fetch_lat_lng['accName'];
          echo "[


            "."'"?> <div  style="font-size:18px;text-decoration:none;text-shadow:0 2px 2px #444;font-weight:bold;"><a href="#"><?php echo $id;?></a> </div><?php echo "'".",". $long.",". $lat."],";

        }
      ?>
    ];

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 9,
      center: new google.maps.LatLng(-1.9900,29.9999),
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      draggable: true,
      scaleControl: false,
      scrollwheel: false,

    });
    

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
  </script>
          </div>
        </div>
      </div>
  </div>
<?php include ("template/footer.php");?>


</body>

</html>              
