<!-- user form -->
<form id="user_list_form" class="edit" method="post" action="processuser">
    <h2>Edit or add New</h2>
    <span id="rightspan">To edit user click on the table row</span><br>    
    <input id="admin_note" type="hidden" value="<?php echo $this->notice ?>"/>
    <input id="id_user" type="hidden" name="id_user" value=""/>
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
            <td><select id="status_id" name="status"><?php foreach ($this->status as $k => $v) {
    echo "<option value='" . $v['id_status'] . "'>" . $v['status_name'] . "</option>";
} ?></select></td>
            <td><input id="email" name="email" type="email" value="" required=""/></td>
            <td><input id="password" name="password" type="password" value="" required=""/></td>
            <td><input id="password_conf" name="password_conf" type="password" value="" required=""/></td>
        </tr>
    </table>
    <div id="bottom">
        <div id="bottom-left">
            <button id="reset" class="reset" type="reset" name="user-submit" value="reset">Clear</button>
            <button id="delete" class="delete" type="button" name="user-submit" value="remove" onclick="getVal(this)">Remove</button>
            <button id="update" class="update" type="button" name="user-submit" value="update" onclick="getVal(this)">Update</button>
            <button id="new" type="button" name="user-submit" value="new" onclick="getVal(this)">New</button>
        </div>
    </div>
</form>
<!--END user form -->
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
        if ($this->users) {
            foreach ($this->users as $k => $user) {
                ?>
                <tr>
                    <td data-title='User Status'><?php echo $user->status_name ?></td>
                    <td data-title='Email'  data-index="email"><?php echo $user->user_email ?></td>
                    <td data-index="id_user" class="td_hidden"><?php echo $user->user_id ?></td>                
                    <td data-index="status_id" class="td_hidden"><?php echo $user->id_status ?></td>
                </tr>
                <?php
            }
        } else {
            
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