<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<!--  SUPORT IE 9 GRADIENT-->
<!--[if gte IE 9]>
  <style type="text/css">
    .gradientIE {
       filter: none;
    }
</style>   
<![endif]-->
<!--[if gte IE 9 ]>
<style type="text/css">
    .main-navigation li a{
    	 padding: 16px 16px 15px !important;
    }
    .main-navigation li:first-child {
    margin-left: 1px;
	}
  </style>
<![endif]-->
<style type="text/css">
    .ie10 .main-navigation li a{
    	 padding: 16px 16px 15px !important;
    }
    .ie10 .main-navigation li:first-child {
    margin-left: 1px;
	}
  </style>

<?php wp_head(); ?>

<script type="text/javascript">
jQuery(document).ready(function(){
	if(jQuery.browser.msie && jQuery.browser.version == 10){ 
		jQuery('html').addClass('ie10');
	} 
});
</script>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<header id="masthead" class="site-header" role="banner">
		<hgroup>
			 <a  class="logo-main" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a> 
			 
             <div id="wikihead">
             <?php get_search_form( true );?>
             	<div id="linksocial">
                    <a class="urllink" href="http://www.facebook.com/" rel="nofollow"><img src="http://www.serrate.bo/uploads/Main/logo_facebook.png" alt="Búsquenos en Facebook" title="Búsquenos en Facebook"></a> 
                    <a class="urllink" href="http://www.twitter.com/" rel="nofollow"><img src="http://www.serrate.bo/uploads/Main/logo_twitter.png" alt="Síganos en Twitter" title="Síganos en Twitter"></a> 
                    <a class="urllink" href="http://www.linkedin.com/" rel="nofollow"><img src="http://www.serrate.bo/uploads/Main/logo_in.png" alt="Contáctenos con Linkkedin" title="Contáctenos con Linkkedin"></a> 
                    <a class="urllink" href="http://www.maps.google.com/" rel="nofollow"><img src="http://www.serrate.bo/uploads/Main/logo_mapa.png" alt="Conozca nuestra ubicación" title="Conozca nuestra ubicación"></a> 
             
             		 <a class="selflink" href="http://www.serrate.bo/pmwiki.php/Main/ServiciosLegales"><img src="http://www.serrate.bo/uploads/Main/icono_espanol.png" alt="Ver página en Español" title="Ver página en Español"></a>   <a class="wikilink" href="http://www.serrate.bo/pmwiki.php/PT/ServiciosLegales"><img src="http://www.serrate.bo/uploads/Main/icono_portugues.png" alt="Ver página en Portugués" title="Ver página en Portugués"></a>   <a class="wikilink" href="http://www.serrate.bo/pmwiki.php/EN/ServiciosLegales"><img src="http://www.serrate.bo/uploads/Main/icono_ingles.png" alt="Ver página en Inglés" title="Ver página en Inglés"></a> 
             	</div>
             </div>
		</hgroup>

		<nav id="site-navigation" class="main-navigation" role="navigation"> 
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
		</nav><!-- #site-navigation -->

		 
	</header><!-- #masthead -->

	<div id="main" class="wrapper">