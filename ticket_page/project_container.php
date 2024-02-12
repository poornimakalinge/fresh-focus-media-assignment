<!DOCTYPE html>
<html lang="en">
<body>
    <div class="content-wrapper">
        <div class="project-header">
            Project
        </div>
        <div class="container-wrapper">
            <div class="col-5">
            <div class="block">
                <div class="label col-5"><span class="text-danger">*</span>Customer Name: </div>
                <select id="customer_name" name="customer name" class="form-select dropdown" aria-label="Default select example">
                <option value="Customer Name">Select Customer Name</option>
                </select>
            </div>
            <div class="block">
                <div class="label col-5"><span class="text-danger">*</span>Job Name: </div>
                <select disabled id="job_name" name="job name" class="form-select dropdown" aria-label="Default select example">
                    <option value="Job Name">Select Job Name</option>
                </select>
            </div>
            <div class="block">
                <div class="label col-5"><span class="text-danger">*</span>Status: </div>
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
                <div class="label col-5"><span class="text-danger">*</span>Location/LSD: </div>
                <select disabled id="location_name" name="location/lsd" class="form-select dropdown" aria-label="Default select example">
                    <option value="Location/LSD">Select Location/LSD</option>
                </select>
            </div>
            </div>

            <div class="col-5">
            <div class="block">
                <div class="label col-5"><span class="text-danger">*</span>Ordered By: </div>
                <input class="input-block" id="ordered_by" name="ordered by" placeholder="ordered_user"/>
            </div>
            <div class="block">
                <div for="date" class="label col-5"><span class="text-danger">*</span>Date: </div>
                <input id="date" name="date" class="form-control input-block" type="date" />
                <span id="dateSelected"></span>
            </div>
            <div class="block">
                <div class="label col-5"><span class="text-danger">*</span>Area/Field: </div>
                <input id="area_field" name="area/field" class="input-block" placeholder="area"/>
            </div>
            <div class="block" id="error_text">
                <div class="label col-5 text-danger">Make sure to enter all project details </div>
            </div>
            </div>
        </div>
    </div>
</body>
</html>