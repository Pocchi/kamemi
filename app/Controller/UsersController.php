<?php

App::uses('AppController','Controller');
App::import('Vendor','chainfunc');
class UsersController extends AppController{
	var $uses = array('Good','Goods_img','Order','Cart','User','Send','Orders_detail');
	public $components = array('Page');
	var $name = 'Users';
	//	var $uses = array('Kamemi', 'login');
	public $helpers=array('Html','Form','BootstrapForm');
	

	public function index(){
		 //print_r($this->User->find('all',
//								array('User.f_cust_id'=>'1')
//								  ));


	}

	public function login_ok(){
		
	}
	public function login(){
		$email=null;
		$pass=null;
		$menber=array();
		$error=array();

		if(isset($this->request->data['login'])){
			//アドレス、パスワード受け取り
			$email=$this->request->data['login']['f_cust_mail'];
			$pass=$this->request->data['login']['f_cust_pass'];
			//print $email;
			//print $pass;
			//問い合せカウント
			$userCount=$this->User->find(
				'count',
				array('conditions'=>array(
					'and'=>array(
						'f_cust_mail'=>$email,
						'f_cust_pass'=>$pass
					)
				))
			);
			
			if($userCount>0){
				//検索データ取得
				$user=$this->User->find(
					'first',
					array('conditions'=>array(
						'and'=>array(
							'f_cust_mail'=>$email,
							'f_cust_pass'=>$pass,
							'f_cust_flag'=>'customer'
							)
						))
				);
				//セッション埋め込み
				$this->Session->write(
					'user',
					array('userId'=>$user['User']['f_cust_id'],
						  'userName'=>$user['User']['f_cust_name'],
						  'userState'=>$user['User']['f_cust_flag']
						 )
				);
				//オーダーからのログインかどうか
				if(isset($this->request->data['login']['loginvalue'])){
					//オーダーから
					$ordervalue=$this->request->data['login']['loginvalue'];
					
					$this->Session->setFlash('ログインしました', 'default', array('class' => 'flash_login'));
					$this->redirect('/orders/buy_input');
				}else{
					//オーダー以外から
					//backUrlセッション取得
					if($this->Session->check('backUrl')){
						$backUrl=$this->Session->read('backUrl');
					
					}
					$this->Session->setFlash('ログインしました', 'default', array('class' => 'flash_login'));
					$backUrl=str_replace("kamemi/","",$backUrl);
					//print $backUrl;
					$this->redirect($backUrl);
				}
			}else{
				$errors[]= 'メールアドレスかパスワードが違います';
			}
		}
		$this->set('errors',$error);
	}



	public function logout(){
		$this->Session->delete('user');
		$this->Session->delete('cart');

		$this->Session->setFlash('ログアウトしました', 'default', array('class' => 'flash_login'));
		$this->redirect('/users/index');
	}
	public function menber_input(){
		//新規会員登録
		//ゲストIDが発行されていない
		//value初期化
		$useArray=array();
		for($i=0;$i<8;$i++){
			$useArray[$i]="";
		}
		$useArray[5]='0';
		//
		if($this->Session->check('user')){
			$inputId=$this->Session->read('user.userId');
			$userState=$this->Session->read('user.userName');
			//send問い合せ
			$value=$this->Send->find(
				'first',
				array('conditions'=>array(
					'and'=>array(
						'f_cust_id'=>$inputId,
					)),
					'order' => array('Send.f_send_id DESC'),
				));
			print_r($value);

			if(isset($value)){
			$useArray[0]=$value["Send"]["f_send_name"];
			$useArray[1]=$value["Send"]["f_send_tel"];
			$useArray[2]=$value["Send"]["f_send_post"];
			$useArray[3]=$value["Send"]["f_send_address"];
			$useArray[4]=$value["Send"]["f_send_mail"];
			$useArray[5]=$value["Send"]["f_send_dm"];
			}
		}else{
			//連番取得(ユーザID)
			$nextid=null;
			$countid=$this->User->findLastId('f_cust_id','users','User');
			foreach ($countid as $id):
			$previd=$id['User']['f_cust_id'];
			endforeach;
			$nextUserId=chainfunc($previd);
			//連番取得ここまで
			$inputId=$nextUserId;
		}
		//valueセット
		$this->set("inputId",$inputId);
		$this->set("useArray",$useArray);
		
	}
	public function menber_complete(){
		if(isset($this->request->data['users'])){
			//アドレス、パスワード受け取り
			$userArray=$this->request->data;
			//print_r($userArray);
			//ゲスト発行済みかどうか
			if($this->Session->check('user')){
			//発行済み(alter)
				$user=$this->User->save($this->request->data['users']);
			}else{
			//新規(create)
				$this->User->create();
				$user=$this->User->save(
					array(
						'User'=>array(
							'f_cust_id'=>$userArray['users']['f_cust_id'],
							'f_cust_name'=>$userArray['users']['f_cust_name'],
							'f_cust_tel'=>$userArray['users']['f_cust_tel'],
							'f_cust_post'=>$userArray['users']['f_cust_post'],
							'f_cust_address'=>$userArray['users']['f_cust_address'],
							'f_cust_mail'=>$userArray['users']['f_cust_mail'],
							'f_cust_dm'=>$userArray['users']['f_cust_dm'],
							'f_cust_pass'=>$userArray['users']['f_cust_pass'],
							'f_cust_flag'=>'customer'
						)
					)
				);
			}
			if($user!==false){
				//セッション埋め込み
				$this->Session->write(
					'user',
					array('userId'=>$userArray['users']['f_cust_id'],
						  'userName'=>$userArray['users']['f_cust_name'],
						  'userState'=>'customer'
						 )
				);


				$this->Session->setFlash('登録完了しました', 'default', array('class' => 'flash_login'));
				$this->redirect('/users/index');
			}
		}
	}
	public function menber(){
		//
		//ゲストかどうか
		//
		$userId=$this->Session->read('user.userId');
		$userName=$this->Session->read('user.userName');
		
			
		if(isset($userName)&&$userName!="ゲスト"){
			
			//
			//購入履歴処理
			//
			$historyArray=$this->Orders_detail->query(
				'select
				 orders_details.f_goods_id as "商品ID",
				 goods.f_goods_name as "商品名",
				 orders_details.f_order_detail_price as "価格",
				 a_orders.f_order_datetime as "注文日時"
				 from
				 orders_details,goods,a_orders
				 where
				 goods.f_goods_id=orders_details.f_goods_id
				 and
				 a_orders.f_order_id=orders_details.f_order_id
				 and
				 a_orders.f_cust_id="'.$userId.'"
				 order by f_order_datetime desc'
			);
			//print_r($historyArray);
			$this->set('history',$historyArray);
			//img名取得
			$imgName=array();
			foreach($historyArray as $history):
				$goodid=$history['orders_details']['商品ID'];
			//print "<br />";
			//print $goodid;
			$imgName[]=$this->Goods_img->find(
				'first',
				array(
					'fields'=>array('f_goods_img_name'),
					'conditions'=>array(
					'and'=>array(
						'f_goods_id'=>$goodid,
					)
				))
			);
			endforeach;
			$this->set("imgArray",$imgName);
			//
			//会員情報処理
			//

			$userArray=$this->User->find(
				'first',
				array(
					'conditions'=>array(
						'and'=>array(
							'f_cust_id'=>$userId,
						)
					))
			);
			//DM表示処理
			$dm=$userArray["User"]["f_cust_dm"];
			if($dm=="1"){
				$userArray["User"]["f_cust_dm"]="希望する";
			}else{
				$userArray["User"]["f_cust_dm"]="希望しない";
			}
			//パスワード変換
			$pass=null;
			$count=strlen($userArray["User"]["f_cust_pass"]);
			//print $count;
			for($i=0;$i<$count;$i++){
				$pass.="*";
			}
			//print $pass;
			$userArray["User"]["f_cust_pass"]=$pass;
			//print_r($userArray);
			$this->set("user",$userArray);
		}else{
			$nowUrl=$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
			$url=explode('kamemi',$nowUrl);
			$urlnext=$url[0]."kamemi/Users";
			die(header("Location:".$urlnext));
		}
	}
}