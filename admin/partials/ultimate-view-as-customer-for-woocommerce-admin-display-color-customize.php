<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.programmelab.com
 * @since      1.0.0
 *
 * @package    Ultimate_View_As_Customer_For_Woocommerce
 * @subpackage Ultimate_View_As_Customer_For_Woocommerce/admin/partials
 */
// If this file is called directly, abort.
if (!defined('ABSPATH')) exit;

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="ultimate-view-as-customer-for-woocommerce-settings-wrapper">
    <div class="ultimate-view-as-customer-for-woocommerce-settings-container">
        <section class="container-fluid">
            <div class="topbar-part bg-dark-blue">
                <div class="text-center">
                    <?php printf(
                        esc_html__('You\'re Using %1$s %2$s Free Version %3$s', 'ultimate-view-as-customer-for-woocommerce'),
                        '<strong>' . esc_html(ULTIMATE_VIEW_AS_CUSTOMER_FOR_WOOCOMMERCE_NAME) . '</strong>',
                        '<span class="d-inline-block text-lite-blue">',
                        '</span>'
                    ); ?>
                </div>
            </div>
        </section>
        <section class="container-fluid">
            <div class="header-part bg-lite-blue">
                <div class="row">
                    <div class="col-lg-9 left-header">
                        <div class="d-flex flex-column flex-lg-row align-items-center">
                            <img class="img-fluid" src="<?php echo esc_url(plugin_dir_url(__DIR__) . 'images/logo.svg') ?>" alt="<?php echo esc_html(ULTIMATE_VIEW_AS_CUSTOMER_FOR_WOOCOMMERCE_NAME . '-Logo') ?>">
                            <img class="img-fluid" src="<?php echo esc_url(plugin_dir_url(__DIR__) . 'images/programme-lab-logo.svg') ?>" alt="<?php echo esc_html('Programme-lab-Logo') ?>">
                            <ul class="list-inline">
                                <li class="list-inline-item"><a href="admin.php?page=ultimate-view-as-customer-for-woocommerce" class="welcome-link"><?php echo esc_html__('Settings', 'ultimate-view-as-customer-for-woocommerce') ?></a></li>
                                <li class="list-inline-item active"><a href="admin.php?page=ultimate-view-as-customer-for-woocommerce-color-customizer" class="color-customizer-link"><?php echo esc_html__('Color Customizer', 'ultimate-view-as-customer-for-woocommerce') ?></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 right-header text-center text-lg-end">
                        <ul class="list-inline">
                            <li class="list-inline-item"><a href="<?php echo esc_url("https://www.programmelab.com/") ?>" class="leanrmore-link" target="_blank"><?php echo esc_html__('Learn More', 'ultimate-view-as-customer-for-woocommerce') ?></a></li>
                            <li class="list-inline-item">
                                <a href="https://wordpress.org/support/plugin/ultimate-view-as-customer-for-woocommerce/reviews/#new-post" class="review-link" target="_blank">

                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_3319_11057)">
                                            <path d="M10 0C4.48598 0 0 4.48598 0 10C0 15.514 4.48598 20 10 20C15.514 20 20 15.514 20 10C20 4.48598 15.514 0 10 0ZM10 18.75C5.17523 18.75 1.25 14.8248 1.25 10C1.25 5.17523 5.17523 1.25 10 1.25C14.8248 1.25 18.75 5.17523 18.75 10C18.75 14.8248 14.8248 18.75 10 18.75ZM15.2678 13.0469C14.1751 14.9393 12.2059 16.0691 10.0002 16.0691C7.79434 16.0691 5.825 14.9393 4.73223 13.0469C4.55961 12.748 4.66199 12.3657 4.9609 12.1931C5.25988 12.0205 5.64211 12.1229 5.81465 12.4218C6.68148 13.9229 8.24617 14.8191 10.0001 14.8191C11.754 14.8191 13.3186 13.9229 14.1853 12.4218C14.3579 12.1229 14.7402 12.0205 15.0391 12.1931C15.338 12.3657 15.4404 12.7479 15.2678 13.0469ZM4.63586 7.53684C4.63586 6.8473 5.19684 6.28629 5.88641 6.28629C6.57598 6.28629 7.13695 6.84727 7.13695 7.53684C7.13695 8.22641 6.57598 8.78738 5.88641 8.78738C5.19684 8.78738 4.63586 8.22641 4.63586 7.53684ZM15.3642 7.53684C15.3642 8.22637 14.8032 8.78738 14.1136 8.78738C13.4241 8.78738 12.8631 8.22641 12.8631 7.53684C12.8631 6.84727 13.4241 6.28629 14.1136 6.28629C14.8032 6.28633 15.3642 6.8473 15.3642 7.53684Z" fill="white" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_3319_11057">
                                                <rect width="20" height="20" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="container-fluid">
            <div class="content-part">
                <div class="row justify-content-md-center">
                    <div class="col-lg-8">
                        <div class="wrapper">
                            <div class="content-header-part">
                                <h4><?php echo sprintf(esc_html__('Customize The Customer Switcher Design', 'ultimate-view-as-customer-for-woocommerce')) ?></h4>
                                <p><?php echo sprintf(esc_html__('Specify the colors of the background of the frontend admin switcher as well as the text color. Also select specific color that you want to set for the switch button, button text and more.', 'ultimate-view-as-customer-for-woocommerce')) ?></p>
                            </div>
                            <div class="content-form-part">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <form class="ultimate-view-as-customer-for-woocommerce-options" method="post">
                                            <?php wp_nonce_field('ultimate_view_as_customer_for_woocommerce_form_action', 'ultimate_view_as_customer_for_woocommerce_form_field'); ?>
                                            <input type="hidden" class="ultimate-view-as-customer-for-woocommerce-option-name" value="ultimate_view_as_customer_for_woocommerce_api_settings">
                                            <?php
                                            $ultimate_view_as_customer_for_woocommerce_api_settings = get_option('ultimate_view_as_customer_for_woocommerce_api_settings') ? get_option('ultimate_view_as_customer_for_woocommerce_api_settings') : [];
                                            // var_dump($ultimate_view_as_customer_for_woocommerce_api_settings);
                                            ?>
                                            <div class="ultimate-view-as-customer-for-woocommerce-setting-unit color-setting-unit">
                                                <div class="title-wrap">
                                                    <label class="position-relative text-label">
                                                        <?php echo sprintf(esc_html__('Color Customizer', 'ultimate-view-as-customer-for-woocommerce')) ?>
                                                        <span class="tooltip hint--bottom" aria-label="<?php echo sprintf(esc_html__('Select from the color picker to apply on the frontend bar.', 'ultimate-view-as-customer-for-woocommerce')) ?>"><i class="dashicons dashicons-editor-help"></i></span>
                                                    </label>
                                                    <div class="description">
                                                        <p><?php echo sprintf(esc_html__('Select from the color picker and set the designof the frontend bar to your liking.', 'ultimate-view-as-customer-for-woocommerce')) ?></p>
                                                    </div>
                                                </div>
                                                <div class="position-relative color">
                                                    <div class="d-flex gap-22">
                                                        <div class="color-unit">
                                                            <label class="control-label" for="ultimate_view_as_customer_for_woocommerce_api_settings_bar_background_color"><?php echo esc_html__('Bar Background Color', 'ultimate-view-as-customer-for-woocommerce') ?></label>
                                                            <div class="color-box">
                                                                <input class="ultimate_view_as_customer_for_woocommerce_api_settings_input color-input" type="color" name="ultimate_view_as_customer_for_woocommerce_api_settings[color-customizer][bar_background_color]" data-name="color-customizer.bar_background_color" id="ultimate_view_as_customer_for_woocommerce_api_settings_bar_background_color" value="<?php echo (isset($ultimate_view_as_customer_for_woocommerce_api_settings["color-customizer"]["bar_background_color"]) && $ultimate_view_as_customer_for_woocommerce_api_settings["color-customizer"]["bar_background_color"]) ? esc_html($ultimate_view_as_customer_for_woocommerce_api_settings["color-customizer"]["bar_background_color"]) : '#002340' ?>">
                                                                <span><?php echo (isset($ultimate_view_as_customer_for_woocommerce_api_settings["color-customizer"]["bar_background_color"]) && $ultimate_view_as_customer_for_woocommerce_api_settings["color-customizer"]["bar_background_color"]) ? esc_html($ultimate_view_as_customer_for_woocommerce_api_settings["color-customizer"]["bar_background_color"]) : '#002340' ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="color-unit">
                                                            <label class="control-label" for="ultimate_view_as_customer_for_woocommerce_api_settings_bar_text_color"><?php echo esc_html__('Bar Text Color', 'ultimate-view-as-customer-for-woocommerce') ?></label>
                                                            <div class="color-box">
                                                                <input class="ultimate_view_as_customer_for_woocommerce_api_settings_input color-input" type="color" name="ultimate_view_as_customer_for_woocommerce_api_settings[color-customizer][bar_text_color]" data-name="color-customizer.bar_text_color" id="ultimate_view_as_customer_for_woocommerce_api_settings_bar_text_color" value="<?php echo (isset($ultimate_view_as_customer_for_woocommerce_api_settings["color-customizer"]["bar_text_color"]) && $ultimate_view_as_customer_for_woocommerce_api_settings["color-customizer"]["bar_text_color"]) ? esc_html($ultimate_view_as_customer_for_woocommerce_api_settings["color-customizer"]["bar_text_color"]) : '#ffffff' ?>">
                                                                <span><?php echo (isset($ultimate_view_as_customer_for_woocommerce_api_settings["color-customizer"]["bar_text_color"]) && $ultimate_view_as_customer_for_woocommerce_api_settings["color-customizer"]["bar_text_color"]) ? esc_html($ultimate_view_as_customer_for_woocommerce_api_settings["color-customizer"]["bar_text_color"]) : '#ffffff' ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="color-unit">
                                                            <label class="control-label" for="ultimate_view_as_customer_for_woocommerce_api_settings_button_background_color"><?php echo esc_html__('Button Color', 'ultimate-view-as-customer-for-woocommerce') ?></label>
                                                            <div class="color-box">
                                                                <input class="ultimate_view_as_customer_for_woocommerce_api_settings_input color-input" type="color" name="ultimate_view_as_customer_for_woocommerce_api_settings[color-customizer][button_background_color]" data-name="color-customizer.button_background_color" id="ultimate_view_as_customer_for_woocommerce_api_settings_button_background_color" value="<?php echo (isset($ultimate_view_as_customer_for_woocommerce_api_settings["color-customizer"]["button_background_color"]) && $ultimate_view_as_customer_for_woocommerce_api_settings["color-customizer"]["button_background_color"]) ? esc_html($ultimate_view_as_customer_for_woocommerce_api_settings["color-customizer"]["button_background_color"]) : '#0167FF' ?>">
                                                                <span><?php echo (isset($ultimate_view_as_customer_for_woocommerce_api_settings["color-customizer"]["button_background_color"]) && $ultimate_view_as_customer_for_woocommerce_api_settings["color-customizer"]["button_background_color"]) ? esc_html($ultimate_view_as_customer_for_woocommerce_api_settings["color-customizer"]["button_background_color"]) : '#0167FF' ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="color-unit">
                                                            <label class="control-label" for="ultimate_view_as_customer_for_woocommerce_api_settings_button_text_color"><?php echo esc_html__('Button Text Color', 'ultimate-view-as-customer-for-woocommerce') ?></label>
                                                            <div class="color-box">
                                                                <input class="ultimate_view_as_customer_for_woocommerce_api_settings_input color-input" type="color" name="ultimate_view_as_customer_for_woocommerce_api_settings[color-customizer][button_text_color]" data-name="color-customizer.button_text_color" id="ultimate_view_as_customer_for_woocommerce_api_settings_button_text_color" value="<?php echo (isset($ultimate_view_as_customer_for_woocommerce_api_settings["color-customizer"]["button_text_color"]) && $ultimate_view_as_customer_for_woocommerce_api_settings["color-customizer"]["button_text_color"]) ? esc_html($ultimate_view_as_customer_for_woocommerce_api_settings["color-customizer"]["button_text_color"]) : '#ffffff' ?>">
                                                                <span><?php echo (isset($ultimate_view_as_customer_for_woocommerce_api_settings["color-customizer"]["button_text_color"]) && $ultimate_view_as_customer_for_woocommerce_api_settings["color-customizer"]["button_text_color"]) ? esc_html($ultimate_view_as_customer_for_woocommerce_api_settings["color-customizer"]["button_text_color"]) : '#ffffff' ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="help-text">
                                                    <?php printf(
                                                        esc_html__(
                                                            '%1$sNote :%2$s Select a color from the color picker and set it to your desired area. See on the frontend to see the updates.',
                                                            'ultimate-view-as-customer-for-woocommerce'
                                                        ),
                                                        '<strong>',
                                                        '</strong>'
                                                    ); ?>
                                                </div>
                                            </div>
                                            <?php
                                            //submit_button();
                                            $actual_link = '';
                                            if (isset($_SERVER['HTTP_HOST']) && isset($_SERVER['REQUEST_URI']))
                                                $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . '://' . sanitize_text_field(wp_unslash($_SERVER['HTTP_HOST'])) . sanitize_text_field(wp_unslash($_SERVER['REQUEST_URI']));
                                            ?>
                                            <div class="btn-group" role="group">
                                                <button id="settings-reset" type="button" class="btn btn-secondary" data-tab="color-customizer" data-redirect="<?php echo esc_url($actual_link) ?>"><?php echo esc_html__('Reset to Default', 'ultimate-view-as-customer-for-woocommerce') ?></button>
                                                <button type="submit" class="btn btn-primary"><?php echo esc_html__('Save', 'ultimate-view-as-customer-for-woocommerce') ?></button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-lg-4">
                                        <svg viewBox="0 0 258 258" xmlns="http://www.w3.org/2000/svg">
                                            <path d="m49.171 49.927-2.3878-2.2369c-0.1426-0.1374-0.2258-0.3252-0.2316-0.5232-0.0057-0.198 0.0663-0.3904 0.2007-0.5359l3.0237-3.1747c0.1354-0.1335 0.3148-0.2132 0.5046-0.2244 0.1898-0.0111 0.3773 0.0471 0.5274 0.1638l2.3543 2.0511c0.1468 0.1334 0.2354 0.3191 0.2467 0.5171 0.0114 0.1981-0.0555 0.3927-0.1861 0.542l-2.967 3.354c-0.139 0.1461-0.328 0.2342-0.5293 0.2466-0.2012 0.0124-0.3997-0.0517-0.5556-0.1795z" fill="#E8354C" />
                                            <path d="m55.493 56.369-2.3878-2.2382c-0.1426-0.1372-0.2257-0.3248-0.2315-0.5225-0.0058-0.1978 0.0662-0.39 0.2005-0.5353l3.0238-3.1747c0.1353-0.1337 0.3146-0.2136 0.5045-0.2248 0.19-0.0111 0.3775 0.0472 0.5275 0.1642l2.3542 2.0601c0.1468 0.1332 0.2353 0.3187 0.2467 0.5165 0.0113 0.1979-0.0555 0.3923-0.186 0.5413l-2.9671 3.354c-0.1398 0.1453-0.3294 0.2321-0.5307 0.2432-0.2013 0.011-0.3993-0.0547-0.5541-0.1838z" fill="#191919" />
                                            <path d="m61.812 62.778-2.389-2.2368c-0.1422-0.1378-0.2249-0.3257-0.2304-0.5235-0.0056-0.1979 0.0665-0.3901 0.2007-0.5356l3.0238-3.1747c0.1354-0.1335 0.3147-0.2133 0.5046-0.2244 0.1898-0.0112 0.3772 0.047 0.5274 0.1638l2.3581 2.0562c0.1468 0.1334 0.2354 0.3191 0.2467 0.5172 0.0114 0.198-0.0554 0.3926-0.1861 0.5419l-2.967 3.354c-0.0652 0.079-0.146 0.1436-0.2373 0.1899-0.0914 0.0462-0.1913 0.0731-0.2935 0.0789-0.1023 0.0059-0.2046-0.0095-0.3006-0.0451s-0.1836-0.0907-0.2574-0.1618z" fill="#0167FF" />
                                            <path d="m213.57 161.05c6.771 1.519 13.644 2.54 20.564 3.055 3.263 0.225 3.026 0.737-1.784 1.057-5.535 0.201-11.076-0.153-16.54-1.057-0.221 1.957-0.332 3.925-0.332 5.895 10.643 3.115 28.422 0.213 31.718-0.363 0.845-5.211 0.963-7.209 1.24-7.408 0.211-0.12 0.335 8.467 0.272 9.159-0.656 7.344-2.73 14.491-6.108 21.045-3.448 6.603-15.85 6.606-23.252 3.296-0.597-0.259-1.135-0.637-1.582-1.11s-0.794-1.031-1.019-1.642c-3.615-11.269-5.209-20.408-3.177-31.927zm4.263 25.369c1.651 5.333 2.193 6.765 7.591 7.892 4.283 0.854 8.72 0.466 12.79-1.118 1.983-0.759 3.66-5.613 4.232-7.135 1.97-4.694 3.45-9.579 4.415-14.577-0.12 0.665-8.829 1.203-9.616 1.27-7.14 0.607-14.816 0.968-21.77-0.937 0.132 4.951 0.925 9.863 2.358 14.605z" fill="#191919" />
                                            <path d="m235.13 133.62c0.14 3.07 0.01 6.146-0.387 9.193-1.385 11.759-2.797 17.415-3.235 12.642-1.098-11.963 3.601-26.351-4.718-35.166-2.978-3.157-5.584-2.718-5.744-3.354-0.172-0.516 3.551-1.33 7.166 1.481 3.342 2.605 6.491 8.026 6.918 15.204z" fill="#191919" />
                                            <path d="m229.3 134.26-0.726 0.241c-8.562 2.855-17.286-2.58-18.051-12.215 9.613-2.218 17.088 3.529 18.777 11.974zm-15.814-10.707 13.485 8.617c-0.976-2.726-2.83-5.051-5.271-6.611-2.441-1.559-5.33-2.263-8.214-2.003v-3e-3zm13.123 9.706-14-8.919c0.328 1.508 0.951 2.936 1.834 4.202s2.007 2.344 3.308 3.173c1.302 0.83 2.755 1.393 4.275 1.659 1.52 0.265 3.078 0.227 4.583-0.112v-3e-3z" fill="#191919" />
                                            <path d="m236.16 122.53c-6.797-6.797-5.73-16.936 2.967-22.073l0.453 0.605c9.107 11.756-3.35 21.339-3.42 21.468zm-0.272-2.873 2.207-16.448c-1.229 0.932-2.261 2.098-3.038 3.431-0.776 1.332-1.281 2.805-1.487 4.334-0.205 1.529-0.106 3.083 0.292 4.573s1.086 2.887 2.026 4.11zm3.326-15.996-2.147 15.844c2.054-2.035 3.377-4.691 3.765-7.556 0.389-2.865-0.18-5.779-1.618-8.288z" fill="#191919" />
                                            <path d="m121.56 219.32 23.736-29.18c0.282-0.372 0.642-0.679 1.055-0.898 0.412-0.219 0.868-0.346 1.334-0.371h45.719c0.717-0.049 1.427 0.167 1.996 0.605 11.419 9.941 19.709 16.783 28.211 24.582 0.095 0.08 0.164 0.186 0.198 0.305 0.033 0.119 0.031 0.246-9e-3 0.363-0.039 0.118-0.112 0.221-0.211 0.296-0.098 0.075-0.217 0.118-0.341 0.125-55.375 1.402-31.402 3.354-101.2 5.11-0.11 3e-3 -0.219-0.025-0.314-0.081s-0.172-0.137-0.223-0.235c-0.05-0.098-0.072-0.208-0.063-0.318 0.01-0.11 0.05-0.215 0.116-0.303zm29.21-9.435c-3.303 2.503 15.571 1.063 18.505 1.361 13.212 1.347 1.633 3.18 8.829 3.599 1.572 0.092 20.756 0.266 22.466-4.717 0.748-2.18-8.95-7.527-6.198-7.62 8.709-0.294-6.261-3.467-16.057-4.989-18.931-2.942-22.132-4.627-26.76 0-2.297 2.298-4.168 3.483-8.738 8.043-1.801 1.797 13.718-0.045 7.953 4.323zm-21.076 4.144c0.085 0.076 0.185 0.133 0.294 0.168s0.224 0.048 0.337 0.036c0.114-0.011 0.224-0.046 0.324-0.102 0.099-0.056 0.186-0.132 0.255-0.224l17.054-20.32c0.136-0.185 0.313-0.336 0.518-0.441 0.204-0.105 0.431-0.161 0.661-0.162l41.637-1.179c0.223-0.012 0.434-0.11 0.586-0.274 0.153-0.164 0.236-0.38 0.232-0.604s-0.095-0.437-0.253-0.595c-0.159-0.158-0.372-0.249-0.596-0.252l-41.636 1.18c-0.484 4e-3 -0.959 0.121-1.39 0.342-0.43 0.22-0.803 0.538-1.089 0.928l-17.028 20.32c-0.073 0.083-0.128 0.179-0.163 0.284-0.034 0.105-0.048 0.215-0.039 0.325s0.039 0.217 0.09 0.315 0.121 0.184 0.206 0.255z" fill="#0167FF" />
                                            <path d="m155.54 196.49c1.692-0.76 4.596 0.425 6.351 0.756 7.3 1.379 15.282 3.441 22.406 5.533 2.541 0.747 5.049 0.998 6.984 2.933 1.149 1.15 2.418 2.268 3.483 3.508-2.803 0.629-5.657 1.003-8.527 1.118-2.836-0.142-5.662-0.435-8.467-0.877-6.831-0.611-13.603-1.764-20.253-3.447-1.297-0.369-3.716-0.818-4.293-2.237-1.426-3.48 0.106-6.295 2.316-7.287zm32.807 11.702 1.664-0.454c-1.032-1.068-1.249-1.41-2.056-1.632-10.739-2.967-19.715-5.111-25.309-6.411-0.731 0.554-1.284 1.311-1.59 2.176-0.307 0.865-0.353 1.801-0.133 2.692 7.467 1.597 24.66 3.76 27.424 3.629zm-33.139-5.382c1.015 0.631 2.146 1.053 3.326 1.24-0.142-1.753 0.34-3.498 1.361-4.93-1.127-0.299-2.282-0.481-3.447-0.544-0.709 0.414-1.232 1.083-1.463 1.87-0.23 0.788-0.15 1.633 0.223 2.364z" fill="#191919" />
                                            <path d="m6.7449 78.109c0.129-0.2412 25.071-31.282 28.001-34.924 1.1185-1.3906 2.5994-2.9321 4.3538-2.6006-2.5865 2.6638-2.4033 2.62-24.885 45.447l14.577 0.903c5.4128-10.826 10.825-21.662 16.237-32.508-2.0859-2.8122-4.2028-5.6541-6.2887-8.4663 0.8153-1.032 1.6628-2.0562 2.4794-3.0844 0.3463 0.4972 0.4919 1.1068 0.4077 1.7068s-0.3921 1.1459-0.8618 1.5285c7.62 8.7385 15.48 17.24 23.283 25.822 0.1011 0.1492 0.2351 0.2733 0.3916 0.3628 0.1565 0.0894 0.3315 0.1418 0.5114 0.1532 0.476-0.0465 0.4089-0.1703 4.475-4.0816 1.0939-1.0526 2.4149-0.4566 1.419 0.9366-1.193 1.4532-2.5418 2.7713-4.0222 3.9306-2.8148 2.4678-3.354 0.6011-10.613-7.3169-1.4513 3.1747-1.0475 6.8641-0.903 10.341 0.0425 1.0824-0.645 2.0434-1.419 1.0591-1.4031-1.9115-2.0796-4.2601-1.9085-6.6251 0.1712-2.365 1.1788-4.5917 2.8424-6.2813-2.7516-3.0534-5.5328-6.0772-8.2844-9.1319-17.31 34.622-16.191 32.78-16.899 33.171-0.7082 0.3909-0.5908 0.1948-15.572-0.7559-1.8395-0.1174-2.113-1.0501-1.2706-2.6316 0.8011-1.5041 1.6035-2.9928 2.3891-4.5047-2.3581-0.1509-4.7163-0.2773-7.1053-0.4231-1.6099-0.0968-1.9647-0.8308-1.3352-2.0253zm9.3138 0.8166 15.027-28.447-22.557 28.03 7.5297 0.4167z" fill="#191919" />
                                            <path d="m111.25 42.913c0.605-1.5415 1.119-2.3581 1.332-2.3581 0.461 0-0.217 3.0199-0.545 6.5016 0.876-1.4822 8.425-3.9603 8.89 2.5993 0.147 2.0873-1.813-4.6956-7.56-0.574-0.334 0.2399-1.179-0.0903-1.482-0.756-0.059 0.4838-0.085 0.9675-0.12 1.5119-0.471 7.1415-1.689 14.577 1.632 21.257 3.435 6.9157 12.779 10.621 24.825 2.838 3.096-1.9982 3.306-1.6615 1.059 0.756-8.447 9.0893-22.68 8.3373-28.152-0.9366-4.4-7.4587-2.993-15.92-1.663-24.008 0.361-2.3318 0.958-4.6205 1.784-6.8306z" fill="#191919" />
                                            <path d="m48.053 81.587c-5.5961-6.3094-2.7439-14.943-1.5119-11.944 0.3457 0.841 0.6347 2.4187 1.21 4.2028 1.2065 3.4604 2.9737 6.699 5.231 9.586 0.516 0.8462 0.4231 1.33-0.605 1.0875-1.7045-0.5182-3.212-1.5405-4.3241-2.9322z" fill="#191919" />
                                            <path d="m170.91 153.16c-6.24-0.141-12.465 0.696-18.447 2.48-9.804 2.751-15.121 5.7-18.506 6.772-2.087 0.661-2.508 0.365-0.786-0.997 3.047-2.38 6.392-4.353 9.949-5.867 7.087-2.926 14.888-5.464 22.949-4.596 0-0.242 0.076 2.451 1.935-22.526 0.024-0.227 0.134-0.436 0.309-0.583s0.4-0.22 0.628-0.204c0.113 8e-3 0.224 0.04 0.326 0.092 0.101 0.052 0.191 0.124 0.265 0.211 0.073 0.087 0.128 0.189 0.162 0.298 0.033 0.109 0.045 0.223 0.034 0.337-1.818 24.47-1.883 22.301-2.025 22.584 3.561 0.566 6.795 1.944 3.207 1.999z" fill="#191919" />
                                            <path d="m128.76 56.943c-0.544-0.0297-0.938-0.8463-0.877-1.7841s0.575-1.677 1.119-1.6318c1.375 0.1096 1.046 3.4881-0.242 3.4159z" fill="#191919" />
                                            <path d="m115.3 53.799c0.061-0.9675 0.573-1.7093 1.149-1.6641 0.577 0.0451 0.968 0.8475 0.903 1.815-0.064 0.9675-0.574 1.7234-1.149 1.6628s-0.964-0.8462-0.903-1.8137z" fill="#191919" />
                                            <path d="m136.07 51.411c0.041 0.2611 2e-3 0.5287-0.114 0.7665s-0.301 0.4343-0.532 0.563-0.496 0.1832-0.759 0.1563-0.512-0.134-0.712-0.3067c-3.288-6.232-8.052-1.1855-6.984-2.967 3.354-5.5793 8.98 0.0941 9.101 1.7879z" fill="#191919" />
                                            <path d="m122.22 63.233c-1.239-0.062-4.414-1.6938-4.475-2.8729-0.06-1.179 3.236-6.6822 3.236-6.6822 0.756 0.8463-1.419 6.3494-1.271 6.561 0.148 0.2115 2.51 0.6359 2.994 0.8475 0.453 0.2412 0.725 2.2059-0.484 2.1466z" fill="#191919" />
                                            <path d="m126.34 66.711c0.149-0.1027 0.329-0.1515 0.51-0.1384 0.181 0.013 0.353 0.0871 0.486 0.2102 0.133 0.123 0.221 0.2877 0.249 0.4671 0.027 0.1793-7e-3 0.3628-0.097 0.5202-0.423 1.1481-5.137 4.3228-6.289 0.0903-0.363-1.33 1.829 2.7309 5.141-1.1494z" fill="#191919" />
                                            <path d="m39.735 37.864 1.6629-1.548c0.3951-0.2364 0.8439-0.3687 1.3041-0.3845 0.4603-0.0158 0.917 0.0854 1.3274 0.2942l-2.4793 2.2679c0.1444-0.1458 1.5802 1.2642 1.8434 1.6331l1.8756-2.3581c0.3157 0.6008 0.5495 1.2412 0.6953 1.904 0 0.0439-1.6628 2.0266-1.6331 2.0563 0.3354 0.9339 0.6153 2.8302-0.3328 3.114-0.1384 0.0392-0.2842 0.044-0.4249 0.0139-0.1406-0.03-0.2718-0.094-0.382-0.1863-0.1103-0.0924-0.1963-0.2102-0.2506-0.3434s-0.0752-0.2776-0.0609-0.4207c0.4553-2.9993-3.087-5.4412-6.192-4.1422-0.3084 0.1196-0.5871 0.3049-0.8166 0.5431-0.1031 0.1172-0.2369 0.2033-0.3863 0.2486-0.1494 0.0452-0.3085 0.0479-0.4593 0.0077s-0.2874-0.1217-0.3944-0.2354-0.1802-0.2549-0.2113-0.4079c-0.0321-0.1314-0.0323-0.2685-7e-4 -0.4 0.0317-0.1315 0.0943-0.2535 0.1826-0.3559 0.5608-0.5197 1.2252-0.9148 1.9496-1.1594 0.7243-0.2445 1.4922-0.333 2.2532-0.2596 0.9404 0.0167 0.8011 0.2476 0.9301 0.1186z" fill="#191919" />
                                            <path d="m17.394 117.54 35.167 3.476c-0.1097-2.193 0.387-18.878 1.5725-25.277-3.6208-1.4923-6.8042-3.8782-9.2526-6.9348s-4.0819-6.6841-4.7478-10.543c-0.2851-2.0846-0.0606-3.2353 0.0903-3.2353 0.2425 0 0.4232 1.0888 1.1494 3.2353 1.1614 3.7274 3.24 7.1036 6.0451 9.8191 2.8052 2.7154 6.2471 4.6832 10.01 5.7229-1.032 8.1265-1.6242 25.372-1.5416 27.576l32.838 3.205c-16.629-30.325-17.73-35.516-17.841-35.74 1.3557-0.7805 7.482 0.6643 9.6156-7.5594 0.5425-2.2326 0.4269-4.5745-0.3328-6.7428-2.162-6.579-8.1941-10.572-8.1941-11.369 0.0297-0.2116 0.9972 0.1819 2.8729 1.4809 0-0.436 0.0877-0.4063 2.2678-2.3878 0.1922-0.2889 1.7828 1.1378-28.272-22.833 0.0929 0.1871-0.1561 0.8863-0.9675 0.8759-0.1133-0.0107-0.2232-0.045-0.3226-0.1007-0.0994-0.0556-0.186-0.1314-0.2544-0.2225-0.0683-0.0911-0.1169-0.1954-0.1426-0.3064-0.0258-0.1109-0.028-0.226-0.0066-0.3379 0.069-0.8623-0.1365-1.7244-0.5872-2.4629-0.4507-0.7384-1.1234-1.3154-1.9219-1.6483-0.7284-0.3083-1.5249-0.4202-2.3101-0.3247s-1.5316 0.3952-2.1649 0.8691c-0.106 0.117-0.2428 0.2018-0.3947 0.2447-0.152 0.0428-0.3129 0.0421-0.4644-0.0022-0.1516-0.0442-0.2876-0.1303-0.3925-0.2482-0.105-0.118-0.1746-0.2631-0.2009-0.4187-0.0253-0.129-0.0193-0.2621 0.0175-0.3883 0.0368-0.1261 0.1034-0.2416 0.194-0.3367 1.3868-1.548 3.9668-1.677 5.7457-1.21 0.8764 0.2659 1.6806 0.7283 2.3512 1.352 0.6707 0.6237 1.1901 1.3922 1.5188 2.2471l29.603 23.619c0.2008 0.1686 0.3664 0.3751 0.4872 0.6078s0.1946 0.487 0.217 0.7482c0.0224 0.2613-7e-3 0.5244-0.0864 0.7742-0.0795 0.2499-0.2074 0.4816-0.3766 0.682-2.5155 2.3336-2.024 1.9505-2.451 2.0562 11.94 9.4815 8.127 22.928-0.6656 26.004 0.6347 1.6331 15.724 31.205 16.842 33.473l25.432 2.514c1.121 0.112 2.165 0.622 2.941 1.438 0.777 0.815 1.235 1.883 1.292 3.007 0 0 2.933 50.163 2.933 50.194 4.597 0.212 9.526 1.384 14.847 1.784 22.256 1.668 48.901-5.922 59.356-27.515 13.325-27.528-7.534-56.011-36.678-63.045 0 1.0411-6.857 13.938-20.017 13.938-7.876 0-14.938-3.586-17.78-10.793-14.735 4.4302-15.9 4.8012-27.788 14.665-2.0833 1.727-2.6303 1.662-1.0887-0.666 5.8664-8.859 15.032-13.528 25.036-16.237 2.662-0.7211 5.473-0.8746 8.133-1.6331 4.447-1.2668 3.811-3.0277 3.508-7.3776-0.025-0.3637-0.174-3.3011 0.696-2.1775 0.608 0.9914 0.98 2.1088 1.088 3.2663 0.31 1.6306 0.988 3.2934 0.666 4.9588-0.375 1.935-1.861 2.549-3.538 3.114-1.35 0.4554-4.807 1.4822-5.05 1.5725 1.12 2.8122 4.807 9.0929 15.27 9.5549 12.971 0.572 18.808-11.521 19.261-12.579-6.055-1.2978-8.205-0.4283-10.22-1.966-0.954-0.9272-1.526-2.1788-1.603-3.5075-0.703-3.6623-2.304-14.448-2.691-16.146-0.53-2.322-1.325-6.1275 0.938-6.8641 0.555-0.1305 1.123-0.2015 1.694-0.2116 4.12-0.5753 5.984-7.3414 1.087-8.4056-3.176-0.6915-4.062-0.3703-4.837 0.8152-2.24 3.4276-4.808 4.0829-5.504-0.8759 0 0-2.479-15.271-12.396-19.202-6.563-2.5994-12.771-0.0503-16.178 1.966-1.062 0.6282-1.636-0.3316-1.904-1.548-1.378-6.192 17.627-26.519 33.835-11.278 0 0-12.338-16.027-3.962-15.845s5.654 8.8894 5.654 8.8894 2.722-8.1941 10.766-4.257c8.043 3.9371 3.084 10.578 3.084 10.578s7.166-7.6794 11.944 0.6953-6.321 10.578-6.321 10.578 8.928-1.032 6.837 7.1066c-0.475 1.7395-1.333 3.3509-2.51 4.7163-2.276 2.709-8.859-0.3329-12.513-6.8641 1.452 3.1153 4.204 11.037-1.935 16.691 0.242 0.9108 0.28 1.864 0.11 2.7912-0.169 0.9271-0.542 1.8052-1.091 2.5713-0.549 0.766-1.261 1.401-2.085 1.8593-0.823 0.4584-1.738 0.7287-2.679 0.7917-0.665 0.0593-1.076 0.0696-0.423 2.54 1.032 3.9074 3.447 19.079 3.991 20.168 1.015 0.3644 2.071 0.5981 3.144 0.6953 36.511 2.8909 64.872 39.338 44.955 72.03-11.61 19.07-36.461 27.173-59.688 24.825-5.805-0.587-10.795-1.935-15.239-2.358l0.665 11.157c0.035 0.68-0.077 1.36-0.326 1.993-0.25 0.634-0.633 1.206-1.123 1.679s-1.076 0.835-1.718 1.063c-0.642 0.227-1.325 0.314-2.004 0.255l-26.004-2.419c0.0903 5.926 1.0024 19.469 6.7425 27.273 4.358 5.925 14.393 10.047 23.374 9.647 3.461-0.06 6.86-0.928 9.926-2.534 3.066-1.607 5.714-3.908 7.733-6.719-15.51 0.464-19.276 0.242-20.078 0.242 0.431-3.154 0.715-6.909 1.148-1.361 30.675-3.577 119.56-6.553 96.246-3.538-15.163 1.966-59.727 4.178-75.23 4.596-2.252 3.5-5.371 6.358-9.053 8.297s-7.803 2.893-11.963 2.77c-9.252 0-18.963-4.235-23.493-10.372-6.192-8.377-7.0459-22.435-7.1066-28.452l-12.094-1.12c0.0296-0.09-0.3329-16.297-1.361-19.23-1.0281-2.932-2.0794 0.756-2.3594 8.256-0.1174 3.175 2.3891 48.682 2.3891 48.682l28.638 3.659c0.33 0.037 0.641 0.172 0.892 0.389 0.252 0.217 0.432 0.505 0.517 0.825 0.085 0.321 0.071 0.66-0.041 0.973-0.111 0.313-0.314 0.585-0.582 0.78l-6.592 5.049c-0.174 0.135-0.374 0.234-0.586 0.291-0.213 0.057-0.436 0.072-0.654 0.042l-62.863-8.557c-0.3552-0.045-0.6863-0.204-0.944-0.453-0.2577-0.248-0.4282-0.574-0.4862-0.927-0.0579-0.353-3e-4 -0.716 0.1644-1.034s0.4277-0.574 0.7498-0.731c9.1371-4.631 8.7565-4.538 9.4351-4.414l17.114 2.177-2.2085-37.525-41.395-3.84c-1.1278-0.101-2.1811-0.606-2.9648-1.423-0.7838-0.818-1.2451-1.891-1.2986-3.022l-3.7797-63.8c-0.0646-0.68 0.0229-1.367 0.2561-2.009 0.2332-0.643 0.6063-1.226 1.0923-1.707s1.0728-0.847 1.7179-1.074c0.6452-0.226 1.3325-0.306 2.0124-0.234zm123.16-91.8c-0.94-0.7748-2.002-1.3882-3.144-1.8151-1.666-0.642-3.419-1.0294-5.201-1.1493-7.693-0.6631-15.738 4.644-18.052 9.675-0.679 1.4757-0.357 1.8821 0.967 1.032 4.424-2.8471 10.707-9.3358 24.639-6.561 1.576 0.3096 2.046-0.0168 0.791-1.1816zm-67.308 107.89c31.144 2.495 33.433 1.709 36.104 3.024 1.935 0.816 2.749 2.752 3.023 5.08 0.119 1.004 1.548 31.887 2.601 17.084 0.237-3.309 0.645-14.857 0.332-17.931-0.843-8.436-7.335-8.514-15.33-9.04-70.376-4.638-70.922-1.756-26.73 1.783z" fill="#191919" />
                                        </svg>

                                    </div>
                                </div>
                            </div>
                            <?php include_once(ULTIMATE_VIEW_AS_CUSTOMER_FOR_WOOCOMMERCE_PATH . 'admin/partials/ultimate-view-as-customer-for-woocommerce-admin-footer.php') ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>