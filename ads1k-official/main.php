<?php

/**
 * Plugin Name:       Ads1k Official Pop-Under Plugin Tool
 * Plugin URI:        http://ads1k.com/become_pub.php
 * Description:       Ads1k plugin dedicated to maximize publishers' revenues via popunder Geo targeted Ads Serving Technology.
 * Version:           1.1
 * Author:            Ads1K
 * Author URI:        http://ads1k.com/benefit_pub.php
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ads1k
 */

define( 'PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

register_activation_hook (		__FILE__,	'ads1k_ok'	); 
register_deactivation_hook (	__FILE__, 	'ads1k_ko'	);

function ads1k_ok()
{
	add_option( 'ads_Pop',	'',		'', 'yes' );
	add_option( 'ads_Red',	'',		'', 'yes' );
	add_option( 'ads_off',	'0',	'', 'yes' );
}

function ads1k_ko()
{
	delete_option( 'ads_Pop' );
	delete_option( 'ads_Red' );
	delete_option( 'ads_off' );
}

function ads_Xsetting()
{
	register_setting( 'ads_opt_gr1',	'ads_Pop', 'codValid' );
	register_setting( 'ads_opt_gr2',	'ads_Red', 'codValid');
	register_setting( 'ads_opt_gr1',	'ads_off', 'ads1k_xOK');
}

if ( is_admin() )
{
	add_action( 'admin_menu',	'ads_adm_Menu' );
	add_action( 'admin_init',	'ads_Xsetting' );

	add_action( 'wp_loaded',	'ads1k_xOK' );

	function ads_adm_Menu()
	{
		add_menu_page(
						'Ads1K',
						'Ads1K',
						'administrator',
						'ads1k-com',
						'includeT',
						'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6RjEzNjRCMUFBQTc0MTFFNEE0Njg4ODlFMkI5NkQ4N0UiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6RjEzNjRCMUJBQTc0MTFFNEE0Njg4ODlFMkI5NkQ4N0UiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDpGMTM2NEIxOEFBNzQxMUU0QTQ2ODg4OUUyQjk2RDg3RSIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDpGMTM2NEIxOUFBNzQxMUU0QTQ2ODg4OUUyQjk2RDg3RSIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PiXrI+kAAAGXSURBVHjaYvz//z8DJYAFxmjdsIGB88sXBp737xn/srDUAYWWMDIyWgJpESCegK4xIyMDTDPBBOSuXWNg+vuX4Tc7uzDD//81QKFAIE4D4kp8LoAbEFtdzeAxaxbDe0lJaUaIyxyA3pMBYjGiDAABjWPHRID442chIRD3PRB/A+I/aHqMgZgPmwENQPxaf+9er+88PMgaGJHY04EuOgOiMQIRCNYDMfsLJaVLLL9+IWuGuaABqBkUcm+AuAObARe/8/FdPB4UpMz/5g1M7B8QPwbieqDmemCsfAGylYH4E4YBR8LCGG5YWTEAbWdj/vOH4T8jIwNQw0egRh0gbgCyHwCVGSBrRgmDQxERDN94eRm4P3wAa4YC5FQGitKPOGNB8MULBtafPxn+MTPDJYE2M0G9AWJvAVJ6eKMRC+AH4rtA5+cCaTagIRdBsU3IADYozQvEHECsCsRTgIYkQF1yHUh54jPgFZS+DNT0AUj/gPIXQl3CAE3mGNEIA6+BuA+aLp4ANYkjyU0D8pWA9A54QqE0OwMEGACZBIhqgzYsPwAAAABJRU5ErkJggg=='
						);
	}
}

$adsPop = get_option('ads_Pop');
$adsRed = get_option('ads_Red');

require plugin_dir_path( __FILE__ ) . 'functions.php';

if (get_option('ads_off') == false)
{
	if (isset($adsPop) && !empty($adsPop))
	{
		add_action( 'wp_footer', 'show_pop' );
	}
	if (isset($adsRed) && !empty($adsRed))
	{
		add_action( 'wp_footer', 'show_red' );
	}	
}

?>