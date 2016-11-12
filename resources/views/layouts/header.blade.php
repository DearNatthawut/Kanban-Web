@section("header")

        <!DOCTYPE html>
<html ng-app="kanban"  class="no-js">

<head>

    @include('layouts.css')

    @include('layouts.scriptNG')

    @include('layouts.script')

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Project Management With Kanban Borad</title>
    <link rel="icon" href="/kanban/favicon.ico"/>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <header class="main-header">
        <!-- Logo -->
        <a href="/kanban/home" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>K</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>KANBAN</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->


                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                           <a><span class="hidden-xs">{{Auth::user()->name}} ( @if(Auth::user()->Level_id == 1) admin ) @elseif(Auth::user()->Level_id == 2) Member ) @elseif(Auth::user()->Level_id == 3) Project manager ) @endif</span></a>

                    <li class="dropdown user user-menu">
                        <a href="/kanban/auth/logout"  ><span class="glyphicon glyphicon-log-out"> Singout</span></a>
                    </li>

                </ul>
            </div>
        </nav>

    </header>
</head>
<body class="hold-transition skin-purple  fixed sidebar-mini "> <!--  เปลี่ยน skin ตรงนี้-->
<div class="overlay-wrapper">
@show
