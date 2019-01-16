<?php
/*
Plugin Name: APTN Property Navbar
Plugin URI: https://aptn.ca
Description: Plugin contains widget that can be easily added to any website as a top property navigation bar.
Version: 1.0.0
Author: Ivan Reshetar
Author URI: https://aptn.ca
*/

add_action('widgets_init', function(){
    register_widget('PROPBAR_Widget');
});
//function propbar_widget(){
//    register_widget('PROPBAR_Widget');
//}

class PROPBAR_Widget extends WP_Widget {

    function __construct()
    {
        parent::__construct(
            'propbar_fw',
            'APTN Property Navbar Widget',
            array(
                'description' => 'Widget that can be easily added to any website as a top property navigation bar',
                'classname' => 'propbar_class'
            )
        );
        add_action('wp_enqueue_scripts', array($this, 'propbar_styles_scripts'));

        $res = get_option("widget_propbar_fw");
        foreach ($res as $value ) {
            if ( $value['header'] == 1 and is_admin() == false) {
                add_action( 'wp_head', array( $this, 'insert_after_body' ) );
            }
            if ( $value['footer'] == 1 and is_admin() == false) {
                add_action( 'wp_footer', array( $this, 'insert_in_footer' ) );
            }
        }

    }

    /**
     * Frontend
     */
    function widget($args, $instance)
    {
        $sidebar_color = 'dark';
        extract($args);
        extract($instance);

        if($sidebar){
            $title = apply_filters('widget_title', $title);
            $sidebar_code = '<ul class="propbar_main propbar_sidebar bg-'.$sidebar_color.'">
            <li>
                <a href="https://aptn.ca/" title="APTN TV" target="_blank" >
                    <img src="/wp-content/plugins/propbar-widget/img/'.$sidebar_color.'/APTN TV.png"/>
                </a>
            </li>
            <li>
                <a href="https://aptnnews.ca/"  title="APTN News" target="_blank" >
                    <img src="/wp-content/plugins/propbar-widget/img/'.$sidebar_color.'/APTN News.png"/>
                </a>
            </li>
            <li>
                <a href="http://www.aptncommunity.ca/" title="APTN Community" target="_blank" >
                    <img src="/wp-content/plugins/propbar-widget/img/'.$sidebar_color.'/APTN Community.png"/>
                </a>
            </li>
            <li>
                <a href="http://digitaldrum.ca/" title="APTN Digital Drum" target="_blank" >
                  <img src="/wp-content/plugins/propbar-widget/img/'.$sidebar_color.'/APTN Digital Drum.png"/>
                </a>
            </li>
            <li>
                <a href="https://aptnnews.ca/category/infocus/" title="APTN inFocus" target="_blank" >
                    <img src="/wp-content/plugins/propbar-widget/img/'.$sidebar_color.'/APTN inFocus.png"/>
                </a>
            </li>            
            <li>
                <a href="https://aptnnews.ca/category/investigates/"  title="APTN Investigates" target="_blank" >
                    <img src="/wp-content/plugins/propbar-widget/img/'.$sidebar_color.'/APTN Investigates.png"/>
                </a>
            </li>            
        </ul>';

            echo $before_widget;
            echo $before_title . $title .$widget_folder. $after_title;
            echo $sidebar_code;
            echo $after_widget;
        }

    }

    /** Insert page code into the buffer */
    public function insert_after_body( $template ) {
        ob_start( array( $this, 'insert_after_body_code' ) );
        return $template;
    }

    /** Insert code after tag <body> */
    public function insert_after_body_code( $buffer ) {

        $header_color = 'dark';
        $res = get_option("widget_propbar_fw");
        foreach ($res as $value ) {
            if ( $value['header_color']) {
                $header_color = $value['header_color'];
            }
        }
        $header_code = '
        <div class="propbar_block  bg-'.$header_color.'">
            <ul class="propbar_main" id="propbar_header">
                <li class="propbar_li_show">
                    <a href="https://aptn.ca/" title="APTN TV" target="_blank" >
                        <img src="/wp-content/plugins/propbar-widget/img/'.$header_color.'/APTN TV.png" class="propbar-logo-big"/>
                    </a>
                </li>
                <li class="propbar_li_show">
                    <a href="https://aptnnews.ca/"  title="APTN News" target="_blank" >
                        <img src="/wp-content/plugins/propbar-widget/img/'.$header_color.'/APTN News.png" class="propbar-logo-big"/>
                    </a>
                </li>
                <li class="propbar_li_show">
                    <a href="http://www.aptncommunity.ca/" title="APTN Community" target="_blank" >
                        <img src="/wp-content/plugins/propbar-widget/img/'.$header_color.'/APTN Community.png" class="propbar-logo-big"/>
                    </a>
                </li>
                <li class="propbar_li_show">
                    <a href="http://digitaldrum.ca/" title="APTN Digital Drum" target="_blank" >
                      <img src="/wp-content/plugins/propbar-widget/img/'.$header_color.'/APTN Digital Drum.png" class="propbar-logo-big"/>
                    </a>
                </li>
                <li class="propbar_li_show">
                    <a href="https://aptnnews.ca/category/infocus/" title="APTN inFocus" target="_blank" >
                        <img src="/wp-content/plugins/propbar-widget/img/'.$header_color.'/APTN inFocus.png" class="propbar-logo-big"/>
                    </a>
                </li>
                <li class="propbar_li_show">
                    <a href="https://aptnnews.ca/category/investigates/"  title="APTN Investigates" target="_blank" >
                        <img src="/wp-content/plugins/propbar-widget/img/'.$header_color.'/APTN Investigates.png" class="propbar-logo-big"/>
                    </a>
                </li>            
            </ul>
            <div id="prev-next-btns">
                <div class="bg-'.$header_color.'" id="prev-btn"  title="Prev"><</div>
                <div class="bg-'.$header_color.'" id="next-btn"  title="Next">></div>
            </div>
        </div>';
        $buffer = preg_replace( '@<body[^>]*>@', '$0' . apply_filters( 'dco_iac_insert_after_body', "\n" . $header_code ), $buffer );
        return $buffer;
    }

    /** Insert page code into the buffer */
    public function insert_in_footer( $template ) {
        ob_start( array( $this, 'insert_in_footer_code' ) );
        return $template;
    }

    /** Insert code before the tag </body> */
    public function insert_in_footer_code( $buffer ) {
        $footer_color = 'dark';
        $res = get_option("widget_propbar_fw");
        foreach ($res as $value ) {
            if ( $value['footer_color']) {
                $footer_color = $value['footer_color'];
            }
        }
        $footer_code = '
        <div class="propbar_block bg-'.$footer_color.'">
            <ul class="propbar_main"  id="propbar_footer">
                <li class="propbar_li_show">
                    <a href="https://aptn.ca/" title="APTN TV" target="_blank" >
                        <img src="/wp-content/plugins/propbar-widget/img/'.$footer_color.'/APTN TV.png" class="propbar-logo-big"/>
                    </a>
                </li>
                <li class="propbar_li_show">
                    <a href="https://aptnnews.ca/"  title="APTN News" target="_blank" >
                        <img src="/wp-content/plugins/propbar-widget/img/'.$footer_color.'/APTN News.png" class="propbar-logo-big"/>
                    </a>
                </li>
                <li class="propbar_li_show">
                    <a href="http://www.aptncommunity.ca/" title="APTN Community" target="_blank" >
                        <img src="/wp-content/plugins/propbar-widget/img/'.$footer_color.'/APTN Community.png" class="propbar-logo-big"/>
                    </a>
                </li>
                <li class="propbar_li_show">
                    <a href="http://digitaldrum.ca/" title="APTN Digital Drum" target="_blank" >
                      <img src="/wp-content/plugins/propbar-widget/img/'.$footer_color.'/APTN Digital Drum.png" class="propbar-logo-big"/>
                    </a>
                </li>
                <li class="propbar_li_show">
                    <a href="https://aptnnews.ca/category/infocus/" title="APTN inFocus" target="_blank" >
                        <img src="/wp-content/plugins/propbar-widget/img/'.$footer_color.'/APTN inFocus.png" class="propbar-logo-big"/>
                    </a>
                </li>                
                <li class="propbar_li_show">
                    <a href="https://aptnnews.ca/category/investigates/"  title="APTN Investigates" target="_blank" >
                        <img src="/wp-content/plugins/propbar-widget/img/'.$footer_color.'/APTN Investigates.png" class="propbar-logo-big"/>
                    </a>
                </li>
            </ul>
            <div id="prev-next-btns-footer">
                <div class="bg-'.$footer_color.'" id="prev-btn-footer" title="Prev"><</div>
                <div class="bg-'.$footer_color.'" id="next-btn-footer" title="Next">></div>
            </div>
        </div>';
        $buffer = preg_replace( '@</body[^>]*>@', '$0' . apply_filters( 'dco_iac_insert_after_body', "\n" . $footer_code ), $buffer );
        return $buffer;
    }


    /**
     * Scripts connection
     */
    function propbar_styles_scripts(){
        wp_register_style('propbar-style', plugins_url('css/propbar-style.min.css', __FILE__));
        wp_enqueue_style('propbar-style');

        wp_register_script('propbar-script', plugins_url('js/propbar-script.min.js', __FILE__), ['jquery']);
        wp_enqueue_script('propbar-script');

    }

    /**
     * Backend
     */
    function form($instance)
    {
        //var_dump($instance);
        extract($instance);
        $title = !empty( $title ) ? $title : 'More from APTN';
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo 'Title:'; ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <input class="checkbox" type="checkbox"<?php checked( $instance['header'] ); ?> id="<?php echo $this->get_field_id('header'); ?>" name="<?php echo $this->get_field_name('header'); ?>" />
            <label for="<?php echo $this->get_field_id('header'); ?>"><?php _e('Show in header'); ?></label>
            <br>
            <input class="checkbox" type="checkbox"<?php checked( $instance['sidebar'] ); ?> id="<?php echo $this->get_field_id('sidebar'); ?>" name="<?php echo $this->get_field_name('sidebar'); ?>" />
            <label for="<?php echo $this->get_field_id('sidebar'); ?>"><?php _e('Show in sidebar'); ?></label>
            <br>
            <input class="checkbox" type="checkbox"<?php checked( $instance['footer'] ); ?> id="<?php echo $this->get_field_id('footer'); ?>" name="<?php echo $this->get_field_name('footer'); ?>" />
            <label for="<?php echo $this->get_field_id('footer'); ?>"><?php _e('Show in footer'); ?></label>
            <br><br>
            <label for="<?php echo esc_attr( $this->get_field_id( 'header_color' ) ); ?>"><?php _e( 'Header color' ); ?></label>
            <select name="<?php echo esc_attr( $this->get_field_name( 'header_color' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'header_color' ) ); ?>" class="widefat">
                <option value="dark"<?php selected( $instance['header_color'], 'dark' ); ?>><?php _e('Dark'); ?></option>
                <option value="light"<?php selected( $instance['header_color'], 'light' ); ?>><?php _e('Light'); ?></option>
            </select>
            <label for="<?php echo esc_attr( $this->get_field_id( 'sidebar_color' ) ); ?>"><?php _e( 'Sidebar color' ); ?></label>
            <select name="<?php echo esc_attr( $this->get_field_name( 'sidebar_color' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'sidebar_color' ) ); ?>" class="widefat">
                <option value="dark"<?php selected( $instance['sidebar_color'], 'dark' ); ?>><?php _e('Dark'); ?></option>
                <option value="light"<?php selected( $instance['sidebar_color'], 'light' ); ?>><?php _e('Light'); ?></option>
            </select>
            <label for="<?php echo esc_attr( $this->get_field_id( 'footer_color' ) ); ?>"><?php _e( 'Footer color' ); ?></label>
            <select name="<?php echo esc_attr( $this->get_field_name( 'footer_color' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'footer_color' ) ); ?>" class="widefat">
                <option value="dark"<?php selected( $instance['footer_color'], 'dark' ); ?>><?php _e('Dark'); ?></option>
                <option value="light"<?php selected( $instance['footer_color'], 'light' ); ?>><?php _e('Light'); ?></option>
            </select>
        </p>
        <?php
    }

    /**
     * Handles updating settings for the current widget instance.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $new_instance = wp_parse_args( (array) $new_instance, array('header' => 0, 'sidebar' => 0, 'footer' => 0) );
        $instance['header'] = $new_instance['header'] ? 1 : 0;
        $instance['sidebar'] = $new_instance['sidebar'] ? 1 : 0;
        $instance['footer'] = $new_instance['footer'] ? 1 : 0;
        $instance['title'] = $new_instance['title'];
        $instance['header_color'] = $new_instance['header_color'];
        $instance['sidebar_color'] = $new_instance['sidebar_color'];
        $instance['footer_color'] = $new_instance['footer_color'];
        return $instance;
    }


}


