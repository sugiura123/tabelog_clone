<h2>パスワード変更</h2>

<?= $this->Form->create('User'); ?>
<?= $this->Form->input('password_current', ['label' => '現在のパスワード', 'type' => 'password']); ?>
<?= $this->Form->input('password', ['label' => '新パスワード', 'type' => 'password']); ?>
<?= $this->Form->input('password_confirm', ['label' => 'パスワード（確認）', 'type' => 'password']); ?>
<?= $this->Form->hidden('id'); ?>
<?= $this->Form->end('更新'); ?>