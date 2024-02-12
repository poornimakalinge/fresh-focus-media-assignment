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
    </head>
  <body>
    <div class="container">
        <?php include "../db_connections/connection.php"; ?>

        <div class="header">
            Edit Ticket
        </div>
        <form id="field_ticket_form">
            <?php include "project_container.php"; ?>
            <?php include "description_container.php"; ?>
            <?php include "labour_container.php"; ?>
            <?php include "truck_container.php"; ?>
            <?php include "miscellaneous_container.php"; ?>

            <button id="submit_field_ticket_form" class="btn float-end" disabled> FINISH</button>
            
        </form>
    </div>

    <!-- scripts added at the end that allows the HTML content to load before scripts are executed, which inturn improves page loading performance. -->
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- tinyMCE text editor -->   
    <script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-webcomponent@1/dist/tinymce-webcomponent.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/v4avxwcumpfaokkcw63uhua578mmizh6x8leafxg161d6wqv/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <!-- custom scripts added here -->
    <script src="edit_ticket.js" ></script>
  </body>
</html>