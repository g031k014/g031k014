<?php
class BoardsController extends AppController {
	public $name = 'Boards';
	public $uses = array('Board','User');
	//public $autoRender = false;//デフォルトオフ
	public $layout = "board_layout";//レイアウトを使う
	//public $components = array('Debugkit.Toolbar');//デバッグキットを使う
	
	//認証周り
	public $components = array(
            'DebugKit.Toolbar', //デバッグキット
            'Auth' => array( //ログイン機能を利用する
                'authenticate' => array(
                    'Form' => array(
                        'userModel' => 'User',
                        'fields' => array('username' => 'name','password' => 'password')
                    )
                ),
                //ログイン後の移動先
                'loginRedirect' => array('controller' => 'Boards', 'action' => 'index'),
                //ログアウト後の移動先
                'logoutRedirect' => array('controller' => 'Boards', 'action' => 'login'),
                //ログインページのパス
                'loginAction' => array('controller' => 'Boards', 'action' => 'login'),
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

	public function beforeFilter(){//login処理の設定
             $this->Auth->allow('login','logout','useradd');//ログインしないで、アクセスできるアクションを登録する
             $this->set('user',$this->Auth->user()); // ctpで$userを使えるようにする 。
        }

	public function login(){//ログイン
			if($this->request->is('post')){//POST送信なら
				if($this->Auth->login()){//ログイン成功なら
					//$this->Session->delete('Auth.redirect'); //前回ログアウト時のリンクを記録させない
					return $this->redirect($this->Auth->redirect()); //Auth指定のログインページへ移動
				}else{ //ログイン失敗なら
					$this->Session->setFlash(__('ユーザ名かパスワードが違います'), 'default', array(), 'auth');
				}
			}
		}

		public function logout(){
			$this->Auth->logout();
			$this->Session->destroy(); //セッションを完全削除
			$this->Session->setFlash(__('ログアウトしました'));
			$this->redirect(array('action' => 'login'));
		}

		public function useradd(){
			//POST送信なら
			if($this->request->is('post')) {
				//パスワードとパスチェックの値をハッシュ値変換
				$this->request->data['User']['password'] = AuthComponent::password($this->request->data['User']['password']);
				$this->request->data['User']['pass_check'] = AuthComponent::password($this->request->data['User']['pass_check']);
				//入力したパスワートとパスワードチェックの値が一致
				if($this->request->data['User']['pass_check'] === $this->request->data['User']['password']){		
					$this->User->create();//ユーザーの作成
					$mse = ($this->User->save($this->request->data))? '新規ユーザーを追加しました' : '登録できませんでした。やり直して下さい';
					$this->Session->setFlash(__($mes));
				}else{
					$this->Session->setFlash(__('パスワード確認の値が一致しません．'));
				}
				$this->redirect(array('action' => 'login'));//リダイレクト	
			}
		}

}
?>