<?php
/*
 * Created by Artureanec
*/

# Custom Fields
if ( class_exists( 'RWMB_Field' ) ) {
    class RWMB_Help_Field extends RWMB_Key_Value_Field {
        public static function html( $meta, $field ) {
            // Question.
            $key                            = isset( $meta[0] ) ? $meta[0] : '';
            $attributes                     = self::get_attributes( $field, $key );
            $attributes['placeholder']      = esc_attr__('Title', 'technum');
            $html                           = sprintf( '<input %s>', self::render_attributes( $attributes ) );

            // Answer.
            $val                            = isset( $meta[1] ) ? $meta[1] : '';
            $attributes                     = self::get_attributes( $field, $val );
            $attributes['placeholder']      = esc_attr__('Text', 'technum');
            $attributes['id']               = $attributes['id'] . esc_attr('_text');
            $attributes['value']            = false;
            $html                           .= sprintf( '<textarea %s>%s</textarea>', self::render_attributes( $attributes ), $val );

            return $html;
        }
    }

    class RWMB_Benefits_Field extends RWMB_Input_Field {
        public static function admin_enqueue_scripts() {
            wp_enqueue_style( 'rwmb-color', RWMB_CSS_URL . 'color.css', array( 'wp-color-picker' ), RWMB_VER );

            $dependencies = array( 'wp-color-picker' );
            $args         = func_get_args();
            $field        = reset( $args );
            if ( ! empty( $field['alpha_channel'] ) ) {
                wp_enqueue_script( 'wp-color-picker-alpha', RWMB_JS_URL . 'wp-color-picker-alpha/wp-color-picker-alpha.min.js', array( 'wp-color-picker' ), RWMB_VER, true );
                $dependencies = array( 'wp-color-picker-alpha' );
            }
            wp_enqueue_script( 'rwmb-color', RWMB_JS_URL . 'color.js', $dependencies, RWMB_VER, true );
        }

        public static function html( $meta, $field ) {

            $icon_container = technum_icon_picker_popover(true, true, true, true);

            // Icon.
            $key                                    = isset( $meta[0] ) ? $meta[0] : '';
            $attributes                             = self::get_attributes( $field, $key );
            $attributes['placeholder']              = esc_attr__('Icon', 'technum');
            $attributes['class']                    = esc_attr('icp icp-auto');
            $attributes['type']                     = esc_attr('text');
            $attributes['readonly']                 = true;
            $attributes['id']                       = $attributes['id'] . esc_attr('_icon');
            $attributes['data-options']             = false;
            $attributes['data-alpha-enabled']       = false;
            $attributes['data-alpha-color-type']    = false;
            $html                                   = '<div class="rwmb-benefits-icon-picker">';
            $html                                   .= '<div class="input-group icp-container">';
            $html                                   .= sprintf('<input data-placement="bottomRight" %s">', self::render_attributes($attributes) );

            if ( !empty($key) ) {
                $html .= '<span class="input-group-addon"><i class="' . esc_attr($key) . '"></i></span></div>' . sprintf('%s', $icon_container);
            } else {
                $html .= '<span class="input-group-addon"></span></div>' . sprintf('%s', $icon_container);
            };
            $html                                   .= '</div>';

            // Title.
            if ( $field['field_title'] ) {
                $val                                    = isset( $meta[1] ) ? $meta[1] : '';
                $attributes                             = self::get_attributes( $field, $val );
                $attributes['placeholder']              = esc_attr__('Title', 'technum');
                $attributes['id']                       = $attributes['id'] . esc_attr('_title');
                $attributes['data-options']             = false;
                $attributes['data-alpha-enabled']       = false;
                $attributes['data-alpha-color-type']    = false;
                $html                                   .= '<div class="rwmb-benefits-title">';
                $html                                   .= sprintf( '<input %s>', self::render_attributes($attributes) );
                $html                                   .= '</div>';
            }

            // Color.
            if ( $field['field_color'] ) {
                $key                                    = isset( $meta[2] ) ? $meta[2] : '';
                $attributes                             = self::get_attributes( $field, $key );
                $attributes['placeholder']              = false;
                $attributes['class']                    = 'rwmb-color wp-color-picker';
                $attributes['id']                       = $attributes['id'] . esc_attr('_color');
                $html                                   .= '<div class="rwmb-benefits-color">';
                $html                                   .= sprintf( '<input %s>', self::render_attributes($attributes) );
                $html                                   .= '</div>';
            }

            return $html;
        }

        public static function begin_html( $meta, $field ) {
            $desc = $field['desc'] ? "<p id='{$field['id']}_description' class='description'>{$field['desc']}</p>" : '';
            if ( empty( $field['name'] ) ) {
                return '<div class="rwmb-input">' . $desc;
            }
            return sprintf(
                '<div class="rwmb-label">
				<label for="%s">%s</label>
			</div>
			<div class="rwmb-input">
			%s',
                $field['id'],
                $field['name'],
                $desc
            );
        }

        public static function input_description( $field ) {
            return '';
        }

        public static function label_description( $field ) {
            return '';
        }

        public static function esc_meta( $meta ) {
            foreach ( (array) $meta as $k => $pairs ) {
                $meta[ $k ] = array_map( 'esc_attr', (array) $pairs );
            }
            return $meta;
        }

        public static function value( $new, $old, $post_id, $field ) {
            foreach ( $new as &$arr ) {
                if ( empty( $arr[0] ) && empty( $arr[1] ) ) {
                    $arr = false;
                }
            }
            $new = array_filter( $new );
            return $new;
        }

        public static function normalize( $field ) {
            $field['clone']         = true;
            $field['multiple']      = true;
            $field                  = wp_parse_args(
                $field,
                array(
                    'alpha_channel' => false,
                    'js_options'    => array(),
                )
            );
            $field                  = wp_parse_args(
                $field,
                array(
                    'field_title'   => false,
                    'field_color'   => false,
                    'size'          => 30,
                    'maxlength'     => false,
                    'pattern'       => false,
                )
            );
            $field['js_options']    = wp_parse_args(
                $field['js_options'],
                array(
                    'defaultColor' => false,
                    'hide'         => true,
                    'palettes'     => true,
                )
            );
            $field             = parent::normalize( $field );

            $field['attributes']['type'] = 'text';
            $field['placeholder']        = wp_parse_args(
                (array) $field['placeholder'],
                array(
                    'key'   => esc_html__( 'Icon', 'technum' ),
                    'value' => esc_html__( 'Title', 'technum' ),
                )
            );
            return $field;
        }

        public static function format_clone_value( $field, $value, $args, $post_id ) {
            return sprintf( '<label>%s:</label> %s', $value[0], $value[1] );
        }

        public static function get_attributes( $field, $value = null ) {
            $attributes         = parent::get_attributes( $field, $value );
            $attributes         = wp_parse_args(
                $attributes,
                array(
                    'size'          => $field['size'],
                    'maxlength'     => $field['maxlength'],
                    'pattern'       => $field['pattern'],
                    'placeholder'   => $field['placeholder'],
                    'data-options'  => wp_json_encode( $field['js_options'] ),
                )
            );
            $attributes['type'] = 'text';

            if ( $field['alpha_channel'] ) {
                $attributes['data-alpha-enabled']    = 'true';
                $attributes['data-alpha-color-type'] = 'hex';
            }

            return $attributes;
        }

        public static function format_single_value( $field, $value, $args, $post_id ) {
            return sprintf( "<span style='display:inline-block;width:20px;height:20px;border-radius:50%%;background:%s;'></span>", $value );
        }
    }

    class RWMB_Iconpicker_Field extends RWMB_Input_Field {

        public static function html( $meta, $field ) {
            $icon_container = technum_icon_picker_popover(true, true, true, true);

            // Icon.
            $attributes                              = self::call( 'get_attributes', $field, $meta );
            $attributes['placeholder']              = '';
            $attributes['class']                    = esc_attr('icp icp-auto');
            $attributes['type']                     = esc_attr('text');
            $attributes['readonly']                 = true;
            $html                                   = '<div class="rwmb-iconpicker-icon-picker">';
            $html                                   .= '<div class="input-group icp-container">';
            $html                                   .= sprintf('<input data-placement="bottomRight" %s">', self::render_attributes($attributes) );

            if ( !empty($meta) ) {
                $html .= '<span class="input-group-addon"><i class="' . esc_attr($meta) . '"></i></span></div>' . sprintf('%s', $icon_container);
            } else {
                $html .= '<span class="input-group-addon"></span></div>' . sprintf('%s', $icon_container);
            };
            $html                                   .= '</div>';

            return $html;
        }

        public static function normalize( $field ) {
            $field = parent::normalize( $field );

            $field = wp_parse_args(
                $field,
                array(
                    'size'      => 30,
                    'maxlength' => false,
                    'pattern'   => false,
                )
            );

            return $field;
        }

        public static function get_attributes( $field, $value = null ) {
            $attributes = parent::get_attributes( $field, $value );
            $attributes = wp_parse_args(
                $attributes,
                array(
                    'size'        => $field['size'],
                    'maxlength'   => $field['maxlength'],
                    'pattern'     => $field['pattern'],
                    'placeholder' => $field['placeholder'],
                )
            );

            return $attributes;
        }
    }
}

# RWMB check
if (!function_exists('technum_post_options')) {
    function technum_post_options()
    {
        if (class_exists('RWMB_Loader')) {
            return true;
        } else {
            return false;
        }
    }
}

# RWMB get option
if (!function_exists('technum_get_post_option')) {
    function technum_get_post_option($name, $default = false) {
        if (class_exists('RWMB_Loader')) {
            if (rwmb_meta($name)) {
                return rwmb_meta($name);
            } else {
                return $default;
            }
        } else {
            return $default;
        }
    }
}

# RWMB get value
if (!function_exists('technum_get_post_value')) {
    function technum_get_post_value($name, $default = false) {
        if (class_exists('RWMB_Loader')) {
            if (rwmb_the_value($name, null, null, false)) {
                return rwmb_the_value($name, null, null, false);
            } else {
                return $default;
            }
        } else {
            return $default;
        }
    }
}

# RWMB get image
if (!function_exists('technum_get_post_image')) {
    function technum_get_post_image($name, $size = 'large', $default = false) {
        if (class_exists('RWMB_Loader')) {
            if (rwmb_meta($name)) {
                $out = '';
                $images = rwmb_meta( $name, array( 'size' => $size ) );
                foreach ( $images as $image ) {
                    $out .= '<div class="image_wrapper"><img src="'. $image['url']. '" alt="'. $image['alt']. '"></div>';
                }
                return $out;
            } else {
                return $default;
            }
        } else {
            return $default;
        }
    }
}

# RWMB get time
if (!function_exists('technum_get_post_time')) {
    function technum_get_post_time($time, $default = false) {
        if (class_exists('RWMB_Loader')) {
            if (rwmb_meta($time)) {
                $time = ' ' . rwmb_meta($time);
                $time = str_replace(esc_html__(' 0 Hours', 'technum'), '', $time);
                $time = str_replace(esc_html__(' 0 Minutes', 'technum'), '', $time);
                $time = str_replace(esc_html__(' 1 Hours', 'technum'), esc_html__(' 1 Hour', 'technum'), $time);
                $time = str_replace(esc_html__(' 1 Minutes', 'technum'), esc_html__('1 Minute', 'technum'), $time);
                return trim($time);
            } else {
                return $default;
            }
        } else {
            return $default;
        }
    }
}

if (class_exists('RWMB_Loader')) {
    if (!function_exists('technum_custom_meta_boxes')) {
        add_filter('rwmb_meta_boxes', 'technum_custom_meta_boxes');

        function technum_custom_meta_boxes($meta_boxes) {
            $sidebar_list_default = array(
                'default' => esc_html__('Default', 'technum')
            );
            $sidebar_list = technum_get_all_sidebar_list();
            $sidebar_list = $sidebar_list_default + $sidebar_list;

            # Quote Post Format
            $meta_boxes[] = array(
                'title'         => esc_html__('Quote Post Format Settings', 'technum'),
                'post_types'    => array('post'),
                'context'       => 'advanced',
                'fields'        => array(
                    array(
                        'id'            => 'post_media_quote_text',
                        'name'          => esc_html__('Select Images', 'technum'),
                        'placeholder'   => esc_html__('Enter Quote Text', 'technum'),
                        'type'          => 'textarea',
                    ),
                    array(
                        'id'            => 'post_media_quote_author',
                        'name'          => esc_html__('Select Images', 'technum'),
                        'placeholder'   => esc_html__('Quote Author Name', 'technum'),
                        'type'          => 'text',
                    ),
                ),
            );

            # Gallery Post Format
            $meta_boxes[] = array(
                'title'         => esc_html__('Gallery Post Format Settings', 'technum'),
                'post_types'    => array('post'),
                'context'       => 'advanced',
                'fields'        => array(
                    array(
                        'id'        => 'post_media_gallery_select',
                        'name'      => esc_html__('Select Images', 'technum'),
                        'type'      => 'image_advanced',
                    ),
                ),
            );

            # Video Post Format
            $meta_boxes[] = array(
                'title'         => esc_html__('Video Post Format Settings', 'technum'),
                'post_types'    => array('post'),
                'context'       => 'advanced',
                'fields'        => array(
                    array(
                        'id'        => 'post_media_video_type',
                        'name'      => esc_html__('Video Source', 'technum'),
                        'type'      => 'select',
                        'std'       => 'link',
                        'options'   => array(
                            'link'      => esc_html__('Outer Link', 'technum'),
                            'self'      => esc_html__('Self Hosted', 'technum')
                        )
                    ),
                    array(
                        'id'            => 'post_media_video_url',
                        'name'          => esc_html__('Enter Video Link', 'technum'),
                        'type'          => 'oembed',
                        'desc'          => esc_html__('Copy link to the video from YouTube or other video-sharing website.', 'technum'),
                        'attributes'    => array(
                            'data-dependency-id'    => 'post_media_video_type',
                            'data-dependency-val'   => 'link'
                        )
                    ),
                    array(
                        'id'                => 'post_media_video_select',
                        'name'              => esc_html__('Select Video From Media Library', 'technum'),
                        'type'              => 'video',
                        'max_file_uploads'  => 1,
                        'max_status'        => false,
                        'attributes'        => array(
                            'data-dependency-id'    => 'post_media_video_type',
                            'data-dependency-val'   => 'self'
                        )
                    ),
                ),
            );

            # Content Output Settings
            $meta_boxes[] = array(
                'title'         => esc_html__('Single Post Settings', 'technum'),
                'post_types'    => array('post'),
                'context'       => 'advanced',
                'fields'        => array(

                    //-- Single Post Settings
                    array(
                        'type'  => 'heading',
                        'name'  => esc_html__('Post Output Settings', 'technum'),
                    ),

                    array(
                        'id'        => 'post_media_image_status',
                        'name'      => esc_html__('Show Media Block', 'technum'),
                        'type'      => 'select',
                        'std'       => 'default',
                        'options'   => array(
                            'default'   => esc_html__('Default', 'technum'),
                            'on'        => esc_html__('Yes', 'technum'),
                            'off'       => esc_html__('No', 'technum')
                        )
                    ),

                    array(
                        'id'        => 'post_category_status',
                        'name'      => esc_html__('Show Post Categories', 'technum'),
                        'type'      => 'select',
                        'std'       => 'default',
                        'options'   => array(
                            'default'   => esc_html__('Default', 'technum'),
                            'on'        => esc_html__('Yes', 'technum'),
                            'off'       => esc_html__('No', 'technum')
                        )
                    ),

                    array(
                        'id'        => 'post_date_status',
                        'name'      => esc_html__('Show Post Date', 'technum'),
                        'type'      => 'select',
                        'std'       => 'default',
                        'options'   => array(
                            'default'   => esc_html__('Default', 'technum'),
                            'on'        => esc_html__('Yes', 'technum'),
                            'off'       => esc_html__('No', 'technum')
                        )
                    ),

                    array(
                        'id'        => 'post_author_status',
                        'name'      => esc_html__('Show Post Author', 'technum'),
                        'type'      => 'select',
                        'std'       => 'default',
                        'options'   => array(
                            'default'   => esc_html__('Default', 'technum'),
                            'on'        => esc_html__('Yes', 'technum'),
                            'off'       => esc_html__('No', 'technum')
                        )
                    ),

                    array(
                        'id'        => 'post_comment_counter_status',
                        'name'      => esc_html__('Show Number of Post Comments', 'technum'),
                        'type'      => 'select',
                        'std'       => 'default',
                        'options'   => array(
                            'default'   => esc_html__('Default', 'technum'),
                            'on'        => esc_html__('Yes', 'technum'),
                            'off'       => esc_html__('No', 'technum')
                        )
                    ),

                    array(
                        'id'        => 'post_title_status',
                        'name'      => esc_html__('Show Post Title', 'technum'),
                        'type'      => 'select',
                        'std'       => 'default',
                        'options'   => array(
                            'default'   => esc_html__('Default', 'technum'),
                            'on'        => esc_html__('Yes', 'technum'),
                            'off'       => esc_html__('No', 'technum')
                        )
                    ),

                    array(
                        'id'        => 'post_tags_status',
                        'name'      => esc_html__('Show Post Tags', 'technum'),
                        'type'      => 'select',
                        'std'       => 'default',
                        'options'   => array(
                            'default'   => esc_html__('Default', 'technum'),
                            'on'        => esc_html__('Yes', 'technum'),
                            'off'       => esc_html__('No', 'technum')
                        )
                    ),

                    array(
                        'id'        => 'post_socials_status',
                        'name'      => esc_html__('Show Post Social Buttons', 'technum'),
                        'type'      => 'select',
                        'std'       => 'default',
                        'options'   => array(
                            'default'   => esc_html__('Default', 'technum'),
                            'on'        => esc_html__('Yes', 'technum'),
                            'off'       => esc_html__('No', 'technum')
                        )
                    ),

                    array(
                        'type' => 'divider',
                    ),

                    //-- Sticky Header
                    array(
                        'type'  => 'heading',
                        'name'  => esc_html__('Recent Posts', 'technum'),
                    ),

                    array(
                        'id'        => 'recent_posts_status',
                        'name'      => esc_html__('Show Recent Posts', 'technum'),
                        'type'      => 'select',
                        'std'       => 'default',
                        'options'   => array(
                            'default'   => esc_html__('Default', 'technum'),
                            'on'        => esc_html__('Yes', 'technum'),
                            'off'       => esc_html__('No', 'technum')
                        )
                    ),

                    array(
                        'id'        => 'recent_posts_customize',
                        'name'      => esc_html__('Customize', 'technum'),
                        'type'      => 'select',
                        'std'       => 'default',
                        'options'   => array(
                            'default'   => esc_html__('Default', 'technum'),
                            'off'       => esc_html__('No', 'technum'),
                            'on'        => esc_html__('Yes', 'technum')
                        )
                    ),

                    array(
                        'id'            => 'recent_posts_section_heading',
                        'name'          => esc_html__('Recent Posts Section Title', 'technum'),
                        'type'          => 'text',
                        'std'           => '',
                        'placeholder'   => technum_get_theme_mod('recent_posts_section_heading')
                    ),

                    array(
                        'id'            => 'recent_posts_number',
                        'name'          => esc_html__('Number of Posts', 'technum'),
                        'type'          => 'select',
                        'options'       => array(
                            'default'       => esc_html__('Default', 'technum'),
                            '2'             => esc_html__('2 Items', 'technum'),
                            '3'             => esc_html__('3 Items', 'technum'),
                            '4'             => esc_html__('4 Items', 'technum')
                        ),
                        'attributes'    => array(
                            'data-dependency-id'    => 'recent_posts_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'recent_posts_order_by',
                        'name'          => esc_html__('Order By', 'technum'),
                        'type'          => 'select',
                        'options'       => array(
                            'default'       => esc_html__('Default', 'technum'),
                            'random'        => esc_html__('Random', 'technum'),
                            'date'          => esc_html__('Date', 'technum'),
                            'name'          => esc_html__('Name', 'technum')
                        ),
                        'attributes'    => array(
                            'data-dependency-id'    => 'recent_posts_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'recent_posts_order',
                        'name'          => esc_html__('Sort Order', 'technum'),
                        'type'          => 'select',
                        'options'       => array(
                            'default'       => esc_html__('Default', 'technum'),
                            'desc'          => esc_html__('Descending', 'technum'),
                            'asc'           => esc_html__('Ascending', 'technum')
                        ),
                        'attributes'    => array(
                            'data-dependency-id'    => 'recent_posts_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'recent_posts_image',
                        'name'          => esc_html__('Show Recent Post Image', 'technum'),
                        'type'          => 'select',
                        'std'           => 'default',
                        'options'       => array(
                            'default'       => esc_html__('Default', 'technum'),
                            'on'            => esc_html__('Yes', 'technum'),
                            'off'           => esc_html__('No', 'technum')
                        ),
                        'attributes'    => array(
                            'data-dependency-id'    => 'recent_posts_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'recent_posts_category',
                        'name'          => esc_html__('Show Recent Post Categories', 'technum'),
                        'type'          => 'select',
                        'std'           => 'default',
                        'options'       => array(
                            'default'       => esc_html__('Default', 'technum'),
                            'on'            => esc_html__('Yes', 'technum'),
                            'off'           => esc_html__('No', 'technum')
                        ),
                        'attributes'    => array(
                            'data-dependency-id'    => 'recent_posts_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'recent_posts_date',
                        'name'          => esc_html__('Show Recent Post Date', 'technum'),
                        'type'          => 'select',
                        'std'           => 'default',
                        'options'       => array(
                            'default'       => esc_html__('Default', 'technum'),
                            'on'            => esc_html__('Yes', 'technum'),
                            'off'           => esc_html__('No', 'technum')
                        ),
                        'attributes'    => array(
                            'data-dependency-id'    => 'recent_posts_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'recent_posts_author',
                        'name'          => esc_html__('Show Recent Post Author', 'technum'),
                        'type'          => 'select',
                        'std'           => 'default',
                        'options'       => array(
                            'default'       => esc_html__('Default', 'technum'),
                            'on'            => esc_html__('Yes', 'technum'),
                            'off'           => esc_html__('No', 'technum')
                        ),
                        'attributes'    => array(
                            'data-dependency-id'    => 'recent_posts_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'recent_posts_comment_counter',
                        'name'          => esc_html__('Show Recent Post Number of Comments', 'technum'),
                        'type'          => 'select',
                        'std'           => 'default',
                        'options'       => array(
                            'default'       => esc_html__('Default', 'technum'),
                            'on'            => esc_html__('Yes', 'technum'),
                            'off'           => esc_html__('No', 'technum')
                        ),
                        'attributes'    => array(
                            'data-dependency-id'    => 'recent_posts_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'recent_posts_title',
                        'name'          => esc_html__('Show Recent Post Title', 'technum'),
                        'type'          => 'select',
                        'std'           => 'default',
                        'options'       => array(
                            'default'       => esc_html__('Default', 'technum'),
                            'on'            => esc_html__('Yes', 'technum'),
                            'off'           => esc_html__('No', 'technum')
                        ),
                        'attributes'    => array(
                            'data-dependency-id'    => 'recent_posts_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'recent_posts_excerpt',
                        'name'          => esc_html__('Show Recent Post Excerpt', 'technum'),
                        'type'          => 'select',
                        'std'           => 'default',
                        'options'       => array(
                            'default'       => esc_html__('Default', 'technum'),
                            'on'            => esc_html__('Yes', 'technum'),
                            'off'           => esc_html__('No', 'technum')
                        ),
                        'attributes'    => array(
                            'data-dependency-id'    => 'recent_posts_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'recent_posts_excerpt_length',
                        'name'          => esc_html__('Page Title Height', 'technum'),
                        'type'          => 'number',
                        'placeholder'   => technum_get_theme_mod('recent_posts_excerpt_length'),
                        'std'           => '',
                        'attributes'    => array(
                            'data-dependency-id'    => 'recent_posts_customize',
                            'data-dependency-val'   => 'custom'
                        )
                    ),

                    array(
                        'id'            => 'recent_posts_tags',
                        'name'          => esc_html__('Show Recent Post Tags', 'technum'),
                        'type'          => 'select',
                        'std'           => 'default',
                        'options'       => array(
                            'default'       => esc_html__('Default', 'technum'),
                            'on'            => esc_html__('Yes', 'technum'),
                            'off'           => esc_html__('No', 'technum')
                        ),
                        'attributes'    => array(
                            'data-dependency-id'    => 'recent_posts_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'recent_posts_more',
                        'name'          => esc_html__('Show Recent Post \'Read More\' Button', 'technum'),
                        'type'          => 'select',
                        'std'           => 'default',
                        'options'       => array(
                            'default'       => esc_html__('Default', 'technum'),
                            'on'            => esc_html__('Yes', 'technum'),
                            'off'           => esc_html__('No', 'technum')
                        ),
                        'attributes'    => array(
                            'data-dependency-id'    => 'recent_posts_customize',
                            'data-dependency-val'   => 'on'
                        )
                    )
                )
            );

            # Portfolio Custom Fields
            $meta_boxes[] = array(
                'title'         => esc_html__('Portfolio Fields', 'technum'),
                'post_types'    => array('technum_portfolio'),
                'context'       => 'side',
                'fields'        => array(
                    array(
                        'id'    => 'portfolio_author',
                        'name'  => esc_html__('Portfolio Author', 'technum'),
                        'type'  => 'text'
                    ),
                    array(
                        'id'    => 'portfolio_client',
                        'name'  => esc_html__('Client', 'technum'),
                        'type'  => 'text'
                    ),
                    array(
                        'id'    => 'portfolio_gallery',
                        'name'  => esc_html__('Portfolio Gallery', 'technum'),
                        'type'  => 'image_advanced'
                    )
                )
            );

            # Projects Custom Fields
            $meta_boxes[] = array(
                'title'         => esc_html__('Project Fields', 'technum'),
                'post_types'    => array('technum_project'),
                'context'       => 'advanced',
                'fields'        => array(
                    array(
                        'id'            => 'project_strategy',
                        'name'          => esc_html__('Strategy', 'technum'),
                        'type'          => 'text',
                        'add_button'    => esc_html__('+ Add More', 'technum'),
                        'clone'         => true
                    ),
                    array(
                        'id'            => 'project_design',
                        'name'          => esc_html__('Design', 'technum'),
                        'type'          => 'text',
                        'add_button'    => esc_html__('+ Add More', 'technum'),
                        'clone'         => true
                    ),
                    array(
                        'id'            => 'project_client',
                        'name'          => esc_html__('Client', 'technum'),
                        'type'          => 'text'
                    ),
                    array(
                        'id'            => 'project_button',
                        'name'          => esc_html__('Link Button', 'technum'),
                        'type'          => 'text_list',
                        'options'       => array(
                            esc_attr__('Link', 'technum')   => esc_html__('Link', 'technum'),
                            esc_attr__('Label', 'technum')  => esc_html__('Label', 'technum')
                        ),
                        'clone'         => false
                    ),
                    array(
                        'type' => 'divider',
                    ),
                    array(
                        'id'            => 'project_gallery',
                        'name'          => esc_html__('Project Gallery', 'technum'),
                        'type'          => 'image_advanced'
                    )
                )
            );

            # Team Member Custom Fields
            $meta_boxes[] = array(
                'title'         => esc_html__('Team Member Fields', 'technum'),
                'post_types'    => array('technum_team_member'),
                'context'       => 'advanced',
                'fields'        => array(
                    array(
                        'id'            => 'team_member_position',
                        'name'          => esc_html__('Position', 'technum'),
                        'type'          => 'text'
                    ),
                    array(
                        'type' => 'divider',
                    ),
                    array(
                        'id'            => 'team_member_short_text',
                        'name'          => esc_html__('Member Short Info', 'technum'),
                        'type'          => 'wysiwyg',
                        'options'       => array(
                            'textarea_rows' => 6,
                            'teeny'         => true
                        ),
                    ),
                    array(
                        'type' => 'divider',
                    ),
                    array(
                        'id'            => 'team_member_socials',
                        'name'          => esc_html__('Social Links', 'technum'),
                        'type'          => 'key_value',
                        'placeholder'   => array(
                            'key'           => esc_attr__('Icon', 'technum'),
                            'value'         => esc_attr__('Link', 'technum')
                        ),
                        'add_button'    => esc_html__('+ Add More', 'technum'),
                        'class'         => 'icon-picker',
                        'clone'         => true,
                        'sort_clone'    => true,
                        'max_clone'     => 7
                    ),
                    array(
                        'type' => 'divider',
                    ),
                    array(
                        'id'            => 'team_member_biography_title',
                        'name'          => esc_html__('Biography Title', 'technum'),
                        'type'          => 'text'
                    ),
                    array(
                        'id'            => 'team_member_biography_text',
                        'name'          => esc_html__('Biography Text', 'technum'),
                        'type'          => 'wysiwyg',
                        'options'       => array(
                            'textarea_rows' => 6,
                            'teeny'         => true
                        ),
                    ),
                    array(
                        'type' => 'divider',
                    ),
                    array(
                        'id'            => 'team_member_personal_info_title',
                        'name'          => esc_html__('Personal Info Title', 'technum'),
                        'type'          => 'text',
                        'std'           => esc_html__('Personal Info', 'technum')
                    ),
                    array(
                        'id'            => 'team_member_personal_info_item',
                        'name'          => esc_html__('Personal Info Item', 'technum'),
                        'type'          => 'text',
                        'clone'         => true,
                        'add_button'    => esc_html__('+ Add More', 'technum')
                    ),
                    array(
                        'id'            => 'team_member_email',
                        'name'          => esc_html__('Personal Info E-mail', 'technum'),
                        'type'          => 'text'
                    ),
                    array(
                        'type' => 'divider',
                    ),
                    array(
                        'id'            => 'team_member_skills_title',
                        'name'          => esc_html__('Skills List Title', 'technum'),
                        'type'          => 'text',
                        'std'           => esc_html__('Main Skills', 'technum')
                    ),
                    array(
                        'id'            => 'team_member_skills_list',
                        'name'          => esc_html__('Personal Skills', 'technum'),
                        'type'          => 'text',
                        'clone'         => true,
                        'add_button'    => esc_html__('+ Add More', 'technum')
                    ),
                    array(
                        'type' => 'divider',
                    ),
                    array(
                        'id'            => 'team_member_values_title',
                        'name'          => esc_html__('Values List Title', 'technum'),
                        'type'          => 'text',
                        'std'           => esc_html__('Values', 'technum')
                    ),
                    array(
                        'id'            => 'team_member_values_list',
                        'name'          => esc_html__('Values', 'technum'),
                        'type'          => 'text',
                        'clone'         => true,
                        'add_button'    => esc_html__('+ Add More', 'technum')
                    ),
                    array(
                        'type' => 'divider',
                    ),
                    array(
                        'id'            => 'team_member_experience_title',
                        'name'          => esc_html__('Experience & Education Section Title', 'technum'),
                        'type'          => 'text',
                        'std'           => wp_kses_post(__('My experience<br> & years of education', 'technum'))
                    ),
                    array(
                        'id'            => 'team_member_education_list',
                        'name'          => esc_html__('Education List', 'technum'),
                        'type'          => 'text_list',
                        'clone'         => true,
                        'options'       => array(
                            esc_attr__('Title', 'technum')          => esc_html__('Title', 'technum'),
                            esc_attr__('Period', 'technum')         => esc_html__('Period', 'technum'),
                            esc_attr__('Description', 'technum')    => esc_html__('Description', 'technum'),
                        ),
                        'add_button'    => esc_html__('+ Add More', 'technum')
                    ),
                    array(
                        'id'            => 'team_member_experience_list',
                        'name'          => esc_html__('Experience List', 'technum'),
                        'type'          => 'text_list',
                        'clone'         => true,
                        'options'       => array(
                            esc_attr__('Title', 'technum')          => esc_html__('Title', 'technum'),
                            esc_attr__('Period', 'technum')         => esc_html__('Period', 'technum'),
                            esc_attr__('Description', 'technum')    => esc_html__('Description', 'technum'),
                        ),
                        'add_button'    => esc_html__('+ Add More', 'technum')
                    ),
                )
            );

            # Vacancy Custom Fields
            $meta_boxes[] = array(
                'title'         => esc_html__('Vacancy Fields', 'technum'),
                'post_types'    => array('technum_vacancy'),
                'context'       => 'advanced',
                'fields'        => array(
                    array(
                        'id'        => 'vacancy_occupation',
                        'name'      => esc_html__('Occupation', 'technum'),
                        'type'      => 'text',
                        'desc'      => esc_html__('Full-time, part-time, contract, etc.', 'technum')
                    ),
                    array(
                        'id'        => 'vacancy_location',
                        'name'      => esc_html__('Location', 'technum'),
                        'type'      => 'text',
                    ),
                    array(
                        'id'        => 'vacancy_salary',
                        'name'      => esc_html__('Salary', 'technum'),
                        'type'      => 'text',
                    ),
                    array(
                        'id'        => 'vacancy_responsibilities',
                        'name'      => esc_html__('Responsibilities', 'technum'),
                        'type'      => 'wysiwyg',
                        'raw'       => false,
                        'options'   => array(
                            'textarea_rows' => 8,
                            'teeny'         => true,
                        ),
                    ),
                    array(
                        'id'        => 'vacancy_qualifications',
                        'name'      => esc_html__('Preferred Qualifications', 'technum'),
                        'type'      => 'wysiwyg',
                        'raw'       => false,
                        'options'   => array(
                            'textarea_rows' => 8,
                            'teeny'         => true,
                        ),
                    ),
                    array(
                        'id'            => 'vacancy_button',
                        'name'          => esc_html__('Contact Button', 'technum'),
                        'type'          => 'text_list',
                        'options'       => array(
                            esc_attr__('Link', 'technum')   => esc_html__('Link', 'technum'),
                            esc_attr__('Label', 'technum')  => esc_html__('Label', 'technum')
                        ),
                        'clone'         => false
                    ),

                    array(
                        'type'  => 'heading',
                        'name'  => esc_html__('Recent Vacancies', 'technum'),
                    ),

                    array(
                        'id'        => 'recent_vacancies_status',
                        'name'      => esc_html__('Show Recent Vacancies', 'technum'),
                        'type'      => 'select',
                        'std'       => 'default',
                        'options'   => array(
                            'default'   => esc_html__('Default', 'technum'),
                            'on'        => esc_html__('Yes', 'technum'),
                            'off'       => esc_html__('No', 'technum')
                        )
                    ),

                    array(
                        'id'        => 'recent_vacancies_customize',
                        'name'      => esc_html__('Customize', 'technum'),
                        'type'      => 'select',
                        'std'       => 'default',
                        'options'   => array(
                            'default'   => esc_html__('Default', 'technum'),
                            'off'       => esc_html__('No', 'technum'),
                            'on'        => esc_html__('Yes', 'technum')
                        )
                    ),

                    array(
                        'id'            => 'recent_vacancies_section_heading',
                        'name'          => esc_html__('Recent Vacancies Section Title', 'technum'),
                        'type'          => 'textarea',
                        'std'           => '',
                        'placeholder'   => technum_get_theme_mod('recent_vacancies_section_heading')
                    ),

                    array(
                        'id'            => 'recent_vacancies_number',
                        'name'          => esc_html__('Number of Posts', 'technum'),
                        'type'          => 'number',
                        'min'           => 1,
                        'max'           => 20,
                        'step'          => 1,
                        'std'           => '',
                        'attributes'    => array(
                            'data-dependency-id'    => 'recent_posts_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'recent_vacancies_order_by',
                        'name'          => esc_html__('Order By', 'technum'),
                        'type'          => 'select',
                        'options'       => array(
                            'default'       => esc_html__('Default', 'technum'),
                            'random'        => esc_html__('Random', 'technum'),
                            'date'          => esc_html__('Date', 'technum'),
                            'name'          => esc_html__('Name', 'technum')
                        ),
                        'attributes'    => array(
                            'data-dependency-id'    => 'recent_vacancies_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'recent_vacancies_order',
                        'name'          => esc_html__('Sort Order', 'technum'),
                        'type'          => 'select',
                        'options'       => array(
                            'default'       => esc_html__('Default', 'technum'),
                            'desc'          => esc_html__('Descending', 'technum'),
                            'asc'           => esc_html__('Ascending', 'technum')
                        ),
                        'attributes'    => array(
                            'data-dependency-id'    => 'recent_vacancies_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                )
            );

            # Service Post Icon Settings
            $meta_boxes[] = array(
                'title'         => esc_html__('Service Icon', 'technum'),
                'post_types'    => array('technum_service'),
                'context'       => 'advanced',
                'fields'        => array(
                    array(
                        'id'            => 'service_main_icon',
                        'type'          => 'iconpicker',
                        'name'          => esc_html__('Service Icon', 'technum'),
                    ),
                    array(
                        'id'            => 'service_main_icon_color',
                        'name'          => esc_html__('Icon Color', 'technum'),
                        'type'          => 'color',
                        'std'           => '',
                        'alpha_channel' => true
                    ),
                )
            );
            # Service Custom Fields
            $meta_boxes[] = array(
                'title'         => esc_html__('Service Fields', 'technum'),
                'post_types'    => array('technum_service'),
                'context'       => 'after_title',
                'fields'        => array(
                    array(
                        'type'  => 'heading',
                        'name'  => esc_html__('Short Description', 'technum'),
                    ),
                    array(
                        'id'        => 'service_description',
                        'type'      => 'wysiwyg',
                        'raw'       => true,
                        'options'   => array(
                            'textarea_rows' => 12,
                            'teeny'         => false,
                        ),
                    ),

                    array(
                        'type' => 'divider',
                    ),

                    array(
                        'id'            => 'service_benefits_title',
                        'name'          => esc_html__('Benefits Section Title', 'technum'),
                        'type'          => 'text',
                        'std'           => esc_html__('Benefits', 'technum')
                    ),
                    array(
                        'id'            => 'service_benefit_items',
                        'name'          => esc_html__('Benefits', 'technum'),
                        'type'          => 'benefits',
                        'add_button'    => esc_html__('+ Add More', 'technum'),
                        'clone'         => true,
                        'sort_clone'    => true,
                        'alpha_channel' => true,
                        'field_title'   => true,
                        'field_color'   => true
                    ),

                    array(
                        'type' => 'divider',
                    ),

                    array(
                        'id'            => 'service_help_title',
                        'name'          => esc_html__('Help Section Title', 'technum'),
                        'type'          => 'text',
                        'std'           => esc_html__('We’re Here to Help You', 'technum'),
                    ),
                    array(
                        'id'            => 'service_help_items',
                        'name'          => esc_html__('Help Items', 'technum'),
                        'type'          => 'help',
                        'clone'         => true,
                        'add_button'    => esc_html__('+ Add More', 'technum')
                    ),

                )
            );

            # Case Study Custom Fields
            $meta_boxes[] = array(
                'title'         => esc_html__('Case Study Fields', 'technum'),
                'post_types'    => array('technum_case_study'),
                'context'       => 'advanced',
                'fields'        => array(
                    array(
                        'id'        => 'case_study_result',
                        'name'      => esc_html__('Results', 'technum'),
                        'type'      => 'wysiwyg',
                        'raw'       => false,
                        'options'   => array(
                            'textarea_rows' => 8,
                            'teeny'         => true,
                        ),
                    ),

                    array(
                        'id'        => 'case_study_boxes',
                        'name'      => 'Result Boxes',
                        'type'      => 'text_list',
                        'clone'     => true,
                        'options'   => array(
                            'Value'     => 'Value',
                            'Title'     => 'Title'
                        ),
                    ),
                )
            );

            # Post and Page Settings
            $meta_boxes[] = array(
                'title'         => esc_html__('Color Settings', 'technum'),
                'post_types'    => array('post', 'page', 'technum_portfolio', 'technum_team_member', 'technum_vacancy', 'technum_service', 'technum_case_study', 'product'),
                'closed'        => true,
                'context'       => 'advanced',
                'fields'        => array(

                    # Color Options

                    //-- Standard colors
                    array(
                        'type'  => 'heading',
                        'name'  => esc_html__('Standard Colors', 'technum'),
                    ),

                    array(
                        'id'            => 'standard_default_text_color',
                        'name'          => esc_html__('Default Text Color', 'technum'),
                        'type'          => 'color',
                        'std'           => '',
                        'alpha_channel' => false
                    ),

                    array(
                        'id'            => 'standard_dark_text_color',
                        'name'          => esc_html__('Dark Text Color', 'technum'),
                        'type'          => 'color',
                        'std'           => '',
                        'alpha_channel' => false
                    ),

                    array(
                        'id'            => 'standard_light_text_color',
                        'name'          => esc_html__('Light Text Color', 'technum'),
                        'type'          => 'color',
                        'std'           => '',
                        'alpha_channel' => false
                    ),

                    array(
                        'id'            => 'standard_accent_text_color',
                        'name'          => esc_html__('Accent Text Color', 'technum'),
                        'type'          => 'color',
                        'std'           => '',
                        'alpha_channel' => false
                    ),

                    array(
                        'type' => 'divider',
                    ),

                    array(
                        'id'            => 'standard_border_color',
                        'name'          => esc_html__('Border Color', 'technum'),
                        'type'          => 'color',
                        'std'           => '',
                        'alpha_channel' => false
                    ),

                    array(
                        'id'            => 'standard_border_hover_color',
                        'name'          => esc_html__('Hovered Border Color', 'technum'),
                        'type'          => 'color',
                        'std'           => '',
                        'alpha_channel' => false
                    ),

                    array(
                        'type' => 'divider',
                    ),

                    array(
                        'id'            => 'standard_background_color',
                        'name'          => esc_html__('Background Color', 'technum'),
                        'type'          => 'color',
                        'std'           => '',
                        'alpha_channel' => false
                    ),

                    array(
                        'id'            => 'standard_background_alter_color',
                        'name'          => esc_html__('Alternative Background Color', 'technum'),
                        'type'          => 'color',
                        'std'           => '',
                        'alpha_channel' => false
                    ),

                    array(
                        'type' => 'divider',
                    ),

                    array(
                        'id'            => 'standard_button_text_color',
                        'name'          => esc_html__('Button Text Color', 'technum'),
                        'type'          => 'color',
                        'std'           => '',
                        'alpha_channel' => false
                    ),

                    array(
                        'id'            => 'standard_button_border_color',
                        'name'          => esc_html__('Button Border Color', 'technum'),
                        'type'          => 'color',
                        'std'           => '',
                        'alpha_channel' => false
                    ),

                    array(
                        'id'            => 'standard_button_background_color',
                        'name'          => esc_html__('Button Background Color', 'technum'),
                        'type'          => 'color',
                        'std'           => '',
                        'alpha_channel' => false
                    ),

                    array(
                        'id'            => 'standard_button_text_hover',
                        'name'          => esc_html__('Button Text Hover', 'technum'),
                        'type'          => 'color',
                        'std'           => '',
                        'alpha_channel' => false
                    ),

                    array(
                        'id'            => 'standard_button_border_hover',
                        'name'          => esc_html__('Button Border Hover', 'technum'),
                        'type'          => 'color',
                        'std'           => '',
                        'alpha_channel' => false
                    ),

                    array(
                        'id'            => 'standard_button_background_hover',
                        'name'          => esc_html__('Button Background Hover', 'technum'),
                        'type'          => 'color',
                        'std'           => '',
                        'alpha_channel' => false
                    ),

                    array(
                        'type' => 'divider',
                    ),

                    //-- Contrast Colors
                    array(
                        'type'  => 'heading',
                        'name'  => esc_html__('Contrast Colors', 'technum'),
                    ),

                    array(
                        'id'            => 'contrast_default_text_color',
                        'name'          => esc_html__('Default Text Color', 'technum'),
                        'type'          => 'color',
                        'std'           => '',
                        'alpha_channel' => false
                    ),

                    array(
                        'id'            => 'contrast_dark_text_color',
                        'name'          => esc_html__('Dark Text Color', 'technum'),
                        'type'          => 'color',
                        'std'           => '',
                        'alpha_channel' => false
                    ),

                    array(
                        'id'            => 'contrast_light_text_color',
                        'name'          => esc_html__('Light Text Color', 'technum'),
                        'type'          => 'color',
                        'std'           => '',
                        'alpha_channel' => false
                    ),

                    array(
                        'id'            => 'contrast_accent_text_color',
                        'name'          => esc_html__('Accent Text Color', 'technum'),
                        'type'          => 'color',
                        'std'           => '',
                        'alpha_channel' => false
                    ),

                    array(
                        'type' => 'divider',
                    ),

                    array(
                        'id'            => 'contrast_border_color',
                        'name'          => esc_html__('Border Color', 'technum'),
                        'type'          => 'color',
                        'std'           => '',
                        'alpha_channel' => false
                    ),

                    array(
                        'id'            => 'contrast_border_hover_color',
                        'name'          => esc_html__('Hovered Border Color', 'technum'),
                        'type'          => 'color',
                        'std'           => '',
                        'alpha_channel' => false
                    ),

                    array(
                        'type' => 'divider',
                    ),

                    array(
                        'id'            => 'contrast_background_color',
                        'name'          => esc_html__('Background Color', 'technum'),
                        'type'          => 'color',
                        'std'           => '',
                        'alpha_channel' => false
                    ),

                    array(
                        'id'            => 'contrast_background_alter_color',
                        'name'          => esc_html__('Alternative Background Color', 'technum'),
                        'type'          => 'color',
                        'std'           => '',
                        'alpha_channel' => false
                    ),

                    array(
                        'type' => 'divider',
                    ),

                    array(
                        'id'            => 'contrast_button_text_color',
                        'name'          => esc_html__('Button Text Color', 'technum'),
                        'type'          => 'color',
                        'std'           => '',
                        'alpha_channel' => false
                    ),

                    array(
                        'id'            => 'contrast_button_border_color',
                        'name'          => esc_html__('Button Border Color', 'technum'),
                        'type'          => 'color',
                        'std'           => '',
                        'alpha_channel' => false
                    ),

                    array(
                        'id'            => 'contrast_button_background_color',
                        'name'          => esc_html__('Button Background Color', 'technum'),
                        'type'          => 'color',
                        'std'           => '',
                        'alpha_channel' => false
                    ),

                    array(
                        'id'            => 'contrast_button_text_hover',
                        'name'          => esc_html__('Button Text Hover', 'technum'),
                        'type'          => 'color',
                        'std'           => '',
                        'alpha_channel' => false
                    ),

                    array(
                        'id'            => 'contrast_button_border_hover',
                        'name'          => esc_html__('Button Border Hover', 'technum'),
                        'type'          => 'color',
                        'std'           => '',
                        'alpha_channel' => false
                    ),

                    array(
                        'id'            => 'contrast_button_background_hover',
                        'name'          => esc_html__('Button Background Hover', 'technum'),
                        'type'          => 'color',
                        'std'           => '',
                        'alpha_channel' => false
                    ),
                )
            );

            $meta_boxes[] = array(
                'title'         => esc_html__('Top Bar Settings', 'technum'),
                'post_types'    => array('post', 'page', 'technum_portfolio', 'technum_team_member', 'technum_vacancy', 'technum_service', 'technum_case_study', 'product'),
                'closed'        => true,
                'context'       => 'advanced',
                'fields'        => array(

                # Top Bar Options

                    //-- Top Bar General
                    array(
                        'type'  => 'heading',
                        'name'  => esc_html__('General', 'technum'),
                    ),

                    array(
                        'id'        => 'top_bar_status',
                        'name'      => esc_html__('Show Top Bar', 'technum'),
                        'type'      => 'select',
                        'std'       => 'default',
                        'options'   => array(
                            'default'   => esc_html__('Default', 'technum'),
                            'on'        => esc_html__('Yes', 'technum'),
                            'off'       => esc_html__('No', 'technum')
                        )
                    ),

                    array(
                        'id'        => 'top_bar_customize',
                        'name'      => esc_html__('Customize', 'technum'),
                        'type'      => 'select',
                        'std'       => 'default',
                        'options'   => array(
                            'default'   => esc_html__('Default', 'technum'),
                            'off'       => esc_html__('No', 'technum'),
                            'on'        => esc_html__('Yes', 'technum')
                        )
                    ),

                    array(
                        'id'            => 'top_bar_default_text_color',
                        'name'          => esc_html__('Default Text Color', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'class'         => 'divider-before',
                        'attributes'    => array(
                            'data-dependency-id'    => 'top_bar_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'top_bar_dark_text_color',
                        'name'          => esc_html__('Dark Text Color', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'attributes'    => array(
                            'data-dependency-id'    => 'top_bar_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'top_bar_light_text_color',
                        'name'          => esc_html__('Light Text Color', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'attributes'    => array(
                            'data-dependency-id'    => 'top_bar_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'top_bar_accent_text_color',
                        'name'          => esc_html__('Accent Text Color', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'attributes'    => array(
                            'data-dependency-id'    => 'top_bar_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'top_bar_border_color',
                        'name'          => esc_html__('Border Color', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'class'         => 'divider-before',
                        'attributes'    => array(
                            'data-dependency-id'    => 'top_bar_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'top_bar_border_hover_color',
                        'name'          => esc_html__('Hovered Border Color', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'attributes'    => array(
                            'data-dependency-id'    => 'top_bar_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'top_bar_background_color',
                        'name'          => esc_html__('Background Color', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'class'         => 'divider-before',
                        'attributes'    => array(
                            'data-dependency-id'    => 'top_bar_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'top_bar_background_alter_color',
                        'name'          => esc_html__('Alternative Background Color', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'attributes'    => array(
                            'data-dependency-id'    => 'top_bar_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'top_bar_button_text_color',
                        'name'          => esc_html__('Button Text Color', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'class'         => 'divider-before',
                        'attributes'    => array(
                            'data-dependency-id'    => 'top_bar_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'top_bar_button_border_color',
                        'name'          => esc_html__('Button Border Color', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'attributes'    => array(
                            'data-dependency-id'    => 'top_bar_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'top_bar_button_background_color',
                        'name'          => esc_html__('Button Background Color', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'attributes'    => array(
                            'data-dependency-id'    => 'top_bar_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'top_bar_button_text_hover',
                        'name'          => esc_html__('Button Text Hover', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'attributes'    => array(
                            'data-dependency-id'    => 'top_bar_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'top_bar_button_border_hover',
                        'name'          => esc_html__('Button Border Hover', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'attributes'    => array(
                            'data-dependency-id'    => 'top_bar_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'top_bar_button_background_hover',
                        'name'          => esc_html__('Button Background Hover', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'attributes'    => array(
                            'data-dependency-id'    => 'top_bar_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'type' => 'divider',
                    ),

                    //-- Top Bar Social Buttons
                    array(
                        'type'  => 'heading',
                        'name'  => esc_html__('Social Buttons', 'technum'),
                    ),

                    array(
                        'id'        => 'top_bar_socials_status',
                        'name'      => esc_html__('Show Social Buttons', 'technum'),
                        'type'      => 'select',
                        'std'       => 'default',
                        'options'   => array(
                            'default'   => esc_html__('Default', 'technum'),
                            'on'        => esc_html__('Yes', 'technum'),
                            'off'       => esc_html__('No', 'technum')
                        )
                    ),

                    array(
                        'type' => 'divider',
                    ),

                    //-- Top Bar Additional Text
                    array(
                        'type'  => 'heading',
                        'name'  => esc_html__('Additional Text', 'technum'),
                    ),

                    array(
                        'id'        => 'top_bar_additional_text_status',
                        'name'      => esc_html__('Show Additional Text', 'technum'),
                        'type'      => 'select',
                        'std'       => 'default',
                        'options'   => array(
                            'default'   => esc_html__('Default', 'technum'),
                            'on'        => esc_html__('Yes', 'technum'),
                            'off'       => esc_html__('No', 'technum')
                        )
                    ),

                    array(
                        'id'            => 'top_bar_additional_text_title',
                        'name'          => esc_html__('Additional Text Title', 'technum'),
                        'type'          => 'textarea',
                        'placeholder'   => technum_get_theme_mod('top_bar_additional_text_title'),
                        'std'           => '',
                        'attributes'    => array(
                            'data-dependency-id'    => 'top_bar_additional_text_status',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'top_bar_additional_text',
                        'name'          => esc_html__('Additional Text', 'technum'),
                        'type'          => 'textarea',
                        'placeholder'   => technum_get_theme_mod('top_bar_additional_text'),
                        'std'           => '',
                        'attributes'    => array(
                            'data-dependency-id'    => 'top_bar_additional_text_status',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'type' => 'divider',
                    ),

                    //-- Top Bar Contacts
                    array(
                        'type'  => 'heading',
                        'name'  => esc_html__('Contacts', 'technum'),
                    ),

                    array(
                        'id'        => 'top_bar_contacts_email_status',
                        'name'      => esc_html__('Show Email Address', 'technum'),
                        'type'      => 'select',
                        'std'       => 'default',
                        'options'   => array(
                            'default'   => esc_html__('Default', 'technum'),
                            'on'        => esc_html__('Yes', 'technum'),
                            'off'       => esc_html__('No', 'technum')
                        )
                    ),

                    array(
                        'id'            => 'top_bar_contacts_email',
                        'name'          => esc_html__('Email Address', 'technum'),
                        'type'          => 'text',
                        'placeholder'   => technum_get_theme_mod('top_bar_contacts_email'),
                        'std'           => '',
                        'attributes'    => array(
                            'data-dependency-id'    => 'top_bar_contacts_email_status',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'        => 'top_bar_contacts_phone_status',
                        'name'      => esc_html__('Show Phone Number', 'technum'),
                        'type'      => 'select',
                        'std'       => 'default',
                        'options'   => array(
                            'default'   => esc_html__('Default', 'technum'),
                            'on'        => esc_html__('Yes', 'technum'),
                            'off'       => esc_html__('No', 'technum')
                        )
                    ),

                    array(
                        'id'            => 'top_bar_contacts_phone',
                        'name'          => esc_html__('Phone Number', 'technum'),
                        'type'          => 'text',
                        'placeholder'   => technum_get_theme_mod('top_bar_contacts_phone'),
                        'std'           => '',
                        'attributes'    => array(
                            'data-dependency-id'    => 'top_bar_contacts_phone_status',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'        => 'top_bar_contacts_address_status',
                        'name'      => esc_html__('Show Address', 'technum'),
                        'type'      => 'select',
                        'std'       => 'default',
                        'options'   => array(
                            'default'   => esc_html__('Default', 'technum'),
                            'on'        => esc_html__('Yes', 'technum'),
                            'off'       => esc_html__('No', 'technum')
                        )
                    ),

                    array(
                        'id'            => 'top_bar_contacts_address',
                        'name'          => esc_html__('Address', 'technum'),
                        'type'          => 'text',
                        'placeholder'   => technum_get_theme_mod('top_bar_contacts_address'),
                        'std'           => '',
                        'attributes'    => array(
                            'data-dependency-id'    => 'top_bar_contacts_address_status',
                            'data-dependency-val'   => 'on'
                        )
                    )

                )
            );

            $meta_boxes[] = array(
                'title'         => esc_html__('Header Settings', 'technum'),
                'post_types'    => array('post', 'page', 'technum_portfolio', 'technum_team_member', 'technum_vacancy', 'technum_service', 'technum_case_study', 'product'),
                'closed'        => true,
                'context'       => 'advanced',
                'fields'        => array(

                # Header Options

                    //-- Header General
                    array(
                        'type'  => 'heading',
                        'name'  => esc_html__('Contacts', 'technum'),
                    ),

                    array(
                        'id'        => 'header_status',
                        'name'      => esc_html__('Show Header', 'technum'),
                        'type'      => 'select',
                        'std'       => 'default',
                        'options'   => array(
                            'default'   => esc_html__('Default', 'technum'),
                            'on'        => esc_html__('Yes', 'technum'),
                            'off'       => esc_html__('No', 'technum')
                        )
                    ),

                    array(
                        'id'        => 'header_style',
                        'name'      => esc_html__('Header Style', 'technum'),
                        'type'      => 'select',
                        'options'   => array(
                            'default'   => esc_html__('Default', 'technum'),
                            'type-1'    => esc_html__('Style 1', 'technum'),
                            'type-2'    => esc_html__('Style 2', 'technum'),
                            'type-3'    => esc_html__('Style 3', 'technum')
                        )
                    ),

                    array(
                        'id'        => 'header_position',
                        'name'      => esc_html__('Header Position', 'technum'),
                        'type'      => 'select',
                        'std'       => 'default',
                        'options'   => array(
                            'default'   => esc_html__('Default', 'technum'),
                            'above'     => esc_html__('Above', 'technum'),
                            'over'      => esc_html__('Over', 'technum')
                        )
                    ),

                    array(
                        'id'        => 'header_customize',
                        'name'      => esc_html__('Customize', 'technum'),
                        'type'      => 'select',
                        'std'       => 'default',
                        'options'   => array(
                            'default'   => esc_html__('Default', 'technum'),
                            'off'       => esc_html__('No', 'technum'),
                            'on'        => esc_html__('Yes', 'technum')
                        )
                    ),

                    array(
                        'id'            => 'header_default_text_color',
                        'name'          => esc_html__('Default Text Color', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'class'         => 'divider-before',
                        'attributes'    => array(
                            'data-dependency-id'    => 'header_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'header_dark_text_color',
                        'name'          => esc_html__('Dark Text Color', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'attributes'    => array(
                            'data-dependency-id'    => 'header_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'header_light_text_color',
                        'name'          => esc_html__('Light Text Color', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'attributes'    => array(
                            'data-dependency-id'    => 'header_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'header_accent_text_color',
                        'name'          => esc_html__('Accent Text Color', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'attributes'    => array(
                            'data-dependency-id'    => 'header_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'header_border_color',
                        'name'          => esc_html__('Border Color', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'class'         => 'divider-before',
                        'attributes'    => array(
                            'data-dependency-id'    => 'header_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'header_border_hover_color',
                        'name'          => esc_html__('Hovered Border Color', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'attributes'    => array(
                            'data-dependency-id'    => 'header_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'header_background_color',
                        'name'          => esc_html__('Background Color', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'class'         => 'divider-before',
                        'attributes'    => array(
                            'data-dependency-id'    => 'header_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'header_background_alter_color',
                        'name'          => esc_html__('Alternative Background Color', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'attributes'    => array(
                            'data-dependency-id'    => 'header_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'header_button_text_color',
                        'name'          => esc_html__('Button Text Color', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'class'         => 'divider-before',
                        'attributes'    => array(
                            'data-dependency-id'    => 'header_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'header_button_border_color',
                        'name'          => esc_html__('Button Border Color', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'attributes'    => array(
                            'data-dependency-id'    => 'header_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'header_button_background_color',
                        'name'          => esc_html__('Button Background Color', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'attributes'    => array(
                            'data-dependency-id'    => 'header_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'header_button_text_hover',
                        'name'          => esc_html__('Button Text Hover', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'attributes'    => array(
                            'data-dependency-id'    => 'header_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'header_button_border_hover',
                        'name'          => esc_html__('Button Border Hover', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'attributes'    => array(
                            'data-dependency-id'    => 'header_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'header_button_background_hover',
                        'name'          => esc_html__('Button Background Hover', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'attributes'    => array(
                            'data-dependency-id'    => 'header_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'type' => 'divider',
                    ),

                    //-- Sticky Header
                    array(
                        'type'  => 'heading',
                        'name'  => esc_html__('Sticky Header', 'technum'),
                    ),

                    array(
                        'id'        => 'sticky_header_status',
                        'name'      => esc_html__('Show Sticky Header', 'technum'),
                        'type'      => 'select',
                        'std'       => 'default',
                        'options'   => array(
                            'default'   => esc_html__('Default', 'technum'),
                            'on'        => esc_html__('Yes', 'technum'),
                            'off'       => esc_html__('No', 'technum')
                        )
                    ),

                    array(
                        'type' => 'divider',
                    ),

                    //-- Mobile Header
                    array(
                        'type'  => 'heading',
                        'name'  => esc_html__('Mobile Header', 'technum'),
                    ),

                    array(
                        'id'            => 'mobile_header_breakpoint',
                        'name'          => esc_html__('Mobile Header Breakpoint, in px', 'technum'),
                        'type'          => 'text',
                        'placeholder'   => technum_get_theme_mod('mobile_header_breakpoint'),
                        'std'           => ''
                    ),

                    array(
                        'type' => 'divider',
                    ),

                    //-- Header Logo
                    array(
                        'type'  => 'heading',
                        'name'  => esc_html__('Logo', 'technum'),
                    ),

                    array(
                        'id'        => 'header_logo_status',
                        'name'      => esc_html__('Show Header Logo', 'technum'),
                        'type'      => 'select',
                        'std'       => 'default',
                        'options'   => array(
                            'default'   => esc_html__('Default', 'technum'),
                            'on'        => esc_html__('Yes', 'technum'),
                            'off'       => esc_html__('No', 'technum')
                        )
                    ),

                    array(
                        'id'        => 'header_logo_customize',
                        'name'      => esc_html__('Customize', 'technum'),
                        'type'      => 'select',
                        'std'       => 'default',
                        'options'   => array(
                            'default'   => esc_html__('Default', 'technum'),
                            'off'       => esc_html__('No', 'technum'),
                            'on'        => esc_html__('Yes', 'technum')
                        )
                    ),

                    array(
                        'id'                => 'header_logo_image',
                        'name'              => esc_html__('Logo Image', 'technum'),
                        'type'              => 'image_advanced',
                        'max_file_uploads'  => 1,
                        'max_status'        => false,
                        'size'              => 'full',
                        'attributes'        => array(
                            'data-dependency-id'    => 'header_logo_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'header_logo_retina',
                        'name'          => esc_html__('Logo Retina', 'technum'),
                        'type'          => 'checkbox',
                        'std'           => 1,
                        'attributes'    => array(
                            'data-dependency-id'    => 'header_logo_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'                => 'header_logo_mobile_image',
                        'name'              => esc_html__('Mobile Logo Image', 'technum'),
                        'type'              => 'image_advanced',
                        'max_file_uploads'  => 1,
                        'max_status'        => false,
                        'size'              => 'full',
                        'attributes'        => array(
                            'data-dependency-id'    => 'header_logo_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'header_logo_mobile_retina',
                        'name'          => esc_html__('Mobile Logo Retina', 'technum'),
                        'type'          => 'checkbox',
                        'std'           => 1,
                        'attributes'    => array(
                            'data-dependency-id'    => 'header_logo_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'type' => 'divider',
                    ),

                    //-- Header Callback
                    array(
                        'type'          => 'heading',
                        'name'          => esc_html__('Header Callback', 'technum'),
                        'attributes'    => array(
                            'data-dependency-id'    => 'header_style',
                            'data-dependency-val'   => 'type-3'
                        )
                    ),

                    array(
                        'id'            => 'header_callback_status',
                        'name'          => esc_html__('Show Header Callback Block', 'technum'),
                        'type'          => 'select',
                        'std'           => 'default',
                        'options'       => array(
                            'default'               => esc_html__('Default', 'technum'),
                            'on'                    => esc_html__('Yes', 'technum'),
                            'off'                   => esc_html__('No', 'technum')
                        ),
                        'attributes'    => array(
                            'data-dependency-id'    => 'header_style',
                            'data-dependency-val'   => 'type-3'
                        )
                    ),

                    array(
                        'id'            => 'header_callback_title',
                        'name'          => esc_html__('Header Callback Title', 'technum'),
                        'type'          => 'text',
                        'placeholder'   => technum_get_theme_mod('header_callback_title'),
                        'std'           => '',
                        'attributes'    => array(
                            'data-dependency-id'    => 'header_style,header_callback_status',
                            'data-dependency-val'   => 'type-3,on'
                        )
                    ),

                    array(
                        'id'            => 'header_callback_text',
                        'name'          => esc_html__('Header Callback Text', 'technum'),
                        'type'          => 'text',
                        'placeholder'   => technum_get_theme_mod('header_callback_text'),
                        'std'           => '',
                        'attributes'    => array(
                            'data-dependency-id'    => 'header_style,header_callback_status',
                            'data-dependency-val'   => 'type-3,on'
                        )
                    ),

                    array(
                        'type' => 'divider',
                    ),

                    //-- Header Button
                    array(
                        'type'  => 'heading',
                        'name'  => esc_html__('Header Button', 'technum'),
                    ),

                    array(
                        'id'        => 'header_button_status',
                        'name'      => esc_html__('Show Header Button', 'technum'),
                        'type'      => 'select',
                        'std'       => 'default',
                        'options'   => array(
                            'default'   => esc_html__('Default', 'technum'),
                            'on'        => esc_html__('Yes', 'technum'),
                            'off'       => esc_html__('No', 'technum')
                        )
                    ),

                    array(
                        'id'            => 'header_button_text',
                        'name'          => esc_html__('Header Button Text', 'technum'),
                        'type'          => 'text',
                        'placeholder'   => technum_get_theme_mod('header_button_text'),
                        'std'           => ''
                    ),

                    array(
                        'id'            => 'header_button_url',
                        'name'          => esc_html__('Header Button Link', 'technum'),
                        'type'          => 'text',
                        'placeholder'   => technum_get_theme_mod('header_button_url'),
                        'std'           => ''
                    ),

                    array(
                        'type' => 'divider',
                    ),

                    //-- Header Menu
                    array(
                        'type'  => 'heading',
                        'name'  => esc_html__('Header Menu', 'technum'),
                    ),

                    array(
                        'id'        => 'header_menu_status',
                        'name'      => esc_html__('Show Main Menu', 'technum'),
                        'type'      => 'select',
                        'std'       => 'default',
                        'options'   => array(
                            'default'   => esc_html__('Default', 'technum'),
                            'on'        => esc_html__('Yes', 'technum'),
                            'off'       => esc_html__('No', 'technum')
                        )
                    ),

                    array(
                        'id'        => 'header_menu_select',
                        'name'      => esc_html__('Select Menu', 'technum'),
                        'type'      => 'select',
                        'std'       => 'default',
                        'options'   => technum_get_all_menu_list()
                    ),

                    array(
                        'type' => 'divider',
                    ),

                    //-- Header Side Panel
                    array(
                        'type'  => 'heading',
                        'name'  => esc_html__('Header Icons', 'technum'),
                    ),

                    array(
                        'id'        => 'side_panel_status',
                        'name'      => esc_html__('Show side panel trigger', 'technum'),
                        'type'      => 'select',
                        'std'       => 'default',
                        'options'   => array(
                            'default'   => esc_html__('Default', 'technum'),
                            'on'        => esc_html__('Yes', 'technum'),
                            'off'       => esc_html__('No', 'technum')
                        )
                    ),

                    array(
                        'id'        => 'header_search_status',
                        'name'      => esc_html__('Show search icon', 'technum'),
                        'type'      => 'select',
                        'std'       => 'default',
                        'options'   => array(
                            'default'   => esc_html__('Default', 'technum'),
                            'on'        => esc_html__('Yes', 'technum'),
                            'off'       => esc_html__('No', 'technum')
                        )
                    ),

                    array(
                        'id'            => 'header_minicart_status',
                        'name'          => esc_html__('Show product cart', 'technum'),
                        'type'          => 'select',
                        'std'           => 'default',
                        'options'       => array(
                            'default'       => esc_html__('Default', 'technum'),
                            'on'            => esc_html__('Yes', 'technum'),
                            'off'           => esc_html__('No', 'technum')
                        ),
                    ),
                ),
            );

            $meta_boxes[] = array(
                'title'         => esc_html__('Page Title Settings', 'technum'),
                'post_types'    => array('post', 'page', 'technum_portfolio', 'technum_team_member', 'technum_vacancy', 'technum_service', 'technum_case_study', 'product'),
                'closed'        => true,
                'context'       => 'advanced',
                'fields'        => array(

                    # Page Title Options

                    //-- Page Title General
                    array(
                        'type'  => 'heading',
                        'name'  => esc_html__('General', 'technum'),
                    ),

                    array(
                        'id'        => 'page_title_status',
                        'name'      => esc_html__('Show Page Title', 'technum'),
                        'type'      => 'select',
                        'std'       => 'default',
                        'options'   => array(
                            'default'   => esc_html__('Default', 'technum'),
                            'on'        => esc_html__('Yes', 'technum'),
                            'off'       => esc_html__('No', 'technum')
                        )
                    ),

                    array(
                        'id'        => 'page_title_overlay_status',
                        'name'      => esc_html__('Show overlay', 'technum'),
                        'type'      => 'select',
                        'std'       => 'default',
                        'options'   => array(
                            'default'   => esc_html__('Default', 'technum'),
                            'off'       => esc_html__('No', 'technum'),
                            'on'        => esc_html__('Yes', 'technum')
                        )
                    ),

                    array(
                        'id'            => 'page_title_overlay_color',
                        'name'          => esc_html__('Overlay Color', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => true,
                        'attributes'    => array(
                            'data-dependency-id'    => 'page_title_overlay_status',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'        => 'page_title_customize',
                        'name'      => esc_html__('Customize', 'technum'),
                        'type'      => 'select',
                        'std'       => 'default',
                        'class'     => 'divider-before',
                        'options'   => array(
                            'default'   => esc_html__('Default', 'technum'),
                            'off'       => esc_html__('No', 'technum'),
                            'on'        => esc_html__('Yes', 'technum')
                        )
                    ),

                    array(
                        'id'            => 'page_title_height',
                        'name'          => esc_html__('Page Title Height', 'technum'),
                        'type'          => 'number',
                        'placeholder'   => technum_get_theme_mod('page_title_height'),
                        'std'           => '500',
                        'attributes'    => array(
                            'data-dependency-id'    => 'page_title_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'page_title_default_text_color',
                        'name'          => esc_html__('Default Text Color', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'class'         => 'divider-before',
                        'attributes'    => array(
                            'data-dependency-id'    => 'page_title_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'page_title_dark_text_color',
                        'name'          => esc_html__('Dark Text Color', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'attributes'    => array(
                            'data-dependency-id'    => 'page_title_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'page_title_light_text_color',
                        'name'          => esc_html__('Light Text Color', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'attributes'    => array(
                            'data-dependency-id'    => 'page_title_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'page_title_accent_text_color',
                        'name'          => esc_html__('Accent Text Color', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'attributes'    => array(
                            'data-dependency-id'    => 'page_title_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'page_title_border_color',
                        'name'          => esc_html__('Border Color', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'class'         => 'divider-before',
                        'attributes'    => array(
                            'data-dependency-id'    => 'page_title_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'page_title_border_hover_color',
                        'name'          => esc_html__('Hovered Border Color', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'attributes'    => array(
                            'data-dependency-id'    => 'page_title_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'page_title_background_color',
                        'name'          => esc_html__('Background Color', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'class'         => 'divider-before',
                        'attributes'    => array(
                            'data-dependency-id'    => 'page_title_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'page_title_background_alter_color',
                        'name'          => esc_html__('Alternative Background Color', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'attributes'    => array(
                            'data-dependency-id'    => 'page_title_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'page_title_button_text_color',
                        'name'          => esc_html__('Button Text Color', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'class'         => 'divider-before',
                        'attributes'    => array(
                            'data-dependency-id'    => 'page_title_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'page_title_button_border_color',
                        'name'          => esc_html__('Button Border Color', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'attributes'    => array(
                            'data-dependency-id'    => 'page_title_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'page_title_button_background_color',
                        'name'          => esc_html__('Button Background Color', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'attributes'    => array(
                            'data-dependency-id'    => 'page_title_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'page_title_button_text_hover',
                        'name'          => esc_html__('Button Text Hover', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'attributes'    => array(
                            'data-dependency-id'    => 'page_title_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'page_title_button_border_hover',
                        'name'          => esc_html__('Button Border Hover', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'attributes'    => array(
                            'data-dependency-id'    => 'page_title_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'page_title_button_background_hover',
                        'name'          => esc_html__('Button Background Hover', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'attributes'    => array(
                            'data-dependency-id'    => 'page_title_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'                => 'page_title_background_image',
                        'name'              => esc_html__('Background Image', 'technum'),
                        'type'              => 'image_advanced',
                        'max_file_uploads'  => 1,
                        'max_status'        => false,
                        'size'              => 'full',
                        'class'             => 'divider-before',
                        'attributes'        => array(
                            'data-dependency-id'    => 'page_title_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'page_title_background_position',
                        'name'          => esc_html__('Background Position', 'technum'),
                        'type'          => 'select',
                        'std'           => 'default',
                        'options'       => array(
                            'default'       => esc_html__('Default', 'technum'),
                            'center center' => esc_html__('Center Center', 'technum'),
                            'center left'   => esc_html__('Center Left', 'technum'),
                            'center right'  => esc_html__('Center Right', 'technum'),
                            'top center'    => esc_html__('Top Center', 'technum'),
                            'top left'      => esc_html__('Top Left', 'technum'),
                            'top right'     => esc_html__('Top Right', 'technum'),
                            'bottom center' => esc_html__('Bottom Center', 'technum'),
                            'bottom left'   => esc_html__('Bottom Left', 'technum'),
                            'bottom right'  => esc_html__('Bottom Right', 'technum')
                        ),
                        'attributes'    => array(
                            'data-dependency-id'    => 'page_title_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'page_title_background_repeat',
                        'name'          => esc_html__('Background Repeat', 'technum'),
                        'type'          => 'select',
                        'std'           => 'default',
                        'options'       => array(
                            'default'       => esc_html__('Default', 'technum'),
                            'no-repeat'     => esc_html__('No-repeat', 'technum'),
                            'repeat'        => esc_html__('Repeat', 'technum'),
                            'repeat-x'      => esc_html__('Repeat-x', 'technum'),
                            'repeat-y'      => esc_html__('Repeat-y', 'technum')
                        ),
                        'attributes'    => array(
                            'data-dependency-id'    => 'page_title_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'page_title_background_size',
                        'name'          => esc_html__('Background Size', 'technum'),
                        'type'          => 'select',
                        'std'           => 'default',
                        'options'       => array(
                            'default'       => esc_html__('Default', 'technum'),
                            'initial'       => esc_html__('Initial', 'technum'),
                            'auto'          => esc_html__('Auto', 'technum'),
                            'cover'         => esc_html__('Cover', 'technum'),
                            'contain'       => esc_html__('Contain', 'technum'),
                        ),
                        'attributes'    => array(
                            'data-dependency-id'    => 'page_title_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'type'          => 'divider',
                        'attributes'    => array(
                            'data-dependency-id'    => 'page_title_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'hide_page_title_background_mobile',
                        'name'          => esc_html__('Hide Background Image on Mobile Devices', 'technum'),
                        'type'          => 'checkbox',
                        'std'           => 0,
                        'attributes'    => array(
                            'data-dependency-id'    => 'page_title_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'hide_page_title_background_tablet',
                        'name'          => esc_html__('Hide Background Image on Tablet Devices', 'technum'),
                        'type'          => 'checkbox',
                        'std'           => 0,
                        'attributes'    => array(
                            'data-dependency-id'    => 'page_title_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'type' => 'divider',
                    ),

                    //-- Page Title Breadcrumbs
                    array(
                        'type'  => 'heading',
                        'name'  => esc_html__('Page Title Breadcrumbs', 'technum'),
                    ),

                    array(
                        'id'        => 'page_title_breadcrumbs_status',
                        'name'      => esc_html__('Show Page Title Breadcrumbs', 'technum'),
                        'type'      => 'select',
                        'std'       => 'default',
                        'options'   => array(
                            'default'   => esc_html__('Default', 'technum'),
                            'on'        => esc_html__('Show', 'technum'),
                            'off'       => esc_html__('Hide', 'technum')
                        )
                    ),



                    //-- Page Title Additional Text
                    array(
                        'type'  => 'heading',
                        'name'  => esc_html__('Page Title Additional Text', 'technum'),
                    ),

                    array(
                        'id'            => 'page_title_additional_text',
                        'name'          => esc_html__('Additional Text', 'technum'),
                        'type'          => 'text',
                        'placeholder'   => technum_get_theme_mod('page_title_additional_text'),
                        'std'           => ''
                    ),

                    array(
                        'id'        => 'page_title_additional_customize',
                        'name'      => esc_html__('Customize', 'technum'),
                        'type'      => 'select',
                        'std'       => 'default',
                        'options'   => array(
                            'default'   => esc_html__('Default', 'technum'),
                            'off'       => esc_html__('No', 'technum'),
                            'on'        => esc_html__('Yes', 'technum')
                        )
                    ),

                    array(
                        'id'            => 'page_title_additional_text_color',
                        'name'          => esc_html__('Text Color', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => true,
                        'attributes'    => array(
                            'data-dependency-id'    => 'page_title_additional_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),
                )
            );

            // Layout Settings
            $meta_boxes[] = array(
                'title'         => esc_html__('Layout Settings', 'technum'),
                'post_types'    => array('page'),
                'context'       => 'advanced',
                'closed'        => true,
                'fields'        => array(

                    //-- Content Margin
                    array(
                        'type'  => 'heading',
                        'name'  => esc_html__('Content Margin', 'technum'),
                    ),
                    array(
                        'id'        => 'content_top_margin',
                        'name'      => esc_html__('Remove Top Margin', 'technum'),
                        'type'      => 'select',
                        'std'       => 'off',
                        'options'   => array(
                            'on'        => esc_html__('Yes', 'technum'),
                            'off'       => esc_html__('No', 'technum')
                        )
                    ),

                    array(
                        'id'        => 'content_bottom_margin',
                        'name'      => esc_html__('Remove Bottom Margin', 'technum'),
                        'type'      => 'select',
                        'std'       => 'off',
                        'options'   => array(
                            'off'       => esc_html__('No', 'technum'),
                            'on'        => esc_html__('Yes', 'technum')
                        )
                    ),

                    array(
                        'type' => 'divider',
                    ),

                    //-- Sidebar Options
                    array(
                        'type'  => 'heading',
                        'name'  => esc_html__('Sidebar', 'technum'),
                    ),

                    array(
                        'id'        => 'sidebar_position',
                        'name'      => esc_html__('Sidebar Position', 'technum'),
                        'type'      => 'select',
                        'options'   => array(
                            'default'   => esc_html__('Default', 'technum'),
                            'left'      => esc_html__('Left', 'technum'),
                            'right'     => esc_html__('Right', 'technum'),
                            'none'      => esc_html__('None', 'technum')
                        )
                    ),

                    array(
                        'id'            => 'page_sidebar_select',
                        'name'          => esc_html__('Select Sidebar', 'technum'),
                        'type'          => 'select',
                        'std'           => 'default',
                        'options'       => $sidebar_list
                    ),
                )
            );

            // Layout Settings
            $meta_boxes[] = array(
                'title'         => esc_html__('Layout Settings', 'technum'),
                'post_types'    => array('technum_service'),
                'context'       => 'advanced',
                'closed'        => true,
                'fields'        => array(

                    //-- Content Margin
                    array(
                        'type'  => 'heading',
                        'name'  => esc_html__('Content Margin', 'technum'),
                    ),
                    array(
                        'id'        => 'content_top_margin',
                        'name'      => esc_html__('Remove Top Margin', 'technum'),
                        'type'      => 'select',
                        'std'       => 'off',
                        'options'   => array(
                            'on'        => esc_html__('Yes', 'technum'),
                            'off'       => esc_html__('No', 'technum')
                        )
                    ),

                    array(
                        'id'        => 'content_bottom_margin',
                        'name'      => esc_html__('Remove Bottom Margin', 'technum'),
                        'type'      => 'select',
                        'std'       => 'off',
                        'options'   => array(
                            'off'       => esc_html__('No', 'technum'),
                            'on'        => esc_html__('Yes', 'technum')
                        )
                    ),

                    array(
                        'type' => 'divider',
                    ),

                    //-- Sidebar Options
                    array(
                        'type'  => 'heading',
                        'name'  => esc_html__('Sidebar', 'technum'),
                    ),

                    array(
                        'id'        => 'service_sidebar_position',
                        'name'      => esc_html__('Sidebar Position', 'technum'),
                        'type'      => 'select',
                        'options'   => array(
                            'default'   => esc_html__('Default', 'technum'),
                            'left'      => esc_html__('Left', 'technum'),
                            'right'     => esc_html__('Right', 'technum'),
                            'none'      => esc_html__('None', 'technum')
                        )
                    ),

                    array(
                        'id'            => 'service_sidebar_select',
                        'name'          => esc_html__('Select Sidebar', 'technum'),
                        'type'          => 'select',
                        'std'           => 'default',
                        'options'       => $sidebar_list
                    ),
                )
            );

            // Layout Settings
            $meta_boxes[] = array(
                'title'         => esc_html__('Layout Settings', 'technum'),
                'post_types'    => array('technum_team_member'),
                'context'       => 'advanced',
                'closed'        => true,
                'fields'        => array(

                    //-- Content Margin
                    array(
                        'type'  => 'heading',
                        'name'  => esc_html__('Content Margin', 'technum'),
                    ),
                    array(
                        'id'        => 'content_top_margin',
                        'name'      => esc_html__('Remove Top Margin', 'technum'),
                        'type'      => 'select',
                        'std'       => 'off',
                        'options'   => array(
                            'on'        => esc_html__('Yes', 'technum'),
                            'off'       => esc_html__('No', 'technum')
                        )
                    ),

                    array(
                        'id'        => 'content_bottom_margin',
                        'name'      => esc_html__('Remove Bottom Margin', 'technum'),
                        'type'      => 'select',
                        'std'       => 'off',
                        'options'   => array(
                            'off'       => esc_html__('No', 'technum'),
                            'on'        => esc_html__('Yes', 'technum')
                        )
                    )
                )
            );

            // Layout Settings
            $meta_boxes[] = array(
                'title'         => esc_html__('Layout Settings', 'technum'),
                'post_types'    => array('post'),
                'context'       => 'advanced',
                'closed'        => true,
                'fields'        => array(

                    //-- Sidebar Options
                    array(
                        'type'  => 'heading',
                        'name'  => esc_html__('Sidebar', 'technum'),
                    ),

                    array(
                        'id'        => 'post_sidebar_position',
                        'name'      => esc_html__('Sidebar Position', 'technum'),
                        'type'      => 'select',
                        'options'   => array(
                            'default'   => esc_html__('Default', 'technum'),
                            'left'      => esc_html__('Left', 'technum'),
                            'right'     => esc_html__('Right', 'technum'),
                            'none'      => esc_html__('None', 'technum')
                        )
                    ),

                    array(
                        'id'            => 'post_sidebar_select',
                        'name'          => esc_html__('Select Sidebar', 'technum'),
                        'type'          => 'select',
                        'std'           => 'default',
                        'options'       => $sidebar_list
                    ),
                )
            );

            $meta_boxes[] = array(
                'title'         => esc_html__('Footer Settings', 'technum'),
                'post_types'    => array('post', 'page', 'technum_portfolio', 'technum_team_member', 'technum_vacancy', 'technum_service', 'technum_case_study', 'product'),
                'closed'        => true,
                'context'       => 'advanced',
                'fields'        => array(

                    # Footer Options

                    //-- Footer General
                    array(
                        'type'  => 'heading',
                        'name'  => esc_html__('General', 'technum'),
                    ),

                    array(
                        'id'        => 'footer_status',
                        'name'      => esc_html__('Show Footer', 'technum'),
                        'type'      => 'select',
                        'std'       => 'default',
                        'options'   => array(
                            'default'   => esc_html__('Default', 'technum'),
                            'on'        => esc_html__('Yes', 'technum'),
                            'off'       => esc_html__('No', 'technum')
                        )
                    ),

                    array(
                        'id'        => 'footer_style',
                        'name'      => esc_html__('Footer Style', 'technum'),
                        'type'      => 'select',
                        'options'   => array(
                            'default'   => esc_html__('Default', 'technum'),
                            'type-1'    => esc_html__('Style 1', 'technum'),
                            'type-2'    => esc_html__('Style 2', 'technum')
                        )
                    ),

                    array(
                        'id'        => 'footer_customize',
                        'name'      => esc_html__('Customize', 'technum'),
                        'type'      => 'select',
                        'std'       => 'default',
                        'options'   => array(
                            'default'   => esc_html__('Default', 'technum'),
                            'off'       => esc_html__('No', 'technum'),
                            'on'        => esc_html__('Yes', 'technum')
                        )
                    ),

                    array(
                        'id'            => 'footer_default_text_color',
                        'name'          => esc_html__('Default Text Color', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'class'         => 'divider-before',
                        'attributes'    => array(
                            'data-dependency-id'    => 'footer_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'footer_dark_text_color',
                        'name'          => esc_html__('Dark Text Color', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'attributes'    => array(
                            'data-dependency-id'    => 'footer_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'footer_light_text_color',
                        'name'          => esc_html__('Light Text Color', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'attributes'    => array(
                            'data-dependency-id'    => 'footer_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'footer_accent_text_color',
                        'name'          => esc_html__('Accent Text Color', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'attributes'    => array(
                            'data-dependency-id'    => 'footer_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'footer_border_color',
                        'name'          => esc_html__('Border Color', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'class'         => 'divider-before',
                        'attributes'    => array(
                            'data-dependency-id'    => 'footer_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'footer_border_hover_color',
                        'name'          => esc_html__('Hovered Border Color', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'attributes'    => array(
                            'data-dependency-id'    => 'footer_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'footer_background_color',
                        'name'          => esc_html__('Background Color', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'class'         => 'divider-before',
                        'attributes'    => array(
                            'data-dependency-id'    => 'footer_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'footer_background_alter_color',
                        'name'          => esc_html__('Alternative Background Color', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'attributes'    => array(
                            'data-dependency-id'    => 'footer_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'footer_button_text_color',
                        'name'          => esc_html__('Button Text Color', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'class'         => 'divider-before',
                        'attributes'    => array(
                            'data-dependency-id'    => 'footer_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'footer_button_border_color',
                        'name'          => esc_html__('Button Border Color', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'attributes'    => array(
                            'data-dependency-id'    => 'footer_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'footer_button_background_color',
                        'name'          => esc_html__('Button Background Color', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'attributes'    => array(
                            'data-dependency-id'    => 'footer_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'footer_button_text_hover',
                        'name'          => esc_html__('Button Text Hover', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'attributes'    => array(
                            'data-dependency-id'    => 'footer_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'footer_button_border_hover',
                        'name'          => esc_html__('Button Border Hover', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'attributes'    => array(
                            'data-dependency-id'    => 'footer_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'footer_button_background_hover',
                        'name'          => esc_html__('Button Background Hover', 'technum'),
                        'type'          => 'color',
                        'alpha_channel' => false,
                        'attributes'    => array(
                            'data-dependency-id'    => 'footer_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'                => 'footer_background_image',
                        'name'              => esc_html__('Background Image', 'technum'),
                        'type'              => 'image_advanced',
                        'max_file_uploads'  => 1,
                        'max_status'        => false,
                        'attributes'        => array(
                            'data-dependency-id'    => 'footer_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'footer_background_position',
                        'name'          => esc_html__('Background Position', 'technum'),
                        'type'          => 'select',
                        'std'           => 'default',
                        'options'       => array(
                            'default'       => esc_html__('Default', 'technum'),
                            'center center' => esc_html__('Center Center', 'technum'),
                            'center left'   => esc_html__('Center Left', 'technum'),
                            'center right'  => esc_html__('Center Right', 'technum'),
                            'top center'    => esc_html__('Top Center', 'technum'),
                            'top left'      => esc_html__('Top Left', 'technum'),
                            'top right'     => esc_html__('Top Right', 'technum'),
                            'bottom center' => esc_html__('Bottom Center', 'technum'),
                            'bottom left'   => esc_html__('Bottom Left', 'technum'),
                            'bottom right'  => esc_html__('Bottom Right', 'technum')
                        ),
                        'attributes'    => array(
                            'data-dependency-id'    => 'footer_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'footer_background_repeat',
                        'name'          => esc_html__('Background Repeat', 'technum'),
                        'type'          => 'select',
                        'std'           => 'default',
                        'options'       => array(
                            'default'       => esc_html__('Default', 'technum'),
                            'no-repeat'     => esc_html__('No-repeat', 'technum'),
                            'repeat'        => esc_html__('Repeat', 'technum'),
                            'repeat-x'      => esc_html__('Repeat-x', 'technum'),
                            'repeat-y'      => esc_html__('Repeat-y', 'technum')
                        ),
                        'attributes'    => array(
                            'data-dependency-id'    => 'footer_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'id'            => 'footer_background_size',
                        'name'          => esc_html__('Background Size', 'technum'),
                        'type'          => 'select',
                        'std'           => 'default',
                        'options'       => array(
                            'default'       => esc_html__('Default', 'technum'),
                            'initial'       => esc_html__('Initial', 'technum'),
                            'auto'          => esc_html__('Auto', 'technum'),
                            'cover'         => esc_html__('Cover', 'technum'),
                            'contain'       => esc_html__('Contain', 'technum'),
                        ),
                        'attributes'    => array(
                            'data-dependency-id'    => 'footer_customize',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'type' => 'divider',
                    ),

                    //-- Footer Widgets
                    array(
                        'type'  => 'heading',
                        'name'  => esc_html__('Footer Widgets', 'technum'),
                    ),

                    array(
                        'id'        => 'footer_sidebar_status',
                        'name'      => esc_html__('Show Footer Widgets', 'technum'),
                        'type'      => 'select',
                        'std'       => 'default',
                        'options'   => array(
                            'default'   => esc_html__('Default', 'technum'),
                            'on'        => esc_html__('Yes', 'technum'),
                            'off'       => esc_html__('No', 'technum')
                        )
                    ),

                    array(
                        'id'            => 'footer_sidebar_select',
                        'name'          => esc_html__('Select Sidebar', 'technum'),
                        'type'          => 'select',
                        'std'           => 'default',
                        'options'       => $sidebar_list,
                        'attributes'    => array(
                            'data-dependency-id'    => 'footer_sidebar_status',
                            'data-dependency-val'   => 'on'
                        )
                    ),

                    array(
                        'type' => 'divider',
                    ),

                    //-- Copyright
                    array(
                        'type'  => 'heading',
                        'name'  => esc_html__('Copyright', 'technum'),
                    ),

                    array(
                        'id'        => 'footer_copyright_status',
                        'name'      => esc_html__('Show Copyright', 'technum'),
                        'type'      => 'select',
                        'std'       => 'default',
                        'options'   => array(
                            'default'   => esc_html__('Default', 'technum'),
                            'on'        => esc_html__('Yes', 'technum'),
                            'off'       => esc_html__('No', 'technum')
                        )
                    ),

                    array(
                        'id'            => 'footer_copyright_text',
                        'name'          => esc_html__('Copyright Text', 'technum'),
                        'type'          => 'text',
                        'placeholder'   => technum_get_theme_mod('footer_copyright_text'),
                        'std'           => ''
                    ),

                    array(
                        'type' => 'divider',
                    ),

                    //-- Footer Menu
                    array(
                        'type'  => 'heading',
                        'name'  => esc_html__('Footer Menu', 'technum'),
                    ),

                    array(
                        'id'        => 'footer_menu_status',
                        'name'      => esc_html__('Show Footer Menu', 'technum'),
                        'type'      => 'select',
                        'std'       => 'default',
                        'options'   => array(
                            'default'   => esc_html__('Default', 'technum'),
                            'on'        => esc_html__('Yes', 'technum'),
                            'off'       => esc_html__('No', 'technum')
                        )
                    ),

                    array(
                        'id'        => 'footer_menu_select',
                        'name'      => esc_html__('Select Menu', 'technum'),
                        'type'      => 'select',
                        'std'       => 'default',
                        'options'   => technum_get_all_menu_list()
                    ),

                    array(
                        'type' => 'divider',
                    ),

                    //-- Footer Additional Menu
                    array(
                        'type'  => 'heading',
                        'name'  => esc_html__('Footer Additional Menu', 'technum'),
                    ),

                    array(
                        'id'        => 'footer_additional_menu_status',
                        'name'      => esc_html__('Show Footer Additional Menu', 'technum'),
                        'type'      => 'select',
                        'std'       => 'default',
                        'options'   => array(
                            'default'   => esc_html__('Default', 'technum'),
                            'on'        => esc_html__('Yes', 'technum'),
                            'off'       => esc_html__('No', 'technum')
                        )
                    ),

                    array(
                        'id'        => 'footer_additional_menu_select',
                        'name'      => esc_html__('Select Menu', 'technum'),
                        'type'      => 'select',
                        'std'       => 'default',
                        'options'   => technum_get_all_menu_list()
                    )
                )
            );

            return $meta_boxes;
        }
    }
}