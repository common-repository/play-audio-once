<?php
/**
 * Plugin Name:       Play Audio once
 * Description:       Adds an option to the audio block to prevent the file from being played multiple times.
 * Requires at least: 5.8
 * Requires PHP:      7.4
 * Version:           1.1.4
 * Author:            Thomas Zwirner
 * Author URI:        https://www.thomaszwirner.de
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       play-audio-once
 *
 * @package play-audio-once
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Adds JavaScript-files to frontend.
 *
 * @return void
 * @noinspection PhpUnused
 */
function play_audio_once_scripts(): void {
	wp_register_script( 'play-audio-once-md5-js', plugins_url( 'libs/jquery.md5.js', __FILE__ ), array( 'jquery' ), filemtime( plugin_dir_path( __FILE__ ) . 'libs/jquery.md5.js' ), true );
	wp_enqueue_script( 'play-audio-once-md5-js' );
	wp_register_script( 'play-audio-once-frontend-js', plugins_url( 'js.js', __FILE__ ), array( 'jquery' ), filemtime( plugin_dir_path( __FILE__ ) . 'js.js' ), true );
	wp_enqueue_script( 'play-audio-once-frontend-js' );
}
add_action( 'wp_enqueue_scripts', 'play_audio_once_scripts' );

/**
 * Adds JavaScript-file for Gutenberg-editor to add the option.
 *
 * @return void
 * @noinspection PhpUnused
 */
function play_audio_once_assets(): void {
	wp_enqueue_script(
		'play-audio-once-backend-js',
		plugins_url( 'attributes/audioOption.js', __FILE__ ),
		array( 'wp-blocks', 'wp-element', 'wp-components', 'wp-i18n', 'wp-block-editor' ),
		filemtime( plugin_dir_path( __FILE__ ) . 'attributes/audioOption.js' ),
		true
	);
	if ( function_exists( 'wp_set_script_translations' ) ) {
		wp_set_script_translations(
			'play-audio-once-backend-js',
			'play-audio-once',
			trailingslashit(plugin_dir_path( __FILE__ )) . 'languages/'
		);
	}
}
add_action( 'enqueue_block_assets', 'play_audio_once_assets' );
