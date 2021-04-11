<?php
/**
 * Plugin Name: cal-plugin
 * Description: Đây là plugin đầu tiên mà tôi viết dành riêng cho WordPress, chỉ để học tập mà thôi. // Phần mô tả cho plugin
 * Version: 1.0 // Đây là phiên bản đầu tiên của plugin
 * Author: Sau Hi // Tên tác giả, người thực hiện plugin này
 * Author URI: http://sauhi.com // Địa chỉ trang chủ của tác giả
 * License: GPLv2 or later // Thông tin license của plugin, nếu không quan tâm thì bạn cứ để GPLv2 vào đây
 */

 
?>
<?php
if(!class_exists('CaculatorForm')){
    class CaculatorForm{
        function get_form() {
            $materials = $this->get_material();
            $membrans = $this->get_membran();
            require_once('cal_form.php');
        }
        function get_material(){
            global $wpdb;
            $sql = "
            SELECT 
                m.material_id,
                m.material_name,
                m.material_price,
                m.material_price_50, 
                m.material_price_100, 
                m.material_price_200, 
                m.material_price_big  
            FROM wp_material m";
            return $wpdb->get_results($sql);
        }
        function get_membran(){
            global $wpdb;
            $sql = "
            SELECT 
                m.membran_id,
                m.membran_name,
                m.membran_price,
                m.membran_price_50, 
                m.membran_price_100, 
                m.membran_price_200, 
                m.membran_price_big  
            FROM wp_membran m";
            return $wpdb->get_results($sql);
        }
        
    }
}
function caculatorFormLoading(){
    global $cal_form ;
    $cal_form = new CaculatorForm();
    global $wpdb;

    //create data table
    $sql = "CREATE TABLE IF NOT EXISTS wp_material (
       	material_id INT(11) NOT NULL AUTO_INCREMENT,
        material_name VARCHAR(100) NOT NULL DEFAULT '0' COLLATE 'utf8mb4_general_ci',
        material_price BIGINT(20) NULL DEFAULT NULL,
        material_price_50 DOUBLE NULL DEFAULT NULL,
        material_price_100 DOUBLE NULL DEFAULT NULL,
        material_price_200 DOUBLE NULL DEFAULT NULL,
        material_price_big DOUBLE NULL DEFAULT NULL,
	PRIMARY KEY (material_id) USING BTREE
    )
    COMMENT= 'Chất liệu'
    COLLATE= utf8mb4_general_ci
    ENGINE=InnoDB";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
    $sql = "CREATE TABLE IF NOT EXISTS wp_membran (
        membran_id INT(11) NOT NULL AUTO_INCREMENT,
        membran_name VARCHAR(100) NOT NULL DEFAULT '0' COLLATE 'utf8mb4_general_ci',
        membran_price BIGINT(20) NULL DEFAULT NULL,
        membran_price_50 DOUBLE NULL DEFAULT NULL,
        membran_price_100 DOUBLE NULL DEFAULT NULL,
        membran_price_200 DOUBLE NULL DEFAULT NULL,
        membran_price_big DOUBLE NULL DEFAULT NULL,
    PRIMARY KEY (membran_id) USING BTREE
    )
    COMMENT= 'Màng bọc'
    COLLATE= utf8mb4_general_ci
    ENGINE=InnoDB";
    dbDelta($sql);

}
function disableCaculatorForm(){
    global $wpdb;
    $wpdb->query( "DROP TABLE IF EXISTS wp_material" );
    $wpdb->query( "DROP TABLE IF EXISTS wp_wp_membran" );
}

add_action( 'plugins_loaded', 'caculatorFormLoading' );
register_deactivation_hook( __FILE__, 'disableCaculatorForm' );

function enqueue_scripts_and_styles()
{
        wp_enqueue_script('jquery');
        wp_register_script('my-plugin-script', plugins_url( '/js/script.js', __FILE__ ));
        wp_enqueue_script( 'my-plugin-script' );
 
}
add_action( 'wp_enqueue_scripts', 'enqueue_scripts_and_styles' );

?>




<?php
 
function cal_form_create_menu() {
        add_menu_page('Settings Caculator Form', 'Caculator Form Setings', 'administrator', __FILE__, 'setting_pages', 1);
}

add_action('admin_menu', 'cal_form_create_menu'); 
function save_material(){
    
     $material_id =  $_GET['material_id'];
     $material_name =  $_GET['material_name'];
     $material_price =  $_GET['material_price'];
     $material_price_50 =  $_GET['material_price_50'];
     $material_price_100 =  $_GET['material_price_100'];
     $material_price_200 =  $_GET['material_price_200'];
     $material_price_big =  $_GET['material_price_big'];
     $data = array( "material_name" => $material_name,
     "material_price" => $material_price,
     "material_price_50" => $material_price_50,
     "material_price_100" => $material_price_100,
     "material_price_200" => $material_price_200,
     "material_price_big" => $material_price_big);
     global $wpdb;
     if($material_id){
        $data['material_id'] = $material_id;
        $wpdb->replace("wp_material",$data);
     }else{
        $wpdb->insert("wp_material",$data);
     }
     wp_redirect( admin_url( '/admin.php?page=cal-plugin%2Fcal_plugin.php' ) );
}

add_action( 'admin_post_save_material', 'save_material' );
function setting_pages() {
    $cal_form = new CaculatorForm();
    $materials = $cal_form->get_material();
    $membrans = $cal_form->get_membran();
    
?>
<div class="wrap">
<h1>Cài đặt form</h1>
<?php echo admin_url( 'admin-post.php' ) ?>
<h2>Cài đặt chất liệu</h2>
<table id="tb_material">
<tr>
    <th>Mã chất liệu</th>
    <th>Tên chất liệu</th>
    <th>giá tiền/m2</th>
    <th>50< số lượng < 100 <br> (%)</th>
    <th>100< số lượng < 200 <br> (%)</th>
    <th>200< số lượng < 400 <br> (%)</th>
    <th>400< số lượng<br> (%)</th>
    <th>action</th>
</tr>
<?php foreach($materials as $material) : ?>
    <tr>
        <td><input type="hidden" name="material_id" value="<?php echo $material->material_name;?>"><?php echo $material->material_id;?></td>
        <td><input type="text" name="material_name" value="<?php echo $material->material_name;?>"></td>
        <td><input type="text" name="material_price" value="<?php echo $material->material_price;?>"></td>
        <td><input type="text" name="material_price_50" value="<?php echo $material->material_price_50;?>"></td>
        <td><input type="text" name="material_price_100" value="<?php echo $material->material_price_100;?>"></td>
        <td><input type="text" name="material_price_200" value="<?php echo $material->material_price_200;?>"></td>
        <td><input type="text" name="material_price_big" value="<?php echo $material->material_price_big;?>"></td>
        <td><button onclick="save_material(this)" >Lưu</button><button onclick="del_material()" >Xóa</button></td>
    </tr>

<?php endforeach ?>

</table>
<button id="btn_add_row_material" >Thêm cột</button>

<h2>Cài đặt chất liệu</h2>
<form>
<table>
<tr>
    <th>Mã chất liệu</th>
    <th>Tên chất liệu</th>
    <th>giá tiền/m2</th>
    <th>50< số lượng < 100 <br> (%)</th>
    <th>100< số lượng < 200 <br> (%)</th>
    <th>200< số lượng < 400 <br> (%)</th>
    <th>400< số lượng<br> (%)</th>
</tr>
<?php foreach($membrans as $membran) : ?>
    <tr>
        <td><?php echo $membran->membran_id;?></td>
        <td><?php echo $membran->membran_name;?></td>
        <td><?php echo $membran->membran_price;?></td>
        <td><?php echo $membran->membran_price_50;?></td>
        <td><?php echo $membran->membran_price_100;?></td>
        <td><?php echo $membran->membran_price_200;?></td>
        <td><?php echo $membran->membran_price_big;?></td>
    </tr>

<?php endforeach ?>

</table>
<button>Lưu giá trị</button>
</form>


</div>
<script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>
<?php
wp_enqueue_script( 'cal-js', plugins_url( 'js\script.js', __FILE__ ));
} ?>


