<?= $this->Form->create('Shop', ['type' => 'file']); ?>
<?= $this->Form->input('name', ['label' => '店名']); ?>
<?= $this->Form->input('tel', ['label' => '電話番号']); ?>
<?= $this->Form->input('addr', ['label' => '住所']); ?>
<?= $this->Form->input('url', ['label' => 'URL']); ?>

<?= $this->Form->input('photo', ['type' => 'file', 'label' => '写真']); ?>
<?= $this->Form->input('photo_dir', ['type' => 'hidden']); ?>

<?php if (!empty($this->request->data)) : ?>
    <?= $this->Form->hidden('id'); ?>
<?php endif;?>
<?= $this->Form->end($submitLabel); ?>
