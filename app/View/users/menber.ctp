<?php echo $this->Html->script('menber_tab', array('inline'=>false)); ?>
<?php echo $this->Html->css('menber', array( 'inline' => false)); ?>
<!-- include end -->
<div id="title"><span>会員ページ</span></div>
<!-- カラムスタート -->
<main id="wrapper" class="row">
	<div id="left" class="col span_19"><!-- left start -->
		<div id="leftin" class=""><!-- leftin start -->
			<ul>
				<li>会員メニュー</li>
				<li id="menber">会員情報</li>
				<li id="history">購入履歴</li>
			</ul>
	</div><!-- leftin end -->
	
	</div><!-- left end -->

<div id="right" class="col span_20"><!-- right start -->
	<div id="right_menber">
		<h2>会員情報</h2>
		<dl>
			<dt>名前</dt>
			<dd id="com_name"><?php echo $user["User"]["f_cust_name"]; ?></dd>
			<dt>電話番号</dt>
			<dd id="com_tel"><?php echo $user["User"]["f_cust_tel"]; ?></dd>
			<dt>郵便番号</dt>
			<dd id="com_post"><?php echo $user["User"]["f_cust_post"]; ?></dd>
			<dt>住所</dt>
			<dd id="com_address"><?php echo $user["User"]["f_cust_address"]; ?></dd>
			<dt>メール</dt>
			<dd id="com_mail"><?php echo $user["User"]["f_cust_mail"]; ?></dd>
			<dt>パスワード</dt>
			<dd id="com_mail"><?php echo $user["User"]["f_cust_pass"]; ?></dd>
			<dt>DM希望</dt>
			<dd id="com_dm"><?php echo $user["User"]["f_cust_dm"]; ?></dd>
		</dl>
		
	</div>
	<div id="right_buy_history">
		<h2>購入履歴</h2>
		<?php
	$cnt=0;
	foreach($history as $good):
	
	//debug($good);
		?>
		<div role="main" class="row gutters listbox"><!-- カラムスタート -->
			<div role="complimentary" class="col span_13 listimg">
				<?php echo $this->Html->image($imgArray[$cnt]['Goods_img']['f_goods_img_name'], array('alt' => 'kamemiイメージ','id'=>'')); ?>
			</div>
			<div class="col span_14 listtxt">
				<ul>
					<li><?php echo $good['orders_details']['商品ID'] ?></li>
					<li><?php echo $good['goods']['商品名'] ?></li>
					<li><?php echo $good['orders_details']['価格']."円" ?></li>
					<li><?php echo $good['a_orders']['注文日時'] ?></li>
					<li><?php echo $this->Html->link('詳細',array('controller'=>'Goods','action'=>'goods_detail',$good['orders_details']['商品ID'])); ?></li>
				</ul>
			</div>
		</div>

		<?php
	//htmlspesialcharsの省略
	//echo h($good['Good']['f_goods_id']);
	$cnt++;
	endforeach; ?>
	</div>

</div><!-- right end -->
	<!--モーダルウインドウ Start-->
	<div id="modal_back">
		<?php echo $this->Html->image("black_50.png", array('alt' => '','id'=>'','class'=>'closeButton')); ?>

	</div>
	<div id="modal">
		<a href="#" class="close closeButton">×</a>
		<h2>請求先入力</h2>
		<p>こちらで入力されたメールアドレスに請求が届きます。</p>

		<?php
echo $this->Form->input('f_order_mail',array('label' => 'メールアドレス','value'=>$send['f_send_mail']));
echo $this->Form->input('f_order_mail_confirm',array('label' => 'メールアドレス(再)','value'=>$send['f_send_mail']));
echo $this->Form->button('リセット',array('type'=>'button','id'=>'reset2'));
echo $this->Form->end('購入確定する');
		?>
	</div>
	<!--モーダルウインドウ End-->
</main>