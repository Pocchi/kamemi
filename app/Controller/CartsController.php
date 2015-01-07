<?php
App::uses('AppController','Controller');
App::import('Vendor','chainfunc');
class CartsController extends AppController{
	var $name = 'Carts';
	var $uses = array('Good','Goods_img','Cart','Carts_detail','User');
	public $helpers=array('Html','Form');
	//Authカスタマイズ
	//	var $uses = array('Kamemi', 'login');

	public function beforeFilter(){
		if(isset($this->request->data['cartin']['goodsid'])){
			$cartadd=$this->request->data['cartin']['goodsid'];
			$this->Session->write('cartadd',$cartadd);
		}
		parent::beforeFilter();
		//$this->Session->delete('cart');
		//$this->Session->delete('user');
		if($this->Session->check('cart')){
		//カートセッションがある

			$cartsession=$this->Session->read('cart');
			//print_r($cartsession);
			//print "ok1";
		}else{
			//print "ok2";
			//カートセッションがない
			if($this->Session->check('user')){
				//ログインしていた場合、カートID問い合せ
				$userid=$this->Session->read('user.userId');
				$cartCount=$this->Cart->find(
					'count',
					array('conditions'=>array(
						'and'=>array(
							'f_cust_id'=>$userid,
							array('f_order_datetime'=>NUll),
							array('f_order_datetime <'=>date('Y-m-d i:s'))
						)
					))
				);

				if($cartCount>0){
					//検索データ取得
					$cartId=$this->User->find(
						'first',
						array('conditions'=>array(
							'and'=>array(
								'f_cust_id'=>$userid,
								array('f_order_datetime'=>NUll),
								array('f_order_datetime<'=>date('Y-m-d H:i:s'))
							)
						))
					);
				}else{

					//カート登録
					//連番取得(カートID)
					$nextid=null;
					$countid=$this->Cart->findLastId('f_cart_id','carts','Cart');
					foreach ($countid as $id):
					$previd=$id['Cart']['f_cart_id'];
					endforeach;
					$cartId=chainfunc($previd);
					//連番取得ここまで
					$this->Cart->save(
						array(
							'Cart'=>array(
								'f_cart_id'=>$cartId,
								'f_cust_id'=>$userid,
							)
						)
					);
				}

			}else{
				//未ログインの場合,ゲストアカウントを登録する
				//連番取得(ユーザID)
				$nextid=null;
				$countid=$this->User->findLastId('f_cust_id','users','User');
				foreach ($countid as $id):
				$previd=$id['User']['f_cust_id'];
				endforeach;
				$nextUserId=chainfunc($previd);
				//連番取得ここまで
				//ゲストアカウント登録
				$this->User->create();
				$this->User->save(
					array(
						'User'=>array(
							'f_cust_id'=>$nextUserId,
							'f_cust_flag'=>"gest",
						)
					)
				);
				//セッション埋め込み
				$this->Session->write(
					'user',
					array('userId'=>$nextUserId,
						  'userName'=>'ゲスト',
						  'userState'=>'gest',
						 )
				);
				//カート登録
				//連番取得(カートID)
				$nextid=null;
				$countid=$this->Cart->findLastId('f_cart_id','carts','Cart');
				foreach ($countid as $id):
				$previd=$id['Cart']['f_cart_id'];
				endforeach;
				$cartId=chainfunc($previd);
				//連番取得ここまで
				$this->Cart->create();
				$this->Cart->save(
					array(
						'Cart'=>array(
							'f_cart_id'=>$cartId,
							'f_cust_id'=>$nextUserId,
						)
					)
				);
			}

			$this->Session->write('cart.cartId',$cartId);
			//print "cartid:".$cartId;

		}
		//print "session:".$cartid=$this->Session->read('cart.cartId');

	}
	
	public function cart(){

		$cartid=$this->Session->read('cart.cartId');
		//print $cartid;
		$userid=$this->Session->read('user.userId');
		//print $userid;

		$cartarray=array();
		$cartidarray=array();
		//print_r($this->Good->find('all'));
		$carts=$this->Carts_detail->find(
			'all',
			array('conditions'=>array('Carts_detail.f_cart_id'=>$cartid))
		);
		foreach ($carts as $cart):
		$cartidarray[]=$cart['Carts_detail']['f_carts_detail_id'];
			$cartstxt=$this->Good->find(
				'first',
				array('conditions'=>array(
					'Good.f_goods_id'=>$cart['Carts_detail']['f_goods_id']))
			);

			$cartarray[]=$cartstxt;
		endforeach;
		$this->set('carts',$cartarray);
		$this->set('cartid',$cartidarray);
	}
	
	public function add(){
		//連番取得
		$nextid=null;
		$cartid=$this->Session->read('cart.cartId');
		$countid=$this->Carts_detail->findLastId('f_carts_detail_id','carts_details','Carts_detail');
		foreach ($countid as $id):
		$previd=$id['Carts_detail']['f_carts_detail_id'];
		endforeach;
		$cartDetailId=chainfunc($previd);
		//print "cartDetail:".$cartDetailId;
		//連番取得ここまで
		if($this->Session->check('cartadd')){
			$cartadd=$this->Session->read('cartadd');
			//print $cartadd;
			//print $cartid;
			if($this->Session->check('user')){
				$userid=$this->Session->read('user.userId');
				$this->Carts_detail->create();
				$cart=$this->Carts_detail->save(
						array(
							'Carts_detail'=>array(
								'f_carts_detail_id'=>$cartDetailId,
								'f_goods_id'=>$cartadd,
								'f_cart_id'=>$cartid,
							)
						)
					);
				
				if($cart!=false){
					//カート追加成功
					$this->Session->setFlash('カートに追加しました', 'default', array('class' => 'flash_login'));
						$this->redirect('/Carts/cart');
					}else{
						$this->Session->setFlash('カート追加失敗しました', 'default', array('class' => 'flash_login'));
						//print $this->Session->read('cart.cartId');
						$this->redirect('/Carts/cart');
					}
				}
			}
		}

	public function delete(){
		if(isset($this->request->data['cartdel']['cartdelid'])){
			$cartid=$this->request->data['cartdel']['cartdelid'];
			$this->Session->setFlash('商品を削除しました', 'default', array('class' => 'flash_login'));
			$this->Carts_detail->delete($cartid);
			$this->redirect('/Carts/cart');
		}
		
	}
}