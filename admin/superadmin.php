<script src="js/superadmin.js" type="text/javascript"></script>
<div id="notice">
    <div id="top">
        <div id="notice-title">
            <h4></h4>
        </div>
    </div>
    <span id="notice-span"></span>
    <div id="bottom">
        <div id="bottom-left">            
            <button id="notice-close" type="button" name="close">Close</button>
            <button id="notice-cancel" type="button" name="cancel">Cancel</button>
            <button id="notice-confirm" type="submit" name="user-submit" form="user_list_form">Confirm</button>
        </div>
    </div>
</div>
<form id="user_list_form" class="edit" method="post" action="processuser">
    <h2>Edit or add New</h2>
    <span id="rightspan">To edit user click on the table row</span><br>
    <table>
        <thead>
            <tr>
                <th>Status</th>
                <th>Email</th>
                <th>Password</th>
                <th>Confirm Password</th>
            </tr>
        </thead>
        <tr>
            <td><select id="status_id" name="status"><?php foreach ($status as $k=>$v){echo "<option value='".$v['status']."'>".$v['status_name']."</option>"; }?></select></td>
            <td><input id="email" name="email" type="email" value="" required=""/></td>
            <td><input id="password" name="password" type="password" value="" required=""/></td>
            <td><input id="password_conf" name="password_conf" type="password" value="" required=""/></td>
        </tr>
    </table>
    <input id="id_user" type="hidden" name="id_user" value=""/>
    <div id="bottom">
        <div id="bottom-left">
            <button id="reset" class="reset" type="reset" name="user-submit" value="reset">Clear</button>
            <button id="delete" class="delete" type="button" name="user-submit" value="remove" onclick="getVal(this)">Remove</button>
            <button id="update" class="update" type="button" name="user-submit" value="update" onclick="getVal(this)">Update</button>
            <button id="new" type="button" name="user-submit" value="new" onclick="getVal(this)">New</button>
        </div>
    </div>
</form>
<script>           
    function getVal(obj) {
        document.getElementById("notice-confirm").value = obj.value;
        rec_action = obj.value;
    }
</script>