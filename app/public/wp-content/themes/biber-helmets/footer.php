<footer class="site-footer">
  <div class="elementor-container">
    <div class="footer-grid">

      <!-- CỘT 1: THƯƠNG HIỆU & LOGO CHÍNH THỨC -->
      <div class="footer-col">
        <?php
          $footer_logo_primary = get_template_directory_uri() . '/assets/images/biker-logo.png';
          $footer_logo_fallback1 = get_template_directory_uri() . '/assets/images/biker-logo.jpg';
          $footer_logo_fallback2 = get_template_directory_uri() . '/assets/images/biker-badge-logo.jpg';
        ?>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo" style="display: inline-block; text-decoration: none; margin-bottom: 18px;" title="Biker Helmets">
          <img src="<?php echo esc_url($footer_logo_primary); ?>" alt="Biker Helmets Logo" onerror="this.onerror=null;this.src='<?php echo esc_url($footer_logo_fallback1); ?>';this.onerror=function(){this.src='<?php echo esc_url($footer_logo_fallback2); ?>';};" style="height: 52px; width: auto; max-width: 190px; object-fit: contain; filter: drop-shadow(0 2px 10px rgba(0,0,0,0.6)); display: block;">
        </a>
        <p class="footer-desc">
          Hệ thống phân phối mũ bảo hiểm và phụ kiện phượt motor chính hãng hàng đầu tại Việt Nam. Đạt tiêu chuẩn an toàn quốc tế ECE 22.06 & DOT, đồng hành an toàn cùng bạn trên mọi cung đường.
        </p>
        <div class="social-links">
          <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" title="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
          <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" title="Instagram"><i class="fa-brands fa-instagram"></i></a>
          <a href="https://tiktok.com" target="_blank" rel="noopener noreferrer" title="TikTok"><i class="fa-brands fa-tiktok"></i></a>
          <a href="https://youtube.com" target="_blank" rel="noopener noreferrer" title="YouTube"><i class="fa-brands fa-youtube"></i></a>
        </div>
      </div>

      <!-- CỘT 2: SẢN PHẨM & DANH MỤC -->
      <div class="footer-col">
        <h4>Sản Phẩm & Phụ Kiện</h4>
        <ul class="footer-links">
          <?php $shop_link = function_exists('biker_get_shop_url') ? biker_get_shop_url() : home_url('/shop/'); ?>
          <li><a href="<?php echo esc_url($shop_link); ?>"><i class="fa-solid fa-angle-right"></i> Tất Cả Sản Phẩm</a></li>
          <li><a href="<?php echo esc_url($shop_link . '?danh-muc=fullface'); ?>"><i class="fa-solid fa-angle-right"></i> Mũ Fullface ECE 22.06</a></li>
          <li><a href="<?php echo esc_url($shop_link . '?danh-muc=3-4'); ?>"><i class="fa-solid fa-angle-right"></i> Mũ 3/4 Phượt & Đô Thị</a></li>
          <li><a href="<?php echo esc_url($shop_link . '?danh-muc=lat-ham'); ?>"><i class="fa-solid fa-angle-right"></i> Mũ Lật Hàm 180° Carbon</a></li>
          <li><a href="<?php echo esc_url(home_url('/#products')); ?>"><i class="fa-solid fa-angle-right"></i> Bộ Sưu Tập Nổi Bật</a></li>
        </ul>
      </div>

      <!-- CỘT 3: ĐIỀU HƯỚNG HỆ THỐNG TRANG -->
      <div class="footer-col">
        <h4>Hệ Thống Trang</h4>
        <ul class="footer-links">
          <li><a href="<?php echo esc_url(home_url('/')); ?>"><i class="fa-solid fa-angle-right"></i> Trang Chủ</a></li>
          <li><a href="<?php echo esc_url(function_exists('biker_get_shop_url') ? biker_get_shop_url() : home_url('/shop/')); ?>"><i class="fa-solid fa-angle-right"></i> Cửa Hàng (Shop)</a></li>
          <li><a href="<?php echo esc_url(function_exists('biker_get_posts_url') ? biker_get_posts_url() : home_url('/tin-tuc/')); ?>"><i class="fa-solid fa-angle-right"></i> Bài Viết & Tin Tức</a></li>
          <li><a href="<?php echo esc_url(function_exists('wc_get_cart_url') ? wc_get_cart_url() : home_url('/cart/')); ?>"><i class="fa-solid fa-angle-right"></i> Giỏ Hàng</a></li>
          <li><a href="<?php echo esc_url(function_exists('wc_get_checkout_url') ? wc_get_checkout_url() : home_url('/checkout/')); ?>"><i class="fa-solid fa-angle-right"></i> Thanh Toán (Checkout)</a></li>
          <li><a href="<?php echo esc_url(home_url('/my-account/')); ?>"><i class="fa-solid fa-angle-right"></i> Tài Khoản Cá Nhân</a></li>
        </ul>
      </div>

      <!-- CỘT 4: LIÊN HỆ & SHOWROOM -->
      <div class="footer-col">
        <h4>Liên Hệ & Showroom</h4>
        <ul class="footer-links">
          <li style="display: flex; gap: 10px; align-items: flex-start; color: #94a3b8; font-size: 14px;">
            <i class="fa-solid fa-location-dot" style="color: #ffb703; margin-top: 4px;"></i>
            <span>123 Đường Biker, Quận 1, TP. Hồ Chí Minh</span>
          </li>
          <li style="display: flex; gap: 10px; align-items: center; color: #94a3b8; font-size: 14px;">
            <i class="fa-solid fa-phone" style="color: #ffb703;"></i>
            <span>Hotline: <a href="tel:0909123456" style="color: #ffb703; font-weight: 700;">0909 123 456</a></span>
          </li>
          <li style="display: flex; gap: 10px; align-items: center; color: #94a3b8; font-size: 14px;">
            <i class="fa-solid fa-envelope" style="color: #ffb703;"></i>
            <span>Email: <a href="mailto:support@biberhelmets.vn" style="color: #cbd5e1;">support@biberhelmets.vn</a></span>
          </li>
          <li style="display: flex; gap: 10px; align-items: center; color: #94a3b8; font-size: 14px;">
            <i class="fa-solid fa-clock" style="color: #ffb703;"></i>
            <span>Mở cửa: 08:00 - 21:30 hàng ngày</span>
          </li>
        </ul>
      </div>

    </div>
    
    <div class="footer-bottom" style="text-align: center; padding-top: 30px; margin-top: 30px; border-top: 1px solid rgba(255,255,255,0.06); color: #8b949e; font-size: 14px;">
      <p>&copy; <?php echo date('Y'); ?> Biker Helmets. All rights reserved. Tiêu chuẩn an toàn quốc tế ECE 22.06 & DOT.</p>
    </div>
  </div>
</footer>

<!-- ========================================================
     CHATBOT TRỢ LÝ AI BIKER HELMETS (TƯ VẤN 24/7)
     ======================================================== -->
<div class="biker-chatbot-widget">
  
  <!-- Nút bong bóng mở Chatbot -->
  <button type="button" class="biker-chatbot-toggle" id="bikerChatbotToggle" onclick="toggleBikerChatbot()" title="Chat với Trợ lý Biker AI">
    <span class="chatbot-pulse"></span>
    <i class="fa-solid fa-headset" style="font-size: 20px;"></i>
    <span class="chatbot-toggle-text">Tư vấn AI</span>
  </button>

  <!-- Khung cửa sổ Chatbot Dark Mode -->
  <div class="biker-chatbox" id="bikerChatbox" style="display: none;">
    
    <!-- Chat Header -->
    <div class="biker-chatbox-header">
      <div style="display: flex; align-items: center; gap: 10px;">
        <div class="bot-avatar">
          <i class="fa-solid fa-robot"></i>
        </div>
        <div>
          <div style="font-weight: 800; font-size: 15px; color: #fff;">Biker AI Assistant</div>
          <div style="font-size: 11px; color: #10b981; display: flex; align-items: center; gap: 5px;">
            <span style="width: 7px; height: 7px; border-radius: 50%; background: #10b981; display: inline-block;"></span> Trực tuyến 24/7
          </div>
        </div>
      </div>
      <button type="button" class="btn-chat-close" onclick="toggleBikerChatbot()">&times;</button>
    </div>

    <!-- Chat Messages Container -->
    <div class="biker-chatbox-body" id="bikerChatMessages">
      
      <!-- Tin nhắn chào mở đầu của Bot -->
      <div class="chat-msg bot-msg">
        <div class="msg-bubble">
          👋 Xin chào Biker! Em là **Trợ lý AI Biker Helmets**. Em có thể hỗ trợ gì cho hành trình của anh/chị hôm nay?
        </div>
      </div>

      <!-- Gợi ý câu hỏi nhanh -->
      <div class="chat-quick-actions" id="chatQuickActions">
        <button type="button" class="quick-btn" onclick="sendQuickMsg('Cách chọn size mũ bảo hiểm chuẩn?')">📏 Hướng dẫn chọn size mũ</button>
        <button type="button" class="quick-btn" onclick="sendQuickMsg('Mũ ECE 22.06 có gì đặc biệt?')">🛡️ Tiêu chuẩn ECE 22.06</button>
        <button type="button" class="quick-btn" onclick="sendQuickMsg('Tư vấn mũ Fullface dưới 4 triệu')">🏍️ Fullface dưới 4 triệu</button>
        <button type="button" class="quick-btn" onclick="sendQuickMsg('Chính sách giao hàng & bảo hành')">🚚 Giao hàng & Bảo hành</button>
      </div>

    </div>

    <!-- Chat Input Form -->
    <div class="biker-chatbox-footer">
      <input type="text" id="bikerChatInput" placeholder="Nhập câu hỏi của bạn..." onkeypress="if(event.key==='Enter') sendUserMsg();">
      <button type="button" class="btn-chat-send" onclick="sendUserMsg()" title="Gửi câu hỏi">
        <i class="fa-solid fa-paper-plane"></i>
      </button>
    </div>

  </div>

</div>

<!-- CSS CHO CHATBOT -->
<style>
.biker-chatbot-widget {
  position: fixed;
  bottom: 24px;
  right: 24px;
  z-index: 99999;
  font-family: var(--font-primary, -apple-system, BlinkMacSystemFont, sans-serif);
}

.biker-chatbot-toggle {
  background: linear-gradient(135deg, #ffb703 0%, #ff9e00 100%);
  color: #0d1117;
  border: none;
  padding: 12px 20px;
  border-radius: 99px;
  cursor: pointer;
  box-shadow: 0 8px 24px rgba(255, 183, 3, 0.4);
  display: flex;
  align-items: center;
  gap: 10px;
  font-weight: 800;
  font-size: 14px;
  transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
  position: relative;
}

.biker-chatbot-toggle:hover {
  transform: translateY(-4px) scale(1.05);
  box-shadow: 0 12px 28px rgba(255, 183, 3, 0.55);
}

.chatbot-pulse {
  position: absolute;
  top: 0; left: 0; right: 0; bottom: 0;
  border-radius: 99px;
  border: 2px solid #ffb703;
  animation: chatbotPulseAnim 2s infinite;
  pointer-events: none;
}

@keyframes chatbotPulseAnim {
  0% { transform: scale(1); opacity: 0.8; }
  100% { transform: scale(1.3); opacity: 0; }
}

.biker-chatbox {
  position: absolute;
  bottom: 60px;
  right: 0;
  width: 360px;
  max-width: 90vw;
  height: 480px;
  max-height: 80vh;
  background: #161b22;
  border: 1px solid rgba(255, 183, 3, 0.3);
  border-radius: 18px;
  box-shadow: 0 20px 50px rgba(0, 0, 0, 0.7);
  display: flex;
  flex-direction: column;
  overflow: hidden;
  animation: bikerFadeIn 0.3s ease;
}

.biker-chatbox-header {
  background: #0d1117;
  padding: 14px 18px;
  border-bottom: 1px solid rgba(255, 255, 255, 0.08);
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.bot-avatar {
  width: 34px;
  height: 34px;
  border-radius: 50%;
  background: #ffb703;
  color: #0d1117;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 16px;
}

.btn-chat-close {
  background: transparent;
  border: none;
  color: #8b949e;
  font-size: 24px;
  cursor: pointer;
  line-height: 1;
}

.btn-chat-close:hover { color: #fff; }

.biker-chatbox-body {
  flex-grow: 1;
  padding: 16px;
  overflow-y: auto;
  display: flex;
  flex-direction: column;
  gap: 12px;
  background: #0d1117;
}

.chat-msg {
  display: flex;
  margin-bottom: 4px;
}

.chat-msg.bot-msg { justify-content: flex-start; }
.chat-msg.user-msg { justify-content: flex-end; }

.msg-bubble {
  max-width: 85%;
  padding: 10px 14px;
  border-radius: 14px;
  font-size: 13px;
  line-height: 1.5;
}

.bot-msg .msg-bubble {
  background: #21262d;
  color: #f0f6fc;
  border-bottom-left-radius: 4px;
  border: 1px solid rgba(255, 255, 255, 0.06);
}

.user-msg .msg-bubble {
  background: #ffb703;
  color: #0d1117;
  font-weight: 600;
  border-bottom-right-radius: 4px;
}

.chat-quick-actions {
  display: flex;
  flex-direction: column;
  gap: 6px;
  margin-top: 8px;
}

.quick-btn {
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(255, 183, 3, 0.2);
  color: #ffb703;
  padding: 8px 12px;
  border-radius: 8px;
  font-size: 12px;
  font-weight: 600;
  cursor: pointer;
  text-align: left;
  transition: all 0.2s ease;
}

.quick-btn:hover {
  background: rgba(255, 183, 3, 0.15);
  border-color: #ffb703;
  transform: translateX(4px);
}

.biker-chatbox-footer {
  padding: 12px;
  background: #161b22;
  border-top: 1px solid rgba(255, 255, 255, 0.08);
  display: flex;
  gap: 8px;
}

.biker-chatbox-footer input {
  flex-grow: 1;
  background: #0d1117;
  border: 1px solid rgba(255, 255, 255, 0.12);
  color: #fff;
  padding: 8px 12px;
  border-radius: 8px;
  font-size: 13px;
  outline: none;
}

.biker-chatbox-footer input:focus { border-color: #ffb703; }

.btn-chat-send {
  background: #ffb703;
  color: #0d1117;
  border: none;
  width: 36px;
  height: 36px;
  border-radius: 8px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
}
</style>

<!-- JAVASCRIPT XỬ LÝ CHATBOT THÔNG MINH -->
<script>
function toggleBikerChatbot() {
  const box = document.getElementById('bikerChatbox');
  if (box.style.display === 'none' || box.style.display === '') {
    box.style.display = 'flex';
    document.getElementById('bikerChatInput').focus();
  } else {
    box.style.display = 'none';
  }
}

function sendQuickMsg(text) {
  document.getElementById('bikerChatInput').value = text;
  sendUserMsg();
}

function sendUserMsg() {
  const input = document.getElementById('bikerChatInput');
  const text = input.value.trim();
  if (!text) return;

  const msgContainer = document.getElementById('bikerChatMessages');

  // Thêm tin nhắn của User
  const userDiv = document.createElement('div');
  userDiv.className = 'chat-msg user-msg';
  userDiv.innerHTML = `<div class="msg-bubble">${escapeHtml(text)}</div>`;
  msgContainer.appendChild(userDiv);
  input.value = '';
  msgContainer.scrollTop = msgContainer.scrollHeight;

  // Hiệu ứng Bot đang gõ
  const typingDiv = document.createElement('div');
  typingDiv.className = 'chat-msg bot-msg';
  typingDiv.id = 'botTyping';
  typingDiv.innerHTML = `<div class="msg-bubble" style="color: #8b949e; font-style: italic;"><i class="fa-solid fa-ellipsis fa-fade"></i> Biker AI đang trả lời...</div>`;
  msgContainer.appendChild(typingDiv);
  msgContainer.scrollTop = msgContainer.scrollHeight;

  setTimeout(() => {
    const typing = document.getElementById('botTyping');
    if (typing) typing.remove();

    const reply = generateBotReply(text.toLowerCase());
    const botDiv = document.createElement('div');
    botDiv.className = 'chat-msg bot-msg';
    botDiv.innerHTML = `<div class="msg-bubble">${reply}</div>`;
    msgContainer.appendChild(botDiv);
    msgContainer.scrollTop = msgContainer.scrollHeight;
  }, 700);
}

function generateBotReply(q) {
  if (q.includes('size') || q.includes('kích thước') || q.includes('vòng đầu') || q.includes('đo')) {
    return `📏 <strong>Hướng dẫn chọn size mũ chuẩn Biker:</strong><br>
    • Dùng thước dây đo quanh trán cách chân mày 2cm:<br>
    - <strong>Size S:</strong> 55 - 56 cm<br>
    - <strong>Size M:</strong> 57 - 58 cm (Phổ biến nhất)<br>
    - <strong>Size L:</strong> 59 - 60 cm<br>
    - <strong>Size XL:</strong> 61 - 62 cm<br>
    *Được đổi size miễn phí trong 7 ngày nếu không vừa!`;
  } else if (q.includes('ece') || q.includes('dot') || q.includes('an toàn') || q.includes('tiêu chuẩn')) {
    return `🛡️ <strong>Chuẩn an toàn ECE 22.06:</strong><br>
    Là tiêu chuẩn an toàn mũ bảo hiểm mới nhất và khắt khe nhất thế giới của châu Âu (ECE 22.06). Mũ phải vượt qua bài kiểm tra va chạm đa hướng 18 điểm và thử nghiệm gia tốc xoay chống chấn thương sọ não. Tất cả sản phẩm tại Biker Helmets đều đạt chuẩn ECE & DOT!`;
  } else if (q.includes('fullface') || q.includes('dưới 4 triệu') || q.includes('giá rẻ') || q.includes('tư vấn')) {
    return `🏍️ <strong>Gợi ý mũ Fullface dưới 4 triệu cực hot:</strong><br>
    1. <strong>AGV K1 S Solid Black:</strong> 3.950.000 ₫ (Chuẩn ECE 22.06, khí động học GP)<br>
    2. <strong>HJC C70 Lantic:</strong> 2.400.000 ₫ (2 kính tiện dụng)<br>
    3. <strong>Royal M139:</strong> 650.000 ₫ (Giá tốt, kính âm thời trang)<br>
    👉 Anh/Chị có thể bấm xem chi tiết ngay trên Trang Chủ hoặc mục Sản Phẩm nhé!`;
  } else if (q.includes('ship') || q.includes('giao hàng') || q.includes('bảo hành') || q.includes('đổi trả')) {
    return `🚚 <strong>Chính sách tại Biker Helmets:</strong><br>
    • <strong>Miễn phí vận chuyển</strong> toàn quốc cho đơn từ 500k.<br>
    • <strong>Bảo hành chính hãng 24 tháng</strong> cho vỏ nón và quai khóa.<br>
    • <strong>1 đổi 1 trong 7 ngày</strong> nếu phát hiện lỗi từ nhà sản xuất hoặc không vừa size. Hotline hỗ trợ: <strong style="color:#ffb703;">0909 123 456</strong>!`;
  } else {
    return `Cảm ơn Biker đã nhắn tin! Em đã ghi nhận câu hỏi của bạn. Để được tư vấn kỹ hơn về dòng mũ hoặc đặt hàng nhanh chóng, bạn có thể gọi trực tiếp Hotline <strong style="color:#ffb703;">0909 123 456</strong> hoặc tham khảo các mẫu nón đạt chuẩn ECE 22.06 tại trang <a href="${window.location.origin}/#products" style="color:#ffb703;font-weight:700;">Sản Phẩm</a> nhé!`;
  }
}

function escapeHtml(text) {
  return text.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
}
</script>

<?php wp_footer(); ?>
</body>
</html>