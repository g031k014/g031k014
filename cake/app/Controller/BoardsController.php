<?php
class BoardsController extends AppController {
	public $name = 'Boards';
	public $uses = array('Board','User');
	//public $autoRender = false;//デフォルトオフ
	public $layout = "board_layout";//レイアウトを使う
	//public $components = array('Debugkit.Toolbar');//デバッグキットを使う
	
	//認証周り
	public $components = array(
			'DebugKit.Toolbar', //デバッグきっと
			'Auth' => array( //ログイン機能を利用する
				'authenticate' => array(
					'Form' => array(
						'userModel' => 'User',
						'fields' => array('username' => 'email','password' => 'password')
					)
				),
				//ログイン後の移動先
				'loginRedirect' => array('controller' => 'new_boards', 'action' => 'index'),
				//ログアウト後の移動先
				'logoutRedirect' => array('controller' => 'new_boards', 'action' => 'login'),
				//ログインページのパス
				'loginAction' => array('controller' => 'new_boards', 'action' => 'login'),
				//未ログイン時のメッセージ
				'authError' => 'あなたのお名前とパスワードを入力して下さい。',
			)
		);


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
		// $this->Board->del($this->Board->findById($id));//↓の行と同じ働き
		$this->Board->del($id);
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