<?php
	echo $mes;
	echo $this->Html->tag('br');
	foreach($data as $key => $value){
		echo $value['Board']['comment'];
		echo " ";
		echo $value['Board']['created'];
		echo " ";
		echo $this->Html->link('編集','edit/'.$value['Board']['id']);
		echo " ";
		echo $this->Html->link('×','delete/'.$value['Board']['id']);
		echo $this->Html->tag('br');
	}
?>