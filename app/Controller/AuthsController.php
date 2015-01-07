<?php
App::uses('AppController','Controller');
class AuthsController extends AppController{
	var $name = 'Auths';
	//	var $uses = array('Kamemi', 'login');
	public $helpers=array('Html','Form');

	public function Authcheck(){

		if(isset($this->Session->read('user'))){
		}else{
			//未ログインの場合
		$this->Session->setFlash('ログインしてください', 'default', array('class' => 'flash_login'));
		$this->redirect('/users/login');
	}
}