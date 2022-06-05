<?php 
include("teacher-session.php");
require 'config.php'; 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="stylesheets/stud-signup.css">
        <link rel="icon" type="image/png" href="Images/skillsoft-favicon.png">
        <?php include('header.php') ?>
        <title>Teacher Quiz Page</title>
		<!-- <style>
			.dataTables_filter{ display: none; }
		</style> -->
    </head>
    <body>
        <?php include("teacher-navi.php");?>
        <div style="margin-left: 170px;"  class="container-fluid admin">
		<div class="col-md-12 alert alert-warning">Quiz List</div>
		<button class="btn btn-warning bt-sm" id="new_quiz"><i class="fa fa-plus"></i> Add New</button>
		<br>
		<br>
		<div class="card">
			<div class="card-body">
				<table class="table table-bordered" id='table'>
					<thead>
						<tr>
							<th>Quiz ID</th>
							<th>Quiz Title</th>
							<th>Quiz Category</th>
							<th>Quiz Timer (mins)</th>
							<th>Quiz Points</th>
							<th>Quiz Description</th>
							<th>Total Questions</th>
							<th style ="width: 20%;">Action</th>
						</tr>
					</thead>
					<tbody> 
					<?php
					$tid = $_SESSION['teach_id'];
					$qry = $conn->query("SELECT quiz.teac_id, quiz.quiz_description, quiz.quiz_timer, quiz.quiz_point, quiz.quiz_id, quiz.quiz_title, quiz.quiz_category, quiz.quiz_cover, count(*) FROM quiz LEFT JOIN quiz_question ON (quiz.quiz_id = quiz_question.quiz_id) WHERE quiz.teac_id = '$tid' GROUP BY quiz.quiz_id");
					$i = 1;
					if($qry->num_rows > 0){
						while($row= $qry->fetch_assoc()){
							$items = $conn->query("SELECT count(quques_id) as item_count from quiz_question where quiz_id = '".$row['quiz_id']."'")->fetch_array()['item_count'];
						?>
					<tr>
						<td><?php echo $i ?></td>
						<td><?php echo $row['quiz_title'] ?></td>
						<td><?php echo $row['quiz_category'] ?></td>
						<td><?php echo $row['quiz_timer'] ?></td>
						<td><?php echo $row['quiz_point'] ?></td>
						<td><?php echo $row['quiz_description'] ?></td>
						<td><?php echo $items ?></td>
						
						<td>
							<center>
							<a class="btn btn-sm btn-outline-primary edit_quiz" href="./quiz-view.php?id=<?php echo $row['quiz_id']?>"><i class="fa fa-task"></i> Manage</a>
							<button class="btn btn-sm btn-outline-primary editbtn" data-id="<?php echo $row['quiz_id']?>" type="button"><i class="fa fa-edit"></i> Edit</button>
							<button class="btn btn-sm btn-outline-danger remove_quiz" data-id="<?php echo $row['quiz_id']?>" type="button"><i class="fa fa-trash"></i> Delete</button>
							</center>
						</td>
					</tr>
					
					<?php
					$i++; }
					}
					?>
					
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="modal fade" id="manage_quiz" tabindex="-1" role="dialog" >
		<div class="modal-dialog modal-centered" role="document">
			<div style="width: 100%;" class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModallabel">Add new quiz</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<form method="POST" action="insert-quiz.php" id='quiz-frm' enctype="multipart/form-data">
					<div class ="modal-body">
					<div id="msg"></div>
						<div class="form-group">
							<label>Quiz Title</label>
							<input type="hidden" value="<?php echo $tid ?>" name="tid" />
							<input type="hidden" name="id" />
							<input type="text" name="quiz_title" required class="form-control" />
						</div>
						<div class="form-group">
							<label>Quiz Category</label>
							<input type="text" name="quiz_category" required class="form-control" />
						</div>
						<div class="form-group">
							<label>Quiz Timer</label>
							<input placeholder="(in minutes)" type="number" min="1" max="60" name="quiz_timer" required class="form-control" />
						</div>
						<div class="form-group">
							<label>Quiz Points</label>
							<input type="number" name ="quiz_point" required class="form-control" />
						</div>
						<div class="form-group">
							<label>Quiz Description</label>
							<textarea rows='3' name="quiz_description" required class="form-control" ></textarea>
						</div>
						<div class="form-group">
							<label>Quiz Cover Image</label>
							<input type="file" required accept="image/*,.png,.jpeg,.jpg" name="image">
						</div>
					</div>
					<div class="modal-footer">
						<input type="hidden" value="<?php echo date("Y-m-d h:i:s"); ?>" name="quiz_create_date"> 
						<button type="submit" class="btn btn-success" name="insert-quiz"><span class="glyphicon glyphicon-save"></span> Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="modal fade" id="edit_quiz" tabindex="-1" role="dialog" >
		<div class="modal-dialog modal-centered" role="document">
			<div style="width: 100%;" class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModallabel">Edit quiz</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<form method="POST" action="update-quiz.php" id='quiz-frm' enctype="multipart/form-data">
					<div class ="modal-body">
						<div class="form-group">
							<label>Quiz Title</label>
							<input type="hidden" name="update_id" id="update_id" />
							<input type="text" name="quiz_title" id="quiz_title" required class="form-control" />
						</div>
						<div class="form-group">
							<label>Quiz Category</label>
							<input type="text" id="quiz_category" name="quiz_category" required class="form-control" />
						</div>
						<div class="form-group">
							<label>Quiz Timer</label>
							<input placeholder="(in minutes)" id="quiz_timer" type="number" min="1" max="60" name="quiz_timer" required class="form-control" />
						</div>
						<div class="form-group">
							<label>Quiz Points</label>
							<input type="number" name ="quiz_point" id="quiz_point" required class="form-control" />
						</div>
						<div class="form-group">
							<label>Quiz Description</label>
							<textarea rows='3' name="quiz_description" id="quiz_description" required class="form-control" ></textarea>
						</div>
					</div>
					<div class="modal-footer">
						<input type="hidden" value="<?php echo date("Y-m-d h:i:s"); ?>" name="quiz_create_date"> 
						<button type="submit" class="btn btn-primary" name="update-quiz"><span class="glyphicon glyphicon-save"></span>Update Quiz</button>
					</div>
				</form>
			</div>
		</div>
	</div>
        
    </body>

	<script>
	$(document).ready(function(){
		$('#table').DataTable();
		$('#new_quiz').click(function(){
			$('#msg').html('')
			$('#manage_quiz .modal-title').html('Add New quiz')
			$('#manage_quiz #quiz-frm').get(0).reset()
			$('#manage_quiz').modal('show')
		})

		$(document).on("click",".editbtn",function(){
			$('#edit_quiz').modal('show');
				$tr = $(this).closest('tr');
				var data = $tr.children("td").map(function() {
					return $(this).text();
				}).get();
				console.log(data);
				$('#update_id').val(data[0]);
				$('#quiz_title').val (data[1]);
				$('#quiz_category').val (data[2]);
				$('#quiz_timer').val(data[3]);
				$('#quiz_point').val(data[4]);
				$('#quiz_description').val(data[5]);
		});

		$(document).on("click",".remove_quiz",function(){
			var id = $(this).attr('data-id')
			var conf = confirm('Are you sure you want to delete this quiz?');
			if(conf == true){
				$.ajax({
				url:'./delete-quiz.php?id='+id,
				error:err=>console.log(err),
				success:function(resp){
					if(resp == true)
						location.reload()
						alert( "Quiz has been successfully deleted!" );
				}
			})
			}
		})
	})
</script>
</html>