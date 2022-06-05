<?php 
include("teacher-session.php");
require 'config.php'; 
$id = $_SESSION['teach_id'];

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
        <div style="margin-left: 170px;"  class="container-fluid admin">
		<div class="col-md-12 alert alert-warning">Statistics List</div>
		<br>
		<br>
		<div class="card">
			<div class="card-body">
				<table class="table table-bordered" id='table'>
					<thead>
						<tr>
							<th>#</th>
							<th>Student Name</th>
							<th>Quiz Title</th>
							<th>Correct</th>
							<th>Wrong</th>
							<th>Score</th>
							<th>Attempt Date</th>
						</tr>
					</thead>
					<tbody> 
					<?php
					$num_rows = 0;
					$correct = 0;
					$wrong = 0;
					$sql = "SELECT *, COUNT(IF(h.his_is_right = '1', 1, NULL)) AS totalcorrect, COUNT(h.quques_id) AS totalquestion FROM history h INNER JOIN student s, quiz_question qq, quiz q 
					WHERE (h.stud_id = s.stud_id) AND (h.quques_id = qq.quques_id) AND (qq.quiz_id = q.quiz_id) AND (q.teac_id = '$id') GROUP BY his_date_time;";
					$result = mysqli_query($conn, $sql);
					while ($row = mysqli_fetch_array($result)){
					$totalcorrect = $row['totalcorrect'];
					$quespoint = $row['quiz_point'];
					$totalques = $row['totalquestion'];
					$score_each_ques = ($quespoint/$totalques);
					$score = ($totalcorrect * $score_each_ques);
					$totalwrong = $totalques - $totalcorrect;					
					$num_rows++;
					?>
					<tr>
						<td><?php echo $num_rows ;?></td>
						<td><?php echo $row['stud_username'];?></td>
                        <td><?php echo $row['quiz_title'];?></td>
						<td><?php echo $totalcorrect;?>/<?php echo $totalques;?></td>
						<td><?php echo $totalwrong;?>/<?php echo $totalques;?></td>
						<td><?php echo $score;?>/<?php echo $quespoint;?></td>
						<td><?php echo $row['his_date_time'];?></td></td>
					</tr>
					<?php 
					}
					?>
					</tbody>
				</table>
			</div>
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
	})
</script>
</html>