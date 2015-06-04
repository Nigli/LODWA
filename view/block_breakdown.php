<table border="0" cellpadding="0" cellspacing="0" style="margin-top: 50px;border-bottom: 1px solid #cccccc;width: 551px;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;" width="551">
    <tr style="border-bottom: 2px solid #cccccc;">
        <td style="width: 368px;height: 23px;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
            <h3 style="display: block;font-family: Helvetica;font-size: 22px;font-style: normal;font-weight: bold;line-height: 125%;letter-spacing: 0px;margin: 0;text-align: left;color: #666666 !important;">
                <span style="font-size:22px;">
                    <span style="font-family: arial, 'helvetica neue', helvetica, sans-serif;">
                        TR Block Breakdown
                    </span>
                </span>
            </h3>
        </td>
    </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="TextBlock" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;color:#666666">
    <thead class="TextBlockOuter">
        <tr>
            <td style="width: 137px;height: 23px;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                <span style="font-size:14px;line-height: 150%;font-weight: bold;"><span style="font-family: arial, 'helvetica neue', helvetica, sans-serif;">
                    First Name
                </span></span>
            </td>
            <td style="width: 137px;height: 23px;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                <span style="font-size:14px;line-height: 150%;font-weight: bold;"><span style="font-family: arial, 'helvetica neue', helvetica, sans-serif;">
                    Last Name 
                </span></span>
            </td>
            <td style="width: 137px;height: 23px;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                <span style="font-size:14px;line-height: 150%;font-weight: bold;"><span style="font-family: arial, 'helvetica neue', helvetica, sans-serif;">
                    Num. of Subs 
                </span></span>
            </td>
            <td style="width: 137px;height: 23px;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                <span style="font-size:14px;line-height: 150%;font-weight: bold;"><span style="font-family: arial, 'helvetica neue', helvetica, sans-serif;">
                    Num. of Contracts
                </span></span>
            </td>
        </tr>
    </thead>
    <tbody class="TextBlockOuter">
        <?php
        foreach ($email->subscribers as $subscriber){
        ?>
            <tr>
                <td style="width: 137px;height: 23px;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                    <span style="font-size:14px;line-height: 150%"><span style="font-family: arial, 'helvetica neue', helvetica, sans-serif;">
                        <?php echo $subscriber->first_name?>
                    </span></span>
                </td>
                <td style="width: 137px;height: 23px;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                    <span style="font-size:14px;line-height: 150%;"><span style="font-family: arial, 'helvetica neue', helvetica, sans-serif;">
                        <?php echo $subscriber->last_name?>
                    </span></span>
                </td>
                <td style="text-align: center;width: 137px;height: 23px;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                    <span style="font-size:14px;line-height: 150%;"><span style="font-family: arial, 'helvetica neue', helvetica, sans-serif;">
                        <?php echo $subscriber->num_subs?>
                    </span></span>
                </td>
                <td style="text-align: center;width: 137px;height: 23px;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                    <span style="font-size:14px;line-height: 150%;"><span style="font-family: arial, 'helvetica neue', helvetica, sans-serif;">
                        <?php echo ($subscriber->num_subs * $email->num_contr)?>
                    </span></span>
                </td>
            </tr>
        <?php }
        ?>        
    </tbody>   
</table>
<table border="0" cellpadding="0" cellspacing="0" style="margin-top: 18px;width: 551px;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;" width="551">
    <tr >
        <td style="width: 368px;height: 16px;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
            <span style="font-size:16px;display: block;font-family: Helvetica;font-style: normal;line-height: 125%;letter-spacing: 0px;margin: 0;text-align: left;color: #666666 !important;">
                <span style="font-family: arial, 'helvetica neue', helvetica, sans-serif;">
                    Total Quantity for Block Order is: <?php echo $email->num_tot_contr ?>
                </span>
            </span>
        </td>
    </tr>
</table>