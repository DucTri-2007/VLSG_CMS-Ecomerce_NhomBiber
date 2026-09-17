<?php
/**
 * The main template file (Danh sách tin tức & bài viết)
 */
get_header();
?>

<main class="elementor-container" style="max-width: 1200px; margin: 40px auto; padding: 40px 24px; min-height: 65vh;">
  
  <div style="text-align: center; margin-bottom: 40px;">
    <h1 style="color: #ffb703; font-size: 32px; font-weight: 800; margin-bottom: 8px;">
      Tin Tức & Cẩm Nang Biker
    </h1>
    <p style="color: #8b949e; font-size: 15px;">Tổng hợp kiến thức an toàn, cẩm nang chọn nón bảo hiểm chuẩn quốc tế ECE 22.06</p>
  </div>

  <?php if ( have_posts() ) : ?>
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 28px;">
      <?php while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> style="background: #161b22; border-radius: 12px; border: 1px solid rgba(255,255,255,0.08); overflow: hidden; display: flex; flex-direction: column; transition: transform 0.3s ease, border-color 0.3s ease;" onmouseover="this.style.transform='translateY(-4px)';this.style.borderColor='#ffb703'" onmouseout="this.style.transform='translateY(0)';this.style.borderColor='rgba(255,255,255,0.08)'">
          
          <!-- Ảnh đại diện bài viết -->
          <a href="<?php the_permalink(); ?>" style="display: block; width: 100%; height: 200px; overflow: hidden; position: relative;">
            <?php echo biker_get_post_image(get_the_ID(), 'biker-card-thumb'); ?>
          </a>

          <div style="padding: 20px; display: flex; flex-direction: column; flex-grow: 1;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px; font-size: 12px; color: #8b949e;">
              <span><i class="fa-regular fa-calendar" style="color: #ffb703; margin-right: 4px;"></i> <?php echo get_the_date('d/m/Y'); ?></span>
              <span style="color: #00f5d4;"><?php echo get_the_author(); ?></span>
            </div>

            <h2 style="font-size: 18px; font-weight: 700; line-height: 1.4; margin-bottom: 12px;">
              <a href="<?php the_permalink(); ?>" style="color: #ffffff; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#ffb703'" onmouseout="this.style.color='#ffffff'">
                <?php the_title(); ?>
              </a>
            </h2>

            <div style="color: #8b949e; font-size: 14px; line-height: 1.6; margin-bottom: 16px; flex-grow: 1;">
              <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
            </div>

            <div>
              <a href="<?php the_permalink(); ?>" style="display: inline-flex; align-items: center; gap: 6px; color: #ffb703; font-weight: 600; font-size: 14px; text-decoration: none;">
                Đọc bài viết <i class="fa-solid fa-arrow-right"></i>
              </a>
            </div>
          </div>

        </article>
      <?php endwhile; ?>
    </div>

    <!-- Phân trang -->
    <div style="margin-top: 40px; text-align: center; color: #ffb703;">
      <?php the_posts_pagination(array('mid_size' => 2)); ?>
    </div>

  <?php else : ?>
    <div style="background: #161b22; border-radius: 12px; padding: 40px; text-align: center; color: #8b949e;">
      <i class="fa-regular fa-newspaper" style="font-size: 40px; margin-bottom: 16px; color: #ffb703; display: block;"></i>
      <p>Chưa có bài viết nào được đăng tải.</p>
    </div>
  <?php endif; ?>

</main>

<?php
get_footer();
?>
