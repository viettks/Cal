<div>
<div>
    <h5> Tên tờ rơi</h5>
<div>
<div>
    <form>
        <div>
            <div class="inline"><input type="radio" name="leaf_type" value="A5" id="type_a5" checked><label for="type_a5">A5</label></div>
            <div class="inline"><input type="radio" name="leaf_type" value="A4" id="type_a4"><label for="type_a4">A4</label></div>
            <div class="inline"><input type="radio" name="leaf_type" value="A3" id="type_a3"><label for="type_a3">A3</label></div>
        </div>
        <div>
            <div  class="inline">Chất liệu giấy</div>
            <div class="inline">
                <select name="leaf_material" id="leaf_material">
                    <option value="C100">C100</option>
                    <option value="C150">C150</option>
                    <option value="C200">C200</option>
                </select>
            </div>
        </div>
        <div>
            <div class="inline">Số lượng</div>
            <div class="inline">
                <select name="leaf_amount" id="leaf_amount">
                    <option value="C100">C100</option>
                    <option value="C150">C150</option>
                    <option value="C200">C200</option>
                </select>
            </div>
        </div>
        <div>
            <div class="inline">Gia công</div>
           <div  class="inline">
            <select name="leaf_membran" id="leaf_material">
                    <option value="00">Không cán màng</option>
                    <option value="01">Cán màng bóng</option>
                    <option value="02">Cán màng mờ</option>
                </select>
            </div>
        </div>
        <div>
            <div class="inline">Thời gian in</div>
            <div class="inline">
                <div class="inline"><input type="radio" name="leaf_time" value="05" id="type_a5" checked><label for="type_a5">Lấy ngay (tăng 5% phí)</label></div>
                <div class="inline"><input type="radio" name="leaf_time" value="05" id="type_a4"><label for="type_a4">Sau 2-3 ngày (Giảm 5%)</label></div>
                <div class="inline"><input type="radio" name="leaf_time" value="05" id="type_a3"><label for="type_a3">Sau 1 tuần (Giảm 10%)</label></div>
            </div>
        </div>

    </form>
</div>
</div>
<style>
.inline{
    display: inline-block;
}   
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
     var data = <?php echo json_encode($leaflets); ?>;
     $( document ).ready(function() {
        $("#radio_1").prop("checked", true);
        $( data ).each(function(index, item) {
    
        );

    });
</script>
