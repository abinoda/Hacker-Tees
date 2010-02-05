<div id="email-signup">
    <h3>Get notified when we release a new shirt design:</h3>
    <?= Form::open(URL::site('signup'), array('id' => 'capture-email')) ?>
        <?= CSRF::set_token() ?>
        <div>
            <?= Form::input('email', 'enter your email', array('id' => 'email')) ?>
            <?= Form::submit(NULL, 'submit', array('class' => 'submit')) ?>
        </div>
    <?= Form::close() ?>
</div>