<div class="col-lg-5 col-sm-12 col-12">
          
        <div class="card">
            <div class="card-header">
                <h5 class="card-title" style="padding:0px;margin:0px;">Tính giá tem nhãn tự động</h5>
            </div>
            <div class="card-body">
                <form id="calculate_form" name="caculator_form">
                    <div class="flex-row">
                        <label class="left-col">Kích thước (Đơn vị mm)</label>
                        <div>
                            <input type="number" placeholder="dài (mm)" name="width" id="cal_width">
                        </div>
                        <div>
                            <input type="number" placeholder="Rộng (mm)" name="cal_height">    
                        </div>
                    </div>
                    <div class="flex-row">
                        <label class="left-col">Số lượng cần in</label>
                        <div class="right-col">
                            <input type="number" placeholder="Nhập số lượng nhãn in" name="amount" id="cal_amout">
                        </div>
                    </div>
                    <div class="flex-row">
                        <label class="left-col">Công nghệ in</label>
                        <div class="right-col">
                            <select name="print_type" id="print_type">
                                <?php foreach ($print_techs as $pr) : ?>
                                    <option value="<?php echo $pr->print_id ?>"><?php echo $pr->print_name ?> </option>
                                <?php endforeach?>
                                
                            </select>
                        </div>
                    </div>
                    <div class="flex-row">
                        <label class="left-col">Chất liệu</label>
                        <div class="right-col">
                            <select name="material_type" id="material_type">
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