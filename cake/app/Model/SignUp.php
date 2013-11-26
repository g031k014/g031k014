<?php
	class SignUp extends Model{
		public $name = 'SignUp';
		public $userTable = false;

		public function handan($info){
			//$result=array();//無くてもいい宣言
			if($info['sex']=='0'){
				$result['sex']="男";
			}elseif($info['sex']=='1'){
				$result['sex']="女";
			}

			if($info['grade']=='0'){
				$result['grade']="学部１年";
			}elseif($info['grade']=='1'){
				$result['grade']="学部２年";
			}elseif($info['grade']=='2'){
				$result['grade']="学部３年";
			}elseif($info['grade']=='3'){
				$result['grade']="学部４年";
			}else{
				$result['grade']='その他';
			}

			$i = 0;
			foreach($info['fav'] as $value){
				if($value != '0'){
					$result['fav'][$i] = $value;
					$i++;
				}
			}

			$result['lastname']=$info['lastname'];
			$result['name']=$info['name'];
			$result['comment']=$info['comment'];
			$result['password']=$info['password'];
			$result['time']=$info['time'];

			return $result;
		}
	}
?>