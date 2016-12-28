<h2>会員情報変更</h2>

<?= $this->Form->create('User'); ?>
<?= $this->Form->input('email', ['label' => 'メールアドレス', 'type' => 'email']); ?>
<?= $this->Form->input('password_current', ['label' => '現在のパスワード',  'type' => 'password']); ?>
<?= $this->Form->hidden('id'); ?>
<?= $this->Form->end('更新'); ?>