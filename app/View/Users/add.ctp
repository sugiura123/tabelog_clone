<h2>新規会員登録</h2>

<?= $this->Form->create('User'); ?>
<?= $this->Form->input('email', ['label' => 'メールアドレス', 'type' => 'email']); ?>
<?= $this->Form->input('password', ['label' => 'パスワード', 'type' => 'password']); ?>
<?= $this->Form->input('password_confirm', ['label' => 'パスワード(確認)', 'type' => 'password']); ?>
<?= $this->Form->end('登録する'); ?>
