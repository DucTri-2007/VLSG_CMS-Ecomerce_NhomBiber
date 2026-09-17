<?php
/**
 * Template Name: Trang Tất Cả Bài Viết (Tin Tức & Cẩm Nang)
 * Description: Hiển thị 10 bài viết an toàn trích xuất từ Ảnh 1, hỗ trợ xem chi tiết qua tham số ?article_id=X và liên kết qua nút Đọc tiếp
 */
get_header();

$all_articles = function_exists('biker_get_10_safety_articles') ? biker_get_10_safety_articles() : array();
$requested_id = isset($_GET['article_id']) ? absint($_GET['article_id']) : 0;

// NẾU CÓ THAM SỐ article_id HỢP LỆ: HIỂN THỊ TRANG CHI TIẾT BÀI VIẾT
if ($requested_id > 0 && isset($all_articles[$requested_id])) :
    $current_article = $all_articles[$requested_id];
?>
<main class="elementor-container" style="max-width: 960px; margin: 40px auto; padding: 40px 24px; min-height: 70vh;">
  
  <!-- ĐIỀU HƯỚNG BREADCRUMB & NÚT QUAY LẠI -->
  <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px; flex-wrap: wrap; gap: 12px;">
    <a href="<?php echo esc_url(home_url('/')); ?>" style="color: #ffb703; text-decoration: none; font-size: 14px; font-weight: 700; display: inline-flex; align-items: center; gap: 6px; transition: gap 0.2s;" onmouseover="this.style.gap='10px'" onmouseout="this.style.gap='6px'">
      <i class="fa-solid fa-arrow-left"></i> Về trang chủ
    </a>
    <a href="<?php echo esc_url(home_url('/tin-tuc/')); ?>" style="color: #8b949e; text-decoration: none; font-size: 14px; display: inline-flex; align-items: center; gap: 6px;">
      <i class="fa-solid fa-list"></i> Xem tất cả 10 bài viết
    </a>
  </div>

  <article class="biker-single-article" style="background: #161b22; border-radius: 20px; border: 1px solid rgba(255,255,255,0.08); padding: 40px; box-shadow: 0 20px 50px rgba(0,0,0,0.5);">
    
    <!-- CHUYÊN MỤC BADGE -->
    <div style="margin-bottom: 16px;">
      <span style="background: rgba(255,183,3,0.12); color: #ffb703; border: 1px solid rgba(255,183,3,0.3); padding: 5px 14px; border-radius: 99px; font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">
        <?php echo esc_html($current_article['category']); ?>
      </span>
    </div>

    <!-- TIÊU ĐỀ BÀI VIẾT -->
    <h1 style="color: #ffffff; font-size: 34px; font-weight: 900; line-height: 1.35; margin-bottom: 20px; letter-spacing: -0.5px;">
      <?php echo esc_html($current_article['title']); ?>
    </h1>

    <!-- METADATA: TÁC GIẢ, NGÀY ĐĂNG, LƯỢT XEM, THỜI GIAN ĐỌC -->
    <div style="display: flex; align-items: center; flex-wrap: wrap; gap: 18px; color: #8b949e; font-size: 13px; margin-bottom: 30px; padding-bottom: 18px; border-bottom: 1px solid rgba(255,255,255,0.08);">
      <span><i class="fa-regular fa-calendar" style="margin-right: 6px; color: #ffb703;"></i> <?php echo esc_html($current_article['date']); ?></span>
      <span><i class="fa-regular fa-user" style="margin-right: 6px; color: #00f5d4;"></i> <?php echo esc_html($current_article['author']); ?></span>
      <span><i class="fa-regular fa-eye" style="margin-right: 6px; color: #ffb703;"></i> <?php echo esc_html($current_article['views']); ?></span>
      <span><i class="fa-regular fa-clock" style="margin-right: 6px; color: #ffb703;"></i> <?php echo esc_html($current_article['read_time']); ?></span>
    </div>

    <!-- ẢNH ĐẠI DIỆN HERO (TRÍCH XUẤT TỪ ẢNH 1) -->
    <div style="width: 100%; max-height: 480px; overflow: hidden; border-radius: 14px; margin-bottom: 32px; border: 1px solid rgba(255,255,255,0.1); box-shadow: 0 12px 30px rgba(0,0,0,0.6); background: #0d1117;">
      <img 
        src="<?php echo esc_url($current_article['image']); ?>" 
        alt="<?php echo esc_attr($current_article['title']); ?>"
        onerror="this.onerror=null;this.src='<?php echo esc_url($current_article['fallback_image']); ?>';this.onerror=function(){this.src='<?php echo esc_url(get_template_directory_uri() . '/assets/images/news-grid-full.jpg'); ?>';};"
        style="width: 100%; height: auto; max-height: 480px; object-fit: cover; display: block;"
      >
    </div>

    <!-- TÓM TẮT DẪN NHẬP (SAPEAU) -->
    <div style="font-size: 17px; font-weight: 600; line-height: 1.7; color: #e2e8f0; background: rgba(255,183,3,0.06); border-left: 4px solid #ffb703; padding: 18px 24px; border-radius: 0 12px 12px 0; margin-bottom: 30px;">
      <?php echo esc_html($current_article['excerpt']); ?>
    </div>

    <!-- TOÀN BỘ NỘI DUNG CHI TIẾT BÀI VIẾT -->
    <div class="entry-content" style="line-height: 1.9; color: #f0f6fc; font-size: 16px; word-wrap: break-word;">
      <style>
        .entry-content h3 { color: #ffb703; font-size: 22px; font-weight: 800; margin: 32px 0 16px; }
        .entry-content p { margin-bottom: 20px; }
        .entry-content ul, .entry-content ol { padding-left: 24px; margin-bottom: 20px; }
        .entry-content li { margin-bottom: 8px; }
        .entry-content blockquote { border-left: 4px solid #ffb703; background: #21262d; padding: 18px 22px; margin: 24px 0; border-radius: 0 8px 8px 0; color: #ffb703; font-style: italic; font-size: 16px; font-weight: 500; }
      </style>
      <?php echo wp_kses_post($current_article['content']); ?>
    </div>

    <!-- KHỐI CHIA SẺ & MUA HÀNG AN TOÀN -->
    <div style="margin-top: 40px; padding-top: 24px; border-top: 1px solid rgba(255,255,255,0.08); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
      <div style="display: flex; align-items: center; gap: 10px;">
        <span style="font-size: 13px; color: #8b949e;">Chia sẻ:</span>
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(home_url('/tin-tuc/?article_id=' . $current_article['id'])); ?>" target="_blank" rel="noopener noreferrer" style="width: 36px; height: 36px; border-radius: 50%; background: #1877f2; color: #fff; display: inline-flex; align-items: center; justify-content: center; text-decoration: none;">
          <i class="fa-brands fa-facebook-f"></i>
        </a>
        <button type="button" onclick="navigator.clipboard.writeText(window.location.href);alert('Đã sao chép liên kết bài viết!');" style="width: 36px; height: 36px; border-radius: 50%; background: #21262d; color: #ffb703; border: 1px solid rgba(255,255,255,0.1); cursor: pointer; display: inline-flex; align-items: center; justify-content: center;" title="Sao chép link">
          <i class="fa-solid fa-link"></i>
        </button>
      </div>

      <a href="<?php echo esc_url(home_url('/#products')); ?>" class="btn-glow" style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; border-radius: 99px;">
        <i class="fa-solid fa-shield-halved"></i> Mua Mũ Đạt Chuẩn Ngay
      </a>
    </div>

  </article>

  <!-- =======================================================
       BÀI VIẾT AN TOÀN KHÁC (LIÊN KẾT QUA NÚT ĐỌC TIẾP)
       ======================================================= -->
  <section style="margin-top: 60px;">
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 30px;">
      <h2 style="font-size: 26px; font-weight: 800; color: #ffffff;">
        <i class="fa-solid fa-newspaper" style="color: #ffb703; margin-right: 8px;"></i> Các Bài Báo An Toàn Khác
      </h2>
      <a href="<?php echo esc_url(home_url('/tin-tuc/')); ?>" style="color: #ffb703; text-decoration: none; font-weight: 700; font-size: 14px;">
        Xem tất cả 10 bài <i class="fa-solid fa-arrow-right"></i>
      </a>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px;">
      <?php 
      $related_count = 0;
      foreach ($all_articles as $rel_id => $rel_article) :
          if ($rel_id == $requested_id) continue;
          if ($related_count >= 3) break;
          $related_count++;
          $rel_url = home_url('/tin-tuc/?article_id=' . $rel_id);
      ?>
        <div style="background: #161b22; border-radius: 14px; border: 1px solid rgba(255,255,255,0.08); overflow: hidden; display: flex; flex-direction: column; transition: transform 0.3s ease, border-color 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)';this.style.borderColor='#ffb703'" onmouseout="this.style.transform='translateY(0)';this.style.borderColor='rgba(255,255,255,0.08)'">
          <a href="<?php echo esc_url($rel_url); ?>" style="display: block; width: 100%; height: 160px; overflow: hidden; position: relative;">
            <img 
              src="<?php echo esc_url($rel_article['image']); ?>" 
              alt="<?php echo esc_attr($rel_article['title']); ?>"
              onerror="this.onerror=null;this.src='<?php echo esc_url($rel_article['fallback_image']); ?>';"
              style="width: 100%; height: 100%; object-fit: cover; display: block;"
            >
            <span style="position: absolute; bottom: 8px; left: 8px; background: rgba(0,0,0,0.8); color: #ffb703; padding: 2px 8px; border-radius: 4px; font-size: 10px; font-weight: 700;">
              <?php echo esc_html($rel_article['category']); ?>
            </span>
          </a>
          <div style="padding: 18px; display: flex; flex-direction: column; flex-grow: 1;">
            <h4 style="font-size: 15px; font-weight: 700; line-height: 1.4; margin-bottom: 8px;">
              <a href="<?php echo esc_url($rel_url); ?>" style="color: #ffffff; text-decoration: none;">
                <?php echo esc_html($rel_article['title']); ?>
              </a>
            </h4>
            <div style="margin-top: auto; padding-top: 10px; border-top: 1px solid rgba(255,255,255,0.06);">
              <!-- NÚT ĐỌC TIẾP LIÊN KẾT CÁC BÀI VỚI NHAU -->
              <a href="<?php echo esc_url($rel_url); ?>" style="color: #ffb703; font-weight: 700; font-size: 13px; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
                Đọc tiếp <i class="fa-solid fa-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

</main>

<?php 
// NẾU KHÔNG CÓ article_id: HIỂN THỊ TOÀN BỘ 10 BÀI VIẾT VỚI BỘ LỌC
else : 
?>
<main class="elementor-container" style="max-width: 1240px; margin: 40px auto; padding: 40px 24px; min-height: 70vh;">
  
  <!-- HEADER TIÊU ĐỀ TRANG BÀI VIẾT -->
  <div style="text-align: center; margin-bottom: 50px;">
    <div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(255,183,3,0.12); border: 1px solid rgba(255,183,3,0.3); border-radius: 99px; padding: 6px 18px; color: #ffb703; font-size: 13px; font-weight: 700; text-transform: uppercase; margin-bottom: 14px;">
      <i class="fa-solid fa-triangle-exclamation"></i> Hồ Sơ Cảnh Báo An Toàn Giao Thông
    </div>
    <h1 style="color: #ffffff; font-size: 38px; font-weight: 900; margin-bottom: 12px; letter-spacing: -0.5px;">
      10 Bài Viết & Cẩm Nang Biker Sống Còn
    </h1>
    <p style="color: #8b949e; font-size: 16px; max-width: 700px; margin: 0 auto; line-height: 1.6;">
      Trích xuất từ dữ liệu tai nạn giao thông thực tế và infographic an toàn quốc gia. Nhấn nút <strong>"Đọc tiếp"</strong> ở từng bài để theo dõi chi tiết khuyến cáo cứu mạng từ chuyên gia.
    </p>
  </div>

  <!-- LƯỚI 10 BÀI BÁO AN TOÀN -->
  <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 32px;">
    <?php foreach ($all_articles as $a): 
      $art_url = home_url('/tin-tuc/?article_id=' . $a['id']);
    ?>
      <article class="biker-post-card" style="background: #161b22; border-radius: 16px; border: 1px solid rgba(255,255,255,0.08); overflow: hidden; display: flex; flex-direction: column; transition: all 0.3s ease; box-shadow: 0 10px 25px rgba(0,0,0,0.3);" onmouseover="this.style.transform='translateY(-6px)';this.style.borderColor='#ffb703';this.style.boxShadow='0 15px 35px rgba(255,183,3,0.15)'" onmouseout="this.style.transform='translateY(0)';this.style.borderColor='rgba(255,255,255,0.08)';this.style.boxShadow='0 10px 25px rgba(0,0,0,0.3)'">
        
        <!-- ẢNH ĐẠI DIỆN TỪ ẢNH 1 -->
        <a href="<?php echo esc_url($art_url); ?>" style="display: block; width: 100%; height: 220px; overflow: hidden; position: relative; background: #0d1117;">
          <img 
            src="<?php echo esc_url($a['image']); ?>" 
            alt="<?php echo esc_attr($a['title']); ?>"
            onerror="this.onerror=null;this.src='<?php echo esc_url($a['fallback_image']); ?>';this.onerror=function(){this.src='<?php echo esc_url(get_template_directory_uri() . '/assets/images/news-grid-full.jpg'); ?>';};"
            style="width: 100%; height: 100%; object-fit: cover; display: block;"
          >
          <span style="position: absolute; bottom: 12px; left: 12px; background: rgba(0,0,0,0.85); backdrop-filter: blur(6px); color: #ffb703; padding: 4px 12px; border-radius: 6px; font-size: 11px; font-weight: 800; text-transform: uppercase; border: 1px solid rgba(255,183,3,0.3);">
            <?php echo esc_html($a['category']); ?>
          </span>
          <span style="position: absolute; top: 12px; right: 12px; background: rgba(0,0,0,0.7); backdrop-filter: blur(4px); color: #8b949e; padding: 3px 8px; border-radius: 4px; font-size: 11px;">
            <i class="fa-regular fa-clock"></i> <?php echo esc_html($a['read_time']); ?>
          </span>
        </a>

        <!-- THÔNG TIN NỘI DUNG & NÚT ĐỌC TIẾP -->
        <div style="padding: 24px; display: flex; flex-direction: column; flex-grow: 1;">
          <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px; font-size: 12px; color: #8b949e;">
            <span><i class="fa-regular fa-calendar" style="color: #ffb703; margin-right: 6px;"></i> <?php echo esc_html($a['date']); ?></span>
            <span style="color: #00f5d4;"><i class="fa-regular fa-eye" style="margin-right: 4px;"></i> <?php echo esc_html($a['views']); ?></span>
          </div>

          <h2 style="font-size: 19px; font-weight: 700; line-height: 1.45; margin-bottom: 12px;">
            <a href="<?php echo esc_url($art_url); ?>" style="color: #ffffff; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#ffb703'" onmouseout="this.style.color='#ffffff'">
              <?php echo esc_html($a['title']); ?>
            </a>
          </h2>

          <div style="color: #8b949e; font-size: 14px; line-height: 1.6; margin-bottom: 20px; flex-grow: 1;">
            <?php echo esc_html($a['excerpt']); ?>
          </div>

          <!-- NÚT ĐỌC TIẾP LIÊN KẾT TRANG RIÊNG -->
          <div style="border-top: 1px solid rgba(255,255,255,0.06); padding-top: 16px; display: flex; justify-content: space-between; align-items: center;">
            <a href="<?php echo esc_url($art_url); ?>" style="display: inline-flex; align-items: center; gap: 8px; color: #ffb703; font-weight: 700; font-size: 14px; text-decoration: none; transition: gap 0.2s;" onmouseover="this.style.gap='12px'" onmouseout="this.style.gap='8px'">
              Đọc tiếp <i class="fa-solid fa-arrow-right"></i>
            </a>
            <span style="font-size: 12px; color: #6e7681;"><i class="fa-regular fa-user"></i> <?php echo esc_html($a['author']); ?></span>
          </div>
        </div>

      </article>
    <?php endforeach; ?>
  </div>

</main>
<?php endif; ?>

<?php
get_footer();
