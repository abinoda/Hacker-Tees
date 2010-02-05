<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
<channel>
    <atom:link href="<?= URL::site('rss') ?>" rel="self" type="application/rss+xml" />

    <title>Hacker Tees</title>
    <link><?= URL::base() ?></link>
    <description>T-shirts for hackers.</description>
    <lastBuildDate><?= date('D, j M Y H:i:s T', strtotime($last_build_date)) ?></lastBuildDate>
    <language>en-us</language>
    
    <? foreach ($tees AS $tee): ?>
    <item>
        <title><?= $tee->title ?></title>
        <link><?= URL::site($tee->slug) ?></link>
        <guid><?= URL::site($tee->slug) ?></guid>
        <pubDate><?= date('D, j M Y H:i:s T', strtotime($tee->created_at)) ?></pubDate>
        <description><?= $tee->description ?></description>
    </item>
    <? endforeach ?>
</channel>
</rss>