<?php
App::uses('AppController','Controller');
class UsersController extends AppController{
	var $name = 'Users';
	//	var $uses = array('Kamemi', 'login');
	public $helpers=array('Html','Form');
	//Authカスタマイズ
	public $components = array(
		'Auth'=>array(
			//ログインしなくて良いページの指定
			'allowedActions'=>array('login','index','goods_list'),

			//モデル、フィールド名指定
			'authenticate'=>array(
				'Form'=>array(
					'userModel'=>'User',
					'firlds'=>array(
						'username'=>'User.f_cust_mail',
						'password'=>'User.f_cust_pass',
					),
				)
			),
			//ログイン処理リダイレクト
			'loginAction'=>'/users/login',
			//ログイン処理後リダイレクト
			'loginRedirect'=>'/users/index',
			//ログアウト処理後リダイレクト
			'logoutRedirect'=>'/users/login'
		)
	);
	
	public function beforeFilter() {
		parent::beforeFilter();
		// ユーザー自身による登録とログアウトを許可する
		$this->Auth->allow('add', 'logout','login','index');
	}
	public function index(){
		 print_r($this->User->find('all',
								array('User.f_cust_id'=>'1')
								  ));

	}

	public function login_ok(){
		
	}
	public function login(){
//		$email=null;
//		$pass=null;
//		$menber=array();
//
//		if(isset($this->request->data['login'])){
//			$email=$this->request->data['login']['f_cust_mail'];
//			$pass=$this->request->data['login']['f_cust_pass'];
//			print $email;
//			print $pass;
//	}
		//ログイン認証
		$error=array();
		if($this->request->data){
			if($this->Auth->login()){
				return $this->redirect($this->Auth->redirectUrl());
			}else{
				//ログイン失敗時の処理
				$errors[]= 'メールアドレスかパスワードが違います';

			}
			$this->set('errors',$errors);
		}

	}


	public function logout(){
		$logoutUrl=$this->Auth->logout();
		$this->redirect($logoutUrl);
	}
}