<!DOCTYPE html>
<html lang="en">
<body>
    <div class="content-wrapper">
        <div class="db-content-header">
            Labour
        </div>
        <div class="labour-rows">
            <div class="labour-item-row db-content">
                <div class="item-block">
                <div class="label">Staff </div>
                <select id="labour_staff" name="labour staff name" class="form-select dropdown" aria-label="Default select example">
                    <option value="staff">Select Staff</option>
                </select>
                </div>
                <div class="item-block">
                <div class="label">Position </div>
                <select disabled id="labour_position" name="labour staff position" class="form-select dropdown" aria-label="Default select example">
                    <option value="position">Select Position</option>
                </select>
                </div>
                <div class="item-block">
                <div class="label">UOM </div>
                <select disabled id="labour_uom" name="labour UOM" class="form-select dropdown" aria-label="Default select example">
                    <option value="labour uom">Select UOM</option>
                </select>
                </div>
                <div class="item-block">
                <div class="label">Reg. Rate </div>
                <input id="labour_reg_rate" class="" name="labour reg. rate" type="number" min=0 placeholder=0.00  disabled/>
                </div>
                <div class="item-block">
                <div class="label">Reg. Hours </div>
                <input id="labour_reg_hours" name="labour reg. hours" class="" type="number" min=0 placeholder=0.00 />
                </div>
                <div class="item-block">
                <div class="label">OverTime Rate </div>
                <input id="labour_ot_rate" name="labour ot rate" class="" type="number" min=0 placeholder=0.00 disabled/>
                </div>
                <div class="item-block">
                <div class="label">OverTime </div>
                <input id="labour_overtime" name="labour overtime" class="" type="number" min=0 placeholder=0.00 />
                </div>

                <div class="item-block img-block">
                    <img src="../img/plus-circle.svg" class="item-block cursor-ptr" id="labour_add"/>
                    <img src="../img/cross-circle.svg" class="item-block cursor-ptr hide-img" id="labour_remove" />
                </div>
            </div>
        </div>

        <div class="sub-total">
            <div class="label">Sub-Total </div>
            <input id="labour_subtotal" name="labour subtotal" class="col-5" type="number" min=0 placeholder=0.00 disabled/>
        </div>
    </div>

</body>
</html>