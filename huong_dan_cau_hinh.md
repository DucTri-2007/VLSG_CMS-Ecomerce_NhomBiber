# Hướng Dẫn Cấu Hình Chi Tiết & Chuẩn Bị Minh Chứng Nộp Bài [B10] & [B11]

Tài liệu này hướng dẫn chi tiết từng bước thực hiện cấu hình hệ thống trên website LocalWP WordPress của bạn, cùng với hướng dẫn chụp ảnh minh chứng và đóng gói bài tập để nộp.

---

## 🛠️ PHẦN 1: BÀI TẬP B11 - CẤU HÌNH VẬN CHUYỂN & THANH TOÁN

### Bước 1.1: Khởi động Website và Cài đặt WooCommerce
1.  Mở ứng dụng **Local (by Flywheel)** trên máy tính.
2.  Chọn website của bạn và nhấp **Start Site** để khởi động máy chủ.
3.  Nhấp vào nút **WP Admin** để đăng nhập vào trang quản trị WordPress.
4.  Đảm bảo plugin **WooCommerce** đã được cài đặt và kích hoạt (Vào **Plugins > Installed Plugins** để kiểm tra. Nếu chưa có, nhấp **Add New** tìm `WooCommerce` và tiến hành cài đặt).

### Bước 1.2: Import danh sách sản phẩm bằng file CSV (Để có > 20 sản phẩm)
1.  Trong trang quản trị WordPress, chọn **Products > All Products**.
2.  Nhấp vào nút **Start Import** (hoặc **Import** ở phía trên nếu đã có sẵn sản phẩm).
3.  Nhấp **Choose File** và tìm tới tệp [File_ProductData.csv](file:///d:/VLSG_CMS-Ecomerce_NhomBiber-NhanhMain_Hoang_new/VLSG_CMS-Ecomerce_NhomBiber-NhanhMain_Cong/File_ProductData.csv) (hoặc tệp nằm trong thư mục dự án của bạn).
4.  Nhấp **Continue**. Ở trang đối chiếu cột (mapping), giữ nguyên mặc định và nhấp **Run the Importer**.
5.  Đợi trình nhập hoàn tất. WooCommerce sẽ import thành công **21 sản phẩm** mũ bảo hiểm.
6.  *Minh chứng 1*: Truy cập **Products > All Products**. Hãy chắc chắn bộ đếm phía trên hiển thị `All (21)` hoặc lớn hơn 20. Chụp ảnh màn hình khu vực này và lưu lại dưới tên `Anh_ProductList.png` (Hình ảnh bắt buộc phải hiển thị rõ góc có bộ đếm sản phẩm).

### Bước 1.3: Cấu hình Phí vận chuyển (Shipping Zones)
1.  Vào mục **WooCommerce > Settings** và chuyển sang tab **Shipping**.
2.  Nhấp vào nút **Add shipping zone** để tạo vùng vận chuyển thứ nhất:
    *   **Zone name**: Điền `Nội thành`
    *   **Zone regions**: Chọn tỉnh/thành phố của bạn (ví dụ: `Ho Chi Minh` hoặc `Ha Noi`).
    *   **Shipping methods**: Nhấp **Add shipping method** > Chọn `Flat rate` (Phí cố định) > Nhấp **Add shipping method**. Sau đó nhấp vào chữ **Edit** bên dưới Flat rate vừa tạo, đổi tên thành `Phí vận chuyển Nội thành` và đặt **Cost** là `30000` (Không điền chữ VNĐ hay dấu chấm). Nhấp **Save changes**.
3.  Quay lại trang Shipping và nhấp tiếp **Add shipping zone** để tạo vùng thứ hai:
    *   **Zone name**: Điền `Toàn quốc`
    *   **Zone regions**: Chọn `Vietnam`.
    *   **Shipping methods**: Nhấp **Add shipping method** > Chọn `Flat rate` > Nhấp **Add shipping method**. Nhấp **Edit** dưới Flat rate này, đổi tên thành `Phí vận chuyển Toàn quốc` và đặt **Cost** là `50000`. Nhấp **Save changes**.
4.  Lưu lại toàn bộ cấu hình.

### Bước 1.4: Kích hoạt Phương thức thanh toán (Payment Methods)
1.  Chuyển sang tab **Payments** trong phần **WooCommerce > Settings**.
2.  Tìm phương thức **Cash on delivery (COD)** (Thanh toán khi nhận hàng) và gạt nút bật (kích hoạt). Nhấp nút **Finish set up** hoặc **Save changes** để lưu lại.
3.  Tìm phương thức **Direct bank transfer** (Chuyển khoản ngân hàng) và gạt nút bật. Nhấp vào nút **Finish set up** hoặc **Manage** bên cạnh để cấu hình:
    *   **Account name**: Nhập tên chủ tài khoản (ví dụ: `NHOM BIBER`).
    *   **Account number**: Nhập số tài khoản giả định (ví dụ: `1234567890`).
    *   **Bank name**: Nhập tên ngân hàng giả định (ví dụ: `Vietcombank`).
    *   Nhấp **Save changes**.

### Bước 1.5: Tự mua hàng thử nghiệm & Chụp ảnh minh chứng thanh toán
1.  Mở một trình duyệt ẩn danh (hoặc đăng xuất khỏi tài khoản Admin) để đóng vai khách hàng.
2.  Truy cập vào trang cửa hàng và chọn mua **1-2 sản phẩm mũ bảo hiểm** bất kỳ. Nhấp **Add to Cart** (Thêm vào giỏ hàng).
3.  Vào trang **Cart** (Giỏ hàng) > Kiểm tra sản phẩm và bấm **Proceed to Checkout** (Tiến hành thanh toán).
4.  Tại trang Checkout:
    *   Nhập đầy đủ thông tin thanh toán (họ tên, địa chỉ...).
    *   Tại phần chọn khu vực/tỉnh thành phố: Hãy chọn tỉnh thành bạn đã cấu hình ở bước 1.3 để hệ thống tự động tính phí vận chuyển tương ứng (30.000đ cho Nội thành hoặc 50.000đ cho Toàn quốc).
    *   *Minh chứng 2*: Xem phần cổng thanh toán bên tay phải hoặc bên dưới, đảm bảo hiển thị đầy đủ và cho phép chọn 2 phương thức: **Chuyển khoản ngân hàng** (Direct bank transfer) và **Thanh toán khi nhận hàng** (COD). **Chụp ảnh màn hình toàn bộ khu vực này** và lưu lại dưới tên `Anh_PaymentMethods.png`.
5.  Chọn một phương thức thanh toán và nhấn **Place Order** (Đặt hàng). Hệ thống sẽ chuyển hướng sang trang **Order Received** (Đơn hàng đã nhận) báo thành công.

---

## 📱 PHẦN 2: BÀI TẬP B10 - TỐI ƯU RESPONSIVE & LÊN LỊCH BÀI SEO

### Bước 2.1: Tối ưu UI/UX Trang chủ trên thiết bị di động (Elementor)
1.  Trong WordPress Admin, đi tới **Pages > All Pages**.
2.  Tìm trang chủ của bạn (thường có nhãn `Front Page`) và chọn **Edit with Elementor**.
3.  Tại thanh công cụ phía dưới cùng của Elementor (bên cạnh nút Update), nhấp vào biểu tượng **Responsive Mode** (chế độ phản hồi). Một thanh điều khiển sẽ xuất hiện ở phía trên cùng của màn hình thiết kế.
4.  Chọn biểu tượng **Mobile** (Điện thoại).
5.  Rà soát toàn bộ giao diện trên Mobile từ trên xuống dưới:
    *   **Lỗi tràn viền (Horizontal Overflow)**: Nếu thấy xuất hiện thanh cuộn ngang hoặc có hình ảnh/phần tử bị lòi ra ngoài mép màn hình, hãy nhấp vào phần tử đó và điều chỉnh lại chiều rộng (Width) thành `100%` hoặc `Auto`.
    *   **Khoảng cách sát mép (Margin/Padding)**: Đảm bảo văn bản và các nút bấm không chạm sát lề màn hình điện thoại. Nhấp vào các Section hoặc Column, chuyển sang tab **Advanced** và đặt **Padding** Trái (Left) và Phải (Right) khoảng `15px` - `20px` (Đảm bảo chọn chế độ Mobile khi cài đặt).
    *   **Cân đối khoảng cách giữa các phần**: Điều chỉnh lại **Margin-Top** hoặc **Margin-Bottom** của các Section để trang trông cân đối, dễ đọc.
    *   **Kích thước chữ**: Giảm kích thước chữ của các tiêu đề lớn H1, H2 xuống khoảng `22px` - `28px` để chúng không bị gãy thành quá nhiều dòng trên điện thoại.
6.  Sau khi tối ưu xong, nhấp nút **Update** ở góc dưới cùng bên trái để lưu lại.

### Bước 2.2: Soạn thảo và Lên lịch đăng bài viết chuẩn SEO
1.  Sử dụng nội dung 2 bài viết chuẩn cấu trúc Silo tôi đã soạn sẵn trong tệp [huong_dan_seo.md](file:///d:/VLSG_CMS-Ecomerce_NhomBiber-NhanhMain_Hoang_new/VLSG_CMS-Ecomerce_NhomBiber-NhanhMain_Cong/huong_dan_seo.md).
2.  Trong WordPress Admin, chọn **Posts > Add New**.
3.  **Soạn bài viết thứ nhất**:
    *   Nhập tiêu đề và nội dung bài viết thứ nhất.
    *   Trong khung cấu hình của plugin **Yoast SEO** hoặc **RankMath** ở dưới:
        *   Điền **Focus Keyphrase** (Từ khóa chính): `chọn mũ bảo hiểm fullface`.
        *   Điền **Meta description** như đã soạn sẵn.
    *   Tạo ảnh minh họa bằng Bing Image Creator theo gợi ý trong tệp SEO, sau đó nén ảnh bằng Squoosh.app sang định dạng `.webp` và đặt tên file đúng chuẩn SEO. Tải ảnh lên mục **Featured Image** (Ảnh đại diện bài viết) và điền **Alt Text** đầy đủ.
    *   Tại khung **Publish** (đăng bài) ở cột bên phải, nhấp vào chữ **Immediately** bên cạnh mục Publish và chọn một ngày cụ thể trong tuần tới (ví dụ: thứ Ba tuần tới).
    *   Nhấp nút **Schedule...** để lên lịch đăng tự động.
4.  **Soạn bài viết thứ hai**:
    *   Thực hiện tương tự với nội dung bài viết thứ hai.
    *   Điền **Focus Keyphrase**: `mũ bảo hiểm 3/4`.
    *   Lên lịch đăng bài vào một ngày khác bài viết thứ nhất trong tuần tới (ví dụ: thứ Năm tuần tới) và nhấp **Schedule...**.
5.  Kiểm tra để đảm bảo điểm SEO và Readability trên Yoast SEO/Rank Math hiển thị màu **Xanh (Good)**.

---

## 📦 PHẦN 3: ĐÓNG GÓI MINH CHỨNG VÀ NỘP BÀI (B11)

Theo yêu cầu bắt buộc của bài tập B11, bạn cần tạo tệp nén bao gồm đúng 3 minh chứng sau:

1.  **Anh_ProductList.png**: Ảnh chụp danh sách sản phẩm hiển thị số lượng lớn hơn 20.
2.  **Anh_PaymentMethods.png**: Ảnh chụp giao diện checkout hiển thị 2 phương thức COD và Chuyển khoản ngân hàng.
3.  **File_ProductData.csv**: Tệp CSV dùng để import sản phẩm (chính là file [File_ProductData.csv](file:///d:/VLSG_CMS-Ecomerce_NhomBiber-NhanhMain_Hoang_new/VLSG_CMS-Ecomerce_NhomBiber-NhanhMain_Cong/File_ProductData.csv) tôi đã tạo trong thư mục dự án).

### Các bước đóng gói:
1.  Tạo một thư mục tạm trên màn hình máy tính của bạn và đặt tên là `MinhChung_Buoi11`.
2.  Sao chép tệp `File_ProductData.csv` từ thư mục dự án vào thư mục tạm này.
3.  Di chuyển 2 tệp ảnh chụp `Anh_ProductList.png` và `Anh_PaymentMethods.png` vào cùng thư mục này.
4.  Nhấp chuột phải vào thư mục `MinhChung_Buoi11` > Chọn **Send to > Compressed (zipped) folder** (hoặc dùng WinRAR/7-Zip) để nén lại thành tệp `.zip`.
5.  Đổi tên tệp nén thành: **`Nhom[X]_Buoi11_[TenDoAn].zip`**
    *   *Ví dụ*:ếu nhóm bạn là Nhóm 5 và tên đồ án là BiberHelmet, hãy đặt tên file là: `Nhom5_Buoi11_BiberHelmet.zip`
6.  Nộp tệp nén này lên Microsoft Teams theo đúng thời hạn.
