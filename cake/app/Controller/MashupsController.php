<?php
	class MashupsController extends AppController{
		public $name = "Mashups";
		public $components = array('DebugKit.Toolbar');
		public function index(){
			$result = $this->Mashup->api();
			$this->set("result",$result);
		}
	}
?>