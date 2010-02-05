<p id="tech-stars">10% of our profits will help fund a customer chosen startup. Nominations and voting begin in April.</p>
<div id="main">
    <div id="tee">
        <?= HTML::image('public/images/tees/'.$tee->image, array("alt" => $tee->title)) ?>        
    </div>
    <ul id="tees">
        <? foreach ($tees AS $t): ?>
        <li><a href="<?= URL::site($t->slug) ?>" title="<?= $t->title ?>"><?= HTML::image('public/images/tees/'.$t->image, array("alt" => $t->title, "width" => "72")) ?></a></li>
        <? endforeach ?>
    </ul>
</div>
<div id="sidebar">    
    <div id="shirt-description">        
        <? if ($tee->is_limited): ?>
        <span id="limited-edition">Limited Edition</span>
        <div id="quantity"><?= $quantity ?></div>
        <? endif ?>
        <h2><?= $tee->title ?></h2>
        <p><?= $tee->description ?></p>
    </div>
    <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" id="add-to-cart">
        <? if (count($products)): ?>
        <div id="price">$<?= number_format($tee->price) ?></div>
        <div id="size">
            <label for="size">Size</label>
            <select name="os0">
                <? foreach($products AS $product): ?>
                <option value="<?= $product->size ?>"><?= $product->size ?></option>
                <? endforeach ?>
            </select>
            <input type="hidden" name="cmd" value="_s-xclick" />
            <input type="hidden" name="hosted_button_id" value="<?= $tee->hosted_button_id ?>" />
            <input type="hidden" name="on0" value="Size" />
        </div>
        <div>
            <input class="submit" type="submit" value="Add to Cart" />
        </div>
        <? else: ?>
        <div id="price" class="sold-out">Sold Out</div>
        <? endif ?>
        <script type="text/javascript" src="http://w.sharethis.com/button/sharethis.js#publisher=2be8bbe7-cddd-4838-bf37-6d4b84c2ba85&amp;type=website&amp;buttonText=&amp;post_services=email%2Cfacebook%2Ctwitter"></script>        
    </form>    
    <?= View::factory('contact/_email_signup') ?>
</div>