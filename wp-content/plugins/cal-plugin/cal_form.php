<div class="col-lg-5 col-sm-12 col-12">
          
        <div class="card">
            <div class="card-header">
                <h5 class="card-title" style="padding:0px;margin:0px;">Tính giá tem nhãn tự động</h5>
            </div>
            <div class="card-body">
                <p class="text-dark" style="font-size:12px;"><i>Vui lòng nhập kích thước, số lượng và chất liệu decal</i></p>
                <form id="calculate_form" name="caculator_form">
                    <div class="flex-row">
                        <label class="left-col">Nhập kích thước <span class="text-danger">(Đơn vị milimet)</span></label>
                        <div>
                            <input type="number" placeholder="Ngang (mm)" name="width" id="cal_width">
                        </div>
                        <div>
                            <input type="number" placeholder="Cao (mm)" name="cal_height">    
                        </div>
                    </div>
                    <div class="flex-row">
                        <label class="left-col">Số lượng cần in</label>
                        <div class="right-col">
                            <input type="number" placeholder="Nhập số lượng nhãn in" name="amount" id="cal_amout">
                        </div>
                    </div>
                    <div class="flex-row">
                        <label class="left-col">Loại in ấn</label>
                        <div class="right-col">
                            <select name="print_type" id="print_type">
                                <!-- <?php foreach ($print->in_an as $pr) : ?>
                                    <option value="<?php echo $pr ?>"><?php echo $pr ?> </option>
                                <?php endforeach?> -->
                                
                            </select>
                        </div>
                    </div>
                    <div class="flex-row">
                        <label class="left-col">Chất liệu</label>
                        <div class="right-col">
                            <select name="decal_type" id="decal_type">
                                <?php foreach ($materials as $material) : ?>
                                    <option value="<?php echo $material->material_id ?>"><?php echo $material->material_name ?> </option>
                                <?php endforeach?>
                            </select>
                        </div>
                    </div>
                    <div class="flex-row">
                        <label class="left-col">Gia công</label>
                        <div class="right-col">
                            <select id="menbran_type" name="menbran_type">
                            <!-- <?php foreach ($print->gia_cong as $pr) : ?>
                                <option value="<?php echo $pr ?>"><?php echo $pr ?> </option> -->
                            <?php endforeach?>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>