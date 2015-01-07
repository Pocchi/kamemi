<?php

class A_order extends AppModel{
	//contでsave時呼ばれる
	//エラーチェック
	//public $hasMany="Order";
	public $name='A_order';
	public $primaryKey = 'f_order_id';
	/*//エラーチェック
	public $validate = array(
		'f_order_mail'=>array(
			'rule'=>array('confirm'),
			'message'=>'メールアドレスが一致しません'
		),
	);
	public function confirm($check){
		foreach($check as $key=>$value){
			if((! isset($this->data[$this->name][$key.'_confirm']))or($value!==$this->data[$this->name][$key.'_confirm'])){
				return false;
			}
			
		}
		return true;
	}*/
}