<?php

/**
 * The admin-specific functionality of the plugin.
 */
class Nm_tabs_Admin
{

    /**
     * The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     */
    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * Register the stylesheets for the admin area.
     */
    public function enqueue_styles()
    {
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/nm_tabs-admin.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the admin area.
     */
    public function enqueue_scripts()
    {
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/nm_tabs-admin.js', array( 'jquery' ), $this->version, false);
    }
    
    /**
     * Register tabs custom post type
     */
    public function register_tab_cpt()
    {
        $labels = array(
                    'name'                  => _x('Nordic Milk Tabs', 'Post Type General Name', 'nm_tabs'),
                    'singular_name'         => _x('Tab', 'Post Type Singular Name', 'nm_tabs'),
                    'menu_name'             => __('Tabs', 'nm_tabs'),
                    'name_admin_bar'        => __('Tabs', 'nm_tabs'),
                    'archives'              => __('Our Tabs', 'nm_tabs'),
                    'attributes'            => __('Tab Attributes', 'nm_tabs'),
                    'parent_item_colon'     => __('Parent tab:', 'nm_tabs'),
                    'all_items'             => __('All tabs', 'nm_tabs'),
                    'add_new_item'          => __('Add new tab', 'nm_tabs'),
                    'add_new'               => __('Add new', 'nm_tabs'),
                    'new_item'              => __('New tab', 'nm_tabs'),
                    'edit_item'             => __('Edit tab', 'nm_tabs'),
                    'update_item'           => __('Update tab', 'nm_tabs'),
                    'view_item'             => __('View tab', 'nm_tabs'),
                    'view_items'            => __('View tabs', 'nm_tabs'),
                    'search_items'          => __('Search tab', 'nm_tabs'),
                    'not_found'             => __('Not found', 'nm_tabs'),
                    'not_found_in_trash'    => __('Not found in Trash', 'nm_tabs'),
                    'insert_into_item'      => __('Insert into tabs sheet', 'nm_tabs'),
                    'uploaded_to_this_item' => __('Uploaded to this tab sheet', 'nm_tabs'),
                    'items_list'            => __('Tabs list', 'nm_tabs'),
                    'item_published'				=> __('Tabs published', 'nm_tabs'),
                    'items_list_navigation' => __('Tabs list navigation', 'nm_tabs'),
                    'filter_items_list'     => __('Filter tabs list', 'nm_tabs'),
            );
    
        $args = array(
                    'label'                 => __('Tabs', 'nm_tabs'),
                    'description'           => __('Pages to be shown on the tabs section', 'nm_tabs'),
                    'labels'                => $labels,
                    'supports'              => array( 'title', 'editor', 'page-attributes'),
                    'hierarchical'          => false,
                    'public'                => true,
                    'show_ui'               => true,
                    'show_in_menu'          => true,
                    'menu_position'         => 5,
                    'menu_icon'             => 'dashicons-index-card',
                    'show_in_admin_bar'     => true,
                    'show_in_nav_menus'     => true,
                    'can_export'            => true,
                    'has_archive'           => false,
                    'exclude_from_search'   => false,
                    'publicly_queryable'    => true,
                    'capability_type'       => 'post',
                    'show_in_rest'	    => false
            );
    
        register_post_type('nm_tabs', $args);
    }
    
    /**
    * Register tabs group taxonomy
     */
    public function register_tab_groups_taxonomy()
    {
        $labels = array(
            'name'                  => _x('Tab groups', 'Post Type General Name', 'nm_tabs'),
            'singular_name'         => _x('Tab group', 'Post Type Singular Name', 'nm_tabs'),
            'search_items'          => __('Search Tab Groups', 'nm_tabs'),
            'popular_items'				 	=> __('Popular Tab Groups', 'nm_tabs'),
            'all_items'             => __('All Tab Groups', 'nm_tabs'),
            'edit_item'             => __('Edit Tab Group', 'nm_tabs'),
            'view_item'             => __('View Tab Group', 'nm_tabs'),
            'update_item'           => __('Update Tab Group', 'nm_tabs'),
            'add_new_item'          => __('Add New Tab Group', 'nm_tabs'),
            'new_item_name'					=> __('New Tab Group Name', 'nm_tabs'),
            'separate_items_with_commas' => __('Separate tab groups with commas', 'nm_tabs'),
            'add_or_remove_items'		=> __('Add or remove tab groups', 'nm_tabs'),
            'choose_from_most_used'	=> __('Choose from the most used tab groups', 'nm_tabs'),
            'not_found'							=> __('No tab group found', 'nm_tabs'),
            'no_terms'							=> __('No tab group', 'nm_tabs'),
            'filter_by_item'				=> __('Filter by tab groups', 'nm_tabs'),
            'items_list_navigation'	=> __('Tab group list navigation', 'nm_tabs'),
            'item_list'							=> __('Tab group list', 'nm_tabs'),
            'most_used'							=> __('Most used tab groups', 'nm_tabs'),
            'back_to_items'					=> __('Back to tab groups', 'nm_tabs'),
            'item_link'							=> __('Tab groups Link', 'nm_tabs'),
            'item_link_description' => __('A link to a tab group', 'nm_tabs')
        );
    
        $args = array(
            'labels'								=> $labels,
            'description'						=> __('Tab groups', 'nm_tabs'),
            'public'								=> true,
            'hierarchical'					=> false,
            'show_in_rest'					=> false,
            'show_admin_column'			=> true,
        );
    
        register_taxonomy('nm_tab_groups', 'nm_tabs', $args);
    }

    /**
     * Add icons metabox to tab cpt
     */
    public function add_icons_metabox()
    {
        add_meta_box('nm_tabs_icons', __('Tab icons', 'nm_tabs'), array($this, 'render_icons_metabox'), 'nm_tabs', 'side', 'default', null);
    }

    /**
     * Render content for icons metabox
     */
    public function render_icons_metabox($post)
    {
        wp_nonce_field('nm_tabs_icons', 'nm_tabs_icons_wpnonce');
        wp_enqueue_media();

        global $post;

        // Get WordPress' media upload URL
        $upload_link = esc_url(get_upload_iframe_src('image', $post->ID));

        // See if icons are already saved as post meta
        $icon = get_post_meta($post->ID, '_nm_tabs_icon', true);
        $active_icon = get_post_meta($post->ID, '_nm_tabs_active_icon', true);
        

        // Get the icons source
        $icon_src = wp_get_attachment_image_src($icon, 'full');
        $active_icon_src = wp_get_attachment_image_src($active_icon, 'full');
        
        // For convenience, see if the array is valid
        $icon_exists = is_array($icon_src);
        $active_icon_exists = is_array($active_icon_src);
        
        require plugin_dir_path(__FILE__) . '/partials/nm_tabs-admin-icon.php';
    }

    /**
     * Save icons as post meta
     */
    public function save_icons($post_id)
    {
        if (!isset($_POST['nm_tabs_icons_wpnonce']) ||
                    !wp_verify_nonce($_POST['nm_tabs_icons_wpnonce'], 'nm_tabs_icons') ||
                    defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ||
                    !current_user_can('edit_post', $post_id)) {
            return;
        }

        $post_properties = ['nm-tabs-icon' => '_nm_tabs_icon', 'nm-tabs-active-icon' => '_nm_tabs_active_icon'];

        foreach ($post_properties as $post_property => $tab_meta_key) {
            if (isset($_POST[$post_property])) {
                if (is_array(wp_get_attachment_image_src($_POST[$post_property]))) {
                    update_post_meta($post_id, $tab_meta_key, $_POST[$post_property]);
                } elseif (empty($_POST[$post_property])) {
                    delete_post_meta($post_id, $tab_meta_key);
                }
            }
        }
    }
}
