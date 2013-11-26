<!-- input.ctp -->
<h2>ユーザー登録フォーム</h2>
<?php
	echo $this->Form->create('signup', array(
		'type' => 'post',
		'url' => 'result'//Controller function resultに入力されたものを飛ばす
	));//フォーム開始

	echo '<br />名字<br />';
	echo $this->Form->text('signup.lastname');//テキストボックス
	echo '<br />';

	echo '<br />名前<br />';
	echo $this->Form->text('signup.name');
	echo '<br />';

	echo '<br />性別<br />';
	echo $this->Form->radio('signup.sex',
		array("0"=>'男', "1"=>'女'),
		array('legend'=>false, 'label'=>true, 'value'=>'1'));//初期値設定

	echo '<br />学年<br />';
	echo $this->Form->select('signup.grade',
		array('学部１年','学部２年','学部３年','学部４年'),
		array('value'=>'1'));//初期選択値
	echo '<br />';

	echo '<br />好きなもの<br />';
	echo $this->Form->checkbox('signup.fav.exe', array('checked'=>true,'value'=>'運動'));
	echo $this->Form->label('signup.運動');
	echo $this->Form->checkbox('signup.fav.com', array('checked'=>false,'value'=>'漫画'));
	echo $this->Form->label('signup.漫画');
	echo $this->Form->checkbox('signup.fav.girl', array('checked'=>true,'value'=>'女の子'));
	echo $this->Form->label('signup.女の子');

	echo '<br />コメント<br />';
	echo $this->Form->textarea('signup.comment',
		array('cols'=>40, 'rows'=>3));
	echo '<br />';

	echo '<br />パスワード<br />';
	echo $this->Form->text('signup.password', array('type'=>'password'));

	echo $this->Form->hidden('signup.time', array('value'=>date("Y/m/d H:i:s")));//隠しフィールド

	echo $this->Form->submit('submit');
	echo $this->Form->end();//フォーム終了
?>
