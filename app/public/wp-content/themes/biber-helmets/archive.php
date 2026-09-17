<?php
/**
 * Archive Template (Danh mục tin tức, bài viết Biker)
 */
get_header();
?>

<main class="elementor-container" style="max-width: 1200px; margin: 40px auto; padding: 40px 24px; min-height: 70vh;">
  
  <div style="text-align: center; margin-bottom: 48px;">
    <span style="background: rgba(255,183,3,0.12); color: #ffb703; border: 1px solid rgba(255,183,3,0.3); padding: 6px 16px; border-radius: 99px; font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; display: inline-block; margin-bottom: 12px;">
      <i class="fa-regular fa-folder-open" style="margin-right: 6px;"></i> Chuyên Mục Tin Tức
    </span>
    <h1 style="color: #ffffff; font-size: 36px; font-weight: 800; margin-bottom: 12px;">
      <?php the_archive_title(); ?>
    </h1>
    <?php if ( get_the_archive_description() ) : ?>
      <div style="color: #8b949e; font-size: 15px; max-width: 600px; margin: 0 auto;">
        <?php the_archive_description(); ?>
      </div>
    <?php else : ?>
      <p style="color: #8b949e; font-size: 15px;">Tổng hợp kiến thức an toàn, cẩm nang chọn nón bảo hiểm chuẩn quốc tế ECE 22.06 và văn hóa phượt đỉnh cao.</p>
    <?php endif; ?>
  </div>

  <?php if ( have_posts() ) : ?>
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 30px;">
      <?php while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> style="background: #161b22; border-radius: 16px; border: 1px solid rgba(255,255,255,0.08); overflow: hidden; display: flex; flex-direction: column; transition: transform 0.3s ease, border-color 0.3s ease;" onmouseover="this.style.transform='translateY(-6px)';this.style.borderColor='#ffb703'" onmouseout="this.style.transform='translateY(0)';this.style.borderColor='rgba(255,255,255,0.08)'">
          
          <!-- Ảnh đại diện bài viết (Trích xuất từ Ảnh 2 Showroom) -->
          <a href="<?php the_permalink(); ?>" style="display: block; width: 100%; height: 220px; overflow: hidden; position: relative;">
            <?php echo biker_get_post_image(get_the_ID(), 'biker-card-thumb'); ?>
            <span style="position: absolute; bottom: 12px; left: 12px; background: rgba(0,0,0,0.75); backdrop-filter: blur(4px); color: #ffb703; padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: 700; text-transform: uppercase;">
              <?php 
                $cats = get_the_category();
                echo !empty($cats) ? esc_html($cats[0]->name) : 'Cẩm Nang';
              ?>
            </span>
          </a>

          <div style="padding: 24px; display: flex; flex-direction: column; flex-grow: 1;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px; font-size: 12px; color: #8b949e;">
              <span><i class="fa-regular fa-calendar" style="color: #ffb703; margin-right: 4px;"></i> <?php echo get_the_date('d/m/Y'); ?></span>
              <span style="color: #00f5d4;"><i class="fa-regular fa-user" style="margin-right: 4px;"></i> <?php echo get_the_author(); ?></span>
            </div>

            <h2 style="font-size: 19px; font-weight: 700; line-height: 1.4; margin-bottom: 12px;">
              <a href="<?php the_permalink(); ?>" style="color: #ffffff; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#ffb703'" onmouseout="this.style.color='#ffffff'">
                <?php the_title(); ?>
              </a>
            </h2>

            <div style="color: #8b949e; font-size: 14px; line-height: 1.6; margin-bottom: 20px; flex-grow: 1;">
              <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
            </div>

            <div>
              <a href="<?php the_permalink(); ?>" style="display: inline-flex; align-items: center; gap: 8px; color: #ffb703; font-weight: 700; font-size: 14px; text-decoration: none;">
                Đọc bài viết <i class="fa-solid fa-arrow-right"></i>
              </a>
            </div>
          </div>

        </article>
      <?php endwhile; ?>
    </div>

    <!-- Phân trang -->
    <div style="margin-top: 50px; text-align: center;">
      <?php the_posts_pagination(array(
        'mid_size'  => 2,
        'prev_text' => '<i class="fa-solid fa-chevron-left"></i> Trang trước',
        'next_text' => 'Trang sau <i class="fa-solid fa-chevron-right"></i>',
      )); ?>
    </div>

  <?php else : ?>
    <div style="background: #161b22; border-radius: 16px; padding: 60px 40px; text-align: center; color: #8b949e; border: 1px solid rgba(255,255,255,0.08);">
      <i class="fa-regular fa-newspaper" style="font-size: 48px; margin-bottom: 16px; color: #ffb703; display: block;"></i>
      <h3 style="color: #fff; font-size: 20px; margin-bottom: 8px;">Chưa có bài viết nào</h3>
      <p>Nội dung trong chuyên mục này đang được cập nhật. Vui lòng quay lại sau!</p>
    </div>
  <?php endif; ?>

</main>

<?php
get_footer();
