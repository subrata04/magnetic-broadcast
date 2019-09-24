<?php /*
    <div class="con_middle">

    <div class="inermidarea">
    <h1>Register :</h1>
    <div class="farea">
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
    <ol>
    <li>
    <label for="username">User Name</label>
    <input type="text" id="username" name="username" class="text" value="<?php echo set_value('username'); ?>" />
    </li>
    <li>
    <label for="email">Email</label>
    <input type="text" id="email" name="email" class="text" value="<?php echo set_value('email'); ?>" />
    </li>
    <li>
    <label for="password">Choose a Password</label>
    <input type="password" id="password" name="password" class="text" />
    </li>
    <li>
    <label for="repassword">Confirm Password</label>
    <input type="password" id="repassword" name="repassword" class="text"  />
    </li>
    <li>
    <label for="fname">First Name</label>
    <input type="text" id="fname" name="fname" class="text" value="<?php echo set_value('fname'); ?>" />
    </li>
    <li>
    <label for="lname">Last Name</label>
    <input type="text" id="lname" name="lname" class="text" value="<?php echo set_value('lname'); ?>" />
    </li>
    <li>
    <label for="name">Phone</label>
    <input type="text" id="phone" name="phone" class="text" value="<?php echo set_value('phone'); ?>" />
    </li>
    <li>
    <label for="gender">Gender</label>
    <select name="gender" id="gender" class="formbox" value="<?php echo set_value('gender'); ?>" >
    <option value="Male">Male</option>
    <option value="Female">Female</option>
    </select>
    </li>
    <li class="buttons">
    <input type="submit" name="" id="" src="" class="send" value="SUBMIT"  />
    <div class="clr"></div>
    </li>
    </ol>
    </form></div>
    </div>


    </div>

*/ ?>

<div class="SR">
    <div class="headingpart">
        <div class="headingpart2">&nbsp; &nbsp; &nbsp;  &nbsp;Register :</div>
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
                            <label for="name">First Name</label><br />
                            <input type="text" id="fname" name="fname" class="text" value="<?php echo set_value('fname'); ?>" />
                        </li>
                        <li>
                            <label for="name">Last Name</label><br />
                            <input type="text" id="lname" name="lname" class="text" value="<?php echo set_value('lname'); ?>" />
                        </li>
                        <li>
                            <label for="name">Phone</label><br />
                            <input type="text" id="phone" name="phone" class="text" value="<?php echo set_value('phone'); ?>" />
                        </li>
                        <li>
                            <label for="email">Email</label><br />
                            <input type="text" id="email" name="email" class="text" value="<?php echo set_value('email'); ?>" />
                        </li>
                        <li>
                            <label for="email">Username</label><br />
                            <input type="text" id="username" name="username" class="text" value="<?php echo set_value('username'); ?>" />
                        </li>
                        <li>
                            <label for="password">Choose a Password</label><br />
                            <input type="password" id="password" name="password" class="text" />
                        </li>
                        <li>
                            <label for="password">Confirm Password</label><br />
                            <input type="password" id="repassword" name="repassword" class="text"  />
                        </li>
                        <li>
                            <label for="gender">Gender</label><br />
                            <select name="gender" id="gender" class="formbox" value="<?php echo set_value('gender'); ?>" >
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </li>
                        <li><br />
                            <input type="submit" name="" id="" src="" class="btn" value="SUBMIT"  />
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
