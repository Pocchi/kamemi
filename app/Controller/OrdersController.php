<?php
App::uses('AppController','Controller');
App::import('Vendor','chainfunc');
App::import('Vendor','check_flag');
//App::import('Vendor','mailsend');
App::uses( 'CakeEmail', 'Network/Email');
class OrdersController extends AppController{
	public $components = array('Page');
	var $name = 'Orders';
	var $uses = array('Good','Goods_img','A_order','Cart','User','Carts_detail','Send','Shop_maintenance','Orders_detail');
	public $helpers=array('Html','Form');
	public function beforeFilter(){
		parent::beforeFilter();
		//購入ルートチェック
		if(isset($this->request->data['cartin'])){
			$orderFlag=$this->request->data['cartin']['cart'];
			$this->Session->write('oreder.root','true');
			$this->set('flag',$orderFlag);
		}else if($this->Session->check('oreder')){
			$this->set('flag','true');
		}
		//アカウントstateチェック(ゲストかどうか)
		if($this->Session->check('user')){
			$userstate=$this->Session->read('user.userState');
			$userid=$this->Session->read('user.userId');
			$this->set('state',$userstate);
			$auto=$this->User->find(
				'first',
				array('conditions'=>array(
					'and'=>array(
						'f_cust_id'=>$userid
					)
				)));
			$this->set('auto',$auto);
			//print_r($auto);

		}
	}
	public function buy_input(){
		$userId=$this->Session->read('user.userId');
		$cartId=$this->Session->read('cart.cartId');
		//print "<br />user:".$userId;
		//print "<br />cart:".$cartId;
		//ユーザ変更
		//更新する内容
		$data=array(
			'Cart'=>array(
				'f_cart_id'=>$cartId,
				'f_cust_id'=>$userId
			));
		$filds=array('f_cust_id');
		$user=$this->Cart->save($data,$filds);
		//print_r($data);
		
	}
	public function buy_comfirm(){
		//post取得
		if(isset($this->request->data['send'])){
			$sendArray=$this->request->data['send'];
			//print_r($sendArray);
			//print $sendArray['f_send_dm'];
			//$value=check_flag($sendArray['f_send_dm']);
			$value;
			if($sendArray['f_send_dm']=="1"){
				$value="希望する";
			}else{
				$value="希望しない";
			}
			$this->set('send',$sendArray);
			$this->set('dm_flag',$value);

			//連番取得
			$countid=$this->Send->findLastId('f_send_id','sends','Send');
			foreach ($countid as $id):
			$previd=$id['Send']['f_send_id'];
			endforeach;
			$sendId=chainfunc($previd);
			//print $sendId;
			//print "cartDetail:".$cartDetailId;
			//連番取得ここまで
			//send追加
			$this->Send->create();
			$sendTable=$this->Send->save(
				array(
					'Send'=>array(
						'f_send_id'=>$sendId,
						'f_send_name'=>$sendArray['f_cust_name'],
						'f_send_post'=>$sendArray['f_send_post'],
						'f_send_address'=>$sendArray['f_send_address'],
						'f_send_tel'=>$sendArray['f_send_tel'],
						'f_send_mail'=>$sendArray['f_send_mail'],
						'f_cust_id'=>$sendArray['f_cust_id'],
						'f_send_dm'=>$sendArray['f_send_dm'],
					)
				)
			);
			$this->set('sendId',$sendId);
			$this->set('f_cust_name',$sendArray['f_cust_name']);
			//送料
			$sendMoney=$this->Shop_maintenance->find(
				'first',
				array('conditions'=>array(
					'Shop_maintenance.f_shop_maintenance_tag'=>'送料'),
					'order'=>'Shop_maintenance.f_shop_maintenance_id asc'
					  )
			);
			//print_r($sendMoney);
			$this->set('sendMoney',$sendMoney['Shop_maintenance']['f_shop_maintenance_num']);

			//カート情報
			$cartarray=array();
			$cartidarray=array();
			if($this->Session->check('cart')){
				$cartId=$this->Session->read('cart.cartId');
				//print "cartid".$cartId;
				$carts=$this->Carts_detail->find(
					'all',
					array('conditions'=>array('Carts_detail.f_cart_id'=>$cartId))
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
				//print_r($cartarray);
				$this->set('cartid',$cartidarray);
			}
			
		}
	}
	public function buy_complete(){
		//post取得
		if(isset($this->request->data['Order'])){
			$orderArray=$this->request->data['Order'];
			$userId=$this->Session->read('user.userId');
			$cartId=$this->Session->read('cart.cartId');
			$orderDate=date('Y-m-d H:i:s');
			//print_r($orderArray);
		
			//受注No取得
		//連番取得
		$countid=$this->A_order->findLastId('f_order_id','a_orders','A_order');
		foreach ($countid as $id):
		$previd=$id['A_order']['f_order_id'];
		endforeach;
		$orderId=chainfunc($previd);
		$this->set('orderId',$orderId);

						//連番取得ここまで
			//a_orderインサート
			$this->A_order->create();
			$this->A_order->save(
				array(
					'A_order'=>array(
						'f_order_id'=>$orderId,
						'f_cust_id'=>$userId,
						'f_order_datetime'=>$orderDate,
						'f_order_mail'=>$orderArray['f_order_mail'],
						'f_order_price'=>$orderArray['f_order_price'],
						'f_send_id'=>$orderArray['f_send_id'],
					)
				)
			);
			//cart注文日時アップデート
			$data=array(
				'Cart'=>array(
					'f_cart_id'=>$cartId,
					'f_order_datetime'=>$orderDate
				));
			$filds=array('f_order_datetime');
			$cart=$this->Cart->save($data,$filds);
			
			//カート内商品検索
			$carts=$this->Carts_detail->find(
				'all',
				array('conditions'=>array('Carts_detail.f_cart_id'=>$cartId))
			);
			$i=0;
			foreach ($carts as $cart):
			$cartidarray[]=$cart['Carts_detail']['f_carts_detail_id'];
			$cartstxt=$this->Good->find(
				'first',
				array('conditions'=>array(
					'Good.f_goods_id'=>$cart['Carts_detail']['f_goods_id']))
			);

			$cartarray[]=$cartstxt;
			//print "cart:";
			//print_r($cartarray);
			//print $cartarray[$i]['Good']['f_goods_id'];
			
			
			//order_detailインサート

			//連番取得
			$countid=$this->Orders_detail->findLastId('f_order_detail_id','orders_details','Orders_detail');
			foreach ($countid as $id){
			$previd=$id['Orders_detail']['f_order_detail_id'];
			}
			$orderDetailId=chainfunc($previd);
			//print "order_detail:".$orderDetailId;

			//連番取得ここまで

			$this->Orders_detail->create();
			$this->Orders_detail->save(
				array(
					'Orders_detail'=>array(
						'f_order_detail_id'=>$orderDetailId,
						'f_cust_id'=>$userId,
						'f_order_id'=>$orderId,
						'f_goods_id'=>$cartarray[$i]['Good']['f_goods_id'],
						'f_order_detail_price'=>$cartarray[$i]['Good']['f_goods_price'],
					)
				)
			);
			$i++;
			endforeach;
			//カートセッション削除
			$this->Session->delete('cart');
			//
			//メール送信
			//
			$sql_email="select
				 goods.f_goods_name as '商品名',
				 orders_details.f_order_detail_num as '数量',
				 orders_details.f_order_detail_price as '価格'
				 from orders_details,goods
				 where orders_details.f_goods_id=goods.f_goods_id
				 and orders_details.f_order_id='".$orderId."'";

			$sql_email2="select
				 sends.f_send_name as '送付先名',
				 sends.f_send_post as '郵便番号',
				 sends.f_send_address as '住所',
				 sends.f_send_tel as '電話番号'
				 from a_orders,sends
				 where a_orders.f_send_id=sends.f_send_id
				 and a_orders.f_order_id ='".$orderId."'";
			$sql_email3="select
				users.f_cust_name as '購入者名'
				from a_orders,users
				where a_orders .f_cust_id=users.f_cust_id
				and a_orders.f_order_id='".$orderId."'";
			$send_email = $this->A_order->query($sql_email);
			$send_email2 = $this->A_order->query($sql_email2);
			$send_email3 = $this->A_order->query($sql_email3);
			//print_r($send_email);
			//print_r($send_email2);
			//print_r($send_email3);
			$orderprice=$orderArray['f_order_price'];
			$images=IMAGES."topimage.jpg";
			//
			//$images = array('file' => $imagepath,
			//						'mimetype' => mime_content_type($imagepath),
			//						'contentId' => "image01"
			//					   );

			$mail_to=$orderArray['f_order_mail'];
			$mail_subject="注文番号【".$orderId."】自動送信メール";
			$email = new CakeEmail('gmail');                        // インスタンス化
			$email->from( array( 'm.axolotl.tr@gmail.com' => 'Kamemiブランドサイト'));  // 送信元
			$email->attachments($images);
			$email->to($mail_to);                      // 送信先
			$email->subject($mail_subject);                      // メールタイトル
			$email->emailFormat('html');
			// フォーマット
			$email->template('templete');               // テンプレートファイル
			$email->viewVars( compact( 'name','send_email','send_email2','send_email3','orderprice'));             // テンプレートに渡す変数

			$email->send();                             // メール送信



		}
	}

}