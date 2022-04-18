<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1, user-scalable=no">
    <title><?= "Sobat Daging " ?></title>

    <!-- Meta Tags - Description for Search Engine purposes -->
    <meta name="description" content="Cloudify - Web Hosting HTML Template">
    <meta name="keywords" content="one page, multipage, domain, hosting, server, cloud, cloudify, html5 template">
    <meta name="author" content="GnoDesign">

    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->

    <link href="<?= base_url() ?>/assets/auth/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?= base_url() ?>/assets/auth/css/bootstrap-datepicker.css" rel="stylesheet" />
    <link href="<?= base_url() ?>/assets/auth/css/styles.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/auth/css/bootstrap-datepicker.css" />

    <!--
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css"> -->


    <script src="<?= base_url() ?>/assets/client/js/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="<?= base_url() ?>/assets/auth/js/autoNumeric.js"></script>

    <!--
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script> -->

    <style>
        .bg-sobat {
            background-color: #B89874;
        }

        #mainNav .navbar-nav li.nav-item a.nav-link:hover {
            color: #B89874;
        }

        .page-link {
            position: relative;
            /*display: block;*/
            /*color: #0d6efd;*/
            text-decoration: none;
            background-color: transparent;
            border: none;
            /* border: 1px solid #dee2e6; */
            transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            padding: 5px;
            color: white;
        }

        .page-item.active .page-link {
            z-index: 3;
            color: #B89874;
            background-color: transparent;
        }

        .page-link:hover {
            z-index: 2;
            color: #0a58ca;
            /*background-color: #e9ecef; */
            background-color: none;
            border-color: #dee2e6;
        }

        .form-control {
            display: block;
            width: 100%;
            padding: .375rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: white;
            background-color: transparent;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 0;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            border-top: none;
            border-left: none;
            border-right: none;
            border-bottom: none;
            margin-top: -10px;
        }

        .form-control:focus {
            background-color: transparent;
            box-shadow: none;
            color: white;
            border-color: white;
            outline: 0;

        }

        .form-control-label {
            display: block;
            width: 100%;
            padding: .375rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: white;
            background-color: transparent;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 0;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            border-top: none;
            border-left: none;
            border-right: none;
            margin-top: -5px;
        }

        .form-control-label:focus {
            background-color: transparent;
            box-shadow: none;
            color: white;
            border-color: white;
            outline: 0;

        }

        .form-control-paging {
            display: block;
            width: 70%;
            padding: .375rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: white;
            background-color: transparent;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 0;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            margin-top: 0px;
            border-right: none;
        }

        .form-control-paging:focus {
            background-color: transparent;
            box-shadow: none;
            color: white;
            border-color: white;
            outline: 0;

        }

        .form-control-paging-date {
            display: block;
            width: 70%;
            padding: .375rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: white;
            background-color: transparent;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 0;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            margin-top: 0px;
        }

        .form-control-paging-date:focus {
            background-color: transparent;
            box-shadow: none;
            color: white;
            border-color: white;
            outline: 0;

        }

        .form-control-button {
            display: block;
            width: 100%;
            padding: .375rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: black;
            background-color: white;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        .table tr {
            text-align: center;
        }

        .table-left tr {
            text-align: left;
        }

        .table {
            border-width: 1px;
            border-style: solid;
            border-color: white;
        }

        select {
            background-color: transparent;
            color: black;
            background: transparent;
        }

        option {
            background-color: transparent;
            background: transparent;
            color: black;
        }

        #mainNav .navbar-nav li.nav-item a.nav-link:hover {
            color: white;
        }

        .form-search {
            display: block;
            width: 100%;
            padding: .375rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: white;
            background-color: transparent;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 0;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        .form-search:focus {
            background-color: transparent;
            box-shadow: none;
            color: white;
            border-color: white;
            outline: 0;

        }

        /*
        .datepicker {
            padding: 18px;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
            direction: ltr;
            /*background-color: transparent;
            color: white; */
        /*background-color: transparent;
            color: white;

        } */

        /*
        .datepicker table tr td.day:hover,
        .datepicker table tr td.day.focused {
            background: #B89874;
            cursor: pointer;
        }

        .datepicker table tr td.active:hover,
        .datepicker table tr td.active:hover:hover,
        .datepicker table tr td.active.disabled:hover,
        .datepicker table tr td.active.disabled:hover:hover,
        .datepicker table tr td.active:active,
        .datepicker table tr td.active:hover:active,
        .datepicker table tr td.active.disabled:active,
        .datepicker table tr td.active.disabled:hover:active,
        .datepicker table tr td.active.active,
        .datepicker table tr td.active:hover.active,
        .datepicker table tr td.active.disabled.active,
        .datepicker table tr td.active.disabled:hover.active,
        .datepicker table tr td.active.disabled,
        .datepicker table tr td.active:hover.disabled,
        .datepicker table tr td.active.disabled.disabled,
        .datepicker table tr td.active.disabled:hover.disabled,
        .datepicker table tr td.active[disabled],
        .datepicker table tr td.active:hover[disabled],
        .datepicker table tr td.active.disabled[disabled],
        .datepicker table tr td.active.disabled:hover[disabled] {
            background: #B89874;
        }
        */

        .table-detail {
            border-width: 1px;
            border-style: solid;
            border-color: white;
            border-top: none;
            border-left: none;
            border-right: none;
        }

        .button-action {
            background-color: transparent;
            color: white;
        }


        ul .pagination li .page-link:hover {
            z-index: 2;
            color: #0a58ca;
            /*background-color: #e9ecef; */
            background-color: none;
            border-color: #dee2e6;
        }

        .dataTables_filter {
            display: block;
            width: 100%;
            padding: .375rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: white;
            background-color: transparent;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 0;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            border-top: none;
            border-left: none;
            border-right: none;
            margin-top: -10px;
        }

        /*

        .datepicker table tr td span.active,
        .datepicker table tr td span.active:hover,
        .datepicker table tr td span.active.disabled,
        .datepicker table tr td span.active.disabled:hover {
            background-color: #B89874;
            background-image: -moz-linear-gradient(to bottom, #08c, #0044cc);
            background-image: -ms-linear-gradient(to bottom, #08c, #0044cc);
            background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#08c), to(#0044cc));
            background-image: -webkit-linear-gradient(to bottom, #08c, #0044cc);
            background-image: -o-linear-gradient(to bottom, #08c, #0044cc);
            background-image: linear-gradient(to bottom, #08c, #0044cc);
            background-repeat: repeat-x;
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#08c', endColorstr='#0044cc', GradientType=0);
            border-color: #0044cc #0044cc #002a80;
            border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
            filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
            color: #fff;
            text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
        }
        */

        .button-active {
            background-color: #B89874;
            color: white;

        }
        .btn-sobat-md {
            background-color: transparent;
            color: white;
            text-decoration: none;
        }

        .btn-sobat-md:hover {
            background-color: transparent;
            color: #B89874;
            text-decoration: none;
        }

        .btn-payment-md {
            background-color: transparent;
            color: white;
            text-decoration: none;
            border-color:white;
        }

        .btn-payment-md:hover {
            background-color: #B89874;
            color: white;
            text-decoration: none;
            border-color:white;
        }
    </style>
</head>