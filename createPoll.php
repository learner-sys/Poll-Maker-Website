<?php 
session_start();
// Initialize variables
$question="";
$endby="";
$incompleteInfo='';
$incompleteOptions='';
$emptyDateError='';
$options=array();
if(!isset($_SESSION['activeUser']))
{
    echo "You need to login first<br />";
    echo"<a href=login.php class=mybutton> Log in </a>";
    echo"<a href=register.php class=mybutton> Sign up </a>";
}

else
{ 
        try
        {
                require('connection.php');
                $uid=$_SESSION['uid'];
                $sql = "SELECT username FROM users WHERE uid = :uid";
                        $stmt = $db->prepare($sql);
                        $stmt->bindParam(':uid', $uid);
                        $stmt->execute();
                        $username =$_SESSION['activeUser'];
                        echo "<h5 id='welcomeMessage'> Welcome, ".$username."! <h5> <br>";
                
                if(isset($_POST['submit']))
                {
                    $nonEmptyOptionsCount = 0;
                    foreach ($_POST['option'] as $op)
                    {
                        if (!empty($op))
                        {
                           $nonEmptyOptionsCount++;
                           
                        }
                    }
                    if (empty($_POST['title']) || empty($_POST['question'])) {
                        $incompleteInfo = "INCOMPLETE INFORMATIONS!";
                    }
                    if ($nonEmptyOptionsCount < 2)
                    {
                       $incompleteOptions = "Please fill in at least two options.";
                    }
                    else
                    {
                    $question=$_POST['question'];
                    $endby=$_POST['endPoll'];
                    $status="open";//by default
                    $options=array();
                   
                    if($endby=="stop")
                    {
                        $endtype="stopbtn";
                        $stmt=$db->prepare("INSERT INTO pollquestions (uid,questions,endBy,status,votes) VALUES (:uid, :question,:endtype,:status, 0)");
                        $stmt->bindParam(':uid', $uid);
                        $stmt->bindParam(':question', $question);
                        $stmt->bindParam(':endtype', $endtype);
                        $stmt->bindParam(':status', $status);
                        $stmt->execute();
                    }
                    else
                    {
                        $endtype="date";
                        $enddate=$_POST['endDate'];
                        $exp_date=$enddate;
                        $today_date=date('Y/m/d');
                        $exp=strtotime($exp_date);
                        $td=strtotime($today_date);
                        if($td>$exp)
                        $status="close";
                        $stmt = $db->prepare("INSERT INTO pollquestions (uid, questions, endBy, endDate, status, votes) VALUES (:uid, :question, :endtype, :end_date, :status, 0)");
                        $stmt->bindParam(':uid', $uid);
                        $stmt->bindParam(':question', $question);
                        $stmt->bindParam(':endtype', $endtype);
                        $stmt->bindParam(':end_date', $enddate);
                        $stmt->bindParam(':status', $status);
                        $stmt->execute();
                    }
                    //To know the poll id
                    $pollId=$db->lastInsertId();
                    //loop foreach option input
                    foreach($_POST['option'] as $k=>$value)
                    {
                        $options[]=$value;
                    }

                    $optionStmt = $db->prepare("INSERT INTO polloptions (pid, `options`) VALUES (:pid, :opions)");
                    foreach ($options as $optionID => $optionText) 
                    {
                    $optionStmt->execute(array(':pid' => $pollId, ':opions' => $optionText));
                    }
                    $r = $stmt->rowCount();
                      if($r==1){
                        header("Location: myhomepage2.php");
                      }
                        else
                          echo "Something wronge happen";
                }
            }
            $db=null;
        }   
        catch(PDOException $e)
        {
            echo "Error: " .$e->getMessage();
        } 
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Poll</title>
    <link rel="stylesheet" href="createPoll.css">
</head>
<body>
    <?php
    
    echo "<nav>";
    echo "<img src='1x/logoOnly.png' id='logoimg'>";
    if (isset($_SESSION['uid'])) {
        $userid=$_SESSION['uid'];
        echo "<form action='logout.php' method='POST'>
        <input type='submit' name='logout' id='navButtons' value='Logout'>
      </form>";
      echo "<form action='createPoll.php' method='POST'>
        <input type='submit' name='create' id='navButtons' value='create poll'>
      </form>";
      echo "<form action='myhomepage2.php' method='POST'>
      <input type='submit' name='mypolls'id='navButtons' value='my polls'>
      </form>";
      echo "<form action='myhomepage2.php' method='POST'>
      <input type='submit' name='myvotes'id='navButtons' value='my votes'>
      </form>";
    } else {
        echo "<form action='login.php' method='POST'>
        <input type='submit' name='login' id='navButtons' value='Login'>
      </form>";
    }
    echo "<form action='myhomepage2.php'>
    <input type='submit' name='home' id='navButtons' value='home'>
    </form>";
    
    echo "</nav>";
    ?>
    <div class="container">
    <h3>Create a Poll</h3>
    Complete the below fields to create your poll.

    <form method="post">
    <input type ="text" placeholder="Enter Poll question" id="que" name="question" value='<?php echo isset($_POST["question"]) ? htmlspecialchars($_POST["question"]) : ""; ?>'><br>
    <span style="color: red;"><?php echo $incompleteInfo; ?></span><br>
    

    <div id="pollBlock">
        <input type="text" id="optionsfield" name="option[]" placeholder="option 1" value='<?php ?>'>
         <input type="text"  id="optionsfield" name="option[]" placeholder="option 2" value=''>
        
    </div>
    <span style="color: red;"><?php echo $incompleteOptions; ?></span><br>
   

    <button type="button" onclick="addMoreOp()" id="addButton">Add More Options</button><br>
    <button type="button" onclick="deleteoption()" id="deleteButton">delete Option</button>


    <p>End Poll By:</p>
    <?php $required = 'required' ?>
     <input type="radio" value="date" name="endPoll" id="endByDate" onclick="displayhidden()" checked>By date
     <input type="radio" value="stop" name="endPoll" id="endByStop" onclick="displayhidden()">By stop button<br />
     <input type="date" name="endDate" style="display:block" id="date" required><br>
     <p style="display:none" id="msg">! The button will be shown at the results page when the poll is created</p>
    
    <button type="submit" id="submit" name="submit">Create Poll</button>
    </form>
    </div>
    <script>
        let c=2;
        function addMoreOp() {
            if (c > 9) {
        alert("You exceeded the maximum number of options!");
    } else {
        ++c;
        var optionInputs = document.getElementsByName('option[]');
        var lastOptionInput = optionInputs[optionInputs.length - 1];
        var clonedOptionInput = lastOptionInput.cloneNode(true);
        clonedOptionInput.value = '';
        clonedOptionInput.placeholder = 'option ' + c;
        var lineBreak = document.createElement('br');
        document.getElementById('pollBlock').appendChild(clonedOptionInput);
        document.getElementById('pollBlock').appendChild(lineBreak);
    }
}
       function deleteoption(){
           
            if(c<=2)
            {
              alert("You must have at least two options!")
            }
            else if(c>=3)
            {
                --c;
                var pollBlock = document.getElementById('pollBlock');
                var optionInputs = document.getElementsByName('option[]');
                var lastOptionInput = optionInputs[optionInputs.length - 1];
                var deleteButton = pollBlock.lastChild.previousSibling; // Assuming the delete button is always the second-to-last child

                pollBlock.removeChild(lastOptionInput);
                pollBlock.removeChild(deleteButton);
            
            }

        }

        function displayhidden()
        {
            if(document.getElementById('endByDate').checked)
            {
                document.getElementById('date').style.display='block';
                document.getElementById('msg').style.display='none';
                document.getElementById('date').required=true;
            }
            else
            {
                document.getElementById('date').style.display='none';
                document.getElementById('msg').style.display='block';
                document.getElementById('date').required=false;

            }



        }

    </script>
</body>
</html>
<?php } ?>
