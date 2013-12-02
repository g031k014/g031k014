<?php

	echo $this->Html->link('ログアウト',array('controller' => 'Boards', 'action' => 'login'));
	echo $this->Html->tag('br');

	echo $this->Html->link('投稿する', array('controller' => 'Boards', 'action' => 'create'));
	echo $this->Html->tag('br');
	echo $this->Html->tag('br');


	//コメント検索機能の追加
	 //キーワード検索
	 //検索件数の指定
	 //昇順、降順の指定




	//投稿したコメントに投稿したユーザの名前とメアドを表示させる
	//投稿したユーザのみが編集、削除をできるようにする

	foreach ($data as $key => $value) {
		if(!empty($value["Board"]["comment"])){
			echo $value["Board"]["id"].' : ';
			echo $value["Board"]["comment"].' ';
			echo $value["Board"]["timestamp"].' ';
			echo $this->Html->link('編集', array(
					'action' => 'edit', 
					$value["Board"]["id"]
				)).' ';
			echo $this->Html->link('削除', array(
					'action' => 'del', 
					$value["Board"]["id"]
				));
			echo $this->Html->tag('br');
		}
	}
?>