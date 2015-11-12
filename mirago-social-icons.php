<?php

/*
 Plugin Name: Mirago Social Icons
 Plugin URI: http://www.mirago.com.br
 Description: Exibe os ícones das redes sociais
 Version: 1.0
 Author: Mirago Marketing Digital
 Author URI: https://www.mirago.com.br
 */

function mirago_social_enqueue_style() {
	wp_enqueue_style( 'svg-social', plugin_dir_url( __FILE__ ) . 'css/social-svg.min.css' );
}

add_action( 'wp_enqueue_scripts', 'mirago_social_enqueue_style' );

function mirago_social_enqueue_color_picker($hook) {
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'msi-color-picker', plugin_dir_url( __FILE__ ) . 'js/msi-color-picker.js', array( 'wp-color-picker' ), false, true ); 
}

add_action( 'admin_enqueue_scripts', 'mirago_social_enqueue_color_picker' );


function mirago_social_show_icons(){
 	$redes = array();
 	if (get_option('msi_facebook')) { $redes['facebook'] = get_option('msi_facebook'); }
 	if (get_option('msi_twitter')) { $redes['twitter'] = get_option('msi_twitter'); }
 	if (get_option('msi_linkedin')) { $redes['linkedin'] = get_option('msi_linkedin'); }
  if (get_option('msi_youtube')) { $redes['youtube'] = get_option('msi_youtube'); }
 	if (get_option('msi_pinterest')) { $redes['pinterest'] = get_option('msi_pinterest'); }
 	if (get_option('msi_instagram')) { $redes['instagram'] = get_option('msi_instagram'); }
 	if (get_option('msi_vimeo')) { $redes['vimeo'] = get_option('msi_vimeo'); }
 	if (get_option('msi_googleplus')) { $redes['googleplus'] = get_option('msi_googleplus'); }

  if ($redes) {
   	$url = plugin_dir_url( __FILE__ );
   	$output = '<div class="social no-spin linear">';
   	$output .='<ul>';

   	foreach ($redes as $key => $value) {
   		if ($value != '' && !empty($value)) {
	     	$output .= '<li class="'. $key . '">';
	     	$output .= '<a href="'. $value . '" target="_blank">';
	      $output .= '<div class="icon">';
	      $output .= file_get_contents($url . "img/". $key . ".svg");
	      $output .= '</div>';
	      $output .= '<div class="circle">';
        $output .= file_get_contents($url . "img/circle.svg");
	      $output .= '</div>';
	      $output .= '</a>';
	      $output .= '</li>';
      }
  	}

    $output .='</ul>';	
    $output .= '</div>';
    $output .= '<style>';

    $cor_facebook = '#3b5998';
    $cor_twitter = '#55acee';
    $cor_linkedin = '#0077b5';
    $cor_youtube = '#cd201f';
    $cor_pinterest = '#cc2127';
    $cor_instagram = '#3f729b';
    $cor_googleplus = '#dd4b39';
    $cor_vimeo = '#4bf';

    if (get_option('msi_icone_tipo') == 3) {
      $cor_facebook = $cor_twitter = $cor_linkedin = $cor_youtube = $cor_pinterest = $cor_instagram = $cor_googleplus = $cor_vimeo = '#000';
    } elseif (get_option('msi_icone_tipo') == 4) {
      $cor_facebook = $cor_twitter = $cor_linkedin = $cor_youtube = $cor_pinterest = $cor_instagram = $cor_googleplus = $cor_vimeo = '#fff';
    }

    $output .= '.social ul li a .icon svg, .social ul li a:hover .icon svg { z-index: 9999 !important } ';
    if (get_option('msi_icone_tipo') == 0 ) {
      

      $output .= '
      .social ul li.facebook a .circle svg { fill: ' . $cor_facebook . ' }
      .social ul li.twitter a .circle svg { fill: ' . $cor_twitter . ' }
      .social ul li.linkedin a .circle svg { fill: ' . $cor_linkedin . ' }
      .social ul li.youtube a .circle svg { fill: ' . $cor_youtube . ' }
      .social ul li.pinterest a .circle svg { fill: ' . $cor_pinterest . ' }
      .social ul li.instagram a .circle svg { fill: ' . $cor_instagram . ' }
      .social ul li.googleplus a .circle svg { fill: ' . $cor_googleplus . ' }
      .social ul li.vimeo a .circle svg { fill: ' . $cor_vimeo . ' } 
      .social ul li a .icon svg { fill: #FFF }

      .social ul li.facebook a:hover .circle svg { fill: ' . $cor_facebook . ' }
      .social ul li.twitter a:hover .circle svg { fill: ' . $cor_twitter . ' }
      .social ul li.linkedin a:hover .circle svg { fill: ' . $cor_linkedin . ' }
      .social ul li.youtube a:hover .circle svg { fill: ' . $cor_youtube . ' }
      .social ul li.pinterest a:hover .circle svg { fill: ' . $cor_pinterest . ' }
      .social ul li.instagram a:hover .circle svg { fill: ' . $cor_instagram . ' }
      .social ul li.googleplus a:hover .circle svg { fill: ' . $cor_googleplus . ' }
      .social ul li.vimeo a:hover .circle svg { fill: ' . $cor_vimeo . ' } 
      .social ul li a:hover .icon svg { fill: #FFF }

      .social ul li a .circle { stroke: none !important; }
      ';

    } else {

      $output .= 
      '
      .social ul li.facebook a:hover .icon svg { fill: ' . $cor_facebook . ' }
      .social ul li.twitter a:hover .icon svg { fill: ' . $cor_twitter . ' }
      .social ul li.linkedin a:hover .icon svg { fill: ' . $cor_linkedin . ' }
      .social ul li.youtube a:hover .icon svg { fill: ' . $cor_youtube . ' }
      .social ul li.pinterest a:hover .icon svg { fill: ' . $cor_pinterest . ' }
      .social ul li.instagram a:hover .icon svg { fill: ' . $cor_instagram . ' }
      .social ul li.googleplus a:hover .icon svg { fill: ' . $cor_googleplus . ' }
      .social ul li.vimeo a:hover .icon svg { fill: ' . $cor_vimeo . ' } 
      ';   

      if (get_option('msi_borda') == 0) {
        $output .= 
        '
        .social ul li.facebook a:hover .circle svg { stroke: ' . $cor_facebook . ' }
        .social ul li.twitter a:hover .circle svg { stroke: ' . $cor_twitter . ' }
        .social ul li.linkedin a:hover .circle svg { stroke: ' . $cor_linkedin . ' }
        .social ul li.youtube a:hover .circle svg { stroke: ' . $cor_youtube . ' }
        .social ul li.pinterest a:hover .circle svg { stroke: ' . $cor_pinterest . ' }
        .social ul li.instagram a:hover .circle svg { stroke: ' . $cor_instagram . ' }
        .social ul li.googleplus a:hover .circle svg { stroke: ' . $cor_googleplus . ' }
        .social ul li.vimeo a:hover .circle svg { stroke: ' . $cor_vimeo . ' } 
        ';
      } else { $output .= '.social ul li a .circle { stroke: none !important; }'; }


      if (get_option('msi_icone_tipo') == 2 ) {
        $cor_facebook = $cor_twitter = $cor_linkedin = $cor_youtube = $cor_pinterest = $cor_instagram = $cor_googleplus = $cor_vimeo = '#888';
      }
      
      $output .= 
      '
      .social ul li.facebook a .icon svg { fill: ' . $cor_facebook . ' }
      .social ul li.twitter a .icon svg { fill: ' . $cor_twitter . ' }
      .social ul li.linkedin a .icon svg { fill: ' . $cor_linkedin . ' }
      .social ul li.youtube a .icon svg { fill: ' . $cor_youtube . ' }
      .social ul li.pinterest a .icon svg { fill: ' . $cor_pinterest . ' }
      .social ul li.instagram a .icon svg { fill: ' . $cor_instagram . ' }
      .social ul li.googleplus a .icon svg { fill: ' . $cor_googleplus . ' }
      .social ul li.vimeo a .icon svg { fill: ' . $cor_vimeo . ' }  
      ';
      
      if (get_option('msi_borda') == 0) {
        $output .= 
        '
        .social ul li.facebook a .circle svg { stroke: ' . $cor_facebook . ' }
        .social ul li.twitter a .circle svg { stroke: ' . $cor_twitter . ' }
        .social ul li.linkedin a .circle svg { stroke: ' . $cor_linkedin . ' }
        .social ul li.youtube a .circle svg { stroke: ' . $cor_youtube . ' }
        .social ul li.pinterest a .circle svg { stroke: ' . $cor_pinterest . ' }
        .social ul li.instagram a .circle svg { stroke: ' . $cor_instagram . ' }
        .social ul li.googleplus a .circle svg { stroke: ' . $cor_googleplus . ' }
        .social ul li.vimeo a .circle svg { stroke: ' . $cor_vimeo . ' }  
        ';
      }

      if (get_option('msi_fundo')) {
        $output .= '.social ul li a .circle svg { fill: ' . get_option('msi_fundo') . ' } ';
      }
    }

    $output .= '</style>';

    echo $output;
  } else {
   	return false;
  }
 }
 
 add_shortcode('mirago_social_icons', 'mirago_social_show_icons');


add_action('admin_menu', 'mirago_social_icons_menu');

function mirago_social_icons_menu() {
add_theme_page( 
	'Mirago Social Icons', 
	'Redes Sociais', 
	'edit_theme_options', 
	'mirago-social-icons',
	'mirago_social_icons_options'
);	
}

function mirago_social_icons_options(){ ?>
	<div class="wrap">
    <?php
      $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'url';
      if(isset($_GET['tab'])) $active_tab = $_GET['tab'];
    ?>

    <h2>Redes Sociais</h2>
    <!-- <h2 class="nav-tab-wrapper">
    <a href="?page=mirago-social-icons&tab=url" class="nav-tab <?php echo $active_tab == 'url' ? 'nav-tab-active' : ''; ?>">Redes Sociais</a>
    <a href="?page=mirago-social-icons&tab=aparencia" class="nav-tab <?php echo $active_tab == 'aparencia' ? 'nav-tab-active' : ''; ?>">Aparência</a>
    </h2> -->

    <form method="post" action="options.php">
      <?php wp_nonce_field('update-options') ?>
      
      <?php //if($active_tab == 'aparencia') { ?>
        <p>Para exibir os ícones, use o shortcode: [mirago_social_icons]</p>
        <hr />
        <p><strong>Tipo de ícone:</strong>
          <select name="msi_icone_tipo" id="msi-icone-tipo" onchange="icone_tipo_selecionado();">
            <option value="0" <?php if (get_option('msi_icone_tipo') == 0) echo 'selected'; ?>>Padrão</option>
            <option value="1" <?php if (get_option('msi_icone_tipo') == 1) echo 'selected'; ?>>Ícone colorido</option>
            <option value="2" <?php if (get_option('msi_icone_tipo') == 2) echo 'selected'; ?>>Cinza + Hover com cor padrão</option>
            <option value="3" <?php if (get_option('msi_icone_tipo') == 3) echo 'selected'; ?>>Preto</option>
            <option value="4" <?php if (get_option('msi_icone_tipo') == 4) echo 'selected'; ?>>Branco</option>
          </select>
        </p>
        <div class="icone-personalizavel">
          <p><strong>Borda:</strong>
            <select name="msi_borda" id="msi-borda">
              <option value="0" <?php if (get_option('msi_borda') == 0) echo 'selected'; ?>>Ativada</option>
              <option value="1" <?php if (get_option('msi_borda') == 1) echo 'selected'; ?>>Desativada</option>
            </select>
          </p>

          <p><strong>Cor de fundo:</strong>
            <input type="text" name="msi_fundo" id="msi-fundo" class="color-field" value="<?php echo get_option('msi_fundo'); ?>" >
          </p>
        </div>
      <?php // } ?>
      <hr />
      <?php // if($active_tab == 'url') { ?>
        <p><strong>Facebook:</strong><br />
          <input type="text" name="msi_facebook" size="45" value="<?php echo get_option('msi_facebook'); ?>" />
        </p>
        <p><strong>Twitter:</strong><br />
          <input type="text" name="msi_twitter" size="45" value="<?php echo get_option('msi_twitter'); ?>" />
        </p>
        <p><strong>Linkedin:</strong><br />
          <input type="text" name="msi_linkedin" size="45" value="<?php echo get_option('msi_linkedin'); ?>" />
        </p>
        <p><strong>Youtube:</strong><br />
          <input type="text" name="msi_youtube" size="45" value="<?php echo get_option('msi_youtube'); ?>" />
        </p>
        <p><strong>Pinterest:</strong><br />
          <input type="text" name="msi_pinterest" size="45" value="<?php echo get_option('msi_pinterest'); ?>" />
        </p>
        <p><strong>Instagram:</strong><br />
          <input type="text" name="msi_instagram" size="45" value="<?php echo get_option('msi_instagram'); ?>" />
        </p>
        <p><strong>Google Plus:</strong><br />
          <input type="text" name="msi_googleplus" size="45" value="<?php echo get_option('msi_googleplus'); ?>" />
        </p>
        <p><strong>Vimeo:</strong><br />
          <input type="text" name="msi_vimeo" size="45" value="<?php echo get_option('msi_vimeo'); ?>" />
        </p>
      <?php // } ?>
      <p><input type="submit" class="button button-primary" name="Submit" value="Salvar" /></p>
      <input type="hidden" name="action" value="update" />
      <input type="hidden" name="page_options" value="msi_icone_tipo,msi_borda,msi_fundo,msi_facebook,msi_twitter,msi_linkedin,msi_youtube,msi_pinterest,msi_instagram,msi_vimeo,msi_googleplus" />
    </form>
  </div>

<?php } ?>