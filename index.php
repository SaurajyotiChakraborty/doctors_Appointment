<!DOCTYPE html>
<html lang="en">
<head>


<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Leaflet CSS and JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<!-- Your custom scripts -->

</head>
    <?php
    session_start();
    ob_start();
    include('header.php');
    include('admin/db_connect.php');

	$query = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
	foreach ($query as $key => $value) {
		if(!is_numeric($key))
			$_SESSION['setting_'.$key] = $value;
	}
    ob_end_flush();
    ?>

    <style>
    	header.masthead {
		  background: url(assets/img/<?php echo $_SESSION['setting_cover_img'] ?>);
		  background-repeat: no-repeat;
		  background-size: cover;
      height: 100vh;
      }
      div.container{
        min-width: -webkit-fill-available;
        padding: 0;
        margin:0 10px !important;
        overflow: hidden;
      }
      .tabs{
        display: flex;
    justify-content: center;
    align-items: center;
    min-width: 100vh;
    background: transparent;
    }

    .tabs a{
      position: relative;
    font-size: 1.1em;
    color: red !important;
    text-decoration: none;
    padding: 20px;
    transition: .5s;

    }
    .tabs a:hover{
      color: white !important;

    }
    .tabs a span{
    position: absolute !important;
    top: 0 !important;
    left: 0 !important;
    width: 100% !important;
    height: 100% !important;
    z-index: -1 !important;
    border-bottom: 2px solid white !important;
    border-radius: 15px !important;
    transform: scale(0) translateY(50px) !important;
    opacity: 0 !important;
    transition: .5s !important;


    }
    .tabs a:hover span{
    transform: scale(1) translateY(0) !important;
    opacity: 1 !important;
   
    }
    
    
    #mainNav .navbar-nav .nav-item:last-child .nav-link {
    padding-right:  14px !important;
  }

  nav#mainNav {
    background:  transparent!important;
    color: rgb(235 9 9 / 70%) !important;

     
}
nav#mainNav.navbar-scrolled {
  background:#03232ff0!important;

}

#mainNav .navbar-brand {
  font-family: "Merriweather Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
  font-weight: 700;
  color: white;
}

#mainNav .navbar-nav .nav-item .nav-link {
  color: white !important;
  font-family: "Merriweather Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
  font-weight: 700;
  font-size: 0.9rem;
  padding: 0 0.75rem ;
  

}
#mainNav .navbar-nav .nav-item .nav-link:hover {
    color: #46CAF4!important;
}
#mainNav.navbar-scrolled .navbar-nav .nav-item .nav-link {
    color: #b3cce4 !important;
}
#mainNav.navbar-scrolled .navbar-brand {
    color: #b3cce4;
  }

body {
  margin: 0;
  font-family: "Merriweather", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
  font-size: 1rem;
  font-weight: 400;
  line-height: 1.5;
  color:  #f2f6f9;
  text-align: left;
  background-color:  #026588f0!important;
}
/* #mainNav.navbar-scrolled {
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    background-color: #b3cce4;
  } */
  #mainNav .navbar-brand:hover {
    color: #46CAF4!important;
  }
  
  #mainNav.navbar-scrolled.navbar-nav .nav-item .nav-link{
    color:#b3cce4!important;
  }
    .col-lg-10.align-self-end.mb-4.page-title {
    padding: 10rem !important;
    }
    h3, .h3 {
    font-size: 2.75rem !important;
}
hr.divider {
  max-width: 32.25rem;
  border-width: 0.2rem;
  border-color:#19a6d3 ;
}
.btn-primary {
  color: #fff;
  background-color:#0b9ecc;
  border-color: #f4623a;
}
.btn-primary:hover{
  background-color:#1c39bb!important;
}


.card {
  position: relative;
  display: flex;
  flex-direction: column;
  min-width: 0;
  word-wrap: break-word;
  background-color: #00232d;
  background-clip: border-box;
  border: 1px solid rgba(0, 0, 0, 0.125);
  border-radius: 0.25rem;
}


*,
*::before,
*::after {
  box-sizing: border-box;
  color: #f1e3e3;
  
}
#mainNav .navbar-nav .nav-item .nav-link.active {
  color: white!important;
}
#mainNav .navbar-nav .nav-item .nav-link.active:hover {
  color: #46CAF4!important;
}
.badge-light {
  color: #212529;
  background-color: black;
}

.btn-outline-primary {
  color: #f0ddd8;
    border-color: #e6d6d1;
}
.bg-light {
    background-color: #010910bd !important;
}
/* .btn-outline-primary {
  color: #ed4213;
  border-color: #691b03;
}
.btn {
  display: inline-block;
  font-weight: 400;
  color: #212529;
  text-align: center;
  background-color: transparent;
  border: 1px solid red;
  padding: 0.375rem 0.75rem;
  font-size: 1rem;
  line-height: 1.5;
  border-radius: 0.25rem;
  transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
  
} */ */
</style>
<!-- <script>
  document.getElementById('close').addEventListener('click', function() {
	window.location.href="index.php?page=doctors"
  });
  

      
  
  </script> -->
    <body id="page-top">
        <!-- Navigation-->
        <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body text-white">
        </div>
      </div>
        <nav class="navbar navbar-scrolled  navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="./"><?php echo $_SESSION['setting_name'] ?></a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-scrolled navbar-collapse tabs" id="navbarResponsive">
                    <ul class="navbar-nav  ml-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=home">Home<span></span></a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger"  href="javascript:void(0)" id="locate_doctors"></span>Doctors Near Your Location<span></span></a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=about">About<span></span></a></li>
                        <?php if(isset($_SESSION['login_id'])): ?>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="admin/ajax.php?action=logout2"><?php echo "Welcome ".$_SESSION['login_name'] ?> <i class="fa fa-power-off"></i></a></li>
                      <?php else: ?>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="javascript:void(0)" id="login_now">Login <span></span></a></li>
                      <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
       
        <?php 
        $page = isset($_GET['page']) ?$_GET['page'] : "home";
        include $page.'.php';
        ?>
       

<div class="modal fade" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
      </div>
      <div class="modal-body">
        <div id="delete_content"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
        <button type="button" class="btn btn-secondary" id="close"data-dismiss="modal">Cancel </button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal_right" role='dialog'>
    <div class="modal-dialog modal-full-height  modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="fa fa-arrow-righ t"></span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      </div>
    </div>
  </div>
  <style>
    

    
        /* Customize the map modal styling with Leaflet CSS */
        #map_modal .modal-body {
            height: 400px;
            /* Set an appropriate height */
        }

        #map {
            width: 100%;
            height: 100%;
        }
    </style>

    <div class="modal fade" id="map_modal" tabindex="-1" role="dialog" aria-labelledby="mapModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mapModalLabel">Doctor's Location</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="map"></div>
            </div>
        </div>
    </div>


        <footer class="bg-light py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="mt-0">Contact us</h2>
                        <hr class="divider my-4" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 ml-auto text-center mb-5 mb-lg-0">
                        <i class="fas fa-phone fa-3x mb-3 text-muted"></i>
                        <div><?php echo $_SESSION['setting_contact'] ?></div>
                    </div>
                    <div class="col-lg-4 mr-auto text-center">
                        <i class="fas fa-envelope fa-3x mb-3 text-muted"></i>
                        <!-- Make sure to change the email address in BOTH the anchor text and the link target below!-->
                        <a class="d-block" href="mailto:<?php echo $_SESSION['setting_email'] ?>"><?php echo $_SESSION['setting_email'] ?></a>
                    </div>
                </div>
            </div>
            <br>
            <div class="container"><div class="small text-center text-muted">Copyright © 2024 - <?php echo $_SESSION['setting_name'] ?></div></div>
        </footer>
        
       <?php include('footer.php') ?>
       <script>
        // Get all tabs
        var tabs = document.querySelectorAll('.navbar-nav .nav-link');

        // Get the selector
        var selector = document.querySelector('.selector');

        // Add click event listener to each tab
        tabs.forEach(function(tab) {
            tab.addEventListener('click', function() {
                // Remove 'active' class from all tabs
                tabs.forEach(function(t) {
                    t.classList.remove('active');
                });

                // Add 'active' class to the clicked tab
                this.classList.add('active');

                // Move the selector to the clicked tab
                var tabPosition = this.getBoundingClientRect();
                var tabsPosition = this.closest('.tabs').getBoundingClientRect();
                var leftOffset = tabPosition.left - tabsPosition.left;
                var width = tabPosition.width;
                selector.style.left = leftOffset + 'px';
                selector.style.width = width + 'px';
            });
        });

        // Check if the current page URL matches any link href
        tabs.forEach(function(tab) {
            if (tab.href === window.location.href) {
                // Add 'active' class to the tab if it matches the current page URL
                tab.classList.add('active');

                // Move the selector to the active tab
                var tabPosition = tab.getBoundingClientRect();
                var tabsPosition = tab.closest('.tabs').getBoundingClientRect();
                var leftOffset = tabPosition.left - tabsPosition.left;
                var width = tabPosition.width;
                selector.style.left = leftOffset + 'px';
                selector.style.width = width + 'px';
            }
        });
    </script>
    <script>
        // Function to get user's location
       async function getUserLocation() {
            if (navigator.geolocation) {
              await navigator.geolocation.getCurrentPosition(showDoctorsNearLocation);
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        // Function to handle the retrieved location and load doctors
        function showDoctorsNearLocation(position) {
            // Extract latitude and longitude from the position object
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
            var accuracy = position;

            console.log('var Location:', latitude, longitude, accuracy);


            // AJAX call to fetch doctors near the user's location
            $.ajax({
                url: 'ajax.php', // Update the URL to your server-side script
                type: 'POST',
                data: {
                    action: 'get_doctors_near_location',
                    latitude: latitude,
                    longitude: longitude
                },
                success: function(response) {
                    // Log the response to the console
                    // console.log('Doctors Near Your Location:', response);

                    // Get the user's latitude and longitude
                    var userLatitude = position.coords.latitude;
                    var userLongitude = position.coords.longitude;

                    // Log the user's location to the console
                        console.log('User Location:', userLatitude, userLongitude);

                    // Display the user's location in the modal title
                    $('#uni_modal .modal-title').html('Doctors Near Your Location - Latitude: ' + userLatitude + ', Longitude: ' + userLongitude);
                    var jsonResponse = response;
                    // console.log("jsonResponse", jsonResponse)
                    // Parse the JSON string to get an array of doctor objects
                    var doctorsArray = JSON.parse(jsonResponse);
                    // Output doctors in a clickable link format
                    var linkHTML = '<ul>';
                    doctorsArray.forEach(function(doctor) {
                        // console.log(doctor)
                        linkHTML += '<li><a href="#locate_doctors" class="doctor-link" data-id="' + doctor.id + '">' + doctor.id + " " + doctor.name + '</a></li>';
                    });
                    linkHTML += '</ul>';

                    // Display the link HTML in the modal body
                    $('#uni_modal .modal-body').html(linkHTML);
                    $('#uni_modal').modal('show');
                },
                error: function() {
                    alert('Error fetching doctors. Please try again.');
                }
            });
        }

        $('#locate_doctors').on('click', function() {
            getUserLocation();
        });

        $(document).on('click', '.doctor-link', function(e) {
            e.preventDefault();
            getUserLocation();
            // Get the doctor's ID from the data-id attribute
            var doctorId = $(this).data('id');
            // console.log(doctorId)
            // AJAX call to fetch latitude and longitude for the clicked doctor
            $.ajax({
                url: 'ajax.php',
                type: 'POST',
                data: {
                    action: 'get_doctor_location',
                    id: doctorId
                },
                success: function(response) {
                    // Log the response to the console
                        console.log('Doctor Location:', response);
                    var correctedStr = response.substring(1);

                    // console.log('Corrected string:', correctedStr);
                    var res = correctedStr
                    var parsedResponse = JSON.parse(res);
                    // console.log('Parsed response:', parsedResponse.latitude)
                    // Check if latitude and longitude are available
                    if (parsedResponse.latitude && parsedResponse.longitude) {
                        console.log('Latitude:', parsedResponse.latitude);
                        console.log('Longitude:', parsedResponse.longitude);
                        // Display the location on the map
                        showMap(parsedResponse.latitude, parsedResponse.longitude);
                    } else {
                        alert('Latitude and longitude not available for the selected doctor.');
                    }
                },
                error: function() {
                    alert('Error fetching doctor location. Please try again.');
                }
            });
        });

        function showMap(latitude, longitude) {
            // Check if the map container already has a map instance
            var existingMap = L.DomUtil.get('map');
            var tabs = document.querySelectorAll('.navbar-nav .nav-link');

            // If a map instance exists, remove it before initializing a new one
            if (existingMap) {
                existingMap._leaflet_id = null;
            }

            // Create a map centered at the given latitude and longitude
            var map = L.map('map').setView([latitude, longitude], 15);

            // Add a tile layer (you can use a different tile layer depending on your preference)
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            // Add a marker at the doctor's location
            var marker = L.marker([latitude, longitude]).addTo(map)
                .bindPopup('Doctor Location - Latitude: ' + latitude + ', Longitude: ' + longitude)
                .openPopup();

            // Open the map in a modal
            $('#map_modal').modal('show');

            // Attach an event listener to the modal's hidden.bs.modal event
            $('#map_modal').on('hidden.bs.modal', function() {
                // Remove the map when the modal is closed
                map.remove();
            });

            // Redirect to doctors.php on map click
            map.on('click', function() {
                window.location.href = 'index.php?page=singledoctor&latitude='+latitude+'&longitude='+longitude;
            });
        }
    </script>
    <script>
  document.getElementById('close').addEventListener('click', function() {
	window.location.href="index.php?page=doctors"
  });
  

      
  
  </script>
    </body>

    <?php $conn->close() ?>

</html>
