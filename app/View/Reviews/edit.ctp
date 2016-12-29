<?php
//isNew(データが空である)がtrueであれば投稿。そうでなければ編集
    $titleLabel = $isNew ? '投稿' : '編集';
    $submitLabel = $isNew ? '投稿' : '更新';
?>

<!-- //titleLabelが切り替わる -->
<h2>レビュー<?= $titleLabel; ?></h2>

<?= $this->Form->create('Review'); ?>
<?= $this->Form->input('score', [
    'label' => '点数',
    'type' => 'select',
    'options' => $this->Shop->scoreList()
]); ?>

<?= $this->Form->input('title', ['label' => 'タイトル']); ?>
<?= $this->Form->input('body', ['label' => '内容']); ?>
<?= $this->Form->hidden('id'); ?>
<?= $this->Form->hidden('shop_id', ['value' => $shopId]); ?>
<!-- //投稿または更新ボタン -->
<?= $this->Form->end($submitLabel); ?>

<?php if ($this->request->data) : ?>
    <div style="float: right; margin-right: 50px; margin-top: -55px; font-size: 18px;">
        <?= $this->Form->postLink(
            '削除',
            ['action' => 'delete', $this->request->data['Review']['id']],
            ['confirm' => '本当に削除してよろしいですか？']
        ); ?>
    </div>
<?php endif; ?>