<?php 



extract($_POST);

if(empty($id)){
	$data=  " quiz_title='".$title."'";
	$data .=  ", quiz_timer='".$timer."'";
	$data .=  ", quiz_point='".$qpoints."'";
	$insert_user = $conn->query('INSERT INTO quiz set  '.$data);

	if($insert_user){
			echo json_encode(array('status'=>1,'id'=>$conn->insert_id));
	}
}else{
	$data=  " quiz_title='".$title."'";
	$data .=  ", quiz_timer='".$timer."'";
	$data .=  ", quiz_point='".$qpoints."'";
	$update = $conn->query('UPDATE quiz set  '.$data.' where id= '.$id);

	if($update){
			echo json_encode(array('status'=>1,'id'=>$id));
		
	}
}