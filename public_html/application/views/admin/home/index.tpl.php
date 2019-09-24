<h2>Dashboard</h2>
<?php 
    // error message showing[start]
   // echo show_msg();
    // error message showing[end]
    $menu_access = config_item('menu_access');
    $arr_user_access  = get_ses_data('i_roles');

   /* if(array_intersect($menu_access['user_dash'], $arr_user_access)){ */
    ?>
    <a href="<?php echo admin_url().'contact/listing.html' ?>" class="dashboard_button button_user">
        <span class="dashboard_button_heading two_lines">Contact Manager</span>
    <span>View list, block, delete user from here</span>            </a><!--end dashboard_button-->
   

