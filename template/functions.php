<?php
/**
 * Jakka Sigma Portfolio functions and definitions
 */

if ( ! function_exists( 'jakka_sigma_setup' ) ) :
    function jakka_sigma_setup() {
        // Menambahkan dukungan untuk tag title otomatis
        add_theme_support( 'title-tag' );

        // Menambahkan dukungan untuk gambar unggulan (Post Thumbnails)
        add_theme_support( 'post-thumbnails' );

        // Mendaftarkan lokasi menu (opsional untuk pengembangan ke depan)
        register_nav_menus( array(
            'primary' => __( 'Primary Menu', 'jakka-sigma' ),
        ) );

        // Dukungan untuk Banner Hero (Custom Header)
        add_theme_support( 'custom-header', array(
            'default-image' => get_template_directory_uri() . '/aset/banner.jpg',
            'width'         => 1920,
            'height'        => 1080,
            'flex-height'   => true,
            'flex-width'    => true,
        ) );
    }
endif;
add_action( 'after_setup_theme', 'jakka_sigma_setup' );

/**
 * Mendaftarkan pengaturan gambar ke Customizer WordPress
 */
function jakka_sigma_customize_register( $wp_customize ) {
    // Buat Section baru bernama "Portfolio Images"
    $wp_customize->add_section( 'jakka_images_section', array(
        'title'    => __( 'Portfolio Images', 'jakka-sigma' ),
        'priority' => 30,
    ) );

    // Section for Contact Info
    $wp_customize->add_section( 'jakka_contact_section', array(
        'title'    => __( 'Contact Information', 'jakka-sigma' ),
        'priority' => 31,
    ) );

    // 1. Foto Profil (About)
    $wp_customize->add_setting( 'profile_image_setting', array('sanitize_callback' => 'esc_url_raw') );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'profile_image_control', array(
        'label'    => __( 'Foto Profil (About Me)', 'jakka-sigma' ),
        'section'  => 'jakka_images_section',
        'settings' => 'profile_image_setting',
    ) ) );

    // 2. Foto Contact
    $wp_customize->add_setting( 'contact_image_setting', array('sanitize_callback' => 'esc_url_raw') );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'contact_image_control', array(
        'label'    => __( 'Foto Bagian Contact', 'jakka-sigma' ),
        'section'  => 'jakka_images_section',
        'settings' => 'contact_image_setting',
    ) ) );

    // 3. Project Images
    for ($i = 1; $i <= 3; $i++) {
        for ($j = 1; $j <= 3; $j++) {
            $wp_customize->add_setting( "project{$i}_img{$j}_setting", array('sanitize_callback' => 'esc_url_raw') );
            $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, "project{$i}_img{$j}_control", array(
                'label'    => __( "Project {$i} - Foto {$j}", 'jakka-sigma' ),
                'section'  => 'jakka_images_section',
                'settings' => "project{$i}_img{$j}_setting",
            ) ) );
        }
    }

    // 4. Contact Details (Text)
    $contact_fields = array(
        'phone'   => __( 'Phone Number', 'jakka-sigma' ),
        'email'   => __( 'Email Address', 'jakka-sigma' ),
        'address' => __( 'Location/Address', 'jakka-sigma' ),
    );

    foreach ($contact_fields as $id => $label) {
        $wp_customize->add_setting( "jakka_{$id}_setting", array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ) );

        $wp_customize->add_control( "jakka_{$id}_control", array(
            'label'    => $label,
            'section'  => 'jakka_contact_section',
            'settings' => "jakka_{$id}_setting",
            'type'     => 'text',
        ) );
    }
}
add_action( 'customize_register', 'jakka_sigma_customize_register' );

/**
 * Enqueue scripts and styles.
 */
function jakka_sigma_scripts() {
    wp_enqueue_style( 'jakka-sigma-style', get_stylesheet_uri(), array(), '1.0' );
}
add_action( 'wp_enqueue_scripts', 'jakka_sigma_scripts' );