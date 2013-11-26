<?php
	if (empty($this->params->data['Board']['comment'])) {
		echo '投稿内容';
		echo $this->Form->create() ;//フォーム開始
		
		echo $this->Form->text('comment');//テキストボックス

		echo $this->Form->submit('投稿');//送信ボタン
		echo $this->Form->end();//フォーム終了
	}else{
		echo $this->Form->create(array(
			'action' => 'creatable'
		)) ;//フォーム開始

		echo $this->Form->hidden("comment", array("value" => $com["Board"]["comment"]));
		echo $this->Html->tag('h2',$com["Board"]["comment"]);
		echo $this->Html->tag('br');
		echo'この内容で投稿してもいいですか？';
		echo $this->Form->submit('送信');//送信ボタン
		echo $this->Form->end();//フォーム終了
	}
?>
