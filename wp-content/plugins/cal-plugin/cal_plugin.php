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
                m.material_name 
            FROM wp_material m";
            return $wpdb->get_results($sql);
        }
        function get_membran(){
            global $wpdb;
            $sql = "
            SELECT 
                m.membran_id,
                m.membran_name,
                m.membran_price
            FROM wp_membran m";
            return $wpdb->get_results($sql);
        }
        function get_print_tech(){
            global $wpdb;
            $sql = "
            SELECT p.print_id,
                p.print_name,
                p.print_price,
                p.print_price_30,
                p.print_price_50,
                p.print_price_100,
                p.print_price_200,
                p.print_price_big 
            FROM wp_print_tech p";
            return $wpdb->get_results($sql);
        }
        
    }
}
function caculatorFormLoading(){
    global $cal_form ;
    $cal_form = new CaculatorForm();
    global $wpdb;
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    //create data table
    $sql = "CREATE TABLE IF NOT EXISTS wp_material (
        material_id INT(11) NOT NULL AUTO_INCREMENT,
        material_name VARCHAR(100) NOT NULL DEFAULT '0' COLLATE 'utf8mb4_general_ci',
        PRIMARY KEY (material_id) USING BTREE
    )
    COMMENT='Chất liệu'
    COLLATE='utf8mb4_general_ci'
    ENGINE=InnoDB";
    
    dbDelta($sql);
    $sql = "CREATE TABLE IF NOT EXISTS wp_membran (
        membran_id INT(11) NOT NULL AUTO_INCREMENT,
        membran_name VARCHAR(100) NOT NULL DEFAULT '0' COLLATE 'utf8mb4_general_ci',
        membran_price BIGINT(20) NULL DEFAULT '0',
    PRIMARY KEY (membran_id) USING BTREE
    )
    COMMENT= 'Màng bọc'
    COLLATE= utf8mb4_general_ci
    ENGINE=InnoDB";
    dbDelta($sql);
    $sql = "CREATE TABLE IF NOT EXISTS wp_print_tech (
        print_id INT(11) NOT NULL AUTO_INCREMENT,
        print_name VARCHAR(100) NOT NULL DEFAULT '0' COLLATE 'utf8mb4_general_ci',
        print_price BIGINT(20) NULL DEFAULT '0',
        print_price_30 BIGINT(20) NULL DEFAULT '0',
        print_price_50 BIGINT(20) NULL DEFAULT '0',
        print_price_100 BIGINT(20) NULL DEFAULT '0',
        print_price_200 BIGINT(20) NULL DEFAULT '0',
        print_price_big BIGINT(20) NULL DEFAULT '0',
    PRIMARY KEY (print_id) USING BTREE
    )
    COMMENT= 'Công nghệ in'
    COLLATE= utf8mb4_general_ci
    ENGINE=InnoDB";
    dbDelta($sql);

}
function disableCaculatorForm(){
    global $wpdb;
    $wpdb->query( "DROP TABLE IF EXISTS wp_material" );
    $wpdb->query( "DROP TABLE IF EXISTS wp_membran" );
    $wpdb->query( "DROP TABLE IF EXISTS wp_print_tech" );
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
     $material_name =  $_GET['material_name'];
     global $wpdb;
   
     $data['material_name'] = $material_name;
     $wpdb->insert("wp_material",$data);
     wp_redirect( admin_url( '/admin.php?page=cal-plugin%2Fcal_plugin.php' ) );
}

function delete_material(){
    
    $material_id =  $_GET['material_id'];
    $data['material_id'] = $material_id;
    global $wpdb;
    $wpdb->delete("wp_material",$data);
    wp_redirect( admin_url( '/admin.php?page=cal-plugin%2Fcal_plugin.php' ) );
}

add_action( 'admin_post_save_material', 'save_material' );
add_action( 'admin_post_detete_material', 'delete_material' );

function save_membran(){
    global $wpdb;
    $data['membran_name'] = $_GET['membran_name'];
    $data['membran_price'] = $_GET['membran_price'];
    $wpdb->insert("wp_membran",$data);
    wp_redirect( admin_url( '/admin.php?page=cal-plugin%2Fcal_plugin.php' ) );
}
add_action( 'admin_post_save_membran', 'save_membran' );

function delete_membran(){
    
    $data['membran_id'] =  $_GET['membran_id'];
    global $wpdb;
    $wpdb->delete("wp_membran",$data);
    wp_redirect( admin_url( '/admin.php?page=cal-plugin%2Fcal_plugin.php' ) );
}
add_action( 'admin_post_delete_membran', 'delete_membran' );

function save_print_tech(){
    global $wpdb;
    $data['print_name'] = $_GET['print_name'];
    $data['print_price'] = $_GET['print_price'];
    $data['print_price_30'] = $_GET['print_price_30'];
    $data['print_price_50'] = $_GET['print_price_50'];
    $data['print_price_100'] = $_GET['print_price_100'];
    $data['print_price_200'] = $_GET['print_price_200'];
    $data['print_price_big'] = $_GET['print_price_big'];

    $wpdb->insert("wp_print_tech",$data);
    wp_redirect( admin_url( '/admin.php?page=cal-plugin%2Fcal_plugin.php' ) );
}
add_action( 'admin_post_save_print_tech', 'save_print_tech' );

function delete_print_tech(){
    
    $data['print_id'] =  $_GET['print_id'];
    global $wpdb;
    $wpdb->delete("wp_print_tech",$data);
    wp_redirect( admin_url( '/admin.php?page=cal-plugin%2Fcal_plugin.php' ) );
}
add_action( 'admin_post_delete_print_tech', 'delete_print_tech' );

function setting_pages() {
    $cal_form = new CaculatorForm();
    $materials = $cal_form->get_material();
    $membrans = $cal_form->get_membran();
    $print_techs = $cal_form->get_print_tech();
    $i = 1;
    
?>
<div class="wrap">
<h1>Cài đặt form</h1>
<?php echo admin_url( 'admin-post.php' ) ?>
<h2>Cài đặt chất liệu</h2>
<table id="tb_material">
<tr>
    <th>STT</th>
    <th>Tên chất liệu</th>
    <th>action</th>
</tr>
<?php foreach($materials as $material) : ?>
    <tr>
        <td><?php echo $i++?></td>
        <td><?php echo $material->material_name;?></td>
        <td><button onclick="del_material(<?php echo $material->material_id;?>)" >Xóa</button></td>
    </tr>

<?php endforeach ?>

</table>
<form onsubmit="return false;"> 
    <label for="add_material_name">Tên chất liệu</label>
    <input type="text" name="material_name" id="add_material_name">
    <button id="btn_add_material" type="button" >Thêm chất liệu</button>
 </form>


<h2>Cài đặt màng bọc</h2>
<table>
<tr>
    <th>STT</th>
    <th>Tên màng</th>
    <th>giá tiền/m2</th>
</tr>
<?php 
    $i = 1;
    foreach($membrans as $membran) : ?>
    <tr>
        <td><?php echo $i++?></td>
        <td><?php echo $membran->membran_name;?></td>
        <td><?php echo $membran->membran_price;?></td>
        <td><button onclick="del_membran(<?php echo $membran->membran_id;?>)" >Xóa</button></td>
    </tr>

<?php endforeach ?>

</table>
<form onsubmit="return false;"> 
    <label for="add_membran_name">Tên màng</label>
    <input type="text" name="membran_name" id="add_membran_name">
    <label for="add_membran_price">Giá tiền/m2</label>
    <input type="number" name="membran_price" id="add_membran_price">
    <button id="btn_add_membran" type="button" >Thêm màng</button>
 </form>

<h2>Cài đặt công nghệ in</h2>
<table>
<tr>

    <th rowspan="2">STT</th>
    <th rowspan="2">Tên công nghệ</th>
    <th colspan="6">giá tiền/m2</th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th rowspan="2">action</th>
</tr>
<tr>
    <th></th>
    <th></th>
    <th>Dưới 10m2</th>
    <th>10-30m2</th>
    <th>30-50m2</th>
    <th>50-100m2</th>
    <th>100-200m2</th>
    <th>trên 200m2</th>
    <th></th>
</tr>
<?php 
    $i = 1;
    foreach($print_techs as $pr) : ?>
    <tr>
        <td><?php echo $i++?></td>
        <td><?php echo $pr->print_name;?></td>
        <td><?php echo $pr->print_price;?></td>
        <td><?php echo $pr->print_price_30;?></td>
        <td><?php echo $pr->print_price_50;?></td>
        <td><?php echo $pr->print_price_100;?></td>
        <td><?php echo $pr->print_price_200;?></td>
        <td><?php echo $pr->print_price_big;?></td>
        <td><button onclick="del_print_tech(<?php echo $pr->print_id;?>)" >Xóa</button></td>
    </tr>

<?php endforeach ?>
</table>

<form onsubmit="return false;"> 
    <label for="add_membran_name">Tên màng</label>
    <input type="text" name="print_name" id="print_name">
    <label for="add_membran_price">Dưới 10</label>
    <input type="number" name="print_price" id="print_price">
    <label for="add_membran_price">Dưới 2</label>
    <input type="number" name="print_price_30" id="print_price_30">
    <label for="add_membran_price">Dưới 3</label>
    <input type="number" name="print_price_50" id="print_price_50">
    <label for="add_membran_price">Dưới 4</label>
    <input type="number" name="print_price_100" id="print_price_100">
    <label for="add_membran_price">Dưới 5</label>
    <input type="number" name="print_price_200" id="print_price_200">
    <label for="add_membran_price">Dưới 6</label>
    <input type="number" name="print_price_big" id="print_price_big">
  
    <button id="btn_save_print" type="button" >Lưu công nghệ in</button>
 </form>


</div>
<script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>
<?php
wp_enqueue_script( 'cal-js', plugins_url( 'js\script.js', __FILE__ ));
} ?>


