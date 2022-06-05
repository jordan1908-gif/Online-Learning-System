<?php
include "admin-session.php";
include "conn.php";

//Retreive selected result from the table and display them on page
$sql = "SELECT * FROM teacher WHERE teac_status = 'Verified'";
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
    <link rel="stylesheet" href="admin-mgteachers.css">
    <link rel="icon" type="image/png" href="Images/Learneasy_favicon.png">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
    <?php include('header.php') ?>  
    <title>Manage Teacher</title>
</head>
<body>
    <?php include("admin-nav.php")?>
    
    <div class="teac-page-container">
        <p class="teac-page-title">Teacher</p>
        <button class="check-btn" onclick="document.getElementById('approval-list').style.display='block'">Approval</button>
        <div class="search-box">
            <form method="POST" action="admin-mgteacher.php" autocomplete="off">
                <input id="search_text" name="search" type="text" placeholder="Enter teacher ID or username.">
                <button id="search-btn" type="submit" name="submit" value="Search"><i class="fas fa-search"></i></button>
            </form>
        </div>

        <div class="teac-list">
            <table id="table-data" class="list">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email Address</th>
                        <th>Join Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                        <?php while ($row =mysqli_fetch_array($result)){?>
                        <tr>
                            <td><?php echo $row["teac_id"]; ?></td>
                            <td><?php echo $row["teac_username"]; ?></td>
                            <td><?php echo $row["teac_first_name"]; ?></td>
                            <td><?php echo $row["teac_last_name"]; ?></td>
                            <td><?php echo $row["teac_email"]; ?></td>
                            <td><?php echo $row["teac_join_date"]; ?></td>
                            <td><?php echo $row["teac_status"]; ?></td>
                            <td><a class="edit_teacher"><button type="button" data-id="<?php echo $row['teac_id']?>" class="viewbtn">Edit</button></a>&nbsp;
                                <a><button type="button" data-id="<?php echo $row['teac_id']?>" class="deletebtn">Delete</button></a></td>
                        </tr>
                    <?php
                        }
                    
                ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <div id="approval-list" class="modal">
        <div class="modal-content animate">
            <div class="container">
                <p>Teacher Approval List</p>
                
                <div class="pending-list">
                    <table class="list">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Education Proof</th>
                            <th>Update Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        include("conn.php");

                        $sql= "SELECT * FROM teacher WHERE teac_status = 'Not Verified'";

                            $result = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($result) >0){

                            while ($row = mysqli_fetch_array($result)){
                            ?>
                            <tr>
                                <td><?php echo $row["teac_id"]; ?></td>
                                <td><?php echo $row["teac_username"]; ?></td>
                                <td><?php echo $row["teac_first_name"]; ?> <?php echo $row["teac_last_name"]; ?></td>
                                <td><?php echo $row["teac_email"]; ?></td>
                                <td><a href="../Images/<?php echo $row['teac_edu_proof']?>" download=""><?php echo $row['teac_edu_proof'];?></a></td>
                               
                                <td>
                                    <a class="edit-teacher" onclick="return confirm('Are you sure you want to approve the teacher?')" href='admin-update-status.php?teac_id=<?php echo $row['teac_id'];?>'><button style="background-color: green;" type="button" class="approvebtn">Approve</button></a>&nbsp;
                                    <a><button type="button" data-id="<?php echo $row['teac_id']?>" class="rejectbtn">Reject</button></a></td>
                                </td>
                            </tr>
                        <?php
                            }
                        }
                    ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit_teacher" tabindex="-1" role="dialog" >
		<div class="modal-dialog modal-centered" role="document">
			<div style="width: 100%;" class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModallabel">Edit teacher</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<form method="POST" action="teacher-update.php" id='quiz-frm'>
					<div class ="modal-body">
						<div class="form-group">
							<label>Username</label>
							<input type="hidden" name="update_id" id="update_id" />
							<input type="text" name="teac_username" id="teac_username" readonly required class="form-control" />
						</div>
						<div class="form-group">
							<label>First Name</label>
							<input type="text" name="teac_first_name" id="teac_first_name" required class="form-control" />
						</div>
                        <div class="form-group">
							<label>Last Name</label>
							<input type="text" name="teac_last_name" id="teac_last_name" required class="form-control" />
						</div>
                        <div class="form-group">
							<label>Email</label>
							<input type="text" name="teac_email" id="teac_email" required class="form-control" />
						</div>
                        <div class="form-group">
							<label>Verification Status</label>
							<select name="verified" id="verified" class="form-control" required>
                                <option value="Verified">Verified</option>
                                <option value="Not Verified">Not Verified</option>
                            </select>
						</div>
                        <div class="form-group">
							<label>Join Date</label>
							<input type="text" name="teac_join_date" id="teac_join_date" readonly required class="form-control" />
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary" name="update-teacher"><span class="glyphicon glyphicon-save"></span>Update Teacher</button>
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

    <script>
    // Get the modal
    var modal = document.getElementById('approval-list');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    </script>

    <script type="text/javascript">
    $(document).ready(function(){
        $('#table').DataTable();

        $("#search_text").keyup(function(){
            var search = $(this).val();
            $.ajax({
                url:'teacher-search.php',
                method: 'post',
                data:{query:search},
                success:function(response){
                        $("#table-data").html(response);
                }
            });
        });

        $(document).on("click",".viewbtn",function(){
			$('#edit_teacher').modal('show');
				$tr = $(this).closest('tr');
				var data = $tr.children("td").map(function() {
					return $(this).text();
				}).get();
				console.log(data);
				$('#update_id').val(data[0]);
				$('#teac_username').val (data[1]);
				$('#teac_first_name').val(data[2]);
				$('#teac_last_name').val(data[3]);
				$('#teac_email').val(data[4]);
                $('#teac_join_date').val(data[5]);
                $('#teac_status').val(data[6]);
		});

        $(document).on("click",".deletebtn",function(){
			var id = $(this).attr('data-id')
			var conf = confirm('Are you sure you want to delete this teacher from the system?');
			if(conf == true){
				$.ajax({
				url:'./teacher-delete.php?id='+id,
				error:err=>console.log(err),
				success:function(resp){
					if(resp == true)
						location.reload()
						alert( "Teacher has been successfully deleted!" );
				}
			})
			}
		})

        $(document).on("click",".rejectbtn",function(){
			var id = $(this).attr('data-id')
			var conf = confirm('Are you sure you want to reject this teachers account approval?');
			if(conf == true){
				$.ajax({
				url:'./teacher-delete.php?id='+id,
				error:err=>console.log(err),
				success:function(resp){
					if(resp == true)
						location.reload()
						alert( "Teacher account approval has been successfully rejected!" );
				}
			})
			}
		})
    });
    </script>
</body>
</html>