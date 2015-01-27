<?php echo $this->Html->css('menber_input', array( 'inline' => false)); ?>
<?php echo $this->Html->css('modal',array( 'inline' => false)); ?>
<?php echo $this->Html->script( 'modal', array('inline'=> false)); ?>
<?php echo $this->Html->script( 'resetInput2', array('inline'=> false)); ?>
		<div id="title"><span>新規登録</span></div>
		<main>
<?php

echo $this->Form->create('users', array('controller'=>'user','action'=>'menber_complete','class'=>'BootstrapForm'));
echo $this->Form->input('f_cust_id',array('type'=>'hidden','value'=>$inputId));
echo $this->Form->input('f_cust_name',array('label' => '名前','value'=>$useArray[0]));
echo $this->Form->input('f_cust_tel',array('label' => '電話番号','value'=>$useArray[1]));
echo $this->Form->input('f_cust_post',array('label' => '郵便番号','value'=>$useArray[2]));
echo $this->Form->input('f_cust_address',array('label' => '住所','value'=>$useArray[3]));
echo $this->Form->input('f_cust_mail',array('label' => 'メールアドレス','value'=>$useArray[4]));
echo $this->Form->input('f_cust_pass',array('label' => 'パスワード'));
echo $this->Form->input( 'f_cust_dm', array(
	'type' => 'checkbox',
	'checked' => $useArray[5],    // 初期表示で選択させる場合
	'label' => 'チェックをつけるとDMが郵送されます',    // チェックボックスのラベル
	//'hiddenField' => false        // div親要素の有無(true/false)
));
echo $this->Form->button('reset',array('type'=>'button','id'=>'reset'));
echo $this->Form->button('確認',array('type'=>'button','id'=>'mordal_open'));
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
		<dt>パスワード</dt>
		<dd id="com_pass"></dd>
		<dt>DM希望</dt>
		<dd id="com_dm"></dd>
	</dl>
	<?php
echo $this->Form->end('登録する');
	?>
</div>
<!--モーダルウインドウ End-->
			</form>
		</main>