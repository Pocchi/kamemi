<?php //echo $this->Html->script(array('script1', 'script2'), array('inline'=>false)); ?>
<?php echo $this->Html->css('cart', array( 'inline' => false)); ?>
<!-- include end -->
	<div id="title"><span>カート</span></div>
	<!-- カラムスタート -->
	<main id="wrapper" class="row">
		

	<div id="right" class="col centercolum"><!-- right start -->
<?php
$i=0;
$goodsPrice=0;
foreach($carts as $cart):
//debug($good);
?>
		<div role="main" class="row gutters listbox"><!-- カラムスタート -->
			<div role="complimentary" class="col span_13 listimg">
				<?php echo $this->Html->image($cart['Good']['f_goods_id']."-1.png", array('alt' => 'kamemiイメージ','id'=>'')); ?>
			</div>
			<div class="col span_14 listtxt">
				<ul>
					<li><?php echo $cart['Good']['f_goods_name'] ?></li>
					<li><?php echo $cart['Good']['f_goods_size'] ?></li>
					<li><?php echo $cart['Good']['f_goods_price']."円" ?></li>
					<li><?php echo $this->Html->link('詳細',array('controller'=>'Goods','action'=>'goods_detail',$cart['Good']['f_goods_id'])); ?></li>
					<li>
						<?php
							echo $this->Form->create('cartdel',array(
								'type'=>'post',
								'url'=>'/carts/delete'
							));
							echo $this->Form->hidden('cartdelid',array('value'=>$cartid[$i]));
							echo $this->Form->end(
								array(
									'label'=>'削除する',
									'div'=>array(
										'class'=>'submit',
									)
								)
							);
							$i++;
$goodsPrice+=$cart['Good']['f_goods_price'];
						?>
					</li>
				</ul>
			</div>
		</div>

<?php
//htmlspesialcharsの省略
//echo h($good['Good']['f_goods_id']);
				
 endforeach; ?>
 
	</div><!-- right end -->
	<?php
		if($i!=0){
			//カート内にデータがある時
			?>

			<dl class="row">
				<dt>品数</dt>
				<dd><?php echo $i; ?>点</dd>
				<dt>合計</dt>
				<dd id="pricedd"><?php echo number_format($goodsPrice); ?>円</dd>
			</dl>
			<?php
			echo $this->Form->create('cartin',array(
				'type'=>'post',
				'url'=>'/orders/buy_input'
			));
			echo $this->Form->hidden('cart',array('value'=>'true'));
			echo $this->Form->end(
				array(
					'label'=>'購入する',
					'class'=>'orderSubmit'
				)

			);
			?>
		</div><!-- orderbox end -->
			<?php
		}else{
			?>
			<div id="comment">
			<p>カートに何も入っていません</p>
				</div>
	<?php
		}
echo $this->Html->link('商品リストへ',array('controller'=>'goods','action'=>'goods_list'), array('class'=>'button03'));
		
		?>
	
	</main>