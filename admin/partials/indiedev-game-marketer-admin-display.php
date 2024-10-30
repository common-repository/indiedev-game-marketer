<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.indiedev.tools/product/indiedev-game-marketer-wp-plugin-for-wordpress/
 * @since      1.0.0
 *
 * @package    Indiedev_Game_Marketer
 * @subpackage Indiedev_Game_Marketer/admin/partials
 */

if (!current_user_can('manage_options')) {
    return;
}

function idgm_admin_sidebar() {
    ?>
    <div class="idgm-admin-sidebar">
        <center><img src="<?php echo plugins_url(); ?>/indiedev-game-marketer/images/logo.png" class="idgm-logo" /></center><br />
        <center>[ <a target="_blank" href="http://blacklodgegames.com/indiedev-game-marketer-wp-plugin-for-wordpress/" style="text-decoration:none;"> <span class="dashicons dashicons-welcome-learn-more"></span> <?php _e('Full Documentation', 'indiedev-game-marketer'); ?></a> ]</center>
        <div class="idgm-box"><ul>
    <?php
    
    $rss = new DOMDocument();
    $rss->load('http://blacklodgegames.com/category/indie-game-marketing/feed/');
    $feed = array();
    foreach ($rss->getElementsByTagName('item') as $node) {
            $item = array ( 
                    'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
                    'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
                    );
            array_push($feed, $item);
    }
    $limit = 3;
    for($x=0;$x<$limit;$x++) {
            $title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
            $link = $feed[$x]['link'];
            echo '<li class="idgm-sidelink"> - <strong><a href="'.$link.'" title="'.$title.'">'.$title.'</a></strong></li>';
    }    
    ?></ul><center><a href="http://blacklodgegames.com" target="_blank"><img src="<?php echo plugins_url(); ?>/indiedev-game-marketer/images/blg-logo.png" class="idgm-logo" /></a></center><br /></div></div><br /><?php
}

?>
<div class="wrap">
    
    <h2 class="nav-tab-wrapper">
      <a class="nav-tab  nav-tab-active" href="#tab-settings" data-tab-index="1"><?php _e('Settings', $this->plugin_name); ?></a>
      <a class="nav-tab" href="#tab-games" data-tab-index="2"><?php _e('Games', $this->plugin_name); ?></a>
      <a class="nav-tab" href="#tab-press-kits" data-tab-index="3"><?php _e('Press Kits', $this->plugin_name); ?></a>
      <a class="nav-tab" href="#tab-social" data-tab-index="5"><?php _e('Social', $this->plugin_name); ?></a>
      <a class="nav-tab" href="#tab-more" data-tab-index="6"><?php _e('More', $this->plugin_name); ?>...</a>
      <a class="nav-tab" href="#tab-debug" data-tab-index="7"><?php _e('Diagnostics', $this->plugin_name); ?></a>
      
    </h2>
    <div id="sections">

        <section id="tab-settings">
            <div class="idgm-left">
                <h1><strong> &rarr; <?php _e('Settings', $this->plugin_name); ?> &larr; </strong></h1>
                <?php $this->Indiedev_Game_Marketer_options_page(); ?>
            </div>
        </section>    

        <section id="tab-games">
            <div class="idgm-left">
            <h1><strong> &rarr; <?php _e('Games', $this->plugin_name); ?> &larr; </strong></h1>
            <?php $this->Indiedev_Game_Marketer_games_page(); ?>
            </div>
        </section>                
        
        <section id="tab-press-kits">
            <div class="idgm-left">
            <h1><strong> &rarr; <?php _e('Press Kits', $this->plugin_name); ?> &larr; </strong></h1>
            <?php $this->Indiedev_Game_Marketer_presskit_page(); ?>
            </div>
        </section>       

        <section id="tab-social">
            <div class="idgm-left">
            <h1><strong> &rarr; <?php _e('Social', $this->plugin_name); ?> &larr; </strong></h1>
            <?php $this->Indiedev_Game_Marketer_social_page(); ?>
            <div>
        </section>     

        <section id="tab-more">
            <div class="idgm-left">
            <h1><strong> &rarr; <?php _e('More', $this->plugin_name); ?> &larr; </strong></h1>
            <?php $this->Indiedev_Game_Marketer_more_page(); ?>
            </div>
        </section>  
        
        <section id="tab-debug">
            <div class="idgm-left">
            <h1><strong> &rarr; <?php _e('Diagnostics', $this->plugin_name); ?> &larr; </strong></h1>
            <?php $this->Indiedev_Game_Marketer_diagnostics_page(); ?>
            </div>
        </section>           
           
    </div>
            
    <?php idgm_admin_sidebar(); ?>
            
            
</div>

