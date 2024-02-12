<!DOCTYPE html>
<html lang="en">
<body>
    <div class="content-wrapper">
        <div class="db-content-header">
            Truck
        </div>
        <div class="truck-rows">
            <div class="truck-item-row db-content">
                <div class="item-block">
                <div class="label">Label </div>
                <select id="truck_label" name="truck label" class="form-select dropdown" aria-label="Default select example">
                    <option value="label">Select Truck</option>
                </select>
                </div>
                <div class="item-block">
                <div class="label">Qty </div>
                <input type="number" min=0 id="truck_qty" name="truck qty" class="" placeholder=0 />
                </div>
                <div class="item-block">
                <div class="label">UOM </div>
                <select disabled id="truck_uom" name="truck uom" class="form-select dropdown" aria-label="Default select example">
                    <option value="truck uom">Select UOM</option>
                </select>
                </div>
                <div class="item-block">
                <div class="label">Rate ($) </div>
                <input id="truck_rate" name="truck rate" class="" type="number" min=0 placeholder=0.00 disabled/>
                </div>
                <div class="item-block">
                <div class="label">Total </div>
                <input id="truck_total" name="truck total" class="" type="number" min=0 placeholder=0.00 disabled/>
                </div>
                <div class="item-block img-block">
                    <img src="../img/plus-circle.svg" class="item-block cursor-ptr" id="truck_add"/>
                    <img src="../img/cross-circle.svg" class="item-block cursor-ptr hide-img" id="truck_remove"/>
                </div>
            </div>
        </div>

        <div class="sub-total">
            <div class="label">Sub-Total </div>
            <input id="truck_subtotal" name="truck subtotal" class="col-5" type="number" min=0 placeholder=0.00 disabled/>
        </div>
    </div>
</body>
</html>