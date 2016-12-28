<?php

App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {

    public $hasMany = [
        'Review' => [
            'className' => 'Review'
        ]
    ];

    public $validate = [
        'email' => [
            'required' => [
                'rule' => 'notBlank',
                'message' => 'メールアドレスを入力してください'
            ],
            'validEmail' => [
                'rule' => 'email',
                'message' => '正しいメールアドレスを入力してください'
            ],
            'emailExists' => [
                'rule' => ['isUnique', 'email'],
                'message' => '入力されたメールアドレスは既に登録されています'
            ],
        ],
        'password' => [
            'required' => [
                'rule' => 'notBlank',
                'message' => 'パスワードを入力してください'
            ],
            // バリデーションにメソッドを指定
            'match' => [
                'rule' => 'passwordConfirm',
                'message' => 'パスワードが一致していません'
            ],
        ],
        'password_confirm' => [
            'required' => [
                'rule' => 'notBlank',
                'message' => 'パスワード(確認)を入力してください'
            ],
        ],
        'password_current' => [
            'required' => [
                'rule' => 'notBlank',
                'message' => '現在のパスワードが入力されていません',
            ],
            'match' => [
                'rule' => 'checkCurrentPassword',
                'message' => '現在のパスワードが間違っています'
            ]
        ]
    ];

    // カスタムバリデーションメソッド
    public function passwordConfirm($check) {

        // $check は ['password' => '入力された値']
        if ($check['password'] === $this->data['User']['password_confirm']) {
            return true;
        }

        return false;
    }

    public function checkCurrentPassword($check) {

        // 入力されたパスワード
        $password = array_values($check)[0];

        // 入力された id に対応するユーザーを取得
        $user = $this->findById($this->data['User']['id']);

        // 入力されたパスワード と ユーザーのパスワードが一致するかをチェック
        $passwordHasher = new BlowfishPasswordHasher();

        if ($passwordHasher->check($password, $user['User']['password'])) {
            return true;
        }

        return false;

    }


    public function beforeSave($options = []) {

        // パスワードをハッシュ化
        if (isset($this->data['User']['password'])) {
            $passwordHasher = new BlowfishPasswordHasher();

            $this->data['User']['password'] = $passwordHasher->hash($this->data['User']['password']);
        }

        return true;
    }
}