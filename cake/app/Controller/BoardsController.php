<?php
class BoardsController extends AppController {
	public $name = 'Boards';
	public $uses = array('Board');
	public $layout = "board_layout";
	//public $components = array('Debugkit.Toolbar');
	//public $autoRender = false;//デフォルトオフ

	public function index(){
		$this->set('data', $this->Board->find('all'));
	}

	public function edit($id){
		if(!empty($this->request->data)){//ポスト送信されたら  //※issetだと×
			$this->set('edt', $this->request->data);//ビューに値を受け渡す
		}else{
			$this->set("data", $this->Board->findById($id));
		}
	}

	public function del($id){
		$this->Board->del($this->Board->findById($id));
		$this->redirect(array("action" => "index"));
	}

	public function create(){
		if(isset($this->request->data)){//ポスト送信されたら
			$com = $this->request->data;
			$this->set('com', $com);//ビューに値を受け渡す
		}
	}

	public function creatable(){
		$this->Board->db_connect($this->request->data);
		$this->redirect(array("action" => "index"));
	}
}
?>