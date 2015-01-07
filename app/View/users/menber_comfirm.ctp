<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width" />
	<title>Kamemiブランドサイト</title>
	<link rel="stylesheet" media="all" href="css/common.css" />
	<link rel="stylesheet" media="all" href="css/menber_comfirm.css" />
	<script src="scripts/respond.min.js"></script>
</head>
<body>

	<div class="container row">
		<header role="banner" class="row clearfix">
			<img src="images/kamemirogo.png" id="kamemilogo"/>
			<div id="ulcopy">
				<span>ねぼすけホシガメブランド</span>
				<ul id="navi">
				<li><a href="index.html">トップページ</a></li>
				<li><a href="#">商品</a></li>
				<li><a href="#">ＤＭ</a></li>
				<li><a href="#">会員</a></li>
				<li><a href="#">カート</a></li>
				</ul>
			</div>
		</header>
		<div id="title"><span>登録確認</span></div>
		<main>
			<form class="row">
				<lavel for="t1">名前</lavel>
				<input type="text" name="s_name" id="t1" value="カメ美" disabled="disabled" >
				<lavel>電話番号</lavel>
				<input type="text" name="s_tel" value="aa" disabled="disabled" >
				<lavel>郵便番号</lavel>
				<input type="text" name="s_post" value="aa" disabled="disabled" >
				<lavel>住所</lavel>
				<input type="text" name="s_add" value="aa" disabled="disabled" >
				<lavel>メールアドレス</lavel>
				<input type="text" name="s_mail" value="aa" disabled="disabled" >
				<lavel>パスワード</lavel>
				<input type="password" name="s_pass" value="aa" disabled="disabled" >
				<lavel>DM希望</lavel>
				<input type="checkbox" name="s_dm" id="ck_box" disabled="disabled" checked>
				
				<div id="dm_span">チェックをつけるとDMが郵送されます</div>
				<div id="bt_box">
					<input type="submit" value="修正" class="button01" />
					<input type="submit" value="登録" class="button01" />
				</div>
				
			</form>
		</main>
		
		<footer role="contentinfo" class="row">
		
			Copylight &#169; 2014.HOSHIgame inc. All Rights Reserved.
		
		</footer>
	</div>

</body>
</html>