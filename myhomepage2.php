<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>my homepage</title>
    <link rel="stylesheet" href="homepage.css">
    <link rel="icon" href="logo1.png">

    <script>
        function viewresults(pollid, c) {
            const results = document.getElementById('pollResult'+ c);
            const xhttpemail = new XMLHttpRequest();
            xhttpemail.onload = function() {
            results.innerHTML = this.responseText;
            }
            xhttpemail.open("POST", "result.php");
            xhttpemail.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttpemail.send("pid=" + encodeURIComponent(pollid));
        }

        function filterQuestions() {
            const input = document.getElementById('searchInput').value.toLowerCase();
            const questions = document.getElementsByClassName('question');

            for (let i = 0; i < questions.length; i++) {
                const questionText = questions[i].innerText.toLowerCase();
                if (questionText.includes(input)) {
                    questions[i].style.display = 'block';
                } else {
                    questions[i].style.display = 'none';
                }
            }
        }
    </script>
</head>
<body>
    <?php
    session_start();
    $selectedOption = isset($_POST['sortSelect']) ? $_POST['sortSelect'] : 'date';
    
    
    
    echo "<nav>";
    echo "<img src='1x/logoOnly.png' id='logoimg'>";
    
    echo "<form action='myhomepage2.php'>
    <input type='submit' name='home' id='navButtons' value='home'>
    </form>";
    if (isset($_SESSION['uid'])) {
        $userid=$_SESSION['uid'];
      echo "<form action='createPoll.php' method='POST'>
        <input type='submit' name='create' id='navButtons' value='create poll'>
      </form>";
      echo "<form action='myhomepage2.php' method='POST'>
      <input type='submit' name='mypolls'id='navButtons' value='my polls'>
      </form>";
      echo "<form action='myhomepage2.php' method='POST'>
      <input type='submit' name='myvotes'id='navButtons' value='my votes'>
      </form>";
      echo "<form action='logout.php' method='POST'>
      <input type='submit' name='logout' id='navButtons' value='Logout'>
    </form>";
    } else {
        echo "<form action='login.php' method='POST'>
        <input type='submit' name='login' id='navButtons' value='Login'>
      </form>";
    }

    echo "</nav>";

    
    
    require 'connection.php';   
     
    echo "<div class='welcom'>";
   echo "<img onMouseOver='changeSize()' onMouseOut='restoreSize()' src='1x/logoOnly2.png' id='homePageLogo'>";
    echo "<p>Create your own POLL and more!</p>";
   echo "</div>";

   echo "<div id='searchcontainer'><input type='text' id='searchInput' placeholder='Search' onkeyup='filterQuestions()'></div>";

   echo "<form method='POST'>
    <select id='sortSelect' name='sortSelect' onchange='this.form.submit()'>
      <option value='date'" . ($selectedOption === 'date' ? 'selected' : '') . ">Date</option>
      <option value='popularity' " . ($selectedOption === 'popularity' ? 'selected' : '') . ">Popularity</option>
    </select>
    </form>";

    if (isset($_POST['sortSelect'])) {
        $selectedValue = $_POST['sortSelect'];

        // Perform actions based on the selected value
        if ($selectedValue === 'date') {
            $stmt1 = $db->query("SELECT * FROM pollquestions ORDER BY pid DESC");
        }
        // Perform additional actions for sorting by date
       else if ($selectedValue === 'popularity') {
            $stmt1 = $db->query("SELECT * FROM pollquestions ORDER BY votes DESC");
        }
    } else {
        $stmt1 = $db->query("SELECT * FROM pollquestions ORDER BY pid DESC");
    } 

   
    $c = 0;
    echo "<div class= 'polls'>";
    while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)) {
        $pollid = $row['pid'];
        if (isset($_POST['mypolls'])){
            $stmt4 = $db->prepare("SELECT * FROM pollquestions WHERE uid = :userid AND pid = :pid");
            $stmt4->bindParam(':userid', $userid);
            $stmt4->bindParam(':pid', $pollid);
            $stmt4->execute();
    
            // Check if it's not the creator
            if ($stmt4->rowCount() == 0) {
                continue;
            }
        }
        if (isset($_POST['myvotes'])){
            $stmt3 = $db->prepare("SELECT * FROM vote WHERE uid = :userid AND pid=:pid");
            $stmt3->bindParam(':userid', $userid);
            $stmt3->bindParam(':pid', $pollid);
            $stmt3->execute();

            if ($stmt3->rowCount() == 0) {
                continue;
            }
        }


        echo "<div name=poll id='poll' class='question'>";

        $creatorResult = $db->query("SELECT username FROM users WHERE uid = " . $row['uid']);
        $creatorRow = $creatorResult->fetch(PDO::FETCH_ASSOC);
        $creatorName = $creatorRow['username'];
        echo "Creator: " . $creatorName."<br>"; 

        $question = $row['questions'];
        echo "<p id='q'>".$question."</p><br><br>";
            if (!empty($userid)){
                //cheak if the user has voted before
                $stmt3 = $db->prepare("SELECT * FROM vote WHERE uid = :userid AND pid=:pid");
                $stmt3->bindParam(':userid', $userid);
                $stmt3->bindParam(':pid', $pollid);
                $stmt3->execute();
    
                if ($stmt3->rowCount() > 0) {
                    $c++;
                    echo "<div id='pollResult".$c."'></div>";
                    echo "<script>viewresults('$pollid', '$c');</script>";
                }
                else{
                    //print the question
                    // check the question status
                    $stmt='null';
                    $stmt = $db->prepare("SELECT * FROM pollquestions WHERE pid = :pid AND status = :stat");
                    $stmt->bindParam(':pid', $pollid);
                    $stmt->bindValue(':stat', 'open');
                    $stmt->execute();
    
                    // If the poll is active
                    if ($stmt->rowCount() == 1) {
                        // Fetch and display the options
                        $disabl="required";
                        $stmt4 = $db->prepare("SELECT * FROM pollquestions WHERE uid = :userid AND pid = :pid");
                        $stmt4->bindParam(':userid', $userid);
                        $stmt4->bindParam(':pid', $pollid);
                        $stmt4->execute();
                        if ($stmt4->rowCount() >= 1) {
                            $disabl="hidden";
                        }
    
                        $stmt2 = $db->prepare("SELECT * FROM polloptions WHERE pid = :pollid");
                        $stmt2->bindParam(':pollid', $pollid);
                        $stmt2->execute();
                        $optionId=0;
                        if ($stmt2->rowCount() > 0) {
                            echo " <form method='POST' action='insert.php'>";
                            while ($option = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                                $optionId = $option['oid'];
                                echo "<input id='radio' type='radio' name='option' value='".$optionId."'".$disabl.">";
                             
                                if ($stmt4->rowCount() == 0) {
                                    echo  "<p id='optionsp'>".$option['options'] . "</p><br>";
                                } 
                            }
                            echo "<input type='hidden' name='pid' value='".$pollid."'>";
                        } 
                        //display button
                        $stmt4 = $db->prepare("SELECT * FROM pollquestions WHERE uid = :userid AND pid = :pid");
                        $stmt4->bindParam(':userid', $userid);
                        $stmt4->bindParam(':pid', $pollid);
                        $stmt4->execute();
    
                        // Check if it's the creator
                        if ($stmt4->rowCount() >= 1) {
                        $stmt5 = $db->prepare("SELECT * FROM pollquestions WHERE uid = :userid AND pid = :pid AND endBy = :endd");
                        $stmt5->bindParam(':userid', $userid);
                        $stmt5->bindParam(':pid', $pollid);
                        $date = 'date';
                        $stmt5->bindParam(':endd', $date);
                        $stmt5->execute();

                        $c++;
                        echo "<div id='pollResult".$c."'></div>";
                        echo "<script>viewresults('$pollid', '$c');</script>";
                    
                        if ($stmt5->rowCount() == 0) {
                            echo "<button type='submit' name='Stop' id='navButtons'>Stop Poll</button>";
                            echo "<button type='submit' name='Delete' id='navButtons'>Delete Poll</button>";
                            echo "</form>";
                            
                            } 
                        else {
                            echo "<button type='submit' name='Delete' id='navButtons'>Delete Poll</button>";
                            echo "</form>";
                            }
                        } else if ($stmt->rowCount() == 1){
                            echo "<button type='submit' name='view1'id='navButtons'>Vote</button>";
                            echo "</form>";                    
                            
                        }  
                    }
                    // If the poll is not active
                    else {
                        $c++;
                        echo "<h3>The poll has ended</h3>";
                        echo "<div id='pollResult".$c."'></div>";
                        echo "<script>viewresults('$pollid', '$c');</script>";

                        $stmt4 = $db->prepare("SELECT * FROM pollquestions WHERE uid = :userid AND pid = :pid");
                        $stmt4->bindParam(':userid', $userid);
                        $stmt4->bindParam(':pid', $pollid);
                        $stmt4->execute();
    
                        if ($stmt4->rowCount() >= 1) {
                            echo " <form method='POST' action='insert.php'>";
                            echo "<input type='hidden' name='pid' value='".$pollid."'>";
                            echo "<button type='submit' name='Delete' id='navButtons'>Delete Poll</button>";
                            echo "</form>";
                        }
                    }              
 
                }
            }
            else{
                //if the user not logined 
                //print the question
                // check the question status
                $stmt='null';
                $stmt = $db->prepare("SELECT * FROM pollquestions WHERE pid = :pid AND status = :stat");
                $stmt->bindParam(':pid', $pollid);
                $stmt->bindValue(':stat', 'open');
                $stmt->execute();
    
                // If the poll is active
                if ($stmt->rowCount() == 1) {
                        // Display the question
                        $question = $stmt->fetch(PDO::FETCH_ASSOC);
                        echo $question['questions'];
                        echo "</br>";
                        // Fetch and display the options
                        $stmt2 = $db->prepare("SELECT * FROM polloptions WHERE pid = :pollid");
                        $stmt2->bindParam(':pollid', $pollid);
                        $stmt2->execute();
                        if ($stmt2->rowCount() > 0) {
                            while ($option = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                                echo "<input type='radio' name='option'>";
                                echo  $option['options'] . "<br>"; 
                            }
                        }  
                }
                    // If the poll is not active
                else {
                    $c++;
                   echo "<h2>The poll has ended</h2>";
                   echo "<div id='pollResult".$c."'></div>";
                   echo "<script>viewresults('$pollid', '$c');</script>";
                }              
    
                //display button
                echo " <form method='POST' action='viewresult.php'>
                <button type='submit' name='view' disabled >Vote</button></br>
                </form>";
                echo "You must Login to vote <a href='login.php'>Click here to Login</a>";}
        echo "</div>";


    }

    ?>
    </div>


    <script>
        function changeSize(){
            document.getElementById("homePageLogo").style.width="299.4974px";
            document.getElementById("homePageLogo").style.height="165.6823px";
        }
        function restoreSize() {
    document.getElementById("homePageLogo").style.width = "289.4974px";
    document.getElementById("homePageLogo").style.height = "155.6823px";
}
        </script>
</body>
</html>