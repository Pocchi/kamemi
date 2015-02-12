<?php echo $this->Html->css('modal',array( 'inline' => false)); ?>
<?php echo $this->Html->css('buy_comfirm',array( 'inline' => false)); ?>
<?php echo $this->Html->script( 'modal', array('inline'=> false)); ?>
<?php echo $this->Html->script( 'resetInput', array('inline'=> false)); ?>
		<div id="title"><span>購入情報確認</span></div>
		<main>
		<?php
	echo $this->Form->create('Order',array(
		'type'=>'post',
		'url'=>'/orders/buy_complete'
	));
	echo $this->Form->hidden('f_send_id',array('value'=>$sendId));
print $sendId;
			?>
			<h1>注文商品</h1>
			<ul>
			<?php
				$i=0;
				$goodsPrice=0;
				foreach($carts as $cart):
					//debug($good);
			?>
				<li class="goodsimg">
			<?php echo $this->Html->image($cart['Good']['f_goods_id']."-1.png", array('alt' => 'kamemiイメージ','id'=>''));
					?></li>

				<li><?php echo $cart['Good']['f_goods_name'] ?></li>
				<li><?php echo $cart['Good']['f_goods_size'] ?></li>
				<li><?php echo $cart['Good']['f_goods_price']."円" ?></li>

				<?php
					$i++;
					$goodsPrice+=$cart['Good']['f_goods_price'];
				endforeach;
			?>
			</ul>
			<?php
				if($i!=0){
				//カート内にデータがある時
			?>

			<dl class="row">
				<dt>品数</dt>
				<dd><?php echo $i; ?>点</dd>
				<dt>商品合計</dt>
				<dd id="pricedd"><?php echo number_format($goodsPrice); ?>円</dd>
				<dt>送料</dt>
				<dd id="pricedd"><?php echo number_format($sendMoney); ?>円</dd>
				<dt id="seikyu">請求金額</dt>
				<dd id="pricedd"><?php echo number_format($goodsPrice+$sendMoney); ?>円</dd>
				<?php
					echo $this->Form->hidden('f_order_price',array('value'=>$goodsPrice+$sendMoney));
				}else{
					echo $this->Form->hidden('f_order_price',array('value'=>'0'));
				?>
				<div id="comment">
					<p>カートに何も入っていません</p>
				</div>
				<?php
				}


				?>
			</dl>
			<h1>配送先住所</h1>
			<dl class="row">
				<dt>名前</dt>
				<dd id="com_name"><?php echo $send['f_cust_name']; ?></dd>
				<dt>電話番号</dt>
				<dd id="com_tel"><?php echo $send['f_send_tel']; ?></dd>
				<dt>郵便番号</dt>
				<dd id="com_post"><?php echo $send['f_send_post']; ?></dd>
				<dt>住所</dt>
				<dd id="com_address"><?php echo $send['f_send_address']; ?></dd>
				<dt>メール</dt>
				<dd id="com_mail"><?php echo $send['f_send_mail']; ?></dd>
				<dt>DM希望</dt>
				<dd id="com_dm"><?php echo $dm_flag; ?></dd>
			</dl>
			<?php

echo $this->Form->hidden('cart',array('value'=>'true'));
echo $this->Form->button('請求先を入力する',array('type'=>'button','id'=>'mordal_open','class'=>"button02"));
?>
			<!--モーダルウインドウ Start-->
			<div id="modal_back">
				<?php echo $this->Html->image("black_50.png", array('alt' => '','id'=>'display_in','class'=>'closeButton')); ?>

			</div>
			<div id="modal">
				<a href="#" class="close closeButton">×</a>
				<h2>請求先入力</h2>
				<p>こちらのメールアドレスに<br />請求が届きます。</p>
				<hr />

				<?php
echo $this->Form->input('f_order_mail',array('label' => 'メールアドレス','value'=>$send['f_send_mail']));
echo $this->Form->input('f_order_mail_confirm',array('label' => 'メールアドレス(再)','value'=>$send['f_send_mail']));
						//echo $this->Form->button('リセット',array('type'=>'button','id'=>'reset2','class'=>"resetbutton"));
echo $this->Form->end('購入確定する');
				?>
			</div>
			<!--モーダルウインドウ End-->

<?php
?>
		</main>