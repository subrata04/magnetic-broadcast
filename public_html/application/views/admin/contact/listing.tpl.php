
<script>
function view_msg(obj){
    html=$(obj).next('.hidfield').text();
    $.facebox('<div style="max-height:200px; max-width:600px;">'+html+'</div>');
}
</script>
<h2>Lead Listing </h2>
<?php 
    echo validation_errors('<div id="error">', '</div>'); 
    if(!empty($s_msg)){
        echo '<div id="error">'.$s_msg.'</div>';
    }
?>

<div class="">
    <!--- Search By Role: 
    <select name="user_role" id="user_role" onchange="javascript:list_particular(this)" >
    <option value="" selected="selected">All</option>
    <?php //echo get_user_role_dd($i_user_role); ?>
    </select> -->

    <form action="" method="post">Search By Name/User Name: 
        <input class="input-medium" type="text" name="searchval" value="<?php echo $searchval; ?>" >
        <input type="submit" value="SEARCH" class="button" style=" margin-left: 5px; padding: 3px 5px;">
        <input type="button" value="SHOW ALL"  onclick="location = '<?php echo admin_url()?>contact/listing.html'" class="button" style=" margin-left: 5px; padding: 3px 5px;">
    </form>  



</div>
<div class="clear"></div>
Select Action From the list
<select id="act_type" name="act_type">
    <?php echo get_dd(array('Select action', 'Delete Contact User')) ?>
</select>
<input type="button" value="Apply" name="apply" onclick="apply_action(<?php echo ADMIN_ROLE; ?>)" class="button">
<div class="clear"></div>
<div id="show_err_js_msg">
</div>
<div id="messege_portion">
    <?php
        // Message showing from controller
       // echo show_msg();
    ?>
</div>

<table class="details">
    <caption>&nbsp;</caption>
    <?php
        //pr($m_dataset);
    ?>
    <tr>
        <th width="2%"><a rel="tip" title="check all"><input type="checkbox" id="chk_all"></a></th>
        
       <!-- <th width="18%">User ID</th>           -->
        <th width="30%">Contact Information</th>
      <!--  <th width="30%">Business Information</th>
        <th width="20%">About Us</th>-->
        <th width="15%">Added Time</th>
        <?php /*<th width="12%">Phone</th>*/ ?>

        <th width="5%">Action</th>
    </tr>
    <?php   
   // pr($m_dataset) ;
    if(count($m_dataset)>0){
        ?>
        <?php 
            foreach($m_dataset as $m_row){
              
                    $s_email = strlen($m_row['s_email'])>17?substr_replace($m_row['s_email'],'...',15):$m_row['s_email'];
                    $s_phone = strlen($m_row['s_phone'])>12?substr_replace($m_row['s_phone'],'...',10):$m_row['s_phone'];
                 

                ?>
                <tr>
                    <td><a rel="tip" title="check this admin"><input type="checkbox" class="chk_admin" name="chkadmin[]" value="<?php echo strEncode($m_row['id']); ?>"></a></td>
                    <td align="left" valign="top">
                     <span style="font-weight: bold; color: black;">Name : </span><?php echo ucwords($m_row['s_fname'])." ".ucwords($m_row['s_lname']); ?><br />
                     <span style="font-weight: bold; color: black;">Email : </span><?php echo $m_row['s_email']; ?><br />
                     <span style="font-weight: bold; color: black;">Phone No : </span><?php echo $m_row['s_phone']; ?><br />
                     <span style="font-weight: bold; color: black;">Address : </span><?php echo $m_row['s_address']; ?><br />
                     <span style="font-weight: bold; color: black;">City : </span><?php echo $m_row['s_city']; ?><br />
                     <span style="font-weight: bold; color: black;">State : </span><?php echo $m_row['state']; ?><br />
                     <span style="font-weight: bold; color: black;">Country : </span><?php
                     
                     if($m_row['s_country']==254)
                     echo 'USA';
                     
                     else
                     echo $m_row['s_country'];
                      ?><br />
                     <span style="font-weight: bold; color: black;">Zip : </span><?php echo $m_row['s_zip']; ?>
                    </td>
                   
                    <!--<td align="left" valign="top">
                        
                    <span style="font-weight: bold; color: black;">Company Name : </span><?php //echo $m_row['s_cname']; ?><br />
                     <!--<span style="font-weight: bold; color: black;">Annual Revenue : </span><?php //echo $m_row['s_annual_revenue']; ?><br />
                     <span style="font-weight: bold; color: black;">Number Of Location : </span><?php //echo $m_row['s_number_of_location']; ?><br />
                     <?php //if($m_row['s_online'] != ''){ 
                         //$arr = @unserialize($m_row['s_online']);
                         //$str = @implode(',',$arr);
                         ?>
                     <span style="font-weight: bold; color: black;">Is Online? </span><?php echo $str; ?><br />
                     <?php //} ?>
                     
                     <span style="font-weight: bold; color: black;">Website : </span><?php echo $m_row['s_website']; ?><br />
                     <span style="font-weight: bold; color: black;">Product/Services : </span><?php echo $m_row['s_product_or_services']; ?><br />
                     <span style="font-weight: bold; color: black;">Average Product/Services Price : </span><?php echo $m_row['s_product_or_services_avg_price']; ?><br />
                     <span style="font-weight: bold; color: black;">Average Profit : </span><?php echo $m_row['s_avg_profit']; ?><br />
                     <span style="font-weight: bold; color: black;">Industry : </span><?php echo $industry[$m_row['s_industry']]; ?>
                        
                    </td>  -->
                    <!--<td valign="top">  <?php //echo character_limiter($m_row['s_about_us'], 250, "&#8230;&nbsp;&nbsp;<br /><a href='javascript:void(0);' onclick='view_msg(this)'>View More</a>");?><sapn class="hidfield" style="display:none;"><?php echo $m_row['s_about_us'];?></sapn></td> -->
                    <td>  <?php echo date('m/d/Y h:ia',$m_row['i_added_time']);?></td>
                   
                    <td align="center"> 
                        <a rel="tip" title="Delete contact details" href="javascript:delete_confirmation('<?php echo admin_url().'contact/del/'.strEncode($m_row['id']).'/'.strEncode($this->uri->uri_string()); ?>');">
                            <img width="14" height="14" border="0" style="margin-right:5px;" alt="Delete" src="<?php echo base_url()?>images/admin/delete.png">
                        </a>
                    </td>
                   

                </tr>
               
            <?php } ?>
        <?php }else{ ?>
        <tr><td colspan="9" align="center">No Data Found</td></tr>
        <?php } ?>

</table>                  
<?php echo $user_page_link; ?>

