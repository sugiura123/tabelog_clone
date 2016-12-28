<?php

class ReviewsController extends AppController {

    public $uses = ['Review', 'Shop'];

    public function edit($shopId = null) {

        if (!$this->Shop->exists($shopId)) {
            throw new NotFoundException('レストランがみつかりません');
        }

        $userId = $this->Auth->user('id');

        if ($this->request->is(['post', 'put'])) {
            $message = 'レビューを更新しました';
            if (empty($this->request->data['Review']['id'])) {
                $message = 'レビューを登録しました';
                $this->Review->create();
            }

            $this->request->data['Review']['user_id'] = $userId;

            if ($this->Review->save($this->request->data)) {
                $this->Flash->success($message);

                return $this->redirect([
                    'controller' => 'shops',
                    'action' => 'view',
                    $shopId
                    ]);
            }
        } else {
            $this->request->data = $this->Review->getData($shopId, $userId);
        }

        $isNew = empty($this->request->data);

        $this->set('shopId', $shopId);
        $this->set('isNew', $isNew);
    }

    public function delete($id = null) {
        if (!$this->Review->exists($id)) {
            throw new NotFoundException('レビューがみつかりません');
        }

        // ショップのIDを取得
        $shopId = $this->Review->findById($id)['Review']['shop_id'];

        $this->request->allowMethod(['post', 'delete']);
        if ($this->Review->delete($id)) {
            $this->Flash->success('レビューを削除しました');

            return $this->redirect([
                    'controller' => 'shops',
                    'action' => 'view',
                    $shopId
                ]);
        } else {
            $this->Flash->error('レビューを削除できませんでした');
        }
    }
}