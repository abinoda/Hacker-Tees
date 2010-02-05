<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="content-type" content="application/xhtml+xml;charset=utf-8" />
    <meta name="google-site-verification" content="W-DSGOklU2Jnz-SDN-kSk9ZNP_PX1vEQBk20jdYAhCw" />
    <meta name="description" content="Hacker Tees is a hacker-friendly t-shirt company dedicated to providing beautiful, high quality t-shirts for hackers." />        
    <meta name="keywords" content="hacker t-shirts, hacker tees, geek t-shirts, programming t-shirts, computer t-shirts" />
    <title><?= Helper_Application::title($title) ?></title>
    <link rel="alternate" type="application/rss+xml" title="Hacker Tees" href="<?= URL::site('rss') ?>" />
    <link rel="icon" type="image/png" href="<?= URL::site('public/images/favicon.png') ?>" />
    <?= HTML::style('public/css/screen.css') ?>
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <h1><a href="<?= URL::site() ?>">Hacker Tees</a></h1>
            <ul id="nav">
                <li><a href="<?= URL::site() ?>"<?= $section == 'tees' ? ' class="active"' : NULL ?>>Tees</a></li>
                <li><a href="<?= URL::site('about') ?>"<?= $section == 'about' ? ' class="active"' : NULL ?>>About</a></li>
                <li><a href="<?= URL::site('faq') ?>"<?= $section == 'faq' ? ' class="active"' : NULL ?>>FAQ</a></li>
                <li><a href="<?= URL::site('contact') ?>"<?= $section == 'contact' ? ' class="active"' : NULL ?>>Contact</a></li>
            </ul>
        </div>
        <div id="content">
            <?= $content ?>
        </div>
        <div id="footer">
            <span id="copyright">&copy; 2010 Hacker Tees</span>
            <a href="http://twitter.com/hackertees" title="Follow Hacker Tees on Twitter">Twitter</a>
        </div>
    </div>  
    <?= HTML::script('public/js/jquery-1.3.2.min.js') ?>
    <?= HTML::script('public/js/hackertees.js') ?>
    <?= IN_PRODUCTION ? View::factory('layouts/_google_analytics') : NULL ?>
</body>
</html>