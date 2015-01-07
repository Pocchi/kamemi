<?php //echo $this->Html->script(array('script1', 'script2'), array('inline'=>false)); ?>
<?php echo $this->Html->css('index', array( 'inline' => false)); ?>
<!-- include end -->
		<main role="main" class="row gutters">
			<aside role="complimentary" class="col span_13" id="topimage">
				<?php echo $this->Html->image('topimage.jpg', array('alt' => 'kamemiイメージ','id'=>'')); ?>
			</aside>
			<article class="col span_14" id="text1">
				<?php echo $this->Html->image('kamemirogo.png', array('alt' => 'kamemiロゴ2','id'=>'kamemilogo')); ?>
				<span id="te1">は<br /></span>
				
				<span id="te2">
				カメ好きのための<br />
				カメだらけのブランドです。</span>
				<a href="#">>>商品を見る</a>
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
			</div>
			<div class="subcon col span_17 ">
				<h2>-</h2>
			</div>
		</div>

