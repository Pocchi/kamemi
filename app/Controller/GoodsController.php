<?php
//App::uses('AppController','Controller');
class GoodsController extends AppController{
	public $components = array('Page');
	var $name = 'Goods';
	var $uses = array('Good','Goods_img');
	//	var $uses = array('Kamemi', 'login');
	public $helpers=array('Html','Form');
	//Authカスタマイズ
	public function goods_list(){
		//print_r($this->Good->find('all'));
		$goodlist=$this->Good->find('all');
		$this->set('goods',$goodlist);

	}

	public function goods_detail($id=null){
		//商品詳細取得
		$goods=$this->Good->find(
			'first',
			array('conditions'=>array('Good.f_goods_id'=>$id))
		);
		$this->set('goodstxt',$goods);
		//商品イメージ取得
		$goodsimg=$this->Goods_img->find(
			'all',
			array('conditions'=>array('Goods_img.f_goods_id'=>$id))
		);
		//print_r($goodsimg);
		$this->set('goodsimgs',$goodsimg);
	}
}