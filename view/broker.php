<?php $this->user_status == \utils\Enum::MANAGER ? include $this->broker_form : ""; ?>
<!-- broker list -->
<div id="profile">
    <table>
        <thead>
            <tr>
                <th></th>
                <th>Broker Company Name</th>
                <th>Broker Name</th>
                <th>Broker Email</th>
            </tr>
        </thead>
        <?php
        if ($this->broker) {
            foreach ($this->broker as $k => $broker) {
                ?>
                <tr>
                    <td data-title='Broker Company Name' data-index="broker_company"><?php echo $broker->broker_company ?></td>
                    <td data-title='Broker Name' data-index="broker_name"><?php echo $broker->broker_name ?></td>
                    <td data-title='Broker Email' data-index="broker_email"><?php echo $broker->broker_email ?></td>
                    <td data-index="id_broker" class="td_hidden"><?php echo $broker->id_broker ?></td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr><td>No Brokers in Database</td></tr>
            <?php
        }
        ?>
    </table>
</div>
<!-- end broker list -->