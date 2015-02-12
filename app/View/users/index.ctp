<?php //echo $this->Html->script(array('script1', 'script2'), array('inline'=>false)); ?>
<?php echo $this->Html->css('index', array( 'inline' => false)); ?>
<!-- include end -->
		<main role="main" class="row gutters">
			<aside role="complimentary" class="col span_13" id="topimage">
				<?php echo $this->Html->image('topimage.jpg', array('alt' => 'kamemiイメージ','id'=>'')); ?>
			</aside>
			<article class="col span_14" id="text1">
				<?php echo $this->Html->image('kamemirogo.png', array('alt' => 'kamemiロゴ2','id'=>'kamemilogo_mini2')); ?>
				<span id="te1">は<br /></span>
				
				<span id="te2">
				カメ好きのための<br />
				カメだらけのブランドです。</span>
				<?php echo $this->Html->link('>>商品を見る',array('controller'=>'goods','action'=>'goods_list')); ?>
			</article>
		</main>
		<div id="sub" role="main" class="row gutters subcontents">
			<div class="subcon col span_17 firstco ">
				<h2>更新情報</h2>
				<div class="news">
					<ul>
						<li>
							<span class="newsDay">11月12日(水)</span><br />
							<span class="newsIn">トップページ制作中！</span>
						</li>
						<li>
							<span class="newsDay">11月10日(月)</span><br />
							<span class="newsIn">商品制作中！</span>
						</li>
						<li>
							<span class="newsDay">11月9日(日)</span><br />
							<span class="newsIn">鋭意制作中！</span>
						</li>
					</ul>
				</div>
			</div>
			<div class="subcon col span_18 ">
				<h2>商品情報</h2>
				<div class="news">
					<ul>
						<li>
							<span class="newsDay">2月3日(火)</span><br />
							<span class="newsIn">エコバッグM登場！</span>
						</li>
						<li>
							<span class="newsDay">2月1日(日)</span><br />
							<span class="newsIn">エコバッグS（べっこう）登場！</span>
						</li>
						<li>
							<span class="newsDay">1月29日(木)</span><br />
							<span class="newsIn">エコバッグS（プレーン）登場！</span>
						</li>
					</ul>
				</div>
				
			</div>
			<div class="subcon col span_17 ">
				<h2>-</h2>
			</div>
		</div>

