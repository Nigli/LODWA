<script src="inc/js/admin.js" type="text/javascript"></script>
<div id="spinner"></div>
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
            <button id="notice-cancel" type="button" name="cancel">Cancel</button>
            <button id="notice-confirm" type="submit" name="user-submit" form="user_list_form">Confirm</button>
        </div>
    </div>
</div>
<form id="user_list_form" class="edit" method="post" action="processuser">
    <h2>Edit or add New</h2>
    <span id="rightspan">To edit user click on the table row</span><br>    
    <input id="admin_note" type="hidden" value="<?php echo $this->notice ?>"/>
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
            <td><select id="status_id" name="status"><?php foreach ($this->status as $k=>$v){echo "<option value='".$v['status']."'>".$v['status_name']."</option>"; }?></select></td>
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
<div id="user_list">  
    <h2>Users List</h2>
    <table>
        <thead>
            <tr>
                <th colspan="2">Status</th>
                <th>Email</th>
            </tr>
        </thead>
        <?php
        foreach ($this->users as $k=>$user) {
        ?>
            <tr>
                <td data-title='User Status'><?php echo $user->status_name ?></td>
                <td data-title='Email'><?php echo $user->user_email ?></td>
                <td data-title='User Id' class="td_hidden"><?php echo $user->user_id ?></td>                
                <td data-title='Status Id' class="td_hidden"><?php echo $user->user_status ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
    <?php
        echo $this->pagin->createLinks($this->links);
    ?>
</div>
<script>           
    function getVal(obj) {
        document.getElementById("notice-confirm").value = obj.value;
        rec_action = obj.value;
    }
</script>