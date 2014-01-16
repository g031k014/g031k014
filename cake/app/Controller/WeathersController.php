<?php
class WeathersController extends AppController {
	public $name = 'Weathers';
	public $uses = array('Board', 'User');
	public $layout = "weather_layout";
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
				'loginRedirect' => array('controller' => 'Weathers', 'action' => 'index'),
				//ログアウト後の移動先
				'logoutRedirect' => array('controller' => 'Weathers', 'action' => 'login'),
				//ログインページのパス
				'loginAction' => array('controller' => 'Weathers', 'action' => 'login'),
				//未ログイン時のメッセージ
				'authError' => 'あなたのお名前とパスワードを入力して下さい。',
			)
		);
	public $paginate = array(
			'limit' => 10,
        	'order' => array('Board.id' => 'desc')
 	    );

	public function index(){
		if(!empty($this->request->query['words'])){//検索
			$WORDS = $this->request->query['words'];
			$NUM = $this->request->query['num']+1;
			$conditions = array('conditions' => array("Board.comment LIKE" => "%$WORDS%"), 'limit' => $NUM);
			$this->Session->write("conditions", $conditions);
			$this->paginate = $conditions;
			$search = $this->paginate('Board');
			$this->set('data', $search);
		}else{
			//$this->set('data', $this->Board->find('all'));
			if (empty($this->request->query['words'])){
				$this->Session->delete('conditions');
			}
			if (!($this->Session->read('conditions'))){
				$this->set('data', $this->paginate('Board'));
			}else{
				$this->paginate = $this->Session->read('conditions');
				$this->set('data', $this->paginate('Board'));
			}
		}
	}

	public function edit($id){
		if(!empty($this->request->data)){//ポスト送信されたら
			$this->set('edt', $this->request->data);//ビューに値を受け渡す
		}else{
			$this->set("data", $this->Board->findById($id));
		}
	}

	public function del($id){
		$this->Board->delete($id);
		$this->redirect(array('controller' => 'Weathers', 'action' => 'index'));
	}

	public function create(){
		if(!empty($this->request->data)){//ポスト送信されたら
			$com = $this->request->data;
			$this->set('com', $com);//ビューに値を受け渡す
		}
	}

	public function creatable(){
		$this->request->data['Board']['user_id'] = $this->Auth->user('id');
		$this->Board->save($this->request->data);
		$this->redirect(array('controller' => 'Weathers', 'action' => 'index'));
	}

	public function beforeFilter(){//login処理
		//モバイルからのリクエストの場合
		if($this->request->is('mobile')){
			//テーマをJqm、レイアウトをjqmに指定します。
			$this->theme = 'M_boards';
			$this->layout = 'M_boards';
		}
		$this->Auth->allow('login', 'logout', 'useradd');//loginしなくてもいいところ
		$this->set('user', $this->Auth->user());//
	}

	public function login(){
		if($this->request->is('post')){//POST送信したら
			if($this->Auth->login()){//login成功したら
				return $this->redirect($this->Auth->redirect());//loginページへ移動
			}else{
				$this->Session->setFlash(__('ユーザ名もしくはパスワードが違います'), 'default', array(), 'auth');
			}
		}
	}

	public function logout(){
		$this->Auth->logout();
		$this->Session->destroy();//sessionをリセット
		$this->Session->setFlash(__('ログアウトしました'));
		$this->redirect(array('action' => 'login'));
	}

    public function useradd(){
        if($this->request->is('post')) {//POST送信なら
	        //入力したパスワートとパスワードチェックの値が一致
	        if($this->request->data['User']['pass_check'] === $this->request->data['User']['password']){
	        	$this->User->set($this->request->data);
            	if($this->User->validates()){ //エラーがなければ
            		//パスワードとパスチェックの値をハッシュ値変換
					$this->request->data['User']['password'] = AuthComponent::password($this->request->data['User']['password']);
			    	$this->request->data['User']['pass_check'] = AuthComponent::password($this->request->data['User']['pass_check']);
			    	$this->User->create();//ユーザーの作成
		    		$mes = ($this->User->save($this->request->data))? '新規ユーザーを追加しました' : '登録できませんでした。やり直して下さい';
					$this->Session->setFlash(__($mes));
				    $this->redirect(array('action' => 'login'));//リダイレクト
	       		}
	        }else{
	            $this->Session->setFlash(__('パスワード確認の値が一致しません．'));
	        }
        }
    }
}
?>