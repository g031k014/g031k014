<?php

	//debug($data);//デバッグ
	echo $this->Html->link('ログアウト',array('controller' => 'Boards', 'action' => 'logout'));
	echo $this->Html->tag('br');
	echo $this->Html->tag('br');

	echo $this->Html->link('投稿する', array('controller' => 'Boards', 'action' => 'create'));
	echo $this->Html->tag('br');
	echo $this->Html->tag('br');


	echo $this->Form->create();
	echo 'キーワード検索';
	echo $this->Form->text('words');
	echo $this->Html->tag('br');
	echo '検索件数';
	$options = array(1,2,3,4,5,6,7,8,9,10);
	echo $this->Form->select('num', $options, array('empty' => false));
	echo $this->Html->tag('br');
	echo $this->Form->end('検索');
	echo $this->Html->tag('br');

	echo 'ソート';
	echo $this->Paginator->sort('id','ID').'　';//IDでソート
	echo $this->Paginator->sort('created','Created');//時間でソート
	echo $this->Html->tag('br');
	echo $this->Html->tag('br');
	echo $this->Html->link('一覧に戻る',array('controller' => 'Boards', 'action' => 'index'));
	echo $this->Html->tag('br');
	echo $this->Html->tag('br');

	//var_dump($data);
	foreach ($data as $key => $value) {
		if(!empty($value["Board"]["comment"])){
			//echo $value["Board"]["id"].' : ';
			//投稿したコメントに投稿したユーザの名前とメアドを表示させる
			echo 'ユーザ名：'.$value["User"]["name"].'　,　';
			echo 'アドレス：'.$value["User"]["email"];
			echo $this->Html->tag('br');
			echo 'コメント：'.$value["Board"]["comment"].'　';
			echo $value["Board"]["created"].' ';

			//投稿したユーザのみが編集、削除をできるようにする
			if($user['id'] == $value['Board']['user_id']){
			echo $this->Html->link('編集', array(
					'action' => 'edit', 
					$value["Board"]["id"]
				)).' ';
			echo $this->Html->link('削除', array(
					'action' => 'del', 
					$value["Board"]["id"]
				));
		}
			echo $this->Html->tag('br');
			echo $this->Html->tag('br');

		}
	}
?>