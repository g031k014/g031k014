
<?php
	echo $this->Html->tag('コメント編集画面');
	if (!empty($data['Board']['comment'])) { // 最初の画面
		echo $this->Form->create() ;//フォーム開始

		echo $this->Form->text('comment', array("value" => $data["Board"]["comment"]));//テキストボックス
		echo $this->Form->hidden("id", array("value" => $data["Board"]["id"]));
		echo $this->Form->submit('送信');//送信ボタン
		echo $this->Form->end();//フォーム終了
	}else{
		echo $this->Form->create(array(
			'action' => 'creatable'
		)) ;//フォーム開始

		echo $this->Html->tag('h2',$edt["Board"]["comment"]);
		echo $this->Html->tag('br');

		echo $this->Form->hidden('comment', array("value" => $edt["Board"]["comment"]));//テキストボックス
		echo $this->Form->hidden("id", array("value" => $edt["Board"]["id"]));

		echo'この内容で投稿してもいいですか？';
		echo $this->Form->submit('送信');//送信ボタン
		echo $this->Form->end();//フォーム終了
	}
?>