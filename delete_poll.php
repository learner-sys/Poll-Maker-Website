<?php
session_start();
try{


    $questionId = $_GET['pid'];
    require('connection.php');
    //delete from vote table
    $db->beginTransaction();
    $stmt9 = $db->prepare("DELETE FROM vote WHERE pid = :qid");
    $stmt9->bindParam(':qid', $questionId);
    $stmt9->execute();

    //delete from polloptions table
    $stmt8 = $db->prepare("DELETE FROM polloptions WHERE pid = :qid");
    $stmt8->bindParam(':qid', $questionId);
    $stmt8->execute();
    //delete from pollquestions table
    $stmt7 = $db->prepare("DELETE FROM pollquestions WHERE pid = :qid");
    $stmt7->bindParam(':qid', $questionId);
    $stmt7->execute();
    $db->commit();

    header("Location: myhomepage2.php");
    exit();}
    catch (PDOException $ex) {
        echo "Error occurred!";
        die($ex->getMessage());
    }
    ?>