<?php
App::uses('Component', 'Controller');

class PageComponent extends Component {
	protected $action=null;
	public $request;

	public $helpers=array('Html','Form');
	public function chain(){
		print "chain";

		

	}

	
}