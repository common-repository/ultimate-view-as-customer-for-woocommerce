<?php
if (!defined('ABSPATH')) exit;
class Ultimate_View_As_Customer_For_Woocommerce_User_Switching
{
	/**
	 * The name used to identify the application during a WordPress redirect.
	 *
	 * @var string
	 */
	public static $application = 'WordPress/Ultimate View as Customer for Woocommerce';

	const REDIRECT_TYPE_NONE = null;
	const REDIRECT_TYPE_URL = 'url';
	const REDIRECT_TYPE_POST = 'post';
	const REDIRECT_TYPE_TERM = 'term';
	const REDIRECT_TYPE_USER = 'user';
	const REDIRECT_TYPE_COMMENT = 'comment';

	/**
	 * Sets up all the filters and actions.
	 * 
	 * @return void
	 */
	public function init_hooks()
	{
		$ultimate_view_as_customer_for_woocommerce_api_settings = get_option('ultimate_view_as_customer_for_woocommerce_api_settings') ? get_option('ultimate_view_as_customer_for_woocommerce_api_settings') : [];

		// Required functionality:
		add_filter('user_has_cap', array($this, 'ultimate_view_as_customer_for_woocommerce_filter_user_has_cap'), 10, 4);
		add_filter('map_meta_cap', array($this, 'ultimate_view_as_customer_for_woocommerce_filter_map_meta_cap'), 10, 4);
		add_filter('user_row_actions', array($this, 'ultimate_view_as_customer_for_woocommerce_filter_user_row_actions'), 10, 2);
		add_action('plugins_loaded', array($this, 'ultimate_view_as_customer_for_woocommerce_action_plugins_loaded'), 1);
		add_action('init', array($this, 'ultimate_view_as_customer_for_woocommerce_action_init'));
		add_action('all_admin_notices', array($this, 'ultimate_view_as_customer_for_woocommerce_action_admin_notices'), 1);
		add_action('wp_logout', 'ultimate_view_as_customer_for_woocommerce_ultimate_view_as_customer_for_woocommerce_clear_olduser_cookie');
		add_action('wp_login', 'ultimate_view_as_customer_for_woocommerce_ultimate_view_as_customer_for_woocommerce_clear_olduser_cookie');

		// Nice-to-haves:
		add_filter('ms_user_row_actions', array($this, 'ultimate_view_as_customer_for_woocommerce_filter_user_row_actions'), 10, 2);
		add_filter('login_message', array($this, 'ultimate_view_as_customer_for_woocommerce_filter_login_message'), 1);
		add_filter('removable_query_args', array($this, 'ultimate_view_as_customer_for_woocommerce_filter_removable_query_args'));
		add_action('wp_meta', array($this, 'ultimate_view_as_customer_for_woocommerce_action_wp_meta'));

		if (isset($ultimate_view_as_customer_for_woocommerce_api_settings['settings']['fontend_enable']) && $ultimate_view_as_customer_for_woocommerce_api_settings['settings']['fontend_enable']) {
			add_action('wp_footer', array($this, 'ultimate_view_as_customer_for_woocommerce_action_wp_footer'));
			add_action('init', array($this, 'ultimate_view_as_customer_for_woocommerce_action_init_body_class'));
		}

		add_action('personal_options', array($this, 'ultimate_view_as_customer_for_woocommerce_action_personal_options'));
		add_action('admin_bar_menu', array($this, 'ultimate_view_as_customer_for_woocommerce_action_admin_bar_menu'), 11);
		add_action('bbp_template_after_user_details_menu_items', array($this, 'ultimate_view_as_customer_for_woocommerce_action_bbpress_button'));
		add_action('woocommerce_login_form_start', array($this, 'ultimate_view_as_customer_for_woocommerce_action_woocommerce_login_form_start'), 10, 0);
		add_action('woocommerce_admin_order_data_after_order_details', array($this, 'ultimate_view_as_customer_for_woocommerce_action_woocommerce_order_details'), 1);
		add_filter('woocommerce_account_menu_items', array($this, 'ultimate_view_as_customer_for_woocommerce_filter_woocommerce_account_menu_items'), 999);
		add_filter('woocommerce_get_endpoint_url', array($this, 'ultimate_view_as_customer_for_woocommerce_filter_woocommerce_get_endpoint_url'), 10, 2);
		add_action('ultimate_view_as_customer_for_woocommerce_switch_to_user', array($this, 'ultimate_view_as_customer_for_woocommerce_forget_woocommerce_session'));
		add_action('ultimate_view_as_customer_for_woocommerce_switch_back_user', array($this, 'ultimate_view_as_customer_for_woocommerce_forget_woocommerce_session'));


		add_action("admin_bar_menu", array($this, "ultimate_view_as_customer_for_woocommerce_admin_bar_menu"), 500);

		add_action("wp_ajax_ultimate_view_as_customer_for_woocommerce_show_customer_on_demand", array($this, "ultimate_view_as_customer_for_woocommerce_show_customer_on_demand"));
		add_action("wp_ajax_nopriv_ultimate_view_as_customer_for_woocommerce_show_customer_on_demand", array($this, "ultimate_view_as_customer_for_woocommerce_show_customer_on_demand"));
	}
	/**
	 * Custom
	 * 
	 */
	public function ultimate_view_as_customer_for_woocommerce_admin_bar_menu(WP_Admin_Bar $wp_admin_bar)
	{

		if (!current_user_can('manage_options')) {
			return;
		}
		// 

		//add top level menu item
		$wp_admin_bar->add_menu(array(
			'id'    => 'ultimate-view-as-customer-for-woocommerce-switch-as-customer',
			'title' => '<span class="ab-icon"></span><span class="ab-text">' . __('Ultimate View as Customer', 'ultimate-view-as-customer-for-woocommerce') . '</span>',
			'icon' => 'dashicons-before dashicons-admin-post'
			// 'href'  => admin_url('options-general.php?page=perfmatters')
		));
		$wp_admin_bar->add_menu(array(
			'parent' => 'ultimate-view-as-customer-for-woocommerce-switch-as-customer',
			'id' => 'ultimate-view-as-customer-for-woocommerce-form-in-admin-bar',
			'title' => '<form class="search-user"><div class="input-wrap"><input class="search-user-input" type="text" placeholder="' . __('Start typing to search.', 'ultimate-view-as-customer-for-woocommerce') . '" /><div class="search-result"></div></div><button class="search-user-btn" type="button">Search</button> </form>'
		));
		$wp_admin_bar->add_menu(array(
			'parent' => 'ultimate-view-as-customer-for-woocommerce-switch-as-customer',
			'id' => 'ultimate-view-as-customer-for-woocommerce-current-user-title',
			'title' => '<span class="title-part">Current User</span>'
		));
		$current_user = wp_get_current_user();
		$wp_admin_bar->add_menu(
			array(
				'parent' => 'ultimate-view-as-customer-for-woocommerce-switch-as-customer',
				'title' => get_avatar($current_user->ID, 32) . '<span class="current-user-name">' . $current_user->display_name . ' (' . ucfirst($current_user->roles[0]) . ')' . '</span>',
				'id' => 'ultimate-view-as-customer-for-woocommerce-switch-user-current',
				// 'href' => 'edit-comments.php?comment_status=moderated',
				// 'href' => $link
				// 
			)
		);
		$wp_admin_bar->add_menu(array(
			'parent' => 'ultimate-view-as-customer-for-woocommerce-switch-as-customer',
			'id' => 'ultimate-view-as-customer-for-woocommerce-recent-users-title',
			'title' => '<span class="title-part">Recent Users</span>'
		));
		$ultimate_view_as_customer_for_woocommerce_latest_switched_user = get_option('ultimate_view_as_customer_for_woocommerce_latest_switched_user') ? array_reverse(get_option('ultimate_view_as_customer_for_woocommerce_latest_switched_user')) : [];
		if (sizeof($ultimate_view_as_customer_for_woocommerce_latest_switched_user)) {
			$n = 0;
			foreach ($ultimate_view_as_customer_for_woocommerce_latest_switched_user as $user_id) {
				$user = get_user_by('id', $user_id);
				$link = self::maybe_switch_url($user);
				$wp_admin_bar->add_menu(
					array(
						'parent' => 'ultimate-view-as-customer-for-woocommerce-recent-users-title',
						'title' => $user->display_name . ' (' . ucfirst($user->roles[0]) . ')',
						'id' => 'switch-user-' . $user->ID,
						'href' => $link
					)
				);
				$n++;
				if ($n >= 4) break;
			}
		}
		/*$blogusers = get_users(array('role__in' => array('customer')));
		foreach ($blogusers as $user) {
			$link = self::maybe_switch_url($user);
			$wp_admin_bar->add_menu(
				array(
					'parent' => 'ultimate-view-as-customer-for-woocommerce-recent-users-title',
					'title' => $user->display_name . ' (' . ucfirst($user->roles[0]) . ')',
					'id' => 'ultimate-view-as-customer-for-woocommerce-switch-user-' . $user->ID,
					'href' => $link
				)
			);
		}*/
		/*$wp_admin_bar->add_menu(array(
			'parent' => 'ultimate-view-as-customer-for-woocommerce-switch-as-customer',
			'title' => __('Drafts'),
			'id' => 'dwb-drafts',
			'href' => 'edit.php?post_status=draft&post_type=post',
			'meta' => array('target' => '_blank')
		));
		$wp_admin_bar->add_menu(array('parent' => 'ultimate-view-as-customer-for-woocommerce-switch-as-customer', 'title' => __('Pending Comments'), 'id' => 'dwb-pending', 'href' => 'edit-comments.php?comment_status=moderated'));


		$wp_admin_bar->add_menu( array(
        'id'     => 'wpse',
        'parent' => null,
        'group'  => null,
        'title'  => __( 'Example', 'some-textdomain' ),
        'href'   => get_edit_profile_url( get_current_user_id() ),
        'meta'   => array(
            'target'   => '_self',
            'title'    => __( 'Hello', 'some-textdomain' ),
            'html'     => '<p>Hello</p>',
            'class'    => 'wpse--item',
            'rel'      => 'friend',
            'onclick'  => "alert('Hello');",
            'tabindex' => PHP_INT_MAX,
        ),
    ) );

		$args = array(
			'parent' => 'ultimate-view-as-customer-for-woocommerce-switch-as-customer',
			'id'     => 'media-libray',
			'title'  => 'My Library',
			'href'   => esc_url(admin_url('upload.php')),
			'meta'   => false
		);
		$wp_admin_bar->add_node($args);*/
	}

	// Ajax Callback function
	public function ultimate_view_as_customer_for_woocommerce_show_customer_on_demand()
	{
		if (!isset($_POST['ultimate_view_as_customer_for_woocommerce_security']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['ultimate_view_as_customer_for_woocommerce_security'])), 'ultimate_view_as_customer_for_woocommerce_security_nonce')) {
			wp_send_json_error('Nonce validation failed.');
			die();
		}
		$html = '';
		$userQuery = isset($_POST['userQuery']) ? sanitize_text_field(wp_unslash($_POST['userQuery'])) : '';
		//'requestFrom': 'frontend',
		$requestFrom = isset($_POST['requestFrom']) ? sanitize_text_field(wp_unslash($_POST['requestFrom'])) : '';
		$old_user_id = isset($_POST['old_user_id']) ? sanitize_text_field(wp_unslash($_POST['old_user_id'])) : '';

		global $wpdb;
		$wild = '%';

		$result = $wpdb->get_results(
			$wpdb->prepare(
				"SELECT {$wpdb->prefix}users.ID, {$wpdb->prefix}users.user_email, {$wpdb->prefix}users.user_login, group_concat(CASE {$wpdb->prefix}usermeta.meta_key WHEN '{$wpdb->prefix}capabilities' THEN {$wpdb->prefix}usermeta.meta_value END) {$wpdb->prefix}capabilities FROM {$wpdb->prefix}users LEFT JOIN {$wpdb->prefix}usermeta ON {$wpdb->prefix}users.ID = {$wpdb->prefix}usermeta.user_id WHERE ({$wpdb->prefix}users.ID LIKE %s OR {$wpdb->prefix}users.user_login LIKE %s OR {$wpdb->prefix}users.user_email LIKE %s) AND {$wpdb->prefix}usermeta.meta_value LIKE %s GROUP BY {$wpdb->prefix}users.ID LIMIT 0, 10;",
				array(
					$wild . $wpdb->esc_like($userQuery) . $wild,
					$wild . $wpdb->esc_like($userQuery) . $wild,
					$wild . $wpdb->esc_like($userQuery) . $wild,
					$wild . $wpdb->esc_like('customer') . $wild
				)
			),
		);
		$old_user = isset($_POST['old_user_id']) ? get_user_by('id', $old_user_id) : '';

		if (sizeof($result)) {
			$html .= '<ul>';
			foreach ($result as $row) {
				$user = get_user_by('id', $row->ID);
				//$link = self::switch_back_url($old_user, $row->ID) . '&redirect_to=' . get_permalink(get_option('woocommerce_myaccount_page_id'));

				$link = ($requestFrom == 'frontend') ? self::switch_back_url($old_user, $row->ID) . '&redirect_to=' . get_permalink(get_option('woocommerce_myaccount_page_id')) : self::maybe_switch_url($user);

				// $link = self::maybe_switch_url($user);

				if ($link) $html .=  '<li><a href="' . esc_url($link) . '">' . $user->display_name . ' (' . ucfirst($user->roles[0]) . ')' . '</a></li>';
			}
			$html .= '</ul>';
		}
		// die(wp_kses_post(wp_json_encode($html)));
		die(wp_kses_post($html));
		// echo $html;
		exit();
	}

	/**
	 * Defines the names of the cookies used by User Switching.
	 *
	 * @return void
	 */
	public function ultimate_view_as_customer_for_woocommerce_action_plugins_loaded()
	{
		// User Switching's auth_cookie
		if (!defined('ULTIMATE_VIEW_AS_CUSTOMER_FOR_WOOCOMMERCE_USER_SWITCHING_COOKIE')) {
			define('ULTIMATE_VIEW_AS_CUSTOMER_FOR_WOOCOMMERCE_USER_SWITCHING_COOKIE', 'wordpress_user_sw_' . COOKIEHASH);
		}

		// User Switching's secure_auth_cookie
		if (!defined('ULTIMATE_VIEW_AS_CUSTOMER_FOR_WOOCOMMERCE_USER_SWITCHING_SECURE_COOKIE')) {
			define('ULTIMATE_VIEW_AS_CUSTOMER_FOR_WOOCOMMERCE_USER_SWITCHING_SECURE_COOKIE', 'wordpress_user_sw_secure_' . COOKIEHASH);
		}

		// User Switching's logged_in_cookie
		if (!defined('ULTIMATE_VIEW_AS_CUSTOMER_FOR_WOOCOMMERCE_USER_SWITCHING_OLDUSER_COOKIE')) {
			define('ULTIMATE_VIEW_AS_CUSTOMER_FOR_WOOCOMMERCE_USER_SWITCHING_OLDUSER_COOKIE', 'wordpress_user_sw_olduser_' . COOKIEHASH);
		}
	}

	/**
	 * Outputs the 'Switch To' link on the user editing screen if the current user has permission to switch to them.
	 *
	 * @param WP_User $user User object for this screen.
	 * @return void
	 */
	public function ultimate_view_as_customer_for_woocommerce_action_personal_options(WP_User $user)
	{
		$link = self::maybe_switch_url($user);

		if (!$link) {
			return;
		}

?>
		<tr class="ultimate-view-as-customer-for-woocommerce-wrap">
			<th scope="row">
				<?php echo esc_html_x('User Switching', 'User Switching title on user profile screen', 'ultimate-view-as-customer-for-woocommerce'); ?>
			</th>
			<td>
				<a id="ultimate_view_as_customer_for_woocommerce_switcher" href="<?php echo esc_url($link); ?>">
					<?php esc_html_e('Switch&nbsp;To', 'ultimate-view-as-customer-for-woocommerce'); ?>
				</a>
			</td>
		</tr>
		<?php
	}

	/**
	 * Returns whether the current logged in user is being remembered in the form of a persistent browser cookie
	 * (ie. they checked the 'Remember Me' check box when they logged in). This is used to persist the 'remember me'
	 * value when the user switches to another user.
	 *
	 * @return bool Whether the current user is being 'remembered'.
	 */
	public static function remember()
	{
		/** This filter is documented in wp-includes/pluggable.php */
		$cookie_life = apply_filters('auth_cookie_expiration', 172800, get_current_user_id(), false);
		$current = wp_parse_auth_cookie('', 'logged_in');

		if (!$current) {
			return false;
		}

		// Here we calculate the expiration length of the current auth cookie and compare it to the default expiration.
		// If it's greater than this, then we know the user checked 'Remember Me' when they logged in.
		return (intval($current['expiration']) - time() > $cookie_life);
	}

	public function ultimate_view_as_customer_for_woocommerce_action_init_body_class()
	{
		$old_user = self::get_old_user();

		if ($old_user instanceof WP_User) {
			add_filter('body_class', function ($classes) {
				$classes[] = 'ultimate-view-as-customer-for-woocommerce-enabled';
				return $classes;
			});
		}
	}

	/**
	 * Loads localisation files and routes actions depending on the 'action' query var.
	 *
	 * @return void
	 */
	public function ultimate_view_as_customer_for_woocommerce_action_init()
	{
		$old_user = self::get_old_user();

		if (!isset($_REQUEST['action'])) {
			return;
		}

		$current_user = (is_user_logged_in()) ? wp_get_current_user() : null;

		switch ($_REQUEST['action']) {

				// We're attempting to switch to another user:
			case 'ultimate_view_as_customer_for_woocommerce_switch_to_user':
				$user_id = absint($_REQUEST['user_id'] ?? 0);

				// Check authentication:

				if (!current_user_can('ultimate_view_as_customer_for_woocommerce_switch_to_user', $user_id)) {
					wp_die(esc_html__('Could not switch users.', 'ultimate-view-as-customer-for-woocommerce'), 403);
				}
				// $allowed_roles = array('administrator', 'customer');

				// if (!array_intersect($allowed_roles, $current_user->roles)) {
				// 	wp_die(esc_html__('Could not switch users.', 'ultimate-view-as-customer-for-woocommerce'), 403);
				// }

				// Check intent:
				check_admin_referer("ultimate_view_as_customer_for_woocommerce_switch_to_user_{$user_id}");

				// Switch user:
				$user = ultimate_view_as_customer_for_woocommerce_switch_to_user($user_id, self::remember());
				if ($user) {

					// $ultimate_view_as_customer_for_woocommerce_latest_switched_user = [];
					$ultimate_view_as_customer_for_woocommerce_latest_switched_user = get_option('ultimate_view_as_customer_for_woocommerce_latest_switched_user') ? get_option('ultimate_view_as_customer_for_woocommerce_latest_switched_user') : [];
					if (in_array($user_id, $ultimate_view_as_customer_for_woocommerce_latest_switched_user)) {
						array_splice($ultimate_view_as_customer_for_woocommerce_latest_switched_user, array_search($user_id, $ultimate_view_as_customer_for_woocommerce_latest_switched_user), 1);
					}
					$ultimate_view_as_customer_for_woocommerce_latest_switched_user[] = $user_id;
					update_option('ultimate_view_as_customer_for_woocommerce_latest_switched_user', $ultimate_view_as_customer_for_woocommerce_latest_switched_user);


					$redirect_to = esc_url(self::get_redirect($user, $current_user));

					// Redirect to the dashboard or the home URL depending on capabilities:
					$args = array(
						'user_switched' => 'true',
					);

					if ($redirect_to) {
						wp_safe_redirect(add_query_arg($args, $redirect_to), 302, self::$application);
					} elseif (!current_user_can('read')) {
						wp_safe_redirect(add_query_arg($args, home_url()), 302, self::$application);
					} else {
						wp_safe_redirect(add_query_arg($args, admin_url()), 302, self::$application);
					}
					exit;
				} else {
					wp_die(esc_html__('Could not switch users.', 'ultimate-view-as-customer-for-woocommerce'), 404);
				}
				break;

				// We're attempting to switch back to the originating user:
			case 'switch_to_olduser':
				// Fetch the originating user data:
				$old_user = self::get_old_user();
				if (!$old_user) {
					wp_die(esc_html__('Could not switch users.', 'ultimate-view-as-customer-for-woocommerce'), 400);
				}

				// Check authentication:
				if (!self::authenticate_old_user($old_user)) {
					wp_die(esc_html__('Could not switch users.', 'ultimate-view-as-customer-for-woocommerce'), 403);
				}

				// Check intent:
				check_admin_referer("switch_to_olduser_{$old_user->ID}");

				// Switch user:
				if (ultimate_view_as_customer_for_woocommerce_switch_to_user($old_user->ID, self::remember(), false)) {

					if (!empty($_REQUEST['interim-login']) && function_exists('login_header')) {
						$GLOBALS['interim_login'] = 'success'; // @codingStandardsIgnoreLine
						login_header('', '');
						exit;
					}

					$redirect_to = self::get_redirect($old_user, $current_user);
					$args = array(
						'user_switched' => 'true',
						'switched_back' => 'true',
					);
					setcookie('user_switched', 1, time() + (86400 * 30), "/");

					if (isset($_REQUEST['sw_user'])) {
						$args['action'] = 'customer_to_customer';
						$args['sw_user'] = sanitize_text_field(wp_unslash($_REQUEST['sw_user']));
						$args['customer_to_customer_wpnonce'] = wp_create_nonce('customer_to_customer_wpnonce'); //_wpnonce=bdb29efbad
					}

					if ($redirect_to) {
						wp_safe_redirect(add_query_arg($args, $redirect_to), 302, self::$application);
					} else {
						wp_safe_redirect(add_query_arg($args, admin_url('users.php')), 302, self::$application);
					}
					exit;
				} else {
					wp_die(esc_html__('Could not switch users.', 'ultimate-view-as-customer-for-woocommerce'), 404);
				}
				break;
			case 'customer_to_customer':
				if (isset($_REQUEST['sw_user'])) {
					$user = get_user_by('id', sanitize_text_field(wp_unslash($_REQUEST['sw_user'])));
					$link = self::maybe_switch_url($user);
					echo '<div class="loader-wrapper"><div><div class="loader"></div><a id="cuctomer-to-customer-redirect" href="' . esc_url($link) . '">' . esc_html__('Loading...', 'ultimate-view-as-customer-for-woocommerce') . '</a></div></div>';
				}
				break;
				// We're attempting to switch off the current user:
			case 'switch_off':
				// Check authentication:
				if (!$current_user || !current_user_can('switch_off')) {
					/* Translators: "switch off" means to temporarily log out */
					wp_die(esc_html__('Could not switch off.', 'ultimate-view-as-customer-for-woocommerce'), 403);
				}

				// Check intent:
				check_admin_referer("switch_off_{$current_user->ID}");

				// Switch off:
				if (ultimate_view_as_customer_for_woocommerce_switch_off_user()) {
					$redirect_to = self::get_redirect(null, $current_user);
					$args = array(
						'switched_off' => 'true',
					);

					if ($redirect_to) {
						wp_safe_redirect(add_query_arg($args, $redirect_to), 302, self::$application);
					} else {
						wp_safe_redirect(add_query_arg($args, home_url()), 302, self::$application);
					}
					exit;
				} else {
					/* Translators: "switch off" means to temporarily log out */
					wp_die(esc_html__('Could not switch off.', 'ultimate-view-as-customer-for-woocommerce'), 403);
				}
				break;
		}
	}

	/**
	 * Fetches the URL to redirect to for a given user (used after switching).
	 *
	 * @param  WP_User $new_user Optional. The new user's WP_User object.
	 * @param  WP_User $old_user Optional. The old user's WP_User object.
	 * @return string The URL to redirect to.
	 */
	protected static function get_redirect(WP_User $new_user = null, WP_User $old_user = null)
	{
		$nonce = wp_create_nonce('ultimate_view_as_customer_for_woocommerce_security_nonce');
		if (!wp_verify_nonce(sanitize_text_field(wp_unslash($nonce)), 'ultimate_view_as_customer_for_woocommerce_security_nonce')) {
			wp_send_json_error('Nonce validation failed.');
			die();
		}

		$redirect_to = '';
		$requested_redirect_to = '';
		$redirect_type = self::REDIRECT_TYPE_NONE;

		if (!empty($_REQUEST['redirect_to'])) {
			// URL
			$redirect_to = self::remove_query_args(sanitize_text_field(wp_unslash($_REQUEST['redirect_to'])));
			// var_dump($redirect_to);
			// $requested_redirect_to = esc_url(wp_unslash($_REQUEST['redirect_to']));

			$requested_redirect_to = esc_url_raw(wp_unslash($_REQUEST['redirect_to']));
			$requested_redirect_to = filter_var($requested_redirect_to, FILTER_VALIDATE_URL);

			$redirect_type = self::REDIRECT_TYPE_URL;
		} elseif (!empty($_GET['redirect_to_post'])) {
			// Post
			$post_id = absint($_GET['redirect_to_post']);
			$redirect_type = self::REDIRECT_TYPE_POST;

			if (function_exists('is_post_publicly_viewable') && is_post_publicly_viewable($post_id)) {
				$link = get_permalink($post_id);

				if (is_string($link)) {
					$redirect_to = $link;
					$requested_redirect_to = $link;
				}
			}
		} elseif (!empty($_GET['redirect_to_term'])) {
			// Term
			$term = get_term(absint($_GET['redirect_to_term']));
			$redirect_type = self::REDIRECT_TYPE_TERM;

			if (($term instanceof WP_Term) && is_taxonomy_viewable($term->taxonomy)) {
				$link = get_term_link($term);

				if (is_string($link)) {
					$redirect_to = $link;
					$requested_redirect_to = $link;
				}
			}
		} elseif (!empty($_GET['redirect_to_user'])) {
			// User
			$user = get_userdata(absint($_GET['redirect_to_user']));
			$redirect_type = self::REDIRECT_TYPE_USER;

			if ($user instanceof WP_User) {
				$link = get_author_posts_url($user->ID);

				if (is_string($link)) {
					$redirect_to = $link;
					$requested_redirect_to = $link;
				}
			}
		} elseif (!empty($_GET['redirect_to_comment'])) {
			// Comment
			$comment = get_comment(absint($_GET['redirect_to_comment']));
			$redirect_type = self::REDIRECT_TYPE_COMMENT;

			if ($comment instanceof WP_Comment) {
				if ('approved' === wp_get_comment_status($comment)) {
					$link = get_comment_link($comment);

					if (is_string($link)) {
						$redirect_to = $link;
						$requested_redirect_to = $link;
					}
				} elseif (function_exists('is_post_publicly_viewable') && is_post_publicly_viewable((int) $comment->comment_post_ID)) {
					$link = get_permalink((int) $comment->comment_post_ID);

					if (is_string($link)) {
						$redirect_to = $link;
						$requested_redirect_to = $link;
					}
				}
			}
		}

		if (!$new_user) {
			/** This filter is documented in wp-login.php */
			$redirect_to = apply_filters('logout_redirect', $redirect_to, $requested_redirect_to, $old_user);
		} else {
			/** This filter is documented in wp-login.php */
			$redirect_to = apply_filters('login_redirect', $redirect_to, $requested_redirect_to, $new_user);
		}

		/**
		 * Filters the redirect location after a user switches to another account or switches off.
		 *
		 * @since 1.7.0
		 *
		 * @param string       $redirect_to   The target redirect location, or an empty string if none is specified.
		 * @param string|null  $redirect_type The redirect type, see the `Ultimate_View_As_Customer_For_Woocommerce_User_Switching::REDIRECT_*` constants.
		 * @param WP_User|null $new_user      The user being switched to, or null if there is none.
		 * @param WP_User|null $old_user      The user being switched from, or null if there is none.
		 */
		return apply_filters('ultimate_view_as_customer_for_woocommerce_redirect_to', $redirect_to, $redirect_type, $new_user, $old_user);
	}

	/**
	 * Displays the 'Switched to {user}' and 'Switch back to {user}' messages in the admin area.
	 *
	 * @return void
	 */
	public function ultimate_view_as_customer_for_woocommerce_action_admin_notices()
	{

		$nonce = wp_create_nonce('ultimate_view_as_customer_for_woocommerce_security_nonce');
		if (!wp_verify_nonce(sanitize_text_field(wp_unslash($nonce)), 'ultimate_view_as_customer_for_woocommerce_security_nonce')) {
			wp_send_json_error('Nonce validation failed.');
			die();
		}

		$user = wp_get_current_user();
		$old_user = self::get_old_user();

		if ($old_user) {
			$switched_locale = false;
			$lang_attr = '';
			$locale = get_user_locale($old_user);
			$switched_locale = switch_to_locale($locale);
			$lang_attr = str_replace('_', '-', $locale);

		?>
			<div id="ultimate_view_as_customer_for_woocommerce" class="updated notice notice-success is-dismissible">
				<?php
				if ($lang_attr) {
					printf(
						'<p lang="%s">',
						esc_attr($lang_attr)
					);
				} else {
					echo '<p>';
				}
				?>
				<span class="dashicons dashicons-admin-users" style="color:#56c234" aria-hidden="true"></span>
				<?php
				$message = '';
				$just_switched = isset($_GET['user_switched']);
				if ($just_switched) {
					$message = esc_html(self::switched_to_message($user));
				}
				$switch_back_url = add_query_arg(array(
					'redirect_to' => rawurlencode(self::current_url()),
				), self::switch_back_url($old_user));

				$message .= sprintf(
					' <a href="%s">%s</a>.',
					esc_url($switch_back_url),
					esc_html(self::switch_back_message($old_user))
				);

				/**
				 * Filters the contents of the message that's displayed to switched users in the admin area.
				 *
				 * @since 1.1.0
				 *
				 * @param string  $message         The message displayed to the switched user.
				 * @param WP_User $user            The current user object.
				 * @param WP_User $old_user        The old user object.
				 * @param string  $switch_back_url The switch back URL.
				 * @param bool    $just_switched   Whether the user made the switch on this page request.
				 */
				$message = apply_filters('ultimate_view_as_customer_for_woocommerce_switched_message', $message, $user, $old_user, $switch_back_url, $just_switched);

				echo wp_kses($message, array(
					'a' => array(
						'href' => array(),
					),
				));
				?>
				</p>
			</div>
			<?php
			if ($switched_locale) {
				restore_previous_locale();
			}
		} elseif (isset($_GET['user_switched']) || isset($_COOKIE['user_switched'])) {
			?>
			<div id="ultimate_view_as_customer_for_woocommerce" class="ultimate-view-as-customer-for-woocommerce-switch-notice updated notice notice-success">

				<?php
				echo wp_kses_post(self::switched_back_message($user));
				// if (isset($_GET['switched_back'])) {
				// 	echo wp_kses_post(self::switched_back_message($user));
				// } else {
				// 	echo sprintf(
				// 		esc_html__('%1$s %2$s %3$s', 'ultimate-view-as-customer-for-woocommerce'),
				// 		'<p>',
				// 		esc_html(self::switched_to_message($user)),
				// 		'</p>'
				// 	);
				// }
				?>

			</div>
		<?php
		}
	}

	/**
	 * Validates the old user cookie and returns its user data.
	 *
	 * @return false|WP_User False if there's no old user cookie or it's invalid, WP_User object if it's present and valid.
	 */
	public static function get_old_user()
	{
		$cookie = ultimate_view_as_customer_for_woocommerce_get_olduser_cookie();
		if (!empty($cookie)) {
			$old_user_id = wp_validate_auth_cookie($cookie, 'logged_in');

			if ($old_user_id) {
				return get_userdata($old_user_id);
			}
		}
		return false;
	}

	/**
	 * Authenticates an old user by verifying the latest entry in the auth cookie.
	 *
	 * @param WP_User $user A WP_User object (usually from the logged_in cookie).
	 * @return bool Whether verification with the auth cookie passed.
	 */
	public static function authenticate_old_user(WP_User $user)
	{
		$cookie = ultimate_view_as_customer_for_woocommerce_get_auth_cookie();
		if (!empty($cookie)) {
			if (self::secure_auth_cookie()) {
				$scheme = 'secure_auth';
			} else {
				$scheme = 'auth';
			}

			$old_user_id = wp_validate_auth_cookie(end($cookie), $scheme);

			if ($old_user_id) {
				return ($user->ID === $old_user_id);
			}
		}
		return false;
	}

	/**
	 * Adds a 'Switch back to {user}' link to the account menu, and a `Switch To` link to the user edit menu.
	 *
	 * @param WP_Admin_Bar $wp_admin_bar The admin bar object.
	 * @return void
	 */
	public function ultimate_view_as_customer_for_woocommerce_action_admin_bar_menu(WP_Admin_Bar $wp_admin_bar)
	{
		if (!is_admin_bar_showing()) {
			return;
		}

		if ($wp_admin_bar->get_node('user-actions')) {
			$parent = 'user-actions';
		} else {
			return;
		}

		$old_user = self::get_old_user();

		if ($old_user) {
			$wp_admin_bar->add_node(array(
				'parent' => $parent,
				'id' => 'switch-back',
				'title' => esc_html(self::switch_back_message($old_user)),
				'href' => add_query_arg(array(
					'redirect_to' => rawurlencode(self::current_url()),
				), self::switch_back_url($old_user)),
			));
		}

		if (current_user_can('switch_off')) {
			$url = self::switch_off_url(wp_get_current_user());
			$redirect_to = is_admin() ? self::get_admin_redirect_to() : array(
				'redirect_to' => rawurlencode(self::current_url()),
			);

			if (is_array($redirect_to)) {
				$url = add_query_arg($redirect_to, $url);
			}

			// $wp_admin_bar->add_node(array(
			// 	'parent' => $parent,
			// 	'id' => 'switch-off',
			// 	// Translators: "switch off" means to temporarily log out
			// 	'title' => esc_html__('Switch Off', 'ultimate-view-as-customer-for-woocommerce'),
			// 	'href' => $url,
			// ));
		}

		if (!is_admin() && is_author() && (get_queried_object() instanceof WP_User)) {
			if ($old_user) {
				$wp_admin_bar->add_node(array(
					'parent' => 'edit',
					'id' => 'author-switch-back',
					'title' => esc_html(self::switch_back_message($old_user)),
					'href' => add_query_arg(array(
						'redirect_to' => rawurlencode(self::current_url()),
					), self::switch_back_url($old_user)),
				));
			} elseif (current_user_can('ultimate_view_as_customer_for_woocommerce_switch_to_user', get_queried_object_id())) {
				$wp_admin_bar->add_node(array(
					'parent' => 'edit',
					'id' => 'author-switch-to',
					'title' => esc_html__('Switch&nbsp;To', 'ultimate-view-as-customer-for-woocommerce'),
					'href' => add_query_arg(array(
						'redirect_to' => rawurlencode(self::current_url()),
					), self::switch_to_url(get_queried_object())),
				));
			}
		}
	}

	/**
	 * Returns a context-aware redirect parameter for use when switching off in the admin area.
	 *
	 * This is used to redirect the user to the URL of the item they're editing at the time.
	 *
	 * @return ?array<string, int>
	 */
	public static function get_admin_redirect_to()
	{
		$nonce = wp_create_nonce('ultimate_view_as_customer_for_woocommerce_security_nonce');
		if (!wp_verify_nonce(sanitize_text_field(wp_unslash($nonce)), 'ultimate_view_as_customer_for_woocommerce_security_nonce')) {
			wp_send_json_error('Nonce validation failed.');
			die();
		}

		if (!empty($_GET['post'])) {
			// Post
			return array(
				'redirect_to_post' => intval($_GET['post']),
			);
		} elseif (!empty($_GET['tag_ID'])) {
			// Term
			return array(
				'redirect_to_term' => intval($_GET['tag_ID']),
			);
		} elseif (!empty($_GET['user_id'])) {
			// User
			return array(
				'redirect_to_user' => intval($_GET['user_id']),
			);
		} elseif (!empty($_GET['c'])) {
			// Comment
			return array(
				'redirect_to_comment' => intval($_GET['c']),
			);
		}

		return null;
	}

	/**
	 * Adds a 'Switch back to {user}' link to the Meta sidebar widget.
	 *
	 * @return void
	 */
	public function ultimate_view_as_customer_for_woocommerce_action_wp_meta()
	{
		$old_user = self::get_old_user();

		if ($old_user instanceof WP_User) {
			$url = add_query_arg(array(
				'redirect_to' => rawurlencode(self::current_url()),
			), self::switch_back_url($old_user));
			printf(
				'<li id="ultimate_view_as_customer_for_woocommerce_switch_on_list"><a href="%s">%s</a></li>',
				esc_url($url),
				esc_html(self::switch_back_message($old_user))
			);
		}
	}

	/**
	 * Adds a 'Switch back to {user}' link to the WordPress footer if the admin toolbar isn't showing.
	 *
	 * @return void
	 */
	public function ultimate_view_as_customer_for_woocommerce_action_wp_footer()
	{
		if (is_admin_bar_showing() || did_action('wp_meta')) {
			return;
		}

		/**
		 * Allows the 'Switch back to {user}' link in the WordPress footer to be disabled.
		 *
		 * @since 1.5.5
		 *
		 * @param bool $show_in_footer Whether to show the 'Switch back to {user}' link in footer.
		 */
		if (!apply_filters('ultimate_view_as_customer_for_woocommerce_in_footer', true)) {
			return;
		}

		$old_user = self::get_old_user();

		if ($old_user instanceof WP_User) {
			add_filter('body_class', function ($classes) {
				$classes[] = 'ultimate-view-as-customer-for-woocommerce-enabled';
				return $classes;
			});

			$url = add_query_arg(array(
				// 'redirect_to' => rawurlencode(self::current_url()),
				'redirect_to' => rawurlencode(admin_url()),
			), self::switch_back_url($old_user));
		?>
			<div id="ultimate_view_as_customer_for_woocommerce_switch_on">
				<span class="current-user-data"><?php echo esc_html__('You\'re Viewing as ', 'ultimate-view-as-customer-for-woocommerce') . '"' . esc_html(wp_get_current_user()->display_name) . '"' ?></span>
				<span class="switch-to-another">
					<div class="header-text"><?php echo esc_html__('Switch to another customer', 'ultimate-view-as-customer-for-woocommerce') ?></div>
					<div class="hover-content">
						<div class="ab-item ab-empty-item" role="menuitem">
							<form class="search-user">
								<div class="input-wrap">
									<input class="search-user-input-from-frontend" type="text" placeholder="Start typing to search.">
									<div class="search-result"></div>
								</div>
								<input type="hidden" id="old_user_id" value="<?php echo esc_html($old_user->ID) ?>" />
								<button class="search-user-btn" type="button">Search</button>
							</form>
						</div>
						<div class="ab-item ab-empty-item" role="menuitem" aria-expanded="false"> <span class="wp-admin-bar-arrow" aria-hidden="true"></span> <span class="title-part">Recent Users</span></div>
						<ul>
							<?php
							$ultimate_view_as_customer_for_woocommerce_latest_switched_user = get_option('ultimate_view_as_customer_for_woocommerce_latest_switched_user') ? array_reverse(get_option('ultimate_view_as_customer_for_woocommerce_latest_switched_user')) : [];
							if (sizeof($ultimate_view_as_customer_for_woocommerce_latest_switched_user)) {
								$n = 0;
								foreach ($ultimate_view_as_customer_for_woocommerce_latest_switched_user as $user_id) {
									$user = get_user_by('id', $user_id);
									$admin = get_user_by('id', $old_user->ID); // need to get an admin id
									$redirect_to = get_permalink(get_option('woocommerce_myaccount_page_id'));
									// $link = self::maybe_switch_url($user);
									$link = self::switch_back_url($admin, $user_id) . '&redirect_to=' . $redirect_to;
									echo '<li><a href="' . esc_url($link) . '">' . esc_html($user->display_name) . '</a></li>';
									$n++;
									if ($n >= 4) break;
								}
							}
							?>
						</ul>
					</div>
				</span>
				<span class="switch-to-old"><a href="<?php echo esc_url($url) ?>"><?php echo esc_html(self::switch_back_message($old_user)) ?></a></span>
			</div>

<?php
		}
	}

	/**
	 * Adds a 'Switch back to {user}' link to the WordPress login screen.
	 *
	 * @param  string $message The login screen message.
	 * @return string The login screen message.
	 */
	public function ultimate_view_as_customer_for_woocommerce_filter_login_message($message)
	{

		$nonce = wp_create_nonce('ultimate_view_as_customer_for_woocommerce_security_nonce');
		if (!wp_verify_nonce(sanitize_text_field(wp_unslash($nonce)), 'ultimate_view_as_customer_for_woocommerce_security_nonce')) {
			wp_send_json_error('Nonce validation failed.');
			die();
		}
		$old_user = self::get_old_user();

		if ($old_user instanceof WP_User) {
			$url = self::switch_back_url($old_user);

			if (!empty($_REQUEST['interim-login'])) {
				$url = add_query_arg(array(
					'interim-login' => '1',
				), $url);
			} elseif (!empty($_REQUEST['redirect_to'])) {
				$redirect_to = rawurlencode(sanitize_text_field(wp_unslash($_REQUEST['redirect_to'])));
				$url = add_query_arg(array(
					'redirect_to' => filter_var($redirect_to, FILTER_VALIDATE_URL),
					// 'redirect_to' => rawurlencode(wp_unslash($_REQUEST['redirect_to'])),
				), $url);
			}

			$message .= '<p class="message" id="ultimate_view_as_customer_for_woocommerce_switch_on">';
			$message .= '<span class="dashicons dashicons-admin-users" style="color:#56c234" aria-hidden="true"></span> ';
			$message .= sprintf(
				'<a href="%1$s" onclick="window.location.href=\'%1$s\';return false;">%2$s</a>',
				esc_url($url),
				esc_html(self::switch_back_message($old_user))
			);
			$message .= '</p>';
		}

		return $message;
	}

	/**
	 * Adds a 'Switch To' link to each list of user actions on the Users screen.
	 *
	 * @param array<string,string> $actions Array of actions to display for this user row.
	 * @param WP_User              $user    The user object displayed in this row.
	 * @return array<string,string> Array of actions to display for this user row.
	 */
	public function ultimate_view_as_customer_for_woocommerce_filter_user_row_actions(array $actions, WP_User $user)
	{
		$link = self::maybe_switch_url($user);

		if (!$link) {
			return $actions;
		}

		$actions['ultimate_view_as_customer_for_woocommerce_switch_to_user'] = sprintf(
			'<a href="%s">%s</a>',
			esc_url($link),
			esc_html__('Switch&nbsp;To', 'ultimate-view-as-customer-for-woocommerce')
		);

		return $actions;
	}

	/**
	 * Adds a 'Switch To' link to each member's profile page in bbPress.
	 *
	 * @return void
	 */
	public function ultimate_view_as_customer_for_woocommerce_action_bbpress_button()
	{
		$user = get_userdata(bbp_get_user_id());

		if (!$user) {
			return;
		}

		$link = self::maybe_switch_url($user);

		if (!$link) {
			return;
		}

		$link = add_query_arg(array(
			'redirect_to' => rawurlencode(bbp_get_user_profile_url($user->ID)),
		), $link);

		echo '<ul id="ultimate_view_as_customer_for_woocommerce_switch_to">';
		printf(
			'<li><a href="%s">%s</a></li>',
			esc_url($link),
			esc_html__('Switch&nbsp;To', 'ultimate-view-as-customer-for-woocommerce')
		);
		echo '</ul>';
	}

	/**
	 * Filters the list of query arguments which get removed from admin area URLs in WordPress.
	 *
	 * @link https://core.trac.wordpress.org/ticket/23367
	 *
	 * @param array<int,string> $args Array of removable query arguments.
	 * @return array<int,string> Updated array of removable query arguments.
	 */
	public function ultimate_view_as_customer_for_woocommerce_filter_removable_query_args(array $args)
	{
		return array_merge($args, array(
			'user_switched',
			'switched_off',
			'switched_back',
		));
	}

	/**
	 * Returns the switch to or switch back URL for a given user.
	 *
	 * @param  WP_User $user The user to be switched to.
	 * @return string|false The required URL, or false if there's no old user or the user doesn't have the required capability.
	 */
	public static function maybe_switch_url(WP_User $user)
	{
		$old_user = self::get_old_user();

		if ($old_user && ($old_user->ID === $user->ID)) {
			return self::switch_back_url($old_user);
		} elseif (current_user_can('ultimate_view_as_customer_for_woocommerce_switch_to_user', $user->ID)) {
			return self::switch_to_url($user);
		} else {
			return false;
		}
	}

	/**
	 * Returns the nonce-secured URL needed to switch to a given user ID.
	 *
	 * @param  WP_User $user The user to be switched to.
	 * @return string The required URL.
	 */
	public static function switch_to_url(WP_User $user)
	{
		return wp_nonce_url(
			add_query_arg(
				array(
					'action' => 'ultimate_view_as_customer_for_woocommerce_switch_to_user',
					'user_id' => $user->ID,
					'nr' => 1,
				),
				wp_login_url()
			),
			"ultimate_view_as_customer_for_woocommerce_switch_to_user_{$user->ID}"
		);
	}

	/**
	 * Returns the nonce-secured URL needed to switch back to the originating user.
	 *
	 * @param  WP_User $user The old user.
	 * @return string        The required URL.
	 */
	public static function switch_back_url(WP_User $user, $user_id = 0)
	{
		$arg = array(
			'action' => 'switch_to_olduser',
			'nr' => 1,
			// 'sw_user' => 39,
		);
		if ($user_id) $arg['sw_user'] = $user_id;
		return wp_nonce_url(add_query_arg($arg, wp_login_url()), "switch_to_olduser_{$user->ID}");
	}

	/**
	 * Returns the nonce-secured URL needed to switch off the current user.
	 *
	 * @param  WP_User $user The user to be switched off.
	 * @return string        The required URL.
	 */
	public static function switch_off_url(WP_User $user)
	{
		return wp_nonce_url(add_query_arg(array(
			'action' => 'switch_off',
			'nr' => 1,
		), wp_login_url()), "switch_off_{$user->ID}");
	}

	/**
	 * Returns the message shown to the user when they've switched to a user.
	 *
	 * @param WP_User $user The concerned user.
	 * @return string The message.
	 */
	public static function switched_to_message(WP_User $user)
	{
		$message = sprintf(
			/* Translators: 1: user display name; 2: username; */
			__('Switched to %1$s (%2$s).', 'ultimate-view-as-customer-for-woocommerce'),
			$user->display_name,
			$user->user_login
		);

		// Removes the user login from this message without invalidating existing translations
		return str_replace(sprintf(
			' (%s)',
			$user->user_login
		), '', $message);
	}

	/**
	 * Returns the message shown to the user for the link to switch back to their original user.
	 *
	 * @param WP_User $user The concerned user.
	 * @return string The message.
	 */
	public static function switch_back_message(WP_User $user)
	{
		$message = sprintf(
			/* Translators: 1: user display name; 2: username; */
			__('Switch back to %1$s (%2$s)', 'ultimate-view-as-customer-for-woocommerce'),
			$user->display_name,
			$user->user_login
		);

		// Removes the user login from this message without invalidating existing translations
		return str_replace(sprintf(
			' (%s)',
			$user->user_login
		), '', $message);
	}

	/**
	 * Returns the message shown to the user when they've switched back to their original user.
	 *
	 * @param WP_User $user The concerned user.
	 * @return string The message.
	 */
	public static function switched_back_message(WP_User $user)
	{
		// You have switched back to admin. Want to view as a customer again?
		// It seems like you have switched back to the admin role. If you wish to back to any customer view, just search from the top bar, type the name and click on it to switch again.

		// Switch/settings
		$img_src = esc_url(ULTIMATE_VIEW_AS_CUSTOMER_FOR_WOOCOMMERCE_URL . 'admin/images/notice.svg');
		$message = '';
		$message .= '<div class="wrapper">';
		$message .= '<div class="part-img"><img src="' . esc_url($img_src) . '" alt="" width="100" height="99"></div>';
		$message .= '<div class="part-text">';
		$message .= sprintf(
			/* Translators: 1: user display name; 2: username; */
			__('%1$sYou have switched back to %2$s (%3$s).  Want to view as a customer again?%4$s %5$sIt seems like you have switched back to the admin role. If you wish to back to any customer view, just search from the top bar, type the name and click on it to switch again.%6$s', 'ultimate-view-as-customer-for-woocommerce'),
			'<h4>',
			$user->display_name,
			$user->user_login,
			'</h4>',
			'<p>',
			'</p>'
		);
		$message .= '<div class="button-group"><a id="open-switching-dropdown" href="#" class="button button-primary"><span class="text-part">' . esc_html__("Switch", 'ultimate-view-as-customer-for-woocommerce') . '</span></a><a href="' . esc_url(admin_url('/admin.php?page=ultimate-view-as-customer-for-woocommerce')) . '" class="button button-secondary"><span class="text-part">' . esc_html__("Settings", 'ultimate-view-as-customer-for-woocommerce') . '</span></a></div><!--.button-group-->';
		$message .= '</div><!--.part-text-->';
		$message .= '</div><!--.wrapper-->';
		$message .= '<button type="button" class="notice-dismiss user_switched_clear_cookie"><span class="screen-reader-text">Dismiss this notice.</span></button>';
		return $message;

		// Removes the user login from this message without invalidating existing translations
		// return str_replace(sprintf(
		// 	' (%s)',
		// 	$user->user_login
		// ), '', $message);
	}

	/**
	 * Returns the current URL.
	 *
	 * @return string The current URL.
	 */
	public static function current_url()
	{
		// return esc_url((is_ssl() ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
		$request_uri = '';
		if (isset($_SERVER['HTTP_HOST']) && isset($_SERVER['REQUEST_URI']))
			$request_uri = esc_url_raw((is_ssl() ? 'https://' : 'http://') . sanitize_text_field(wp_unslash($_SERVER['HTTP_HOST'])) . sanitize_text_field(wp_unslash($_SERVER['REQUEST_URI'])));
		return filter_var($request_uri, FILTER_VALIDATE_URL);
	}

	/**
	 * Removes a list of common confirmation-style query args from a URL.
	 *
	 * @param string $url A URL.
	 * @return string The URL with query args removed.
	 */
	public static function remove_query_args($url)
	{
		return remove_query_arg(wp_removable_query_args(), $url);
	}

	/**
	 * Returns whether User Switching's equivalent of the 'logged_in' cookie should be secure.
	 *
	 * This is used to set the 'secure' flag on the old user cookie, for enhanced security.
	 *
	 * @link https://core.trac.wordpress.org/ticket/15330
	 *
	 * @return bool Should the old user cookie be secure?
	 */
	public static function secure_olduser_cookie()
	{
		return (is_ssl() && ('https' === wp_parse_url(home_url(), PHP_URL_SCHEME)));
	}

	/**
	 * Returns whether User Switching's equivalent of the 'auth' cookie should be secure.
	 *
	 * This is used to determine whether to set a secure auth cookie.
	 *
	 * @return bool Whether the auth cookie should be secure.
	 */
	public static function secure_auth_cookie()
	{
		return (is_ssl() && ('https' === wp_parse_url(wp_login_url(), PHP_URL_SCHEME)));
	}

	/**
	 * Adds a 'Switch back to {user}' link to the WooCommerce login screen.
	 *
	 * @return void
	 */
	public function ultimate_view_as_customer_for_woocommerce_action_woocommerce_login_form_start()
	{
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo wp_kses_post($this->ultimate_view_as_customer_for_woocommerce_filter_login_message(''));
	}

	/**
	 * Adds a 'Switch To' link to the WooCommerce order screen.
	 *
	 * @param WC_Order $order The WooCommerce order object.
	 * @return void
	 */
	public function ultimate_view_as_customer_for_woocommerce_action_woocommerce_order_details(WC_Order $order)
	{
		$user = $order->get_user();

		if (!$user || !current_user_can('ultimate_view_as_customer_for_woocommerce_switch_to_user', $user->ID)) {
			return;
		}

		$url = add_query_arg(array(
			'redirect_to' => rawurlencode(esc_url($order->get_view_order_url())),
		), self::switch_to_url($user));

		printf(
			'<p class="form-field form-field-wide"><a href="%1$s">%2$s</a></p>',
			esc_url($url),
			esc_html__('Switch&nbsp;To', 'ultimate-view-as-customer-for-woocommerce')
		);
	}

	/**
	 * Adds a 'Switch back to {user}' link to the My Account screen in WooCommerce.
	 *
	 * @param array<string, string> $items Menu items.
	 * @return array<string, string> Menu items.
	 */
	public function ultimate_view_as_customer_for_woocommerce_filter_woocommerce_account_menu_items(array $items)
	{
		$old_user = self::get_old_user();

		if (!$old_user) {
			return $items;
		}

		$items['ultimate-view-as-customer-for-woocommerce-switch-back'] = self::switch_back_message($old_user);

		return $items;
	}

	/**
	 * Sets the URL of the 'Switch back to {user}' link in the My Account screen in WooCommerce.
	 *
	 * @param string $url      The URL for the menu item.
	 * @param string $endpoint The endpoint slug for the menu item.
	 * @return string  The URL for the menu item.
	 */
	public function ultimate_view_as_customer_for_woocommerce_filter_woocommerce_get_endpoint_url($url, $endpoint)
	{
		if ('ultimate-view-as-customer-for-woocommerce-switch-back' !== $endpoint) {
			return $url;
		}

		$old_user = self::get_old_user();

		if (!$old_user) {
			return $url;
		}

		return self::switch_back_url($old_user);
	}

	/**
	 * Instructs WooCommerce to forget the session for the current user, without deleting it.
	 *
	 * @return void
	 */
	public function ultimate_view_as_customer_for_woocommerce_forget_woocommerce_session()
	{
		if (!function_exists('WC')) {
			return;
		}

		$wc = WC();

		if (!property_exists($wc, 'session')) {
			return;
		}

		if (!method_exists($wc->session, 'forget_session')) {
			return;
		}

		$wc->session->forget_session();
	}

	/**
	 * Filters a user's capabilities so they can be altered at runtime.
	 *
	 * This is used to:
	 *
	 *  - Grant the 'ultimate_view_as_customer_for_woocommerce_switch_to_user' capability to the user if they have the ability to edit the user they're trying to
	 *    switch to (and that user is not themselves).
	 *  - Grant the 'switch_off' capability to the user if they can edit other users.
	 *
	 * Important: This does not get called for Super Admins. See ultimate_view_as_customer_for_woocommerce_filter_map_meta_cap() below.
	 *
	 * @param array<string,bool> $user_caps     Array of key/value pairs where keys represent a capability name and boolean values
	 *                                          represent whether the user has that capability.
	 * @param array<int,string>  $required_caps Array of required primitive capabilities for the requested capability.
	 * @param array<int,mixed>   $args {
	 *     Arguments that accompany the requested capability check.
	 *
	 *     @type string    $0 Requested capability.
	 *     @type int       $1 Concerned user ID.
	 *     @type mixed  ...$2 Optional second and further parameters.
	 * }
	 * @param WP_User            $user          Concerned user object.
	 * @return array<string,bool> Array of concerned user's capabilities.
	 */
	public function ultimate_view_as_customer_for_woocommerce_filter_user_has_cap(array $user_caps, array $required_caps, array $args, WP_User $user)
	{
		if ('ultimate_view_as_customer_for_woocommerce_switch_to_user' === $args[0]) {
			if (empty($args[2])) {
				$user_caps['ultimate_view_as_customer_for_woocommerce_switch_to_user'] = false;
				return $user_caps;
			}
			if (array_key_exists('switch_users', $user_caps)) {
				$user_caps['ultimate_view_as_customer_for_woocommerce_switch_to_user'] = $user_caps['switch_users'];
				return $user_caps;
			}

			$user_caps['ultimate_view_as_customer_for_woocommerce_switch_to_user'] = (user_can($user->ID, 'edit_user', $args[2]) && ($args[2] !== $user->ID));
		} elseif ('switch_off' === $args[0]) {
			if (array_key_exists('switch_users', $user_caps)) {
				$user_caps['switch_off'] = $user_caps['switch_users'];
				return $user_caps;
			}

			$user_caps['switch_off'] = user_can($user->ID, 'edit_users');
		}

		return $user_caps;
	}

	/**
	 * Filters the required primitive capabilities for the given primitive or meta capability.
	 *
	 * This is used to:
	 *
	 *  - Add the 'do_not_allow' capability to the list of required capabilities when a Super Admin is trying to switch
	 *    to themselves.
	 *
	 * It affects nothing else as Super Admins can do everything by default.
	 *
	 * @param array<int,string> $required_caps Array of required primitive capabilities for the requested capability.
	 * @param string            $cap           Capability or meta capability being checked.
	 * @param int               $user_id       Concerned user ID.
	 * @param array<int,mixed>  $args {
	 *     Arguments that accompany the requested capability check.
	 *
	 *     @type mixed ...$0 Optional second and further parameters.
	 * }
	 * @return array<int,string> Array of required capabilities for the requested action.
	 */
	public function ultimate_view_as_customer_for_woocommerce_filter_map_meta_cap(array $required_caps, $cap, $user_id, array $args)
	{
		if ('ultimate_view_as_customer_for_woocommerce_switch_to_user' === $cap) {
			if (empty($args[0]) || $args[0] === $user_id) {
				$required_caps[] = 'do_not_allow';
			}
		}
		return $required_caps;
	}

	/**
	 * Singleton instantiator.
	 *
	 * @return Ultimate_View_As_Customer_For_Woocommerce_User_Switching User Switching instance.
	 */
	public static function get_instance()
	{
		static $instance;

		if (!isset($instance)) {
			$instance = new Ultimate_View_As_Customer_For_Woocommerce_User_Switching();
		}

		return $instance;
	}

	/**
	 * Private class constructor. Use `get_instance()` to get the instance.
	 */
	private function __construct() {}
}

if (!function_exists('ultimate_view_as_customer_for_woocommerce_set_olduser_cookie')) {
	/**
	 * Sets authorisation cookies containing the originating user information.
	 *
	 * @since 1.4.0 The `$token` parameter was added.
	 *
	 * @param int    $old_user_id The ID of the originating user, usually the current logged in user.
	 * @param bool   $pop         Optional. Pop the latest user off the auth cookie, instead of appending the new one. Default false.
	 * @param string $token       Optional. The old user's session token to store for later reuse. Default empty string.
	 * @return void
	 */
	function ultimate_view_as_customer_for_woocommerce_set_olduser_cookie($old_user_id, $pop = false, $token = '')
	{
		$secure_auth_cookie = Ultimate_View_As_Customer_For_Woocommerce_User_Switching::secure_auth_cookie();
		$secure_olduser_cookie = Ultimate_View_As_Customer_For_Woocommerce_User_Switching::secure_olduser_cookie();
		$expiration = time() + 172800; // 48 hours
		$auth_cookie = ultimate_view_as_customer_for_woocommerce_get_auth_cookie();
		$olduser_cookie = wp_generate_auth_cookie($old_user_id, $expiration, 'logged_in', $token);

		if ($secure_auth_cookie) {
			$auth_cookie_name = ULTIMATE_VIEW_AS_CUSTOMER_FOR_WOOCOMMERCE_USER_SWITCHING_SECURE_COOKIE;
			$scheme = 'secure_auth';
		} else {
			$auth_cookie_name = ULTIMATE_VIEW_AS_CUSTOMER_FOR_WOOCOMMERCE_USER_SWITCHING_COOKIE;
			$scheme = 'auth';
		}

		if ($pop) {
			array_pop($auth_cookie);
		} else {
			array_push($auth_cookie, wp_generate_auth_cookie($old_user_id, $expiration, $scheme, $token));
		}

		$auth_cookie = wp_json_encode($auth_cookie);

		if (false === $auth_cookie) {
			return;
		}

		/**
		 * Fires immediately before the User Switching authentication cookie is set.
		 * 
		 * @since 1.4.0
		 *
		 * @param string $auth_cookie JSON-encoded array of authentication cookie values.
		 * @param int    $expiration  The time when the authentication cookie expires as a UNIX timestamp.
		 * @param int    $old_user_id User ID.
		 * @param string $scheme      Authentication scheme. Values include 'auth' or 'secure_auth'.
		 * @param string $token       User's session token to use for the latest cookie.
		 */
		do_action('ultimate_view_as_customer_for_woocommerce_set_cookie', $auth_cookie, $expiration, $old_user_id, $scheme, $token);

		$scheme = 'logged_in';

		/**
		 * Fires immediately before the User Switching old user cookie is set.
		 *
		 * @since 1.4.0
		 *
		 * @param string $olduser_cookie The old user cookie value.
		 * @param int    $expiration     The time when the logged-in authentication cookie expires as a UNIX timestamp.
		 * @param int    $old_user_id    User ID.
		 * @param string $scheme         Authentication scheme. Values include 'auth' or 'secure_auth'.
		 * @param string $token          User's session token to use for this cookie.
		 */
		do_action('ultimate_view_as_customer_for_woocommerce_set_olduser_cookie', $olduser_cookie, $expiration, $old_user_id, $scheme, $token);

		/**
		 * Allows preventing auth cookies from actually being sent to the client.
		 *
		 * @since 1.5.4
		 *
		 * @param bool $send Whether to send auth cookies to the client.
		 */
		if (!apply_filters('ultimate_view_as_customer_for_woocommerce_send_auth_cookies', true)) {
			return;
		}

		setcookie($auth_cookie_name, $auth_cookie, $expiration, SITECOOKIEPATH, COOKIE_DOMAIN, $secure_auth_cookie, true);
		setcookie(ULTIMATE_VIEW_AS_CUSTOMER_FOR_WOOCOMMERCE_USER_SWITCHING_OLDUSER_COOKIE, $olduser_cookie, $expiration, COOKIEPATH, COOKIE_DOMAIN, $secure_olduser_cookie, true);
	}
}

if (!function_exists('ultimate_view_as_customer_for_woocommerce_ultimate_view_as_customer_for_woocommerce_clear_olduser_cookie')) {
	/**
	 * Clears the cookies containing the originating user, or pops the latest item off the end if there's more than one.
	 *
	 * @param bool $clear_all Optional. Whether to clear the cookies (as opposed to just popping the last user off the end). Default true.
	 * @return void
	 */
	function ultimate_view_as_customer_for_woocommerce_ultimate_view_as_customer_for_woocommerce_clear_olduser_cookie($clear_all = true)
	{
		$auth_cookie = ultimate_view_as_customer_for_woocommerce_get_auth_cookie();
		if (!empty($auth_cookie)) {
			array_pop($auth_cookie);
		}
		if ($clear_all || empty($auth_cookie)) {
			/**
			 * Fires just before the upgrade store cookies are cleared.
			 *
			 * @since 1.4.0
			 */
			do_action('ultimate_view_as_customer_for_woocommerce_clear_olduser_cookie');

			if (!apply_filters('ultimate_view_as_customer_for_woocommerce_send_auth_cookies', true)) {
				return;
			}

			$expire = time() - 31536000;
			setcookie(ULTIMATE_VIEW_AS_CUSTOMER_FOR_WOOCOMMERCE_USER_SWITCHING_COOKIE,         ' ', $expire, SITECOOKIEPATH, COOKIE_DOMAIN);
			setcookie(ULTIMATE_VIEW_AS_CUSTOMER_FOR_WOOCOMMERCE_USER_SWITCHING_SECURE_COOKIE,  ' ', $expire, SITECOOKIEPATH, COOKIE_DOMAIN);
			setcookie(ULTIMATE_VIEW_AS_CUSTOMER_FOR_WOOCOMMERCE_USER_SWITCHING_OLDUSER_COOKIE, ' ', $expire, COOKIEPATH, COOKIE_DOMAIN);
		} else {
			if (Ultimate_View_As_Customer_For_Woocommerce_User_Switching::secure_auth_cookie()) {
				$scheme = 'secure_auth';
			} else {
				$scheme = 'auth';
			}

			$old_cookie = end($auth_cookie);

			$old_user_id = wp_validate_auth_cookie($old_cookie, $scheme);
			if ($old_user_id) {
				$parts = wp_parse_auth_cookie($old_cookie, $scheme);

				if (false !== $parts) {
					ultimate_view_as_customer_for_woocommerce_set_olduser_cookie($old_user_id, true, $parts['token']);
				}
			}
		}
	}
}

if (!function_exists('ultimate_view_as_customer_for_woocommerce_get_olduser_cookie')) {
	/**
	 * Gets the value of the cookie containing the originating user.
	 *
	 * @return string|false The old user cookie, or boolean false if there isn't one.
	 */
	function ultimate_view_as_customer_for_woocommerce_get_olduser_cookie()
	{
		if (isset($_COOKIE[ULTIMATE_VIEW_AS_CUSTOMER_FOR_WOOCOMMERCE_USER_SWITCHING_OLDUSER_COOKIE])) {
			return sanitize_text_field(wp_unslash($_COOKIE[ULTIMATE_VIEW_AS_CUSTOMER_FOR_WOOCOMMERCE_USER_SWITCHING_OLDUSER_COOKIE]));
		} else {
			return false;
		}
	}
}

if (!function_exists('ultimate_view_as_customer_for_woocommerce_get_auth_cookie')) {
	/**
	 * Gets the value of the auth cookie containing the list of originating users.
	 *
	 * @return array<int,string> Array of originating user authentication cookie values. Empty array if there are none.
	 */
	function ultimate_view_as_customer_for_woocommerce_get_auth_cookie()
	{
		if (Ultimate_View_As_Customer_For_Woocommerce_User_Switching::secure_auth_cookie()) {
			$auth_cookie_name = ULTIMATE_VIEW_AS_CUSTOMER_FOR_WOOCOMMERCE_USER_SWITCHING_SECURE_COOKIE;
		} else {
			$auth_cookie_name = ULTIMATE_VIEW_AS_CUSTOMER_FOR_WOOCOMMERCE_USER_SWITCHING_COOKIE;
		}

		if (isset($_COOKIE[$auth_cookie_name]) && is_string($_COOKIE[$auth_cookie_name])) {
			$cookie = json_decode(sanitize_text_field(wp_unslash($_COOKIE[$auth_cookie_name])));
			// $cookie = json_decode(wp_unslash($_COOKIE[$auth_cookie_name]));
			// var_dump($cookie);
		}
		if (!isset($cookie) || !is_array($cookie)) {
			$cookie = array();
		}
		return $cookie;
	}
}

if (!function_exists('ultimate_view_as_customer_for_woocommerce_switch_to_user')) {
	/**
	 * Switches the current logged in user to the specified user.
	 *
	 * @param  int  $user_id      The ID of the user to switch to.
	 * @param  bool $remember     Optional. Whether to 'remember' the user in the form of a persistent browser cookie. Default false.
	 * @param  bool $set_old_user Optional. Whether to set the old user cookie. Default true.
	 * @return false|WP_User WP_User object on success, false on failure.
	 */
	function ultimate_view_as_customer_for_woocommerce_switch_to_user($user_id, $remember = false, $set_old_user = true)
	{
		$user = get_userdata($user_id);

		if (!$user) {
			return false;
		}

		$old_user_id = (is_user_logged_in()) ? get_current_user_id() : false;
		$old_token = wp_get_session_token();
		$auth_cookies = ultimate_view_as_customer_for_woocommerce_get_auth_cookie();
		$auth_cookie = end($auth_cookies);
		$cookie_parts = $auth_cookie ? wp_parse_auth_cookie($auth_cookie) : false;

		if ($set_old_user && $old_user_id) {
			// Switching to another user
			$new_token = '';
			ultimate_view_as_customer_for_woocommerce_set_olduser_cookie($old_user_id, false, $old_token);
		} else {
			// Switching back, either after being switched off or after being switched to another user
			$new_token = $cookie_parts['token'] ?? '';
			ultimate_view_as_customer_for_woocommerce_ultimate_view_as_customer_for_woocommerce_clear_olduser_cookie(false);
		}

		/**
		 * Attaches the original user ID and session token to the new session when a user switches to another user.
		 *
		 * @param array<string, mixed> $session Array of extra data.
		 * @return array<string, mixed> Array of extra data.
		 */
		$session_filter = function (array $session) use ($old_user_id, $old_token) {
			$session['switched_from_id'] = $old_user_id;
			$session['switched_from_session'] = $old_token;
			return $session;
		};

		add_filter('attach_session_information', $session_filter, 99);

		wp_clear_auth_cookie();
		wp_set_auth_cookie($user_id, $remember, '', $new_token);
		wp_set_current_user($user_id);

		remove_filter('attach_session_information', $session_filter, 99);

		if ($set_old_user && $old_user_id) {
			/**
			 * Fires when a user switches to another user account.
			 *
			 * @since 0.6.0
			 * @since 1.4.0 The `$new_token` and `$old_token` parameters were added.
			 *
			 * @param int    $user_id     The ID of the user being switched to.
			 * @param int    $old_user_id The ID of the user being switched from.
			 * @param string $new_token   The token of the session of the user being switched to. Can be an empty string
			 *                            or a token for a session that may or may not still be valid.
			 * @param string $old_token   The token of the session of the user being switched from.
			 */
			do_action('ultimate_view_as_customer_for_woocommerce_switch_to_user', $user_id, $old_user_id, $new_token, $old_token);
		} else {
			/**
			 * Fires when a user switches back to their originating account.
			 *
			 * @since 0.6.0
			 * @since 1.4.0 The `$new_token` and `$old_token` parameters were added.
			 *
			 * @param int       $user_id     The ID of the user being switched back to.
			 * @param int|false $old_user_id The ID of the user being switched from, or false if the user is switching back
			 *                               after having been switched off.
			 * @param string    $new_token   The token of the session of the user being switched to. Can be an empty string
			 *                               or a token for a session that may or may not still be valid.
			 * @param string    $old_token   The token of the session of the user being switched from.
			 */
			do_action('ultimate_view_as_customer_for_woocommerce_switch_back_user', $user_id, $old_user_id, $new_token, $old_token);
		}

		if ($old_token && $old_user_id && !$set_old_user) {
			// When switching back, destroy the session for the old user
			$manager = WP_Session_Tokens::get_instance($old_user_id);
			$manager->destroy($old_token);
		}

		return $user;
	}
}

if (!function_exists('ultimate_view_as_customer_for_woocommerce_switch_off_user')) {
	/**
	 * Switches off the current logged in user. This logs the current user out while retaining a cookie allowing them to log
	 * straight back in using the 'Switch back to {user}' system.
	 *
	 * @return bool True on success, false on failure.
	 */
	function ultimate_view_as_customer_for_woocommerce_switch_off_user()
	{
		$old_user_id = get_current_user_id();

		if (!$old_user_id) {
			return false;
		}

		$old_token = wp_get_session_token();

		ultimate_view_as_customer_for_woocommerce_set_olduser_cookie($old_user_id, false, $old_token);
		wp_clear_auth_cookie();
		wp_set_current_user(0);

		/**
		 * Fires when a user switches off.
		 *
		 * @since 0.6.0
		 * @since 1.4.0 The `$old_token` parameter was added.
		 *
		 * @param int    $old_user_id The ID of the upgrade store off.
		 * @param string $old_token   The token of the session of the upgrade store off.
		 */
		do_action('ultimate_view_as_customer_for_woocommerce_switch_off_user', $old_user_id, $old_token);

		return true;
	}
}

if (!function_exists('ultimate_view_as_customer_for_woocommerce_current_user_switched')) {
	/**
	 * Returns whether the current user switched into their account.
	 *
	 * @return false|WP_User False if the user isn't logged in or they didn't switch in; old user object (which evaluates to
	 *                       true) if the user switched into the current user account.
	 */
	function ultimate_view_as_customer_for_woocommerce_current_user_switched()
	{
		if (!is_user_logged_in()) {
			return false;
		}

		return Ultimate_View_As_Customer_For_Woocommerce_User_Switching::get_old_user();
	}
}

$GLOBALS['ultimate_view_as_customer_for_woocommerce'] = Ultimate_View_As_Customer_For_Woocommerce_User_Switching::get_instance();
$GLOBALS['ultimate_view_as_customer_for_woocommerce']->init_hooks();
