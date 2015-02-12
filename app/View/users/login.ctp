<?php echo $this->Html->css('login', array( 'inline' => false)); ?>
		<div id="title"><span>ログイン</span></div>
		<main>
				<?php

echo $this->Form->create('login');
echo $this->Form->input('f_cust_mail',array('label' => 'メールアドレス','class'=>''));

echo $this->Form->input('f_cust_pass',array('label' => 'パスワード','type'=>'password'));
					echo $this->Form->end('ログイン');
				?>
			<?php
				if (isset($errors)){
			?>
			<ul>
			<?php foreach($errors as $error){ ?>
				<li><?php echo($error); ?></li>
			<?php
				}
			?>
			</ul>
<?php }
		?>
				<!--<div id="dm_span">パスワードを忘れたら</div>-->


		</main>