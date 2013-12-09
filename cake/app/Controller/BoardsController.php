<?php
class BoardsController extends AppController {
	public $name = 'Boards';
	public $uses = array('Board','User');
	//public $autoRender = false;//デフォルトオフ
	//public $layout = "board_layout";//レイアウトを使う
	
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

	// public $pagenate = array(
	// 	'limit' => 10,
	// 	'order' =>array('Board.id' => 'asc')
	// 	);


	 public function index(){
            if(!empty($this->request->data['Board']['words'])){
                $WORDS = $this->request->data['Board']['words'];
                $NUM = $this->request->data['Board']['num']+1;
                $conditions = array('conditions' => array("Board.comment LIKE" => "%$WORDS%"), 'limit' => $NUM);
                $this->Session->write("conditions", $conditions);
                $this->paginate = $conditions;
                $search = $this->paginate('Board');
                $this->set('data', $search);
            }else{
                    if (empty($this->request->params['named']['page'])){
                            $this->Session->delete('conditions');
                    }
                    if (!($this->Session->read('conditions'))){
                    		$this->paginate =  array('limit' => 10);
                            $this->set('data', $this->paginate('Board'));
                    }else{
                            $this->paginate = $this->Session->read('conditions');
                            $this->set('data', $this->paginate('Board'));
                    }
            }
        }

	public function edit($id){
		if(!empty($this->request->data)){//ポスト送信されたら  //※issetだと×
			$this->set('edt', $this->request->data);//ビューに値を受け渡す
		}else{
			$this->set("data", $this->Board->findById($id));
		}
	}

	public function del($id){
		$this->Board->delete($id);
		$this->redirect(array("action" => "index"));
	}

	public function create(){
		if(isset($this->request->data)){//ポスト送信されたら
			$com = $this->request->data;
			$this->set('com', $com);//ビューにunkonow値を受け渡す
		}
	}

	public function creatable(){
		$this->request->data['Board']['user_id']=$this->Auth->user('id');
		$this->Board->db_connect($this->request->data);
		$this->redirect(array("action" => "index"));
	}

	public function beforeFilter(){//login処理の設定
             $this->Auth->allow('login','useradd');//ログインしないで、アクセスできるアクションを登録する
             $this->set('user',$this->Auth->user()); // ctpで$userを使えるようにする 。
    }

	public function login(){//ログイン
			if ($this->Auth->user()){//リダイレクション（ログアウトせずに出ようとした場合）
				$this->redirect(array('action' => 'index'));
			}
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
		if ($this->Auth->user()){//リダイレクション（ログアウトせずに出ようとした場合）
				$this->redirect(array('action' => 'index'));
			}
		//POST送信なら
		if($this->request->is('post')) {
			//パスワードとパスチェックの値をハッシュ値変換
			if ($this->request->data['User']['password'] === $this->request->data['User']['pass_check']){
				$data = $this->request->data;//入力した値を一旦$dataへ

				$data['User']['password'] = AuthComponent::password($data['User']['password']);
				$this->User->create();//ユーザーの作成
				if ($this->User->save($data)){
					$mes = "新規ユーザを追加しました。"	;
					$this->Session->setFlash(__($mes));
					$this->redirect(array('action' => 'index'));
				}else{
					$this->Session->setFlash(__('登録できませんでした'));
				}
			}else{
				$this->Session->setFlash(__('パスワード確認の値が一致しません．'));
			}
			//$this->redirect(array('action' => 'login'));//リダイレクト	
		}
	}

}
?>