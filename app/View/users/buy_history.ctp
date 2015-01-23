<?php echo $this->Html->css('menber_input', array( 'inline' => false)); ?>
		<div id="title"><span>新規登録</span></div>
		<main>
<?php

echo $this->Form->create('customer', array('controller'=>'customer'));
echo $this->Form->input('f_cust_id',array('type'=>'hidden','value'=>'C0000000002'));
			echo $this->Form->input('f_cust_name',array('label' => '名前'));
echo $this->Form->input('f_cust_tel',array('label' => '電話番号'));
echo $this->Form->input('f_cust_post',array('label' => '郵便番号'));
echo $this->Form->input('f_cust_address',array('label' => '住所'));
echo $this->Form->input('f_cust_mail',array('label' => 'メールアドレス'));
echo $this->Form->input('f_cust_pass',array('label' => 'パスワード'));
echo $this->Form->input( 'f_cust_dm', array(
	'type' => 'checkbox',
	'checked' => '1',    // 初期表示で選択させる場合
	'label' => 'チェックをつけるとDMが郵送されます',    // チェックボックスのラベル
	//  'div' => false        // div親要素の有無(true/false)
));
			echo $this->Form->button('reset',array('type'=>'reset'));
			echo $this->Form->end('登録');
?>

				</div>
				
			</form>
		</main>