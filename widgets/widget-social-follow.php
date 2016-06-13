<?php
/*
フォローボタンウィジェット
*/

class widget_social_follow extends WP_Widget {
    function __construct() {
        parent::__construct ( 'widget_social_follow', '[gadgetone] フォローボタン', array( 'description' => 'SNSのフォローボタンを設置できるウィジェット' ) );
    }
    
    function form($instance) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
        
        $title = !empty($instance['title']) ? $instance['title'] : '';
        $twitter = !empty($instance['twitter']) ? $instance['twitter'] : '';
        $facebook = !empty($instance['facebook']) ? $instance['facebook'] : '';
        $feedly = !empty($instance['feedly']) ? $instance['feedly'] : '';
        $instagram = !empty($instance['instagram']) ? $instance['instagram'] : '';
        $youtube = !empty($instance['youtube']) ? $instance['youtube'] : '';
        
        $style_color = isset($instance['style_color']) ? $instance['style_color'] : 'color';
        ?>
        
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">タイトル:</label><br>
            <input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>">
        </p>
        <hr>
        <p>ボタンを設置したいSNSのURLを入力してください。</p>
        <p>
            <label for="<?php echo $this->get_field_id('twitter'); ?>">Twitter:</label><br>
            <input class="widefat" type="text" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" value="<?php echo $twitter; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('facebook'); ?>">Facebook:</label><br>
            <input class="widefat" type="text" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" value="<?php echo $facebook; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('feedly'); ?>">Feedly:</label><br>
            <input class="widefat" type="text" id="<?php echo $this->get_field_id('feedly'); ?>" name="<?php echo $this->get_field_name('feedly'); ?>" value="<?php echo $feedly; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('instagram'); ?>">Instagram:</label><br>
            <input class="widefat" type="text" id="<?php echo $this->get_field_id('instagram'); ?>" name="<?php echo $this->get_field_name('instagram'); ?>" value="<?php echo $instagram; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('youtube'); ?>">Youtube:</label><br>
            <input class="widefat" type="text" id="<?php echo $this->get_field_id('youtube'); ?>" name="<?php echo $this->get_field_name('youtube'); ?>" value="<?php echo $youtube; ?>">
        </p>
<hr>
<p>ボタンのスタイル:</p>
<p><input type="radio" class="radio" id="<?php echo $this->get_field_id('style_color'); ?>" name="<?php echo $this->get_field_name('style_color'); ?>" value="color" <?php if($style_color == 'color'){ echo 'checked'; } ?>>
<label for="<?php echo $this->get_field_id('style_color'); ?>">カラフル</label></p>
<p><input type="radio" class="radio" id="<?php echo $this->get_field_id('style_color'); ?>" name="<?php echo $this->get_field_name('style_color'); ?>" value="elegant" <?php if($style_color == 'elegant'){ echo 'checked'; } ?>>
<label for="<?php echo $this->get_field_id('style_color'); ?>">エレガント</label></p>

        <?php
    }
    
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['twitter'] = esc_url($new_instance['twitter']);
        $instance['facebook'] = esc_url($new_instance['facebook']);
        $instance['feedly'] = esc_url($new_instance['feedly']);
        $instance['instagram'] = esc_url($new_instance['instagram']);
        $instance['youtube'] = esc_url($new_instance['youtube']);
        
        $instance['style_color'] = esc_attr($new_instance['style_color']);
        return $instance;
    }
    
    function widget($args, $instance) {
        extract ($args, EXTR_SKIP);
        
        if ( !isset( $instance['style_color'] ) ) {
            $instance['style_color'] = 'color';
        }
		
        echo $before_widget;
        ?>
        <?php echo !empty($instance['title']) ? '<h2 class="widgettitle">' . $instance['title'] . '</h2>' : '' ?>
        <ul class="widget-social-follow">
        <?php echo !empty($instance['twitter']) ? '<li class="wsf-twitter ' . $instance['style_color'] . '"><a target="_blank" href="' . $instance['twitter'] . '"><i class="fa fa-twitter"></i></a></li>' : '' ?>
        <?php echo !empty($instance['facebook']) ? '<li class="wsf-facebook ' . $instance['style_color'] . '"><a target="_blank" href="' . $instance['facebook'] . '"><i class="fa fa-facebook"></i></a></li>' : '' ?>
        <?php echo !empty($instance['feedly']) ? '<li class="wsf-feedly ' . $instance['style_color'] . '"><a target="_blank" href="' . $instance['feedly'] . '"><i class="fa fa-rss"></i></a></li>' : '' ?>
        <?php echo !empty($instance['instagram']) ? '<li class="wsf-instagram ' . $instance['style_color'] . '"><a target="_blank" href="' . $instance['instagram'] . '"><i class="fa fa-instagram"></i></a></li>' : '' ?>
        <?php echo !empty($instance['youtube']) ? '<li class="wsf-youtube ' . $instance['style_color'] . '"><a target="_blank" href="' . $instance['youtube'] . '"><i class="fa fa-youtube"></i></a></li>' : '' ?>
        </ul>
        <?php
        echo $after_widget;
    }
}
add_action( 'widgets_init', create_function( '', 'return register_widget("widget_social_follow");' ) );