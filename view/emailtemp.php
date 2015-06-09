<script src="js/emailtemp.js" type="text/javascript"></script>
<form id="emailtemp" method="post"  action="process/process_emailtemp.php">
    <div id="top">
        <h2>Email Disclosure</h2>
    </div>
    <table>
        <tr>
            <td><textarea name="disclosure" class="readonly" disabled=""><?php echo $emailtemp->disclosure ?></textarea></td>
        </tr>
    </table>
    <div id="bottom">
        <div id="bottom-left">
            <button id="change" class="change" name="emailtemp-submit" type="button" value="change">Change</button>
            <button id="update" class="update" name="emailtemp-submit" type="submit" value="update">Update</button>
            <button id="cancel" class="cancel" name="emailtemp-cancel" type="button" value="cancel">Cancel</button>
        </div>
    </div>
</form>
