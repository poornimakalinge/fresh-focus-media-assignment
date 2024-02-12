<!DOCTYPE html>
<html lang="en">
<body>
    <div class="content-wrapper br-none">
        <div class="miscell-header">
            Miscellaneous
        </div>

        <div class="miscell-rows">
            <div class="miscell-item-row db-content">

                <div class="item-block">
                    <div class="label">Descritpion </div>
                    <input id="miscell_desc" name="miscell desc" class="" value="miscell_desc" />
                </div>
                <div class="item-block">
                    <div class="label">Cost </div>
                    <input id="miscell_cost" name="miscell cost" type="number" class="" min=0 placeholder=0.00 />
                </div>
                <div class="item-block">
                    <div class="label">Price </div>
                    <input id="miscell_price" name="miscell price" class=""  type="number" min=0 placeholder=0.00 />
                </div>
                <div class="item-block">
                    <div class="label">Quantity </div>
                    <input id="miscell_qty" name="miscell qty" class=""  type="number" min=0 placeholder=0.00 />
                </div>
                <div class="item-block">
                    <div class="label">Total </div>
                    <input id="miscell_total" name="miscell total" class=""  type="number" min=0 placeholder=0.00 disabled/>
                </div>
                <div class="item-block img-block">
                    <img src="../img/plus-circle.svg" class="cursor-ptr" id="miscell_add"/>
                    <img src="../img/cross-circle.svg" class="cursor-ptr hide-img" id="miscell_remove"/>
                </div>
            </div>
        </div>

        <div class="sub-total">
            <div class="label">Sub-Total </div>
            <input type="number" id="miscell_subtotal" name="miscell subtotal" class="col-5"  type="number" min=0 placeholder=0.00 disabled/>
        </div>

    </div>
</body>
</html>