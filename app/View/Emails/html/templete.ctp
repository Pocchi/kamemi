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
 * @package       app.View.Emails.html
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<?php
//$content = explode("\n", $content);
foreach ($send_email3 as $name):
?>
<p><?php echo $name['users']['購入者名'];?>様</p>
<?php
endforeach;
?>
<p>ご購入ありがとうございます。</p>
<p>【　商品　】</p>
<?php
foreach ($send_email as $goods):
?>
	<?php echo $goods['goods']['商品名'];?>:
	<?php echo $goods['orders_details']['数量'];?>個　
	<?php echo $goods['orders_details']['価格'];?>円
<?php
endforeach;
?>
<hr />
<p>計  <?php echo $orderprice;?>円</p>
<p>【　送付先　】</p>
<?php
foreach ($send_email2 as $sends):?>
<p><?php echo $sends['sends']['送付先名'];?>様</p>
<p>〒<?php echo $sends['sends']['郵便番号'];?></p>
<p><?php echo $sends['sends']['住所'];?></p>
<p>TEL:<?php echo $sends['sends']['電話番号'];?></p>
<?php	endforeach;
?>
<hr />
<p>kamemiブランドサイト</p>
<p>http://kamemi.hungry.jp/kamemi/Users</p>
