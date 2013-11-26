<!-- SignUpsController.php -->
<?php
 class SignUpsController extends AppController {
 	public $name = "SignUps"; //クラス名を指定
 	public $useTable = false;
 	public $components = array('DebugKit.Toolbar'); //DebugKitの適用
 
 	public function input(){
 	}

 	public function result(){
 		if($this->request->is('POST')){
 			if(!empty($this->request->data['signup'])){
 				$info2=$this->SignUp->handan($this->request->data['signup']);
 				$this->set('info', $info2);
 			}
 		}
 	}
}
?>