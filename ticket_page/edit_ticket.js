$(document).ready(function()
{
    initializeDataOnPageLoad();
    
    // Event listeners on dropdown value changes
    $('#customer_name').change(handleCustomerDropDownChange);
    $('#job_name').change(handleJobDropDownChange);
    $(document).on('change', '#labour_staff', handleStaffDropDownChange);
    $(document).on('change', '#labour_position', handlePositionDropDownChange);
    $(document).on('change', '#labour_uom', handleLabourUOMDropDownChange);
    $(document).on('change', '#truck_label', handleTruckLabelDropDownChange);
    $(document).on('change', '#truck_uom', handleTruckUOMDropDownChange);

    // Event listeners for  Adding/Removing rows
    $(document).on('click', '#labour_add', addLabourRow);
    $(document).on('click', '#labour_remove', removeLabourRow);
    $(document).on('click', '#truck_add', addTruckRow);
    $(document).on('click', '#truck_remove', removeTruckRow);
    $(document).on('click', '#miscell_add', addMiscellRow);
    $(document).on('click', '#miscell_remove', removeMiscellRow);

    // Event listener for inputs changes
    $(document).on('change', '#labour_reg_hours, #labour_overtime', calculateLabourSubtotal);
    // Event listener for truck Quantity
    $(document).on('change', '#truck_qty', calculateTruckSubtotal);
    // Event listener for reg hours and overtime inputs changes
    $(document).on('change', '#miscell_cost, #miscell_price, #miscell_qty', calculateMiscellSubtotal);

    // Initially should be 0.00 when the page loads since inputs are empty
    calculateLabourSubtotal();
    calculateTruckSubtotal();
    calculateMiscellSubtotal();

    // on click of 'FINISH' button insert data into field_ticket_details table.
    $('#submit_field_ticket_form').click(submitFieldTicketForm);

    // Call checkFields function on project inputs change
    $('#customer_name, #job_name, #status, #location_name, #ordered_by, #date, #area_field').on('input', function() {
        checkFields();
    });
});

function initializeDataOnPageLoad() {
    // Set the value of the date input field to the current date on page load
    $('#date').val(getCurrentDate());
    // Initialize TinyMCE textarea
    tinymce.init({
        selector: '#textarea_desc'
    });
    getCustomers();     //To poulate customer names
    getStaff();         //To poulate Staff 
    getTrucks();        //To poulate Truck labels
}

function getCurrentDate() {
    var now = new Date();
    var year = now.getFullYear();
    var month = (now.getMonth() + 1).toString().padStart(2, '0'); // Month starts from 0
    var day = now.getDate().toString().padStart(2, '0');
    return year + '-' + month + '-' + day;
}

function getCustomers() {
    $.ajax({
        type: "GET",
        url: "../../db_connections/project/get_customers.php", // PHP script to fetch customers
        success:function(html){
            $('#customer_name').html(html);
        },
        error: function(xhr, status, error) {
            console.error("Error fetching customers:", error);
        }
    });
}

function getStaff() {
    $.ajax({
        type: "GET",
        url: "../../db_connections/labours/get_staff.php", // PHP script to fetch staff
        success:function(html){
            $('#labour_staff').html(html);
        },
        error: function(xhr, status, error) {
            console.error("Error fetching staff:", error);
        }
    });
}

function getTrucks() {
    $.ajax({
        type: "GET",
        url: "../../db_connections/trucks/get_trucks.php", // PHP script to fetch trucks
        success:function(html){
            $('#truck_label').html(html);
        },
        error: function(xhr, status, error) {
            console.error("Error fetching trucks:", error);
        }
    });
}

function handleCustomerDropDownChange() {
    var customer_id = $(this).find('option:selected').attr('id');
    if(customer_id){
    $.ajax({
        type:'POST',
        url:'../../db_connections/project/get_jobs.php', // PHP script to fetch jobs based on customer_id
        data:{customer_id: customer_id},
        success:function(html){
        $('#job_name').html(html).prop('disabled', false);
        $('#location_name').html('<option value="Location/LSD">Select Location/LSD</option>').prop('disabled', true);
        }
    });
    }
    else{
    $('#job_name').html('<option value="">Select Job Name</option>').prop('disabled', true);
    $('#location_name').html('<option value="Location/LSD">Select Location/LSD</option>').prop('disabled', true);
    }
}

function handleJobDropDownChange() {
    var job_id = $(this).find('option:selected').attr('id');
    if(job_id){
    $.ajax({
        type:'POST',
        url:'../../db_connections/project/get_locations.php', // PHP script to fetch locations based on job_id
        data:{job_id: job_id},
        success:function(html){
        $('#location_name').html(html).prop('disabled', false);
        }
    });
    }
    else{
    $('#location_name').html('<option value="Location/LSD">Select Location/LSD</option>').prop('disabled', true);
    }
}

function handleStaffDropDownChange() {
    var $parentRow = $(this).closest('.labour-item-row');
    clearLablourRates($parentRow);
    var staff_id = $(this).find('option:selected').attr('id');
    if(staff_id){
        $.ajax({
        type:'POST',
        url:'../../db_connections/labours/get_positions.php', // PHP script to fetch positions based on staff_id
        data:{staff_id: staff_id},
        success:function(html){
            $parentRow.find('#labour_position').html(html).prop('disabled', false);
        }
        });
    }
    else{
        $parentRow.find('#labour_position').html('<option value="position">Select Position</option>').prop('disabled', true);
    }
}

function handlePositionDropDownChange() {
    var $parentRow = $(this).closest('.labour-item-row');
    clearLablourRates($parentRow);
    var pos_id = $(this).find('option:selected').attr('id');
    if(pos_id){
        $.ajax({
        type:'POST',
        url:'../../db_connections/labours/get_labour_uom.php', // PHP script to fetch UOM based on pos_id
        data:{pos_id: pos_id},
        success:function(html){
            $parentRow.find('#labour_uom').html(html).prop('disabled', false);
        }
        });
    }
}

function handleLabourUOMDropDownChange() {
    var $parentRow = $(this).closest('.labour-item-row');
    var uom_id = $(this).find('option:selected').attr('id');
    if(uom_id){
        $.ajax({
            type: 'POST',
            url: '../../db_connections/labours/get_staff_rates.php', // PHP script to fetch reg & overtime rates
            data:{uom_id: uom_id},
            success: function(response) {
                if (response.error) {
                    console.log('Element not found');
                } else {
                   const element = JSON.parse(response);
                   const {reg_rate, ot_rate} = element[0];
                    $parentRow.find('#labour_reg_rate').val(reg_rate);
                    $parentRow.find('#labour_ot_rate').val(ot_rate);
                }
                calculateLabourSubtotal();
            },
            error: function(xhr, status, error) {
                $parentRow.find('#labour_reg_rate').val(0.00);
                $parentRow.find('#labour_ot_rate').val(0.00);
                // Handle errors here
                console.error(error);
                calculateLabourSubtotal();
            }
        })
    }
    else {
        $parentRow.find('#labour_reg_rate').val(0.00);
        $parentRow.find('#labour_ot_rate').val(0.00);
        calculateLabourSubtotal();
    }
}

function handleTruckLabelDropDownChange() {
    var $parentRow = $(this).closest('.truck-item-row');
    clearTruckRates($parentRow);
    var truck_id = $(this).find('option:selected').attr('id');
    if(truck_id){
        $.ajax({
            type:'POST',
            url:'../../db_connections/trucks/get_truck_uom.php', // PHP script to fetch jobs based on truck_id
            data:{truck_id: truck_id},
            success:function(html){
                $parentRow.find('#truck_uom').html(html).prop('disabled', false);
            }
        });
    }
    else{
        $parentRow.find('#truck_uom').html('<option value="truck uom">Select UOM</option>').prop('disabled', true);
    }
}

function handleTruckUOMDropDownChange() {
    var $parentRow = $(this).closest('.truck-item-row');
    var uom_id = $(this).find('option:selected').attr('id');
    if(uom_id){
        $.ajax({
            type: 'POST',
            url: '../../db_connections/trucks/get_truck_rates.php', // PHP script to fetch truck rate
            data:{uom_id: uom_id},
            success: function(response) {
                if (response.error) {
                    console.log('Element not found');
                } else {
                   const element = JSON.parse(response);
                   const {truck_rate} = element[0];
                    $parentRow.find('#truck_rate').val(truck_rate);
                }
                calculateTruckSubtotal();
            },
            error: function(xhr, status, error) {
                $parentRow.find('#truck_rate').val(0.00);
                // Handle errors here through popup
                console.error(error);
                calculateTruckSubtotal();
            }
        })
    }
    else {
        $parentRow.find('#truck_rate').val(0.00);
        calculateTruckSubtotal();
    }
}

function addLabourRow() {
    var $clone = $(this).closest('.labour-item-row').clone();
    $clone.find('select, input').val(''); // Reset select options
     // Disable position and UOM
    $clone.find('#labour_position').prop('disabled', true).html('<option value="">Select Position</option>');
    $clone.find('#labour_uom').prop('disabled', true).html('<option value="">Select UOM</option>');
    // $clone.find('#labour_position, #labour_uom').prop('disabled', true); // Disable position and UOM
    $clone.find('#labour_remove').removeClass('hide-img'); // Remove the hide-img class
    $(this).closest('.labour-item-row').after($clone);
}

function removeLabourRow() {
    $(this).closest('.labour-item-row').remove();
}

function addTruckRow() {
    var $clone = $(this).closest('.truck-item-row').clone();
    $clone.find('select, input').val(''); // Reset select options
     // Disable position and UOM
    $clone.find('#truck_uom').prop('disabled', true).html('<option value="">Select UOM</option>');
    $clone.find('#truck_remove').removeClass('hide-img'); // Remove the hide-img class
    $(this).closest('.truck-item-row').after($clone);
}

function removeTruckRow() {
    $(this).closest('.truck-item-row').remove();    
}

function addMiscellRow() {
    var $clone = $(this).closest('.miscell-item-row').clone();
    $clone.find('input').val(''); // Reset select options
     // Disable position and UOM
    $clone.find('#miscell_remove').removeClass('hide-img'); // Remove the hide-img class
    $(this).closest('.miscell-item-row').after($clone);
}

function removeMiscellRow() {
    $(this).closest('.miscell-item-row').remove();
}

function submitFieldTicketForm() {
    // Serialize form data to get all the fields data
    var form_details = $('#field_ticket_form').serialize();
    var modified_details = deserializeFormDetails(form_details);
    //since form_details already contains these inputs of multiple rows which we're organizing in array format, hence remove those rows data from form_details.
    $('.labour-item-row :input').each(function() {
        var row_input_name = $(this).attr('name');
        // Escape spaces in the input name
        // Replace the matched key-value pair with an empty string
        delete modified_details[row_input_name];
    });
    $('.truck-item-row :input').each(function() {
        var row_input_name = $(this).attr('name');
        delete modified_details[row_input_name];
    });
    $('.miscell-item-row :input').each(function() {
        var row_input_name = $(this).attr('name');
        delete modified_details[row_input_name];
    });

    $('.sub-total :input:disabled').each(function() {
        modified_details[$(this).attr('name')] = $(this).val();
    });

    var labours_data = [];
    $('.labour-item-row').each(function(index, element) {
        // since form submission ignores disabled inputs hence explicitely added those inputs here
        var serialized_rows = $(this).find(':input').serialize(); 
        // Select disabled inputs and append their values to the serialized data
        $(this).find(':input:disabled').each(function() {
            serialized_rows += '&' + $(this).attr('name') + '=' + ($(this).val());
        });

        var obj = {};
        serialized_rows.split('&').forEach(function(item) {
            var parts = item.split('=');
            obj[decodeURIComponent(parts[0])] = decodeURIComponent(parts[1]);
        });
        labours_data.push(obj);
    });

    var trucks_data = [];
    $('.truck-item-row').each(function(index, element) {
        var serialized_rows = $(this).find(':input').serialize();
        $(this).find(':input:disabled').each(function() {
            serialized_rows += '&' + $(this).attr('name') + '=' + ($(this).val());
        });
        var obj = {};
        serialized_rows.split('&').forEach(function(item) {
            var parts = item.split('=');
            obj[decodeURIComponent(parts[0])] = decodeURIComponent(parts[1]);
        });
        trucks_data.push(obj);
    });

    var miscellaneous_data = [];
    $('.miscell-item-row').each(function(index, element) {
        var serialized_rows = $(this).find(':input').serialize(); 
        // Select disabled inputs and append their values to the serialized data
        $(this).find(':input:disabled').each(function() {
            serialized_rows += '&' + $(this).attr('name') + '=' + ($(this).val());
        });
        var obj = {};
        serialized_rows.split('&').forEach(function(item) {
            var parts = item.split('=');
            obj[decodeURIComponent(parts[0])] = decodeURIComponent(parts[1]);
        });
        miscellaneous_data.push(obj);
    });
    
    modified_details['labours_data']= JSON.stringify(labours_data);
    modified_details['trucks_data']= JSON.stringify(trucks_data);
    modified_details['miscellaneous_data'] = JSON.stringify(miscellaneous_data);

    // Get TinyMCE editor instance
    var editor = tinymce.get('textarea_desc');
    // Get editor content
    var content = editor.getContent({format : 'text'});
    
    // Add content to the form details
    modified_details = {...modified_details, description: content}
    var serialized_details = $.param(modified_details);

    $.ajax({
        type: 'POST',
        url: '../db_connections/operations.php', // PHP script to handle the insertion
        data: serialized_details,
        success: function(response) {
            debugger
            alert('Invoice generated!');
        },
        error: function(xhr, status, error) {
            console.error(error);
            alert('An error occurred while saving field ticket details.');
        }
    });
}

function deserializeFormDetails(serializedString) {
    var formData = {};
    var pairs = serializedString.split('&');

    pairs.forEach(function(pair) {
        var keyValue = pair.split('=');
        var key = decodeURIComponent(keyValue[0]);
        var value = decodeURIComponent(keyValue[1]);
        formData[key] = value;
    });

    return formData;
}

// This function calculates the subtotal whenever there is a change in the #labour_reg_hours or #labour_overtime inputs for any row. 
// It iterates over all the rows of labours block, gets the values of the relevant inputs, and calculates the subtotal for each row. 
// Then updates the #labour_subtotal input with the total sum of all subtotals.

function calculateLabourSubtotal() {
    var labour_total = 0;
    $('.labour-item-row').each(function() {
        var reg_rate = parseFloat($(this).find('#labour_reg_rate').val()) || 0.00;
        var reg_hours = parseFloat($(this).find('#labour_reg_hours').val()) || 0.00;
        var ot_rate = parseFloat($(this).find('#labour_ot_rate').val()) || 0.00;
        var ot_hours = parseFloat($(this).find('#labour_overtime').val()) || 0.00;
        var sub_total = (reg_rate * reg_hours) + (ot_rate * ot_hours);
        labour_total += sub_total;
    });
    $('#labour_subtotal').val(labour_total.toFixed(2));
}

// similarly for #truck_qty input changes, calculate #truck_total & #truck_subtotal input values

function calculateTruckSubtotal() {
    var truck_total = 0;
    $('.truck-item-row').each(function() {
        var truck_qty = parseFloat($(this).find('#truck_qty').val()) || 0.00;
        var truck_rate = parseFloat($(this).find('#truck_rate').val()) || 0.00;
        var sub_total = (truck_qty * truck_rate);
        $(this).find('#truck_total').val(sub_total.toFixed(2));
        truck_total += sub_total;
    });
    $('#truck_subtotal').val(truck_total.toFixed(2));
}

// similarly for #miscell_cost, #miscell_price & #miscell_qty input changes, calculate #miscell_total & #miscell_subtotal input values

function calculateMiscellSubtotal() {
    var miscell_total = 0;
    $('.miscell-item-row').each(function() {
        var miscell_cost = parseFloat($(this).find('#miscell_cost').val()) || 0.00;
        var miscell_price = parseFloat($(this).find('#miscell_price').val()) || 0.00;
        var miscell_qty = parseFloat($(this).find('#miscell_qty').val()) || 0.00;
        //to represent profit/loss, cost is subtracted from price here a/c my understanding
        var sub_total = ((miscell_price - miscell_cost) * miscell_qty);
        $(this).find('#miscell_total').val(sub_total.toFixed(2));
        miscell_total += sub_total;
    });
    $('#miscell_subtotal').val(miscell_total.toFixed(2));
}

function clearLablourRates($parentRow) {
    $parentRow.find('#labour_uom').html('<option value="labour uom">Select UOM</option>').prop('disabled', true);
    $parentRow.find('#labour_reg_rate, #labour_ot_rate').val('');
    calculateLabourSubtotal(); // Recalculate subtotal after clearing rates
}

function clearTruckRates($parentRow) {
    $parentRow.find('#truck_uom').html('<option value="truck uom">Select UOM</option>').prop('disabled', true);
    $parentRow.find('#truck_rate').val('');
    calculateTruckSubtotal(); // Recalculate subtotal after clearing rates
}

function checkFields() {
    var customerName = $('#customer_name').val();
    var jobName = $('#job_name').val();
    var status = $('#status').val();
    var locationName = $('#location_name').val();
    var orderedBy = $('#ordered_by').val();
    var date = $('#date').val();
    var areaField = $('#area_field').val();

    if (customerName && jobName && status && locationName && orderedBy && date && areaField) {
        $('#submit_field_ticket_form').prop('disabled', false); // Enable the submit button
        $('#error_text').hide(); // Hide the conditional text
    } else {
        $('#submit_field_ticket_form').prop('disabled', true); // Disable the submit button
        $('#error_text').show(); // Show the conditional text
    }
}