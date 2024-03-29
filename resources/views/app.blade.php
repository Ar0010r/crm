<!DOCTYPE html>

<html lang="en" >

<head>
    <title>HiringTools</title>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1">
    <meta name="description" content="">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <link rel="icon" type="image/x-icon" href="idea.png">

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900"
          rel="stylesheet">

    <!-- Icon fonts -->
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome.css">
    <link rel="stylesheet" href="assets/vendor/fonts/ionicons.css">
    <link rel="stylesheet" href="assets/vendor/fonts/linearicons.css">
    <link rel="stylesheet" href="assets/vendor/fonts/open-iconic.css">
    <link rel="stylesheet" href="assets/vendor/fonts/pe-icon-7-stroke.css">
    <link rel="stylesheet" href="assets/vendor/libs/growl/growl.css">

    <!-- Core stylesheets -->
    <link rel="stylesheet" href="assets/vendor/css/rtl/bootstrap.css" class="theme-settings-bootstrap-css">
    <link rel="stylesheet" href="assets/vendor/css/rtl/appwork.css" class="theme-settings-appwork-css">
    <link rel="stylesheet" href="assets/vendor/css/rtl/theme-corporate.css" class="theme-settings-theme-css">
    <link rel="stylesheet" href="assets/vendor/css/rtl/colors.css" class="theme-settings-colors-css">
    <link rel="stylesheet" href="assets/vendor/css/rtl/uikit.css">
    <link rel="stylesheet" href="assets/vendor/libs/bootstrap-select/bootstrap-select.css">
    <link rel="stylesheet" href="assets/vendor/libs/select2/select2.css">
    <link rel="stylesheet" href="assets/vendor/libs/bootstrap-tagsinput/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="assets/vendor/libs/sweetalert2/sweetalert2.css">
    <link rel="stylesheet" href="assets/css/demo.css">


    <!-- Load polyfills -->
    <script src="assets/vendor/js/polyfills.js"></script>
    <script>document['documentMode'] === 10 && document.write('<script src="https://polyfill.io/v3/polyfill.min.js?features=Intl.~locale.en"><\/script>')</script>

    <script src="assets/vendor/js/material-ripple.js"></script>
    <script src="assets/vendor/js/layout-helpers.js"></script>

    <!-- Theme settings -->
    <!-- This file MUST be included after core stylesheets and layout-helpers.js in the <head> section -->
    <script src="assets/vendor/js/theme-settings.js"></script>
    {{--<script>
        window.themeSettings = new ThemeSettings({
            cssPath: 'assets/vendor/css/rtl/',
            themesPath: 'assets/vendor/css/rtl/'
        });
    </script>--}}

    <!-- Core scripts -->
    <script src="assets/vendor/js/pace.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css">

    <!-- Libs -->
    <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css">
    <!-- Page -->
    <link rel="stylesheet" href="assets/vendor/css/pages/authentication.css">

    <link rel="stylesheet" href="assets/vendor/libs/dropzone/dropzone.css">
    <link rel="stylesheet" href="assets/vendor/libs/flow-js/flow.css">
    <link rel="stylesheet" href="assets/vendor/libs/datatables/datatables.css">
</head>

<body class="light-style" style="background-color: #f5f5f5!important;">
<div class="page-loader">
    <div class="bg-primary"></div>
</div>

<div id="app" style="background-color: #f5f5f5!important;" ></div>

<script src="{{asset('js/app.js')}}"></script>
<script src="assets/vendor/libs/popper/popper.js"></script>
<script src="assets/vendor/js/bootstrap.js"></script>
<script src="assets/vendor/js/sidenav.js"></script>

<!-- Libs -->
<script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
{{--<script src="assets/vendor/libs/dropzone/dropzone.js"></script>
<script src="assets/vendor/libs/flow-js/flow.js"></script>--}}

<script src="assets/vendor/libs/bootstrap-select/bootstrap-select.js"></script>
{{--<script src="assets/vendor/libs/select2/select2.js"></script>--}}
<script src="assets/vendor/libs/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>

<!-- Demo -->
<script src="assets/vendor/libs/growl/growl.js"></script>
<script src="assets/js/ui_notifications.js"></script>
<script src="assets/vendor/libs/datatables/datatables.js"></script>
{{--<script src="assets/js/forms_selects.js"></script>--}}

<!-- Demo -->
<script src="assets/js/demo.js"></script>
<script src="assets/js/tables_datatables.js"></script>


</body>
