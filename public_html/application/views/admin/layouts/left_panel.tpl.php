<?php 
    $menu_access = config_item('menu_access');
    $arr_user_access  = is_array(get_ses_data('i_roles'))?get_ses_data('i_roles'):array();
     //pr($arr_user_access);
     //  pr(get_ses_data());
?>

<div id="sidebar">
     <div class="Collapse">
        <a href="javascript:collapse_sidebar();" target="_self" title="Collapse Left Menu" id="Collapse" rel='tip'>
            <img src="images/icons/collapse-right.png" alt="" border="0"/>
        </a>
        </div>                           
            <ul class="nav" >


  <?php if(array_intersect($menu_access['menu_user'], $arr_user_access)){ ?>
        <li><a class="headitem itemuser" href="javascript:void(0);">Lead Manager</a>
            <ul class="<?php echo ($s_menu_id == 'menu_user')?'opened':''; ?>" >
                           <?php if(array_intersect($menu_access['list_user'], $arr_user_access)) { ?> 
                    <li class="<?php echo ($s_menu_id == 'menu_user' && $s_sub_menu_id=='list_user')?'current':''; ?>">
                        <a href="<?php echo admin_url()?>contact/listing.html">Lead Listing</a>
                    </li>
                     <?php }  ?>
            </ul>
        </li>
        <?php }?>
  <?php if(array_intersect($menu_access['menu_user'], $arr_user_access)){ ?>
        <li><a class="headitem itemuser" href="javascript:void(0);">Email Manager</a>
            <ul class="<?php echo ($s_menu_id == 'menu_email')?'opened':''; ?>" >
                           <?php if(array_intersect($menu_access['list_user'], $arr_user_access)) { ?> 
                    <li class="<?php echo ($s_menu_id == 'menu_email' && $s_sub_menu_id=='list_email')?'current':''; ?>">
                        <a href="<?php echo admin_url()?>email/listing.html">Email Listing</a>
                    </li>
                     <?php }  ?>
            </ul>
        </li>
        <?php }?>
</ul><!--end subnav-->
    
            
            
            <!--<div class="flexy_datepicker"></div> -->
                    </div>