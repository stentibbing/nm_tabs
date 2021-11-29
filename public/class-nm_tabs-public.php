<?php

/**
 * The public-facing functionality of the plugin.
 */
class Nm_tabs_Public
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
     * Register the stylesheets for the public-facing side of the site.
     */
    public function enqueue_styles()
    {
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/nm_tabs-public.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     */
    public function enqueue_scripts()
    {
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/nm_tabs-public.js', array( 'jquery' ), $this->version, false);
    }
    
    /**
     * Register public shortcodes
     */
    public function add_shortcodes()
    {
        add_shortcode('nm_tabs', array($this, 'render_tabs' ));
        add_shortcode('nm_tab_content', array($this, 'render_tab_content'));
    }

    /**
     * Incase any tabs have inline styles, we include these
     */
    public function add_inline_styles()
    {
        $inline_css = "";
        $args = array(
            'post_type' => 'nm_tabs',
            'nopaging' => true,
        );
        foreach (get_posts($args) as $page) {
            if (array_key_exists('_wpb_shortcodes_custom_css', get_post_meta($page->ID))) {
                foreach (get_post_meta($page->ID)['_wpb_shortcodes_custom_css'] as $custom_style) {
                    $inline_css .= $custom_style;
                }
            }
        }
        if (!empty($inline_css)) {
            wp_add_inline_style($this->plugin_name, $inline_css);
        }
    }
    
    /**
    * Get Tabs custom post types
    */
    private function get_tabs($group_slug)
    {
        $tabs = [];
        $tab_meta = ['_nm_tabs_icon', '_nm_tabs_active_icon'];
                
        $args = array(
                    'post_type' => 'nm_tabs',
                    'order' => 'DSC',
                    'orderby' => 'menu_order',
                    'nopaging' => true
                        );
            
        // Incase tab_group arg is passed, look for posts only with that term
        if (!empty($group_slug)) {
            $args['tax_query'] = array(
                array(
                        'taxonomy' => 'nm_tab_groups',
                        'field' => 'slug',
                        'terms' => $group_slug
                        ),
            );
        }
        
        foreach (get_posts($args) as $tab) {
            if ($tab->post_status == 'publish') {
                $new_tab = [];
                $new_tab['id'] = $tab->ID;
                $new_tab['title'] = $tab->post_title;
                $new_tab['content'] = $tab->post_content;

                $tab_icon_id = get_post_meta($tab->ID, '_nm_tabs_icon', true);
                $tab_icon_url = wp_get_attachment_image_src($tab_icon_id);
                $tab_active_icon_id = get_post_meta($tab->ID, '_nm_tabs_active_icon', true);
                $tab_active_icon_url = wp_get_attachment_image_src($tab_active_icon_id);

                if (is_array($tab_icon_url)) {
                    $new_tab['icon'] = $tab_icon_url[0];
                }

                if (is_array($tab_active_icon_url)) {
                    $new_tab['active_icon'] = $tab_active_icon_url[0];
                }
            }
            $tabs[] = $new_tab;
        }
        
        if (!empty($tabs)) {
            return $tabs;
        } else {
            return null;
        }
    }
    
    /**
    * Return rendered tabs by group
    */
    public function render_tabs($atts)
    {
        $tab_group = get_term_by('slug', $atts['tab_group'], 'nm_tab_groups');

        if ($tab_group) {
            $tabs = $this->get_tabs($atts);
            $tab_group_slug = $tab_group->slug;
            if ($tabs) {
                return require plugin_dir_path(__FILE__) . '/partials/nm_tabs-public-tabs.php';
            }
        } else {
            return 'No content found!';
        }
    }
    
    /**
    * Return rendered tab content by group
    */
    public function render_tab_content($atts)
    {
        $tab_group = get_term_by('slug', $atts['tab_group'], 'nm_tab_groups');

        if ($tab_group) {
            $tabs = $this->get_tabs($atts);
            $tab_group_slug = $tab_group->slug;
            if ($tabs) {
                return require plugin_dir_path(__FILE__) . '/partials/nm_tabs-public-content.php';
            }
        } else {
            return 'No content found!';
        }
    }
}
