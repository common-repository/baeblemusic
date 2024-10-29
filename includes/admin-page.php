<?php

// The visual elements 
function bm_options_page() {

    global $bm_options;
    
    // Start the buffer
    ob_start(); ?>

    <!-- The HTML elements -->
    <div class="wrap">
        <h2><?php _e('Baeblemusic video plugin configuration','bm_domain'); ?></h2>
        <form method="post" action="options.php">
        <?php settings_fields('bm_settings_group'); ?>
        <h3><?php _e('Enable plugin?','bm_domain'); ?></h3>
        <p>
        <?php $statuses = array('Yes','No'); ?>
        <select name="bm_settings[activate]" id="bm_settings[activate]">
        <?php foreach ($statuses as $status) { ?>
        <?php if($bm_options['activate'] == $status) {$selected = 'selected="selected"';} else {$selected='';} ?>     
        <option value="<?php echo $status; ?>" <?php echo $selected;?> ><?php echo $status; ?></option>
        <?php } ?>
        </select>
        </p>
        <p>
        <hr style=" border: 0; height: 0; border-top: 1px solid rgba(0, 0, 0, 0.1); border-bottom: 1px solid rgba(255, 255, 255, 0.3);">    
        </p>
    
        <div id="left_content" style="height: 360px;float: left;padding-right: 30px">
            <h3>Append to Posts</h3>
            <p />
            <h4><?php _e('Active Categories','bm_domain'); ?></h4> <a rel="group_1" href="#select_all">Select All</a> | <a rel="group_1" href="#select_none">Clear All</a> | <a rel="group_1" href="#invert_selection">Invert Selection</a>
            <p />
            <fieldset id="group_1">
            <input id="bm_settings[Trending]" name="bm_settings[Trending]" type="checkbox" value="1" <?php checked('1',$bm_options['Trending']); ?>>
            <label class="description" for="bm_settings[Trending]"><?php _e('Trending','bm_domain'); ?></label>
            <p />
            <input id="bm_settings[Newest]" name="bm_settings[Newest]" type="checkbox" value="1" <?php checked('1',$bm_options['Newest']); ?>>
            <label class="description" for="bm_settings[Newest]"><?php _e('Newest','bm_domain'); ?></label>
            <p />
            <input id="bm_settings[Concerts]" name="bm_settings[Concerts]" type="checkbox" value="1" <?php checked('1',$bm_options['Concerts']); ?>>
            <label class="description" for="bm_settings[Concerts]"><?php _e('Concerts','bm_domain'); ?></label>
            <p />
            <input id="bm_settings[Sessions]" name="bm_settings[Sessions]" type="checkbox" value="1" <?php checked('1',$bm_options['Sessions']); ?>>
            <label class="description" for="bm_settings[Sessions]"><?php _e('Sessions','bm_domain'); ?></label>
            <p />
            <input id="bm_settings[Interviews]" name="bm_settings[Interviews]" type="checkbox" value="1" <?php checked('1',$bm_options['Interviews']); ?>>
            <label class="description" for="bm_settings[Interviews]"><?php _e('Interviews','bm_domain'); ?></label>
            <p />
            <input id="bm_settings[Music Videos]" name="bm_settings[Music Videos]" type="checkbox" value="1" <?php checked('1',$bm_options['Music Videos']); ?>>
            <label class="description" for="bm_settings[Music Videos]"><?php _e('Music Videos','bm_domain'); ?></label>
            </fieldset>
            <p />
            <h4><?php _e('# of Thumbnails','bm_domain'); ?></h4>
            <p />
            <?php $statuses = array('1','2','3','4','5'); ?>
            <!-- Set the default to 3 if it has not been set yet -->
            <?php
            if($bm_options['thumbs_append'] == "") {
                $bm_options['thumbs_append'] = 3;
            }
            ?>
            <select name="bm_settings[thumbs_append]" id="bm_settings[thumbs_append]">
            <?php foreach ($statuses as $status) { ?>
            <?php if($bm_options['thumbs_append'] == $status) {$selected = 'selected="selected"';} else {$selected='';} ?>     
            <option value="<?php echo $status; ?>" <?php echo $selected;?> ><?php echo $status; ?></option>
            <?php } ?>
            </select>
            <p />
            <h4><?php _e('Enable?','bm_domain'); ?></h4>
            <p />
            <?php $statuses = array('Yes','No'); ?>
            <select name="bm_settings[post_appending]" id="bm_settings[post_appending]">
            <?php foreach ($statuses as $status) { ?>
            <?php if($bm_options['post_appending'] == $status) {$selected = 'selected="selected"';} else {$selected='';} ?>     
            <option value="<?php echo $status; ?>" <?php echo $selected;?> ><?php echo $status; ?></option>
            <?php } ?>
            </select>
        </div>
    
        <div id="right_content" style="min-height: 360px; border-left: 1px solid rgba(0, 0, 0, 0.1); border-right: 1px solid rgba(255, 255, 255, 0.3); float:left;padding-left: 30px">
            <h3>Standalone Page</h3>
            <p />
            <h4><?php _e('Active Categories','bm_domain'); ?></h4><a rel="group_2" href="#select_all">Select All</a> | <a rel="group_2" href="#select_none">Clear All</a> | <a rel="group_2" href="#invert_selection">Invert Selection</a>
            <p />
            <fieldset id="group_2">
            <input id="bm_settings[Trending_2]" name="bm_settings[Trending_2]" type="checkbox" value="1" <?php checked('1',$bm_options['Trending_2']); ?>>
            <label class="description" for="bm_settings[Trending_2]"><?php _e('Trending','bm_domain'); ?></label>
            <p />
            <input id="bm_settings[Newest_2]" name="bm_settings[Newest_2]" type="checkbox" value="1" <?php checked('1',$bm_options['Newest_2']); ?>>
            <label class="description" for="bm_settings[Newest_2]"><?php _e('Newest','bm_domain'); ?></label>
            <p />
            <input id="bm_settings[Concerts_2]" name="bm_settings[Concerts_2]" type="checkbox" value="1" <?php checked('1',$bm_options['Concerts_2']); ?>>
            <label class="description" for="bm_settings[Concerts_2]"><?php _e('Concerts','bm_domain'); ?></label>
            <p />
            <input id="bm_settings[Sessions_2]" name="bm_settings[Sessions_2]" type="checkbox" value="1" <?php checked('1',$bm_options['Sessions_2']); ?>>
            <label class="description" for="bm_settings[Sessions_2]"><?php _e('Sessions','bm_domain'); ?></label>
            <p />
            <input id="bm_settings[Interviews_2]" name="bm_settings[Interviews_2]" type="checkbox" value="1" <?php checked('1',$bm_options['Interviews_2']); ?>>
            <label class="description" for="bm_settings[Interviews_2]"><?php _e('Interviews','bm_domain'); ?></label>
            <p />
            <input id="bm_settings[Music Videos_2]" name="bm_settings[Music Videos_2]" type="checkbox" value="1" <?php checked('1',$bm_options['Music Videos_2']); ?>>
            <label class="description" for="bm_settings[Music Videos_2]"><?php _e('Music Videos','bm_domain'); ?></label>
            </fieldset>
            <p />
            <h4><?php _e('# of Thumbnails','bm_domain'); ?></h4>
            <p />
            <?php $statuses = array('1','2','3','4','5'); ?>
            <!-- Set the default to 3 if it has not been set yet -->
            <?php
            if($bm_options['thumbs_stand_alone'] == "") {
                $bm_options['thumbs_stand_alone'] = 3;
            }
            ?>
            <select name="bm_settings[thumbs_stand_alone]" id="bm_settings[thumbs_stand_alone]">
            <?php foreach ($statuses as $status) { ?>
            <?php if($bm_options['thumbs_stand_alone'] == $status) {$selected = 'selected="selected"';} else {$selected='';} ?>     
            <option value="<?php echo $status; ?>" <?php echo $selected;?> ><?php echo $status; ?></option>
            <?php } ?>
            </select>
            <p />
            <h4><?php _e('Enable?','bm_domain'); ?></h4>
            <p />
            <?php $statuses = array('Yes','No'); ?>
            <select name="bm_settings[standalone]" id="bm_settings[standalone]">
            <?php foreach ($statuses as $status) { ?>
            <?php if($bm_options['standalone'] == $status) {$selected = 'selected="selected"';} else {$selected='';} ?>
            <option value="<?php echo $status; ?>" <?php echo $selected;?> ><?php echo $status; ?></option>
            <?php } ?>
            </select>
            
        </div>
        <br style="clear:both;"/>
        
        <hr style=" border: 0; height: 0; border-top: 1px solid rgba(0, 0, 0, 0.1); border-bottom: 1px solid rgba(255, 255, 255, 0.3);">  
        
        <p class="submit">
        <input type="submit" class="button-primary" value="<?php _e('Save Options','bm_domain'); ?>" />
        </form>
    </div>
    
    <?php
    
    // flush the buffer to the screen
    echo ob_get_clean();
    
}

// Functions for admin page
function bm_add_options_link() {
    add_options_page('Baeble Music Options','Baeble Music','manage_options','bm-options','bm_options_page');
}

// Add the options page to the admin menu page
add_action('admin_menu','bm_add_options_link');

// make the entry in the database
function bm_register_settings() {
    register_setting('bm_settings_group','bm_settings');
}

// called before any other function on the admin page
add_action('admin_init','bm_register_settings');


if ($_GET["settings-updated"] == "true") {

    // using database instead
    $post_id = get_option('plugin_page_id');
    
    if (($bm_options['activate'] == "No")  OR ($bm_options['standalone'] == "No")) {
        $new_post = array(
        'post_title' => 'Baeblemusic',
        'post_content' => '<!-- This is left blank intentionally -->',
        'post_status' => 'draft',
        'post_date' => date('Y-m-d H:i:s'),
        'post_author' => 1,
        'post_type' => 'page',
        'filter' => true,
        'ID' => $post_id
        );
    } else {
        $new_post = array(
        'post_title' => 'Baeblemusic',
        'post_content' => '<!-- This is left blank intentionally -->',
        'post_status' => 'publish',
        'post_date' => date('Y-m-d H:i:s'),
        'post_author' => 1,
        'post_type' => 'page',
        'filter' => true,
        'ID' => $post_id
        );
    }
    
     add_action('init','nest_func');

    // Fix for WordPress 3.2
    function nest_func() {
        global $new_post;
        wp_insert_post($new_post);
    }
    
    
}
