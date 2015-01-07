<?php

class Goods_img extends AppModel{
	//contでsave時呼ばれる


	//public $belongTo='Good';
	//プライマリーキー変更
	public $primaryKey = 'f_goods_img_id';
	//エラーチェック
	public $validate = array(
		
	);
}