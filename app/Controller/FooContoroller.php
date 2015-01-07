<?php
public function beforeFilter() {
	/* bar()より前に実行したい処理を書く */
}
public function beforeRender() {
	/* bar()より後に実行したい処理を書く */
}
public function afterFilter() {
	/* Viewのrenderより後に実行したい処理を書く */
}
public function bar() {
	/* Action */
}