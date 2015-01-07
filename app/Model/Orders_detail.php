<?php

class Orders_detail extends AppModel{
	//contでsave時呼ばれる
	//エラーチェック
	public $hasMany="Orders_detail";
	public $validate = array(

	);
}