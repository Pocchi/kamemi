<?php //echo $this->Html->script(array('script1', 'script2'), array('inline'=>false)); ?>
<?php echo $this->Html->css('goods_detail', array( 'inline' => false)); ?>

<!-- include end -->

			<div id="title"><span>商品情報</span></div>
			<main role="main" class="row gutters">

				<div role="complimentary" class="col span_20" id="goodsimg_1">
					<div id="goods_name"><?php echo ($goodstxt['Good']['f_goods_name']); ?></div>
					<?php echo $this->Html->image($goodstxt['Good']['f_goods_id']."-1.png", array('alt' => 'kamemiイメージ','id'=>'')); ?>
				</div>
				<div class="col span_21" id="dammy">
				</div>
			</main>
			<div id="goods_text">

				<p><?php echo $goodstxt['Good']['f_goods_detail']; ?></p>
				<ul>
					<label class="text_in">商品名</label>
					<li><?php echo $goodstxt['Good']['f_goods_name']; ?></li>
					<label class="text_in">素材</label>
					<li><?php echo $goodstxt['Good']['f_goods_memo']; ?></li>
					<label class="text_in">サイズ</label>
					<li><?php echo $goodstxt['Good']['f_goods_size']; ?></li>
					<label class="text_in">価格</label>
					<li><?php echo $goodstxt['Good']['f_goods_price']; ?>円</li>
					<label class="text_in">備考</label>
					<li>
						<?php echo $goodstxt['Good']['f_goods_text']; ?>
					</li>
				</ul>
			</div>
			<?php
	echo $this->Form->create('cartin',array(
		'type'=>'post',
		'url'=>'/carts/add'
	));
echo $this->Form->hidden('goodsid',array('value'=>$goodstxt['Good']['f_goods_id']));
	echo $this->Form->end(
		array(
			'label'=>'カートへ入れる',
			
			'class'=>'orderSubmit submit02'
			
		)
	);
?>

<?php echo $this->Html->link('商品一覧へ戻る',array('controller'=>'Goods','action'=>'goods_list'),array('class'=>'button03 margin20')); ?>
