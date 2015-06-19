<form method="post" action="../unsubprocess">
    <input type="hidden" name="id_receiver" value="<?php echo $subscriber->id_receiver ?>"/>
    <div id="top">
        <h2>Subscription Information</h2>                            
    </div>
    <div id="left">
        <p>You are receiving this email because you opted to receive Northern Advisors Research Reports.</p>
        <p>You can unsubscribe from this list anytime you want clicking on the button bellow.</p>
        <h4>Notice!</h4>
        <p>After clicking on the Unsubscribe button, you will not receive our emails anymore.</p>
    </div>
    <div id="bottom">
        <div id="bottom-left">
            <button type="submit" id="unsubbutton" value="Unsubscribe">Unsubscribe</button>
        </div>
    </div>
</form>