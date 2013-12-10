<div class="hero-unit">
	<?php echo $this->Session->flash('Auth'); ?>
	<?php echo $this->Form->create('User', array('url' => 'login')); ?>
	<?php echo $this->Form->input('User.name', array('label' => 'ユーザー名')); ?>
	<?php echo $this->Form->input('User.password', array('label' => 'パスワード')); ?>
	<?php echo $this->Html->tag('br');?>
	<?php echo $this->Form->end('ログイン'); ?>
	<?php echo $this->Html->tag('br');?>
	<?php echo $this->Form->create('TwLogins', array('action'=>'twitter_login'));?>
    <?php echo $this->Form->end(__('Twitter で Login'));?>
    <?php echo $this->Html->tag('br');?>
    <?php echo $this->Form->create('fbconnects', array('action'=>'facebook'));?>
    <?php echo $this->Form->end(__('Facebook で Login'));?>
    <?php echo $this->Html->tag('br');?>
	<a href="useradd" id="switch" class="label btn-primary">新規登録</a>
</div>