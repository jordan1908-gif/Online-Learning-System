<?php
include "conn.php";


if ((isset($_POST["quques_number"]) && is_array($_POST["quques_number"])) + (isset($_POST["quques_question"]) && is_array($_POST["quques_question"])) + (isset($_POST["quques_correct_answer"]) && is_array($_POST["quques_correct_answer"])) + (isset($_POST["quques_choices_A"]) && is_array($_POST["quques_choices_A"])) + (isset($_POST["quques_choices_B"]) && is_array($_POST["quques_choices_B"])) + (isset($_POST["quques_choices_C"]) && is_array($_POST["quques_choices_C"])) + (isset($_POST["quques_choices_D"]) && is_array($_POST["quques_choices_D"])))
{ 
    
  $quques_number = $_POST["quques_number"];
  $quques_question = $_POST["quques_question"];
  $quques_correct_answer = $_POST["quques_correct_answer"];
  $quques_choices_A = $_POST["quques_choices_A"];
  $quques_choices_B = $_POST["quques_choices_B"];
  $quques_choices_C = $_POST["quques_choices_C"];
  $quques_choices_D = $_POST["quques_choices_D"];
  $quiz_id = $_POST["quiz_id"];

  foreach ($quques_question as $key => $value) {
    $sql = "INSERT INTO quiz_question(quques_number, quques_question, quques_correct_answer, quques_choices_A, quques_choices_B, quques_choices_C, quques_choices_D, quiz_id) VALUES ('".$quques_number[$key]."','".$value."','".$quques_correct_answer[$key]."','".$quques_choices_A[$key]."','".$quques_choices_B[$key]."','".$quques_choices_C[$key]."','".$quques_choices_D[$key]."','".$quiz_id."')";
    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("Question has been added successfully!")</script>';
        echo '<script> window.location.href="quiz-view.php?id='.$quiz_id.'";</script>';
        }else{
        echo '<script>alert("Failed to add your quiz questions")</script>';
        }
  }
}

?>