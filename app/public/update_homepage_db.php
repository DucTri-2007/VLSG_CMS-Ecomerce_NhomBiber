<?php
header('Content-Type: text/plain');
error_reporting(E_ALL);
ini_set('display_errors', 1);

$db_name = 'local';
$db_user = 'root';
$db_pass = 'root';
$db_host = 'localhost';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("DB connection failed: " . $conn->connect_error);
}

// Hero helmet photo
$hero_img = 'https://images.unsplash.com/photo-1558981806-ec527fa84c39?w=800';

// Article images
$article1_img = 'http://localhost:10004/wp-content/uploads/2026/09/biker-helmet-size-guide.webp';
$article2_img = 'http://localhost:10004/wp-content/uploads/2026/09/biker-helmet-top5-review.webp';
$article3_img = 'https://images.unsplash.com/photo-1568772585407-9361f9bf3a87?w=600';

$clean_html_content = '
<!-- wp:html -->
<style>
  :root {
    --biker-primary: #ffb703;
    --biker-dark: #0a0c10;
  }
  .wp-biker-hero-section {
    background: linear-gradient(135deg, #0a0c10 0%, #161b22 100%);
    color: #ffffff;
    border-radius: 20px;
    padding: 60px 40px;
    margin: 20px 0 50px 0;
    box-shadow: 0 15px 35px rgba(0,0,0,0.3);
  }
  .wp-biker-hero-row {
    display: flex;
    align-items: center;
    gap: 40px;
  }
  .wp-biker-column-left, .wp-biker-column-right {
    flex: 1;
  }
  .wp-biker-heading h1 {
    font-size: 38px;
    font-weight: 900;
    color: #ffffff !important;
    line-height: 1.15;
    margin-bottom: 16px;
  }
  .wp-biker-heading h1 span {
    color: var(--biker-primary);
  }
  .wp-biker-text-editor p {
    font-size: 16px;
    color: #cbd5e1 !important;
    margin-bottom: 26px;
    line-height: 1.6;
  }
  .wp-biker-btn-glow {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: var(--biker-primary);
    color: #000000 !important;
    font-weight: 800;
    font-size: 15px;
    padding: 14px 32px;
    border-radius: 99px;
    text-decoration: none !important;
    border: none;
    transition: all 0.3s ease-in-out;
    box-shadow: 0 4px 15px rgba(255, 183, 3, 0.3);
  }
  .wp-biker-btn-glow:hover {
    transform: scale(1.05);
    box-shadow: 0 0 20px rgba(255, 183, 3, 0.6);
    color: #000000 !important;
  }
  .wp-biker-image img {
    width: 100%;
    height: auto;
    border-radius: 16px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.5);
    display: block;
  }

  /* SECTION KINH NGHIỆM & TIN TỨC BIKER */
  .wp-biker-news-section {
    margin: 60px 0;
  }
  .wp-biker-news-title {
    text-align: center;
    font-size: 28px;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 6px;
  }
  .wp-biker-news-sub {
    text-align: center;
    color: #64748b;
    font-size: 15px;
    margin-bottom: 32px;
  }
  .wp-biker-news-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
  }
  .wp-biker-news-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    flex-direction: column;
  }
  .wp-biker-news-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.12);
  }
  .wp-biker-news-thumb {
    position: relative;
    height: 200px;
    overflow: hidden;
  }
  .wp-biker-news-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
  }
  .wp-biker-news-card:hover .wp-biker-news-thumb img {
    transform: scale(1.08);
  }
  .wp-biker-news-tag {
    position: absolute;
    top: 12px;
    left: 12px;
    background: var(--biker-primary);
    color: #000000;
    font-size: 11px;
    font-weight: 800;
    padding: 4px 12px;
    border-radius: 99px;
    text-transform: uppercase;
  }
  .wp-biker-news-body {
    padding: 20px;
    display: flex;
    flex-direction: column;
    flex: 1;
  }
  .wp-biker-news-body h3 {
    font-size: 17px;
    font-weight: 800;
    color: #0f172a;
    line-height: 1.4;
    margin-bottom: 10px;
  }
  .wp-biker-news-body h3 a {
    color: #0f172a;
    text-decoration: none;
    transition: color 0.2s ease;
  }
  .wp-biker-news-body h3 a:hover {
    color: #d97706;
  }
  .wp-biker-news-body p {
    font-size: 14px;
    color: #64748b;
    line-height: 1.6;
    margin-bottom: 16px;
  }
  .wp-biker-news-link {
    margin-top: auto;
    font-size: 13px;
    font-weight: 800;
    color: #d97706;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
  }

  @media (max-width: 900px) {
    .wp-biker-news-grid { grid-template-columns: repeat(2, 1fr); }
  }
  @media (max-width: 600px) {
    .wp-biker-hero-section { padding: 30px 18px; }
    .wp-biker-hero-row { flex-direction: column; gap: 24px; }
    .wp-biker-heading h1 { font-size: 26px; }
    .wp-biker-news-grid { grid-template-columns: 1fr; }
  }
</style>

<!-- HERO SECTION -->
<div class="wp-biker-hero-section">
  <div class="wp-biker-hero-row">
    <div class="wp-biker-column-left">
      <div class="wp-biker-heading">
        <h1>Chinh Phục Mọi Nẻo Đường Với <span>Mũ Bảo Hiểm Biber</span></h1>
      </div>
      <div class="wp-biker-text-editor">
        <p>Bảo vệ tối đa hành trình của bạn với các dòng mũ Fullface, 3/4 và Lật hàm chính hãng AGV, Shoei, HJC đạt chuẩn an toàn quốc tế ECE 22.06 & DOT.</p>
      </div>
      <div class="wp-biker-btn-wrapper">
        <a href="#tin-tuc-biker" class="wp-biker-btn-glow">⚡ Đọc Tin Tức Phượt Mới Nhất</a>
      </div>
    </div>
    <div class="wp-biker-column-right">
      <div class="wp-biker-image">
        <img src="' . $hero_img . '" alt="Mũ Bảo Hiểm Fullface AGV K1 S Nén WebP">
      </div>
    </div>
  </div>
</div>

<!-- SECTION KINH NGHIỆM & TIN TỨC BIKER -->
<div class="wp-biker-news-section" id="tin-tuc-biker">
  <h2 class="wp-biker-news-title">📰 Kinh Nghiệm & Tin Tức Phượt Biber</h2>
  <p class="wp-biker-news-sub">Cập nhật kiến thức chọn mũ bảo hiểm chuẩn SEO và kinh nghiệm phượt an toàn từ chuyên gia</p>

  <div class="wp-biker-news-grid">
    
    <!-- Bài viết 1 -->
    <div class="wp-biker-news-card">
      <div class="wp-biker-news-thumb">
        <img src="' . $article1_img . '" alt="Hướng Dẫn Đo Kích Thước Mũ Bảo Hiểm Fullface">
        <span class="wp-biker-news-tag">Hướng dẫn Size</span>
      </div>
      <div class="wp-biker-news-body">
        <h3><a href="http://localhost:10004/huong-dan-do-kich-thuoc-mu-bao-hiem-fullface">Hướng Dẫn Đo Kích Thước Mũ Bảo Hiểm Fullface Chuẩn ECE 22.06</a></h3>
        <p>Hướng dẫn chi tiết 3 bước đo kích thước mũ bảo hiểm fullface chính xác từng mm cho phượt thủ, bảng đối chiếu size S đến XXL chuẩn quốc tế.</p>
        <a href="http://localhost:10004/huong-dan-do-kich-thuoc-mu-bao-hiem-fullface" class="wp-biker-news-link">Đọc bài viết chi tiết →</a>
      </div>
    </div>

    <!-- Bài viết 2 -->
    <div class="wp-biker-news-card">
      <div class="wp-biker-news-thumb">
        <img src="' . $article2_img . '" alt="Top 5 Mũ Bảo Hiểm 3/4 Và Lật Hàm Tốt Nhất">
        <span class="wp-biker-news-tag">Review & Top List</span>
      </div>
      <div class="wp-biker-news-body">
        <h3><a href="http://localhost:10004/top-5-mu-bao-hiem-3-4-va-lat-ham-tot-nhat">Top 5 Mũ Bảo Hiểm 3/4 Và Lật Hàm Tốt Nhất Năm 2026 Cho Phượt Thủ</a></h3>
        <p>Khám phá top 5 dòng mũ 3/4 tốt nhất và mũ lật hàm xoay 180 độ carbon siêu nhẹ từ KYT, LS2, Bulldog, Givi, Andes cho cung đường xa.</p>
        <a href="http://localhost:10004/top-5-mu-bao-hiem-3-4-va-lat-ham-tot-nhat" class="wp-biker-news-link">Đọc bài viết chi tiết →</a>
      </div>
    </div>

    <!-- Bài viết 3 -->
    <div class="wp-biker-news-card">
      <div class="wp-biker-news-thumb">
        <img src="' . $article3_img . '" alt="Vệ Sinh Lót Mũ Bảo Hiểm Đúng Cách">
        <span class="wp-biker-news-tag">Mẹo Bảo Quản</span>
      </div>
      <div class="wp-biker-news-body">
        <h3><a href="http://localhost:10004/#">Mẹo Vệ Sinh Lót Mũ Bảo Hiểm & Khóa Quai An Toàn Đúng Cách</a></h3>
        <p>Bí quyết tháo lắp lớp xốp EPS, giặt gò má kháng khuẩn và khử mùi mũ bảo hiểm giữ mũ luôn thơm tho như mới sau các tour tour phượt dài.</p>
        <a href="http://localhost:10004/#" class="wp-biker-news-link">Đọc bài viết chi tiết →</a>
      </div>
    </div>

  </div>
</div>
<!-- /wp:html -->
';

$res = $conn->query("SELECT option_value FROM wp_options WHERE option_name = 'page_on_front'");
if ($res && $row = $res->fetch_assoc()) {
    $page_id = (int)$row['option_value'];
    if ($page_id > 0) {
        $stmt = $conn->prepare("UPDATE wp_posts SET post_content = ? WHERE ID = ?");
        $stmt->bind_param("si", $clean_html_content, $page_id);
        $stmt->execute();
        echo "Successfully added News Section to front page ID $page_id!\n";
    }
}
?>
