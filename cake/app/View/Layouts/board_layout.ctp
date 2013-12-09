<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		
		echo $this->Html->css('bootstrap.min');
		//echo $this->Html->css('cake.generic');
		echo $this->Html->css('board');//.css前の名前を書く
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div class="container">
		<div id="header">
			<?php echo $this->Html->tag('br'); ?>
			<?php echo $this->Html->tag('h1','掲示板')?>
		</div>
		<div id="content">
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
			<?php echo $this->Html->tag('br'); ?>
		</div>
		<div id="footer">
	
			<?php echo $this->Html->tag('br'); ?>
			
		</div>
	</div>
</body>
</html>
