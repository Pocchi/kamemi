<?php echo $this->Html->css('modal',array( 'inline' => false)); ?>
<?php echo $this->Html->css('buy_input',array( 'inline' => false)); ?>
<?php echo $this->Html->script( 'modal', array('inline'=> false)); ?>
<?php echo $this->Html->script( 'resetInput', array('inline'=> false)); ?>
		<div id="title"><span>発送先住所入力</span></div>
		<main>
		
<?php
//ログインフォーム
if(isset($flag)){
	//購入ルートチェック
	//print $flag;

	//gestならばログインリンク
	//customerならばvalue挿入
	if(isset($state)){
		if($state=='gest'){
			echo $this->Form->create('login',array(
				'type'=>'post',
				'url'=>'/users/login'
			));
			echo $this->Form->input('f_cust_mail',array('label' => 'メールアドレス'));
			echo $this->Form->input('f_cust_pass',array('label' => 'パスワード','type'=>'password'));
			echo $this->Form->input('loginvalue',array('type'=>'hidden','value'=>'orderlogin'));
			echo $this->Form->end('ログイン');
		}

	}
	//入力フォーム
	echo $this->Form->create('send',array(
		'type'=>'post',
		'url'=>'/orders/buy_comfirm'
	));
	echo $this->Form->input('f_cust_id',array('type'=>'hidden','value'=>$userId));
				echo $this->Form->input('f_cust_name',array('label' => '名前','value'=>$auto['User']['f_cust_name']));
	echo $this->Form->input('f_send_tel',array('label' => '電話番号','value'=>$auto['User']['f_cust_tel']));
	echo $this->Form->input('f_send_post',array('label' => '郵便番号','value'=>$auto['User']['f_cust_post']));
	echo $this->Form->input('f_send_address',array('label' => '住所','value'=>$auto['User']['f_cust_address']));
	echo $this->Form->input('f_send_mail',array('label' => 'メールアドレス','value'=>$auto['User']['f_cust_mail']));
	//echo $this->Form->input('f_cust_pass',array('label' => 'パスワード'));
	echo $this->Form->input( 'f_send_dm', array(
		'type' => 'checkbox',
		'checked' => '1',    // 初期表示で選択させる場合
		'label' => 'チェックをつけるとDMが郵送されます',
		'id'=>'check',
		//  'div' => false        // div親要素の有無(true/false)
	));
	echo $this->Form->button('リセット',array('type'=>'button','id'=>'reset'));
	echo $this->Form->button('確認',array('type'=>'button','id'=>'mordal_open'));
	}
?>

				</div>
<!--モーダルウインドウ Start-->
<div id="modal_back">
	<?php echo $this->Html->image("black_50.png", array('alt' => '','id'=>'','class'=>'closeButton')); ?>

</div>
<div id="modal">
	<a href="#" class="close closeButton">×</a>
	<h2>入力確認</h2>
	<p>以下の住所でよろしいですか？</p>
	<dl>
		<dt>名前</dt>
		<dd id="com_name"></dd>
		<dt>電話番号</dt>
		<dd id="com_tel"></dd>
		<dt>郵便番号</dt>
		<dd id="com_post"></dd>
		<dt>住所</dt>
		<dd id="com_address"></dd>
		<dt>メール</dt>
		<dd id="com_mail"></dd>
		<dt>DM希望</dt>
		<dd id="com_dm"></dd>
	</dl>
	<?php
echo $this->Form->end('この住所に送る');
	?>
</div>
<!--モーダルウインドウ End-->
			</form>
		</main>