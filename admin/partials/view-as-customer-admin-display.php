<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.programmelab.com
 * @since      1.0.0
 *
 * @package    View_As_Customer
 * @subpackage View_As_Customer/admin/partials
 */
// If this file is called directly, abort.
if (!defined('ABSPATH')) exit;

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="view-as-customer-settings-wrapper">
    <div class="view-as-customer-settings-container">
        <section class="container-fluid">
            <div class="topbar-part bg-dark-blue">
                <div class="text-center">

                    <?php printf(
                        esc_html__('You\'re Using %1$s %2$s Free Version %3$s', 'view-as-customer'),
                        '<strong>' . esc_html(VIEW_AS_CUSTOMER_NAME) . '</strong>',
                        '<span class="d-inline-block text-lite-blue">',
                        '</span>'
                    ); ?>
                </div>
            </div>
        </section>
        <section class="container-fluid">
            <div class="header-part bg-lite-blue">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="d-flex flex-column flex-lg-row align-items-center">
                            <img class="img-fluid" src="<?php echo esc_url(plugin_dir_url(__DIR__) . 'images/logo.svg') ?>" alt="<?php echo esc_html(VIEW_AS_CUSTOMER_NAME . '-Logo') ?>">
                            <img class="img-fluid" src="<?php echo esc_url(plugin_dir_url(__DIR__) . 'images/programme-lab-logo.svg') ?>" alt="<?php echo esc_html('Programme-lab-Logo') ?>">
                            <ul class="list-inline">
                                <li class="list-inline-item"><a href="#" class="welcome-link"><?php echo esc_html__('Welcome', 'view-as-customer') ?></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 text-center text-lg-end">
                        <ul class="list-inline">
                            <li class="list-inline-item"><a href="<?php echo esc_url("https://www.programmelab.com/") ?>" class="leanrmore-link" target="_blank"><?php echo esc_html__('Learn More', 'view-as-customer') ?></a></li>
                            <li class="list-inline-item">
                                <a href="#" class="review-link">

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
                <div class="row">
                    <div class="col-lg-4 offset-lg-1 area-content">
                        <div class="content-header text-center d-flex justify-content-center align-items-center">
                            <div class="wrapper">
                                <h4><?php echo sprintf(esc_html__('View Your Store from Customer\'s Perspective.', 'view-as-customer')) ?></h4>
                                <p><?php echo sprintf(esc_html__('Ultimate View as Customer for WooCommerce WooCommerce plugin allows store admins to view their stores from a specific customer\'s perspective and act as that customer. It helpful for a variety of customer support issues.', 'view-as-customer')) ?></p>
                            </div>
                        </div>
                        <form class="view-as-customer-options" method="post">
                            <?php wp_nonce_field('view_as_customer_form_action', 'view_as_customer_form_field'); ?>
                            <input type="hidden" class="view-as-customer-option-name" value="view_as_customer_api_settings">
                            <?php
                            $view_as_customer_api_settings = get_option('view_as_customer_api_settings') ? get_option('view_as_customer_api_settings') : [];
                            // var_dump($view_as_customer_api_settings);
                            ?>
                            <div class="view-as-customer-setting-unit switch-setting-unit">
                                <div class="title-wrap">
                                    <label class="position-relative text-label">
                                        <?php echo sprintf(esc_html__('Enable View as Cutomer', 'view-as-customer')) ?>
                                        <span class="tooltip hint--bottom" aria-label="<?php echo sprintf(esc_html__('This option add a top bar menu for easily switch to a customer\'s view.', 'view-as-customer')) ?>"><i class="dashicons dashicons-editor-help"></i></span>
                                    </label>
                                    <div class="description">
                                        <p><?php echo sprintf(esc_html__('Switch directly from your WordPress Dashboard menu.', 'view-as-customer')) ?></p>
                                    </div>
                                </div>
                                <div class="position-relative switcher">
                                    <label class="control-label" for="view_as_customer_api_settings_settings_enable">
                                        <input class="view_as_customer_api_settings_checkbox" type="checkbox" name="view_as_customer_api_settings[settings_enable]" id="view_as_customer_api_settings_settings_enable" value="1" <?php echo (isset($view_as_customer_api_settings["settings_enable"]) && $view_as_customer_api_settings["settings_enable"]) ? 'checked' : '' ?>>
                                        <em data-on="on" data-off="off"></em>
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                            <div class="view-as-customer-setting-unit switch-setting-unit">
                                <div class="title-wrap">
                                    <label class="position-relative text-label">
                                        <?php echo sprintf(esc_html__('Enable Frontend Bar', 'view-as-customer')) ?>
                                        <span class="tooltip hint--bottom" aria-label="<?php echo sprintf(esc_html__('Adds a frontend for easy admin switch back option.', 'view-as-customer')) ?>"><i class="dashicons dashicons-editor-help"></i></span>
                                    </label>
                                    <div class="description">
                                        <p><?php echo sprintf(esc_html__('See a top bar option for easy admin switch.', 'view-as-customer')) ?></p>
                                    </div>
                                </div>
                                <div class="position-relative switcher">
                                    <label class="control-label" for="view_as_customer_api_settings_fontend_enable">
                                        <input class="view_as_customer_api_settings_checkbox" type="checkbox" name="view_as_customer_api_settings[fontend_enable]" id="view_as_customer_api_settings_fontend_enable" value="1" <?php echo (isset($view_as_customer_api_settings["fontend_enable"]) && $view_as_customer_api_settings["fontend_enable"]) ? 'checked' : '' ?>>
                                        <em data-on="on" data-off="off"></em>
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                            <?php //submit_button(); 
                            ?>
                        </form>
                    </div>
                    <div class="col-lg-5 offset-lg-1 area-media">
                        <!-- <img src="<?php //echo esc_url(plugin_dir_url(__DIR__) . 'images/banner-image.svg') 
                                        ?>" alt="" class="img-fluid"> -->


                        <svg width="544" height="550" viewBox="0 0 544 550" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M279.402 309.622C276.889 312.7 269.684 319.176 269.12 320.116C269.013 320.31 268.964 320.531 268.979 320.752C268.995 320.974 269.074 321.186 269.207 321.363C269.34 321.54 269.521 321.675 269.73 321.752C269.938 321.828 270.163 321.843 270.38 321.794C274.365 319.153 277.966 315.975 281.083 312.35C284.144 309.326 286.382 305.57 287.586 301.438C290.171 292.715 287.036 279.499 278.143 275.839C276.883 275.209 275.627 277.098 276.883 277.937C279.3 279.526 281.303 281.668 282.727 284.186C284.15 286.704 284.952 289.525 285.067 292.416C285.659 298.961 284.671 303.163 279.402 309.622Z" fill="#191919" />
                            <path d="M275.615 329.981C274.985 330.608 275.615 331.449 276.454 331.449C279.681 330.476 282.631 328.749 285.059 326.411C290.352 322.433 294.228 316.861 296.117 310.515C298.006 304.169 297.807 297.384 295.55 291.159C295.447 290.906 295.253 290.7 295.007 290.581C294.76 290.463 294.478 290.441 294.216 290.519C293.954 290.598 293.73 290.771 293.589 291.005C293.448 291.239 293.399 291.518 293.452 291.786C298.261 319.69 279.867 324.868 275.615 329.981Z" fill="#191919" />
                            <path d="M284.011 336.064C286.86 336.064 293.809 330.99 294.084 330.817C302.535 324.178 309.11 314.075 307.515 303.537C307.304 302.277 305.417 302.712 305.417 303.748C305.211 308.597 303.892 313.332 301.563 317.59C299.234 321.847 295.957 325.512 291.986 328.3C285.111 333.217 283.321 334.235 283.172 334.383C282.974 335.225 283.172 336.064 284.011 336.064Z" fill="#191919" />
                            <path d="M308.357 329.769C311.584 325.798 313.621 320.996 314.234 315.917C314.441 314.448 312.342 314.448 311.715 315.499C310.241 318.747 309.746 323.559 306.048 327.874C300.589 334.103 296.885 334.702 294.715 337.944C294.506 338.365 294.715 338.992 295.136 338.786C298.889 338.8 306.229 332.81 308.357 329.769Z" fill="#191919" />
                            <path d="M366.069 109.848C374.11 115.574 382.932 116.349 392.513 114.248C392.722 114.248 396.709 122.432 397.13 123.271C400.776 130.054 405.29 136.333 410.558 141.949C413.117 145.318 416.422 148.048 420.214 149.924C421.003 150.288 421.861 150.476 422.73 150.476C423.599 150.476 424.457 150.288 425.246 149.924C429.443 147.826 428.186 140.692 431.123 137.126C432.083 136.045 433.291 135.213 434.643 134.701C435.995 134.189 437.451 134.012 438.886 134.186C444.763 134.816 447.494 141.113 448.75 145.939C450.249 150.414 450.395 155.231 449.171 159.788C447.282 164.615 442.456 166.504 437.838 167.343C436.788 167.552 437 169.023 437.838 169.232C439.818 169.805 441.922 169.793 443.895 169.198C445.869 168.602 447.628 167.447 448.959 165.874C448.975 166.901 449.23 167.91 449.704 168.821C450.178 169.731 450.858 170.519 451.69 171.121C452.754 176.657 464.31 216.279 467.217 220.643C449.974 228.404 448.189 229.075 427.342 239.742C426.712 234.913 420.211 223.583 419.16 222.532C422.267 220.426 424.835 217.62 426.657 214.339C428.48 211.058 429.507 207.395 429.654 203.645C429.654 202.177 427.762 202.389 427.553 203.645C427.189 207.163 425.985 210.542 424.042 213.497C422.099 216.452 419.473 218.896 416.388 220.624C413.302 222.352 409.846 223.313 406.311 223.426C402.777 223.539 399.266 222.8 396.077 221.273C388.732 217.698 384.953 210.152 381.595 203.227C374.17 187.552 373.697 177.529 369.427 174.479C366.066 171.96 361.87 171.539 359.771 167.552C362.492 163.3 364.811 158.804 366.699 154.123C369.847 146.569 369.847 137.755 369.215 129.571C368.341 124.848 368.412 119.997 369.427 115.302C369.468 115.166 369.458 115.019 369.396 114.891C369.335 114.763 369.228 114.662 369.096 114.609C368.964 114.556 368.817 114.555 368.685 114.605C368.552 114.655 368.443 114.754 368.379 114.881C364.73 122.168 366.487 126.348 366.487 134.186C366.901 144.88 363.811 155.417 357.687 164.194C357.057 165.244 355.8 166.504 356.009 167.769C356.373 169.051 356.987 170.249 357.815 171.293C358.644 172.337 359.67 173.208 360.836 173.855C362.934 175.114 365.871 175.532 367.551 177.43C369.251 179.906 370.464 182.684 371.126 185.614C374.269 195.36 380.889 213.765 389.592 220.657C393.349 223.779 397.954 225.707 402.815 226.193C407.676 226.679 412.571 225.701 416.872 223.385C417.923 222.758 423.797 239.335 424.429 240.803C424.009 241.012 416.036 245.203 412.255 247.31C412.05 247.416 411.875 247.572 411.747 247.764C411.618 247.955 411.54 248.176 411.519 248.406C411.498 248.636 411.536 248.867 411.628 249.079C411.72 249.291 411.864 249.476 412.046 249.617C416.173 252.888 419.599 256.956 422.119 261.58C374.324 281.501 355.432 343.417 329.365 373.43C310.997 395.276 282.188 411.328 255.5 420.224C242.398 424.645 229.006 428.151 215.418 430.716C214.998 430.716 214.998 431.554 215.627 431.554C263.004 426.09 302.448 405.537 325.589 382.032C352.313 355.305 368.214 305.417 400.939 278.357C415.836 265.982 435.352 257.163 455.078 261.989C457.388 262.619 459.698 263.249 462.003 264.088C463.053 264.508 463.895 262.828 462.844 262.201C451.569 255.554 436.703 256.676 424.022 261.151C422.162 256.587 419.207 252.551 415.418 249.4C421.193 246.174 466.089 223.484 478.582 219.81C479.856 238.889 480.692 252.609 481.731 259.47C481.769 259.651 481.843 259.822 481.949 259.974C482.055 260.125 482.19 260.254 482.347 260.352C482.503 260.45 482.678 260.515 482.86 260.544C483.043 260.573 483.229 260.565 483.409 260.521C547.36 332.436 525.621 422.015 534.402 501.847C534.614 503.107 536.291 503.107 536.291 501.847C533.976 456.909 537.52 393.291 528.946 349.288C523.407 318.84 510.246 284 488.447 262.201C487.396 261.151 486.137 259.891 484.872 258.843V258.632C482.905 242.47 482.218 227.405 480.472 218.341C480.677 218.077 480.795 217.755 480.807 217.42C480.82 217.086 480.726 216.756 480.541 216.477C480.355 216.199 480.087 215.985 479.773 215.868C479.46 215.75 479.117 215.734 478.794 215.822C475.442 216.829 472.149 218.023 468.93 219.397C467.786 215.119 466.384 210.914 464.733 206.805C463.474 203.23 454.033 174.49 453.403 172.389C458.65 174.49 463.897 171.564 467.882 167.989C486.582 150.752 493.828 121.91 481.313 101.048C505.433 111.097 531.795 89.4763 523.075 60.5463C519.192 47.5424 510.582 36.4628 498.941 29.4878C471.52 14.3628 443.193 33.2113 447.318 53.8308C447.109 52.7831 442.7 51.3145 441.862 50.8938C436.738 49.1476 431.303 48.5065 425.913 49.0127C420.524 49.5189 415.303 51.161 410.594 53.8308C400.577 51.6995 390.238 51.5574 380.165 53.4128C365.896 56.5588 352.465 67.4708 351.629 83C351.817 88.2825 353.218 93.4509 355.721 98.1062C358.225 102.761 361.766 106.779 366.069 109.848Z" fill="#191919" />
                            <path d="M334.59 110.274C327.69 99.3484 314.864 87.8204 301.015 88.0322C296.597 88.1864 292.283 89.413 288.444 91.6063C284.606 93.7996 281.358 96.8936 278.982 100.622C269.748 114.262 270.377 133.778 273.944 149.297C278.344 168.602 291.781 200.078 315.076 201.547C318.706 201.704 322.33 201.115 325.723 199.815C329.116 198.515 332.206 196.532 334.802 193.99C356.406 173.642 348.488 132.274 334.59 110.274ZM341.726 178.686C335.06 197.6 314.526 199.484 298.078 173.439C287.796 157.489 280.03 135.877 283.597 116.572C286.325 102.72 298.287 88.8709 313.396 94.9567C342.46 106.218 349.063 157.849 341.726 178.678V178.686Z" fill="#191919" />
                            <path d="M336.897 230.51C340.29 233.406 345.697 232.608 349.486 231.335C351.167 230.917 340.686 208.463 336.267 198.39C336.194 198.242 336.09 198.112 335.962 198.009C335.834 197.905 335.684 197.831 335.524 197.791C335.365 197.751 335.198 197.746 335.036 197.777C334.874 197.808 334.721 197.873 334.587 197.969C331.666 200.113 328.402 201.745 324.934 202.796C324.093 203.225 335.648 229.446 336.897 230.51Z" fill="#191919" />
                            <path d="M39.3251 264.297C56.7464 327.525 65.5821 347.855 73.3206 368.59C77.3081 379.502 81.2956 390.414 86.3308 400.906C94.3223 418.665 103.221 420.662 115.921 417.488C125.364 415.175 134.808 412.659 144.04 410.143C144.669 409.931 144.46 409.092 143.831 409.301C134.178 411.4 124.526 413.498 115.082 415.596C110.465 416.647 105.43 417.488 101.021 415.387C93.9044 412.222 89.8811 403.592 86.9606 396.921C81.9501 385.53 64.9221 338.778 63.4591 334.386C51.3591 298.911 20.9634 194.086 16.8714 151.816C16.2416 144.683 15.4029 136.499 19.5994 130.204C23.8014 123.697 31.3501 120.969 38.0711 118.25C117.461 86.2149 255.258 51.0121 320.315 41.4449C334.485 39.4896 339.405 39.1211 346.126 52.5659C348.135 56.4096 349.351 60.618 349.701 64.9409C349.718 65.1516 349.814 65.3482 349.969 65.4915C350.125 65.6348 350.328 65.7144 350.54 65.7144C350.751 65.7144 350.955 65.6348 351.11 65.4915C351.266 65.3482 351.362 65.1516 351.379 64.9409C351.43 56.7537 348.608 48.8079 343.404 42.4871C342.182 41.0282 340.68 39.8301 338.986 38.9646C337.291 38.099 335.44 37.5836 333.542 37.4491C314.652 35.0896 134.093 75.4899 35.3431 116.352C28.4159 119.289 21.2824 122.438 17.2949 128.944C13.0984 135.448 13.5164 143.844 14.1461 151.186C15.8016 177.672 32.1421 238.7 39.3251 264.297Z" fill="#191919" />
                            <path d="M60.5312 134.201C57.2659 135.237 54.1586 136.718 51.2967 138.601C45.3924 143.144 45.5877 149.458 46.0497 156.858C48.5082 196.183 64.8074 259.018 76.8992 290.112C77.0018 290.366 77.1957 290.573 77.4429 290.692C77.6901 290.811 77.9728 290.833 78.2355 290.754C78.4982 290.675 78.7219 290.501 78.8629 290.266C79.0038 290.03 79.0518 289.751 78.9974 289.482C71.1297 262.131 52.5314 207.848 48.7777 158.951C48.3597 152.656 47.3092 144.681 53.1777 140.484C56.0747 138.578 59.2649 137.161 62.6212 136.288C66.3969 134.817 70.1754 133.56 73.9512 132.089C199.86 86.9364 285.462 74.6466 303.945 70.1834C310.435 68.4921 321.523 66.0969 324.512 72.0726C326.867 79.645 328.759 87.3537 330.177 95.1561C330.386 95.7859 331.645 95.7859 331.436 94.9471C330.711 88.879 329.659 82.8543 328.288 76.8989C327.923 74.9582 327.361 73.0599 326.61 71.2339C324.512 66.4076 319.056 65.5689 314.235 65.7779C309.2 66.2597 304.215 67.1723 299.336 68.5059C289.455 70.7664 181.352 88.4736 60.5312 134.201Z" fill="#191919" />
                            <path d="M188.53 77.1129C189.577 76.9011 189.159 75.4326 188.321 75.4326C187.105 75.4333 185.913 75.7773 184.884 76.4252C183.855 77.073 183.03 77.9983 182.504 79.0945C181.977 80.1907 181.771 81.4132 181.909 82.6215C182.047 83.8297 182.523 84.9744 183.283 85.9239C184.019 86.8703 184.981 87.6165 186.081 88.0937C187.181 88.5709 188.383 88.7638 189.577 88.6546C190.861 88.5318 192.091 88.0826 193.152 87.3496C194.212 86.6167 195.067 85.6244 195.636 84.4673C196.204 83.3103 196.467 82.027 196.399 80.7396C196.331 79.4522 195.935 78.2037 195.248 77.1129C195.052 76.8079 194.744 76.5926 194.39 76.5138C194.036 76.435 193.665 76.4991 193.359 76.6921C191.89 77.5171 193.359 80.0499 193.359 81.3094C193.361 82.2245 193.106 83.1218 192.624 83.8995C192.142 84.6773 191.451 85.3043 190.631 85.7094C190.044 85.9205 189.419 86.0058 188.797 85.9597C188.174 85.9137 187.569 85.7373 187.019 85.4421C186.47 85.1469 185.988 84.7394 185.607 84.2461C185.225 83.7528 184.951 83.1847 184.803 82.5787C184.655 81.9727 184.636 81.3423 184.747 80.7285C184.858 80.1147 185.097 79.5311 185.449 79.0157C185.8 78.5003 186.256 78.0645 186.787 77.7367C187.318 77.4089 187.911 77.1963 188.53 77.1129Z" fill="#191919" />
                            <path d="M121.588 370.7C117.188 372.169 112.356 373.846 108.369 370.7C105.563 368.044 103.47 364.725 102.283 361.048C90.1832 330.173 103.262 362.502 90.3207 331.46C90.2541 331.373 90.1589 331.312 90.0518 331.287C89.9447 331.263 89.8323 331.276 89.7343 331.326C89.6362 331.376 89.5587 331.458 89.5151 331.559C89.4715 331.66 89.4647 331.773 89.4957 331.878C90.9642 336.278 92.2237 340.678 93.6922 345.1C95.1607 349.522 96.841 353.9 98.3095 358.32C100.408 364.194 102.709 371.748 109.012 374.479C113.366 375.887 118.092 375.586 122.232 373.637C124.107 372.999 123.475 370.059 121.588 370.7Z" fill="#191919" />
                            <path d="M385.361 195.046C390.399 193.473 398.894 186.967 402.568 183.295C404.036 182.036 401.938 179.938 400.47 181.197C391.799 189.145 388.18 190.432 384.52 193.787C383.893 194.425 384.522 195.25 385.361 195.046Z" fill="#191919" />
                            <path d="M467.418 439.521C467.56 439.447 467.671 439.325 467.731 439.176C467.792 439.028 467.797 438.863 467.746 438.711C467.695 438.559 467.592 438.43 467.455 438.347C467.318 438.264 467.156 438.233 466.998 438.259C465.623 438.259 432.287 446.33 429.015 447.282C441.452 438.922 452.924 429.21 463.222 418.324C463.287 418.272 463.341 418.206 463.38 418.131C463.418 418.057 463.44 417.975 463.445 417.891C463.45 417.807 463.437 417.723 463.407 417.645C463.377 417.567 463.33 417.495 463.271 417.436C463.212 417.377 463.141 417.331 463.062 417.301C462.984 417.271 462.9 417.258 462.816 417.262C462.732 417.267 462.65 417.289 462.576 417.328C462.501 417.366 462.436 417.42 462.383 417.485C448.851 430.065 434.145 441.318 418.466 451.09C388.507 470.065 337.552 494.89 317.587 503.313C268.673 523.954 210.497 537.625 180.346 494.29C166.073 473.514 161.877 446.864 165.655 422.312C166.073 419.166 166.497 416.226 166.915 413.077C167.124 411.609 165.026 410.979 164.608 412.45C163.783 415.596 162.927 418.745 162.298 421.894C160.856 431.477 160.579 441.199 161.473 450.848C163.948 476.049 175.399 500.92 196.098 514.434C237.491 541.431 302.798 514.921 346.979 492.819C349.454 491.581 414.858 459.313 423.572 450.642C460.563 441.669 465.114 440.825 467.418 439.521Z" fill="#191919" />
                            <path d="M211.815 159.162C221.888 156.225 270.153 144.472 269.733 142.794C266.84 131.228 267.029 115.883 272.461 105.02C272.584 104.797 272.638 104.543 272.618 104.29C272.598 104.036 272.504 103.794 272.348 103.593C272.192 103.392 271.98 103.242 271.739 103.16C271.498 103.078 271.238 103.069 270.992 103.134C233.042 110.141 132.15 136.574 68.9084 158.959C68.7578 159.001 68.617 159.072 68.494 159.169C68.371 159.266 68.2683 159.386 68.1917 159.522C68.1151 159.658 68.0661 159.809 68.0475 159.964C68.0289 160.119 68.0411 160.277 68.0834 160.427C71.0204 171.548 74.1664 184.558 79.8342 194.632C81.4704 198.751 88.9367 194.271 211.815 159.162Z" fill="#0167FF" />
                            <path d="M318.637 216.871C318.217 213.722 317.587 210.576 317.169 207.219C317.169 206.589 316.33 206.377 315.7 206.377C289.677 210.156 277.926 174.477 272.05 155.596C271.841 154.771 219.379 169.865 209.097 172.371C208.85 172.459 208.647 172.64 208.53 172.874C208.412 173.109 208.39 173.379 208.467 173.63C208.97 174.832 220.614 208.926 221.686 213.082C221.898 213.711 222.737 214.132 223.157 213.711C225.674 212.034 236.168 204.268 237.427 207.417C242.086 218.545 247.629 229.283 254.004 239.526C270.372 233.652 312.972 219.382 317.587 217.911C318.428 217.919 318.846 217.501 318.637 216.871Z" fill="#0167FF" />
                            <path d="M331.435 124.748C328.5 115.723 324.931 105.223 315.908 100.823C312.259 99.2346 308.2 98.8459 304.315 99.7133C300.431 100.581 296.923 102.659 294.296 105.65C286.948 113.836 286.53 125.796 288.628 136.29C288.837 137.338 331.435 125.166 331.435 124.748Z" fill="#0167FF" />
                            <path d="M337.519 143.424C337.728 142.794 337.307 142.164 336.468 142.373C330.382 143.424 295.339 153.497 293.871 153.923C293.624 154.012 293.42 154.192 293.303 154.427C293.185 154.661 293.163 154.932 293.241 155.183C297.437 167.354 306.251 184.352 320.939 186.45C337.098 188.76 339.826 165.677 339.196 154.344C338.875 150.671 338.315 147.024 337.519 143.424Z" fill="#0167FF" />
                            <path d="M354.927 234.3C358.698 232.149 358.703 229.369 357.655 229.9C356.216 230.146 354.853 230.72 353.671 231.577C347.373 235.356 339.189 236.615 333.106 231.577C331.033 229.795 329.384 227.573 328.277 225.074C328.068 224.444 327.227 224.444 327.227 225.282C327.238 237.396 344.805 241.518 354.927 234.3Z" fill="#191919" />
                            <path d="M335.228 242.891C337.227 244.18 339.474 245.033 341.824 245.395C344.175 245.757 346.575 245.62 348.868 244.992C352.853 244.151 358.939 241.634 361.243 238.065C361.873 237.226 360.822 236.178 359.986 236.387C358.015 237.147 356.173 238.21 354.528 239.536C351.759 241.149 348.671 242.135 345.481 242.424C342.29 242.714 339.075 242.301 336.061 241.214C335.841 241.118 335.592 241.11 335.366 241.193C335.14 241.275 334.955 241.441 334.848 241.656C334.741 241.872 334.721 242.12 334.792 242.35C334.862 242.579 335.019 242.773 335.228 242.891Z" fill="#191919" />
                            <path d="M341.092 251.705C348.902 254.955 360.617 252.755 364.805 244.989C364.933 244.712 364.96 244.399 364.881 244.104C364.802 243.809 364.621 243.552 364.371 243.377C364.121 243.202 363.817 243.12 363.512 243.146C363.208 243.173 362.923 243.305 362.707 243.521C361.339 244.891 359.868 246.154 358.307 247.299C355.844 248.873 353.086 249.927 350.201 250.396C347.316 250.865 344.366 250.74 341.532 250.027C341.321 250.001 341.108 250.051 340.932 250.17C340.756 250.289 340.629 250.468 340.575 250.673C340.522 250.878 340.544 251.096 340.639 251.286C340.734 251.476 340.895 251.625 341.092 251.705Z" fill="#191919" />
                            <path d="M345.492 260.309C352.837 263.246 362.28 259.471 367.527 254.015C368.366 253.173 369.414 252.125 368.996 250.866C368.9 250.653 368.755 250.465 368.572 250.32C368.389 250.174 368.175 250.073 367.945 250.027C365.454 249.714 363.138 254.952 357.872 256.531C353.951 257.821 349.828 258.391 345.703 258.211C345.487 258.276 345.295 258.404 345.151 258.578C345.008 258.752 344.919 258.965 344.896 259.19C344.874 259.414 344.918 259.64 345.024 259.84C345.13 260.039 345.293 260.203 345.492 260.309Z" fill="#191919" />
                            <path d="M382.015 242.682C382.84 243.942 384.952 243.103 384.325 241.634C375.613 220.124 351.438 221.757 348.649 202.183C348.597 202 348.487 201.84 348.336 201.725C348.185 201.611 348 201.549 347.81 201.549C347.621 201.549 347.436 201.611 347.285 201.725C347.133 201.84 347.023 202 346.972 202.183C346.655 203.776 346.655 205.416 346.972 207.009C348.478 211.983 351.568 216.328 355.772 219.384C364.431 226.248 374.095 229.215 382.015 242.682Z" fill="#191919" />
                            <path d="M389.145 136.708C389.777 136.499 389.356 135.449 388.727 135.66C385.757 136.155 376.33 137.965 375.087 140.696C374.875 141.325 374.875 142.376 375.716 142.376C380.643 142.453 385.565 142.031 390.407 141.116C390.793 141.001 391.118 140.739 391.311 140.386C391.504 140.033 391.551 139.617 391.44 139.23C391.329 138.843 391.07 138.515 390.719 138.318C390.368 138.121 389.954 138.07 389.565 138.177C387.467 138.597 385.369 139.018 383.482 139.227C385.428 138.525 387.32 137.683 389.145 136.708Z" fill="#191919" />
                            <path d="M95.1595 232.399C98.5668 243.927 110.48 252.546 123.281 249.188C146.783 243.102 150.781 207.218 124.75 201.762C107.317 198.217 89.918 214.665 95.1595 232.399Z" fill="#0167FF" />
                            <path d="M187.277 213.304C187.907 212.883 192.522 218.339 194.202 220.438C196.572 218.778 199.023 217.238 201.547 215.823C203.335 212.678 204.346 209.152 204.497 205.537C204.649 201.923 203.935 198.325 202.417 195.041C200.898 191.758 198.618 188.884 195.766 186.659C192.914 184.433 189.572 182.92 186.018 182.246C179.693 180.982 173.125 182.134 167.609 185.475C162.092 188.816 158.028 194.104 156.219 200.294C154.863 205.379 155.194 210.767 157.162 215.649C159.129 220.53 162.628 224.641 167.131 227.365C173.635 222.536 180.35 217.921 187.277 213.304Z" fill="#0167FF" />
                            <path d="M132.084 290.738C128.784 294.038 126.43 294.957 128.306 298.081C135.907 313.973 201.893 407.22 222.752 425.461C222.802 425.533 222.868 425.593 222.944 425.637C223.021 425.681 223.106 425.708 223.194 425.715C223.281 425.722 223.37 425.71 223.452 425.679C223.535 425.649 223.61 425.6 223.671 425.537C223.733 425.474 223.78 425.398 223.809 425.315C223.838 425.232 223.849 425.144 223.84 425.056C223.831 424.968 223.802 424.884 223.757 424.808C223.711 424.733 223.65 424.668 223.577 424.619C192.161 388.3 144.899 320.903 131.873 298.925C128.298 292.839 142.785 284.655 146.984 281.086C174.857 258.285 203.928 236.988 234.071 217.286C247.032 245.138 271.017 281.771 281.077 295.347C282.124 296.819 284.652 295.559 283.593 293.879C271.342 274.12 251.869 249.158 236.169 214.129C236.078 213.945 235.95 213.781 235.793 213.649C235.636 213.516 235.453 213.417 235.257 213.358C235.06 213.299 234.853 213.281 234.649 213.305C234.445 213.33 234.248 213.396 234.071 213.499C197.936 237.6 148.65 275.946 132.084 290.738Z" fill="#191919" />
                            <path d="M213.083 218.551C213.257 218.431 213.38 218.251 213.427 218.045C213.475 217.839 213.444 217.623 213.341 217.439C213.238 217.255 213.07 217.116 212.869 217.049C212.669 216.983 212.451 216.994 212.258 217.08C197.253 225.423 182.685 234.529 168.61 244.362C166.93 245.41 165.461 246.67 163.993 247.717C143.893 261.669 125.693 278.177 109.851 296.824C109.661 297.055 109.541 297.336 109.504 297.633C109.467 297.929 109.515 298.231 109.642 298.501C127.517 337.843 178.315 393.165 198.192 405.523C198.613 405.735 199.242 405.105 198.822 404.685C188.215 393.685 181.686 389.361 161.468 367.122C144.462 348.197 122.845 321.032 112.155 297.872C149.85 253.644 190.412 233.662 213.083 218.551Z" fill="#191919" />
                            <path d="M181.608 400.909C182.433 401.327 183.495 401.538 184.125 401.956C184.18 401.984 184.24 402 184.302 402.005C184.363 402.009 184.425 402.001 184.484 401.982C184.542 401.962 184.597 401.931 184.643 401.891C184.69 401.85 184.728 401.801 184.756 401.746C184.783 401.691 184.8 401.631 184.804 401.569C184.809 401.507 184.801 401.445 184.781 401.387C184.762 401.328 184.731 401.274 184.69 401.227C184.65 401.181 184.601 401.142 184.545 401.115C183.728 400.626 182.956 400.066 182.238 399.44C175.826 395.098 169.66 390.403 163.769 385.377C133.83 360.816 90.2836 310.401 88.4356 306.683C91.6751 301.84 147.03 247.833 179.089 223.795C179.719 223.377 179.089 222.538 178.46 222.97C159.82 235.235 145.545 247.912 128.726 263.472C120.352 271.172 93.3856 296.519 86.1256 305.231C85.7879 305.595 85.5834 306.063 85.5455 306.558C85.5075 307.053 85.6384 307.547 85.9166 307.959C92.3324 317.875 122.871 350.584 132.504 360.209C144.431 371.181 165.826 393.019 181.608 400.909Z" fill="#191919" />
                            <path d="M331.227 360.195C331.431 360.328 331.674 360.387 331.916 360.362C332.158 360.337 332.384 360.23 332.556 360.058C332.729 359.886 332.837 359.661 332.863 359.419C332.889 359.177 332.831 358.934 332.698 358.729C332.498 358.347 311.328 333.608 311.083 333.336C310.663 332.915 310.033 333.548 310.258 333.966C313.322 340.126 325.848 357.123 331.227 360.195Z" fill="#191919" />
                            <path d="M353.045 265.766C355.381 272.001 358.482 277.923 362.277 283.394C366.677 287.794 372.562 283.814 372.562 278.356C372.562 272.482 369.201 266.187 367.315 260.731C367.248 260.526 367.136 260.339 366.989 260.182C366.842 260.025 366.662 259.902 366.462 259.821C366.262 259.741 366.047 259.706 365.832 259.718C365.617 259.729 365.407 259.788 365.217 259.889C361.781 261.945 357.882 263.1 353.881 263.247C352.624 263.038 352.633 264.295 353.045 265.766Z" fill="#191919" />
                            <path d="M236.366 253.594C236.67 253.395 236.932 253.138 237.135 252.838C237.339 252.537 237.48 252.198 237.551 251.842C237.621 251.486 237.62 251.119 237.546 250.763C237.473 250.407 237.329 250.07 237.123 249.771L228.604 236.033C228.309 235.626 227.935 235.283 227.504 235.026C227.072 234.768 226.593 234.601 226.095 234.535C225.597 234.469 225.091 234.505 224.607 234.641C224.124 234.777 223.673 235.011 223.283 235.327C197.88 255.602 173.787 277.464 151.146 300.782C150.441 301.516 149.997 302.462 149.882 303.473C149.767 304.484 149.987 305.505 150.509 306.379C156.91 317.008 164.143 326.807 171.122 336.825C171.497 337.371 171.989 337.828 172.561 338.163C173.133 338.498 173.772 338.703 174.432 338.763C175.093 338.824 175.758 338.738 176.382 338.512C177.005 338.287 177.571 337.927 178.04 337.457C195.721 319.251 206.932 308.35 227.312 285.068C230.816 288.59 235.572 290.581 240.54 290.604C245.507 290.628 250.282 288.682 253.819 285.193C267.513 271.542 253.621 248.565 236.366 253.594ZM223.989 280.341C211.844 292.486 198.386 305.083 175.547 327.31C171.031 320.788 164.939 312.087 160.311 304.661C184.265 280.079 198.515 267.801 225.185 243.489C233.339 253.736 233.18 254.153 235.074 254.024C232.561 254.949 230.265 256.381 228.328 258.23C226.391 260.079 224.856 262.307 223.816 264.775C222.776 267.243 222.255 269.898 222.285 272.576C222.315 275.254 222.895 277.897 223.989 280.341ZM250.056 271.744C250.087 273.027 249.859 274.304 249.384 275.497C248.909 276.689 248.198 277.774 247.293 278.684C246.388 279.595 245.308 280.313 244.118 280.795C242.928 281.278 241.653 281.514 240.37 281.491C238.274 281.435 236.236 280.796 234.483 279.647C232.731 278.498 231.332 276.884 230.445 274.985C229.558 273.086 229.217 270.977 229.461 268.896C229.704 266.814 230.523 264.841 231.824 263.198C233.5 262.042 235.451 261.345 237.48 261.176C239.51 261.008 241.548 261.374 243.393 262.238C245.237 263.103 246.822 264.435 247.991 266.103C249.161 267.771 249.872 269.716 250.056 271.744Z" fill="#191919" />
                            <path d="M271.766 313.273C270.021 309.837 268.085 306.501 265.967 303.281C265.756 302.982 265.607 302.645 265.527 302.289C265.447 301.933 265.438 301.564 265.5 301.205C265.562 300.845 265.695 300.501 265.89 300.192C266.086 299.884 266.34 299.617 266.638 299.406C266.937 299.196 267.274 299.047 267.63 298.967C267.986 298.886 268.355 298.877 268.715 298.94C269.074 299.002 269.418 299.135 269.727 299.33C270.036 299.525 270.303 299.779 270.513 300.078C273.498 304.021 276.262 308.128 278.792 312.378C281.327 316.79 277.952 313.217 213.349 386.542C212.86 387.097 212.245 387.528 211.555 387.798C210.866 388.067 210.122 388.169 209.386 388.094C208.649 388.019 207.941 387.77 207.32 387.367C206.699 386.964 206.184 386.418 205.816 385.776C200.434 376.356 193.516 366.588 188.505 357.78C188.038 356.97 187.832 356.038 187.914 355.107C187.995 354.177 188.361 353.294 188.961 352.579C200.62 338.838 213.554 326.232 227.591 314.931C228.104 314.423 228.798 314.14 229.52 314.144C230.241 314.148 230.932 314.439 231.44 314.952C231.947 315.465 232.23 316.159 232.226 316.881C232.222 317.603 231.931 318.293 231.418 318.801C201.033 352.588 202.122 351.223 198.071 355.98C202.195 362.877 207.856 371.113 210.581 375.646C229.843 353.773 250.268 332.952 271.766 313.273Z" fill="#191919" />
                            <path d="M225.5 396.223L227.463 399.236C227.892 399.834 228.066 400.579 227.947 401.305C227.827 402.032 227.424 402.681 226.826 403.111C226.228 403.54 225.483 403.714 224.757 403.595C224.03 403.475 223.381 403.072 222.951 402.474L219.004 397.355C218.574 396.739 218.387 395.985 218.479 395.24C218.572 394.494 218.936 393.809 219.503 393.317C237.455 377.362 260.023 350.429 283.412 328.072C283.918 327.595 284.525 327.239 285.188 327.029C285.851 326.819 286.552 326.761 287.24 326.86C287.928 326.959 288.585 327.212 289.162 327.6C289.739 327.988 290.221 328.501 290.572 329.101C295.256 337.126 298.851 344.38 303.268 353.163C303.732 354.075 303.879 355.117 303.686 356.122C303.492 357.128 302.97 358.041 302.2 358.716C278.388 379.678 284.855 376.199 245.82 409.801C245.294 410.266 244.609 410.511 243.907 410.484C243.205 410.457 242.54 410.159 242.052 409.654C241.563 409.149 241.289 408.475 241.285 407.773C241.281 407.07 241.549 406.393 242.032 405.883C258.024 387.564 275.184 370.297 293.405 354.192C290.959 349.353 288.204 343.825 285.462 338.887C266.803 356.917 249.449 376.69 225.5 396.223Z" fill="#191919" />
                            <path d="M235.958 258.824C233.887 260.004 232.189 261.75 231.054 263.866C229.92 265.983 229.393 268.386 229.534 270.808C229.674 273.229 230.476 275.573 231.85 277.576C233.224 279.58 235.115 281.164 237.312 282.151C238.662 282.744 240.113 283.055 241.577 283.067C243.041 283.078 244.488 282.788 245.83 282.216C247.173 281.643 248.383 280.8 249.389 279.735C250.395 278.671 251.175 277.408 251.682 276.023C252.341 273.775 252.406 271.381 251.869 269.082C251.333 266.783 250.213 264.658 248.623 262.918C247.032 261.178 245.026 259.885 242.804 259.167C240.582 258.448 238.222 258.33 235.958 258.824Z" fill="#0167FF" />
                        </svg>
                    </div>
                </div>
            </div>
        </section>
        <div class="footer-wrapper">
            <section class="container-fluid">
                <div class="footer-part">
                    <div class="row">
                        <div class="col-lg-6 text-center text-lg-start">
                            <?php printf(
                                esc_html__('Enjoyed %1$s ? Please leave us a rating. We really appreciate your support!', 'view-as-customer'),
                                '<strong>' . esc_html(VIEW_AS_CUSTOMER_NAME) . '</strong>'
                            ); ?>
                        </div>
                        <div class="col-lg-6 text-center text-lg-end">
                            <strong><?php echo esc_html__('Version', 'view-as-customer') ?></strong>
                            <?php echo esc_html(VIEW_AS_CUSTOMER_VERSION) ?>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>