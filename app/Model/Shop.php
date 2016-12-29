<?php

class Shop extends AppModel {

    // 使用するビヘイビアの宣言
    public $actsAs = [
        // UploadプラグインのUploadBehaviorという意味
        'Upload.Upload' => [
            // photoというカラムに Uploadビヘイビアを使ってファイル名を登録する
                'photo' => [
                // デフォルトのカラム名 dir を photo_dir に変更
               //☆ 'fields' => ['dir' => 'photo_dir'],
                'deleteOnUpdate' => true,
            ]
        ]
    ];

    public $hasMany = [
        'Review' => [
            'className' => 'Review',
            'dependent' => true // Shop が削除されたら Review も再帰的に削除する
        ]
    ];

//｢このフィールドに入力して下さい｣と勝手に出るようになっている。
    public $validate = [
        'name' => [
            'rule' => ['notBlank']
        ],
        'tel' => [
            'rule' => ['notBlank']
        ],
        'addr' => [
            'rule' => ['notBlank']
        ],
        'url' => [
            'rule' => ['url', true],
            'message' => '形式が正しくありません'
        ],

        // 画像ファイルアップロードのバリデーション追加
        'photo' => [
            'UnderPhpSizeLimit' => [
                'allowEmpty' => true,
                'rule' => 'isUnderPhpSizeLimit',
                'message' => 'アップロード可能なファイルサイズを超えています'
            ],
            'BelowMaxSize' => [
                'rule' => ['isBelowMaxSize', 5242880],
                'message' => 'アップロード可能なファイルサイズを超えています'
            ],
            'CompletedUpload' => [
                'rule' => 'isCompletedUpload',
                'message' => 'ファイルが正常にアップロードされませんでした'
            ],
            'ValidMimeType' => [
                'rule' => ['isValidMimeType', ['image/jpeg', 'image/png'], false],
                'message' => 'ファイルが JPEG でも PNG でもありません'
            ],
            'ValidExtension' => [
                'rule' => ['isValidExtension', ['jpeg', 'jpg', 'png'], false],
                'message' => 'ファイルの拡張子が JPEG でも PNG でもありません'
            ]
        ]
    ];
}