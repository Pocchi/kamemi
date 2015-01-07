<?php //echo $this->Html->script(array('script1', 'script2'), array('inline'=>false)); ?>
<?php echo $this->Html->css('goods_list', array( 'inline' => false)); ?>
<!-- include end -->
	<div id="title"><span>商品リスト</span></div>
	<!-- カラムスタート -->
	<main id="wrapper" class="row">
		<div id="left" class="col span_19"><!-- left start -->
			<div id="leftin" class=""><!-- leftin start -->
				<ul>
					<li>カテゴリ</li>
					<li><a href="#">エコバッグ</a></li>
					<li>スマホケース</a><span class="kategoryComment">準備中！</li>
				</ul>
		</div><!-- leftin end -->
		<div id="kame"><div id="kame"><?php echo $this->Html->image('kamemi.png', array('alt' => 'kamemiイメージ','id'=>'')); ?></div>
		</div>
		</div><!-- left end -->

	<div id="right" class="col span_20"><!-- right start -->
<?php
foreach($goods as $good):
//debug($good);
?>
		<div role="main" class="row gutters listbox"><!-- カラムスタート -->
			<div role="complimentary" class="col span_13 listimg">
				<?php echo $this->Html->image($good['Good']['f_goods_id']."-1.png", array('alt' => 'kamemiイメージ','id'=>'')); ?>
			</div>
			<div class="col span_14 listtxt">
				<ul>
					<li><?php echo $good['Good']['f_goods_name'] ?></li>
					<li><?php echo $good['Good']['f_goods_size'] ?></li>
					<li><?php echo $good['Good']['f_goods_price']."円" ?></li>
					<li><?php echo $this->Html->link('詳細',array('controller'=>'Goods','action'=>'goods_detail',$good['Good']['f_goods_id'])); ?></li>
				</ul>
			</div>
		</div>

<?php
//htmlspesialcharsの省略
//echo h($good['Good']['f_goods_id']);
				
 endforeach; ?>
 
	</div><!-- right end -->
	</main>