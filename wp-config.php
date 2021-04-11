<?php
/**
 * Cấu hình cơ bản cho WordPress
 *
 * Trong quá trình cài đặt, file "wp-config.php" sẽ được tạo dựa trên nội dung 
 * mẫu của file này. Bạn không bắt buộc phải sử dụng giao diện web để cài đặt, 
 * chỉ cần lưu file này lại với tên "wp-config.php" và điền các thông tin cần thiết.
 *
 * File này chứa các thiết lập sau:
 *
 * * Thiết lập MySQL
 * * Các khóa bí mật
 * * Tiền tố cho các bảng database
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Thiết lập MySQL - Bạn có thể lấy các thông tin này từ host/server ** //
/** Tên database MySQL */
define( 'DB_NAME', 'test' );

/** Username của database */
define( 'DB_USER', 'root' );

/** Mật khẩu của database */
define( 'DB_PASSWORD', '' );

/** Hostname của database */
define( 'DB_HOST', 'localhost' );

/** Database charset sử dụng để tạo bảng database. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Kiểu database collate. Đừng thay đổi nếu không hiểu rõ. */
define('DB_COLLATE', '');

/**#@+
 * Khóa xác thực và salt.
 *
 * Thay đổi các giá trị dưới đây thành các khóa không trùng nhau!
 * Bạn có thể tạo ra các khóa này bằng công cụ
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Bạn có thể thay đổi chúng bất cứ lúc nào để vô hiệu hóa tất cả
 * các cookie hiện có. Điều này sẽ buộc tất cả người dùng phải đăng nhập lại.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'zgk?5kDFtM2wv?U~p!Qv#{feE5l]$]WII05A&(>`ba(n}vyUm8qMUCW,$;:VNVSO' );
define( 'SECURE_AUTH_KEY',  '5ev>x?qmPV`Z=+vad/t`WHA92~kF@ciO#/*:d/]|EsHiIC$2/TrgLAl+/W*uWS#7' );
define( 'LOGGED_IN_KEY',    '7:t&%CMPn~v1d;T#,YbZqPVG^RQsZvJbJbFUzG|.FQne%f{a.LWKSNj?&):#V`d#' );
define( 'NONCE_KEY',        'Y+kFHBcTS:iul7w%%Ti&#fbqJrJ;n&$S:VM~^Z.B(*L_<kTt$K-7-9&-%b~zQWFq' );
define( 'AUTH_SALT',        'aAcOXj[bx_FcJ~xUq!xnzVNOEO^%([%L@LJ WwJ-@ X&f+mAwFw8P/)qPz2[%T?c' );
define( 'SECURE_AUTH_SALT', 'O7NpnfwukQx>{,?ulm vqT/=_#wDU?C^]7~Tc9>m-/^*vPmxg^$qyG[.!U3zJaB)' );
define( 'LOGGED_IN_SALT',   'ubJ6N50Y|fCmR_Hl!Q2PwcoHu3c]n%d.xmfq0Q;ak0fmqPZ~Yx~N|=(%G)&/rY76' );
define( 'NONCE_SALT',       'S86-E$A}LQ3lXAF+Vl1Wwt24d(<c5Q*VG%0&iOCbi)NF4bMc9]|Gg0OL,F4Z@N#i' );

/**#@-*/

/**
 * Tiền tố cho bảng database.
 *
 * Đặt tiền tố cho bảng giúp bạn có thể cài nhiều site WordPress vào cùng một database.
 * Chỉ sử dụng số, ký tự và dấu gạch dưới!
 */
$table_prefix = 'wp_';

/**
 * Dành cho developer: Chế độ debug.
 *
 * Thay đổi hằng số này thành true sẽ làm hiện lên các thông báo trong quá trình phát triển.
 * Chúng tôi khuyến cáo các developer sử dụng WP_DEBUG trong quá trình phát triển plugin và theme.
 *
 * Để có thông tin về các hằng số khác có thể sử dụng khi debug, hãy xem tại Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Đó là tất cả thiết lập, ngưng sửa từ phần này trở xuống. Chúc bạn viết blog vui vẻ. */

/** Đường dẫn tuyệt đối đến thư mục cài đặt WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Thiết lập biến và include file. */
require_once(ABSPATH . 'wp-settings.php');
