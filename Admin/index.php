﻿<?php
session_start();

if(isset($_SESSION['TxtCode']) && $_SESSION['TxtRange'] == 'admin'){

$datos = mysqli_connect('localhost', "root", "MoNoCeRoS", "K_usr10000");
                                                            
$Query_name = mysqli_query($datos, "SELECT FAC_NAME FROM FACILITY WHERE FAC_CODE = " . $_SESSION['TxtCode']);

$Query_task = mysqli_query($datos, "SELECT * FROM ISS WHERE FAC_CODE = " . $_SESSION['TxtCode'] );


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Eque-e</title>
        <style type="text/css">

        #client_logo{
            max-width: 3em;
            border:0;
            margin:0;
            padding:0;
        }
        .progressDisplay{
            height:0 ;
            max-width:100%;
            -webkit-transition: all 600ms ease-in-out;
            -moz-transition: all 600ms ease-in-out;
             transition: all 600ms ease-in-out;
             margin-left: 1em;
             opacity: 0;
        }

        </style>
        <link type="text/css" href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="../bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="../css/theme.css" rel="stylesheet">
        <link type="text/css" href="../images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
            rel='stylesheet'>
    </head>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                        <i class="icon-reorder shaded"></i></a><a class="brand" href="index.html"><img id="client_logo" src="../images/vdm.jpg"> </a>
                    <div class="nav-collapse collapse navbar-inverse-collapse">
                        <ul class="nav nav-icons">
                            <li class="active"><a href="#"><i class="icon-envelope"></i></a></li>
                            <li><a href="#"><i class="icon-eye-open"></i></a></li>
                            <li><a href="#"><i class="icon-bar-chart"></i></a></li>
                        </ul>
                        <form class="navbar-search pull-left input-append" action="#">
                        <input type="text" class="span3">
                        <button class="btn" type="button">
                            <i class="icon-search"></i>
                        </button>
                        </form>
                        <ul class="nav pull-right">
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Item No. 1</a></li>
                                    <li><a href="#">Don't Click</a></li>
                                    <li class="divider"></li>
                                    <li class="nav-header">Example Header</li>
                                    <li><a href="#">A Separated link</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Support </a></li>
                            <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="../images/user.png" class="nav-avatar" />
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Your Profile</a></li>
                                    <li><a href="#">Edit Profile</a></li>
                                    <li><a href="#">Account Settings</a></li>
                                    <li class="divider"></li>
                                    <li><a href="../backend/close.php">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- /.nav-collapse -->
                </div>
            </div>
            <!-- /navbar-inner -->
        </div>
        <!-- /navbar -->
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="span3">
                        <div class="sidebar">
                            <ul class="widget widget-menu unstyled">
                                <li class="active"><a href="index.php"><i class="menu-icon icon-dashboard"></i>Vista Principal
                                </a></li>
                                <li><a href="activity.php"><i class="menu-icon icon-bullhorn"></i>ingreso de Audiencias</a>
                                </li>
                                <li><a href="other-user-profile.php"><i class="menu-icon icon-inbox"></i>Perfil de Usuario<b class="label green pull-right">
                                    11</b> </a></li>
                                <li><a href="task.php"><i class="menu-icon icon-tasks"></i>Control de Cumplimientos<b class="label orange pull-right">
                                    19</b> </a></li>
                            </ul>

                            <!--/.widget-nav-->
                            
                            <!--
                            <ul class="widget widget-menu unstyled">
                                <li><a href="ui-button-icon.html"><i class="menu-icon icon-bold"></i> Buttons </a></li>
                                <li><a href="ui-typography.html"><i class="menu-icon icon-book"></i>Typography </a></li>
                                <li><a href="form.html"><i class="menu-icon icon-paste"></i>Forms </a></li>
                                <li><a href="table.html"><i class="menu-icon icon-table"></i>Tables </a></li>
                                <li><a href="charts.html"><i class="menu-icon icon-bar-chart"></i>Charts </a></li>
                            </ul> -->

                            <!--/.widget-nav-->
                            <ul class="widget widget-menu unstyled">
                                <li><a class="collapsed" data-toggle="collapse" href="#togglePages"><i class="menu-icon icon-cog">
                                </i><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                                </i>More Pages </a>
                                    <ul id="togglePages" class="collapse unstyled">
                                        <li><a href="other-login.html"><i class="icon-inbox"></i>Login </a></li>
                                        <li><a href="other-user-profile.html"><i class="icon-inbox"></i>Profile </a></li>
                                        <li><a href="other-user-listing.html"><i class="icon-inbox"></i>All Users </a></li>
                                    </ul>
                                </li>
                                <li><a href="backend/close.php"><i class="menu-icon icon-signout"></i>Logout </a></li>
                            </ul>
                        </div>
                        <!--/.sidebar-->
                    </div>
                    <!--/.span3-->
                    <div class="span9">
                        <div class="content">
                            <div class="btn-controls">
                                <div class="btn-box-row row-fluid">
                                    <a id="Actas" href="#" class="btn-box big span4"><i class="icon-group"></i><b>20</b>
                                        <p class="text-muted">
                                           Actas de Consejo </p>
                                 <ul class="widget widget-usage unstyled progressDisplay" id="Act-Display">
                                        <li>
                                            <p>
                                             <strong>Compromisos Entrantes</strong> <span class="pull-right small muted">17%</span>
                                            </p>
                                            <div class="progress tight">
                                                <div class="bar" style="width: 17%;">
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <p>
                                                <strong>Compromisos en Curso</strong><span class="pull-right small muted">88%</span>
                                            </p>
                                            <div class="progress tight">
                                                <div class="bar bar-success" style="width: 88%;">
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <p>
                                                <strong>Compromisos por vencer</strong> <span class="pull-right small muted">12%</span>
                                            </p>
                                            <div class="progress tight">
                                                <div class="bar bar-warning" style="width: 12%;">
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <p>
                                                <strong>Compromisos Atrasados</strong> <span class="pull-right small muted">2%</span>
                                            </p>
                                            <div class="progress tight">
                                                <div class="bar bar-danger" style="width: 2%;">
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    </a>
                                      


                                <a id="Audiencias" href="#" class="btn-box big span4"><i class="icon-user"></i><b>15</b>
                                        <p class="text-muted">
                                            Audiencias</p>
                                    <ul class="widget widget-usage unstyled progressDisplay" id="Audi-Display">
                                        <li>
                                            <p>
                                             <strong>Audiencias Recibidas</strong> <span class="pull-right small muted">78%</span>
                                            </p>
                                            <div class="progress tight">
                                                <div class="bar" style="width: 78%;">
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <p>
                                                <strong>Audiencias en Curso</strong> <span class="pull-right small muted">38%</span>
                                            </p>
                                            <div class="progress tight">
                                                <div class="bar bar-success" style="width: 18%;">
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <p>
                                                <strong>Audiencias por vencer</strong> <span class="pull-right small muted">44%</span>
                                            </p>
                                            <div class="progress tight">
                                                <div class="bar bar-warning" style="width: 44%;">
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <p>
                                                <strong>Audiencias Atrasadas</strong> <span class="pull-right small muted">67%</span>
                                            </p>
                                            <div class="progress tight">
                                                <div class="bar bar-danger" style="width: 67%;">
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    </a>
                                <a id="Urgencias" href="#" class="btn-box big span4"><i class="icon-warning-sign"></i><b>5</b>
                                        <p class="text-muted">
                                            Urgencias</p>
                       <ul class="widget widget-usage unstyled progressDisplay"  id="urgent-Display">
                                        <li>
                                            <p>
                                                <strong>Urgencias Recibidas</strong> <span class="pull-right small muted">78%</span>
                                            </p>
                                            <div class="progress tight">
                                                <div class="bar" style="width: 78%;">
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <p>
                                                <strong>Urgencias en Curso</strong> <span class="pull-right small muted">56%</span>
                                            </p>
                                            <div class="progress tight">
                                                <div class="bar bar-success" style="width: 56%;">
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <p>
                                                <strong>Urgencias por Vencer</strong> <span id="U-active" class="pull-right small muted">44%</span>
                                            </p>
                                            <div class="progress tight">
                                                <div class="bar bar-warning" style="width: 44%;">
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <p>
                                                <strong>Urgencias Atrasadas</strong> <span class="pull-right small muted">67%</span>
                                            </p>
                                            <div class="progress tight">
                                                <div class="bar bar-danger" style="width: 67%;">
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    </a>
                                </div>
                                <div class="row">
   
                                </div>
                                <div class="btn-box-row row-fluid">
                                    <div class="span8">
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <a href="#" class="btn-box small span4"><i class="icon-envelope"></i><b>Messages</b>
                                                </a><a href="#" class="btn-box small span4"><i class="icon-group"></i><b>Clients</b>
                                                </a><a href="#" class="btn-box small span4"><i class="icon-exchange"></i><b>Expenses</b>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <a href="#" class="btn-box small span4"><i class="icon-save"></i><b>Total Sales</b>
                                                </a><a href="#" class="btn-box small span4"><i class="icon-bullhorn"></i><b>Social Feed</b>
                                                </a><a href="#" class="btn-box small span4"><i class="icon-sort-down"></i><b>Bounce
                                                    Rate</b> </a>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="widget widget-usage unstyled span4">
                                        <li>
                                            <p>
                                                <strong>Solicitudes Entrantes</strong> <span class="pull-right small muted">78%</span>
                                            </p>
                                            <div class="progress tight">
                                                <div class="bar" style="width: 78%;">
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <p>
                                                <strong>Solicitudes Activas</strong> <span class="pull-right small muted">56%</span>
                                            </p>
                                            <div class="progress tight">
                                                <div class="bar bar-success" style="width: 56%;">
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <p>
                                                <strong>Solicitudes por vencer</strong> <span class="pull-right small muted">44%</span>
                                            </p>
                                            <div class="progress tight">
                                                <div class="bar bar-warning" style="width: 44%;">
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <p>
                                                <strong>Solicutdes Atrasadas</strong> <span class="pull-right small muted">67%</span>
                                            </p>
                                            <div class="progress tight">
                                                <div class="bar bar-danger" style="width: 67%;">
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--/#btn-controls-->
                            <div class="module">
                                <div class="module-head">
                                    <h3>
                                        Situación general de requerimientos</h3>
                                </div>
                                <div class="module-body">
                                    <div class="chart inline-legend grid">
                                        <div id="placeholder2" class="graph" style="height: 300px">
                                        </div>
                                    </div>
                                </div>
                            <!--/.module-->
                            <div class="module hide">
                                <div class="module-head">
                                    <h3>
                                        Adjust Budget Range</h3>
                                </div>
                                <div class="module-body">
                                    <div class="form-inline clearfix">
                                        <a href="#" class="btn pull-right">Update</a>
                                        <label for="amount">
                                            Price range:</label>
                                        &nbsp;
                                        <input type="text" id="amount" class="input-" />
                                    </div>
                                    <hr />
                                    <div class="slider-range">
                                    </div>
                                </div>
                            </div>
                            <div class="module">
                                <div class="module-head">
                                    <h3>
                                        DataTables</h3>
                                </div>
                                <div class="module-body table">
                                    <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Rendering engine
                                                </th>
                                                <th>
                                                    Browser
                                                </th>
                                                <th>
                                                    Platform(s)
                                                </th>
                                                <th>
                                                    Engine version
                                                </th>
                                                <th>
                                                    CSS grade
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="odd gradeX">
                                                <td>
                                                    Trident
                                                </td>
                                                <td>
                                                    Internet Explorer 4.0
                                                </td>
                                                <td>
                                                    Win 95+
                                                </td>
                                                <td class="center">
                                                    4
                                                </td>
                                                <td class="center">
                                                    X
                                                </td>
                                            </tr>
                                            <tr class="even gradeC">
                                                <td>
                                                    Trident
                                                </td>
                                                <td>
                                                    Internet Explorer 5.0
                                                </td>
                                                <td>
                                                    Win 95+
                                                </td>
                                                <td class="center">
                                                    5
                                                </td>
                                                <td class="center">
                                                    C
                                                </td>
                                            </tr>
                                            <tr class="odd gradeA">
                                                <td>
                                                    Trident
                                                </td>
                                                <td>
                                                    Internet Explorer 5.5
                                                </td>
                                                <td>
                                                    Win 95+
                                                </td>
                                                <td class="center">
                                                    5.5
                                                </td>
                                                <td class="center">
                                                    A
                                                </td>
                                            </tr>
                                            <tr class="even gradeA">
                                                <td>
                                                    Trident
                                                </td>
                                                <td>
                                                    Internet Explorer 6
                                                </td>
                                                <td>
                                                    Win 98+
                                                </td>
                                                <td class="center">
                                                    6
                                                </td>
                                                <td class="center">
                                                    A
                                                </td>
                                            </tr>
                                            <tr class="odd gradeA">
                                                <td>
                                                    Trident
                                                </td>
                                                <td>
                                                    Internet Explorer 7
                                                </td>
                                                <td>
                                                    Win XP SP2+
                                                </td>
                                                <td class="center">
                                                    7
                                                </td>
                                                <td class="center">
                                                    A
                                                </td>
                                            </tr>
                                            <tr class="even gradeA">
                                                <td>
                                                    Trident
                                                </td>
                                                <td>
                                                    AOL browser (AOL desktop)
                                                </td>
                                                <td>
                                                    Win XP
                                                </td>
                                                <td class="center">
                                                    6
                                                </td>
                                                <td class="center">
                                                    A
                                                </td>
                                            </tr>
                                            <tr class="gradeA">
                                                <td>
                                                    Gecko
                                                </td>
                                                <td>
                                                    Firefox 1.0
                                                </td>
                                                <td>
                                                    Win 98+ / OSX.2+
                                                </td>
                                                <td class="center">
                                                    1.7
                                                </td>
                                                <td class="center">
                                                    A
                                                </td>
                                            </tr>
                                            <tr class="gradeA">
                                                <td>
                                                    Gecko
                                                </td>
                                                <td>
                                                    Firefox 1.5
                                                </td>
                                                <td>
                                                    Win 98+ / OSX.2+
                                                </td>
                                                <td class="center">
                                                    1.8
                                                </td>
                                                <td class="center">
                                                    A
                                                </td>
                                            </tr>
                                            <tr class="gradeA">
                                                <td>
                                                    Gecko
                                                </td>
                                                <td>
                                                    Firefox 2.0
                                                </td>
                                                <td>
                                                    Win 98+ / OSX.2+
                                                </td>
                                                <td class="center">
                                                    1.8
                                                </td>
                                                <td class="center">
                                                    A
                                                </td>
                                            </tr>
                                            <tr class="gradeA">
                                                <td>
                                                    Gecko
                                                </td>
                                                <td>
                                                    Firefox 3.0
                                                </td>
                                                <td>
                                                    Win 2k+ / OSX.3+
                                                </td>
                                                <td class="center">
                                                    1.9
                                                </td>
                                                <td class="center">
                                                    A
                                                </td>
                                            </tr>
                                            <tr class="gradeA">
                                                <td>
                                                    Gecko
                                                </td>
                                                <td>
                                                    Camino 1.0
                                                </td>
                                                <td>
                                                    OSX.2+
                                                </td>
                                                <td class="center">
                                                    1.8
                                                </td>
                                                <td class="center">
                                                    A
                                                </td>
                                            </tr>
                                            <tr class="gradeA">
                                                <td>
                                                    Gecko
                                                </td>
                                                <td>
                                                    Camino 1.5
                                                </td>
                                                <td>
                                                    OSX.3+
                                                </td>
                                                <td class="center">
                                                    1.8
                                                </td>
                                                <td class="center">
                                                    A
                                                </td>
                                            </tr>
                                            <tr class="gradeA">
                                                <td>
                                                    Gecko
                                                </td>
                                                <td>
                                                    Netscape 7.2
                                                </td>
                                                <td>
                                                    Win 95+ / Mac OS 8.6-9.2
                                                </td>
                                                <td class="center">
                                                    1.7
                                                </td>
                                                <td class="center">
                                                    A
                                                </td>
                                            </tr>
                                            <tr class="gradeA">
                                                <td>
                                                    Gecko
                                                </td>
                                                <td>
                                                    Netscape Browser 8
                                                </td>
                                                <td>
                                                    Win 98SE+
                                                </td>
                                                <td class="center">
                                                    1.7
                                                </td>
                                                <td class="center">
                                                    A
                                                </td>
                                            </tr>
                                            <tr class="gradeA">
                                                <td>
                                                    Gecko
                                                </td>
                                                <td>
                                                    Netscape Navigator 9
                                                </td>
                                                <td>
                                                    Win 98+ / OSX.2+
                                                </td>
                                                <td class="center">
                                                    1.8
                                                </td>
                                                <td class="center">
                                                    A
                                                </td>
                                            </tr>
                                            <tr class="gradeA">
                                                <td>
                                                    Gecko
                                                </td>
                                                <td>
                                                    Mozilla 1.0
                                                </td>
                                                <td>
                                                    Win 95+ / OSX.1+
                                                </td>
                                                <td class="center">
                                                    1
                                                </td>
                                                <td class="center">
                                                    A
                                                </td>
                                            </tr>
                                            <tr class="gradeA">
                                                <td>
                                                    Gecko
                                                </td>
                                                <td>
                                                    Mozilla 1.1
                                                </td>
                                                <td>
                                                    Win 95+ / OSX.1+
                                                </td>
                                                <td class="center">
                                                    1.1
                                                </td>
                                                <td class="center">
                                                    A
                                                </td>
                                            </tr>
                                            <tr class="gradeA">
                                                <td>
                                                    Gecko
                                                </td>
                                                <td>
                                                    Mozilla 1.2
                                                </td>
                                                <td>
                                                    Win 95+ / OSX.1+
                                                </td>
                                                <td class="center">
                                                    1.2
                                                </td>
                                                <td class="center">
                                                    A
                                                </td>
                                            </tr>
                                            <tr class="gradeA">
                                                <td>
                                                    Gecko
                                                </td>
                                                <td>
                                                    Mozilla 1.3
                                                </td>
                                                <td>
                                                    Win 95+ / OSX.1+
                                                </td>
                                                <td class="center">
                                                    1.3
                                                </td>
                                                <td class="center">
                                                    A
                                                </td>
                                            </tr>
                                            <tr class="gradeA">
                                                <td>
                                                    Gecko
                                                </td>
                                                <td>
                                                    Mozilla 1.4
                                                </td>
                                                <td>
                                                    Win 95+ / OSX.1+
                                                </td>
                                                <td class="center">
                                                    1.4
                                                </td>
                                                <td class="center">
                                                    A
                                                </td>
                                            </tr>
                                            <tr class="gradeA">
                                                <td>
                                                    Gecko
                                                </td>
                                                <td>
                                                    Mozilla 1.5
                                                </td>
                                                <td>
                                                    Win 95+ / OSX.1+
                                                </td>
                                                <td class="center">
                                                    1.5
                                                </td>
                                                <td class="center">
                                                    A
                                                </td>
                                            </tr>
                                            <tr class="gradeA">
                                                <td>
                                                    Gecko
                                                </td>
                                                <td>
                                                    Mozilla 1.6
                                                </td>
                                                <td>
                                                    Win 95+ / OSX.1+
                                                </td>
                                                <td class="center">
                                                    1.6
                                                </td>
                                                <td class="center">
                                                    A
                                                </td>
                                            </tr>
                                            <tr class="gradeA">
                                                <td>
                                                    Gecko
                                                </td>
                                                <td>
                                                    Mozilla 1.7
                                                </td>
                                                <td>
                                                    Win 98+ / OSX.1+
                                                </td>
                                                <td class="center">
                                                    1.7
                                                </td>
                                                <td class="center">
                                                    A
                                                </td>
                                            </tr>
                                            <tr class="gradeA">
                                                <td>
                                                    Gecko
                                                </td>
                                                <td>
                                                    Mozilla 1.8
                                                </td>
                                                <td>
                                                    Win 98+ / OSX.1+
                                                </td>
                                                <td class="center">
                                                    1.8
                                                </td>
                                                <td class="center">
                                                    A
                                                </td>
                                            </tr>
                                            <tr class="gradeA">
                                                <td>
                                                    Gecko
                                                </td>
                                                <td>
                                                    Seamonkey 1.1
                                                </td>
                                                <td>
                                                    Win 98+ / OSX.2+
                                                </td>
                                                <td class="center">
                                                    1.8
                                                </td>
                                                <td class="center">
                                                    A
                                                </td>
                                            </tr>
                                            <tr class="gradeA">
                                                <td>
                                                    Gecko
                                                </td>
                                                <td>
                                                    Epiphany 2.20
                                                </td>
                                                <td>
                                                    Gnome
                                                </td>
                                                <td class="center">
                                                    1.8
                                                </td>
                                                <td class="center">
                                                    A
                                                </td>
                                            </tr>
                                            <tr class="gradeA">
                                                <td>
                                                    Webkit
                                                </td>
                                                <td>
                                                    Safari 1.2
                                                </td>
                                                <td>
                                                    OSX.3
                                                </td>
                                                <td class="center">
                                                    125.5
                                                </td>
                                                <td class="center">
                                                    A
                                                </td>
                                            </tr>
                                            <tr class="gradeA">
                                                <td>
                                                    Webkit
                                                </td>
                                                <td>
                                                    Safari 1.3
                                                </td>
                                                <td>
                                                    OSX.3
                                                </td>
                                                <td class="center">
                                                    312.8
                                                </td>
                                                <td class="center">
                                                    A
                                                </td>
                                            </tr>
                                            <tr class="gradeA">
                                                <td>
                                                    Webkit
                                                </td>
                                                <td>
                                                    Safari 2.0
                                                </td>
                                                <td>
                                                    OSX.4+
                                                </td>
                                                <td class="center">
                                                    419.3
                                                </td>
                                                <td class="center">
                                                    A
                                                </td>
                                            </tr>
                                            <tr class="gradeA">
                                                <td>
                                                    Webkit
                                                </td>
                                                <td>
                                                    Safari 3.0
                                                </td>
                                                <td>
                                                    OSX.4+
                                                </td>
                                                <td class="center">
                                                    522.1
                                                </td>
                                                <td class="center">
                                                    A
                                                </td>
                                            </tr>
                                            <tr class="gradeA">
                                                <td>
                                                    Webkit
                                                </td>
                                                <td>
                                                    OmniWeb 5.5
                                                </td>
                                                <td>
                                                    OSX.4+
                                                </td>
                                                <td class="center">
                                                    420
                                                </td>
                                                <td class="center">
                                                    A
                                                </td>
                                            </tr>
                                            <tr class="gradeA">
                                                <td>
                                                    Webkit
                                                </td>
                                                <td>
                                                    iPod Touch / iPhone
                                                </td>
                                                <td>
                                                    iPod
                                                </td>
                                                <td class="center">
                                                    420.1
                                                </td>
                                                <td class="center">
                                                    A
                                                </td>
                                            </tr>
                                            <tr class="gradeA">
                                                <td>
                                                    Webkit
                                                </td>
                                                <td>
                                                    S60
                                                </td>
                                                <td>
                                                    S60
                                                </td>
                                                <td class="center">
                                                    413
                                                </td>
                                                <td class="center">
                                                    A
                                                </td>
                                            </tr>
                                            <tr class="gradeA">
                                                <td>
                                                    Presto
                                                </td>
                                                <td>
                                                    Opera 7.0
                                                </td>
                                                <td>
                                                    Win 95+ / OSX.1+
                                                </td>
                                                <td class="center">
                                                    -
                                                </td>
                                                <td class="center">
                                                    A
                                                </td>
                                            </tr>
                                            <tr class="gradeA">
                                                <td>
                                                    Presto
                                                </td>
                                                <td>
                                                    Opera 7.5
                                                </td>
                                                <td>
                                                    Win 95+ / OSX.2+
                                                </td>
                                                <td class="center">
                                                    -
                                                </td>
                                                <td class="center">
                                                    A
                                                </td>
                                            </tr>
                                            <tr class="gradeA">
                                                <td>
                                                    Presto
                                                </td>
                                                <td>
                                                    Opera 8.0
                                                </td>
                                                <td>
                                                    Win 95+ / OSX.2+
                                                </td>
                                                <td class="center">
                                                    -
                                                </td>
                                                <td class="center">
                                                    A
                                                </td>
                                            </tr>
                                            <tr class="gradeA">
                                                <td>
                                                    Presto
                                                </td>
                                                <td>
                                                    Opera 8.5
                                                </td>
                                                <td>
                                                    Win 95+ / OSX.2+
                                                </td>
                                                <td class="center">
                                                    -
                                                </td>
                                                <td class="center">
                                                    A
                                                </td>
                                            </tr>
                                            <tr class="gradeA">
                                                <td>
                                                    Presto
                                                </td>
                                                <td>
                                                    Opera 9.0
                                                </td>
                                                <td>
                                                    Win 95+ / OSX.3+
                                                </td>
                                                <td class="center">
                                                    -
                                                </td>
                                                <td class="center">
                                                    A
                                                </td>
                                            </tr>
                                            <tr class="gradeA">
                                                <td>
                                                    Presto
                                                </td>
                                                <td>
                                                    Opera 9.2
                                                </td>
                                                <td>
                                                    Win 88+ / OSX.3+
                                                </td>
                                                <td class="center">
                                                    -
                                                </td>
                                                <td class="center">
                                                    A
                                                </td>
                                            </tr>
                                            <tr class="gradeA">
                                                <td>
                                                    Presto
                                                </td>
                                                <td>
                                                    Opera 9.5
                                                </td>
                                                <td>
                                                    Win 88+ / OSX.3+
                                                </td>
                                                <td class="center">
                                                    -
                                                </td>
                                                <td class="center">
                                                    A
                                                </td>
                                            </tr>
                                            <tr class="gradeA">
                                                <td>
                                                    Presto
                                                </td>
                                                <td>
                                                    Opera for Wii
                                                </td>
                                                <td>
                                                    Wii
                                                </td>
                                                <td class="center">
                                                    -
                                                </td>
                                                <td class="center">
                                                    A
                                                </td>
                                            </tr>
                                            <tr class="gradeA">
                                                <td>
                                                    Presto
                                                </td>
                                                <td>
                                                    Nokia N800
                                                </td>
                                                <td>
                                                    N800
                                                </td>
                                                <td class="center">
                                                    -
                                                </td>
                                                <td class="center">
                                                    A
                                                </td>
                                            </tr>
                                            <tr class="gradeA">
                                                <td>
                                                    Presto
                                                </td>
                                                <td>
                                                    Nintendo DS browser
                                                </td>
                                                <td>
                                                    Nintendo DS
                                                </td>
                                                <td class="center">
                                                    8.5
                                                </td>
                                                <td class="center">
                                                    C/A<sup>1</sup>
                                                </td>
                                            </tr>
                                            <tr class="gradeC">
                                                <td>
                                                    KHTML
                                                </td>
                                                <td>
                                                    Konqureror 3.1
                                                </td>
                                                <td>
                                                    KDE 3.1
                                                </td>
                                                <td class="center">
                                                    3.1
                                                </td>
                                                <td class="center">
                                                    C
                                                </td>
                                            </tr>
                                            <tr class="gradeA">
                                                <td>
                                                    KHTML
                                                </td>
                                                <td>
                                                    Konqureror 3.3
                                                </td>
                                                <td>
                                                    KDE 3.3
                                                </td>
                                                <td class="center">
                                                    3.3
                                                </td>
                                                <td class="center">
                                                    A
                                                </td>
                                            </tr>
                                            <tr class="gradeA">
                                                <td>
                                                    KHTML
                                                </td>
                                                <td>
                                                    Konqureror 3.5
                                                </td>
                                                <td>
                                                    KDE 3.5
                                                </td>
                                                <td class="center">
                                                    3.5
                                                </td>
                                                <td class="center">
                                                    A
                                                </td>
                                            </tr>
                                            <tr class="gradeX">
                                                <td>
                                                    Tasman
                                                </td>
                                                <td>
                                                    Internet Explorer 4.5
                                                </td>
                                                <td>
                                                    Mac OS 8-9
                                                </td>
                                                <td class="center">
                                                    -
                                                </td>
                                                <td class="center">
                                                    X
                                                </td>
                                            </tr>
                                            <tr class="gradeC">
                                                <td>
                                                    Tasman
                                                </td>
                                                <td>
                                                    Internet Explorer 5.1
                                                </td>
                                                <td>
                                                    Mac OS 7.6-9
                                                </td>
                                                <td class="center">
                                                    1
                                                </td>
                                                <td class="center">
                                                    C
                                                </td>
                                            </tr>
                                            <tr class="gradeC">
                                                <td>
                                                    Tasman
                                                </td>
                                                <td>
                                                    Internet Explorer 5.2
                                                </td>
                                                <td>
                                                    Mac OS 8-X
                                                </td>
                                                <td class="center">
                                                    1
                                                </td>
                                                <td class="center">
                                                    C
                                                </td>
                                            </tr>
                                            <tr class="gradeA">
                                                <td>
                                                    Misc
                                                </td>
                                                <td>
                                                    NetFront 3.1
                                                </td>
                                                <td>
                                                    Embedded devices
                                                </td>
                                                <td class="center">
                                                    -
                                                </td>
                                                <td class="center">
                                                    C
                                                </td>
                                            </tr>
                                            <tr class="gradeA">
                                                <td>
                                                    Misc
                                                </td>
                                                <td>
                                                    NetFront 3.4
                                                </td>
                                                <td>
                                                    Embedded devices
                                                </td>
                                                <td class="center">
                                                    -
                                                </td>
                                                <td class="center">
                                                    A
                                                </td>
                                            </tr>
                                            <tr class="gradeX">
                                                <td>
                                                    Misc
                                                </td>
                                                <td>
                                                    Dillo 0.8
                                                </td>
                                                <td>
                                                    Embedded devices
                                                </td>
                                                <td class="center">
                                                    -
                                                </td>
                                                <td class="center">
                                                    X
                                                </td>
                                            </tr>
                                            <tr class="gradeX">
                                                <td>
                                                    Misc
                                                </td>
                                                <td>
                                                    Links
                                                </td>
                                                <td>
                                                    Text only
                                                </td>
                                                <td class="center">
                                                    -
                                                </td>
                                                <td class="center">
                                                    X
                                                </td>
                                            </tr>
                                            <tr class="gradeX">
                                                <td>
                                                    Misc
                                                </td>
                                                <td>
                                                    Lynx
                                                </td>
                                                <td>
                                                    Text only
                                                </td>
                                                <td class="center">
                                                    -
                                                </td>
                                                <td class="center">
                                                    X
                                                </td>
                                            </tr>
                                            <tr class="gradeC">
                                                <td>
                                                    Misc
                                                </td>
                                                <td>
                                                    IE Mobile
                                                </td>
                                                <td>
                                                    Windows Mobile 6
                                                </td>
                                                <td class="center">
                                                    -
                                                </td>
                                                <td class="center">
                                                    C
                                                </td>
                                            </tr>
                                            <tr class="gradeC">
                                                <td>
                                                    Misc
                                                </td>
                                                <td>
                                                    PSP browser
                                                </td>
                                                <td>
                                                    PSP
                                                </td>
                                                <td class="center">
                                                    -
                                                </td>
                                                <td class="center">
                                                    C
                                                </td>
                                            </tr>
                                            <tr class="gradeU">
                                                <td>
                                                    Other browsers
                                                </td>
                                                <td>
                                                    All others
                                                </td>
                                                <td>
                                                    -
                                                </td>
                                                <td class="center">
                                                    -
                                                </td>
                                                <td class="center">
                                                    U
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>
                                                    Rendering engine
                                                </th>
                                                <th>
                                                    Browser
                                                </th>
                                                <th>
                                                    Platform(s)
                                                </th>
                                                <th>
                                                    Engine version
                                                </th>
                                                <th>
                                                    CSS grade
                                                </th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <!--/.module-->
                        </div>
                        <!--/.content-->
                    </div>
                    <!--/.span9-->
                </div>
            </div>
            <!--/.container-->
        </div>
        <!--/.wrapper-->
        <div class="footer">
            <div class="container">
                <b class="copyright">&copy; 2015 Eque-e </b>All rights reserved.
            </div>
        </div>
        <script type="text/javascript">
      var fac = <? printf($_SESSION['TxtFacility']) ?>
        </script>
        <script src="../scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="../scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
        <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../scripts/flot/jquery.flot.js" type="text/javascript"></script>
        <script src="../scripts/flot/jquery.flot.pie.js" type="text/javascript"></script>
        <script src="../scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>
        <script src="../scripts/jlinq.js" type="text/javascript"></script>
        <script src="../scripts/jlinq.jquery.js" type="text/javascript"></script>
        <script src="../scripts/datatables/jquery.dataTables.js" type="text/javascript"></script>
 
      
    </body>
<script type="text/javascript">
    


$(document).on('ready', function(){

array_set = [
<?

$pass = mysqli_query($datos, "SELECT B.EST_DESCRIPT, COUNT( STSK_ID ) , B.EST_COLOR FROM SUBTASKS A INNER JOIN EST B ON ( A.STSK_STATE = B.EST_CODE )  WHERE STSK_FAC_CODE = " . $_SESSION['TxtFacility'] . " GROUP BY EST_DESCRIPT");

while ( $fila2 = mysqli_fetch_row($pass)) {

?>
{ label: "<? printf(  $fila2[0] ) ?>",  data: <? printf( $fila2[1] ) ?> , color:"<? printf( $fila2[2] ) ?>"},
<? } ?>
{ label: "n/n",  data: 0, color: "#FFF"}
];

    $.plot("#placeholder2", array_set, {
           series: {
            pie: {
                 innerRadius: 0.5,
                show: true
            }
         },
         legend: {
            labelBoxBorderColor: "none"
         }
    });

});

/*

     function setData(){
        getValues( function (content){

            var array_states = ['Pendiente', 'En Curso', 'Atrasada', 'Por Vencer', 'Hecha'];
/*
Pendiente
#DED901

En Curso
#178FD0

Atrasada
#E70101

Por Vencer
#EDB405

Hecha
#1CC131

*/



    /*        
                array_data = JSON.parse(content);
                var jhandler = jlinq.from(array_data.data).select();

                // first construct your depto array 
                var array_dept = [];
                var n = 0;
             for (i=0; i < jhandler.length; i++){
                for (var key in jhandler[i]){
                    array_dept[n] = key;
                    n++;
                }
              }


              //second: match available states
             for (i=0;i<5;i++){
                if(array_states[i] == jhandler[] )
             }


               var ht = jhandler.global[0];
            
              //third: iterate thought JSON dococ to build you dat array
               for (i=0, i < ht.length;i++){
                    { label: ht.,  data: 36.6, color: "#AA4643"}
                  }
               
        });
     }



function getValues(callback){
var data;
$.ajax({
    type: "POST", 
    url: "../backend/inject_pie_data.php?facility=" + fac,
    success : function (resp){
            console.info(resp);
            data = resp;
            callback(data);

    }, 
    error :  function (error){
        console.log(error);
    }
});
}

*/

setIconState('Actas');
setIconState('Audiencias');
setIconState('Urgencias');

    $("#Actas").on('click', function(){
      if($(this).data("val") === 1){
    $("#Act-Display").css({ opacity : "0"});
       $("#Act-Display").css({ height : "0px"});
          $(this).data("val", 0);
      } else {
        $("#Act-Display").css({ height : "270px"});
           $("#Act-Display").css({ opacity : "1"});   
              $(this).data("val", 1);
      }
    });

    $("#Audiencias").on('click', function(){
      if($(this).data("val") === 1){
     $("#Audi-Display").css({ opacity : "0"}); 
        $("#Audi-Display").css({ height : "0px"});
          $(this).data("val", 0);
      } else {

       $("#Audi-Display").css({ height : "270px"});
          $("#Audi-Display").css({ opacity : "1"}); 
            $(this).data("val", 1);  
      }
      
    });

  $("#Urgencias").on('click', function(){
    if($(this).data("val") === 1){
$("#urgent-Display").css({ opacity : "0"}); 
     $("#urgent-Display").css({ height : "0px"});
        $(this).data("val", 0);
    } else {
    $("#urgent-Display").css({ height : "270px"});
          $("#urgent-Display").css({ opacity : "1"}); 
             $(this).data("val", 1);
    }
       
        
    });




// switch para colorear el icono segun valores pasados
function setIconState(objId){

var y = parseFloat($("#" + objId + " li:nth-child(2) span").html());
var delayed = parseFloat($("#" + objId + " li:nth-child(4) span").html());

 var x = parseInt(y);
console.info(x);

switch(true){
  case(x >= 0 && x < 9 ):
$("#" + objId + " > i").css({'color' : 'rgb(255,'+ parseInt((x*0.56)) + ',0)'});
 console.info('rgb(255,' + (x*2) + ',0)');
  break;
  case(x >= 10 && x < 19 ):
$("#" + objId + " > i").css({'color' : 'rgb(255,' + parseInt((x*0.56)) + ',0)'});
console.info('rgb(255,' + (x*2) + ',0)');
  break;
  case(x >= 20 && x < 29):
$("#" + objId + " > i").css({'color' : 'rgb(255,' + parseInt((x*0.56)) + ',0)'});
console.info('rgb(255,' + (x*2) + ',0)');
  break;
  case(x >= 30 && x < 39):
$("#" + objId + " > i").css({'color' : 'rgb(255,' + parseInt((x*0.56)) + ',0)'});
 console.info('rgb(255,' + parseInt(255 - (x*0.56)) + ',0)');
  break;
  case(x >= 40 && x < 49):
$("#" + objId + " > i").css({'color' : 'rgb('+ parseInt(255 - (x*0.56)) + ',255,0)'});
 console.info('rgb('+ parseInt(255 - (x*0.56)) + ',255,0)');
  break;
  case(x >= 50 && x < 59):
$("#" + objId + " > i").css({'color' : 'rgb(' + parseInt(255 - (x*0.56))  + ',255,0)'});
console.info('rgb(' + parseInt(255 - (x*0.56))  + ',255,0)');
  break;
  case(x >= 60 && x < 69):
$("#" + objId + " > i").css({'color' : 'rgb(' + parseInt(255 - (x*0.56)) +',255,0)'});
console.info('rgb(' + parseInt(255 - (x*0.56)) +',255,0)');
  break;
  case(x >= 70 && x < 79):
$("#" + objId + " > i").css({'color' : 'rgb(' + parseInt(255 - (x*0.56)) +',255,0)'});
console.info('rgb(' + parseInt(255 - (x*0.56))+',255,0)');
  break;
  case(x >= 80 && x < 100):
$("#" + objId + " > i").css({'color' : 'rgb(0,255,0)'});
break;
        }
}





</script>
<?

 } else {
    echo "<script language='javascript'>window.location='../index.php'</script>";
 }  ?>