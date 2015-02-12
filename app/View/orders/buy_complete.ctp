<?php echo $this->Html->css('buy_complete', array( 'inline' => false)); ?>
<div id="title"><span>注文完了</span></div>
<main>
	<p class="thanks">ご注文ありがとうございました</p>
	<hr />
	<p>
	<?php
		echo '受注番号：<span>'.$orderId.'</span>';
	?>
	</p>
	<p class="formail">メールが届きます。<br />お待ちくださいませ。</p>
	<?php
	if($userName=="ゲスト"){
		echo $this->Html->link('>>会員登録する',array('controller'=>'Users','action'=>'menber_input'));
		}
	?>
</main>