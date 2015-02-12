<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $helpers = array(
		'Session',
		'Html' => array('className' => 'TwitterBootstrap.BootstrapHtml'),
		'Form' => array('className' => 'TwitterBootstrap.BootstrapForm'),
		'Paginator' => array('className' => 'TwitterBootstrap.BootstrapPaginator'),
	);

	//サニタイジング
	function __sanitize() {
		App::import('Sanitize');
		$this->data = Sanitize::clean($this->data, array('remove_html' => true));
	}

	public function beforeFilter() {

		$userId="C000000000";
		$userName="ゲスト";
		$loglink="ログイン";
		$logaction="login";
		$menberlink="会員登録";
		$menberaction="menber_input";
		/* 共通処理を記述 */
		//userセッション確認
		//セッションに値が設定されているか？
		if($this->Session->check('user')){
			$userId=$this->Session->read('user.userId');
			$userState=$this->Session->read('user.userState');
			$userName=$this->Session->read('user.userName');
			if($userState!='gest'){
				$loglink="ログアウト";
				$logaction="logout";
				$menberlink="会員ページ";
				$menberaction="menber";
			}
		}
		$this->set('userId',$userId);
		$this->set('userName',$userName);
		$this->set('loglink',$loglink);
		$this->set('logaction',$logaction);
		$this->set('menberlink',$menberlink);
		$this->set('menberaction',$menberaction);

		//
		//pageurl取得
		$url=Router::url();
		$now=$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
		//print $url;
		$urlArray=explode('/',$url);
		$urlNext=explode('kamemi',$now);
		$Nexturl=$urlNext[0]."/kamemi/";
		//print_r($urlNext);
		$urlCount=count($urlArray);
		$backUrl="/".$urlArray[$urlCount-2];
		$backUrl.="/".$urlArray[$urlCount-1];
		//print $urlArray[$urlCount-1];
		if(preg_match("/login|logout/",$urlArray[$urlCount-1])){
			//ログイン、ログアウト
		}else if(preg_match("/Users | users/",$urlArray[$urlCount-1])){

			$this->Session->write('backUrl',$Nexturl.'/User/');
		}else if(preg_match("/goods_detail/",$urlArray[$urlCount-2])){
			$this->Session->write('backUrl','/'.$urlArray[$urlCount-3].$backUrl);
		}else{
			//それ以外のページ
			$this->Session->write('backUrl',$backUrl);


		}
		//print($_SERVER["REQUEST_URI"]);
		$nowUrl=$_SERVER["REQUEST_URI"];
		$urlArray=explode("/",$nowUrl);
		//print_r($urlArray);
		$urlCount=count($urlArray);
		//print $urlArray[$urlCount-1];
		$histry="";
		$lastUrl=$urlArray[$urlCount-1];
		$secandUrl=$urlArray[$urlCount-2];
		if($lastUrl !="Users"&&$lastUrl!="index"&&$lastUrl!="buy_complete"&&$secandUrl!="goods_detail"&&$secandUrl!="Carts"){
			$histry="<a href='javascript:history.back();' class='histry'>前のページへ戻る</a>";
		}
		$this->set("histry",$histry);
	}
}
