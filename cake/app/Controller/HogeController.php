<?php
 class HogeController extends AppController {
 	public $name = "Hoge"; //クラス名を指定
 	public $components = array('DebugKit.Toolbar'); //DebugKitの適用
 
 	public function index(){//indexアクション
		//http://ドメイン名/cake/hoge/index/
		//ここにページに必要な処理を記述
		//通常のphpの記述をここで書けます。
 	}

 	public function show(){//showアクション
 		if($this->request->is('POST')){//POST送信されたかどうか
 			$jikan = $this->request->data['Aisatsu']['jikan'];
 			if($jikan == '朝'){
 				$mes = 'おはよう';
 			}elseif($jikan == '夜'){
 				$mes = 'こんばんは';
 			}else{
 				$mes = 'こんにちは';
 			}
 			$this->set('say', $mes); //ビューに値を受け渡す
 		}else{//URLで直接アクセスした人など
 			$this->flash(
 				'inputアクションからきてください',
 				array(
					'controller' => 'hoge',
					'action' => 'input'
 					)
 				);
 		}
 	}

 	public function input(){
		//http://ドメイン名/cake/hoge/index/
 	}
 }