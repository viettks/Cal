<?php
/**
 * Plugin Name: Tờ rơi
 * Description: Tool tính toán giá tiền của tờ rơi
 * Version: 1.0 
 * Author: Ret
 * Author URI: fb.com
 * License: Don't care
 */

 
?>
<?php
if(!class_exists('LeafletPlugin')){
    class LeafletPlugin{
        function get_form() {
          $leaflets = $this->getData();
          require_once('leaflet-form.php');
        }

        public function getData(){
          global $wpdb;
          $sql = "
          SELECT *
          FROM 
            wp_leftlet_detail l
         ";

          return $wpdb->get_results($wpdb->prepare($sql,array($leaf_type,$material)));
        }
        function getDataByType($leaf_type, $material){
            global $wpdb;
            $sql = "
            SELECT *
            FROM 
              wp_leftlet_detail l
                WHERE 
                 l.leaf_type = %s
                 AND l.leaf_material = %s 
           ";

            return $wpdb->get_results($wpdb->prepare($sql,array($leaf_type,$material)));
        // return $wpdb->prepare($sql,array($leaf_type,$material));
        }
    }
}
function registerLeafletPlugin(){
    global $leftletPlugin ;
    $leftletPlugin = new LeafletPlugin();
    global $wpdb;
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    //create data table
   
    dbDelta($sql);
    $sql = "CREATE TABLE IF NOT EXISTS wp_leftlet_detail (
        leaf_id INT(11) NOT NULL AUTO_INCREMENT,
        leaf_material VARCHAR(100) NOT NULL DEFAULT '0' COLLATE 'utf8mb4_general_ci',
        leaf_amout BIGINT(20) NULL DEFAULT '0',
        leaf_price_per_page DOUBLE NULL DEFAULT NULL,
        leaf_price BIGINT(20) NULL DEFAULT '0',
        leaf_non_membran BIGINT(20) NULL DEFAULT '0',
        leaf_membran_01 BIGINT(20) NULL DEFAULT '0',
        leaf_membran_02 BIGINT(20) NULL DEFAULT '0',
        leaf_type VARCHAR(50) NULL DEFAULT '0',
        PRIMARY KEY (`leaf_id`) USING BTREE
    )
    COMMENT='Tờ rơi'
    COLLATE='utf8mb4_general_ci'
    ENGINE=InnoDB
    ";
    dbDelta($sql);

}
function disableLeafletPlugin(){
    global $wpdb;
    $wpdb->query( "DROP TABLE IF EXISTS wp_leftlet_detail" );
}

add_action( 'plugins_loaded', 'registerLeafletPlugin' );
register_deactivation_hook( __FILE__, 'disableLeafletPlugin' );
 
function create_menu_leafletPlugin() {
        add_menu_page('Quản lý tờ rơi', 'Quản lý tờ rơi', 'administrator', __FILE__, 'setting_leaflet_cms', 1);
}
add_action('admin_menu', 'create_menu_leafletPlugin');

function save_leaflet(){
  global $wpdb;
  $data_where['leaf_id'] = $_GET['leaf_id'];

  $data['leaf_price_per_page'] = $_GET['price_per_page'];
  $data['leaf_price'] = $_GET['leaf_price'];
  $data['leaf_non_membran'] = $_GET['leaf_non_membran'];
  $data['leaf_membran_01'] = $_GET['leaf_membran_01'];
  $data['leaf_membran_02'] = $_GET['leaf_membran_02'];
  $wpdb->update("wp_leftlet_detail",$data,$data_where);

  wp_redirect( admin_url( '/admin.php?page=leaflet-plugin%2Fleaflet-price-plugin.php' ) );
}
add_action( 'admin_post_save_leaflet', 'save_leaflet' );

function setting_leaflet_cms() {
    $leftletPlugin = new LeafletPlugin();
    $C100A3s = $leftletPlugin->getDataByType("A3","C100");
    $C150A3s = $leftletPlugin->getDataByType("A3","C100");
    $C200A3s = $leftletPlugin->getDataByType("A3","C100");

    $C100A4s = $leftletPlugin->getDataByType("A4","C100");
    $C150A4s = $leftletPlugin->getDataByType("A4","C100");
    $C200A4s = $leftletPlugin->getDataByType("A4","C100");

    $C100A5s = $leftletPlugin->getDataByType("A5","C100");
    $C150A5s = $leftletPlugin->getDataByType("A5","C100");
    $C200A5s = $leftletPlugin->getDataByType("A5","C100");
    //var_dump($C100A3s  );

 ?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<div>
<h3>Quản lý in tờ rơi</h3>
<div>
<h4>Quản lý A3</h4>

<h5>Chất liệu C100 - A3 <h5>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Chất liệu giấy</th>
      <th scope="col">Số lượng</th>
      <th scope="col">Giá tiền / tờ</th>
      <th scope="col">Giá tiền</th>
      <th scope="col">Không cán màng (số tiền tính thêm hoặc giảm)</th>
      <th scope="col">Cán màng bóng(số tiền tính thêm hoặc giảm)</th>
      <th scope="col">Cán màng mờ (số tiền tính thêm hoặc giảm)</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
<?php foreach( $C100A3s as $cl):?>
  <tr>
      <td><?php echo $cl->leaf_material?></td>
      <td><input type="hidden" name="leaf_id" value="<?php echo $cl->leaf_id?>"><?php echo $cl->leaf_amout?></td>
      <td><input type="number" name="price_per_page" value="<?php echo $cl->leaf_price_per_page?>"></td>
      <td><input type="number" name="leaf_price" value="<?php echo $cl->leaf_price?>"></td>
      <td><input type="number" name="leaf_non_membran" value="<?php echo $cl->leaf_non_membran?>"></td>
      <td><input type="number" name="leaf_membran_01" value="<?php echo $cl->leaf_membran_01?>"></td>
      <td><input type="number" name="leaf_membran_02" value="<?php echo $cl->leaf_membran_02?>"></td>
     <td><button class="btn btn-primary" onclick="save_leaflet(this)" >Lưu</button></td>
    </tr>
<?php endforeach ?>

  </tbody>
</table>

<h5>Chất liệu C150 - A3 <h5>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Chất liệu giấy</th>
      <th scope="col">Số lượng</th>
      <th scope="col">Giá tiền / tờ</th>
      <th scope="col">Giá tiền</th>
      <th scope="col">Không cán màng (số tiền tính thêm hoặc giảm)</th>
      <th scope="col">Cán màng bóng(số tiền tính thêm hoặc giảm)</th>
      <th scope="col">Cán màng mờ (số tiền tính thêm hoặc giảm)</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
<?php foreach( $C100A3s as $cl):?>
  <tr>
      <td><?php echo $cl->leaf_material?></td>
      <td><input type="hidden" name="leaf_id" value="<?php echo $cl->leaf_id?>"><?php echo $cl->leaf_amout?></td>
      <td><input type="number" name="price_per_page" value="<?php echo $cl->leaf_price_per_page?>"></td>
      <td><input type="number" name="leaf_price" value="<?php echo $cl->leaf_price?>"></td>
      <td><input type="number" name="leaf_non_membran" value="<?php echo $cl->leaf_non_membran?>"></td>
      <td><input type="number" name="leaf_membran_01" value="<?php echo $cl->leaf_membran_01?>"></td>
      <td><input type="number" name="leaf_membran_02" value="<?php echo $cl->leaf_membran_02?>"></td>
      <td><button class="btn btn-primary" onclick="save_leaflet(this)" >Lưu</button></td>
    </tr>
<?php endforeach ?>

  </tbody>
</table>

<h5>Chất liệu C200 - A3 <h5>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Chất liệu giấy</th>
      <th scope="col">Số lượng</th>
      <th scope="col">Giá tiền / tờ</th>
      <th scope="col">Giá tiền</th>
      <th scope="col">Không cán màng (số tiền tính thêm hoặc giảm)</th>
      <th scope="col">Cán màng bóng(số tiền tính thêm hoặc giảm)</th>
      <th scope="col">Cán màng mờ (số tiền tính thêm hoặc giảm)</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
<?php foreach( $C100A3s as $cl):?>
  <tr>
      <td><?php echo $cl->leaf_material?></td>
      <td><input type="hidden" name="leaf_id" value="<?php echo $cl->leaf_id?>"><?php echo $cl->leaf_amout?></td>
      <td><input type="number" name="price_per_page" value="<?php echo $cl->leaf_price_per_page?>"></td>
      <td><input type="number" name="leaf_price" value="<?php echo $cl->leaf_price?>"></td>
      <td><input type="number" name="leaf_non_membran" value="<?php echo $cl->leaf_non_membran?>"></td>
      <td><input type="number" name="leaf_membran_01" value="<?php echo $cl->leaf_membran_01?>"></td>
      <td><input type="number" name="leaf_membran_02" value="<?php echo $cl->leaf_membran_02?>"></td>
     <td><button class="btn btn-primary" onclick="save_leaflet(this)" >Lưu</button></td>
    </tr>
<?php endforeach ?>

  </tbody>
</table>

</div>

<div>
  <h4>Quản lý A3</h4>

  <h5>Chất liệu C100 - A3 <h5>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Chất liệu giấy</th>
      <th scope="col">Số lượng</th>
      <th scope="col">Giá tiền / tờ</th>
      <th scope="col">Giá tiền</th>
      <th scope="col">Không cán màng (số tiền tính thêm hoặc giảm)</th>
      <th scope="col">Cán màng bóng(số tiền tính thêm hoặc giảm)</th>
      <th scope="col">Cán màng mờ (số tiền tính thêm hoặc giảm)</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
<?php foreach( $C100A3s as $cl):?>
  <tr>
      <td><?php echo $cl->leaf_material?></td>
      <td><input type="hidden" name="leaf_id" value="<?php echo $cl->leaf_id?>"><?php echo $cl->leaf_amout?></td>
      <td><input type="number" name="price_per_page" value="<?php echo $cl->leaf_price_per_page?>"></td>
      <td><input type="number" name="leaf_price" value="<?php echo $cl->leaf_price?>"></td>
      <td><input type="number" name="leaf_non_membran" value="<?php echo $cl->leaf_non_membran?>"></td>
      <td><input type="number" name="leaf_membran_01" value="<?php echo $cl->leaf_membran_01?>"></td>
      <td><input type="number" name="leaf_membran_02" value="<?php echo $cl->leaf_membran_02?>"></td>
     <td><button class="btn btn-primary" onclick="save_leaflet(this)" >Lưu</button></td>
    </tr>
<?php endforeach ?>

  </tbody>
</table>

<h5>Chất liệu C150 - A3 <h5>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Chất liệu giấy</th>
      <th scope="col">Số lượng</th>
      <th scope="col">Giá tiền / tờ</th>
      <th scope="col">Giá tiền</th>
      <th scope="col">Không cán màng (số tiền tính thêm hoặc giảm)</th>
      <th scope="col">Cán màng bóng(số tiền tính thêm hoặc giảm)</th>
      <th scope="col">Cán màng mờ (số tiền tính thêm hoặc giảm)</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
<?php foreach( $C150A3s as $cl):?>
  <tr>
      <td><?php echo $cl->leaf_material?></td>
      <td><input type="hidden" name="leaf_id" value="<?php echo $cl->leaf_id?>"><?php echo $cl->leaf_amout?></td>
      <td><input type="number" name="price_per_page" value="<?php echo $cl->leaf_price_per_page?>"></td>
      <td><input type="number" name="leaf_price" value="<?php echo $cl->leaf_price?>"></td>
      <td><input type="number" name="leaf_non_membran" value="<?php echo $cl->leaf_non_membran?>"></td>
      <td><input type="number" name="leaf_membran_01" value="<?php echo $cl->leaf_membran_01?>"></td>
      <td><input type="number" name="leaf_membran_02" value="<?php echo $cl->leaf_membran_02?>"></td>
     <td><button class="btn btn-primary" onclick="save_leaflet(this)" >Lưu</button></td>
    </tr>
<?php endforeach ?>

  </tbody>
</table>

<h5>Chất liệu C200 - A3 <h5>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Chất liệu giấy</th>
      <th scope="col">Số lượng</th>
      <th scope="col">Giá tiền / tờ</th>
      <th scope="col">Giá tiền</th>
      <th scope="col">Không cán màng (số tiền tính thêm hoặc giảm)</th>
      <th scope="col">Cán màng bóng(số tiền tính thêm hoặc giảm)</th>
      <th scope="col">Cán màng mờ (số tiền tính thêm hoặc giảm)</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
<?php foreach( $C200A3s as $cl):?>
  <tr>
      <td><?php echo $cl->leaf_material?></td>
      <td><input type="hidden" name="leaf_id" value="<?php echo $cl->leaf_id?>"><?php echo $cl->leaf_amout?></td>
      <td><input type="number" name="price_per_page" value="<?php echo $cl->leaf_price_per_page?>"></td>
      <td><input type="number" name="leaf_price" value="<?php echo $cl->leaf_price?>"></td>
      <td><input type="number" name="leaf_non_membran" value="<?php echo $cl->leaf_non_membran?>"></td>
      <td><input type="number" name="leaf_membran_01" value="<?php echo $cl->leaf_membran_01?>"></td>
      <td><input type="number" name="leaf_membran_02" value="<?php echo $cl->leaf_membran_02?>"></td>
     <td><button class="btn btn-primary" onclick="save_leaflet(this)" >Lưu</button></td>
    </tr>
<?php endforeach ?>

  </tbody>
</table>

</div>

<div>
<h4>Quản lý A4</h4>

<h5>Chất liệu C100 - A4 <h5>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Chất liệu giấy</th>
      <th scope="col">Số lượng</th>
      <th scope="col">Giá tiền / tờ</th>
      <th scope="col">Giá tiền</th>
      <th scope="col">Không cán màng (số tiền tính thêm hoặc giảm)</th>
      <th scope="col">Cán màng bóng(số tiền tính thêm hoặc giảm)</th>
      <th scope="col">Cán màng mờ (số tiền tính thêm hoặc giảm)</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
<?php foreach( $C100A4s as $cl):?>
  <tr>
      <td><?php echo $cl->leaf_material?></td>
      <td><input type="hidden" name="leaf_id" value="<?php echo $cl->leaf_id?>"><?php echo $cl->leaf_amout?></td>
      <td><input type="number" name="price_per_page" value="<?php echo $cl->leaf_price_per_page?>"></td>
      <td><input type="number" name="leaf_price" value="<?php echo $cl->leaf_price?>"></td>
      <td><input type="number" name="leaf_non_membran" value="<?php echo $cl->leaf_non_membran?>"></td>
      <td><input type="number" name="leaf_membran_01" value="<?php echo $cl->leaf_membran_01?>"></td>
      <td><input type="number" name="leaf_membran_02" value="<?php echo $cl->leaf_membran_02?>"></td>
     <td><button class="btn btn-primary" onclick="save_leaflet(this)" >Lưu</button></td>
    </tr>
<?php endforeach ?>

  </tbody>
</table>

<h5>Chất liệu C150 -A4 <h5>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Chất liệu giấy</th>
      <th scope="col">Số lượng</th>
      <th scope="col">Giá tiền / tờ</th>
      <th scope="col">Giá tiền</th>
      <th scope="col">Không cán màng (số tiền tính thêm hoặc giảm)</th>
      <th scope="col">Cán màng bóng(số tiền tính thêm hoặc giảm)</th>
      <th scope="col">Cán màng mờ (số tiền tính thêm hoặc giảm)</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
<?php foreach( $C150A4s as $cl):?>
  <tr>
      <td><?php echo $cl->leaf_material?></td>
      <td><input type="hidden" name="leaf_id" value="<?php echo $cl->leaf_id?>"><?php echo $cl->leaf_amout?></td>
      <td><input type="number" name="price_per_page" value="<?php echo $cl->leaf_price_per_page?>"></td>
      <td><input type="number" name="leaf_price" value="<?php echo $cl->leaf_price?>"></td>
      <td><input type="number" name="leaf_non_membran" value="<?php echo $cl->leaf_non_membran?>"></td>
      <td><input type="number" name="leaf_membran_01" value="<?php echo $cl->leaf_membran_01?>"></td>
      <td><input type="number" name="leaf_membran_02" value="<?php echo $cl->leaf_membran_02?>"></td>
     <td><button class="btn btn-primary" onclick="save_leaflet(this)" >Lưu</button></td>
    </tr>
<?php endforeach ?>

  </tbody>
</table>

<h5>Chất liệu C200 - A4 <h5>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Chất liệu giấy</th>
      <th scope="col">Số lượng</th>
      <th scope="col">Giá tiền / tờ</th>
      <th scope="col">Giá tiền</th>
      <th scope="col">Không cán màng (số tiền tính thêm hoặc giảm)</th>
      <th scope="col">Cán màng bóng(số tiền tính thêm hoặc giảm)</th>
      <th scope="col">Cán màng mờ (số tiền tính thêm hoặc giảm)</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
<?php foreach( $C200A4s as $cl):?>
  <tr>
      <td><?php echo $cl->leaf_material?></td>
      <td><input type="hidden" name="leaf_id" value="<?php echo $cl->leaf_id?>"><?php echo $cl->leaf_amout?></td>
      <td><input type="number" name="price_per_page" value="<?php echo $cl->leaf_price_per_page?>"></td>
      <td><input type="number" name="leaf_price" value="<?php echo $cl->leaf_price?>"></td>
      <td><input type="number" name="leaf_non_membran" value="<?php echo $cl->leaf_non_membran?>"></td>
      <td><input type="number" name="leaf_membran_01" value="<?php echo $cl->leaf_membran_01?>"></td>
      <td><input type="number" name="leaf_membran_02" value="<?php echo $cl->leaf_membran_02?>"></td>
     <td><button class="btn btn-primary" onclick="save_leaflet(this)" >Lưu</button></td>
    </tr>
<?php endforeach ?>

  </tbody>
</table>

</div>

<div>
  <h4>Quản lý A5</h4>

  <h5>Chất liệu C100 - A5 <h5>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Chất liệu giấy</th>
      <th scope="col">Số lượng</th>
      <th scope="col">Giá tiền / tờ</th>
      <th scope="col">Giá tiền</th>
      <th scope="col">Không cán màng (số tiền tính thêm hoặc giảm)</th>
      <th scope="col">Cán màng bóng(số tiền tính thêm hoặc giảm)</th>
      <th scope="col">Cán màng mờ (số tiền tính thêm hoặc giảm)</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
<?php foreach( $C100A5s as $cl):?>
  <tr>
      <td><?php echo $cl->leaf_material?></td>
      <td><input type="hidden" name="leaf_id" value="<?php echo $cl->leaf_id?>"><?php echo $cl->leaf_amout?></td>
      <td><input type="number" name="price_per_page" value="<?php echo $cl->leaf_price_per_page?>"></td>
      <td><input type="number" name="leaf_price" value="<?php echo $cl->leaf_price?>"></td>
      <td><input type="number" name="leaf_non_membran" value="<?php echo $cl->leaf_non_membran?>"></td>
      <td><input type="number" name="leaf_membran_01" value="<?php echo $cl->leaf_membran_01?>"></td>
      <td><input type="number" name="leaf_membran_02" value="<?php echo $cl->leaf_membran_02?>"></td>
     <td><button class="btn btn-primary" onclick="save_leaflet(this)" >Lưu</button></td>
    </tr>
<?php endforeach ?>

  </tbody>
</table>

<h5>Chất liệu C150 - A5 <h5>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Chất liệu giấy</th>
      <th scope="col">Số lượng</th>
      <th scope="col">Giá tiền / tờ</th>
      <th scope="col">Giá tiền</th>
      <th scope="col">Không cán màng (số tiền tính thêm hoặc giảm)</th>
      <th scope="col">Cán màng bóng(số tiền tính thêm hoặc giảm)</th>
      <th scope="col">Cán màng mờ (số tiền tính thêm hoặc giảm)</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
<?php foreach( $C150A5s as $cl):?>
  <tr>
      <td><?php echo $cl->leaf_material?></td>
      <td><input type="hidden" name="leaf_id" value="<?php echo $cl->leaf_id?>"><?php echo $cl->leaf_amout?></td>
      <td><input type="number" name="price_per_page" value="<?php echo $cl->leaf_price_per_page?>"></td>
      <td><input type="number" name="leaf_price" value="<?php echo $cl->leaf_price?>"></td>
      <td><input type="number" name="leaf_non_membran" value="<?php echo $cl->leaf_non_membran?>"></td>
      <td><input type="number" name="leaf_membran_01" value="<?php echo $cl->leaf_membran_01?>"></td>
      <td><input type="number" name="leaf_membran_02" value="<?php echo $cl->leaf_membran_02?>"></td>
     <td><button class="btn btn-primary" onclick="save_leaflet(this)" >Lưu</button></td>
    </tr>
<?php endforeach ?>

  </tbody>
</table>

<h5>Chất liệu C200 - A5 <h5>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Chất liệu giấy</th>
      <th scope="col">Số lượng</th>
      <th scope="col">Giá tiền / tờ</th>
      <th scope="col">Giá tiền</th>
      <th scope="col">Không cán màng (số tiền tính thêm hoặc giảm)</th>
      <th scope="col">Cán màng bóng(số tiền tính thêm hoặc giảm)</th>
      <th scope="col">Cán màng mờ (số tiền tính thêm hoặc giảm)</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
<?php foreach( $C200A5s as $cl):?>
  <tr>
      <td><?php echo $cl->leaf_material?></td>
      <td><input type="hidden" name="leaf_id" value="<?php echo $cl->leaf_id?>"><?php echo $cl->leaf_amout?></td>
      <td><input type="number" name="price_per_page" value="<?php echo $cl->leaf_price_per_page?>"></td>
      <td><input type="number" name="leaf_price" value="<?php echo $cl->leaf_price?>"></td>
      <td><input type="number" name="leaf_non_membran" value="<?php echo $cl->leaf_non_membran?>"></td>
      <td><input type="number" name="leaf_membran_01" value="<?php echo $cl->leaf_membran_01?>"></td>
      <td><input type="number" name="leaf_membran_02" value="<?php echo $cl->leaf_membran_02?>"></td>
     <td><button class="btn btn-primary" onclick="save_leaflet(this)" >Lưu</button></td>
    </tr>
<?php endforeach ?>

  </tbody>
</table>

</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
  $("input[type=number]").change(function(){
    if(this.value == ""){
      this.value = 0;
    }
  });
function save_leaflet(e){
  
  var trow = $(e.closest('tr'));
  var leaf_id = trow.find("input[name=leaf_id]").val();
  var price_per_page = trow.find("input[name=price_per_page]").val();
  var leaf_price = trow.find("input[name=leaf_price]").val();
  var leaf_non_membran = trow.find("input[name=leaf_non_membran]").val();
  var leaf_membran_01 = trow.find("input[name=leaf_membran_01]").val();
  var leaf_membran_02 = trow.find("input[name=leaf_membran_02]").val();
  debugger
  var data = {
        action : "save_leaflet",
        leaf_id : leaf_id,
        price_per_page :price_per_page,
        leaf_price : leaf_price,
        leaf_non_membran : leaf_non_membran,
        leaf_membran_01 : leaf_membran_01,
        leaf_membran_02 : leaf_membran_02,
    };
    window.location.href = "<?php echo admin_url( "admin-post.php" ) ?>?"+ $.param(data);
}

</script>


<?php
}
?>
