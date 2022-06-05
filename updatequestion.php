<?php 
require 'config.php';

$id         = $_POST["id"];
$number     = $_POST['quques_number'];
$question   = $_POST['question'];
$correct    = $_POST['quques_correct_answer'];
$answer1    = $_POST['answera'];
$answer2    = $_POST['answerb'];
$answer3    = $_POST['answerc'];
$answer4    = $_POST['answerd'];


$sql = "UPDATE quiz_question SET quques_number = '$number', quques_question = '$question', quques_correct_answer = '$correct', quques_choices_A = '$answer1', quques_choices_B = '$answer2', quques_choices_C = '$answer3', quques_choices_D = '$answer4' WHERE quques_id = '$id'";
$execute = mysqli_query($conn, $sql);
if($execute) 
{
echo true;
}
else {
echo "Undefined error!";
}
?>