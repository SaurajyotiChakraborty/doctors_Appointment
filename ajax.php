<?php
// Include database connection
include('admin/db_connect.php');

// Check if the action is set in the AJAX request
if (isset($_POST['action'])) {
    $action = $_POST['action'];

    // Check the action type
    switch ($action) {
        case 'get_doctors_near_location':
            handleGetDoctorsNearLocation($conn);
            break;

        case 'get_doctor_location':
            handleGetDoctorLocation($conn);
            break;
        default:
            echo json_encode(['error' => 'Invalid action.']);
            break;
    }
} else {
    echo json_encode(['error' => 'No action specified.']);
}

// Close the database connection
$conn->close();

function handleGetDoctorsNearLocation($conn)
{

    function calculateCoordinates($latitude, $longitude, $distance_km)
    {
        // Earth's radius in kilometers
        $earth_radius_km = 6371;

        // Convert distance from kilometers to radians
        $distance_rad = $distance_km / $earth_radius_km;

        // Convert latitude and longitude from degrees to radians
        $latitude_rad = deg2rad($latitude);
        $longitude_rad = deg2rad($longitude);

        // Calculate new latitude and longitude
        $new_latitude_rad = asin(sin($latitude_rad) * cos($distance_rad) + cos($latitude_rad) * sin($distance_rad) * cos(0));
        $new_longitude_rad = $longitude_rad + atan2(sin(0) * sin($distance_rad) * cos($latitude_rad), cos($distance_rad) - sin($latitude_rad) * sin($new_latitude_rad));

        // Convert new latitude and longitude from radians to degrees
        $new_latitude = rad2deg($new_latitude_rad);
        $new_longitude = rad2deg($new_longitude_rad);

        // Return the new coordinates as an associative array
        return array('latitude' => $new_latitude, 'longitude' => $new_longitude);
    }

    // Check if latitude and longitude are provided
    if (isset($_POST['latitude']) && isset($_POST['longitude'])) {
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
        $distance_km = 10;
        // Define the radius of 10 kilometers in degrees (approximately)
        $new_coordinates = calculateCoordinates($latitude, $longitude, $distance_km);

        // Assign new latitude and longitude values
        $latitude = $new_coordinates['latitude'];
        $longitude = $new_coordinates['longitude'];

        // Prepare SQL query to fetch doctors within the calculated coordinates
        $query = $conn->prepare("SELECT id, name, latitude, longitude FROM doctors_list WHERE latitude BETWEEN ? AND ? AND longitude BETWEEN ? AND ?");
        if ($query === false) {
            die(json_encode(['error' => 'Error preparing query: ' . $conn->error]));
        }

        $minLatitude = $latitude - 2;
        $maxLatitude = $latitude + 2;
        $minLongitude = $longitude - 2;
        $maxLongitude = $longitude + 2;

        // Bind parameters to the prepared statement
        $query->bind_param("dddd", $minLatitude, $maxLatitude, $minLongitude, $maxLongitude);
        if (!$query->execute()) {
            die(json_encode(['error' => 'Error executing query: ' . $query->error]));
        }

        // Get the result of the query
        $result = $query->get_result();

        // Output doctors in JSON format
        $doctors = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $doctors[] = [
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'latitude' => $row['latitude'],
                    'longitude' => $row['longitude'],
                ];
            }
        }

        // Close the database connection
        $query->close();

        // Output JSON response
        echo json_encode($doctors);
    } else {
        echo json_encode(['error' => 'Latitude and longitude not provided.']);
    }
}

function handleGetDoctorLocation($conn)
{
    // Check if the doctor's ID is provided
    if (isset($_POST['id'])) {
        $doctor_id = $_POST['id'];
        echo error_log('Received get_doctor_location request for doctor ID: ' . $doctor_id);

        // Fetch latitude and longitude from the database based on the doctor's ID
        $query = $conn->prepare("SELECT name, latitude, longitude FROM doctors_list WHERE id = ?");
        $query->bind_param('i', $doctor_id);
        $query->execute();
        $query->bind_result($name, $latitude, $longitude);

        // Check if the record exists
        if ($query->fetch()) {
            // Check if latitude and longitude are not null
            if ($latitude !== null && $longitude !== null) {
                // Output the location in JSON format
                echo json_encode([ 'latitude' => $latitude, 'longitude' =>$longitude, 'name' => $name]);
            } else {
                echo json_encode(['error' => 'Latitude or longitude is null for the selected doctor.']);
            }
        } else {
            // Output an error message if the record is not found
            echo json_encode(['error' => 'Doctor not found']);
        }

        // Close the database connection
        $query->close();
    } else {
        // Output an error message if the doctor's ID is not provided
        echo json_encode(['error' => 'Doctor ID not provided']);
    }
}


