<!DOCTYPE html>
<html lang="en" data-ng-app="PPO">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--<link rel="shortcut icon" href="/app/client/images/favicon.ico">-->


        <title>Admin Panel</title>

        <!--Bootstrap CSS-->
        <link href="app/bs3/css/bootstrap.min.css" rel="stylesheet">

        <!--Font-awesome CSS-->
        <link href="app/font-awesome/css/font-awesome.css" rel="stylesheet">

        <!--Ui-Block CSS-->
        <link href="app/bower_components/angular-block-ui/dist/angular-block-ui.min.css" rel="stylesheet">

        <!--click-to-edit or edit-in-place-->
        <link href="app/bower_components/angular-xeditable/dist/css/xeditable.css" rel="stylesheet">

        <!--Core CSS -->
        <link href="app/css/style.css" rel="stylesheet">
        <link href="app/css/style-responsive.css" rel="stylesheet"/>

        <!--Css for notification-->
        <link href="app/css/ns-default.css" rel="stylesheet"/>
        <link href="app/css/ns-style-attached.css" rel="stylesheet"/>


    </head>
    <body ng-controller="AppCtrl">
        <section id="container" ui-view=""></section>

        <!--Core js-->
        <script src="app/js/jquery.js"></script>
        <script src="app/js/jquery-ui/jquery-ui-1.10.1.custom.min.js"></script>
        <script src="app/bs3/js/bootstrap.min.js"></script>

        <script src="app/js/jquery.scrollTo.min.js"></script>
        <script src="app/js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js"></script>
        <script src="app/js/jquery.nicescroll.js"></script>

        <script src="app/js/jquery.scrollTo/jquery.scrollTo.js"></script>
        <script src="app/js/jquery.easing.min.js"></script>
        <script src="app/js/underscore-min.js"></script>

        <script src="app/js/jquery.dcjqaccordion.2.7.js"></script>

        <!--common script init for all pages-->
        <script src="app/js/scripts.js"></script>

        <!-- Notification Js -->
        <script src="app/js/modernizr.custom.js"></script>
        <script src="app/js/classie.js"></script>
        <script src="app/js/notificationFx.js"></script>

        <!-- Angular Libraries -->
        <script src="app/bower_components/angular/angular.min.js"></script>

        <!-- Angular Route -->
        <script src="app/bower_components/angular-ui-router/release/angular-ui-router.min.js"></script>

        <!-- Angular ui bootstrap-->
        <script src="app/bower_components/angular-bootstrap/ui-bootstrap.min.js"></script>
        <script src="app/bower_components/angular-bootstrap/ui-bootstrap-tpls.min.js"></script>

        <!--MomentJs for Time-->
        <script src="app/bower_components/moment/min/moment.min.js"></script>

        <!--Ui-Block CSS-->
        <script src="app/bower_components/angular-block-ui/dist/angular-block-ui.min.js"></script>

        <!--click-to-edit or edit-in-place-->
        <script src="app/bower_components/angular-xeditable/dist/js/xeditable.min.js"></script>

        <!--Angular Image Upload in Base64 Directive-->
        <script src="app/js/imageupload.js"></script>

        <!-- Page level Js (Angular Js Controller, Directive, Constant etc) -->
        <script src="app/js/directive.js"></script>
        <script src="app/js/filter.js"></script>
        <script src="app/js/constants.js"></script>
        <script src="app/partials/app.js"></script>

        <!--Dashboard Js-->
        <script src="app/partials/dashboard/dashboard.js"></script>

        <!--Member Js-->
        <script src="app/partials/users/user.js"></script>


    </body>

</html>