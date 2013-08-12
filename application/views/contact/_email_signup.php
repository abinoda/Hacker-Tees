<div id="email-signup">
    <h3>Get notified when we release a new shirt design:</h3>
    <?= Form::open(URL::site('email_signup')) ?>
        <?= CSRF::set_token() ?>
        <div>
            <?= Form::input('email', 'Your email address', array('id' => 'email', 'onfocus' => "this.value=''", 'onblur' => "if(this.value=='') { this.value='Your email address'}")) ?>
            <?= Form::submit(NULL, 'submit', array('class' => 'submit')) ?>
        </div>
    <?= Form::close() ?>
</div>