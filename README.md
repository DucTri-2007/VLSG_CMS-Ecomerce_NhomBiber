# 🏍️ Biker T5 - Quản Lý Mũ Bảo Hiểm (Data Architecture)

Dự án bài tập: **Hoàn thiện khung xương (Data Architecture) cho Website Bán Mũ Bảo Hiểm** trên nền tảng WordPress.

---

## 📌 1. Cấu Trúc Sơ Đồ ERD (Entity Relationship Diagram)
Sơ đồ thực thể quan hệ đã mô hình hóa đầy đủ 6 thực thể chính:
1. **DANH_MUC (Categories)**: Lưu danh mục mũ (`danh_muc_mu` - Fullface, 3/4, Nửa đầu, Lật hàm...).
2. **THUONG_HIEU (Brands)**: Lưu thương hiệu (`thuong_hieu_mu` - AGV, Shoei, HJC, Royal, Andes, KYT...).
3. **SAN_PHAM (Products)**: CPT `san_pham_mu` (Tên mũ, Chất liệu vỏ, Chuẩn an toàn, Giá niêm yết, Ảnh đại diện).
4. **BIEN_THE_MU (Product Variants)**: CPT `bien_the_mu` (Khóa ngoại trỏ về Sản phẩm, Size, Màu/Tem, Loại kính, Tồn kho, Giá bán thực tế, Mã SKU).
5. **DON_HANG (Orders) & CHI_TIET_DON_HANG (Order Items)**: CPT `don_hang_mu` (Người nhận, SĐT, Địa chỉ, Phương thức TT, Tổng tiền, Trạng thái, Danh sách chi tiết mũ được đặt).
6. **DANH_GIA (Reviews)**: CPT `danh_gia_mu` (Khóa ngoại Sản phẩm, Người đánh giá, Điểm sao 1-5, Bình luận nhận xét).

---

## 🚀 2. Hướng Dẫn Cài Đặt Lên LocalWP / WordPress

### Cách 1: Sử dụng như một Plugin riêng biệt (Khuyên dùng)
1. Copy thư mục `bikerT5` (hoặc đổi tên thành `biker-helmet-manager`) vào thư mục plugins của website:
   ```text
   wp-content/plugins/biker-helmet-manager/
   ```
2. Vào **WordPress Admin** -> Chọn **Plugins (Gói mở rộng)** -> **Installed Plugins**.
3. Tìm **Biker T5 - Quản Lý Mũ Bảo Hiểm** và nhấn **Kích hoạt (Activate)**.
4. Bạn sẽ thấy ngay menu **Mũ Bảo Hiểm** (bao gồm Sản phẩm, Biến thể, Đánh giá, Danh mục, Thương hiệu) và **Đơn Hàng Mũ** trên thanh Admin.

### Cách 2: Tích hợp vào file `functions.php` của Theme
Nếu muốn tích hợp trực tiếp, bạn có thể copy toàn bộ mã nguồn các file trong thư mục `includes/` hoặc copy file `biker-helmet-manager.php` vào cuối file `functions.php` của theme đang kích hoạt.

---

## 🛠️ 3. Hướng Dẫn Khởi Tạo Git & Push Lên GitHub

Mở Terminal / PowerShell tại thư mục `d:\bikerT5` và chạy các lệnh sau:

```bash
# 1. Khởi tạo Git repository
git init

# 2. Thêm tất cả file vào staging
git add .

# 3. Tạo commit đầu tiên
git commit -m "feat: Hoan thien Data Architecture cho Website Ban Mu Bao Hiem (CPT, Taxonomies, Meta Boxes)"

# 4. Đổi tên nhánh sang main
git branch -M main

# 5. Liên kết tới GitHub repo của bạn (thay bằng link repo GitHub của bạn)
git remote add origin https://github.com/<tai-khoan-cua-ban>/<ten-repo>.git

# 6. Đẩy mã nguồn lên GitHub
git push -u origin main
```

---

## 📸 4. Danh Sách Minh Chứng Nộp Bài (Deliverables)
1. **01 Ảnh chụp sơ đồ ERD**: Đã thiết kế hoàn chỉnh các bảng và khóa ngoại quan hệ 1:N.
2. **01 Ảnh chụp màn hình Admin WordPress**:
   - Menu CPT **Mũ Bảo Hiểm** & **Đơn Hàng Mũ**.
   - Màn hình nhập liệu Custom Meta Box kỹ thuật (Chất liệu vỏ, Chuẩn an toàn, Giá niêm yết, Biến thể Size/Màu/Kính...).
3. **Link Public GitHub Repository**: Link sau khi thực hiện lệnh push ở mục 3.
