<input type="hidden" name="shortcode_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">
<table>
    <tr>
        <td>
            <label for="shortcode_slug">Shortcode Name (lowercase, no spaces):&nbsp;&nbsp;</label>
        </td>
        <td>
            <input type="text" name="shortcode_slug" value="<?= $shortcode_slug ?>">
        </td>
    </tr>
    <tr>
        <td>
            <label for="shortcode_btn_text">Editor Button Text:&nbsp;&nbsp;</label>
        </td>
        <td>
            <input type="text" name="shortcode_btn_text" value="<?= $shortcode_btn_text ?>">
        </td>
    </tr>
    <tr>
        <td>
            <label for="shortcode_btn_tooltip">Editor Button Tooltip (on hover):&nbsp;&nbsp;</label>
        </td>
        <td>
            <input type="text" name="shortcode_btn_tooltip" value="<?= $shortcode_btn_tooltip ?>">
        </td>
    </tr>
    <tr>
        <td>
            <label for="shortcode_close_tag">Has close tag (true or false):&nbsp;&nbsp;</label>
        </td>
        <td>
            <input type="text" name="shortcode_close_tag" value="<?= $shortcode_close_tag ?>">
        </td>
    </tr>
</table>