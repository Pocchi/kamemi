<?php
//check_flag
function check_flag($dm){
	//DM表示処理
	$value;
	if($dm=="1"){
		$value="希望する";
	}else{
		$value="希望しない";
	}
	return $value;
}
?>