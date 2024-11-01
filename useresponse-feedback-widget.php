<?php
/**
 * Plugin Name: UseResponse Feedback Widget
 * Description: Add chat widget to site
 * Plugin URI:  https://www.useresponse.com/
 * Author:      UseResponse
 * Version:     1.0
 */

add_action('admin_menu', function () {
    add_menu_page('UseResponse Feedback', 'UseResponse Feedback', 'manage_options', 'wp-ur-feedback', 'urFeedback_widget', plugin_dir_url(__FILE__) . 'ur_ico.png');
});

function urFeedback_widget()
{
    ?>
    <style>
        th {
            display: none;
        }

        .wrap p {
            font-size: 15px;
        }

        form {
            margin-top: -21px;
        }

        p.submit {
            margin-top: 3px;
        }

        textarea {
            color: #837e7e;
        }
    </style>
    <div class="wrap" style="margin-top:30px; width: 1000px;">
        <img src="<?php echo plugin_dir_url(__FILE__) . 'ur_logo.png'; ?>">
        <p>UseResponse Feedback Widget is a part of an effective all-in-one Customer Support Suite. It also includes
            Helpdesk, Ticketing System, Knowledge Base.
            <img src="<?php echo plugin_dir_url(__FILE__) . 'sources.png'; ?>"><br>
            If you already have UseResponse account, please go to Administration » Widgets » Support Center and copy the code
            provided. If you don't have an account, please
            <a href="https://www.useresponse.com/trial" target="_blank">sign up</a> for a free trial.</p>

        <p>Paste widget code here:</p>
        <form action="options.php" method="POST">
            <?php
            settings_fields("urFedback_group");
            do_settings_sections("urFeedback_page");
            submit_button();
            ?>
        </form>
    </div>
    <script type="text/javascript" id="UR_initiator"> (function () {
            var iid = 'uriid_da39a3ee5e6b4b0d3255bfef95601890afd80709';
            if (!document._fpu_) document.getElementById('UR_initiator').setAttribute('id', iid);
            var bsa = document.createElement('script');
            bsa.type = 'text/javascript';
            bsa.async = true;
            bsa.src = '//help.useresponse.com/public/sdk/chat-' + iid + '-38.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(bsa);
        })(); </script>
    <?php
}

add_action('admin_init', 'urFeedback_plugin_settings');
function urFeedback_plugin_settings()
{
    register_setting('urFedback_group', 'urFeedback_widget_code');
    add_settings_section('urFeedback_section', '', '', 'urFeedback_page');
    add_settings_field('urFeedback_widget_code', '', 'urFeedback_widget_code_field', 'urFeedback_page', 'urFeedback_section');
}

function urFeedback_widget_code_field()
{
    ?>
    <textarea name="urFeedback_widget_code" style="width:98%;height: 120px;"><?php echo get_option('urFeedback_widget_code') ?></textarea>
    <?php
}

add_action('wp_footer', 'urFeedback_widget_action');
function urFeedback_widget_action()
{
    echo get_option('urFeedback_widget_code');
}