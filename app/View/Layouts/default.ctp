<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())

?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width" />
	<?php echo $this->Html->charset("utf-8"); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php echo $scripts_for_layout; ?>
	<?php echo $this -> fetch( 'css-embedded' ); ?>
	<?php echo $this->Html->script( 'respond.min', array( 'inline' => true)); ?>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('common');
		echo $this->fetch('meta');
		echo $this->fetch('css');
echo $this->Html->script( 'jquery-1.9.1.min', array('inline'=> true));
		echo $this->fetch('script');
	?>
    
</head>
<body>
	<div id="container">
		<div id="userarea">
		</div>
		<div class="container row">
			<header role="banner" class="row clearfix">
				<?php echo $this->Html->link($this->Html->image('kamemirogo.png'),array('controller'=>'Users','action'=>'index'),array('escape'=>false,'id'=>'kamemilogo'));?>
				<div id="ulcopy">
				
					<span>ねぼすけホシガメブランド</span>
					<ul id="navi">
						<li><?php echo $this->Html->link('トップ',array('controller'=>'Users','action'=>'index')); ?></li>
						<li><?php echo $this->Html->link('商品',array('controller'=>'goods','action'=>'goods_list')); ?></li>
						<li><?php echo $this->Html->link($loglink,array('controller'=>'users','action'=>$logaction)); ?></li>
						<li><?php echo $this->Html->link($menberlink,array('controller'=>'users','action'=>$menberaction)); ?></li>
						<li><?php echo $this->Html->link('カート',array('controller'=>'carts','action'=>'cart')); ?></li>
					</ul>
				</div>

				<div id="nameid"><?php echo $userId; ?></div>
				<div id="namename"><?php echo $userName."さん"; ?></div>
			</header>
			
		<div id="content">

			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
			<?php echo $histry; ?>
		</div>
			<footer role="contentinfo" class="row">

				Copylight &#169; 2014.HOSHIgame inc. All Rights Reserved.

			</footer>
		</div>
<div style="bacKground: black;">
<?php
echo $this->element('sql_dump');
 ?>
	<script>
		$(function(){
			setTimeout(function(){
				$('#flashMessage').fadeOut("slow");
			},800);
		});
	</script>
</div>
</body>
</html>
