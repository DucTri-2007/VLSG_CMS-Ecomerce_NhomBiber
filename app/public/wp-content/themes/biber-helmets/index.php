<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trang Chủ Biber Helmets | Mũ Bảo Hiểm Chính Hãng ECE 22.06</title>
  <meta name="description" content="Trang chủ Biber Helmets - Chuyên mũ bảo hiểm Fullface, 3/4, Lật hàm chính hãng AGV, Shoei, HJC. Đạt tiêu chuẩn an toàn quốc tế ECE 22.06 & DOT.">
  
  <!-- Global Fonts: Inter & Roboto -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
  
  <!-- FontAwesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <style>
    :root {
      --global-color-primary: #ffb703;     /* Primary Brand Color */
      --global-color-primary-hover: #ff9e00;
      --global-color-secondary: #161b22;   /* Secondary Dark Surface */
      --global-color-text: #f0f6fc;        /* Primary Text */
      --global-color-muted: #8b949e;       /* Muted Text */
      --global-color-accent: #00f5d4;      /* Accent Color */
      --global-color-bg: #0d1117;          /* Background Dark */
      --global-color-border: rgba(255, 255, 255, 0.08);
      
      --font-primary: 'Inter', sans-serif;
      --font-secondary: 'Roboto', sans-serif;
    }
    
    *, *::before, *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    
    html {
      scroll-behavior: smooth;
    }
    
    body {
      font-family: var(--font-primary);
      background-color: var(--global-color-bg);
      color: var(--global-color-text);
      line-height: 1.6;
      overflow-x: hidden;
      -webkit-font-smoothing: antialiased;
    }

    .elementor-container {
      max-width: 1280px;
      margin: 0 auto;
      padding: 0 24px;
    }

    /* HEADER GLASSMORPHISM */
    .elementor-header {
      background: rgba(13, 17, 23, 0.7);
      border-bottom: 1px solid var(--global-color-border);
      position: sticky;
      top: 0;
      z-index: 1000;
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      transition: all 0.3s ease;
    }

    .header-inner {
      display: flex;
      justify-content: space-between;
      align-items: center;
      height: 80px;
    }

    .site-logo {
      display: flex;
      align-items: center;
      gap: 12px;
      font-size: 26px;
      font-weight: 900;
      color: #fff;
      text-decoration: none;
      letter-spacing: -0.5px;
      transition: transform 0.3s ease;
    }

    .site-logo:hover {
      transform: scale(1.02);
    }

    .site-logo i {
      color: var(--global-color-primary);
      font-size: 28px;
      filter: drop-shadow(0 0 8px rgba(255, 183, 3, 0.4));
    }

    .nav-menu {
      display: flex;
      gap: 32px;
      list-style: none;
    }

    .nav-menu a {
      color: var(--global-color-text);
      text-decoration: none;
      font-weight: 500;
      font-size: 15px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      position: relative;
      padding: 8px 0;
      transition: color 0.3s ease;
    }

    .nav-menu a::after {
      content: '';
      position: absolute;
      width: 0;
      height: 2px;
      bottom: 0;
      left: 0;
      background-color: var(--global-color-primary);
      transition: width 0.3s ease;
      box-shadow: 0 0 10px var(--global-color-primary);
    }

    .nav-menu a:hover {
      color: var(--global-color-primary);
    }

    .nav-menu a:hover::after {
      width: 100%;
    }

    .header-actions .btn-login {
      background: transparent;
      border: 1px solid var(--global-color-primary);
      color: var(--global-color-primary);
      padding: 10px 24px;
      border-radius: 99px;
      text-decoration: none;
      font-weight: 600;
      font-size: 14px;
      transition: all 0.3s ease;
    }
    
    .header-actions .btn-login:hover {
      background: var(--global-color-primary);
      color: #000;
      box-shadow: 0 0 15px rgba(255, 183, 3, 0.4);
    }

    /* SECTION HERO */
    .elementor-section-hero {
      position: relative;
      padding: 120px 0;
      min-height: 90vh;
      display: flex;
      align-items: center;
      border-bottom: 1px solid var(--global-color-border);
      overflow: hidden;
    }

    .hero-bg-glow {
      position: absolute;
      top: 50%;
      right: 10%;
      width: 600px;
      height: 600px;
      background: radial-gradient(circle, rgba(255, 183, 3, 0.15) 0%, transparent 60%);
      transform: translateY(-50%);
      z-index: 0;
      pointer-events: none;
    }

    .elementor-row {
      display: flex;
      align-items: center;
      gap: 60px;
      position: relative;
      z-index: 1;
    }

    .elementor-column-50 {
      flex: 1;
      width: calc(50% - 30px);
    }

    .badge-premium {
      display: inline-block;
      padding: 6px 16px;
      background: rgba(255, 183, 3, 0.1);
      border: 1px solid rgba(255, 183, 3, 0.3);
      color: var(--global-color-primary);
      border-radius: 99px;
      font-size: 13px;
      font-weight: 600;
      letter-spacing: 1px;
      text-transform: uppercase;
      margin-bottom: 24px;
      animation: fadeInDown 1s ease-out;
    }

    .elementor-widget-heading h1 {
      font-size: 56px;
      font-weight: 900;
      line-height: 1.1;
      margin-bottom: 24px;
      color: #ffffff;
      letter-spacing: -1px;
      animation: fadeInLeft 1s ease-out 0.2s both;
    }

    .elementor-widget-heading h1 span {
      background: linear-gradient(90deg, var(--global-color-primary), #fff000);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      display: inline-block;
    }

    .elementor-widget-text-editor p {
      font-size: 18px;
      color: var(--global-color-muted);
      margin-bottom: 40px;
      line-height: 1.7;
      max-width: 90%;
      animation: fadeInLeft 1s ease-out 0.4s both;
    }

    .hero-buttons {
      display: flex;
      gap: 20px;
      animation: fadeInLeft 1s ease-out 0.6s both;
    }

    .btn-glow {
      display: inline-flex;
      align-items: center;
      gap: 12px;
      background: var(--global-color-primary);
      color: #000000;
      font-weight: 700;
      font-size: 16px;
      padding: 16px 40px;
      border-radius: 99px;
      text-decoration: none;
      border: none;
      cursor: pointer;
      transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      position: relative;
      overflow: hidden;
    }

    .btn-glow i {
      font-size: 18px;
    }

    .btn-glow::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
      transition: all 0.5s ease;
    }

    .btn-glow:hover {
      transform: translateY(-3px) scale(1.02);
      box-shadow: 0 10px 25px rgba(255, 183, 3, 0.5);
    }

    .btn-glow:hover::before {
      left: 100%;
    }

    .btn-outline {
      display: inline-flex;
      align-items: center;
      gap: 12px;
      background: transparent;
      color: #fff;
      font-weight: 700;
      font-size: 16px;
      padding: 16px 40px;
      border-radius: 99px;
      text-decoration: none;
      border: 1px solid var(--global-color-border);
      transition: all 0.3s ease;
    }

    .btn-outline:hover {
      background: rgba(255,255,255,0.05);
      border-color: rgba(255,255,255,0.2);
    }

    .hero-image-wrapper {
      position: relative;
      animation: fadeInRight 1s ease-out 0.4s both;
      max-width: 500px;
      margin: 0 auto;
    }

    .hero-image-wrapper::before {
      content: '';
      position: absolute;
      inset: -10px;
      background: linear-gradient(45deg, var(--global-color-primary), transparent 60%);
      border-radius: 30px;
      z-index: -1;
      opacity: 0.3;
      filter: blur(20px);
    }

    .hero-image-wrapper img {
      width: 100%;
      height: auto;
      object-fit: cover;
      border-radius: 24px;
      border: 1px solid rgba(255,255,255,0.1);
      box-shadow: 0 30px 60px rgba(0, 0, 0, 0.8);
      display: block;
      transition: transform 0.5s ease;
    }

    .hero-image-wrapper:hover img {
      transform: translateY(-10px);
    }

    /* SECTION SẢN PHẨM */
    .elementor-section-products {
      padding: 120px 0;
      background-color: #0a0c10;
    }

    .section-header {
      text-align: center;
      margin-bottom: 60px;
    }

    .elementor-widget-heading h2 {
      font-size: 40px;
      font-weight: 900;
      margin-bottom: 16px;
      color: #ffffff;
      letter-spacing: -0.5px;
    }

    .section-subtitle {
      color: var(--global-color-muted);
      font-size: 18px;
      max-width: 600px;
      margin: 0 auto;
    }

    .product-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 30px;
    }

    .product-card {
      background: #11151d;
      border: 1px solid var(--global-color-border);
      border-radius: 20px;
      padding: 20px;
      display: flex;
      flex-direction: column;
      transition: all 0.4s ease;
      position: relative;
      overflow: hidden;
      group: product;
    }

    .product-card::before {
      content: '';
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
      border-radius: 20px;
      padding: 2px;
      background: linear-gradient(45deg, transparent, rgba(255, 183, 3, 0.1), transparent);
      -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
      -webkit-mask-composite: xor;
      mask-composite: exclude;
      opacity: 0;
      transition: opacity 0.4s ease;
    }

    .product-card:hover {
      transform: translateY(-10px);
      background: #161b22;
      box-shadow: 0 20px 40px rgba(0,0,0,0.4);
    }

    .product-card:hover::before {
      opacity: 1;
    }

    .product-img-wrap {
      position: relative;
      overflow: hidden;
      border-radius: 12px;
      margin-bottom: 20px;
    }

    .product-card img {
      width: 100%;
      height: 240px;
      object-fit: cover;
      transition: transform 0.6s ease;
    }

    .product-card:hover img {
      transform: scale(1.08);
    }
    
    .product-badge {
      position: absolute;
      top: 10px;
      right: 10px;
      background: var(--global-color-primary);
      color: #000;
      font-size: 11px;
      font-weight: 800;
      padding: 4px 10px;
      border-radius: 4px;
      text-transform: uppercase;
    }

    .product-card h3 {
      font-size: 18px;
      font-weight: 700;
      margin-bottom: 10px;
      color: #ffffff;
      line-height: 1.4;
    }

    .product-spec {
      font-size: 13px;
      color: var(--global-color-muted);
      display: flex;
      align-items: center;
      gap: 6px;
      margin-bottom: 16px;
    }

    .product-card .price {
      font-size: 20px;
      font-weight: 800;
      color: var(--global-color-primary);
      margin-top: auto;
    }

    .add-to-cart {
      margin-top: 20px;
      width: 100%;
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255,255,255,0.1);
      color: #fff;
      padding: 12px;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 8px;
    }

    .product-card:hover .add-to-cart {
      background: var(--global-color-primary);
      color: #000;
      border-color: var(--global-color-primary);
    }

    /* FOOTER (NEW) */
    .site-footer {
      background: #050608;
      padding: 80px 0 30px;
      border-top: 1px solid var(--global-color-border);
    }

    .footer-grid {
      display: grid;
      grid-template-columns: 2fr 1fr 1fr 1fr;
      gap: 40px;
      margin-bottom: 60px;
    }

    .footer-col h4 {
      color: #fff;
      font-size: 18px;
      font-weight: 700;
      margin-bottom: 24px;
    }

    .footer-desc {
      color: var(--global-color-muted);
      font-size: 14px;
      margin-top: 16px;
      line-height: 1.8;
      max-width: 80%;
    }

    .footer-links {
      list-style: none;
    }

    .footer-links li {
      margin-bottom: 12px;
    }

    .footer-links a {
      color: var(--global-color-muted);
      text-decoration: none;
      font-size: 14px;
      transition: color 0.3s ease;
    }

    .footer-links a:hover {
      color: var(--global-color-primary);
    }

    .social-links {
      display: flex;
      gap: 16px;
      margin-top: 24px;
    }

    .social-links a {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: rgba(255,255,255,0.05);
      color: #fff;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .social-links a:hover {
      background: var(--global-color-primary);
      color: #000;
      transform: translateY(-3px);
    }

    .footer-bottom {
      text-align: center;
      padding-top: 30px;
      border-top: 1px solid rgba(255,255,255,0.05);
      color: var(--global-color-muted);
      font-size: 14px;
    }

    /* ANIMATIONS */
    @keyframes fadeInLeft {
      from { opacity: 0; transform: translateX(-30px); }
      to { opacity: 1; transform: translateX(0); }
    }
    @keyframes fadeInRight {
      from { opacity: 0; transform: translateX(30px); }
      to { opacity: 1; transform: translateX(0); }
    }
    @keyframes fadeInDown {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* RESPONSIVE */
    @media (max-width: 1024px) {
      .product-grid { grid-template-columns: repeat(2, 1fr); }
      .footer-grid { grid-template-columns: 1fr 1fr; }
    }

    @media (max-width: 768px) {
      .elementor-header { padding: 10px 0; }
      .nav-menu { display: none; } /* Thường ẩn menu hoặc dùng hamburger trên mobile */
      .header-actions { display: none; }
      
      .elementor-section-hero { padding: 80px 0; text-align: center; }
      .elementor-row { flex-direction: column; gap: 40px; }
      .elementor-column-50 { width: 100%; }
      .elementor-widget-text-editor p { max-width: 100%; margin: 0 auto 30px; }
      .hero-buttons { justify-content: center; flex-wrap: wrap; }
      .hero-bg-glow { right: 50%; transform: translate(50%, -50%); }
      
      .elementor-widget-heading h1 { font-size: 40px; }
      .elementor-widget-heading h2 { font-size: 32px; }
      
      .footer-grid { grid-template-columns: 1fr; gap: 30px; }
      .footer-desc { max-width: 100%; }
    }

    @media (max-width: 480px) {
      .product-grid { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>

  <!-- HEADER TỐI ƯU -->
  <header class="elementor-header">
    <div class="elementor-container">
      <div class="header-inner">
        <a href="#" class="site-logo">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/biker-badge-logo.jpg" alt="Biker Logo" style="height:52px;width:auto;object-fit:contain;filter:invert(1);">
          <span style="font-size:22px;font-weight:900;letter-spacing:1px;"><span style="color:#ffffff;">Bi</span><span style="color:#f5a623;">ker</span></span>
        </a>

        <ul class="nav-menu">
          <li><a href="#">Trang Chủ</a></li>
          <li><a href="#products">Sản Phẩm</a></li>
          <li><a href="#about">Về Chúng Tôi</a></li>
          <li><a href="#seo-blog">Bài Viết</a></li>
        </ul>
        
        <div class="header-actions" id="headerActions">
          <a href="#" class="btn-login" id="btnOpenLogin" onclick="document.getElementById('loginModal').classList.add('active');return false;">
            <i class="fa-regular fa-user" style="margin-right:6px;"></i> Đăng nhập
          </a>
        </div>
      </div>
    </div>
  </header>

  <!-- SECTION HERO MỚI -->
  <section class="elementor-section-hero">
    <div class="hero-bg-glow"></div>
    <div class="elementor-container">
      <div class="elementor-row">
        
        <!-- COLUMN 1: NỘI DUNG -->
        <div class="elementor-column-50">
          <div class="badge-premium"><i class="fa-solid fa-medal"></i> Đại lý ủy quyền chính hãng</div>
          <div class="elementor-widget-heading">
            <h1>Chinh Phục Mọi Nẻo Đường Với<br><span>Mũ Bảo Hiểm Đẳng Cấp</span></h1>
          </div>

          <div class="elementor-widget-text-editor">
            <p>Bảo vệ tối đa hành trình phượt của bạn với các dòng mũ Fullface, 3/4 và Lật hàm chính hãng AGV, Shoei, HJC đạt chuẩn an toàn quốc tế ECE 22.06 & DOT mới nhất.</p>
          </div>

          <div class="hero-buttons">
            <a href="#products" class="btn-glow">
              Khám Phá Ngay <i class="fa-solid fa-arrow-right"></i>
            </a>
            <a href="#video" class="btn-outline">
              <i class="fa-regular fa-circle-play"></i> Xem Video
            </a>
          </div>
        </div>

        <!-- COLUMN 2: ẢNH HERO MỚI -->
        <div class="elementor-column-50">
          <div class="hero-image-wrapper">
            <img src="https://images.unsplash.com/photo-1558981403-c5f9899a28bc?auto=format&fit=crop&w=1600&q=80" alt="Biker wearing helmet">
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- SECTION SẢN PHẨM NỔI BẬT -->
  <section class="elementor-section-products" id="products">
    <div class="elementor-container">
      <div class="section-header">
        <div class="elementor-widget-heading">
          <h2>Bộ Sưu Tập Đỉnh Cao</h2>
        </div>
        <p class="section-subtitle">Lựa chọn hàng đầu của các Biker chuyên nghiệp. Các sản phẩm đều vượt qua bài kiểm tra an toàn khắt khe nhất.</p>
      </div>

      <div class="product-grid">
        <!-- SẢN PHẨM 1 -->
        <div class="product-card">
          <div class="product-img-wrap">
            <div class="product-badge">Best Seller</div>
            <img src="./agv-k1-s-solid-black.jpg" alt="AGV K1 S">
          </div>
          <h3>Mũ Fullface AGV K1 S Solid Black</h3>
          <div class="product-spec"><i class="fa-solid fa-shield-halved"></i> Chuẩn an toàn ECE 22.06</div>
          <div class="price">3.950.000 ₫</div>
          <button class="add-to-cart"><i class="fa-solid fa-credit-card"></i> Mua và thanh toán</button>
        </div>

        <!-- SẢN PHẨM 2 -->
        <div class="product-card">
          <div class="product-img-wrap">
            <div class="product-badge" style="background: #00f5d4;">Premium</div>
            <img src="./shoei-x-fifteen-white.jpg" alt="Shoei X-Fifteen">
          </div>
          <h3>Mũ Fullface Shoei X-Fifteen White</h3>
          <div class="product-spec"><i class="fa-solid fa-shield-halved"></i> Chuẩn JIS, SNELL & ECE</div>
          <div class="price">18.500.000 ₫</div>
          <button class="add-to-cart"><i class="fa-solid fa-credit-card"></i> Mua và thanh toán</button>
        </div>

        <!-- SẢN PHẨM 3 -->
        <div class="product-card">
          <div class="product-img-wrap">
            <img src="./kyt-venom-marvel.jpg" alt="KYT Venom">
          </div>
          <h3>Mũ 3/4 KYT Venom Thor Marvel</h3>
          <div class="product-spec"><i class="fa-solid fa-shield-halved"></i> Chuẩn ECE 22.05</div>
          <div class="price">2.200.000 ₫</div>
          <button class="add-to-cart"><i class="fa-solid fa-credit-card"></i> Mua và thanh toán</button>
        </div>

        <!-- SẢN PHẨM 4 -->
        <div class="product-card">
          <div class="product-img-wrap">
            <img src="./ls2-carbon.jpg" alt="LS2 FF906">
          </div>
          <h3>Mũ Lật Hàm LS2 FF906 Advant Carbon</h3>
          <div class="product-spec"><i class="fa-solid fa-shield-halved"></i> Sợi Carbon 180°</div>
          <div class="price">12.500.000 ₫</div>
          <button class="add-to-cart"><i class="fa-solid fa-credit-card"></i> Mua và thanh toán</button>
        </div>
      </div>
    </div>
  </section>

  <!-- FOOTER MỚI THÊM VÀO -->
  <footer class="site-footer">
    <div class="elementor-container">
      <div class="footer-grid">
        <div class="footer-col">
          <a href="#" class="site-logo">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/biker-badge-logo.jpg" alt="Biker Logo" style="height:52px;width:auto;object-fit:contain;filter:invert(1);">
            <span style="font-size:22px;font-weight:900;letter-spacing:1px;"><span style="color:#ffffff;">Bi</span><span style="color:#f5a623;">ker</span></span>
          </a>
          <p class="footer-desc">Hệ thống phân phối mũ bảo hiểm và đồ bảo hộ motor chính hãng hàng đầu tại Việt Nam. Đồng hành cùng bạn trên mọi cung đường.</p>
          <div class="social-links">
            <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#"><i class="fa-brands fa-instagram"></i></a>
            <a href="#"><i class="fa-brands fa-tiktok"></i></a>
            <a href="#"><i class="fa-brands fa-youtube"></i></a>
          </div>
        </div>

        <div class="footer-col">
          <h4>Sản Phẩm</h4>
          <ul class="footer-links">
            <li><a href="#">Mũ Fullface</a></li>
            <li><a href="#">Mũ 3/4</a></li>
            <li><a href="#">Mũ Lật Hàm</a></li>
            <li><a href="#">Đồ Bảo Hộ</a></li>
          </ul>
        </div>

        <div class="footer-col">
          <h4>Chính Sách</h4>
          <ul class="footer-links">
            <li><a href="#">Bảo hành đổi trả</a></li>
            <li><a href="#">Chính sách vận chuyển</a></li>
            <li><a href="#">Bảo mật thông tin</a></li>
            <li><a href="#">Hướng dẫn chọn size</a></li>
          </ul>
        </div>

        <div class="footer-col">
          <h4>Liên Hệ</h4>
          <ul class="footer-links">
            <li><a href="#"><i class="fa-solid fa-location-dot" style="margin-right: 8px;"></i> 123 Đường Biker, Quận 1, TP.HCM</a></li>
            <li><a href="#"><i class="fa-solid fa-phone" style="margin-right: 8px;"></i> 0909 123 456</a></li>
            <li><a href="#"><i class="fa-solid fa-envelope" style="margin-right: 8px;"></i> support@biberhelmets.vn</a></li>
          </ul>
        </div>
      </div>
      
      <div class="footer-bottom">
        <p>&copy; 2026 Biber Helmets. All rights reserved.</p>
      </div>
    </div>
  </footer>

  <!-- MODAL ĐĂNG NHẬP -->
  <div id="loginModal" style="display:none;position:fixed;inset:0;z-index:9999;align-items:center;justify-content:center;background:rgba(0,0,0,0.75);backdrop-filter:blur(6px);" onclick="if(event.target===this)this.classList.remove('active')">
    <div style="background:#161b22;border:1px solid rgba(255,255,255,0.1);border-radius:16px;padding:40px 36px;width:100%;max-width:420px;position:relative;box-shadow:0 25px 60px rgba(0,0,0,0.5);animation:slideUp 0.3s ease;">
      <!-- Close -->
      <button onclick="document.getElementById('loginModal').classList.remove('active')" style="position:absolute;top:16px;right:16px;background:transparent;border:none;color:#8b949e;font-size:20px;cursor:pointer;line-height:1;">&#x2715;</button>

      <!-- Logo mini -->
      <div style="text-align:center;margin-bottom:24px;">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/biker-badge-logo.jpg" alt="Biker" style="height:56px;filter:invert(1);margin-bottom:8px;">
        <h2 style="color:#fff;font-size:20px;font-weight:800;margin:0;"><span style="color:#fff;">Bi</span><span style="color:#f5a623;">ker</span></h2>
        <p style="color:#8b949e;font-size:13px;margin:4px 0 0;">Đăng nhập vào tài khoản của bạn</p>
      </div>

      <!-- Form -->
      <form id="loginForm" onsubmit="handleLogin(event)">
        <div style="margin-bottom:16px;">
          <label style="display:block;color:#f0f6fc;font-size:13px;font-weight:600;margin-bottom:6px;"><i class="fa-regular fa-user" style="margin-right:6px;color:#f5a623;"></i>Tên đăng nhập</label>
          <input id="loginUser" type="text" placeholder="Nhập tên đăng nhập..." required
            style="width:100%;padding:12px 14px;background:#0d1117;border:1px solid rgba(255,255,255,0.12);border-radius:8px;color:#f0f6fc;font-size:14px;outline:none;box-sizing:border-box;transition:border 0.2s;"
            onfocus="this.style.borderColor='#f5a623'" onblur="this.style.borderColor='rgba(255,255,255,0.12)'">
        </div>
        <div style="margin-bottom:8px;">
          <label style="display:block;color:#f0f6fc;font-size:13px;font-weight:600;margin-bottom:6px;"><i class="fa-solid fa-lock" style="margin-right:6px;color:#f5a623;"></i>Mật khẩu</label>
          <div style="position:relative;">
            <input id="loginPass" type="password" placeholder="Nhập mật khẩu..." required
              style="width:100%;padding:12px 44px 12px 14px;background:#0d1117;border:1px solid rgba(255,255,255,0.12);border-radius:8px;color:#f0f6fc;font-size:14px;outline:none;box-sizing:border-box;transition:border 0.2s;"
              onfocus="this.style.borderColor='#f5a623'" onblur="this.style.borderColor='rgba(255,255,255,0.12)'">
            <button type="button" onclick="togglePass()" style="position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;color:#8b949e;cursor:pointer;font-size:15px;"><i id="eyeIcon" class="fa-regular fa-eye"></i></button>
          </div>
        </div>
        <div style="text-align:right;margin-bottom:20px;">
          <a href="/wp-login.php?action=lostpassword" style="color:#f5a623;font-size:12px;text-decoration:none;">Quên mật khẩu?</a>
        </div>
        <div id="loginError" style="display:none;background:rgba(255,80,80,0.12);border:1px solid rgba(255,80,80,0.3);border-radius:8px;padding:10px 14px;color:#ff6b6b;font-size:13px;margin-bottom:16px;"></div>
        <button id="loginBtn" type="submit"
          style="width:100%;padding:13px;background:linear-gradient(135deg,#f5a623,#ff9e00);border:none;border-radius:8px;color:#0d1117;font-size:15px;font-weight:800;cursor:pointer;letter-spacing:0.5px;transition:opacity 0.2s;"
          onmouseover="this.style.opacity='0.88'" onmouseout="this.style.opacity='1'">
          <i class="fa-solid fa-right-to-bracket" style="margin-right:6px;"></i> Đăng nhập
        </button>
      </form>

      <p style="text-align:center;color:#8b949e;font-size:13px;margin-top:20px;margin-bottom:0;">Chưa có tài khoản? <a href="/wp-login.php?action=register" style="color:#f5a623;font-weight:600;text-decoration:none;">Đăng ký ngay</a></p>
    </div>
  </div>

  <style>
    #loginModal { display:flex!important; opacity:0; pointer-events:none; transition:opacity 0.25s; }
    #loginModal.active { opacity:1; pointer-events:all; }
    @keyframes slideUp { from{transform:translateY(30px);opacity:0} to{transform:translateY(0);opacity:1} }

    /* User dropdown */
    .user-menu { position:relative; display:inline-flex; align-items:center; }
    .user-avatar-btn {
      display:flex; align-items:center; gap:8px;
      background:rgba(245,166,35,0.12); border:1px solid rgba(245,166,35,0.3);
      border-radius:50px; padding:6px 14px 6px 6px;
      cursor:pointer; transition:all 0.2s; color:#f0f6fc; font-size:14px; font-weight:600;
    }
    .user-avatar-btn:hover { background:rgba(245,166,35,0.22); border-color:#f5a623; }
    .user-avatar-circle {
      width:30px; height:30px; border-radius:50%;
      background:linear-gradient(135deg,#f5a623,#ff9e00);
      display:flex; align-items:center; justify-content:center;
      color:#0d1117; font-weight:800; font-size:13px;
    }
    .user-dropdown {
      display:none; position:absolute; top:calc(100% + 10px); right:0;
      background:#161b22; border:1px solid rgba(255,255,255,0.1);
      border-radius:12px; min-width:200px;
      box-shadow:0 20px 40px rgba(0,0,0,0.5); z-index:999;
      overflow:hidden; animation:slideUp 0.2s ease;
    }
    .user-menu:hover .user-dropdown, .user-menu.open .user-dropdown { display:block; }
    .user-dropdown-header {
      padding:14px 16px; border-bottom:1px solid rgba(255,255,255,0.08);
    }
    .user-dropdown-header .ud-name { color:#f0f6fc; font-weight:700; font-size:14px; }
    .user-dropdown-header .ud-role { color:#8b949e; font-size:11px; margin-top:2px; }
    .user-dropdown-item {
      display:flex; align-items:center; gap:10px;
      padding:11px 16px; color:#f0f6fc; font-size:13px;
      text-decoration:none; transition:background 0.15s; cursor:pointer;
      border:none; background:none; width:100%; text-align:left;
    }
    .user-dropdown-item:hover { background:rgba(255,255,255,0.06); }
    .user-dropdown-item.logout { color:#ff6b6b; }
    .user-dropdown-item.logout:hover { background:rgba(255,80,80,0.1); }
    .user-dropdown-item i { width:16px; text-align:center; }
  </style>

  <script>
    /* ===== KIỂM TRA ĐĂNG NHẬP QUA PHP ===== */
    window.wpLogoutUrl = '';
    function checkLoginStatus() {
      fetch('/auth-check.php', { credentials: 'include' })
        .then(r => r.ok ? r.json() : null)
        .then(data => {
          if (data && data.logged_in) {
            window.wpLogoutUrl = data.logout_url;
            renderLoggedIn(data);
          } else {
            renderLoggedOut();
          }
        })
        .catch(() => renderLoggedOut());
    }

    function renderLoggedIn(user) {
      var initials = (user.name || 'U').substring(0, 1).toUpperCase();
      var displayName = user.name || 'Tài khoản';
      var role = (user.roles && user.roles[0]) === 'administrator' ? 'Quản trị viên' :
                 (user.roles && user.roles[0]) === 'editor' ? 'Biên tập viên' : 'Thành viên';

      document.getElementById('headerActions').innerHTML =
        '<div style="display:flex; align-items:center; gap:16px;">' +
          '<a href="/wp-admin/" style="color:#f5a623; font-weight:600; font-size:14px; text-decoration:none;"><i class="fa-solid fa-gauge" style="margin-right:6px;"></i>Admin</a>' +
          '<div class="user-menu" id="userMenu">' +
            '<div class="user-avatar-btn" onclick="document.getElementById(\'userMenu\').classList.toggle(\'open\')">'+
              '<div class="user-avatar-circle">' + initials + '</div>' +
              '<span>' + displayName + '</span>' +
              '<i class="fa-solid fa-chevron-down" style="font-size:11px;color:#8b949e;"></i>' +
            '</div>' +
            '<div class="user-dropdown">' +
              '<div class="user-dropdown-header">' +
                '<div class="ud-name">' + displayName + '</div>' +
                '<div class="ud-role">' + role + '</div>' +
              '</div>' +
              '<a href="/wp-admin/profile.php" class="user-dropdown-item"><i class="fa-regular fa-user"></i> Hồ sơ cá nhân</a>' +
              (role === 'Quản trị viên' ? '<a href="/wp-admin/" class="user-dropdown-item"><i class="fa-solid fa-gauge"></i> Bảng điều khiển</a>' : '') +
            '</div>' +
          '</div>' +
          '<a href="#" onclick="doLogout();return false;" style="color:#ff6b6b; font-weight:600; font-size:14px; text-decoration:none;"><i class="fa-solid fa-right-from-bracket" style="margin-right:6px;"></i>Đăng xuất</a>' +
        '</div>';

      // Đóng dropdown khi click ngoài
      document.addEventListener('click', function(e) {
        var menu = document.getElementById('userMenu');
        if (menu && !menu.contains(e.target)) menu.classList.remove('open');
      });
    }

    function renderLoggedOut() {
      document.getElementById('headerActions').innerHTML =
        '<a href="#" class="btn-login" id="btnOpenLogin" onclick="document.getElementById(\'loginModal\').classList.add(\'active\');return false;">'+
        '<i class="fa-regular fa-user" style="margin-right:6px;"></i> Đăng nhập</a>';
    }

    function doLogout() {
      if (window.wpLogoutUrl) {
        window.location.href = window.wpLogoutUrl;
      } else {
        // Fallback xoá cookies
        document.cookie.split(";").forEach(function(c) {
          document.cookie = c.replace(/^ +/, "").replace(/=.*/, "=;expires=" + new Date().toUTCString() + ";path=/");
        });
        window.location.href = '/wp-login.php?action=logout';
      }
    }

    // Khởi chạy kiểm tra trạng thái
    checkLoginStatus();

    /* ===== XỬ LÝ FORM ĐĂNG NHẬP ===== */
    function handleLogin(e) {
      e.preventDefault();
      var btn = document.getElementById('loginBtn');
      var err = document.getElementById('loginError');
      var user = document.getElementById('loginUser').value.trim();
      var pass = document.getElementById('loginPass').value;
      btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin" style="margin-right:6px;"></i> Đang đăng nhập...';
      btn.disabled = true;
      err.style.display = 'none';

      var form = document.createElement('form');
      form.method = 'POST';
      form.action = '/wp-login.php';
      form.style.display = 'none';
      form.innerHTML =
        '<input name="log" value="' + user.replace(/"/g,'&quot;') + '">' +
        '<input name="pwd" value="' + pass.replace(/"/g,'&quot;') + '">' +
        '<input name="rememberme" value="forever">' +
        '<input name="redirect_to" value="' + window.location.href + '">' +
        '<input name="wp-submit" value="Log In">';
      document.body.appendChild(form);
      form.submit();
    }

    function togglePass() {
      var p = document.getElementById('loginPass');
      var i = document.getElementById('eyeIcon');
      if(p.type === 'password') { p.type='text'; i.className='fa-regular fa-eye-slash'; }
      else { p.type='password'; i.className='fa-regular fa-eye'; }
    }
  </script>

</body>
</html>
