<div class="hero-unit">
	<?php
		echo $this->Session->flash('Auth');
		echo $this->Form->create('User', array('url' => 'login'));
		echo $this->Form->input('User.name', array('label' => 'ユーザー名'));
		echo $this->Form->input('User.password', array('label' => 'パスワード'));
		echo $this->Form->end('ログイン');
		// echo $this->Form->create('TwLogins', array('Controller'=>'Tw_weather', 'action'=>'twitter_login'));
  //   	echo $this->Form->end(__('Twitter で Login'));
    	// echo $this->Form->create('Fbconnects', array('action'=>'facebook'));
    	// echo $this->Form->end(__('Facebook で Login'));
		echo $this->Html->tag('br');
		echo $this->Html->tag('br');
		
	?>
	<a href="useradd" id="switch" class="label btn-primary">新規登録</a>
</div>