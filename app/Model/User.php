<?php

class User extends AppModel{

	//contでsave時呼ばれる
	//プライマリーキー変更
	public $primaryKey = 'f_cust_id';
	//バリデード
	//    public $validate = array(
	//		'f_cust_id'=>array(
	//        'rule'=>'notEmpty',
	//        'message'=>'空っす',
	//    ),
	//		'f_cust_name'=>array(
	//        'rule'=>'notEmpty'
	//    )
	//  );
}