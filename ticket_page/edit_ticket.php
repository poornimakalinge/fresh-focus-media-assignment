<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="styles.css" media="all" rel="Stylesheet" type="text/css" /> 

        <title>FFM!</title>
        <?php include "../db_connections/connection.php"; ?>
    </head>
  <body>
    <div class="container">
        <div class="header">
            Edit Ticket
        </div>
      <!-- action="edit_ticket_page.php" method="post" -->
        <form id="field_ticket_form">
            <div class="content-wrapper">
            <div class="project-header">
                Project
            </div>
            <div class="container-wrapper">
                <div class="col-5">
                <div class="block">
                     <div class="label col-5">Customer Name: </div>
                    <select id="customer_name" name="customer name" class="form-select dropdown" aria-label="Default select example">
                    <option value="Customer Name">Select Customer Name</option>
                    </select>
                </div>
                <div class="block">
                     <div class="label col-5">Job Name: </div>
                    <select disabled id="job_name" name="job name" class="form-select dropdown" aria-label="Default select example">
                        <option value="Job Name">Select Job Name</option>
                    </select>
                </div>
                <div class="block">
                     <div class="label col-5">Status: </div>
                    <select id="status" name="status" class="form-select dropdown" aria-label="Default select example">
                        <option value="status">Select Status</option>
                        <?php
                            foreach ($project_status_items as $status_item) {
                                echo "<option value='$status_item'>$status_item</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="block">
                     <div class="label col-5">Location/LSD: </div>
                    <select disabled id="location_name" name="location/lsd" class="form-select dropdown" aria-label="Default select example">
                        <option value="Location/LSD">Select Location/LSD</option>
                    </select>
                </div>
                </div>

                <div class="col-5">
                <div class="block">
                     <div class="label col-5">Ordered By: </div>
                    <input class="input-block" name="ordered by" placeholder="ordered_user"/>
                </div>
                <div class="block">
                     <div for="date" class="label col-5">Date: </div>
                    <input id="date" name="date" class="form-control input-block" type="date" />
                    <span id="dateSelected"></span>
                </div>
                <div class="block">
                     <div class="label col-5">Area/Field: </div>
                    <input id="area" name="area/field" class="input-block" placeholder="area"/>
                </div>
                </div>
            </div>
            </div>
            <div class="content-wrapper">
            <div class="desc-header">
                Description of Work
            </div>
            <div class="desc-content">
                 <div class="label">Description: </div>
                <textarea id="textarea_desc" placeholder="Enter description of Work"></textarea>
            </div>
            </div>

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

                    <img src="../img/plus-circle.svg" class="item-block cursor-ptr" id="labour_add"/>
                    <img src="../img/cross-circle.svg" class="item-block cursor-ptr hide-img" id="labour_remove" />
                </div>
            </div>

            <div class="sub-total">
                 <div class="label">Sub-Total </div>
                <input id="labour_subtotal" name="labour subtotal" class="col-5" type="number" min=0 placeholder=0.00 disabled/>
            </div>
            </div>

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
                    <img src="../img/plus-circle.svg" class="item-block cursor-ptr" id="truck_add"/>
                    <img src="../img/cross-circle.svg" class="item-block cursor-ptr hide-img" id="truck_remove"/>
                </div>
            </div>

            <div class="sub-total">
                 <div class="label">Sub-Total </div>
                <input id="truck_subtotal" name="truck subtotal" class="col-5" type="number" min=0 placeholder=0.00 disabled/>
            </div>
            </div>

            <div class="content-wrapper">
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

                    <img src="../img/plus-circle.svg" class="item-block cursor-ptr" id="miscell_add"/>
                    <img src="../img/cross-circle.svg" class="item-block cursor-ptr hide-img" id="miscell_remove"/>
                </div>
            </div>

            <div class="sub-total">
                 <div class="label">Sub-Total </div>
                <input type="number" id="miscell_subtotal" name="miscell subtotal" class="col-5"  type="number" min=0 placeholder=0.00 disabled/>
            </div>

            <button id="submit_field_ticket_form" class="btn float-end"> FINISH</button>
            </div>
        </form>
    </div>

    <!-- scripts added at the end that allows the HTML content to load before scripts are executed, which inturn improves page loading performance. -->
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Bootstrap Bundle with Popper -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
    <!-- tinyMCE text editor -->   
    <script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-webcomponent@1/dist/tinymce-webcomponent.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/v4avxwcumpfaokkcw63uhua578mmizh6x8leafxg161d6wqv/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <!-- custom scripts added here -->
    <script src="edit_ticket.js" ></script>
  </body>
</html>