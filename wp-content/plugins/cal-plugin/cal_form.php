       <style>
           .card{
               background-color: #ffffff;
               margin: 20px;
               padding: 50px;
               border-radius: 20px;
           }
           .card-header{
               margin: 0px;
               padding: 10px;
               background-color: #00000008;
           }
           .cal-label{
                color: #212529 ;
                flex: 0 0 33.333333%;
                max-width: 33.333333%;
           }
           .flex-row{
                margin-bottom: 1rem;
                display: flex;
                flex-wrap: wrap;
                
           }
           .size-row{
                flex: 0 0 33.333333%;
                max-width: 33.333333%;
                padding-top: 10px;

            }
            .cal-right{
                flex: 0 0 66.666666%;
                max-width: 66.666666%;
                padding-top: 10px;
            }
            .form-input{
                width: 100%;
            }


       </style>
       
       <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tính giá tem nhãn tự động</h4>
            </div>
            <div class="card-body">
                <form id="calculate_form" name="caculator_form">
                    <div class="flex-row">
                        <label class="cal-label">Kích thước (Đơn vị mm)</label>
                        <div class="size-row">
                            <input type="number" class="form-input" placeholder="dài (mm)" name="width" id="cal_width">
                        </div>
                        <div class="size-row">
                            <input type="number"  class="form-input" placeholder="Rộng (mm)" name="cal_height" id="cal_height">    
                        </div>
                    </div>
                    <div class="flex-row">
                        <label class="cal-label">Số lượng cần in</label>
                        <div class="cal-right">
                            <input type="number" class="form-input" placeholder="Nhập số lượng nhãn in" name="amount" id="cal_amout">
                        </div>
                    </div>
                    <div class="flex-row">
                        <label class="cal-label">Công nghệ in</label>
                        <div class="cal-right">
                            <select name="print_type" id="print_type" class="form-input">
                                <?php foreach ($print_techs as $pr) : ?>
                                    <option value="<?php echo $pr->print_id ?>"><?php echo $pr->print_name ?> </option>
                                <?php endforeach?>
                                
                            </select>
                        </div>
                    </div>
                    <div class="flex-row">
                        <label class="cal-label">Chất liệu</label>
                        <div class="cal-right">
                            <select name="material_type" id="material_type" class="form-input">
                                <?php foreach ($materials as $material) : ?>
                                    <option value="<?php echo $material->material_id ?>"><?php echo $material->material_name ?> </option>
                                <?php endforeach?>
                            </select>
                        </div>
                    </div>
                    <div class="flex-row">
                        <label class="cal-label">Gia công</label>
                        <div class="cal-right">
                            <select id="menbran_type" name="menbran_type" class="form-input">
                            <?php foreach ($membrans as $membran) : ?>
                                <option value="<?php echo $membran->membran_id ?>"><?php echo $membran->membran_name; ?> </option> -->
                            <?php endforeach?>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="temporary_wrap" style="display: none;">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Giá tạm tính</h5>
            </div>
            <div class="card-body">
                <form id="temporary" name="temporary_form">
                    <div class="flex-row">
                        <label class="cal-label">Kích thước</label>
                        <div class="cal-right">
                            <input type="hidden" id="temporary_size">
                            <label id="temporary_size_label">1</label>
                        </div>
                        
                    </div>
                    <div class="flex-row">
                        <label class="cal-label">Số lượng</label>
                        <div class="cal-right">
                            <input type="hidden" id="temporary_amout">
                            <label id="temporary_amout_label">1</label>
                        </div>
                        
                    </div>
                    <div class="flex-row">
                        <label class="cal-label">Loại decan</label>
                        <div class="cal-right">
                            <input type="hidden" id="temporary_material">
                            <label id="temporary_material_label">1</label>
                        </div>
                        
                    </div>
                    <div class="flex-row">
                        <label class="cal-label">Đơn giá </label>
                        <div class="cal-right">
                            <input type="hidden" id="temporary_price">
                            <label id="temporary_price_label">1</label>
                        </div>
                       
                    </div>
                    <div class="flex-row">
                        <label class="cal-label">Thành tiền </label>
                        <div class="cal-right">
                            <input type="hidden" id="temporary_total">
                            <label id="temporary_total_label">1</label>
                        </div>
                        
                    </div>
                    <div class="flex-row">
                        <label  class="cal-label">VAT</label>
                        <div class="cal-right">
                            <input type="hidden" id="temporary_vat">
                            <label id="temporary_vat_label">1</label>
                        </div>
                    </div>
                    <div class="flex-row">
                        <label class="cal-label">Tổng tiền</label>
                        <div class="cal-right">
                            <input type="hidden" id="temporary_total_vat">
                            <label id="temporary_total_vat_label">1</label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script
    src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
    <script>
    $("#cal_width, #cal_height,#cal_amout,#print_type,#material_type,#menbran_type").change(function () {
        
        if($("#cal_width").val()!=""&&$("#cal_height").val()!=""&&$("#cal_amout").val()!=""){
            var data = {
					action : "get_ajax_price",
                    width : $("#cal_width").val(),
                    height : $("#cal_height").val(),
                    amount : $("#cal_amout").val(),
                    print_tech_id : $("#print_type").val(),
                    material_id : $("#material_type").val(),
                    membran_id : $("#menbran_type").val(),
				};
            $.ajax({
			    type: "post",
				url: "<?php echo admin_url( 'admin-ajax.php' ); ?>?"+ $.param(data),
                dataType : "json", 
                context: this,
				success: function(data)
				{
                        $('#temporary_size_label').text(data.size);
                        $('#temporary_amout_label').text(data.amount);
                        $('#temporary_material_label').text(data.decal_type);
                        $('#temporary_price_label').text(data.price + " VND/m2");
                        $('#temporary_total_label').text(data.total_price);
                        $('#temporary_vat_label').text(data.vat_price);
                        $('#temporary_total_vat_label').text(data.total_price_vat);
                        $('#temporary_wrap').show();
				}
				,error: function(xhr) {
				}
			});
        }else{
            
        }
    })
    </script>