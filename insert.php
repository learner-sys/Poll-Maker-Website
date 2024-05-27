<?php
session_start();
try{
    if (isset($_SESSION['uid'])) 
    $userid=$_SESSION['uid'];
    $questionId = $_POST['pid'];
    require('connection.php');

    //if the user clicked on vote button
    if(isset($_POST['view1'])){
        try {
            $opid = $_POST['option'];
            $db->beginTransaction();
            $stmt5 = $db->prepare("INSERT INTO vote (uid, pid, oid) VALUES (:userid, :questionid, :opid)");
            $stmt5->bindParam(':userid', $userid);
            $stmt5->bindParam(':questionid', $questionId);
            $stmt5->bindParam(':opid', $opid);
            $stmt5->execute();
        
            $stmt9 = $db->prepare("UPDATE pollquestions SET votes=votes+1 WHERE pid = :qid");
            $stmt9->bindParam(':qid', $questionId);
            $stmt9->execute();

            $db->commit();
        } catch (PDOException $e) {
            // Rollback the transaction if an error occurs
            $db->rollBack();
        
            alert('Transaction failed: ' . $e->getMessage());
        }
        header("Location: myhomepage2.php");
    exit();
    }

    //if the creator clicked on stop button
    else if(isset($_POST['Stop'])){
        $stmt6 = $db->prepare("UPDATE pollquestions SET status = :stat WHERE pid = :qid");
        $stmt6->bindParam(':qid', $questionId);
        $stmt6->bindValue(':stat', 'close');
        $stmt6->execute();


        header("Location: myhomepage2.php");
        exit();
    }

    //if the creator clicked on delete button
    else if(isset($_POST['Delete'])){
        

        //header("Location: homepage.php");
        echo "<script>
            if (confirm('Are you sure you want to delete the poll?')) {
                window.location.href = 'delete_poll.php?pid=$questionId';
            }
            else {
                window.location.href = 'myhomepage2.php';
            }
          </script>";

        exit();
    }
}
catch (PDOException $ex) {
    echo "Error occurred!";
    die($ex->getMessage());
}


// ...


?>