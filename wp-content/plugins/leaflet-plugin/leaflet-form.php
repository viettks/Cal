<div>
<div>
    <h5> Tên tờ rơi</h5>
<div>
<div>
    <form>
        <div class="leaf-wrap">
            <div class="leaflet-item"><input type="radio" class="leaf-type-input" name="leaf_type" value="A5" id="type_a5" checked><label class="label-icon option1" for="type_a5"><img src="<?php echo plugin_dir_url( __FILE__ ) . 'images/IconBros.png'; ?>"><br/>A5</label></div>
            <div class="leaflet-item"><input type="radio" class="leaf-type-input" name="leaf_type" value="A4" id="type_a4"><label class="label-icon option2" for="type_a4"><img src="<?php echo plugin_dir_url( __FILE__ ) . 'images/IconBros.png'; ?>"><br/>A4</label></div>
            <div class="leaflet-item"><input type="radio" class="leaf-type-input" name="leaf_type" value="A3" id="type_a3"><label class="label-icon option3" for="type_a3"><img src="<?php echo plugin_dir_url( __FILE__ ) . 'images/IconBros.png'; ?>"><br/>A3</label></div>
            <!-- <div class="leaflet-item"><input type="radio" name="leaf_type" value="A5" id="type_a5" checked><label for="type_a5">A5</label></div>
            <div class="leaflet-item"><input type="radio" name="leaf_type" value="A4" id="type_a4"><label for="type_a4">A4</label></div>
            <div class="leaflet-item"><input type="radio" name="leaf_type" value="A3" id="type_a3"><label for="type_a3">A3</label></div> -->
        </div>
        <div class="leaf-wrap">
            <div class="inline leaf-title">Chất liệu</div>
            <div class="inline leaf-data">
                <div class="leaflet-item-data"><input type="radio" class="leaf-type-input" name="leaf_material" value="C100" id="material_C100" checked><label class="label-icon option1" for="material_C100">C100</label></div>
                <div class="leaflet-item-data"><input type="radio" class="leaf-type-input" name="leaf_material" value="C150" id="material_C150"><label class="label-icon option2" for="material_C150">C150</div>
                <div class="leaflet-item-data"><input type="radio" class="leaf-type-input" name="leaf_material" value="C200" id="material_C200"><label class="label-icon option3" for="material_C200">C200</label></div>
            </div>
        </div>
        <div class="leaf-wrap">
            <div class="inline leaf-title">Gia công</div>
            <div class="inline leaf-data">
                <div class="leaflet-item-data"><input type="radio" class="leaf-type-input" name="leaf_membran" value="memban_00" id="memban_00" checked><label class="label-icon option1" for="memban_00">Không cán màng</label></div>
                <div class="leaflet-item-data"><input type="radio" class="leaf-type-input" name="leaf_membran" value="memban_01" id="memban_01"><label class="label-icon option2" for="memban_01">Cán màng bóng</div>
                <div class="leaflet-item-data"><input type="radio" class="leaf-type-input" name="leaf_membran" value="memban_02" id="memban_02"><label class="label-icon option3" for="memban_02">Cán màng mờ</label></div>
            </div>
        </div>

        <div class="leaf-wrap">
            <div class="inline leaf-title">Số lượng</div>
            <div class="inline leaf-data">
                <select name="leaf_amout" id="leaf_amout">
                    <!-- <?php var_dump($leafFirst)?>  -->
                   <?php foreach ($leafFirst as $leaf) :?>
                        <option value="<?php echo $leaf->leaf_id ?>"><?php echo $leaf->leaf_amout?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
        <div class="leaf-wrap">
            <div class="inline leaf-title">Thời gian in</div>
            <div class="inline leaf-data">
                <div class="inline"><input type="radio" name="leaf_time" value="00" id="time_00" checked><label for="time_00">Lấy ngay (tăng 5% phí)</label></div>
                <div class="inline"><input type="radio" name="leaf_time" value="02" id="time_02"><label for="time_02">Sau 2-3 ngày (Giảm 5%)</label></div>
                <div class="inline"><input type="radio" name="leaf_time" value="07" id="time_07"><label for="time_07">Sau 1 tuần (Giảm 10%)</label></div>
            </div>
        </div>

    </form>
</div>

<div id="bill_wrap">
    <div class="leaf-wrap">
        <div class="inline leaf-title">Đơn giá</div>
        <div class="inline leaf-data">
            <label id="bill"></label>
        </div>
    </div>
    <div class="leaf-wrap">
        <div class="inline leaf-title">Gia công</div>
        <div class="inline leaf-data">
            <label id="bill_membran"></label>
        </div>
    </div>
    <div class="leaf-wrap">
        <div class="inline leaf-title">Phí thời gian</div>
        <div class="inline leaf-data">
            <label id="bill_time"></label>
        </div>
    </div>
    <div class="leaf-wrap">
        <div class="inline leaf-title">Thuế VAT(10%) </div>
        <div class="inline leaf-data">
            <label id="bill_vat"></label>
        </div>
    </div>
    <div class="leaf-wrap">
        <div class="inline leaf-title">Thành tiền</div>
        <div class="inline leaf-data">
            <label id="bill_total"></label>
        </div>
    </div>
</div>
</div>
<style>
.inline{
    display: inline-block;
}
.leaflet-item{
    width: 33%;
    text-align: center;
    display: inline-block;
    vertical-align: bottom;
}
.leaf-wrap{
    width: 100%;
    display: block;
    padding: 15px;
}
.leaf-type-input{
    display: none;
}
.leaf-type-label:hover{
    cursor: pointer;
}
.label-icon{
    cursor: pointer;
    font-size: x-large;

}
.option1 img{
    width: 100px;
    
}
.option2 img{
    width: 120px;
    
}
.option3 img{
    width: 150px;
    
}
.leaf-title{
    width: 20%;
    vertical-align: middle;
}
.leaf-data{
    width: 70%;
}
.leaf-data select{
    width: 100%;
}
input[name=leaf_type]:checked+label img{ 
    background-color: #edf3fe;
    border: solid 1px red;

}
input[name=leaf_material]:checked+label{ 
    background-color: #edf3fe;
    border: solid 1px red;

}
input[name=leaf_membran]:checked+label{ 
    background-color: #edf3fe;
    border: solid 1px red;

} 
.leaflet-item-data{
    width: 33%;
    text-align: center;
    display: inline-block;
    vertical-align: bottom;
}
.option1,.option2,.option3{
    max-width: 200px;
    min-width: 100px;
    text-align: center;
    padding: 15px;
}
#bill_wrap{
    display: none;
}
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
 <script>
    var dataSet = <?php echo json_encode($leaflets); ?>;
    // $("input[name='leaf_type']:radio").on("change", function() { 
    //     var type = this.value;
    //     var material =  $("input[name='leaf_material']").val();
        
    //     $("#leaf_amout option").remove();
    //     $.each(dataSet, function( index, value ) {
    //         if(value.leaf_type == type && value.leaf_material == material){
    //             $("#leaf_amout").append("<option value='" + value.leaf_id+ "'>" + value.leaf_amout + "</option>")
    //         }
    //     });
    // });

    // $("input[name='leaf_material']:radio").on("change", function() { 
    //     var material = this.value;
    //     var type = $("input[name='leaf_type']").val();
    //     $("#leaf_amout option").remove();
    //     $.each(dataSet, function( index, value ) {
    //         if(value.leaf_type == type && value.leaf_material == material){
    //             $("#leaf_amout").append("<option value='" + value.leaf_id+ "'>" + value.leaf_amout + "</option>")
    //         }
    //     });
    // })
    $("input[name='leaf_type']:radio, input[name='leaf_material']:radio , input[name='leaf_membran']:radio , input[name='leaf_time']:radio , #leaf_amout").change(function(e){
        if(e.currentTarget.name == "leaf_type" || e.currentTarget.name == "leaf_material"){
            var type = $("input[name='leaf_type']").val();
            var material =  $("input[name='leaf_material']").val();
            $("#leaf_amout option").remove();
            $.each(dataSet, function( index, value ) {
                if(value.leaf_type == type && value.leaf_material == material){
                    $("#leaf_amout").append("<option value='" + value.leaf_id+ "'>" + value.leaf_amout + "</option>")
                }
            });
        }

        

        var type = $("input[name='leaf_type']:checked").val();
        var material =  $("input[name='leaf_material']:checked").val();
        var membran =  $("input[name='leaf_membran']:checked").val();
        var amount =  $("#leaf_amout").val();
        var time =  $("input[name='leaf_time']:checked").val();
        var currentData = {};
        $.each(dataSet, function( index, value ) {
            if(value.leaf_id == amount){
                currentData = value;
                return;
            }
        });
        
        var price_membran = 0;
        if(membran == "memban_00"){
            price_membran = parseInt(currentData.leaf_non_membran);
        }else if(membran == "memban_01"){
            price_membran =  parseInt(currentData.leaf_membran_01);
        }else if(membran == "memban_02"){
            price_membran =  parseInt(currentData.leaf_membran_02);
        }

        var price_time = 0;
        var price_time_text = "0%";
        if(time == "00"){
            price_time = 0.05;
            price_time_text = "+5%"
        }else if(time == "02"){
            price_time = -0.05;
            price_time_text = "-5%"
        }else if(time == "07"){
            price_time = -0.1;
            price_time_text = "-10%"
        }
        var price = parseInt(currentData.leaf_price) + price_membran ;
        var price_receive = price_time * price;
        var total = price + price_receive;

        var price_vat = 0.1 * total ;

        var price_end = total + price_vat;

        $("#bill_wrap").show();
        $("#bill").text(currentData.leaf_price_per_page + ' x ' + currentData.leaf_amout + ' = ' + currentData.leaf_price);
        $("#bill_membran").text(price_membran);
        $("#bill_membran").text(price_membran);
        $("#bill_time").text(price_receive);
        $("#bill_vat").text(price_vat);
        $("#bill_total").text(price_end);
    })


</script>
