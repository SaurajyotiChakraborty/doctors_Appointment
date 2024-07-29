 <style>
    .container-2{
        display:flex !important;
        top: 30% !important;
        margin-top: 70px !important;;
        flex-direction:row;
        width:100vw !important;
        padding-top: 56px !important;
        padding: 36px !important;
        background-color:white;
        align-items:center!important;

        
    /* justify-content: space-between; */
    }
    .doc-img> img{
        border-radius:20% !important;
        border: 2px solid blue;
        
    }
    


.container .card {
    min-width: 80% !important;
    background-color: #bb4a4a;
    border: 1px solid #e9ecef;
    border-radius: 0.25rem;
}



.container-2.btn-outline-primary {
  color: #ed4213;
  border-color: #691b03;
}
.btn {
  display: inline-block;
  font-weight: 400;
  color: #ed4213;;
  text-align: center;
  vertical-align: middle;
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
          user-select: none;
  background-color: transparent;
  border: 1px solid #691b03;
  padding: 0.375rem 0.75rem;
  font-size: 1rem;
  line-height: 1.5;
  border-radius: 0.25rem;
  transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
  align-items:center   !important;
  
}
.container-2 .appointment{
    align-items:center !important;
    justify-content:center!important;
    height:100%!important;

}
    /* .card-title{
        color: black;
    } */ */
</style> 

<?php
// Include database connection
include 'admin/db_connect.php';

// Check if latitude and longitude parameters are provided in the URL
if (isset($_GET['latitude']) && isset($_GET['longitude'])) 
    // Get latitude and longitude from the URL parameters
    $latitude = $_GET['latitude'];
    $longitude = $_GET['longitude'];
    if (!is_numeric($latitude) || !is_numeric($longitude)) {
        echo "Latitude and longitude must be numeric values.";
        exit;
    }
    // Sanitize inputs to prevent SQL injection
    $safe_latitude = $conn->real_escape_string($latitude);
    $safe_longitude = $conn->real_escape_string($longitude);

    // SQL query to fetch doctors within a certain distance from the provided coordinates
    $sql = "SELECT *, ( 6371 * acos( cos( radians($safe_latitude) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians($safe_longitude) ) + sin( radians($safe_latitude) ) * sin( radians( latitude ) ) ) ) AS distance FROM doctors_list HAVING distance < 50 ORDER BY distance";

    $result = $conn->query($sql);

    // Check if there are doctors found
    if ($result->num_rows > 0) {
        // Output doctor details in HTML cards
        while ($row = $result->fetch_assoc()) {
            echo '<div class="container-2">';
            echo '<div class="doc-img col-md-3">';
            echo '<img src="assets/img/' . $row['img_path'] . '" style="width: 250px; height: 300px;" alt="">';
            echo '</div>';
            
            echo '<div class="card col-md-6">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $row['name'] . '</h5>';
            echo '<p>'.  $row['email']. '</b></small></p>';
            echo '<p class="card-text">Clinic Address: ' . $row['clinic_address'] . '</p>';
            echo '<p><small>Contact: <b>'. $row['contact']. '</b></small></p>';
            // Add more details here as needed
            echo '</div>';
            echo '</div>';
            
            echo '<div class="col-md-3 text-center appointment">';
echo '<button class="btn-outline-primary btn mb-4 set_appointment" type="button" data-id="' . $row['id'] . '" data-name="Dr. ' . $row['name'] . ', ' . $row['name_pref'] . '">Set Appointment</button>';
echo '</div>';
                    echo '</div>';
            echo '<hr class="divider" style="max-width: 60vw">';
            
        }
    } else {
        echo 'No doctors found within the specified distance.';
    }
    
?>
						 <!-- <div>
						 	<?php if(!empty($row['specialty_ids'])): ?>
						 	<?php 
						 	foreach(explode(",", str_replace(array("[","]"),"",$row['specialty_ids'])) as $k => $val): 
						 	?>
						 	<span class="badge badge-light" style="padding: 10px"><large><b><?php echo $ms_arr[$val] ?></b></large></span>
						 	<?php endforeach; ?>
						 	<?php endif; ?>
                            
						 </div>
					</div>
					<div class="col-md-3 text-center align-self-end-sm">
						<button class="btn-outline-primary  btn  mb-4 set_appointment" type="button" data-id="<?php echo $row['id'] ?>"  data-name="<?php echo "Dr. ".$row['name'].', '.$row['name_pref'] ?>">Set Appointment</button>
					</div>
				</div>
				<hr class="divider" style="max-width: 60vw"> -->
        
                <script>
                    $('.set_appointment').click(function(){
       	if('<?php echo isset($_SESSION['login_id']) ?>' == 1)
			uni_modal("Set Appointment with "+$(this).attr('data-name'),"set_appointment.php?id="+$(this).attr('data-id'),'mid-large')
		else{
			uni_modal("Login First","login.php")
		}
		})
                </script>
