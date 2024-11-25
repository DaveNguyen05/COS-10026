<?php
//redirect to another page
$referer = $_SERVER['HTTP_REFERER'];
$referer_parse = parse_url($referer);

if($referer_parse['host'] == "mercury.swin.edu.au" || $referer_parse['host'] == "www.mercury.swin.edu.au") {
     // Page content will display
} else {
     header("Location: https://mercury.swin.edu.au/cos10026/s101617498/assign2/index.php");
     exit();
}

//connection
require_once("settings.php");
$conn = new mysqli($host, $user, $pwd, $sql_db);

//sanitise function
function sanitise_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jobRefNo = $_POST["referenceNumber"];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $dateOfBirth = $_POST["dob"];
    $streetAddress = $_POST["streetAddress"];
    $suburbTown = $_POST["suburbTown"];
    $postcode = $_POST["postcode"];
    $emailAddress = $_POST["emailAddress"];
    $phoneNumber = $_POST["phoneNumber"];
    $gender = $_POST["gender"];
    $state = $_POST["state"];
    $skills = isset($_POST["skill"]) ? implode(', ', $_POST["skill"]) : "";
    $otherSkills = $_POST["otherSkills"];
    $otherSkillsCheckBox = $_POST["otherSkillsCheckbox"];

    $errors = [];

    //client-side validation is disabled
    //validate job reference number
    if (!preg_match('/^[A-Za-z0-9]{5}$/', $jobRefNo)) {
        $errors[] = "Job reference number must be exactly 5 alphanumeric characters.";
     //   mysqli_close($conn);
    }

    //validate first name
    if (strlen($firstName) > 20 || !preg_match('/^[A-Za-z]+$/', $firstName)) {
        $errors[] = "First name maximum of 20 characters";
      //  mysqli_close($conn);
    }

    //validate last name
    if (strlen($lastName) > 20 || !preg_match('/^[A-Za-z]+$/', $lastName)) {
        $errors[] = "Last name maximum of 20 characters";
     //   mysqli_close($conn);
    }

    //validate date of birth
    $dmy = explode("/", $dateOfBirth);
    if (count($dmy) == 3) {
        list($day, $month, $year) = $dmy;
        if (!checkdate($month, $day, $year) || $year < date("Y") - 80 || $year > date("Y") - 15) {
            $errors[] = "Error, must be between 15-80 years old";
            $conn->close();
        }
    } else {
        $errors[] = "Error inserting date of birth";
     //   mysqli_close($conn);
    }

    //validate gender
    if (isset($gender) != TRUE) {
        $errors[] = "Gender not selected";
      //  mysqli_close($conn);
    }

    //validate street address
    if (strlen($streetAddress) > 40 ) {
        $errors[] = "streetAddress error";
     //   mysqli_close($conn);
    }

    //validate city
    if (strlen($suburbTown) > 40 ) {
        $errors[] = "City maximum of 40 characters";
      //  mysqli_close($conn);
    }

    //validate state
    if (isset($state)) {
        $states = array("act", "nsw", "nt", "qld", "sa", "tas", "vic", "wa");
        if (!in_array(strtolower($state), $states)) {
            $errors[] =  "state does not exist";
         //  mysqli_close($conn);
        }
    }

    //validate postcode, length, matches state NOT IMPLEMENTED
    if (empty($postcode)) {
        $errors[] =  "<p>Please type your postcode</p>";
        $conn->close();
    } else if (!preg_match('#[0-9]{4}#', $postcode)) {
       $errors[] = "The post code must be a 4-digit number.";
      // mysqli_close($conn);
    } else if (!preg_match('/^(0[289][0-9]{2})|([1-9][0-9]{3})$/', $postcode)) {
       $errors[] = "The post code is not a valid ";
    }

    //validate email address format
    if (!preg_match('/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/', $emailAddress)) {
        $errors[] = "Error inserting email address.";
       // mysqli_close($conn);
    }

    //validate phone number
     if (!preg_match('/^((\+61\s?)?(\((0|02|03|04|07|08)\))?)?\s?\d{1,4}\s?\d{1,4}\s?\d{0,4}$/', $phoneNumber)) {
        $errors[] =  "Phone number must be 8 to 12 digits or spaces";
        //mysqli_close($conn);
    }

    //otherskills not empty if check box selected
    if ($otherSkillsCheckBox == "selected" && $otherSkills == "") {
        $errors[] =  "No other skills entered despite checking the related box, please try again";
        //mysqli_close($conn);
    }

    //sanitise data to prevent SQL injection
    $jobRefNo = sanitise_input($jobRefNo);
    $firstName = sanitise_input($firstName);
    $lastName = sanitise_input($lastName);
    $streetAddress = sanitise_input($streetAddress);
    $suburbTown = sanitise_input($suburbTown);
    $postcode = sanitise_input($postcode);
    $emailAddress = sanitise_input($emailAddress);
    $phoneNumber = sanitise_input($phoneNumber);
    $gender = sanitise_input($gender);
    $state = sanitise_input($state);
    $skills = sanitise_input($skills);
    $otherSkills = sanitise_input($otherSkills);

    //When a user submits an EOI, if an EOI table does not already exist in the database the table will be programmatically created.
    $createData = "CREATE TABLE IF NOT EXISTS eoi(
        `EOINumber` int(11) NOT NULL AUTO_INCREMENT,
        `JobRefNo` varchar(16) NOT NULL,
        `FirstName` varchar(20) NOT NULL,
        `LastName` varchar(20) NOT NULL,
        `DateOfBirth` DATE NOT NULL,
        `StreetAddress` varchar(40) NOT NULL,
        `SuburbTown` varchar(40) NOT NULL,
        `State` varchar(3) NOT NULL,
        `Postcode` varchar(4) NOT NULL,
        `EmailAddress` varchar(45) NOT NULL,
        `PhoneNumber` varchar(15) NOT NULL,
        `Gender` varchar(6) NOT NULL,
        `Skills` varchar(45) NOT NULL,
        `OtherSkills` varchar(120) NOT NULL,
        `Status` enum('New','Current','Final') NOT NULL DEFAULT 'New'
        PRIMARY KEY (`EOINumber`);
    )";

    //SQL insert, queries and display of auto incremented primary key 
    $insertSQL = "INSERT INTO eoi (jobRefNo, firstName, lastName, dateOfBirth, streetAddress, suburbTown, postcode, emailAddress, phoneNumber, gender, state, skills, otherSkills) 
    VALUES ('$jobRefNo', '$firstName', '$lastName', '$dateOfBirth', '$streetAddress', '$suburbTown', '$postcode', '$emailAddress', '$phoneNumber', '$gender', '$state', '$skills', '$otherSkills')";
    $conn->query($createData);
    $conn->query($insertSQL);

    if ($conn->query($insertSQL) === TRUE) {
        $IncrementValue = $conn->insert_id;
        echo "EOI number is: $IncrementValue";
    } else {
        echo "Error: " . $insertSQL . "<br>" . $conn->error;
        
    }
} 
?>