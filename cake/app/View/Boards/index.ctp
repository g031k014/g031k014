<?php

	//debug($data);//デバッグ
	//echo $this->Html->link('ログアウト',array('controller' => 'Boards', 'action' => 'logout'));
	echo $this->Html->link('ログアウト', array('action' => 'logout'));
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
	//echo $this->Form->button('test', array('class'=>'btn btn-primary'));
	echo $this->Form->end('検索', array('class'=>'label btn-primary', 'type'=>'button'));
	echo $this->Html->tag('br');

	echo '※Twitterでログインした場合は、アドレスが表示されません。';
	echo $this->Html->tag('br');
	echo $this->Html->tag('br');

	echo $this->Paginator->sort('id','IDでソート').'　';//IDでソート
	//echo $this->Paginator->sort('created','Created');//時間でソート
	echo $this->Html->tag('br');
	echo '※クリックで昇順、降順を変えることができます';
	echo $this->Html->tag('br');
	echo $this->Html->link('元へ戻す', array('action' => 'index')).'　';
	echo $this->Html->tag('br');
	echo $this->Html->tag('br');

	//var_dump($data);
	foreach ($data as $key => $value) {
		if(!empty($value["Board"]["comment"])){
			echo $value["Board"]["id"].' : ';
			//投稿したコメントに投稿したユーザの名前とアドレスを表示させる
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
			echo $this->Html->link('×', array(
					'action' => 'del', 
					$value["Board"]["id"]
				));
		}
			echo $this->Html->tag('br');
			echo $this->Html->tag('br');
	 	}
	 }


	echo $this->Paginator->prev(' << ' . __('前へ'), array(), null, array('class' => 'prev disabled'));
	echo ' '.$this->Paginator->numbers().' ';//ページにジャンプ
	echo $this->Paginator->next(' >> ' . __('次へ'), array(), null, array('class' => 'next disabled'));
	echo '   データ数['.$this->Paginator->params()["count"].']';//データ数表示
	echo $this->Html->tag('br');
	
?>