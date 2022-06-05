<?php
include "admin-session.php";
include "conn.php";

//Retreive selected result from the table and display them on page
$sql = "SELECT * FROM chatbot";
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
    <title>Manage Chatbot</title>
</head>
<body>
    <?php include("admin-nav.php")?>

    <div class="stut-page-container">
        <p class="stut-page-title">Chatbot Q&As</p>
        <div class="search-box">  
            <input id="search_text" name="search" type="text" placeholder="Enter query ID or query substring">
            <button id="search-btn" type="submit" name="submit" value="Search"><i class="fas fa-search"></i></button>
        </div>

        <div class="addbtn">
            <button onclick="document.getElementById('addchatbot-form').style.display='block'">Add Q&As</button>
        </div>

        <div class="stut-list">
            <table id="table-data" class="list">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Query</th>
                        <th>Reply</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row =mysqli_fetch_array($result)){?>
                        <tr>
                            <td><?php echo $row["id"]; ?></td>
                            <td><?php echo $row["queries"]; ?></td>
                            <td><?php echo $row["replies"]; ?></td>
                            <td><a class="edit_chatbot"><button type="button" data-id="<?php echo $row['id']?>" class="viewbtn">Edit</button></a>&nbsp;
                                <a><button type="button" data-id="<?php echo $row['id']?>" class="deletebtn">Delete</button></a>
                            </td>
                        </tr>
                    <?php
                        }
                ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="edit_chatbot" tabindex="-1" role="dialog" >
		<div class="modal-dialog modal-centered" role="document">
			<div style="width: 100%; height: 50%;" class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModallabel">Edit chatbot</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<form method="POST" action="chatbot-update.php" id='quiz-frm'>
					<div class ="modal-body">
						<div class="form-group">
							<label>Query</label>
							<input type="hidden" name="update_id" id="update_id" />
							<textarea rows="5" name="query" id="query" required class="form-control"></textarea>
						</div>
						<div class="form-group">
							<label>Reply</label>
							<textarea rows="5" name="reply" id="reply" required class="form-control"></textarea>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary" name="update-student"><span class="glyphicon glyphicon-save"></span>Update Chatbot</button>
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

    <div id="addchatbot-form" class="modal">
        <form class="modal-content animate" action="addchatbot.php" method="POST">
            <div class="container">
                <div class="form-details">
                    <h2>Add Q&As</h2>
                        <label class="username-info">
                            Query :
                            <textarea rows="6" name="query" value="" required ></textarea>
                        </label>
                        <label class="email-info">
                            Reply :
                            <textarea rows="6" name="reply" value="" required ></textarea>
                        </label>
                    <input type="submit" class="submit-btn" value="Add Q&As" name="submit-btn">
                </div>
            </div>
        </form>
    </div>

    <script>
    // Get the modal
    var modal = document.getElementById('addchatbot-form');

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
                url:'chatbot-search.php',
                method: 'post',
                data:{query:search},
                success:function(response){
                        $("#table-data").html(response);
                }
            });
        });

        $(document).on("click",".viewbtn",function(){
			$('#edit_chatbot').modal('show');
				$tr = $(this).closest('tr');
				var data = $tr.children("td").map(function() {
					return $(this).text();
				}).get();
				console.log(data);
				$('#update_id').val(data[0]);
				$('#query').val (data[1]);
				$('#reply').val(data[2]);
		});

        $(document).on("click",".deletebtn",function(){
			var id = $(this).attr('data-id')
			var conf = confirm('Are you sure you want to delete this query from the system?');
			if(conf == true){
				$.ajax({
				url:'./chatbot-delete.php?id='+id,
				error:err=>console.log(err),
				success:function(resp){
					if(resp == true)
						location.reload()
						alert( "Query has been successfully deleted!" );
				}
			})
			}
		})
     });
    </script>

</body>
</html>
