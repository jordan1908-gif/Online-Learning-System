<?php
    include 'conn.php';
    $output='';

    if(isset($_POST['query'])){
        $search=$_POST['query'];
        $stmt=$conn->prepare("SELECT * FROM admin WHERE adm_id LIKE CONCAT('%',?,'%') OR adm_username LIKE  CONCAT('%',?,'%')");
        $stmt->bind_param("ss",$search,$search);
    }
    else{
        $stmt=$conn->prepare("SELECT * FROM admin");
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
                <th>Action</th>  
            </tr> 
        </thead>
        <tbody>";
        while($row=$result->fetch_assoc()){
            $output .="
            <tr>
                <td>".$row['adm_id']."</td>
                <td>".$row['adm_username']."</td>  
                <td>".$row['adm_first_name']."</td> 
                <td>".$row['adm_last_name']."</td> 
                <td>".$row['adm_email']."</td> 
                <td><a onclick='return confirm('Are you sure you want to delete?')' href='admin-deleteadmin.php?adm_id=".$row['adm_id']."'><button class='deletebtn'>Delete</button></td>
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
            <th>Action</th>  
        </tr> 
        <tr>
            <td style='color: red' colspan='6'>No records found</td>
        </tr>
    </thead>
    <tbody>";
    }
?>
