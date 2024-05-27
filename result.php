<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>result</title>
    <link rel="icon" href="logo1.png">
</head>
<body>
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_SESSION['uid'])) {
    $userid=$_SESSION['uid'];
}

// Retrieve the question ID from the URL parameter
$questionId = $_POST['pid'];
try {
    require('connection.php');

    // Calculate the total number of votes in the poll and save it as 'totalvote'
$totalvote = 0;
$sql = $db->prepare("SELECT COUNT(*) AS vote_count FROM vote WHERE pid = :qid");
$sql->bindParam(':qid', $questionId);
$sql->execute();
$result = $sql->fetch(PDO::FETCH_ASSOC);
$totalvote = $result['vote_count']; // vote count

// Get the options for the poll
$sql2 = $db->prepare("SELECT * FROM polloptions WHERE pid = :qid");
$sql2->bindParam(':qid', $questionId);
$sql2->execute();
$options = $sql2->fetchAll(PDO::FETCH_ASSOC);

// Calculate the total number of options in the poll and save it as 'totaloption'
$totaloparr = array();
foreach ($options as $option) {
    $sql = $db->prepare("SELECT COUNT(*) AS option_count FROM vote WHERE oid = :opid");
    $sql->bindParam(':opid', $option['oid']);
    $sql->execute();
    $result = $sql->fetch(PDO::FETCH_ASSOC);
    $totaloption = $result['option_count']; // option count
    $totaloparr[] = $totaloption;
}

//$colors = ['blue', 'green', 'yellow', 'pink', 'orange', 'red', 'lightblue', 'brown', 'purple', 'grey'];
$colors = [
    "#00B1C1",
    "#BBADE0",
    "#FFFFB5",
    "#FFCCB6",
    "#F3B0C3",
    "#FCB9AA",
    "#FF7FA6",
    "#FEE1E8",
    "#ECD5E3",
    "#FF7FA6"
  ];
// Calculate and display the percentages
if ($totalvote > 0) {
    $i = 0;
    foreach ($options as $index => $option) {
        $percentage = ($totaloparr[$index] / $totalvote) * 100;

        echo $option['options']."<br>";
        echo "<progress value='" . $percentage . "' max='100'  id='custom-progress".$i."' class='custom-progress-".$option['oid']."' ></progress>";
        echo  " ". number_format($percentage, 0) . "%";
        echo "<br>";

        echo "<style>
        #custom-progress".$i." {
            background-color: lightgrey;
            -webkit-appearance: none;
            accent-color: ".$colors[$i].";
            height : 20px;
            border-radius: 10px;
            width:70%;
        }
        #custom-progress".$i."::-webkit-progress-bar {
            background-color: lightgrey;
            border-radius: 10px;
        }
        #custom-progress".$i."::-webkit-progress-value {
            background-color: ".$colors[$i].";
            box-shadow: inset 0px 0px 5px 0px rgba(0, 0, 0, 0.5);
            border-radius: 10px;
            transition: width 0.4s ease-in;
        }
        #custom-progress".$i."::-moz-progress-bar {
            background-color: ".$colors[$i].";
            border-radius: 10px;
            transition: width 0.4s ease-in; 
        }
        </style>";

        $stmt3 = $db->prepare("SELECT * FROM vote WHERE uid = :userid AND oid= :opid");
        $stmt3->bindParam(':userid', $userid);
        $stmt3->bindParam(':opid', $option['oid']);
        $stmt3->execute();
        if ($stmt3->rowCount() == 1) {
            echo "<style>
            .custom-progress-".$option['oid']."{
               box-shadow: 0px 0px 7px lightblue;
            }
            </style>";
        }
        $i++;
    }
} else if ($totalvote == 0) {
    foreach ($options as $index => $option) {
        $percentage = 0;
        echo $option['options']."<br>";
        echo "<progress value='" . $percentage . "' max='100' id='zero'></progress>";
        echo  " ". number_format($percentage, 0) . "%";
        echo "<br>";
    }
    echo "<style>
    #zero {
        background-color: lightgrey;
        -webkit-appearance: none;
        height : 20px;
        border-radius: 10px;
        width:70%;
    }
    #zero::-webkit-progress-bar {
        background-color: lightgrey;
        border-radius: 10px;
    }
    #zero::-webkit-progress-value {
        border-radius: 10px;
    }
    #zero::-moz-progress-bar {
        border-radius: 10px;
    }
    </style>";
}
echo "Total response= ".$totalvote;
} catch (PDOException $ex) {
    echo "Error occurred!";
    die($ex->getMessage());
}
?>
</body>
</html>