<script src="js/emailtemp.js" type="text/javascript"></script>
<div id="spinner"></div>
<!--NOTICE POPUP-->
<div id="notice">
    <div id="top">
        <div id="notice-title">
            <h3></h3>
        </div>
    </div>
    <span id="notice-span"></span>
    <div id="bottom">
        <div id="bottom-left">            
            <button id="notice-close" type="button" name="close">Close</button>
        </div>
    </div>
</div>
<!--END NOTICE POPUP-->
<form id="emailtemp" method="post"  action="processemtemp">
    <input id="emailtemp_note" type="hidden" value="<?php echo $this->notice ?>"/>
    <div id="top">
        <h2>Email Disclaimer</h2>
    </div>
    <table>
        <tr>
            <?php 
            if($this->emailtemp){
            ?>            
            <td><textarea name="disclosure" class="readonly" disabled="" required=""><?php echo $this->emailtemp->disclosure ?></textarea></td>                
        </tr>
    </table>
    <div id="bottom">
        <div id="bottom-left">
            <button id="cancel" class="cancel" name="emailtemp-cancel" type="button" value="cancel">Cancel</button>
            <button id="change" class="change" name="emailtemp-submit" type="button" value="change">Change</button>
            <button id="update" class="update" name="emailtemp-submit" type="submit" value="update">Update</button>
        </div>
    </div>
            <?php
            }else {
                
            ?>
            <td>There is no email template in database</td>
            <?php
            }
            ?>
</form>
