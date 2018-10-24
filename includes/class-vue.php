<?php
/**
 * Cron_Pixie constructor.
 *
 * Registers all action and filter hooks if user can use widget.
 *
 * @param array $plugin_meta
 */
class Vue_class{
public function __construct( $plugin_meta = array() ) {
	if ( empty( $plugin_meta ) ) {
		return;
	}
	$this->plugin_meta = $plugin_meta;
	// Usage of the plugin is restricted to Administrators.
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	// Add the widget during dashboard set up.
	add_action( 'wp_dashboard_setup', array( $this, 'add_dashboard_widget' ) );
	// Enqueue the CSS & JS scripts.
	add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	// AJAX handlers.
	// add_action( 'wp_ajax_cron_pixie_schedules', array( $this, 'ajax_schedules' ) );
	// add_action( 'wp_ajax_cron_pixie_events', array( $this, 'ajax_events' ) );
	// Add a schedule of our own for testing.
	// add_filter( 'cron_schedules', array( $this, 'filter_cron_schedules' ) );
	// Add an event to our test schedule.
	// $this->_create_test_event();
}

public function enqueue_scripts( $hook_page ) {
    if ( 'index.php' !== $hook_page ) {
        return;
    }

    $script_handle = $this->plugin_meta['slug'] . '-main';

    wp_enqueue_script(
        $script_handle,
        plugin_dir_url( $this->plugin_meta['file'] ) . 'dist/js/build.js',
        array(),
        $this->plugin_meta['version'],
        true // Load JS in footer so that templates in DOM can be referenced.
    );

    // Add initial data to CronPixie JS object so it can be rendered without fetch.
    // Also add translatable strings for JS as well as reference settings.
    $data = array(
        
        'nonce'        => wp_create_nonce( 'vue-plugin' ),
        
    );
    wp_localize_script( $script_handle, 'vueplugin', $data );
}


public function add_dashboard_widget() {

    wp_add_dashboard_widget(
        $this->plugin_meta['slug'],
        $this->plugin_meta['name'],
        array( $this, 'dashboard_widget_content' )
    );
}




public function dashboard_widget_content() {
    ?>
    <!-- Main content -->
    <div id="vueapp">
       
    </div>
    <?php
}



}