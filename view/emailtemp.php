<!-- email temp form -->
<form id="emailtemp" method="post"  action="processemtemp">
    <input id="note" type="hidden" value="<?php echo $this->notice ?>"/>
    <div id="top">
        <h2>Email Disclaimer</h2>
    </div>
    <table>
        <tr id="disclosure">
            <?php
            if ($this->emailtemp) {
                ?>            
                <td><textarea name="disclosure" class="readonly" disabled="" required=""><?php echo $this->emailtemp->disclosure ?></textarea></td>                
            </tr>
        </table>
        <div id="bottom">
            <div id="bottom-left">
                <button id="cancel" class="cancel" name="emailtemp-cancel" type="button" value="cancel">Cancel</button>
                <button id="change" class="change" name="emailtemp-submit" type="button" value="change">Change</button>
                <button class="update profile_button" name="emailtemp-submit" type="submit" value="update">Update</button>
            </div>
        </div>
        <?php
    } else {
        ?>
        <td>There is no email template in database</td>
        <?php
    }
    ?>
</form>
<!--END email temp form -->