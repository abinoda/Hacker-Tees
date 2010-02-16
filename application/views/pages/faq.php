<div id="main">
    <h2>FAQ</h2>
    <ul id="faq">
        <li>
            <p class="q">Q: I see a shirt I like but it's sold out. How can I get one?</p>
            <p>A: Sorry, our t-shirts are limited edition. If you desperately want a shirt, <a href="<?= UrL::site('contact') ?>">let us know</a>. We may have a spare lying around.</p>
        </li>
        <li>
            <p class="q">Q: Do you ship internationally?</p>
            <p>A: Yes. Prices are calculated at checkout.</p>
        </li>
        <li>
            <p class="q">Q: What is shipping time like?</p>
            <p>A: We'll try our best to get your shirt delivered to you as soon as possible. Please allow 1-2 weeks for your shipment to arrive.</p>
        </li>
        <li>
            <p class="q">Q: How are your shirts printed?</p>
            <p>A: Our shirts are screen-printed on 100% combed ring-spun cotton 30/1's fine knit jersey by <a href="http://woodencotton.net/" title="Wooden Cotton Printing">Wooden Cotton Printing</a>.</p>
        </li>
        <li>
            <p class="q">Q: What if I have an idea for a shirt?</p>
            <p>A: We want to hear about it!  Please <a href="<?= UrL::site('contact') ?>">contact us</a>.</p>
        </li>
        <li>
            <p class="q">Q: Who designs the shirts?</p>
            <p>A: We are hackers, not designers.</p>
        </li>
        <li>
            <p class="q">Q: Who do I email for support?</p>
            <p>A: Send an email to <a href="mailto:info@hackertees.com">info@hackertees.com</a>.</p>
        </li>
    </ul>
</div>
<div id="sidebar">
    <?= View::factory('contact/_email_signup') ?>
</div>