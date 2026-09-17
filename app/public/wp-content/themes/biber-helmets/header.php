<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trang Chủ Biker | Mũ Bảo Hiểm Chính Hãng ECE 22.06</title>
  <meta name="description" content="Trang chủ Biker - Chuyên mũ bảo hiểm Fullface, 3/4, Lật hàm chính hãng AGV, Shoei, HJC. Đạt tiêu chuẩn an toàn quốc tế ECE 22.06 & DOT.">
  
  <!-- Global Fonts: Inter, Outfit, Roboto với chuẩn Tiếng Việt không lỗi font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Outfit:wght@400;500;600;700;800;900&family=Roboto:ital,wght@0,400;0,500;0,700;1,400&display=swap&subset=vietnamese" rel="stylesheet">
  
  <!-- FontAwesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <!-- CSS moved to style.css -->
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

  <!-- HEADER TỐI ƯU -->
  <header class="elementor-header">
    <div class="elementor-container">
      <div class="header-inner">
        <?php
          $logo_primary   = get_template_directory_uri() . '/assets/images/biker-logo.png';
          $logo_fallback1 = get_template_directory_uri() . '/assets/images/biker-logo.jpg';
          $logo_fallback2 = get_template_directory_uri() . '/assets/images/biker-badge-logo.jpg';
        ?>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo" title="Biker Helmets - Mũ Bảo Hiểm Chính Hãng">
          <img src="<?php echo esc_url($logo_primary); ?>" alt="Biker Helmets Logo" onerror="this.onerror=null;this.src='<?php echo esc_url($logo_fallback1); ?>';this.onerror=function(){this.src='<?php echo esc_url($logo_fallback2); ?>';};" style="height: 48px; width: auto; max-width: 180px; object-fit: contain; filter: drop-shadow(0 2px 8px rgba(0,0,0,0.5)); display: block;">
        </a>

        <ul class="nav-menu">
          <li><a href="<?php echo esc_url(home_url('/')); ?>">Trang Chủ</a></li>
          <li><a href="<?php echo esc_url(function_exists('biker_get_shop_url') ? biker_get_shop_url() : home_url('/shop/')); ?>">Sản Phẩm</a></li>
          <li><a href="<?php echo esc_url(function_exists('biker_get_posts_url') ? biker_get_posts_url() : home_url('/tin-tuc/')); ?>">Bài Viết</a></li>
          <li><a href="<?php echo esc_url(function_exists('wc_get_cart_url') ? wc_get_cart_url() : home_url('/cart/')); ?>">Giỏ Hàng</a></li>
          <li><a href="<?php echo esc_url(function_exists('wc_get_checkout_url') ? wc_get_checkout_url() : home_url('/checkout/')); ?>">Thanh Toán</a></li>
        </ul>
        
        <div class="header-actions" style="display: flex; align-items: center; gap: 14px;">
          <?php if ( class_exists( 'WooCommerce' ) ) : ?>
            <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="biker-cart-btn" title="Xem giỏ hàng" style="position: relative; display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.12); border-radius: 50%; color: #f0f6fc; text-decoration: none; transition: all 0.3s ease;">
              <i class="fa-solid fa-cart-shopping" style="font-size: 15px; color: #ffb703;"></i>
              <span class="biker-cart-count" style="position: absolute; top: -4px; right: -4px; background: #ffb703; color: #000; font-size: 11px; font-weight: 800; border-radius: 50%; width: 18px; height: 18px; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 5px rgba(0,0,0,0.5);">
                <?php echo ( WC()->cart ) ? WC()->cart->get_cart_contents_count() : 0; ?>
              </span>
            </a>
          <?php endif; ?>

          <?php if ( is_user_logged_in() ) : 
            $current_user = wp_get_current_user();
            $initial = strtoupper( substr( $current_user->display_name, 0, 1 ) );
          ?>
            <div class="user-menu" style="display: inline-flex; align-items: center; gap: 8px;">
              <a href="<?php echo esc_url( home_url('/my-account/') ); ?>" class="user-avatar-btn" style="display:flex; align-items:center; gap:8px; background:rgba(255,183,3,0.12); border:1px solid rgba(255,183,3,0.3); border-radius:50px; padding:4px 12px 4px 5px; text-decoration:none; color:#f0f6fc; font-size:13px; font-weight:600;">
                <div style="width:26px; height:26px; border-radius:50%; background:linear-gradient(135deg,#ffb703,#ff9e00); display:flex; align-items:center; justify-content:center; color:#0d1117; font-weight:800; font-size:12px;">
                  <?php echo esc_html( $initial ); ?>
                </div>
                <span><?php echo esc_html( $current_user->display_name ); ?></span>
              </a>
              <a href="<?php echo esc_url( wp_logout_url( home_url('/my-account/?loggedout=true') ) ); ?>" onclick="try{sessionStorage.clear();localStorage.clear();}catch(e){}" title="Đăng xuất và hủy phiên" style="color: #8b949e; font-size: 14px; text-decoration: none; padding: 6px;" onmouseover="this.style.color='#ff6b6b'" onmouseout="this.style.color='#8b949e'">
                <i class="fa-solid fa-right-from-bracket"></i>
              </a>
            </div>
          <?php else : ?>
            <a href="<?php echo esc_url( home_url('/my-account/') ); ?>" class="btn-login"><i class="fa-regular fa-user" style="margin-right: 6px;"></i> Tài Khoản</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </header>