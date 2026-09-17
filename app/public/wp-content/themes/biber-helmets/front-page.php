<?php
/**
 * Template Name: Trang Chủ Biber Helmets
 * Description: Template trang chủ chính thức cho Biber Helmets chuẩn Dark Mode và chuẩn WordPress
 */
get_header();

// Lấy 8 sản phẩm mũ bảo hiểm từ Ảnh 2
$featured_helmets = function_exists('biker_get_8_featured_helmets') ? biker_get_8_featured_helmets() : array();

// Lấy 10 bài viết an toàn giao thông từ Ảnh 1
$safety_articles  = function_exists('biker_get_10_safety_articles') ? biker_get_10_safety_articles() : array();
?>

  <!-- SECTION HERO -->
  <section class="elementor-section-hero">
    <div class="hero-bg-glow"></div>
    <div class="elementor-container">
      <div class="elementor-row">
        
        <!-- COLUMN 1: NỘI DUNG -->
        <div class="elementor-column-50">
          <div class="badge-premium"><i class="fa-solid fa-medal"></i> Đại lý ủy quyền chính hãng ECE 22.06</div>
          <div class="elementor-widget-heading">
            <h1>Chinh Phục Mọi Nẻo Đường Với<br><span>Mũ Bảo Hiểm Đẳng Cấp</span></h1>
          </div>

          <div class="elementor-widget-text-editor">
            <p>Bảo vệ tối đa hành trình phượt của bạn với các dòng mũ Fullface, 3/4 và Lật hàm chính hãng AGV, Shoei, HJC đạt chuẩn an toàn quốc tế ECE 22.06 & DOT mới nhất. 100% hình ảnh sản phẩm thực tế, kiểm định nghiêm ngặt.</p>
          </div>

          <div class="hero-buttons">
            <a href="#products" class="btn-glow">
              Khám Phá Sản Phẩm <i class="fa-solid fa-arrow-down"></i>
            </a>
            <a href="#safety-news" class="btn-secondary-outline" style="display: inline-flex; align-items: center; gap: 8px; padding: 14px 28px; border-radius: 99px; border: 1px solid rgba(255,183,3,0.4); color: #ffb703; text-decoration: none; font-weight: 700; transition: all 0.3s ease;">
              <i class="fa-solid fa-triangle-exclamation"></i> 10 Cảnh Báo An Toàn
            </a>
          </div>
        </div>

        <!-- COLUMN 2: ẢNH HERO -->
        <div class="elementor-column-50">
          <div class="hero-image-wrapper">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/hero-helmet.jpg'); ?>" alt="Biker wearing helmet" onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1558981403-c5f9899a28bc?auto=format&fit=crop&w=1600&q=80';">
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- =======================================================
       SECTION SẢN PHẨM TƯƠNG TÁC (8 MŨ BẢO HIỂM TRÍCH XUẤT TỪ ẢNH 2)
       ======================================================= -->
  <section class="elementor-section-products" id="products" style="padding: 90px 0; background: #0d1117;">
    <div class="elementor-container">
      
      <div class="section-header" style="text-align: center; margin-bottom: 40px;">
        <div class="badge-premium" style="margin-bottom: 12px;"><i class="fa-solid fa-shield-halved"></i> Tiêu Chuẩn ECE 22.06 & DOT</div>
        <div class="elementor-widget-heading">
          <h2 style="font-size: 38px; font-weight: 900; color: #ffffff; letter-spacing: -0.5px;">Bộ Sưu Tập Mũ Bảo Hiểm Chính Hãng</h2>
        </div>
        <p class="section-subtitle" style="color: #8b949e; max-width: 680px; margin: 10px auto 0; font-size: 16px;">
          Trích xuất từ danh mục sản phẩm thực tế. 100% có ảnh sắc nét, cam kết chính hãng, hỗ trợ chọn size và thêm vào giỏ hàng tức thì.
        </p>
      </div>

      <!-- BỘ LỌC DANH MỤC SẢN PHẨM TƯƠNG TÁC -->
      <div class="biker-filter-tabs" style="display: flex; justify-content: center; flex-wrap: wrap; gap: 10px; margin-bottom: 40px;">
        <button type="button" class="biker-tab-btn active" data-filter="all">
          <i class="fa-solid fa-border-all"></i> Tất Cả (21)
        </button>
        <button type="button" class="biker-tab-btn" data-filter="fullface">
          <i class="fa-solid fa-helmet-safety"></i> Mũ Fullface (7)
        </button>
        <button type="button" class="biker-tab-btn" data-filter="3-4">
          <i class="fa-solid fa-shield-virus"></i> Mũ 3/4 Phượt (6)
        </button>
        <button type="button" class="biker-tab-btn" data-filter="lat-ham">
          <i class="fa-solid fa-arrows-rotate"></i> Lật Hàm 180° (4)
        </button>
        <button type="button" class="biker-tab-btn" data-filter="nua-dau">
          <i class="fa-solid fa-motorcycle"></i> Mũ Nửa Đầu (4)
        </button>
      </div>

      <!-- LƯỚI 8 SẢN PHẨM TƯƠNG TÁC -->
      <div class="biker-product-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 28px;">
        <?php foreach ($featured_helmets as $p): ?>
          <div class="product-card biker-product-item" data-category="<?php echo esc_attr($p['category']); ?>" id="product-card-<?php echo esc_attr($p['id']); ?>">
            
            <!-- VÙNG ẢNH SẢN PHẨM & QUICK VIEW BUTTON -->
            <div class="product-img-wrap" style="position: relative; height: 260px; background: radial-gradient(circle, #21262d 0%, #161b22 100%); border-radius: 12px; overflow: hidden; display: flex; align-items: center; justify-content: center;">
              
              <!-- Badge giảm giá / nổi bật -->
              <div class="product-badge" style="background: <?php echo esc_attr($p['badge_color']); ?>; color: <?php echo esc_attr($p['badge_text_color']); ?>; position: absolute; top: 12px; left: 12px; z-index: 2; font-size: 11px; font-weight: 800; padding: 4px 10px; border-radius: 6px; text-transform: uppercase;">
                <?php echo esc_html($p['badge']); ?>
              </div>

              <!-- Nút Xem Nhanh (Quick View) -->
              <button type="button" class="biker-btn-quickview" onclick="openProductQuickView(<?php echo esc_attr($p['id']); ?>)" title="Xem chi tiết nhanh" style="position: absolute; top: 12px; right: 12px; z-index: 3; width: 36px; height: 36px; border-radius: 50%; background: rgba(13,17,23,0.8); border: 1px solid rgba(255,255,255,0.2); color: #fff; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.3s ease;">
                <i class="fa-regular fa-eye"></i>
              </button>

              <!-- Ảnh Mũ Bảo Hiểm 100% Không Lỗi Ảnh (Fallback 2 tầng) -->
              <img 
                src="<?php echo esc_url($p['image']); ?>" 
                alt="<?php echo esc_attr($p['name']); ?>" 
                class="biker-helmet-thumb"
                onerror="this.onerror=null;this.src='<?php echo esc_url($p['fallback_image']); ?>';this.onerror=function(){this.src='<?php echo esc_url(get_template_directory_uri() . '/assets/images/helmets-grid-full.png'); ?>';};"
                style="max-width: 86%; max-height: 86%; object-fit: contain; filter: drop-shadow(0 12px 20px rgba(0,0,0,0.6)); transition: transform 0.4s ease;"
              >
            </div>

            <!-- THÔNG TIN SẢN PHẨM -->
            <div class="product-info-wrap" style="padding-top: 16px; display: flex; flex-direction: column; flex-grow: 1;">
              
              <div style="font-size: 11px; font-weight: 700; color: #ffb703; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px;">
                <?php echo esc_html($p['category_name']); ?>
              </div>

              <h3 style="font-size: 17px; font-weight: 700; line-height: 1.4; margin-bottom: 8px;">
                <a href="javascript:void(0)" onclick="openProductQuickView(<?php echo esc_attr($p['id']); ?>)" style="color: #ffffff; text-decoration: none; transition: color 0.2s;">
                  <?php echo esc_html($p['name']); ?>
                </a>
              </h3>

              <div class="product-spec" style="font-size: 12px; color: #8b949e; margin-bottom: 12px; display: flex; align-items: center; gap: 6px;">
                <i class="fa-solid fa-shield-halved" style="color: #00f5d4;"></i> 
                <span><?php echo esc_html($p['spec']); ?></span>
              </div>

              <!-- CHỌN SIZE TƯƠNG TÁC NGAY TRÊN CARD -->
              <div class="biker-size-selector" style="margin-bottom: 14px;">
                <div style="font-size: 11px; color: #8b949e; margin-bottom: 6px; display: flex; justify-content: space-between;">
                  <span>Kích thước: <strong id="selected-size-txt-<?php echo esc_attr($p['id']); ?>" style="color: #ffb703;">M</strong></span>
                  <span style="color: #6e7681;"><?php echo esc_html($p['weight']); ?></span>
                </div>
                <div class="size-chips" style="display: flex; gap: 6px;">
                  <?php foreach ($p['sizes'] as $sIndex => $size): ?>
                    <button type="button" class="biker-size-chip <?php echo ($size === 'M' || ($sIndex === 0 && !in_array('M', $p['sizes']))) ? 'active' : ''; ?>" data-pid="<?php echo esc_attr($p['id']); ?>" data-size="<?php echo esc_attr($size); ?>">
                      <?php echo esc_html($size); ?>
                    </button>
                  <?php endforeach; ?>
                </div>
              </div>

              <!-- GIÁ & NÚT THÊM VÀO GIỎ -->
              <div class="price-and-action" style="margin-top: auto; padding-top: 12px; border-top: 1px solid rgba(255,255,255,0.06);">
                <div style="display: flex; align-items: baseline; gap: 8px; margin-bottom: 12px;">
                  <span class="price" style="font-size: 20px; font-weight: 800; color: #ffb703;">
                    <?php echo esc_html($p['price']); ?>
                  </span>
                  <?php if (!empty($p['old_price'])): ?>
                    <span style="font-size: 13px; color: #6e7681; text-decoration: line-through;">
                      <?php echo esc_html($p['old_price']); ?>
                    </span>
                  <?php endif; ?>
                </div>

                <button 
                  type="button" 
                  class="add-to-cart biker-btn-addcart" 
                  data-pid="<?php echo esc_attr($p['id']); ?>"
                  data-name="<?php echo esc_attr($p['name']); ?>"
                  data-price="<?php echo esc_attr($p['price']); ?>"
                  data-img="<?php echo esc_url($p['image']); ?>"
                  onclick="bikerAddToCart(this)"
                  style="width: 100%; cursor: pointer; border: none; font-family: inherit; font-size: 14px;"
                >
                  <i class="fa-solid fa-cart-plus"></i> Thêm vào giỏ hàng
                </button>
              </div>

            </div>

          </div>
        <?php endforeach; ?>
      </div>

    </div>
  </section>

  <!-- =======================================================
       SECTION 10 BÀI VIẾT CẢNH BÁO AN TOÀN (TRÍCH XUẤT TỪ ẢNH 1)
       Liên kết trang chủ và trang riêng qua nút "Đọc tiếp"
       ======================================================= -->
  <section class="elementor-section-news" id="safety-news" style="padding: 90px 0; background: #070a0f; border-top: 1px solid rgba(255,255,255,0.08);">
    <div class="elementor-container">
      
      <div class="section-header" style="text-align: center; margin-bottom: 40px;">
        <div class="badge-premium" style="margin-bottom: 12px; background: rgba(255,107,107,0.12); border-color: rgba(255,107,107,0.3); color: #ff6b6b;">
          <i class="fa-solid fa-triangle-exclamation"></i> Cảnh Báo Sống Còn & Tiêu Chuẩn An Toàn
        </div>
        <div class="elementor-widget-heading">
          <h2 style="font-size: 38px; font-weight: 900; color: #ffffff; letter-spacing: -0.5px;">
            10 Bài Báo & Cẩm Nang An Toàn Giao Thông
          </h2>
        </div>
        <p class="section-subtitle" style="color: #8b949e; max-width: 720px; margin: 10px auto 0; font-size: 16px;">
          Tập hợp 10 bài viết từ hồ sơ tai nạn thực tế, số liệu thống kê an toàn và hướng dẫn bảo vệ tính mạng bằng nón bảo hiểm chuẩn quốc tế. Nhấn <strong>"Đọc tiếp"</strong> để xem chi tiết từng bài viết.
        </p>
      </div>

      <!-- BỘ LỌC DANH MỤC BÀI BÁO -->
      <div class="biker-article-filters" style="display: flex; justify-content: center; flex-wrap: wrap; gap: 10px; margin-bottom: 40px;">
        <button type="button" class="biker-art-tab active" data-cat="all">
          Tất Cả (10 Bài)
        </button>
        <button type="button" class="biker-art-tab" data-cat="Cảnh Báo Tai Nạn">
          Cảnh Báo Tai Nạn
        </button>
        <button type="button" class="biker-art-tab" data-cat="Số Liệu Thống Kê">
          Số Liệu & Thống Kê
        </button>
        <button type="button" class="biker-art-tab" data-cat="Tin Tức Thời Sự">
          Tin Tức Thời Sự
        </button>
        <button type="button" class="biker-art-tab" data-cat="Cẩm Nang Biker">
          Cẩm Nang & Công Nghệ
        </button>
      </div>

      <!-- LƯỚI 10 BÀI VIẾT (TRÍCH XUẤT TỪ ẢNH 1) -->
      <div class="biker-articles-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 30px;">
        <?php foreach ($safety_articles as $a): 
          // Link chi tiết bài viết (dẫn tới trang riêng liên kết qua URL ?article_id=X)
          $detail_url = home_url('/tin-tuc/?article_id=' . $a['id']);
        ?>
          <article class="biker-article-card" data-category="<?php echo esc_attr($a['category']); ?>" style="background: #161b22; border: 1px solid rgba(255,255,255,0.08); border-radius: 16px; overflow: hidden; display: flex; flex-direction: column; transition: all 0.3s ease; box-shadow: 0 10px 25px rgba(0,0,0,0.3);">
            
            <!-- ẢNH ĐẠI DIỆN TỪ ẢNH 1 VỚI FALLBACK -->
            <a href="<?php echo esc_url($detail_url); ?>" class="article-thumb-link" style="display: block; width: 100%; height: 210px; overflow: hidden; position: relative; background: #0d1117;">
              <img 
                src="<?php echo esc_url($a['image']); ?>" 
                alt="<?php echo esc_attr($a['title']); ?>"
                class="article-img"
                onerror="this.onerror=null;this.src='<?php echo esc_url($a['fallback_image']); ?>';this.onerror=function(){this.src='<?php echo esc_url(get_template_directory_uri() . '/assets/images/news-grid-full.jpg'); ?>';};"
                style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease; display: block;"
              >
              <!-- Badge chuyên mục -->
              <span style="position: absolute; bottom: 12px; left: 12px; background: rgba(0,0,0,0.85); backdrop-filter: blur(4px); color: #ffb703; padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: 800; text-transform: uppercase; border: 1px solid rgba(255,183,3,0.3);">
                <?php echo esc_html($a['category']); ?>
              </span>
              <!-- Thời gian đọc -->
              <span style="position: absolute; top: 12px; right: 12px; background: rgba(13,17,23,0.8); backdrop-filter: blur(4px); color: #8b949e; padding: 3px 8px; border-radius: 4px; font-size: 11px;">
                <i class="fa-regular fa-clock"></i> <?php echo esc_html($a['read_time']); ?>
              </span>
            </a>

            <!-- NỘI DUNG TÓM TẮT & NÚT ĐỌC TIẾP -->
            <div style="padding: 24px; display: flex; flex-direction: column; flex-grow: 1;">
              
              <div style="display: flex; align-items: center; justify-content: space-between; font-size: 12px; color: #8b949e; margin-bottom: 12px;">
                <span><i class="fa-regular fa-calendar" style="color: #ffb703; margin-right: 4px;"></i> <?php echo esc_html($a['date']); ?></span>
                <span><i class="fa-regular fa-eye" style="color: #00f5d4; margin-right: 4px;"></i> <?php echo esc_html($a['views']); ?></span>
              </div>

              <h3 style="font-size: 18px; font-weight: 700; line-height: 1.45; margin-bottom: 12px;">
                <a href="<?php echo esc_url($detail_url); ?>" style="color: #ffffff; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#ffb703'" onmouseout="this.style.color='#ffffff'">
                  <?php echo esc_html($a['title']); ?>
                </a>
              </h3>

              <p style="color: #8b949e; font-size: 14px; line-height: 1.6; margin-bottom: 20px; flex-grow: 1;">
                <?php echo esc_html($a['excerpt']); ?>
              </p>

              <!-- NÚT ĐỌC TIẾP LIÊN KẾT TRANG RIÊNG -->
              <div style="padding-top: 14px; border-top: 1px solid rgba(255,255,255,0.06); display: flex; justify-content: space-between; align-items: center;">
                <a href="<?php echo esc_url($detail_url); ?>" class="btn-readmore-link" style="display: inline-flex; align-items: center; gap: 8px; color: #ffb703; font-weight: 700; font-size: 14px; text-decoration: none; transition: all 0.2s ease;">
                  <span>Đọc tiếp</span>
                  <i class="fa-solid fa-arrow-right" style="transition: transform 0.2s ease;"></i>
                </a>
                <span style="font-size: 12px; color: #6e7681;"><i class="fa-regular fa-user"></i> <?php echo esc_html($a['author']); ?></span>
              </div>

            </div>

          </article>
        <?php endforeach; ?>
      </div>

      <!-- NÚT ĐI TỚI TRANG TẤT CẢ BÀI VIẾT -->
      <div style="text-align: center; margin-top: 50px;">
        <a href="<?php echo esc_url(home_url('/tin-tuc/')); ?>" class="btn-glow" style="display: inline-flex; align-items: center; gap: 10px; padding: 14px 32px; border-radius: 99px;">
          <i class="fa-regular fa-newspaper"></i> Xem Tất Cả 10 Bài Viết Trên Trang Riêng <i class="fa-solid fa-arrow-right"></i>
        </a>
      </div>

    </div>
  </section>

  <!-- =======================================================
       MODAL QUICK VIEW (XEM NHANH SẢN PHẨM TRÊN TRANG CHỦ)
       ======================================================= -->
  <div id="biker-quickview-modal" class="biker-modal" style="display: none;">
    <div class="biker-modal-overlay" onclick="closeProductQuickView()"></div>
    <div class="biker-modal-container">
      <button type="button" class="biker-modal-close" onclick="closeProductQuickView()">&times;</button>
      
      <div class="biker-modal-body" id="biker-modal-dynamic-content">
        <!-- Nội dung sẽ được Javascript đổ động vào đây -->
      </div>
    </div>
  </div>

  <!-- =======================================================
       TOAST NOTIFICATION (THÔNG BÁO THÊM VÀO GIỎ THÀNH CÔNG)
       ======================================================= -->
  <div id="biker-toast" class="biker-toast" style="display: none;">
    <div class="biker-toast-icon"><i class="fa-solid fa-circle-check"></i></div>
    <div class="biker-toast-content">
      <div class="biker-toast-title">Thêm vào giỏ thành công!</div>
      <div class="biker-toast-msg" id="biker-toast-msg">Đã thêm sản phẩm vào giỏ hàng.</div>
    </div>
  </div>

  <!-- =======================================================
       JAVASCRIPT TƯƠNG TÁC SẢN PHẨM & BÀI VIẾT TRANG CHỦ
       ======================================================= -->
  <script>
    // Dữ liệu 8 sản phẩm cho Modal Quick View
    const BIKER_PRODUCTS_DATA = <?php echo json_encode($featured_helmets, JSON_UNESCAPED_UNICODE); ?>;

    // 1. Tương tác Lọc danh mục sản phẩm (Filter Tabs)
    document.querySelectorAll('.biker-tab-btn').forEach(btn => {
      btn.addEventListener('click', function() {
        document.querySelectorAll('.biker-tab-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        const filter = this.getAttribute('data-filter');

        document.querySelectorAll('.biker-product-item').forEach(card => {
          const cardCat = card.getAttribute('data-category');
          if (filter === 'all' || cardCat === filter) {
            card.style.display = 'flex';
            card.style.animation = 'bikerFadeIn 0.4s ease';
          } else {
            card.style.display = 'none';
          }
        });
      });
    });

    // 2. Tương tác Chọn Size trên từng thẻ sản phẩm
    document.querySelectorAll('.biker-size-chip').forEach(chip => {
      chip.addEventListener('click', function(e) {
        e.stopPropagation();
        const pid = this.getAttribute('data-pid');
        const size = this.getAttribute('data-size');
        
        // Bỏ active của các chip cùng sản phẩm
        const parentCard = document.getElementById('product-card-' + pid);
        if (parentCard) {
          parentCard.querySelectorAll('.biker-size-chip').forEach(c => c.classList.remove('active'));
          this.classList.add('active');
          const txtEl = document.getElementById('selected-size-txt-' + pid);
          if (txtEl) txtEl.textContent = size;
        }
      });
    });

    // 3. Tương tác Thêm vào giỏ hàng Realtime
    function bikerAddToCart(btn) {
      const pid = btn.getAttribute('data-pid');
      const name = btn.getAttribute('data-name');
      const price = btn.getAttribute('data-price');
      
      // Lấy size đang chọn
      let chosenSize = 'M';
      const parentCard = document.getElementById('product-card-' + pid);
      if (parentCard) {
        const activeChip = parentCard.querySelector('.biker-size-chip.active');
        if (activeChip) chosenSize = activeChip.getAttribute('data-size');
      }

      // Hiệu ứng nút bấm
      const originalText = btn.innerHTML;
      btn.innerHTML = '<i class="fa-solid fa-check"></i> Đã thêm vào giỏ!';
      btn.style.background = '#10b981';
      btn.style.borderColor = '#10b981';

      // Cập nhật số lượng giỏ hàng trên Header realtime
      const cartCountEls = document.querySelectorAll('.biker-cart-count');
      cartCountEls.forEach(el => {
        let current = parseInt(el.textContent.trim()) || 0;
        el.textContent = current + 1;
        el.style.transform = 'scale(1.4)';
        setTimeout(() => { el.style.transform = 'scale(1)'; }, 300);
      });

      // Hiện Toast Thông Báo
      showBikerToast(`Đã thêm <strong>${name}</strong> (Size ${chosenSize}) vào giỏ hàng!`);

      // Khôi phục nút sau 2 giây
      setTimeout(() => {
        btn.innerHTML = originalText;
        btn.style.background = '';
        btn.style.borderColor = '';
      }, 2000);
    }

    // 4. Modal Quick View
    function openProductQuickView(id) {
      const p = BIKER_PRODUCTS_DATA[id];
      if (!p) return;

      const modal = document.getElementById('biker-quickview-modal');
      const content = document.getElementById('biker-modal-dynamic-content');
      
      content.innerHTML = `
        <div class="biker-modal-grid">
          <div class="biker-modal-gallery">
            <img src="${p.image}" alt="${p.name}" class="biker-modal-img" onerror="this.onerror=null;this.src='${p.fallback_image}';">
            <div style="margin-top: 14px; display: flex; gap: 8px; justify-content: center;">
              <span style="background: rgba(255,183,3,0.15); border: 1px solid #ffb703; color: #ffb703; padding: 4px 10px; border-radius: 4px; font-size: 12px; font-weight: 700;">${p.spec}</span>
              <span style="background: rgba(0,245,212,0.15); border: 1px solid #00f5d4; color: #00f5d4; padding: 4px 10px; border-radius: 4px; font-size: 12px; font-weight: 700;">${p.shell}</span>
            </div>
          </div>
          <div class="biker-modal-details">
            <span class="badge-premium" style="display:inline-block; margin-bottom: 10px;">${p.category_name}</span>
            <h2 style="font-size: 24px; font-weight: 800; color: #fff; margin-bottom: 8px;">${p.name}</h2>
            <div style="display: flex; align-items: baseline; gap: 10px; margin-bottom: 16px;">
              <span style="font-size: 26px; font-weight: 900; color: #ffb703;">${p.price}</span>
              ${p.old_price ? `<span style="font-size: 15px; color: #6e7681; text-decoration: line-through;">${p.old_price}</span>` : ''}
            </div>
            <p style="color: #8b949e; font-size: 14px; line-height: 1.7; margin-bottom: 20px;">${p.desc}</p>
            
            <div style="background: #21262d; border-radius: 8px; padding: 14px; margin-bottom: 20px; font-size: 13px;">
              <div style="color: #cbd5e1; margin-bottom: 6px;"><strong>Chuẩn an toàn:</strong> ${p.spec}</div>
              <div style="color: #cbd5e1; margin-bottom: 6px;"><strong>Chất liệu vỏ:</strong> ${p.shell}</div>
              <div style="color: #cbd5e1;"><strong>Trọng lượng:</strong> ${p.weight}</div>
            </div>

            <div style="margin-bottom: 24px;">
              <label style="display: block; font-size: 13px; color: #8b949e; margin-bottom: 8px;">Chọn kích thước:</label>
              <div style="display: flex; gap: 8px;">
                ${p.sizes.map(s => `<button type="button" class="biker-size-chip ${s==='M'?'active':''}" onclick="document.querySelectorAll('#biker-modal-dynamic-content .biker-size-chip').forEach(c=>c.classList.remove('active'));this.classList.add('active');">${s}</button>`).join('')}
              </div>
            </div>

            <button type="button" class="btn-glow" style="width: 100%; border: none; cursor: pointer; padding: 14px; font-size: 15px;" onclick="bikerAddToCartFromModal('${p.name}', '${p.price}');">
              <i class="fa-solid fa-cart-shopping"></i> Thêm Vào Giỏ Ngay
            </button>
          </div>
        </div>
      `;
      modal.style.display = 'flex';
    }

    function closeProductQuickView() {
      document.getElementById('biker-quickview-modal').style.display = 'none';
    }

    function bikerAddToCartFromModal(name, price) {
      let chosenSize = 'M';
      const activeSize = document.querySelector('#biker-modal-dynamic-content .biker-size-chip.active');
      if (activeSize) chosenSize = activeSize.textContent.trim();

      const cartCountEls = document.querySelectorAll('.biker-cart-count');
      cartCountEls.forEach(el => {
        let current = parseInt(el.textContent.trim()) || 0;
        el.textContent = current + 1;
      });

      showBikerToast(`Đã thêm <strong>${name}</strong> (Size ${chosenSize}) vào giỏ hàng!`);
      closeProductQuickView();
    }

    // 5. Toast Thông Báo
    let toastTimeout;
    function showBikerToast(htmlMsg) {
      const toast = document.getElementById('biker-toast');
      const msgEl = document.getElementById('biker-toast-msg');
      msgEl.innerHTML = htmlMsg;
      toast.style.display = 'flex';
      toast.classList.add('show');
      
      clearTimeout(toastTimeout);
      toastTimeout = setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => { toast.style.display = 'none'; }, 300);
      }, 3500);
    }

    // 6. Lọc danh mục bài viết an toàn
    document.querySelectorAll('.biker-art-tab').forEach(btn => {
      btn.addEventListener('click', function() {
        document.querySelectorAll('.biker-art-tab').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        const cat = this.getAttribute('data-cat');

        document.querySelectorAll('.biker-article-card').forEach(card => {
          const cardCat = card.getAttribute('data-category');
          if (cat === 'all' || cardCat.indexOf(cat) !== -1 || (cat === 'Cẩm Nang Biker' && (cardCat.indexOf('Cẩm Nang') !== -1 || cardCat.indexOf('Công Nghệ') !== -1))) {
            card.style.display = 'flex';
            card.style.animation = 'bikerFadeIn 0.4s ease';
          } else {
            card.style.display = 'none';
          }
        });
      });
    });
  </script>

<?php
get_footer();
