<?php

class ShopsController extends AppController {

    public $uses = ['Shop', 'Review'];

    public $helpers = ['Shop'];

    public $components = [
        'Paginator' => [
            'limit' => 10,
            'order' => ['created' => 'desc']
        ]
    ];

//他を差し置きまっさきにこれを実行する構文
    public function beforeFilter() {
        //AppController.phpに記載したbeforeFilter()と親子関係とみる。なのでparent
        parent::beforeFilter();

//index,viewともにログインしなくても閲覧ができる(allow で許可する･)
        $this->Auth->allow('index', 'view');
    }

    public function index() {
        // $this->set('shops', $this->Shop->find('all'));
        //上の第一引数'shops'は'sugiura'でもOK。shopsは変数名
        //Model経由でshopsにアクセスする。大文字Shopにする
        //paginateはfind('all')を兼ねているからfind('all')を表示させなくてもOK
        $this->set('shops', $this->Paginator->paginate());

        // 効率よくレビュー件数とレビュー平均値を集計する為に、JOIN と GROUP BY を使用する
        $this->Shop->virtualFields['cnt'] = 0;  // Shop にレビュー件数集計用のバーチャルフィールドを追加
        $this->Shop->virtualFields['avg'] = 0;  // Shop にレビュー評価平均点用のバーチャルフィールドを追加
        $this->Shop->recursive = -1;            // JOIN を使うときは、再帰に -1 を設定する

        // ページネーションの設定
        $this->Paginator->settings = [
            'Shop' => [
                'limit' => 10,                  // 1ページ内に表示するデータ数
                'order' => [                    // 並び順
                    'Shop.created' => 'desc',
                    'Shop.name' => 'asc',
                ],

                // JOIN の設定
                'joins' => [
                    [
                        'type' => 'LEFT',                           // LEFT JOIN
                        'table' => 'reviews',                       // reviews テーブルを JOIN する
                        'alias' => 'Review',                        // エイリアスを Review とする
                        'conditions' => 'Shop.id = Review.shop_id', // JOIN の条件
                    ],
                ],
                // 表示する項目
                'fields' => [
                    'Shop.id', 'Shop.name', 'Shop.photo', 'Shop.photo_dir', 'Shop.created',
                    'count(Review.id) as Shop__cnt',            // レビュー件数の別名にバーチャルフィールド(cnt)を設定
                    'avg(Review.score) as Shop__avg',           // レビュー評価平均点の別名にバーチャルフィールド(avg)を設定
                ],
                'group' => ['Shop.id'],                         // Shop.id でグルーピングして集計
            ],
        ];
        $shops = $this->Paginator->paginate('Shop');

        // debug($shops);    // ここでデバッグプリントすると JOIN の結果が分かりやすく、設定を調整しやすい
        // die;

        $this->set('shops', $shops);

    }

    public function view($id = null) {
        if (!$this->Shop->exists($id)) {
            throw new NotFoundException('レストランがみつかりません');
        }
        $this->set('shop', $this->Shop->findById($id));
        // 現在のユーザーがレビューを投稿済かチェック
        $reviewLabel = '投稿';

        if ($this->Auth->user() && $this->Review->getData($id, $this->Auth->user('id'))) {
            $reviewLabel = '編集';
        }

        // レストランのレビューの平均点を取得
        $averageScore = $this->Review->getAvgScoreByShopId($id);

        // レストラン情報を取得
        $this->Shop->recursive = 2;
        $shop = $this->Shop->findById($id);

        // ビューに値を渡す
        $this->set('reviewLabel', $reviewLabel);
        $this->set('averageScore', $averageScore);
        $this->set('shop', $shop);
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Shop->create();

            if ($this->Shop->save($this->request->data)) {
                $this->Flash->success('レストランを登録しました');
                return $this->redirect(['action' => 'index']);
            }
        }
    }

//add()の時と違って($id = null)とするのはexists($id)で確認するから一旦リセットする意味で
    public function edit($id = null) {
        if (!$this->Shop->exists($id)) {
            throw new NotFoundException('レストランがみつかりません');
        }

        if ($this->request->is(['post', 'put'])) {
            if ($this->Shop->save($this->request->data)) {
                $this->Flash->success('レストランを更新しました');
                return $this->redirect(['action' => 'index']);
            }
            //↑このままではアクセスした時フォームの中身が空っぽになってしまうので,以下を書く
        } else {
            $this->request->data = $this->Shop->findById($id);
        }

    }

    public function delete($id = null) {
        if (!$this->Shop->exists($id)) {
            throw new NotFoundException('レストランがみつかりません');
        }

//post,deleteメソッドの時のみ許可する。つまりgetメソッドのときは表示(許可されない)
        $this->request->allowMethod('post', 'delete');

        if ($this->Shop->delete($id)) {
            $this->Flash->success('レストランを削除しました');
        } else {
            $this->Flash->error('レストランを削除できませんでした');
        }

        return $this->redirect(['action' => 'index']);

    }
}