<div id="main">
    <h2>Contact Us</h2>
    <?= Form::open('contact', array('id' => 'contact')) ?>
    <?= CSRF::set_token() ?>
    <ul>
        <li>
            <?= Form::error($errors, 'name') ?>
            <?= Form::label('name', 'Name') ?>
            <?= Form::input('name', $form['name'], array('class' => 'text')) ?>
        </li>
        <li>
            <?= Form::error($errors, 'email') ?>
            <?= Form::label('email', 'Email') ?>
            <?= Form::input('email', $form['email'], array('class' => 'text')) ?>
        </li>
        <li>
            <?= Form::error($errors, 'subject') ?>
            <?= Form::label('subject', 'Subject') ?>
            <?= Form::input('subject', $form['subject'], array('class' => 'text')) ?>
        </li>
        <li>
            <?= Form::error($errors, 'message') ?>
            <?= Form::label('message', 'Message') ?>
            <?= Form::textarea('message', $form['message'], array('class' => 'text')) ?>
        </li>
        <li>
            <?= Form::submit(NULL, 'Send', array('class' => 'submit')) ?>
        </li>
    </ul>
    <?= Form::close() ?>
</div>
<div id="sidebar">
    <?= View::factory('contact/_email_signup') ?>
</div>