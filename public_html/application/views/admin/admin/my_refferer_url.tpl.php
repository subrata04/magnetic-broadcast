<script type="text/javascript" >
$(document).ready(function() {
    $("input:text").focus(function() { $(this).select(); } );
});

</script>
<h3>Home page Url</h3>
<input type="text" class="input-big" value="<?php echo (base_url().$s_username.'/home.html') ?>" />
<h3>Product page Url</h3>
<input type="text" class="input-big" value="<?php echo (base_url().$s_username.'/product.html') ?>" />

<h3>Customer sign-up page Url</h3>
<input type="text" class="input-big" value="<?php echo (base_url().$s_username.'/customer-join-now.html') ?>" />

<h3>Specific Product page Url</h3>
<?php
    if(count($m_dataset)){
        foreach($m_dataset as $m_row){
            // pr($m_row);
            ?>
            <label><?php echo "Product name: ".$m_row['s_title'] ?></label>
            <input type="text" class="input-big" value="<?php echo (base_url().$s_username.'/product/details/'.$m_row['id'].'/'.make_title_url($m_row['s_title'])) ?>" />
            <?php 
        }
    }
?>
