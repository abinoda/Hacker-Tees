<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="content-type" content="application/xhtml+xml;charset=utf-8" />
    <meta name="description" content="T-shirts for hackers." />        
    <meta name="keywords" content="hacker t-shirts, hacker tees, geek t-shirts, programming t-shirts, computer t-shirts" />
    <title><?= $title ?></title>
    <?= Html::style('public/css/screen.css') ?>
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <h1><a href="<?= URL::site() ?>">Hacker Tees</a></h1>
            <ul id="nav">
                <li><a href="<?= URL::site() ?>">Tees</a></li>
                <li><a href="<?= URL::site('about') ?>">About</a></li>
                <li><a href="<?= URL::site('faq') ?>">FAQ</a></li>
                <li><a href="<?= URL::site('contact') ?>">Contact</a></li>
            </ul>
        </div>
        <div id="content">
            <div id="main">
                <h2><?= $title ?></h2>
                <p><?= $content ?></p>
            </div>
            <div id="sidebar">
                <div id="email-signup">
                    <h3>Get notified when we release a new shirt design:</h3>
                    <form action="#" method="post">
                        <div>
                            <input type="text" name="email" id="email" value="enter your email" />
                            <input type="submit" class="submit" value="submit" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="footer">
            <span id="copyright">&copy; 2010 Hacker Tees</span>
            
            <a href="http://abinoda.com" title="Abi Noda">Abi Noda</a>
            <span class="pipe">|</span>
            <a href="http://corylevy.com" title="Cory Levy">Cory Levy</a>
        </div>
    </div>  
    <?= Html::script('public/js/jquery-1.3.2.min.js') ?>
    <?= Html::script('public/js/hackertees.js') ?>
    <?= IN_PRODUCTION ? View::factory('layouts/_google_analytics') : NULL ?>
</body>
</html>