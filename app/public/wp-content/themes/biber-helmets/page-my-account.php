<?php
/**
 * Template Name: My Account Page
 * Description: Trang quản lý tài khoản cá nhân Biker Helmets chuyên nghiệp chuẩn Dark Mode
 */
get_header();
?>

<main class="elementor-container" style="max-width: 1100px; margin: 40px auto; padding: 0 20px; min-height: 70vh;">

  <?php if ( is_user_logged_in() ) : 
    $current_user = wp_get_current_user();
    $initial = strtoupper( substr( $current_user->display_name, 0, 1 ) );
  ?>
    <!-- BANNER PROFILE TÀI KHOẢN -->
    <div style="background: linear-gradient(135deg, #161b22, #0d1117); border: 1px solid var(--global-color-border); border-radius: 16px; padding: 30px; margin-bottom: 30px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.4);">
      <div style="display: flex; align-items: center; gap: 20px;">
        <div style="width: 64px; height: 64px; border-radius: 50%; background: linear-gradient(135deg, #ffb703, #ff9e00); display: flex; align-items: center; justify-content: center; color: #0d1117; font-size: 26px; font-weight: 900; box-shadow: 0 4px 14px rgba(255,183,3,0.4);">
          <?php echo esc_html( $initial ); ?>
        </div>
        <div>
          <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 4px;">
            <h1 style="color: #ffffff; font-size: 24px; font-weight: 800; margin: 0;">
              <?php echo esc_html( $current_user->display_name ); ?>
            </h1>
            <span style="background: rgba(255,183,3,0.15); color: #ffb703; border: 1px solid rgba(255,183,3,0.3); font-size: 11px; font-weight: 700; padding: 2px 10px; border-radius: 99px; text-transform: uppercase;">
              Biker Member
            </span>
          </div>
          <p style="color: #8b949e; font-size: 14px; margin: 0;">
            <i class="fa-regular fa-envelope" style="margin-right: 6px;"></i> <?php echo esc_html( $current_user->user_email ); ?>
          </p>
        </div>
      </div>
      <div>
        <a href="<?php echo esc_url( wp_logout_url( home_url('/my-account/?loggedout=true') ) ); ?>" onclick="try{sessionStorage.clear();localStorage.clear();}catch(e){}" class="btn-outline" style="display: inline-flex; align-items: center; gap: 8px; border: 1px solid rgba(255,107,107,0.4); color: #ff6b6b; font-size: 13px; padding: 8px 18px; border-radius: 8px; text-decoration: none; transition: all 0.2s;" onmouseover="this.style.background='rgba(255,107,107,0.1)'" onmouseout="this.style.background='transparent'" title="Đăng xuất và hủy phiên bảo mật">
          <i class="fa-solid fa-right-from-bracket"></i> Đăng xuất
        </a>
      </div>
    </div>
  <?php endif; ?>

  <!-- NỘI DUNG TÀI KHOẢN WOOCOMMERCE -->
  <div class="page-entry-content">
    <?php
    if ( have_posts() ) :
      while ( have_posts() ) : the_post();
        the_content();
      endwhile;
    endif;
    ?>
  </div>

</main>

<?php
get_footer();
