<?php
header('Content-Type: text/plain');
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Load WordPress Core
require_once(__DIR__ . '/wp-load.php');

// Post 1: Size guide
$post1_title = 'Hướng Dẫn Đo Kích Thước Mũ Bảo Hiểm Fullface Chuẩn ECE 22.06 Cho Phượt Thủ';
$post1_slug  = 'huong-dan-do-kich-thuoc-mu-bao-hiem-fullface';
$post1_date  = '2026-09-06 09:00:00'; // Scheduled for Sunday next week
$post1_kw    = 'kích thước mũ bảo hiểm fullface';
$post1_desc  = 'Hướng dẫn chi tiết cách đo kích thước mũ bảo hiểm fullface chính xác từng milimet cho phượt thủ. Đạt chuẩn an toàn ECE 22.06 & DOT tại Biber Helmets.';
$post1_img   = 'http://localhost:10004/wp-content/uploads/2026/09/biker-helmet-size-guide.webp';

$post1_content = '
<!-- wp:image {"sizeSlug":"large","linkDestination":"none"} -->
<figure class="wp-block-image size-large"><img src="' . $post1_img . '" alt="Ảnh hướng dẫn đo kích thước mũ bảo hiểm fullface cho phượt thủ" style="border-radius:12px;width:100%"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph -->
<p>Chọn đúng <strong>kích thước mũ bảo hiểm fullface</strong> là yếu tố sống còn quyết định sự an toàn và độ thoải mái cho mỗi phượt thủ trên các cung đường phượt dài. Một chiếc mũ bảo hiểm quá rộng có thể bị lệch khi xảy ra va chạm, trong khi mũ quá chật sẽ gây đau đầu và cản trở lưu thông máu.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Tại Sao Việc Chọn Đúng Kích Thước Mũ Bảo Hiểm Fullface Lại Cực Kỳ Quan Trọng?</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Theo tiêu chuẩn an toàn quốc tế mới nhất <a href="https://unece.org" target="_blank" rel="noopener">ECE 22.06 (United Nations Economic Commission for Europe)</a>, mũ bảo hiểm fullface phải ôm khít lấy vùng sọ và hai bên gò má. Độ hấp thụ lực va đập của lớp xốp EPS bên trong mũ chỉ đạt hiệu quả tối đa khi <strong>kích thước mũ bảo hiểm fullface</strong> vừa vặn hoàn hảo với vòng đầu người đội.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Hướng Dẫn 3 Bước Đo Kích Thước Mũ Bảo Hiểm Fullface Tại Nhà</h2>
<!-- /wp:heading -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Bước 1: Dùng Thước Dây Đo Vòng Đầu Qua Trán</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Bạn dùng một chiếc thước dây mềm, quấn quanh đầu cách chân mày khoảng 1.5 cm đến 2 cm (ngay phía trên lỗ tai). Đây là vị trí vòng đầu lớn nhất giúp bạn xác định được chỉ số <strong>kích thước mũ bảo hiểm fullface</strong> chuẩn xác nhất.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Bước 2: Bảng Đối Chiếu Size Mũ Fullface Chuẩn Quốc Tế</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Sau khi có số đo vòng đầu (tính bằng cm), hãy đối chiếu với bảng kích thước mũ bảo hiểm fullface chuẩn sau đây:</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul>
  <li><strong>Size S</strong>: Vòng đầu từ 55 cm – 56 cm.</li>
  <li><strong>Size M</strong>: Vòng đầu từ 57 cm – 58 cm.</li>
  <li><strong>Size L</strong>: Vòng đầu từ 59 cm – 60 cm (Kích thước phổ biến nhất tại Việt Nam).</li>
  <li><strong>Size XL</strong>: Vòng đầu từ 61 cm – 62 cm.</li>
  <li><strong>Size XXL</strong>: Vòng đầu từ 63 cm – 64 cm.</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Bước 3: Thử Độ Ôm Gò Má Và Khóa Quai An Toàn</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Khi đội thử mũ fullface mới, hai ốp gò má phải ép nhẹ vào má nhưng không làm bạn cắn vào lưỡi. Hãy lắc nhẹ đầu qua lại; nếu mũ không bị xê dịch tự do nghĩa là bạn đã chọn đúng <strong>kích thước mũ bảo hiểm fullface</strong> phù hợp.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Khám Phá Các Mẫu Mũ Fullface Chính Hãng Tại Biber Helmets</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Nếu bạn đang tìm kiếm mẫu mũ bảo hiểm fullface đạt chuẩn ECE 22.06 & DOT chính hãng, hãy tham khảo ngay bộ sưu tập <a href="http://localhost:10004/#danh-sach-mu">Mũ Fullface AGV K1 S và Shoei X-Fifteen</a> tại cửa hàng Biber Helmets với đầy đủ các size từ S đến XXL.</p>
<!-- /wp:paragraph -->
';

// Post 2: Top 5 Review
$post2_title = 'Top 5 Mũ Bảo Hiểm 3/4 Và Lật Hàm Tốt Nhất Năm 2026 Cho Dân Phượt';
$post2_slug  = 'top-5-mu-bao-hiem-3-4-va-lat-ham-tot-nhat';
$post2_date  = '2026-09-09 14:30:00'; // Scheduled for Wednesday next week
$post2_kw    = 'mũ bảo hiểm 3/4 tốt nhất';
$post2_desc  = 'Khám phá ngay top 5 mẫu mũ bảo hiểm 3/4 tốt nhất và mũ lật hàm carbon 180 độ năm 2026. Thiết kế hiện đại, chống ồn hiệu quả cho các chuyến đi phượt.';
$post2_img   = 'http://localhost:10004/wp-content/uploads/2026/09/biker-helmet-top5-review.webp';

$post2_content = '
<!-- wp:image {"sizeSlug":"large","linkDestination":"none"} -->
<figure class="wp-block-image size-large"><img src="' . $post2_img . '" alt="Top 5 mũ bảo hiểm 3/4 tốt nhất và lật hàm cao cấp 2026" style="border-radius:12px;width:100%"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph -->
<p>Dòng <strong>mũ bảo hiểm 3/4 tốt nhất</strong> luôn là sự lựa chọn hàng đầu của phượt thủ nhờ sự kết hợp hoàn hảo giữa độ thông thoáng khi đi phố và khả năng bảo vệ an toàn khi đi xa. Bài viết này sẽ tổng hợp top 5 dòng mũ 3/4 và mũ lật hàm đáng mua nhất năm 2026.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Đánh Giá Chi Tiết Top 5 Mũ Bảo Hiểm 3/4 Tốt Nhất & Lật Hàm 2026</h2>
<!-- /wp:heading -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">1. Mũ 3/4 KYT Venom Thor Marvel – Thiết Kế Đường Phố Nổi Bật</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>KYT Venom đứng đầu danh sách <strong>mũ bảo hiểm 3/4 tốt nhất</strong> nhờ thiết kế tem Marvel bản quyền độc đáo, vỏ nhựa ADT-Advanced nhẹ và hệ thống kính đôi che nắng tiện lợi cho các chuyến đi ban ngày lẫn ban đêm.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">2. Mũ Lật Hàm LS2 FF906 Advant Carbon – Xoay 180 Độ Linh Hoạt</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>LS2 FF906 sở hữu cằm lật 180 độ ra phía sau, giúp bạn linh hoạt chuyển đổi giữa mũ fullface và dòng <strong>mũ bảo hiểm 3/4 tốt nhất</strong> mà không bị vướng gió khi di chuyển tốc độ cao.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">3. Mũ 3/4 Bulldog Heli Carbon Gold – Đẳng Cấp Sợi Carbon Siêu Nhẹ</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Với chất liệu vỏ làm hoàn toàn từ sợi Carbon cao cấp, Bulldog Heli mang lại trọng lượng siêu nhẹ chỉ khoảng 900 gram, giảm tối đa áp lực lên vai và cổ của phượt thủ.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">4. Mũ 3/4 Givi M30.3 Siena – Chuẩn An Toàn Châu Âu</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Đến từ thương hiệu Givi Ý nổi tiếng, dòng mũ 3/4 Givi M30.3 trang bị khe thông gió thể thao và lớp lót kháng khuẩn tháo rời vệ sinh cực kỳ dễ dàng.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">5. Mũ 3/4 Andes 3S111 – Lựa Chọn Quốc Dân Bền Bỉ</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Andes 3S111 là câu trả lời cho tiêu chuẩn <strong>mũ bảo hiểm 3/4 tốt nhất</strong> trong phân khúc giá rẻ nhờ vỏ nhựa ABS nguyên sinh chịu lực tốt và sơn phủ chống trầy xước cao cấp.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Tiêu Chí Chọn Mũ Bảo Hiểm 3/4 Tốt Nhất Cho Chuyến Đi Phượt Xa</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Khi chọn mua, hãy luôn chú ý kiểm tra chứng nhận kiểm định an toàn quốc tế như <a href="https://www.nhtsa.gov" target="_blank" rel="noopener">DOT (Department of Transportation)</a> hoặc ECE 22.05/22.06. Khám phá ngay các mẫu <a href="http://localhost:10004/#danh-sach-mu">Mũ Bảo Hiểm 3/4 Biber Helmets Chính Hãng</a> với ưu đãi bảo hành 24 tháng.</p>
<!-- /wp:paragraph -->
';

function add_wp_scheduled_seo_post($title, $slug, $content, $date, $kw, $desc) {
    $existing = get_page_by_path($slug, OBJECT, 'post');
    $post_data = array(
        'post_title'    => $title,
        'post_name'     => $slug,
        'post_content'  => $content,
        'post_excerpt'  => $desc,
        'post_status'   => 'future',
        'post_type'     => 'post',
        'post_date'     => $date,
        'post_date_gmt' => $date,
        'post_author'   => 1
    );

    if ($existing) {
        $post_data['ID'] = $existing->ID;
        $post_id = wp_update_post($post_data);
        echo "Updated scheduled post ID $post_id ('$title')\n";
    } else {
        $post_id = wp_insert_post($post_data);
        echo "Created new scheduled post ID $post_id ('$title')\n";
    }

    if ($post_id && !is_wp_error($post_id)) {
        update_post_meta($post_id, '_yoast_wpseo_focuskw', $kw);
        update_post_meta($post_id, '_yoast_wpseo_metadesc', $desc);
        update_post_meta($post_id, 'rank_math_focus_keyword', $kw);
        update_post_meta($post_id, 'rank_math_description', $desc);
    }
}

add_wp_scheduled_seo_post($post1_title, $post1_slug, $post1_content, $post1_date, $post1_kw, $post1_desc);
add_wp_scheduled_seo_post($post2_title, $post2_slug, $post2_content, $post2_date, $post2_kw, $post2_desc);
?>
