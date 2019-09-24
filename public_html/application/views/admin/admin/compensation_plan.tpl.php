<h2>Compensation Plan</h2>
<div class="">
<!--    Search By Date: 
    <select name="user_role" id="user_role" onchange="javascript:comlist_particular(this)" >
        <option value="" selected="selected">Last Week</option>
        <option value="1">Last 15 Days</option>
        <option value="2">Last Month</option>
        <option value="3">Last 3 Month</option>
        <option value="4">Last 6 Month</option>
        <option value="5">Last Year</option>
    </select>
-->   
    <form action="" method="post">Search By Name: 
        <input class="input-medium" type="text" name="searchval" value="<?php echo $searchval; ?>" >
        <input type="submit" value="SEARCH" class="button" style=" margin-left: 5px; padding: 3px 5px;">
        <input type="button" value="BACK"  onclick="location = '<?php echo admin_url()?>user/compensation-plan.html'" class="button" style=" margin-left: 5px; padding: 3px 5px;">
    </form>  



</div>
<?php 
    if(!empty($s_msg)){
        echo '<div id="error">'.$s_msg.'</div>';
    }
?>
<?php
    // Message showing from controller
    echo show_msg();
?>

<table class="details">
    <caption>&nbsp;</caption>
<?php
    if(count($m_dataset))
    {
?>
    <tr>
        <th>Full Name</th>
        <th>Commission</th>
        <th>Week</th>
    </tr>

<?php
    foreach($m_dataset as $row)
    {
?>
    <tr>
        <td><?php echo $row['s_firstname']."  ".$row['s_lastname'];?></td>
        <td><?php echo $row['f_total_commission'];?></td>
        <td><?php echo date("m/d/Y g:i A",$row['i_start_date']);?> - <?php echo date("m/d/Y g:i A",$row['i_end_date']);?></td>
    </tr>
<?php
    }}
    else
    {
        echo "No Data Found";
    }
?>

</table>                  
