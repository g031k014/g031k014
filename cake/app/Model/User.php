<?php
    class User extends Model{
        public $name = 'User';
 
        public $validate = array(
            'name' => array(
                'between' => array(
                    'rule' => array('between',0,10),
                    'required' => true,
                    'allowEmpty' => false,
                    'message' => '10文字以内で必ず入力して下さい'
                ),
                'custom' => array(
                    'rule' => array('custom','/^[a-zA-Z]+$/'),
                    'message' => '半角英字のみで入力してください'
                ),
                'unique' => array(
                    'rule' => 'isUnique',
                    'message' => 'そのユーザー名は既に使われています'
                    )
                ),
            'email' => array(
                'rule' => 'email',
                'required' => true,
                'allowEmpty' => false,
                'message' => 'メールアドレスの形式で必ず入力して下さい'
                ),
            'password' => array(
                'rule' => 'alphaNumeric',
                'required' => true,
                'allowEmpty' => false,
                'message' => '必ず入力して下さい'
               ),
            'pass_check' => array(
                'rule' => 'alphaNumeric',
                'required' => true,
                'allowEmpty' => false,
                'message' => '必ず入力して下さい'
            )
    );
}