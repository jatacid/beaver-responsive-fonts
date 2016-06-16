<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/*
Plugin Name: Beaver Responsive Fonts
Plugin URI: https://j7digital.com
Description: Changes Beaver Builder Theme (or child theme) to have font settings scale on a perfect ratio instead of pixels.
Author: J7Digital
Version: 1.1
Author URI: https://j7digital.com
License: GPLv2 or later

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
*/



//Updater Class
if (!function_exists( 'github_plugin_updater_test_init' )) {
function github_plugin_updater_test_init() {
// ... proceed to declare your function
include_once 'updater.php';
define( 'WP_GITHUB_FORCE_UPDATE', true );
}
}
add_action( 'init', 'github_plugin_updater_test_init' );



function responsive_fonts_updater() {
  if ( is_admin() ) { // note the use of is_admin() to double check that this is happening in the admin
$login = 'jatacid/beaver-responsive-fonts';

    $config = array(
      'slug' => plugin_basename( __FILE__ ),
      'proper_folder_name' => 'beaver-responsive-fonts',
      'api_url' => 'https://api.github.com/repos/' . $login,
      'raw_url' => 'https://raw.github.com/' . $login .'/master',
      'github_url' => 'https://github.com/'. $login,
      'zip_url' => 'https://github.com/'. $login .'/archive/master.zip',
      'sslverify' => true,
      'requires' => '3.0',
      'tested' => '3.3',
      'readme' => 'README.md',
      'access_token' => '',
    );
    new WP_GitHub_Updater( $config );
}
}
add_action( 'init', 'responsive_fonts_updater' );





function brf_change_customizer_defaults($wp_customize) {

//checks for BB-theme
$theme = wp_get_theme();
if ('bb-theme' == $theme->name || 'Beaver Builder Theme' == $theme->parent_theme) {

//$wp_customize->remove_section('fl-heading-font');
//$wp_customize->remove_panel('fl-h1-font-size');

$wp_customize->remove_control('fl-h1-font-size');
$wp_customize->remove_control('fl-h2-font-size');
$wp_customize->remove_control('fl-h3-font-size');
$wp_customize->remove_control('fl-h4-font-size');
$wp_customize->remove_control('fl-h5-font-size');
$wp_customize->remove_control('fl-h6-font-size');

$wp_customize->remove_control('fl-h1-line-height');
$wp_customize->remove_control('fl-h2-line-height');
$wp_customize->remove_control('fl-h3-line-height');
$wp_customize->remove_control('fl-h4-line-height');
$wp_customize->remove_control('fl-h5-line-height');
$wp_customize->remove_control('fl-h6-line-height');

// $wp_customize->remove_control('fl-h1-letter-spacing');
// $wp_customize->remove_control('fl-h2-letter-spacing');
// $wp_customize->remove_control('fl-h3-letter-spacing');
// $wp_customize->remove_control('fl-h4-letter-spacing');
// $wp_customize->remove_control('fl-h5-letter-spacing');
// $wp_customize->remove_control('fl-h6-letter-spacing');
}

// $mods = FLCustomizer::get_mods();
// $vars = array();


// Set a Minimum option (mobiles)
// Set a Maximum option (super desktops)
// Set Ratio? Golden Ratio


// Add the djcustom Media Settings to the customizer.
  $wp_customize->add_section( 'responsive-fonts', array(
    'title'=> __( 'Responsive Typography Settings', 'fl-automator' ),
    'description' => __( 'Overrides default Beaver Builder Typography with a more responsive equivalent.', 'fl-automator' ),
    'priority'=> 130,
    ) );

  $wp_customize->add_setting('fl_responsive_font_minimum', array(
  	'default' => '14'
      )
  );

  $wp_customize->add_control('fl_responsive_font_minimum', array(
    'label' => 'Responsive Minimum',
    'description' => 'minimum paragraph font size (seen on mobiles)',
    'section' => 'responsive-fonts',
    'type' => 'number',
    'input_attrs' => array(
    	'min' => 10,
    	'max' => 30),
    )
  );


  $wp_customize->add_setting('fl_responsive_font_maximum', array(
      'default' => '20'
      )
  );

  $wp_customize->add_control('fl_responsive_font_maximum', array(
    'label' => 'Responsive maximum',
    'description' => 'maximum paragraph font size (seen on super desktops)',
    'section' => 'responsive-fonts',
    'type' => 'number',
    'input_attrs' => array(
    	'min' => 10,
    	'max' => 30),
    )
  );




  $wp_customize->add_setting('fl_responsive_font_ratio', array(
      'default' => 'option-1'
      )
  );

  $wp_customize->add_control('fl_responsive_font_ratio', array(
    'label' => 'Ratio Type',
    'description' => 'Select the ratio for font scaling',
    'section' => 'responsive-fonts',
    'type' => 'select',
    'choices' => array(
      'option-1' => 'Golden Ratio (Big & Beautiful)',
      'option-2' => 'Perfect Fifth (Less dramatic)',
    'option-3' => 'Perfect Fourth (Even Less Scaled)'),
    )
  );

}
add_action( 'customize_register', 'brf_change_customizer_defaults', 99);





// Customize mce editor font sizes
if ( ! function_exists( 'wpex_mce_text_sizes' ) ) {
    function wpex_mce_text_sizes( $initArray ){
        $initArray['fontsize_formats'] = "0.25rem 0.5rem 0.75rem 1rem 1.25rem 1.5rem 1.75rem 2rem 2.25rem 2.5rem 2.75rem 3rem 3.25rem 3.5rem 3.75rem 4rem 4.25rem 4.5rem 4.75rem 5rem 5.25rem 5.5rem 5.75rem 6rem 8rem";
        return $initArray;
    }
}
add_filter( 'tiny_mce_before_init', 'wpex_mce_text_sizes' );





function beaver_responsive_fonts_do_css(){

 $settings =  FLCustomizer::get_mods();
 $settings_min = $settings['fl_responsive_font_minimum'];
    if ($settings_min != false ){
        $settings_min = $settings_min;
    } else{
    	$settings_min = '14';
    }

  $settings_max = $settings['fl_responsive_font_maximum'];
    if ($settings_max != false ){
        $settings_max = $settings_max;
    } else{
    	$settings_max = '18';
    }



 $settings_ratio = $settings['fl_responsive_font_ratio'];
    if ($settings_ratio != false){
        $settings_ratio = $settings_ratio;
    } else{
        $settings_ratio = 'option-1';
    }

if ($settings_ratio == 'option-1'){
//Golden Ratio
$settings_ratio = array(
'h1' => '6.854',
'h2' => '4.236',
'h3' => '2.618',
'h4' => '1.618',
'h5' => '1.0',
'h6' => '0.618',
'p' => '1.0',
);
} elseif ($settings_ratio == 'option-2') {
//Perfect Fifth Ratio
$settings_ratio = array(
'h1' => '5.063',
'h2' => '3.375',
'h3' => '2.25',
'h4' => '1.5',
'h5' => '1.0',
'h6' => '0.667',
'p' => '1.0',
);
}else {
//Perfect Fourth Ratio
$settings_ratio = array(
'h1' => '2.441',
'h2' => '1.953',
'h3' => '1.563',
'h4' => '1.25',
'h5' => '1.0',
'h6' => '0.8',
'p' => '1.0',
);
}


echo '<style type="text/css">';
include_once('beaver-responsive-fonts.css.php');
echo '</style>';
}
add_action('fl_head', 'beaver_responsive_fonts_do_css', 99);