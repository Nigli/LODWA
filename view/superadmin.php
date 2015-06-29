<?php include 'admin/superadmin.php'; ?>
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
        foreach ($users as $k=>$user) {
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
        echo $pagin->createLinks($links);
    ?>
</div>