<?php
    include 'conn.php';
    $output='';

    if(isset($_POST['query'])){
        $search=$_POST['query'];
        $stmt=$conn->prepare("SELECT * FROM chatbot WHERE id LIKE CONCAT('%',?,'%') OR queries LIKE  CONCAT('%',?,'%')");
        $stmt->bind_param("ss",$search,$search);
    }
    else{
        $stmt=$conn->prepare("SELECT * FROM chatbot");
    }
    $stmt->execute();
    $result=$stmt->get_result();

    if($result->num_rows>0){
        $output = 
        "<thead> 
            <tr>  
                <th>ID</th>
                <th>Query</th>
                <th>Reply</th>
                <th>Action</th>  
            </tr> 
        </thead>
        <tbody>";
        while($row=$result->fetch_assoc()){
            $output .="
            <tr>
                <td>".$row['id']."</td>
                <td>".$row['queries']."</td>  
                <td>".$row['replies']."</td> 
                <td><a class='edit_chatbot'><button type='button' data-id='".$row['id']."' class='viewbtn'>Edit</button></a>&nbsp;
                    <a><button type='button' data-id='".$row['id']."' class='deletebtn'>Delete</button></a>
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
            <th>Query</th>
            <th>Reply</th>
            <th>Action</th>   
        </tr> 
        <tr>
            <td style='color: red' colspan='4'>No records found</td>
        </tr>
    </thead>
    <tbody>";
    }
?>
