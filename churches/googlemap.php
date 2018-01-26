<!DOCTYPE html>
<html>
<head>
	<title>google map auto complete</title>
</head>
<body>
<?php
    if (isset($_POST['addevent'])) {
        ?>

        <h4 class="heading_a uk-margin-bottom">Add Event</h4>
            <form id="uploadForm"> 
                <div style="margin: 2px;" class="uk-grid uk-grid-medium" data-uk-grid-margin>
                    <div class="uk-width-large-4-6">
                        <div class="md-card">
                            <div class="md-card-content">  
                                <div class="md-input-wrapper">
                                    <input type="text" id="ename" name="ename" class="md-input" placeholder="Event Name">
                                    <span class="md-input-bar "></span>
                                </div>
                                <div class="md-input-wrapper">
                                    <input type="text" name="location" id="location" class="md-input" placeholder="Event Location"> 
                                </div>
                                <div class="md-input-wrapper">
                                    <input type="date" id="edate" name="edate" class="md-input" placeholder="Event Date"/>
                                    <span class="md-input-bar "></span>
                                </div>
                                <div class="md-input-wrapper">
                                    <input type="time" id="etime" name="etime" class="md-input" placeholder="Event Time"/>
                                    <span class="md-input-bar "></span>
                                </div>
                                <div class="md-input-wrapper">
                                    <select onchange="sellingFun()" id="eventS" name="eventS" data-md-selectize>
                                        <option>select</option>
                                        <option value="sale">For sale</option>
                                        <option value="notsale">Not for sale</option>
                                    </select>
                                    <span class="md-input-bar "></span>
                                </div>
                                <div class="md-input-wrapper">
                                    <input type="file" id="eimg" name="eimg" /><br/>
                                    <span class="md-input-bar "></span>
                                </div>
                                <input type="submit" name="submit" value="ADD" class="md-btn md-btn-success">
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-large-2-6">
                        <div style="display: none;" id="pass" class="md-card">
                            <form id="uploadForm">
                                <div class="md-card-toolbar">
                                    <h3 class="md-card-toolbar-heading-text">
                                        Add Event Pass
                                    </h3>
                                </div>
                                <div class="md-card-content">
                                    <div class="md-input-wrapper">
                                        Pass Name: <input type="text" id="ticketName" name="ticketName" class="md-input">
                                        <span class="md-input-bar "></span>
                                    </div>
                                    <div class="md-input-wrapper">
                                        Pass Price: <input type="number" id="ticketPrice" name="ticketPrice" class="md-input">
                                        <span class="md-input-bar "></span>
                                    </div>
                                    <div class="md-input-wrapper">
                                        Pass Place: <input type="number" id="ticketPlace" name="ticketPlace" class="md-input">
                                        <span class="md-input-bar "></span>
                                    </div>
                               </div>
                            </form>
                        </div>
                    </div>
                </div>
            </form>
        <?php
    }

?>
    
    <!-- google web fonts -->
    <script>
        WebFontConfig = {
            google: {
                families: [
                    'Source+Code+Pro:400,700:latin',
                    'Roboto:400,300,500,700,400italic:latin'
                ]
            }
        };
        (function() {
            var wf = document.createElement('script');
            wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
            '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
            wf.type = 'text/javascript';
            wf.async = 'true';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(wf, s);
        })();
    </script>

    <!-- common functions -->
    <script src="assets/js/common.min.js"></script>
    <!-- uikit functions -->
    <script src="assets/js/uikit_custom.min.js"></script>
    <!-- altair common functions/helpers -->
    <script src="assets/js/altair_admin_common.min.js"></script>

    <!-- page specific plugins -->
        <!-- d3 -->
        <script src="bower_components/d3/d3.min.js"></script>
        <!-- metrics graphics (charts) -->
        <script src="bower_components/metrics-graphics/dist/metricsgraphics.min.js"></script>
        <!-- chartist (charts) -->
        <script src="bower_components/chartist/dist/chartist.min.js"></script>
        <!-- maplace (google maps) -->
        <script src="http://maps.google.com/maps/api/js"></script>
        <script src="bower_components/maplace-js/dist/maplace.min.js"></script>
        <!-- peity (small charts) -->
        <script src="bower_components/peity/jquery.peity.min.js"></script>
        <!-- easy-pie-chart (circular statistics) -->
        <script src="bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
        <!-- countUp -->
        <script src="bower_components/countUp.js/dist/countUp.min.js"></script>
        <!-- handlebars.js -->
        <script src="bower_components/handlebars/handlebars.min.js"></script>
        <script src="assets/js/custom/handlebars_helpers.min.js"></script>
        <!-- CLNDR -->
        <script src="bower_components/clndr/clndr.min.js"></script>

        <!--  dashbord functions -->
        <script src="assets/js/pages/dashboard.min.js"></script>
    
    <script>
        $(function() {
            if(isHighDensity()) {
                $.getScript( "bower_components/dense/src/dense.js", function() {
                    // enable hires images
                    altair_helpers.retina_images();
                });
            }
            if(Modernizr.touch) {
                // fastClick (touch devices)
                FastClick.attach(document.body);
            }
        });
        $window.load(function() {
            // ie fixes
            altair_helpers.ie_fix();
        });
    </script>

    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-65191727-1', 'auto');
        ga('send', 'pageview');
    </script>

    <script type="text/javascript">
    $(document).ready(function (e) {
        $("#uploadForm").on('submit',(function(e) {
            e.preventDefault();
            var ename      =  document.getElementById('ename').value;
            var elocation  =  document.getElementById('location').value;
            var etime      =  document.getElementById('etime').value;
            var edate       =  document.getElementById('edate').value;
            var eimg       =  document.getElementById('eimg').value;
            var esale       =  document.getElementById('eventS').value;
            var ticketPrice       =  document.getElementById('ticketPrice').value;
            var ticketPlace      =  document.getElementById('ticketPlace').value;
            var ticketName       =  document.getElementById('ticketName').value;
            if (ename == "" || ename == null) {
                alert("Name of event must be filled");
                return false;
            }
            else if (elocation == "" || elocation == null) {
                alert("Location of event must be filled");
                return false; 
            }
            else if (etime == "" || etime == null) {
                alert("what time is event will be");
                return false; 
            }
            else if (edate == "" || edate == null) {
                alert("fill date an event will be");
                return false; 
            }
            else if (eimg == "" || eimg == null) {
                alert("upload event profile");
                return false; 
            }
            else if (esale == "select" || edate == null) {
                alert("select if event is for sale or not");
                return false; 
            }
            else if (esale == "sale" && ticketPrice == "") {
                alert("Enter event pass price");
                return false; 
            }
            else if (esale == "sale" && ticketPlace == "") {
                alert("Enter event pass number of Place");
                return false; 
            }
            else if (esale == "sale" && ticketName == "") {
                alert("Enter event pass Name");
                return false; 
            }
            else {
                $.ajax({
                    url: "addanevent.php",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(data)
                    {
                        $("#page_content").html(data);
                    },
                    error: function() 
                    {
                    }           
                });
            }
        }));
    });
    </script>

    <script type="text/javascript">
        function sellingFun() {
            var selling = document.getElementById('eventS').value;
            if (selling == 'sale') {
                document.getElementById('pass').style.display = 'block';
            } else {
                document.getElementById('pass').style.display = 'none';
            }

        }
    </script>

    
    <script src="http://maps.googleapis.com/maps/api/js?libraries=places" type="text/javascript"></script>
    <script type="text/javascript">
        google.maps.event.addDomListener(window, 'load', initialize);
        function initialize() {
            var autocomplete = new google.maps.places.Autocomplete(document.getElementById('location'));
            google.maps.event.addListener(autocomplete, 'place_changed', function () {
                var place = autocomplete.getPlace();
                document.getElementById('city2').value = place.name;
                document.getElementById('cityLat').value = place.geometry.location.lat();
                document.getElementById('cityLng').value = place.geometry.location.lng();
                // alert("This function is working!");
                // alert(place.name);
                // alert(place.address_components[0].long_name);

            });
        }
    </script>
</body>
</html>