<input type="hidden" name="shortcode_params_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">

<ol id="shortcode_params_list">
    <?php 
        $count = 0;
        if ( is_array($shortcode_params) &&  count( $shortcode_params ) > 0) {
            foreach( $shortcode_params as $param ) {
                if ( isset( $param['code'] ) || isset( $param['text'] ) ) {
                    ?>
                        <li id="param-<?=$count?>">
                            <label for="shortcode_params[<?=$count?>][code]">Code:</label>&nbsp;&nbsp;
                            <input type="text" name="shortcode_params[<?=$count?>][code]" value="<?=$param['code']?>"/>&nbsp;&nbsp;
                            <label for="shortcode_params[<?=$count?>][text]">Description:</label>&nbsp;&nbsp;
                            <input type="text" name="shortcode_params[<?=$count?>][text]" value="<?=$param['text']?>"  size="40"/>
                            <a href="!#" class="remove_btn" data-index="<?=$count?>" style="text-decoration:none;"><span class="dashicons dashicons-trash"></span></a>
                        </li>
                    <?php
                    $count++;
                }
            }
        }
    ?>
</ol>

<input type="button" id="shortcode_param_add" value="Add Parameter">