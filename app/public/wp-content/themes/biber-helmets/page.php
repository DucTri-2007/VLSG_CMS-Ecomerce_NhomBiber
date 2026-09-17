<?php
/**
 * Template Name: Page Template
 * Description: Hiển thị các trang tĩnh (Giỏ hàng, Thanh toán, Tài khoản, v.v.)
 */
get_header();
?>

<main class="elementor-container" style="max-width: 1200px; margin: 40px auto; padding: 40px 24px; min-height: 65vh; background: #161b22; border-radius: 12px; border: 1px solid rgba(255,255,255,0.08); color: #f0f6fc;">
  <?php
  if ( have_posts() ) :
    while ( have_posts() ) : the_post();
      ?>
      <h1 style="color: #ffb703; font-size: 28px; margin-bottom: 24px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 12px;">
        <?php the_title(); ?>
      </h1>
      <div class="page-entry-content" style="line-height: 1.8; color: #f0f6fc;">
        <?php the_content(); ?>
      </div>
      <?php
    endwhile;
  endif;
  ?>
</main>

<?php
get_footer();
?>
