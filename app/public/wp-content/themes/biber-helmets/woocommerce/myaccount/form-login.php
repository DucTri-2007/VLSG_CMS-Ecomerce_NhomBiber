<?php
/**
 * Login & Register Form (Mặc định hiển thị Đăng ký, chuyển đổi Đăng nhập linh hoạt)
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$is_login_view = isset( $_POST['login'] ) || ( isset( $_GET['action'] ) && $_GET['action'] === 'login' );

do_action( 'woocommerce_before_customer_login_form' ); ?>

<div class="biker-auth-wrapper">

  <!-- REGISTER PANEL (MẶC ĐỊNH HIỂN THỊ ĐẦU TIÊN) -->
  <div class="biker-auth-panel <?php echo ! $is_login_view ? 'active' : ''; ?>" id="authPanelRegister" style="display: <?php echo ! $is_login_view ? 'block' : 'none'; ?>;">
    <div class="biker-auth-header">
      <div style="width: 52px; height: 52px; background: rgba(255,183,3,0.12); border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 12px; border: 1px solid rgba(255,183,3,0.3);">
        <i class="fa-solid fa-user-plus" style="font-size: 22px; color: #ffb703;"></i>
      </div>
      <h2>Đăng Ký Tài Khoản Biker</h2>
      <p>Tạo tài khoản thành viên để nhận ưu đãi và quản lý đơn hàng</p>
    </div>

    <form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >

      <?php do_action( 'woocommerce_register_form_start' ); ?>

      <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="reg_username"><?php esc_html_e( 'Tên đăng nhập', 'woocommerce' ); ?>&nbsp;<span class="required" style="color:#ff6b6b;">*</span></label>
        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" placeholder="Nhập tên đăng nhập của bạn..." value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" required />
      </p>

      <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="reg_email"><?php esc_html_e( 'Địa chỉ email', 'woocommerce' ); ?>&nbsp;<span class="required" style="color:#ff6b6b;">*</span></label>
        <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" placeholder="Nhập email chính xác để nhận thông báo..." value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" required />
      </p>

      <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="reg_password"><?php esc_html_e( 'Mật khẩu', 'woocommerce' ); ?>&nbsp;<span class="required" style="color:#ff6b6b;">*</span></label>
        <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" placeholder="Tạo mật khẩu an toàn..." required />
      </p>

      <?php do_action( 'woocommerce_register_form' ); ?>

      <p class="woocommerce-form-row form-row" style="margin-top: 24px;">
        <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
        <button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="register" value="<?php esc_attr_e( 'Đăng ký', 'woocommerce' ); ?>" style="width: 100% !important; padding: 14px !important; font-size: 15px !important; font-weight: 800 !important;">
          <i class="fa-solid fa-user-plus" style="margin-right: 8px;"></i> Đăng Ký Tài Khoản
        </button>
      </p>

      <?php do_action( 'woocommerce_register_form_end' ); ?>

    </form>

    <!-- ĐƯỜNG DẪN CHUYỂN ĐỔI SANG ĐĂNG NHẬP -->
    <div style="text-align: center; margin-top: 24px; padding-top: 18px; border-top: 1px solid rgba(255,255,255,0.08); font-size: 14px; color: #8b949e;">
      Đã có tài khoản? 
      <a href="javascript:void(0)" onclick="switchAuthMode('login')" style="color: #ffb703; font-weight: 700; text-decoration: none; margin-left: 6px; display: inline-flex; align-items: center; gap: 4px;">
        Đăng nhập ngay <i class="fa-solid fa-arrow-right"></i>
      </a>
    </div>
  </div>

  <!-- LOGIN PANEL (HIỂN THỊ KHI CLICK "ĐÃ CÓ TÀI KHOẢN") -->
  <div class="biker-auth-panel <?php echo $is_login_view ? 'active' : ''; ?>" id="authPanelLogin" style="display: <?php echo $is_login_view ? 'block' : 'none'; ?>;">
    <div class="biker-auth-header">
      <div style="width: 52px; height: 52px; background: rgba(255,183,3,0.12); border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 12px; border: 1px solid rgba(255,183,3,0.3);">
        <i class="fa-solid fa-right-to-bracket" style="font-size: 22px; color: #ffb703;"></i>
      </div>
      <h2>Đăng Nhập Biker Helmets</h2>
      <p>Chào mừng bạn trở lại! Vui lòng điền thông tin đăng nhập</p>
    </div>

    <form class="woocommerce-form woocommerce-form-login login" method="post">

      <?php do_action( 'woocommerce_login_form_start' ); ?>

      <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="username"><?php esc_html_e( 'Tên tài khoản hoặc email', 'woocommerce' ); ?>&nbsp;<span class="required" style="color:#ff6b6b;">*</span></label>
        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" placeholder="Nhập email hoặc tên tài khoản..." value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" required />
      </p>

      <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="password"><?php esc_html_e( 'Mật khẩu', 'woocommerce' ); ?>&nbsp;<span class="required" style="color:#ff6b6b;">*</span></label>
        <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" placeholder="Nhập mật khẩu của bạn..." required />
      </p>

      <?php do_action( 'woocommerce_login_form' ); ?>

      <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; font-size: 13px;">
        <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme" style="display: inline-flex; align-items: center; gap: 6px; cursor: pointer; color: #8b949e; margin: 0;">
          <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span>Ghi nhớ đăng nhập</span>
        </label>
        <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>" style="color: #ffb703; text-decoration: none;">Quên mật khẩu?</a>
      </div>

      <p class="form-row">
        <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
        <button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="<?php esc_attr_e( 'Đăng nhập', 'woocommerce' ); ?>" style="width: 100% !important; padding: 14px !important; font-size: 15px !important; font-weight: 800 !important;">
          <i class="fa-solid fa-right-to-bracket" style="margin-right: 8px;"></i> <?php esc_html_e( 'Đăng nhập', 'woocommerce' ); ?>
        </button>
      </p>

      <?php do_action( 'woocommerce_login_form_end' ); ?>

    </form>

    <!-- ĐƯỜNG DẪN QUAY LẠI ĐĂNG KÝ -->
    <div style="text-align: center; margin-top: 24px; padding-top: 18px; border-top: 1px solid rgba(255,255,255,0.08); font-size: 14px; color: #8b949e;">
      Chưa có tài khoản? 
      <a href="javascript:void(0)" onclick="switchAuthMode('register')" style="color: #ffb703; font-weight: 700; text-decoration: none; margin-left: 6px; display: inline-flex; align-items: center; gap: 4px;">
        Đăng ký ngay <i class="fa-solid fa-arrow-right"></i>
      </a>
    </div>
  </div>

</div>

<script>
function switchAuthMode(mode) {
  var loginPanel = document.getElementById('authPanelLogin');
  var regPanel = document.getElementById('authPanelRegister');
  
  if (!loginPanel || !regPanel) return;
  
  if (mode === 'login') {
    regPanel.classList.remove('active');
    regPanel.style.display = 'none';
    loginPanel.classList.add('active');
    loginPanel.style.display = 'block';
    try { history.replaceState(null, '', '#login'); } catch(e){}
  } else {
    loginPanel.classList.remove('active');
    loginPanel.style.display = 'none';
    regPanel.classList.add('active');
    regPanel.style.display = 'block';
    try { history.replaceState(null, '', '#register'); } catch(e){}
  }
}

// Khởi tạo trạng thái form dựa theo URL hoặc PHP cờ
document.addEventListener('DOMContentLoaded', function() {
  <?php if ( $is_login_view ) : ?>
    switchAuthMode('login');
  <?php else : ?>
    if (window.location.hash === '#login' || window.location.search.indexOf('action=login') !== -1) {
      switchAuthMode('login');
    } else {
      switchAuthMode('register');
    }
  <?php endif; ?>
});
</script>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
