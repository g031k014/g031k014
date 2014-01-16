<?php
		
	//debug($data);
	echo $this->Form->create(array('type' => 'get'));
	echo '検索ワード';
	echo $this->Form->text('words');
	echo $this->Html->tag('br');
	echo '検索件数';
	$options = array(1,2,3,4,5,6,7,8,9,10);
	echo $this->Form->select('num', $options, array('empty' => false));
	echo $this->Html->tag('br');
	echo $this->Form->end('検索');
	echo $this->Html->tag('br');

	echo 'ソート';
	echo $this->Paginator->sort('created', 'Created', array('direction' => 'asc'));//時間でソート
	echo $this->Html->tag('br');
	echo $this->Html->tag('br');
	echo $this->Html->link('TOPへ', array('action' => 'index')).'　';
	
	echo $this->Html->link('投稿する', array('controller' => 'Weathers', 'action' => 'create'));
	echo $this->Html->tag('br');

	//debug($data);

	foreach ($data as $key => $value) {
		echo $value["Board"]["id"].' : ';
		echo $value["User"]["name"];
		echo $this->Html->tag('br');
		echo $value["Board"]["comment"].' ';
		//echo $this->Html->tag('br');
		//echo '　　　'.$value["User"]["email"].' ';
		//echo $value["Board"]["created"].' ';
		if(!empty($user["id"])){
			if($user["id"] === $value['Board']['user_id']){//ログインしたユーザーの書き込み
				echo $this->Html->link('編集', array(
						'action' => 'edit', 
						$value["Board"]["id"]
					)).' ';
				echo $this->Html->link('削除', array(
						'action' => 'del', 
						$value["Board"]["id"]
					));
			}
		}
		echo $this->Html->tag('br');
		echo $this->Html->tag('br');
	}

	echo $this->Paginator->prev(' << ' . __('前へ'), array(), null, array('class' => 'prev disabled'));
	echo ' '.$this->Paginator->numbers().' ';
	echo $this->Paginator->next(' >> ' . __('次へ'), array(), null, array('class' => 'next disabled'));
	echo '   データ数['.$this->Paginator->params()["count"].']';

	echo $this->Html->tag('br');
	echo $this->Html->link('ログアウト', array('action' => 'logout'));
?>