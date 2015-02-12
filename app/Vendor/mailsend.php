<?php
public function mailsend($mail_to,$name,){
	$mail_to="olion-7-leo@i.softbank.jp";
	$images=IMAGES."topimage.jpg";
	//
	//$images = array('file' => $imagepath,
	//						'mimetype' => mime_content_type($imagepath),
	//						'contentId' => "image01"
	//					   );
	$name="ayaka";
	$cid="image01";
	$mail_subject="注文番号【】自動送信メール";
	$email = new CakeEmail( 'gmail');                        // インスタンス化
	$email->from( array( 'pocchi13.tr@gmail.com' => 'Kamemiブランドサイト'));  // 送信元
	$email->attachments($images);
	$email->to($mail_to);                      // 送信先
	$email->subject($mail_subject);                      // メールタイトル
	$email->emailFormat('html');
	// フォーマット
	$email->template('templete');               // テンプレートファイル
	$email->viewVars( compact( 'name','cid'));             // テンプレートに渡す変数

	$email->send();                             // メール送信


}

?>