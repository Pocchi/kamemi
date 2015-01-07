<?php //echo $this->Html->script(array('script1', 'script2'), array('inline'=>false)); ?>
<?php echo $this->Html->css('cart', array( 'inline' => false)); ?>
<!-- include end -->
	<div id="title"><span>カート</span></div>
	<!-- カラムスタート -->
	<main id="wrapper" class="row">
		<div id="left" class="col span_19"><!-- left start -->
			<div id="leftin" class=""><!-- leftin start -->
		</div><!-- leftin end -->
		<div id="kame"><div id="kame"></div>
		</div>
		</div><!-- left end -->

	<div id="right" class="col span_20"><!-- right start -->
<?php
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
echo $this->Form->hidden('cartdelid',array('value'=>$cart['Good']['f_goods_id']));
echo $this->Form->end(
	array(
		'label'=>'削除する',
		'div'=>array(
			'class'=>'submit',
		)
	)
);
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
echo $this->Form->create('cartin',array(
	'type'=>'post',
	'url'=>'/orders/'
));
echo $this->Form->hidden('cart',array('value'=>'true'));
echo $this->Form->end(
	array(
		'label'=>'購入する',
		'div'=>array(
			'class'=>'submit',
		)
	)
);
		?>
	</main>