<?php
    include 'conn.php';
    $output='';

    if(isset($_POST['query'])){
        $search=$_POST['query'];
        $stmt=$conn->prepare("SELECT * FROM student WHERE stud_id LIKE CONCAT('%',?,'%') OR stud_username LIKE  CONCAT('%',?,'%')");
        $stmt->bind_param("ss",$search,$search);
    }
    else{
        $stmt=$conn->prepare("SELECT * FROM student");
    }
    $stmt->execute();
    $result=$stmt->get_result();

    if($result->num_rows>0){
        $output = 
        "<thead> 
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
        <tbody>";
        while($row=$result->fetch_assoc()){
            $output .="
            <tr>
                <td>".$row['stud_id']."</td>
                <td>".$row['stud_username']."</td>  
                <td>".$row['stud_first_name']."</td> 
                <td>".$row['stud_last_name']."</td> 
                <td>".$row['stud_email']."</td> 
                <td>".$row['verified']."</td> 
                <td><a class='edit_student'><button type='button' data-id='".$row['stud_id']."' class='viewbtn'>Edit</button></a>&nbsp;
                    <a><button type='button' data-id='".$row['stud_id']."' class='deletebtn'>Delete</button></a>
                </td>
                
            </tr>";
        }
        $output .="</tbody>";
        echo $output;
    }
    else {
        echo"<thead> 
        <tr>  
            <th>ID</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email Address</th>
            <th>Account Status</th>
            <th>Action</th>  
        </tr> 
        <tr>
            <td style='color: red' colspan='7'>No records found</td>
        </tr>
    </thead>
    <tbody>";
    }
?>
