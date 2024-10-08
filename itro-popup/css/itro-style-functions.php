<?php
/*
  This file is part of ITRO Popup Plugin. (email : support@itroteam.com)
 */

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

function itro_style()
{
    // check if user inputs no-sense values
    if ((ipp_itro_get_option('select_popup_height') == 'px' && ipp_itro_get_option('px_popup_height') == 0) || (ipp_itro_get_option('select_popup_height') == 'perc' && ipp_itro_get_option(
                'perc_popup_height'
            ) == 0)) {
        ipp_update_option('select_popup_height', 'auto');
    }
    if (ipp_itro_get_option('select_popup_width') == 'px' && ipp_itro_get_option('px_popup_width') == 0) {
        ipp_update_option('px_popup_width', '600');
    }
    if (ipp_itro_get_option('select_popup_width') == 'perc' && ipp_itro_get_option('perc_popup_width') == 0) {
        ipp_update_option('perc_popup_width', '60');
    }
    ?>
    <style>
        /* POP-UP */
        #age_button_area {
            padding-top: 10px;
            position: relative;
            width: 100%;
            bottom: 5px;
            padding-top: 5px;
        }

        #ageEnterButton {
            border-color: <?php echo ipp_itro_get_option('enter_button_border_color') ?>;
            background: <?php echo ipp_itro_get_option('enter_button_bg_color') ?>;
            color: <?php echo ipp_itro_get_option('enter_button_font_color'); ?>;
        }

        #ageLeaveButton {
            border-color: <?php echo ipp_itro_get_option('leave_button_border_color') ?>;
            background: <?php echo ipp_itro_get_option('leave_button_bg_color') ?>;
            color: <?php echo ipp_itro_get_option('leave_button_font_color'); ?>;
        }

        #popup_content {
        <?php
        if (ipp_itro_get_option('select_popup_height') == 'px' || ipp_itro_get_option('select_popup_height') == '%') {
        echo 'overflow-y:auto;';
        } else {
        echo 'overflow-y:hidden;';
        }
        ?> overflow-x: auto;
            height: 100%;
            width: 100%;
        }

        #itro_popup {
            visibility: hidden;
            opacity: 0;
            position: <?php echo ipp_itro_get_option('popup_position'); ?>;
            background-image: <?php
	    if (ipp_itro_get_option('background_select') != null) {
		echo 'url("' . ipp_itro_get_option('background_source') . '")';
	    }
	    ?>;
            background-repeat: no-repeat;
            background-position: center center;
            margin: 0 auto;
            left: 1px;
            right: 1px;
            z-index: 2147483647 !important;
        <?php
        if (ipp_itro_get_option('popup_padding') != null) {
        echo 'padding:' . ipp_itro_get_option('popup_padding') . 'px !important;';
        }
        ?> <?php
	    if (ipp_itro_get_option('auto_margin_check') == null) {
		if (ipp_itro_get_option('popup_top_margin') != null) {
		    echo 'top:' . ipp_itro_get_option('popup_top_margin') . 'px;';
		} else {
		    echo 'top: 0px;';
		}
	    }
	    if (ipp_itro_get_option('popup_border_color') != null) {
		echo 'border: solid;';
		echo 'border-color:' . ipp_itro_get_option('popup_border_color') . ';';
	    }
	    ?> border-radius: <?php echo ipp_itro_get_option('popup_border_radius'); ?>px;
            border-width: <?php echo ipp_itro_get_option('popup_border_width'); ?>px;
            width: <?php
	    if (ipp_itro_get_option('select_popup_width') == 'px') {
		echo ipp_itro_get_option('px_popup_width') . 'px';
	    }
	    if (ipp_itro_get_option('select_popup_width') == 'perc') {
		echo ipp_itro_get_option('perc_popup_width') . '%';
	    }
	    ?>;
            height: <?php
	    switch (ipp_itro_get_option('select_popup_height')) {
		case 'px':
		    echo ipp_itro_get_option('px_popup_height') . 'px';
		    break;
		case 'perc':
		    echo ipp_itro_get_option('perc_popup_height') . '%';
		    break;
		case 'auto':
		    echo 'auto';
		    break;
		default:
		    echo 'auto';
	    }
	    ?>;
            background-color: <?php echo ipp_itro_get_option('popup_background'); ?>;
        <?php
        if (ipp_itro_get_option('show_countdown') != null) {
        echo 'padding-bottom: 15px;';
        }
        ?>
        }

        #close_cross {
            cursor: pointer;
            width: 20px;
            position: absolute;
            top: -22px;
            right: -22px;
        }

        #popup_countdown {
            color: <?php echo ipp_itro_get_option('count_font_color') ?>;
            width: 100%;
            padding-top: <?php
	    if (ipp_itro_get_option('show_countdown') != 'yes') {
		echo '0px';
	    } else {
		echo '1px';
	    }
	    ?>;
            padding-bottom: <?php
	    if (ipp_itro_get_option('show_countdown') != 'yes') {
		echo '0px';
	    } else {
		echo '1px';
	    }
	    ?>;
            background-color: <?php echo ipp_itro_get_option('popup_border_color'); ?>;
            height: <?php
	    if (ipp_itro_get_option('show_countdown') != 'yes') {
		echo '0px';
	    }
	    ?>;
            overflow: hidden;
            position: absolute;
            bottom: 0px;
            left: 0px;
            border-bottom-left: <?php echo ipp_itro_get_option('popup_border_radius'); ?>px;
            border-bottom-right: <?php echo ipp_itro_get_option('popup_border_radius'); ?>px;
        }

        #itro_opaco {
            display: none;
            position: fixed;
            background-color: <?php echo ipp_itro_get_option('opaco_bg_color'); ?>;
            font-size: 10px;
            font-family: Verdana;
            top: 100px;
            width: 100%;
            height: 100%;
            z-index: 2147483646 !important;
            left: 0px;
            right: 0px;
            top: 0px;
            bottom: 0px;
            opacity: <?php echo ipp_itro_get_option('popup_bg_opacity'); ?>;
            filter: alpha(opacity= <?php echo ( ipp_itro_get_option('popup_bg_opacity') * 100); ?>); /* For IE8 and earlier */
        }

        /* label under the popup used to close it for mobile devices */
        #ipp_mobile_close_tab {
            display: none;
            border: none;
            position: absolute;
            padding: 5px;
            width: 80px;
            text-align: center;
            left: 1px;
            right: 1px;
            margin: auto;
            background-color: <?php echo (ipp_itro_get_option('popup_border_color') != null ? ipp_itro_get_option('popup_border_color') : 'white' ); ?>
        }

        #ipp_mobile_close_txt {
            font-weight: bold;
            cursor: pointer;
        }

        /* RESPONSIVE CSS */
        @media screen and (max-width: 780px) {
            #itro_popup {
                max-width: 470px;
            <?php
            if (ipp_itro_get_option('absolute_mobile_pos') == 'yes') {
                echo "position: absolute; top: 50px";
            }
            ?>
            }

            #close_cross {
                display: none;
            }

            #ipp_mobile_close_tab {
                display: block;
            }
        }

        @media screen and (max-width: 480px) {
            #itro_popup {
                max-width: 300px
            }
        }

        <?php
        if (ipp_itro_get_option('disable_mobile') == 'yes') {
            echo '
                @media screen and (max-width: 1024px)
                {
                    #itro_popup{display: none !important;}
                    #itro_opaco{display: none !important;}
                }';
        }
        ?>
    </style>
    <?php
}

?>