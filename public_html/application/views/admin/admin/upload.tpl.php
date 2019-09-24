<?php /*
<div class="con_middle">
    <div class="inermidarea">
        <h1>Upload Video</h1>
        <div class="farea">
            <form id="contactform" method="post" name="aa" action="" enctype="multipart/form-data" >
                <div class="clr"></div>
                <?php 
                    echo validation_errors('<div id="error">', '</div>'); 
                    if(!empty($s_msg)){
                        echo '<div id="error">'.$s_msg.'</div>';
                    }
                    echo show_msg();
                ?>
                <ul>
                <li>
                    <label for="name">Video Title</label>
                    <input type="text" class="text" name="vid_name" id="vid_name" value="<?php echo set_value('vid_name'); ?>" >
                </li>
                <li>
                    <label for="company">Video Description</label>
                    <textarea class="text" name="vid_description" id="vid_description" cols="50" rows="4" ><?php echo set_value('vid_description'); ?></textarea>
                </li>
                <li>
                    <label for="email">Pornstar Name</label>
                    <input type="text" class="text" name="pstar_name" id="pstar_name" value="<?php echo set_value('pstar_name'); ?>" >
                </li>
                <li>
                    <label for="subject">Upload Video</label>
                    <input type="file" class="file" name="up_video" id="video" size="63" />
                </li>
                <li>
                    <label for="message">Select Category</label>
                    <select name="category" id="category">
                        <option value="">Select video Category</option>
                        <?php echo get_video_category_dd(set_value('category')); ?>
                    </select>
                </li>
                <li class="buttons">
                    <input type="submit" value="SUBMIT" class="send" id="send" name="send">
                    <div class="clr"></div>
                </li>
                </ol>
            </form></div>
    </div>


</div> */ ?>


<div class="SR">
    <div class="headingpart">
        <div class="headingpart2">&nbsp; &nbsp; &nbsp;  &nbsp;Upload Video</div>
        <div class="headingpart_right">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Demo Advertisement </div>
    </div>
    <div class="clr"></div>
    <div class="Whitearea">
        <div class="Whitearea_top">
            <!-- register -->
            <div class="registercontain">

                <form action="" method="post" id="contactform">
                    <div class="clr"></div>
                    <?php 
                        echo validation_errors('<div id="error">', '</div>'); 
                        if(!empty($s_msg)){
                            echo '<div id="error">'.$s_msg.'</div>';
                        }
                    ?>
                    <?php
                        // Message showing from controller
                        echo show_msg();
                    ?>
                    <ul>
                        <li>
                            <label for="name">Video Title</label><br />
                            <input type="text" class="text" name="vid_name" id="vid_name" value="<?php echo set_value('vid_name'); ?>" >
                        </li>
                        <li>
                            <label for="name">Video Description</label><br />
                            <textarea style="height: 150px" class="text" name="vid_description" id="vid_description" cols="50" rows="4" ><?php echo set_value('vid_description'); ?></textarea>
                        </li>
                        <li>
                            <label for="name">Pornstar Name</label><br />
                            <input type="text" class="text" name="pstar_name" id="pstar_name" value="<?php echo set_value('pstar_name'); ?>" >
                        </li>
                        <li>
                            <label for="email">Upload Video</label><br />
                            <input type="file" class="file" name="up_video" id="video" size="40" />
                        </li>
                        <li>
                            <label for="email">Select Category</label><br />
                            <select name="category" id="category" class="formbox">
                                <option value="">Select video Category</option>
                                <?php echo get_video_category_dd(set_value('category')); ?>
                            </select>
                        </li>                        
                        <li><br />
                            <input type="submit" value="SUBMIT" class="btn" id="send" name="send">
                            <div class="clr"></div>
                        </li>
                    </ul>
                </form>
            </div>
            <!-- register -->
            <div class="banner"></div>
            <div class="clr"></div>
        </div>
    </div>
</div>
