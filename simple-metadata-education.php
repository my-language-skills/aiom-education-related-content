<?php

/*
Plugin Name: Simple Metadata Education
Plugin URI: https://github.com/my-language-skills/simple-metadata-education
Description: Simple Metadata add-on for educational purposes. 
Version: 1.0
Author: My Language Skills team
Author URI: https://github.com/my-language-skills
Text Domain: simple-metadata-education
Domain Path: /languages
License: GPL 3.0
*/

defined ("ABSPATH") or die ("No script assholes!");

require_once( ABSPATH . '/wp-admin/includes/plugin.php' );

//if not presbooks and AIOM not installed, load custom_metadata symbiont (when all packages will be organized, second condition can be removed)
if (!is_plugin_active('pressbooks/pressbooks.php') && !function_exists('x_add_metadata_field')){
	require_once plugin_dir_path( dirname(__FILE__ ) ) . '/simple-metadata-education/symbionts/custom-metadata/custom_metadata.php';
}
if(is_plugin_active('simple-metadata/simple-metadata.php')){
	include_once plugin_dir_path( __FILE__ ) . "admin/smde-site-cpt.php";
	include_once plugin_dir_path( __FILE__ ) . "admin/vocabularies/smde-vocabulary.php";
	include_once plugin_dir_path( __FILE__ ) . "admin/vocabularies/smde-lrmi-vocabulary.php";
	include_once plugin_dir_path( __FILE__ ) . "admin/vocabularies/smde-classification-vocabulary.php";
	include_once plugin_dir_path( __FILE__ ) . "admin/smde-admin-settings.php";
	include_once plugin_dir_path( __FILE__ ) . "admin/smde-output.php";
	include_once plugin_dir_path( __FILE__ ) . "admin/smde-init-metaboxes.php";
	//loading network settings only for multisite installation
	if (is_multisite()){
		include_once plugin_dir_path( __FILE__ ) . "network-admin/smde-network-admin-settings.php";
	}
} else {
	if (is_multisite()){
		add_action( 'network_admin_notices', function () {
			?>
    		<div class="notice notice-info is-dismissible">
        		<p><strong>'Simple Metadata Education'</strong> functionality is deprecated due to the following reason: <strong>'Simple Metadata'</strong> plugin is not installed or not activated. Please, install <strong>'Simple Metadata'</strong> in order to fix the problem.</p>
    		</div>
    	<?php
		});
	} else {
		add_action( 'admin_notices', function () {
			?>
    		<div class="notice notice-info is-dismissible">
        		<p><strong>'Simple Metadata Education'</strong> functionality is deprecated due to the following reason: <strong>'Simple Metadata'</strong> plugin is not installed or not activated. Please, install <strong>'Simple Metadata'</strong> plugin in order to fix the problem.</p>
    		</div>
    	<?php
		});
	}
}