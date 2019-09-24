<script type="text/javascript">

    //$(function()
    //{
    //  var numberOfCheckboxesSelected = $('input:checkbox:checked').length;
    //  alert(numberOfCheckboxesSelected);  
    //  if(numberOfCheckboxesSelected==0)
    //  {
    //      $('.free').css('display','inline');
    // $('.free').not(':checked').each(function(){
    //            alert(1);
    //                        $('.free checkbox').attr('disabled','disabled');
    //                     
    //     
    //      
    //      $('.select').css('display','none');
    //  }
    //  else
    //  {
    //         $('.free').css('display','none');
    //      $('.select').css('display','inline');
    //   
    //  }
    //});
    //function sign_set()
    //{
    // 
    // 
    //   $('#div1').css('display','inline');
    //}

    //function check_status(e)
    //{
    // alert(1);
    //        var add_id = $(e).attr('check_id');
    //    var check_type = $(e).attr('check_type');
    //    alert(add_id);
    //  alert(address_type);
    //             if($(e).is(':checked')){
    //                value = 1;
    //            }else{
    //                value =0;
    //            }
    //            alert(value);
    //            $.post('<?php echo base_url()?>admin/user/statChange' ,
    //            {'id':add_id,'check_type':check_type,'value':value},
    //            function(result)
    //            {
    // alert(result);
    //                if(result==1)
    //                    {
    //                    alert('Status updated successfully');
    //                }
    //            });


    //    
    //}


    $(function(){

        if($('#radio_free').is(':checked')){
            $('#price_list').children().css('color','#666');
            $('#price_list').children().children('input').attr('disabled',true);
        } else {
            $('#price_list').children().css('color','#000');
            $('#price_list').children().children('input').attr('disabled',false);
        }

        $('.radio_cls').click(function(){

            if($('#radio_free').is(':checked')){
                $('#price_list').children().css('color','#666');
                $('#price_list').children().children('input').attr('disabled',true);
            } else {
                $('#price_list').children().css('color','#000');
                $('#price_list').children().children('input').attr('disabled',false);
            }


        });
        
        $('#signupset_but').toggle(function(){
            $('#sam').show();
        },function(){
            $('#sam').hide();
        });

    });

</script>
<?php
    if($s_action=='edit'){
        $d_ammount=$m_dataset['d_ammount'];
        $i_day_of_sub=$m_dataset['i_day_of_sub'];
        $s_text=$m_dataset['s_text_to_show'];
    } 
    else{
        $d_ammount="";
        $i_day_of_sub="";
        $s_text="";
    }             
?>
<h2>Sign Up Configuration</h2>
<?php /* <h3>Admin details</h3> */ ?>
<?php 
    echo validation_errors('<div class="error closeable">', '</div>'); 
    if(!empty($s_msg)){
        echo '<div class="error closeable">'.$s_msg.'</div>';
    }
?>
<?php
    // Message showing from controller
    echo show_msg();
?>
<span class="small req">[ * marked field are mandatory ]</span>
<form action="" enctype="multipart/form-data" method="post">

    <label>Ammount <span class="req">*</span></label>
    $ <input type="text" id="ammount" name="ammount" value="<?php echo set_value('ammount',$d_ammount); ?>" class="input-vsmall money"/>

    <label>Day of Subscribssion<span class="req">*</span></label>
    <input type="text" id="dayofsub" name="dayofsub" value="<?php echo set_value('dayofsub',$i_day_of_sub); ?>" class="input-vsmall"/>  

    <label>Text to show <span class="req">*</span></label>
    <input type="text" id="texttoshow" name="texttoshow" value="<?php echo set_value('texttoshow',$s_text); ?>" class="input-big"/>  

    <br />
    <?php /*   <label><input type="checkbox" name="reminder">Send Notification To This User</label> */ ?>
    <input type="submit" value="Submit" name="submit" class="button">                                   

</form>
<br><br>


<h3>Sign Up Configuration Listing</h3>
<div class="clear"></div>
Select Action From the list
<select id="act_type" name="act_type">
    <?php echo get_dd(array('Select action', 'Delete Sign up Configuration')) ?>
</select>
<input type="button" value="Apply" name="apply" onclick="apply_action_config()" class="button">
<div class="clear"></div>
<div id="show_err_js_msg">
</div>

<table class="details">
    <caption>&nbsp;</caption>
    <?php
        // pr($m_dataset);
    ?>

    <tr>
        <th style="width:10px;"><a rel="tip" title="check all"><input type="checkbox" check_type="all" onclick="check_status(this)" id="chk_all"></a></th>        
        <th width="20%">Ammount</th>
        <th width="20%">Day of Subscribtion</th>
        <th width="50%">Text to show</th>
        <th width="10%" colspan="2">Action</th>
    </tr>
    <?php if(count($m_all_dataset)>0):?>
        <?php 
            foreach($m_all_dataset as $m_row):  
                $s_text = strlen($m_row['s_text_to_show'])>60?substr_replace($m_row['s_text_to_show'],'...',58):$m_row['s_text_to_show'];                                                     
            ?>
            <tr>
                <td><a rel="tip" title="check this admin"><input type="checkbox" class="chk_admin" check_type="single" name="chkadmin[]" check_id="<?php echo $m_row['id']; ?>" value="<?php echo strEncode($m_row['id']); ?>"></a></td>
                <td align="left">
                    $<?php echo put_safe($m_row['d_ammount']); ?>
                </td>
                <td align="left">
                    <?php echo ($m_row['i_day_of_sub']>1)?$m_row['i_day_of_sub']." Days":$m_row['i_day_of_sub']." Day"; ?> 
                </td>
                <td align="left">
                    <a rel="tip" title="show comments" href="javascript:show_comments('<?php echo put_safe($m_row['s_text_to_show']); ?>')" class="link_show"><?php echo $s_text;?></a>

                </td>


                <td align="center">

                    <a rel="tip" title="Edit signup configuration details" href="<?php echo admin_url().'user/signupconfig/'.strEncode($m_row['id']); ?>">
                        <img width="14" height="14" border="0" style="margin-right:5px;" alt="Delete" src="<?php echo base_url()?>images/admin/edit.png">
                    </a>
                </td>
                <td align="center">          
                    <a rel="tip" title="Delete signup configuration details" href="javascript:void(0)" onclick="javascript:delete_confirmation_config('<?php echo admin_url()."user/del-signupconfig/".strEncode($m_row['id']) ?>');">
                        <img width="14" height="14" border="0" style="margin-right:5px;" alt="Delete" src="<?php echo base_url()?>images/admin/delete.png">
                    </a>                                                



                </td>
            </tr>

            <?php endforeach; ?>
        <?php endif; ?>
</table>
<input type="button" value="Signup set" id="signupset_but" class="button"></br></br>
<div style="display: none;" id="sam">
<form action="<?php echo base_url()?>admin/user/changeConfigure" method="post">
<div   id="div1">
    <input type="radio" class="radio_cls" type="free" name="set_signup" id="radio_free" <?php echo ($is_free == 0)?'checked="checked"':'';?>><span>Free</span>
    <input type="radio" class="radio_cls" type="pay" name="set_signup" id="set_signup1" <?php echo ($is_free == 1)?'checked="checked"':'';?>><span>Pay</span>
</div>


<div  class="free">
    <?php
        //pr($m_all_dataset);
        if(count($m_all_dataset)>0){?>
        <ul id="price_list">
            <?php 
                foreach($m_all_dataset as $m_row){  
                ?>
                <li> <input type="checkbox" name="chk_signup[]" value="<?php echo $m_row['id'];?>" <?php echo ($m_row['is_show_in_signup'] == 1)?'checked="checked"':'';?>> &nbsp;<?php echo $m_row['s_text_to_show'];?>($<?php echo $m_row['d_ammount'];?>)</li>

                <?php } ?> 
        </ul>
        <?php } ?>

</div>
<input type="submit" value="Save" class="button">
</form>
</div>