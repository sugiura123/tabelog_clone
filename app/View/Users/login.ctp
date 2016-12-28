<h2>ログイン</h2>

<div>
    <?= $this->Flash->render('auth'); ?>

    <?= $this->Form->create('User'); ?>
    <fieldset>
        <?= $this->Form->input('email', ['label' => 'メールアドレス']); ?>
        <?= $this->Form->input('password', ['label' => 'パスワード']); ?>
    </fieldset>
    <?= $this->Form->end('ログイン'); ?>

</div>