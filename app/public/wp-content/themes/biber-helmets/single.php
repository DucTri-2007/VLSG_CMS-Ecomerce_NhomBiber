<?php
/**
 * The template for displaying all single posts (Chi tiết bài báo/tin tức)
 * Hỗ trợ cả bài viết chuẩn WordPress và 10 bài viết an toàn trích xuất từ Ảnh 1
 */
get_header();

$all_articles = function_exists('biker_get_10_safety_articles') ? biker_get_10_safety_articles() : array();
$requested_id = isset($_GET['article_id']) ? absint($_GET['article_id']) : 0;

// NẾU CÓ THAM SỐ article_id
if ($requested_id > 0 && isset($all_articles[$requested_id])) :
    $current_article = $all_articles[$requested_id];
?>
<main class="elementor-container" style="max-width: 960px; margin: 40px auto; padding: 40px 24px; min-height: 70vh;">
  
  <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px; flex-wrap: wrap; gap: 12px;">
    <a href="<?php echo esc_url(home_url('/')); ?>" style="color: #ffb703; text-decoration: none; font-size: 14px; font-weight: 700; display: inline-flex; align-items: center; gap: 6px;">
      <i class="fa-solid fa-arrow-left"></i> Về trang chủ
    </a>
    <a href="<?php echo esc_url(home_url('/tin-tuc/')); ?>" style="color: #8b949e; text-decoration: none; font-size: 14px; display: inline-flex; align-items: center; gap: 6px;">
      <i class="fa-solid fa-list"></i> Xem 10 bài viết an toàn
    </a>
  </div>

  <article class="biker-single-article" style="background: #161b22; border-radius: 20px; border: 1px solid rgba(255,255,255,0.08); padding: 40px; box-shadow: 0 20px 50px rgba(0,0,0,0.5);">
    
    <div style="margin-bottom: 16px;">
      <span style="background: rgba(255,183,3,0.12); color: #ffb703; border: 1px solid rgba(255,183,3,0.3); padding: 5px 14px; border-radius: 99px; font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">
        <?php echo esc_html($current_article['category']); ?>
      </span>
    </div>

    <h1 style="color: #ffffff; font-size: 34px; font-weight: 900; line-height: 1.35; margin-bottom: 20px; letter-spacing: -0.5px;">
      <?php echo esc_html($current_article['title']); ?>
    </h1>

    <div style="display: flex; align-items: center; flex-wrap: wrap; gap: 18px; color: #8b949e; font-size: 13px; margin-bottom: 30px; padding-bottom: 18px; border-bottom: 1px solid rgba(255,255,255,0.08);">
      <span><i class="fa-regular fa-calendar" style="margin-right: 6px; color: #ffb703;"></i> <?php echo esc_html($current_article['date']); ?></span>
      <span><i class="fa-regular fa-user" style="margin-right: 6px; color: #00f5d4;"></i> <?php echo esc_html($current_article['author']); ?></span>
      <span><i class="fa-regular fa-eye" style="margin-right: 6px; color: #ffb703;"></i> <?php echo esc_html($current_article['views']); ?></span>
      <span><i class="fa-regular fa-clock" style="margin-right: 6px; color: #ffb703;"></i> <?php echo esc_html($current_article['read_time']); ?></span>
    </div>

    <!-- ẢNH ĐẠI DIỆN TỪ ẢNH 1 -->
    <div style="width: 100%; max-height: 480px; overflow: hidden; border-radius: 14px; margin-bottom: 32px; border: 1px solid rgba(255,255,255,0.1); box-shadow: 0 12px 30px rgba(0,0,0,0.6); background: #0d1117;">
      <img 
        src="<?php echo esc_url($current_article['image']); ?>" 
        alt="<?php echo esc_attr($current_article['title']); ?>"
        onerror="this.onerror=null;this.src='<?php echo esc_url($current_article['fallback_image']); ?>';this.onerror=function(){this.src='<?php echo esc_url(get_template_directory_uri() . '/assets/images/news-grid-full.jpg'); ?>';};"
        style="width: 100%; height: auto; max-height: 480px; object-fit: cover; display: block;"
      >
    </div>

    <div style="font-size: 17px; font-weight: 600; line-height: 1.7; color: #e2e8f0; background: rgba(255,183,3,0.06); border-left: 4px solid #ffb703; padding: 18px 24px; border-radius: 0 12px 12px 0; margin-bottom: 30px;">
      <?php echo esc_html($current_article['excerpt']); ?>
    </div>

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

    <div style="margin-top: 40px; padding-top: 24px; border-top: 1px solid rgba(255,255,255,0.08); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
      <a href="<?php echo esc_url(home_url('/tin-tuc/')); ?>" style="color: #ffb703; font-weight: 700; text-decoration: none; font-size: 14px;">
        <i class="fa-solid fa-newspaper" style="margin-right: 6px;"></i> Xem danh mục bài viết
      </a>
      <a href="<?php echo esc_url(home_url('/#products')); ?>" class="btn-glow" style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; border-radius: 99px;">
        <i class="fa-solid fa-shield-halved"></i> Xem Mũ Bảo Hiểm Chính Hãng
      </a>
    </div>

  </article>

  <!-- LIÊN KẾT CÁC BÀI VIẾT KHÁC QUA NÚT ĐỌC TIẾP -->
  <section style="margin-top: 60px;">
    <h2 style="font-size: 24px; font-weight: 800; color: #ffffff; margin-bottom: 24px;">
      <i class="fa-solid fa-triangle-exclamation" style="color: #ffb703; margin-right: 8px;"></i> Các Bài Báo An Toàn Khác
    </h2>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px;">
      <?php 
      $count = 0;
      foreach ($all_articles as $rel_id => $rel_article) :
          if ($rel_id == $requested_id) continue;
          if ($count >= 3) break;
          $count++;
          $rel_url = home_url('/tin-tuc/?article_id=' . $rel_id);
      ?>
        <div style="background: #161b22; border-radius: 14px; border: 1px solid rgba(255,255,255,0.08); overflow: hidden; display: flex; flex-direction: column;">
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
// TRƯỜNG HỢP XEM BÀI VIẾT WORDPRESS THÔNG THƯỜNG
else : 
?>
<main class="elementor-container" style="max-width: 900px; margin: 40px auto; padding: 40px 24px; min-height: 70vh;">
  <?php
  if ( have_posts() ) :
    while ( have_posts() ) : the_post();
      ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class('biker-single-article'); ?> style="background: #161b22; border-radius: 16px; border: 1px solid rgba(255,255,255,0.08); padding: 36px; box-shadow: 0 20px 40px rgba(0,0,0,0.4);">
        
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px; flex-wrap: wrap; gap: 10px;">
          <a href="<?php echo esc_url(home_url('/')); ?>" style="color: #ffb703; text-decoration: none; font-size: 14px; font-weight: 600; display: inline-flex; align-items: center; gap: 6px;">
            <i class="fa-solid fa-arrow-left"></i> Về trang chủ
          </a>
          <span style="background: rgba(255,183,3,0.12); color: #ffb703; border: 1px solid rgba(255,183,3,0.3); padding: 4px 12px; border-radius: 99px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">
            <?php 
              $categories = get_the_category();
              echo !empty($categories) ? esc_html($categories[0]->name) : 'Tin Tức Biker';
            ?>
          </span>
        </div>

        <h1 style="color: #ffffff; font-size: 32px; font-weight: 800; line-height: 1.3; margin-bottom: 16px;">
          <?php the_title(); ?>
        </h1>

        <div style="display: flex; align-items: center; gap: 20px; color: #8b949e; font-size: 13px; margin-bottom: 28px; padding-bottom: 16px; border-bottom: 1px solid rgba(255,255,255,0.08);">
          <span><i class="fa-regular fa-calendar" style="margin-right: 6px; color: #ffb703;"></i> <?php echo get_the_date('d/m/Y'); ?></span>
          <span><i class="fa-regular fa-user" style="margin-right: 6px; color: #ffb703;"></i> <?php the_author(); ?></span>
          <span><i class="fa-regular fa-clock" style="margin-right: 6px; color: #ffb703;"></i> 5 phút đọc</span>
        </div>

        <div class="post-featured-image-wrapper" style="width: 100%; max-height: 480px; overflow: hidden; border-radius: 12px; margin-bottom: 32px; border: 1px solid rgba(255,255,255,0.1); box-shadow: 0 10px 30px rgba(0,0,0,0.5);">
          <?php echo biker_get_post_image(get_the_ID(), 'biker-single-hero-img'); ?>
        </div>

        <div class="entry-content" style="line-height: 1.9; color: #f0f6fc; font-size: 16px; word-wrap: break-word;">
          <?php the_content(); ?>
        </div>

        <div style="margin-top: 40px; padding-top: 24px; border-top: 1px solid rgba(255,255,255,0.08); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
          <a href="<?php echo esc_url(home_url('/tin-tuc/')); ?>" style="color: #0d1117; background: #ffb703; padding: 10px 20px; border-radius: 8px; font-weight: 700; text-decoration: none; font-size: 14px;">
            <i class="fa-solid fa-newspaper" style="margin-right: 6px;"></i> Xem 10 bài viết an toàn
          </a>
        </div>

      </article>
      <?php
    endwhile;
  endif;
  ?>
</main>
<?php endif; ?>

<?php
get_footer();
