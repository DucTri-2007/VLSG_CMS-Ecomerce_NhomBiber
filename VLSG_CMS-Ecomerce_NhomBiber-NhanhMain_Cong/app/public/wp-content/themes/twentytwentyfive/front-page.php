<?php
/**
 * Template Name: Biber Helmet Store Front Page
 * Description: Dynamic modern homepage template for Biber Helmet Store.
 */

get_header();
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php wp_title('|', true, 'right'); ?> Biber Helmets Store</title>
  
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  
  <!-- FontAwesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <style>
    :root {
      --bg-dark: #0a0c10;
      --bg-card: rgba(22, 27, 34, 0.75);
      --bg-input: #161b22;
      --border-color: rgba(255, 255, 255, 0.08);
      --primary: #ffb703;
      --primary-hover: #ff9e00;
      --primary-glow: rgba(255, 183, 3, 0.25);
      --accent-cyan: #00f5d4;
      --accent-red: #ff4757;
      --text-main: #f0f6fc;
      --text-muted: #8b949e;
      --text-sub: #c9d1d9;
      --radius-sm: 8px;
      --radius-md: 14px;
      --radius-lg: 20px;
      --radius-full: 9999px;
      --transition-fast: 0.2s cubic-bezier(0.4, 0, 0.2, 1);
      --transition-normal: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
      background-color: var(--bg-dark) !important;
      color: var(--text-main) !important;
      line-height: 1.6;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 1320px;
      margin: 0 auto;
      padding: 0 24px;
    }

    .hero-section-wp {
      position: relative;
      padding: 60px 0 80px 0;
      background: radial-gradient(circle at 70% 30%, rgba(255, 183, 3, 0.08) 0%, transparent 60%);
    }

    .hero-grid-wp {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 50px;
      align-items: center;
    }

    .hero-title-wp {
      font-family: 'Outfit', sans-serif;
      font-size: 48px;
      font-weight: 800;
      color: #fff;
      line-height: 1.15;
      margin-bottom: 20px;
    }

    .btn-primary-wp {
      background: linear-gradient(135deg, var(--primary) 0%, #ff9e00 100%);
      color: #000;
      font-weight: 800;
      padding: 14px 32px;
      border-radius: var(--radius-full);
      display: inline-flex;
      align-items: center;
      gap: 10px;
      text-decoration: none;
      box-shadow: 0 8px 20px var(--primary-glow);
    }

    .product-grid-wp {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 24px;
      margin: 40px 0 80px 0;
    }

    .card-wp {
      background: var(--bg-card);
      border: 1px solid var(--border-color);
      border-radius: var(--radius-md);
      overflow: hidden;
      display: flex;
      flex-direction: column;
      transition: transform 0.3s ease;
    }

    .card-wp:hover {
      transform: translateY(-6px);
      border-color: var(--primary);
    }

    .card-img-wp {
      width: 100%;
      height: 220px;
      object-fit: cover;
    }

    .card-body-wp {
      padding: 20px;
      display: flex;
      flex-direction: column;
      flex-grow: 1;
    }

    .price-wp {
      font-size: 18px;
      font-weight: 800;
      color: var(--primary);
      margin-top: auto;
      padding-top: 12px;
    }

    @media (max-width: 992px) {
      .hero-grid-wp { grid-template-columns: 1fr; }
      .product-grid-wp { grid-template-columns: repeat(2, 1fr); }
    }
  </style>
</head>
<body>

  <!-- HERO BANNER -->
  <section class="hero-section-wp">
    <div class="container">
      <div class="hero-grid-wp">
        <div>
          <span style="color: var(--primary); font-weight: 700; text-transform: uppercase; font-size: 13px; letter-spacing: 1px;">Biber Helmet Store • WordPress CMS</span>
          <h1 class="hero-title-wp">Mũ Bảo Hiểm Cao Cấp <br><span style="color: var(--primary);">Chuẩn ECE 22.06</span></h1>
          <p style="color: var(--text-muted); font-size: 16px; margin-bottom: 30px;">Hệ thống phân phối mũ bảo hiểm Fullface, 3/4, Lật hàm chính hãng AGV, Shoei, HJC, LS2, Royal, Andes.</p>
          <a href="#wc-products" class="btn-primary-wp"><i class="fa-solid fa-bolt"></i> Xem Danh Sách Mũ</a>
        </div>
        <div>
          <img src="https://images.unsplash.com/photo-1599819811279-d5ad9cccf838?auto=format&fit=crop&w=800&q=80" style="border-radius: 20px; width: 100%; border: 1px solid var(--border-color);" alt="Helmet Banner">
        </div>
      </div>
    </div>
  </section>

  <!-- PRODUCTS FROM WOOCOMMERCE OR PRODUCTS DATA -->
  <section class="container" id="wc-products">
    <h2 style="font-family: 'Outfit'; font-size: 32px; color: #fff; margin-top: 40px; text-align: center;">Mũ Bảo Hiểm Nổi Bật</h2>
    <p style="text-align: center; color: var(--text-muted); margin-bottom: 20px;">Tự động đồng bộ sản phẩm từ Hệ Thống Data Architecture & WooCommerce</p>

    <div class="product-grid-wp">
      <?php
      if (function_exists('wc_get_products')) {
          $args = array(
              'limit' => 21,
              'status' => 'publish',
          );
          $products = wc_get_products($args);
          if (!empty($products)) {
              foreach ($products as $product) {
                  $image_url = wp_get_attachment_image_url($product->get_image_id(), 'medium');
                  if (!$image_url) {
                      $image_url = 'https://images.unsplash.com/photo-1599819811279-d5ad9cccf838?auto=format&fit=crop&w=800&q=80';
                  }
                  ?>
                  <div class="card-wp">
                    <img src="<?php echo esc_url($image_url); ?>" class="card-img-wp" alt="<?php echo esc_attr($product->get_name()); ?>">
                    <div class="card-body-wp">
                      <h3 style="font-size: 16px; font-weight: 700; color: #fff; margin-bottom: 8px;"><?php echo esc_html($product->get_name()); ?></h3>
                      <p style="font-size: 13px; color: var(--text-muted);"><?php echo wp_strip_all_tags($product->get_short_description()); ?></p>
                      <div class="price-wp"><?php echo wc_price($product->get_price()); ?></div>
                    </div>
                  </div>
                  <?php
              }
          }
      } else {
          $fallback_products = array(
              array('name' => 'Mũ Bảo Hiểm Fullface AGV K1 S Solid Black', 'price' => '3.950.000 ₫', 'img' => 'https://images.unsplash.com/photo-1599819811279-d5ad9cccf838?auto=format&fit=crop&w=800&q=80'),
              array('name' => 'Mũ Bảo Hiểm Fullface Shoei X-Fifteen White', 'price' => '18.500.000 ₫', 'img' => 'https://images.unsplash.com/photo-1599819811279-d5ad9cccf838?auto=format&fit=crop&w=800&q=80'),
              array('name' => 'Mũ Bảo Hiểm Fullface HJC C70 Lantic MC5SF', 'price' => '2.400.000 ₫', 'img' => 'https://images.unsplash.com/photo-1599819811279-d5ad9cccf838?auto=format&fit=crop&w=800&q=80'),
              array('name' => 'Mũ Bảo Hiểm 3/4 KYT Venom Thần Sấm Thor', 'price' => '2.200.000 ₫', 'img' => 'https://images.unsplash.com/photo-1575844693280-a420df2e4704?auto=format&fit=crop&w=800&q=80'),
              array('name' => 'Mũ Bảo Hiểm 3/4 Andes 3S111 Đen Mờ', 'price' => '480.000 ₫', 'img' => 'https://images.unsplash.com/photo-1575844693280-a420df2e4704?auto=format&fit=crop&w=800&q=80'),
              array('name' => 'Mũ Bảo Hiểm Lật Hàm LS2 FF906 Advant Carbon', 'price' => '12.500.000 ₫', 'img' => 'https://images.unsplash.com/photo-1608508060274-1c31754c44d1?auto=format&fit=crop&w=800&q=80'),
              array('name' => 'Mũ Bảo Hiểm Nửa Đầu Royal M20C Sơn Nhám', 'price' => '320.000 ₫', 'img' => 'https://images.unsplash.com/photo-1608508060274-1c31754c44d1?auto=format&fit=crop&w=800&q=80'),
              array('name' => 'Mũ Bảo Hiểm Fullface Bell Qualifier DLX MIPS', 'price' => '4.800.000 ₫', 'img' => 'https://images.unsplash.com/photo-1599819811279-d5ad9cccf838?auto=format&fit=crop&w=800&q=80')
          );
          foreach ($fallback_products as $p) {
              ?>
              <div class="card-wp">
                <img src="<?php echo esc_url($p['img']); ?>" class="card-img-wp" alt="<?php echo esc_attr($p['name']); ?>">
                <div class="card-body-wp">
                  <h3 style="font-size: 16px; font-weight: 700; color: #fff; margin-bottom: 8px;"><?php echo esc_html($p['name']); ?></h3>
                  <div class="price-wp"><?php echo esc_html($p['price']); ?></div>
                </div>
              </div>
              <?php
          }
      }
      ?>
    </div>
  </section>

<?php get_footer(); ?>
