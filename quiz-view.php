<?php 
include("teacher-session.php");
require 'config.php'; 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="stylesheets/student-signups.css">
        <link rel="icon" type="image/png" href="Images/skillsoft-favicon.png">
        <?php include('header.php') ?>
        <title>Teacher Quiz Page</title>
    </head>
    <body>
        <?php include("teacher-navi.php");?>
        <div style="margin-left: 170px;" class="container-fluid admin">
        <?php 
			$id = mysqli_real_escape_string($conn,$_GET['id']);
	        $qry = "SELECT * FROM quiz where quiz_id = $id";
			$result = mysqli_query($conn, $qry);
			$row = mysqli_fetch_array($result);
			$qid = $row['quiz_id'];
        ?>
		<div class="col-md-12 alert alert-warning"><?php echo $row['quiz_title'] ?></div>
		<button class="btn btn-warning bt-sm" id="new_question"><i class="fa fa-plus"></i> Add Question</button>
		<br>
		<br>
		<div id="table-data" class="card col-md-12 mr-4" style="float:left">
			<div class="card-header">
				Questions
			</div>
			<div class="card-body">
				<ul class="list-group">
				<?php
					$qry = $conn->query("SELECT * FROM quiz_question where quiz_id = ".$_GET['id']." ORDER BY quques_number ASC");
                    while($row=$qry->fetch_array()){
						$id = $row['quques_id'];
						?>
						<li class="list-group-item"><?php echo $row['quques_number'] ?>. <?php echo $row['quques_question'] ?><br>
							<center>
								<button class="btn btn-sm btn-outline-primary edit_question" id="<?php echo $row['quques_id']?>" type="button"><i class="fa fa-edit"></i></button>
								<button class="btn btn-sm btn-outline-danger remove_question" data-id="<?php echo $row['quques_id']?>" type="button"><i class="fa fa-trash"></i></button>							
							</center>
						</li>
				<?php
					}
				?>
				</ul>
			</div>
		</div>

		<?php 
			$query = $conn->query("SELECT MAX(quques_number) FROM `quiz_question` WHERE quiz_id = ".$_GET['id']."");
			while($row=$query->fetch_array()){
			$cur_auto_id = $row['MAX(quques_number)'] + 1;
        ?>
	
		<div class="modal fade" id="manage_question" tabindex="-1" role="dialog" >
			<div class="modal-dialog modal-centered" role="document">
				<div style="width: 100%;" class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myModallabel">Add New Question</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<form action="uploadquestion.php" method="POST" id='question-frm'>
						<div class ="modal-body" id="edit-question">
							<div id="msg"></div>
							<div class="form-group">
								<label>Question</label> <input type="number" value="<?php echo $cur_auto_id ?>" class="quiz-number" min="1" max="10" name="quques_number[]" readonly required>
								<input type="hidden" name="qid" value="<?php echo $_GET['id'] ?>" />
								<?php
									}
								?>
								<textarea rows='3' name="quques_question[]" required class="form-control" ></textarea>
							</div>
							<label>Options:</label>
							<div class="form-group">
								<textarea rows="2" name="quques_choices_A[]" required class="form-control" ></textarea>
								<span>
								<label><input type="radio" name="quques_correct_answer[]" class="is_right" value="1" required> <small>Question Answer</small></label>
								</span>
								<br>
								<textarea rows="2" name="quques_choices_B[]" required class="form-control" ></textarea>
								<label><input type="radio" name="quques_correct_answer[]" class="is_right" value="2"> <small>Question Answer</small></label>
								<br>
								<textarea rows="2" name="quques_choices_C[]" required class="form-control" ></textarea>
								<label><input type="radio" name="quques_correct_answer[]" class="is_right" value="3"> <small>Question Answer</small></label>
								<br>
								<textarea rows="2" name="quques_choices_D[]" required class="form-control" ></textarea>
								<label><input type="radio" name="quques_correct_answer[]" class="is_right" value="4"> <small>Question Answer</small></label>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Save</button>
							<input type="hidden" value="<?php echo $qid; ?>" name="quiz_id">
						</div>
					</form>
				</div>
			</div>
		</div>

		<div id="dataModal" class="modal fade">  
            <div class="modal-dialog">  
              <div style="width: 100%" class="modal-content">  
                <div class="modal-header">  
                    <?php echo '<h4 align="center" class="modal-title">Edit Question</h4>';?>
                </div>  
                <div class="modal-body" id="edit_ques"></div>  
              <div class="modal-footer">   
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
                <div id="target">
                  <a href="" id = "update_question" class="btn btn-success">Confirm Changes</a>
                </div>
              </div>  
            </div>  
        </div>

		
			
    <script>
	$(document).ready(function(){
		$('#table').DataTable();
		$('#new_question').click(function(){
			$('#msg').html('')
			$('#manage_question .modal-title').html('Add New Question')
			$('#manage_question #question-frm').get(0).reset()
			$('#manage_question').modal('show')
		})
	
		$('.is_right').each(function(){
			$(this).click(function(){
				$('.is_right').prop('checked',false);
				$(this).prop('checked',true);
			})
		})

		$('.edit_question').click(function(){
			var id = $(this).attr('id')
			$.ajax({
				url:"edit-ques.php",  
                method:"post",  
                data:{id:id},
				success:function(data){
					$('#edit_ques').html(data);  
                    $('#dataModal').modal("show"); 
				}
			})
		})

		$('#update_question').click(function(event){
        var number 		= $("#quques_number").val();
        var question 	= $("textarea#question").val();
		var correct 	= $(".is_right:checked").val();
		var answer1 	= $("textarea#answera").val();
		var answer2 	= $("textarea#answerb").val();
		var answer3 	= $("textarea#answerc").val();
		var answer4 	= $("textarea#answerd").val();
        var id 			= $("#id").val();
			$.ajax({
			url:'updatequestion.php',
			method:'post',
			data: {
					'quques_number' 		: number,
					'question' 				: question,
					'quques_correct_answer' : correct,
					'answera' 				: answer1,
					'answerb' 				: answer2,
					'answerc' 				: answer3,
					'answerd' 				: answer4,
					'id' : id
				},
			success:function(response){
				if(response == true)
					location.reload()
					alert( "Question has been successfully edited!" );
				}
			});
      	});

		$('.remove_question').click(function(){
			var id = $(this).attr('data-id')
			var conf = confirm('Are you sure you want to delete this question?');
			if(conf == true){
				$.ajax({
				url:'./delete-question.php?id='+id,
				error:err=>console.log(err),
				success:function(resp){
					if(resp == true)
						location.reload()
						alert( "Question has been successfully deleted!" );
					}
				})
			}
		})
	})
</script>
    </body>
</html>