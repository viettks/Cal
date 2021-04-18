$( document ).ready(function() {
    $('#btn_add_material').click(function(){
        save_material();
    });
    $('#btn_add_membran').click(function(){
        save_membran();
    });
    $('#btn_save_print').click(function(){
        save_print_tech();
    })
});

function save_material(){
    var data = {
        "action":"save_material",
        "material_name": $('#add_material_name').val(),
    };
    window.location.href = "http://localhost/wordpress/wp-admin/admin-post.php?"+$.param(data);
}
function del_material(id){
    var data = {
        "action":"detete_material",
        "material_id": id,
    };
    window.location.href = "http://localhost/wordpress/wp-admin/admin-post.php?"+$.param(data);
}

function save_membran(){
    var data = {
        "action":"save_membran",
        "membran_name": $('#add_membran_name').val(),
        "membran_price": $('#add_membran_price').val(),
    };
    window.location.href = "http://localhost/wordpress/wp-admin/admin-post.php?"+$.param(data);
}
function del_membran(id){
    var data = {
        "action":"delete_membran",
        "membran_id": id,
    };
    window.location.href = "http://localhost/wordpress/wp-admin/admin-post.php?"+$.param(data);
}

function save_print_tech(){
    var data = {
        "action":"save_print_tech",
        "print_id":$('#print_id').val(),
        "print_name":$('#print_name').val(),
        "print_price":$('#print_price').val(),
        "print_price_30":$('#print_price_30').val(),
        "print_price_50":$('#print_price_50').val(),
        "print_price_100":$('#print_price_100').val(),
        "print_price_200":$('#print_price_200').val(),
        "print_price_big":$('#print_price_big').val(),
    };
    window.location.href = "http://localhost/wordpress/wp-admin/admin-post.php?"+$.param(data);
}
function del_print_tech(id){
    var data = {
        "action":"delete_print_tech",
        "print_id": id,
    };
    window.location.href = "http://localhost/wordpress/wp-admin/admin-post.php?"+$.param(data);
}
function edit_to_frm(e){
    var tbr = $(e.closest('tr'));
    $('#print_id').val(tbr.find('td input').val());
    $('#print_name').val(tbr.find('td')[1].innerText);
    $('#print_price').val(tbr.find('td')[2].innerText);
    $('#print_price_30').val(tbr.find('td')[3].innerText);
    $('#print_price_50').val(tbr.find('td')[4].innerText);
    $('#print_price_100').val(tbr.find('td')[5].innerText);
    $('#print_price_200').val(tbr.find('td')[6].innerText);
    $('#print_price_big').val(tbr.find('td')[7].innerText);
}