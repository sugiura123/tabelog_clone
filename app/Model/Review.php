<?php

class Review extends AppModel {
//ReviewはUser,Shopに紐付いている
    public $belongsTo = [
    //この'User'は['className' => 'User']に対するエイリアスなので'sugiura'とかでも良い
        'User' => [
            'className' => 'User'
        ],
        'Shop' => [
            'className' => 'Shop'
        ]
    ];

    public $validate = [
        'title' => [
            'rule' => 'notBlank'
        ],
        'body' => [
            'rule' => 'notBlank'
        ],
        'score' => [
            'numeric' => [
                'rule' => 'numeric',
                'message' => '数値を入力してください'
            ]
        ]
    ];

    public function getData($shopId, $userId) {

        $options = [
            'conditions' => [
            //$shopIdはreview投稿時のID(ReviewsControllerの7行目)$userIdはいまログインしているユーザReviewsControllerの13行目)
                'shop_id' => $shopId,
                'user_id' => $userId
            ]
        ];

        return $this->find('first', $options);
    }

    public function getAvgScoreByShopId($shopId) {

        $options = [
            'fields' => 'AVG(score) as avg',
            'conditions' => ['shop_id' => $shopId],
            'group' => ['shop_id']
        ];

        $data = $this->find('first', $options);

        $avg = 0;
        if (!empty($data[0]['avg'])) {
            $avg = round($data[0]['avg'], 1);
        }

        return $avg;

    }
}