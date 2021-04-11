$( document ).ready(function() {
    $('#btn_add_row_material').click(function(){
        $('#tb_material').append(material_template);
    })
});

function save_material(e){
    var tb_row = $(e.closest('tr'));
    var data = {
        "action":"save_material",
        "material_id": tb_row.find('input[name=material_id').val(),
        "material_name": tb_row.find('input[name=material_name').val(),
        "material_price": tb_row.find('input[name=material_price').val(),
        "material_price_50": tb_row.find('input[name=material_price_50').val(),
        "material_price_100": tb_row.find('input[name=material_price_100').val(),
        "material_price_200": tb_row.find('input[name=material_price_200').val(),
        "material_price_big": tb_row.find('input[name=material_price_big').val()
    };
    window.location.href = "http://localhost/wordpress/wp-admin/admin-post.php?"+$.param(data);
}
var material_template = ' <tr>'+
'<td><input type="hidden" name="material_id" value=""></td>'+
'<td><input type="text" name="material_name" value=""></td>'+
'<td><input type="text" name="material_price" value=""></td>'+
'<td><input type="text" name="material_price_50" value=""></td>'+
'<td><input type="text" name="material_price_100" value=""></td>'+
'<td><input type="text" name="material_price_200" value=""></td>'+
'<td><input type="text" name="material_price_big" value=""></td>'+
'<td><button onclick="save_material(this)" >Lưu</button><button onclick="del_material()" >Xóa</button></td>'+
'</tr>';