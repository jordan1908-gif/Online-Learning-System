<?php
include "admin-session.php";
include "conn.php";

//Retreive selected result from the table and display them on page
$sql = "SELECT * FROM student";
$result = mysqli_query($conn, $sql);

function executeQuery($query) {
    require("conn.php");
    $result = mysqli_query($conn, $query);
    return $result;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin-mgstudents.css">
    <link rel="icon" type="image/png" href="Images/Learneasy_favicon.png">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>   
    <?php include('header.php') ?>
    <title>Manage Student</title>
</head>
<body>
    <?php include("admin-nav.php")?>

    <div class="stut-page-container">
        <p class="stut-page-title">Students</p>
        <div class="search-box">  
            <input id="search_text" name="search" type="text" placeholder="Enter student ID or username">
            <button id="search-btn" type="submit" name="submit" value="Search"><i class="fas fa-search"></i></button>
        </div>
        <div class="stut-list">
            <table id="table-data" class="list">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email Address</th>
                        <th>Account Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row =mysqli_fetch_array($result)){?>
                        <tr>
                            <td><?php echo $row["stud_id"]; ?></td>
                            <td><?php echo $row["stud_username"]; ?></td>
                            <td><?php echo $row["stud_first_name"]; ?></td>
                            <td><?php echo $row["stud_last_name"]; ?></td>
                            <td><?php echo $row["stud_email"]; ?></td>
                            <td><?php echo $row["verified"]; ?></td>
                            <td><a class="edit_student"><button type="button" data-id="<?php echo $row['stud_id']?>" class="viewbtn">Edit</button></a>&nbsp;
                                <a><button type="button" data-id="<?php echo $row['stud_id']?>" class="deletebtn">Delete</button></a>
                            </td>
                        </tr>
                    <?php
                        }
                ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="edit_student" tabindex="-1" role="dialog" >
		<div class="modal-dialog modal-centered" role="document">
			<div style="width: 100%;" class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModallabel">Edit student</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<form method="POST" action="student-update.php" id='quiz-frm'>
					<div class ="modal-body">
						<div class="form-group">
							<label>Username</label>
							<input type="hidden" name="update_id" id="update_id" />
							<input type="text" name="stud_username" id="stud_username" readonly required class="form-control" />
						</div>
						<div class="form-group">
							<label>First Name</label>
							<input type="text" name="stud_first_name" id="stud_first_name" required class="form-control" />
						</div>
                        <div class="form-group">
							<label>Last Name</label>
							<input type="text" name="stud_last_name" id="stud_last_name" required class="form-control" />
						</div>
                        <div class="form-group">
							<label>Email</label>
							<input type="text" name="stud_email" id="stud_email" required class="form-control" />
						</div>
                        <div class="form-group">
							<label>Verification Status</label>
							<input type="number" min="0" max="1" name="verified" id="verified" required class="form-control" />
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary" name="update-student"><span class="glyphicon glyphicon-save"></span>Update Student</button>
					</div>
				</form>
			</div>
		</div>
	</div>

    <div class="admin-footer">
        <div class="foo-des">
            <p>Design and Develop by Win Yip & Jordan - FWDD Assignment</p>
        </div>
    </div>

    <script type="text/javascript">
     $(document).ready(function(){
        $('#table').DataTable();

        $("#search_text").keyup(function(){
            var search = $(this).val();
            $.ajax({
                url:'student-search.php',
                method: 'post',
                data:{query:search},
                success:function(response){
                        $("#table-data").html(response);
                }
            });
        });

        $(document).on("click",".viewbtn",function(){
			$('#edit_student').modal('show');
				$tr = $(this).closest('tr');
				var data = $tr.children("td").map(function() {
					return $(this).text();
				}).get();
				console.log(data);
				$('#update_id').val(data[0]);
				$('#stud_username').val (data[1]);
				$('#stud_first_name').val(data[2]);
				$('#stud_last_name').val(data[3]);
				$('#stud_email').val(data[4]);
                $('#verified').val(data[5]);
		});

        $(document).on("click",".deletebtn",function(){
			var id = $(this).attr('data-id')
			var conf = confirm('Are you sure you want to delete this student from the system?');
			if(conf == true){
				$.ajax({
				url:'./student-delete.php?id='+id,
				error:err=>console.log(err),
				success:function(resp){
					if(resp == true)
						location.reload()
						alert( "Student has been successfully deleted!" );
				}
			})
			}
		})
     });
    </script>

</body>
</html>
