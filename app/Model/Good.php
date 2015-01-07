<?php

class Good extends AppModel{
	//contでsave時呼ばれる
	//public $hasMany="Good";
	//プライマリーキー変更
	//public $name = 'Good';
	//public $hasOne = 'f_goods_id';
	public $primaryKey = 'f_goods_id';
	//エラーチェック
	public $validate = array(
		
	);
}