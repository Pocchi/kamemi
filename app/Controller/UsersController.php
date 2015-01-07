<?php

App::uses('AppController','Controller');
App::import('Vendor','chainfunc');
class UsersController extends AppController{
	var $uses = array('Good','Goods_img','Order','Cart','User');
	public $components = array('Page');
	var $name = 'Users';
	//	var $uses = array('Kamemi', 'login');
	public $helpers=array('Html','Form');
	

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
}