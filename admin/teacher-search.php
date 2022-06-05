<?php
    include 'conn.php';
    $output='';

    if(isset($_POST['query'])){
        $search=$_POST['query'];
        $stmt=$conn->prepare("SELECT * FROM teacher WHERE teac_id LIKE CONCAT('%',?,'%') OR teac_username LIKE  CONCAT('%',?,'%')");
        $stmt->bind_param("ss",$search,$search);
    }
    else{
        $stmt=$conn->prepare("SELECT * FROM teacher");
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
                <th>Join Date</th>
                <th>Status</th>
                <th>Action</th>  
            </tr> 
        </thead>
        <tbody>";
        while($row=$result->fetch_assoc()){
            $output .="
            <tr>
                <td>".$row['teac_id']."</td>
                <td>".$row['teac_username']."</td>  
                <td>".$row['teac_first_name']."</td> 
                <td>".$row['teac_last_name']."</td> 
                <td>".$row['teac_email']."</td> 
                <td>".$row['teac_join_date']."</td> 
                <td>".$row['teac_status']."</td> 
                <td><a class='edit_teacher'><button type='button' data-id='".$row['teac_id']."' class='viewbtn'>Edit</button></a>&nbsp;
                    <a><button type='button' data-id='".$row['teac_id']."' class='deletebtn'>Delete</button></a>
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
            <th>Join Date</th>
            <th>Status</th>
            <th>Action</th>  
        </tr> 
        <tr>
            <td style='color: red' colspan='8'>No records found</td>
        </tr>
    </thead>
    <tbody>";
    }
?>
