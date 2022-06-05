<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
</html>

<?php  
 require 'config.php';
 if(isset($_POST["id"]))  
 {  
      $output = '';  
      $query = "SELECT * FROM quiz_question WHERE quques_id = '".$_POST["id"]."'";  
      $result = mysqli_query($conn, $query);  
      $output .= '  
      <div class="edit">';  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= ' 
                <div class="form-group">
                    <input type = "hidden" value = "'.$row['quques_id'].'" id = "id">
                    <label>Question</label> <input type="number" value="'.$row["quques_number"].'" class="quiz-number" readonly min="1" max="10" id="quques_number" name="quques_number" required>
                    <textarea rows="3" name="question" id="question"  required class="form-control" >'.$row["quques_question"].'</textarea>
                </div>
                <label>Options:</label>
                <div class="form-group">
                    <textarea rows="2" name="answera" id="answera" required class="form-control">'.$row["quques_choices_A"].'</textarea>
                    <span>
                    <label><input type="radio" name="quques_correct_answer" '.($row['quques_correct_answer'] == "1" ? 'checked' : '').'  class="is_right" value="1" required> <small>Question Answer</small></label>
                    </span>
                    <br>
                    <textarea rows="2" name="answerb" id="answerb" required class="form-control" >'.$row["quques_choices_B"].'</textarea>
                    <label><input type="radio" name="quques_correct_answer" '.($row['quques_correct_answer'] == "2" ? 'checked' : '').'  class="is_right" value="2"> <small>Question Answer</small></label>
                    <br>
                    <textarea rows="2" name="answerc" id="answerc" required class="form-control" >'.$row["quques_choices_C"].'</textarea>
                    <label><input type="radio" name="quques_correct_answer" '.($row['quques_correct_answer'] == "3" ? 'checked' : '').'  class="is_right" value="3"> <small>Question Answer</small></label>
                    <br>
                    <textarea rows="2" name="answerd" id="answerd" required class="form-control" >'.$row["quques_choices_D"].'</textarea>
                    <label><input type="radio" name="quques_correct_answer" '.($row['quques_correct_answer'] == "4" ? 'checked' : '').' class="is_right" value="4"> <small>Question Answer</small></label>
                </div>
            </div>';  
      }  
      $output .= "</div>";  
      echo $output;  
 }  
 ?>