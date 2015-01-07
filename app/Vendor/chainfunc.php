<?php
//連番取得
function chainfunc($previd){
    $prevHead = substr($previd, 0, 1);
    $prevString = substr($previd, 1, 9);
	$prevNum=intval($prevString);
	$prevNum++;
	$nextId=$prevHead.sprintf("%09d",$prevNum);
	return $nextId;
}
?>