<?php
/**
 * Plugin Name
 *
 * @author            Tapan Chudasama
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       Settings Page
 * Description:       rtCamp Assignment Plugin
 * Version:           1.0.0
 * Author:            Tapan Chudasama
 * Text Domain:       wp-book
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */
class MySettingsPage {
	/**
	 * Start up
	 *
	 * @return void
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'page_init' ) );
	}

	/**
	 * Add options page
	 *
	 * @return void
	 */
	public function add_plugin_page() {
		add_submenu_page(
			'edit.php?post_type=book',
			'CPT Book Settings',
			'Settings',
			'manage_options',
			'book-settings',
			array( $this, 'create_admin_page' )
		);
	}

	/**
	 * Options page callback
	 *
	 * @return void
	 */
	public function create_admin_page() {
		// Set class property.
		?>
<div class="wrap">
	<h1>Admin Page</h1>
	<form method="post" action="options.php">
		<?php
		// This prints out all hidden setting fields.
		settings_fields( 'my_option_name' );
		do_settings_sections( 'my-setting-admin' );
		submit_button();
		?>
	</form>
</div>
		<?php
	}

	/**
	 * Register and add settings
	 *
	 * @return void
	 */
	public function page_init() {
		register_setting(
			'my_option_name', // Option group.
			'my_option_name', // Option name.
			array( $this, 'sanitize' ) // Sanitize.
		);
		register_setting(
			'my_option_name', // Option group.
			'posts_per_page' // Option name.
		);
		register_setting(
			'my_option_name', // Option group.
			'dropdown1' // Option name.
		);
		register_setting(
			'my_option_name', // Option group.
			'checkbox1'// Option name.
		);
		register_setting(
			'my_option_name', // Option group.
			'checkbox2' // Option name.
		);

		add_settings_section(
			'setting_section_id', // ID.
			'Book Settings', // Title.
			array( $this, 'print_section_info' ), // Callback.
			'my-setting-admin' // Page.
		);

		add_settings_field(
			'posts_per_page', // ID.
			'Posts to show per page', // Title.
			array( $this, 'posts_per_page_callback' ), // Callback.
			'my-setting-admin', // Page.
			'setting_section_id' // Section.
		);

		add_settings_field(
			'currency',
			'Currency',
			array( $this, 'currency_callback' ),
			'my-setting-admin',
			'setting_section_id'
		);
		add_settings_field(
			'displayauth',
			'Display Author',
			array( $this, 'display_author' ),
			'my-setting-admin',
			'setting_section_id'
		);
		add_settings_field(
			'displaycurrency',
			'Display Currency',
			array( $this, 'display_currency' ),
			'my-setting-admin',
			'setting_section_id'
		);
	}

	/**
	 * Sanitize each setting field as needed
	 *
	 * @param array $input Contains all settings fields as array keys.
	 *
	 * @return array
	 */
	public function sanitize( $input ) {
		$new_input = array();
		if ( isset( $input['posts_per_page'] ) ) {
			$new_input['posts_per_page'] = absint( $input['posts_per_page'] );
		}
		return $new_input;
	}

	/**
	 * Print the Section text
	 *
	 * @return void
	 */
	public function print_section_info() {
		print 'Enter your settings below:';
	}

	/**
	 * Get the settings option array and print one of its values
	 *
	 * @return void
	 */
	public function posts_per_page_callback() {
		?>
		<label for="posts_per_page">
		<input type="number" id="posts_per_page" step="1" min="1"
			name="posts_per_page" value="<?php echo esc_attr( get_option( 'posts_per_page' ) ); ?>" />
		</label>
			<?php
	}

	/**
	 * Get the settings option array and print one of its values
	 *
	 * @return void
	 */
	public function currency_callback() {
		$val = get_option( 'dropdown1' );
		?>
		<label>
			<select name="dropdown1">
				<option <?php echo ( 'Rupees' === $val ) ? 'selected' : ''; ?>>Rupees</option>
				<option <?php echo ( 'Dollars' === $val ) ? 'selected' : ''; ?>>Dollars</option>
				<option <?php echo ( 'Euros' === $val ) ? 'selected' : ''; ?>>Euros</option>
				<option <?php echo ( 'Pounds' === $val ) ? 'selected' : ''; ?>>Pounds</option>
			</select>
		</label>
		<?php
		printf(
			isset( $this->val['dropdown1'] ) ?
			esc_attr( $this->val['dropdown1'] ) : ''
		);
	}

	/**
	 * Display Author callback
	 *
	 * @return void
	 */
	public function display_author() {
		?>
		<label for="displayauthor"><input name="checkbox1" type="checkbox" id="displayauthor"
											value="1" <?php checked( '1', get_option( 'checkbox1' ) ); ?> />
		</label>
			<?php
	}

	/**
	 * Display Currency callback
	 *
	 * @return void
	 */
	public function display_currency() {
		?>
		<label for="displaycurrency"><input name="checkbox2" type="checkbox" id="displaycurrency" value="1"
		<?php checked( '1', get_option( 'checkbox2' ) ); ?> />
		</label>
		<?php
	}
}

if ( is_admin() ) {
	$my_settings_page = new MySettingsPage();
}
?>
