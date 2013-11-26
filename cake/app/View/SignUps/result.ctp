<!-- result.ctp -->
<?php
	echo $this->Form->create('user', array(
			'type'=>'post',
			'url'=>'result'
			));

	if(empty($this->params->data['button'])){//登録ボタンが押されていなかったら
		echo "<h2>この情報で登録して大丈夫ですか？</h2>";
		
		//var_dump($info);
		echo '名前：'.$info['lastname'].$info['name'].'<br />';
		echo '性別：'.$info['sex'].'<br />';
		echo '学年：'.$info['grade'].'<br />';
		echo '好きなもの：';
		if(!empty($info['fav'])){
		foreach($info['fav'] as $value){
				echo $value;
				echo ', ';
			}
		}

		echo '<br />';
		echo 'コメント：'.$info['comment'].'<br />';
		echo 'パスワード：'.$info['password'].'<br />';
		echo '登録時間：'.$info['time'].'<br />';

		echo $this->Form->submit('登録', array('name'=>'button'));//('登録', array('name'=>'button'));
		echo $this->Form->end();//フォーム終了
	
	}else{
		echo '<h2>登録ありがとうございました。</h2>';
		echo '<br />';
		echo $this->Html->link('最初に戻る',"http://49.212.46.130/~g031k014/cake/SignUps/input");
		//echo '<a href="http://49.212.46.130/~g031k014/cake/SignUps/input">最初に戻る</a>';//不合格部分（HTML記述）
	}

?>