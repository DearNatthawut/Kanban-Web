<?php
/**
 * Created by PhpStorm.
 * User: DNOJ
 * Date: 4/19/2016
 * Time: 11:22 PM
 */ ?>

@include("layouts.header")
@include("layouts.adminside")


<div class="content-wrapper">

    <section class="content">


        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="box-body">
                    <h2>
                        <i class="glyphicon glyphicon-wrench"></i> Management Account
                    </h2>
                    <hr>
                    <center>
                        <button type="button" class="btn btn-default " onclick="window.location.href='/kanban/managementAccount/changename'">
                            <span>Change Name</span></button>
                        <button type="button" class="btn btn-default " onclick="window.location.href='/kanban/managementAccount/change-email'">
                            <span>Change Email</span></button>
                        <button type="button" class="btn btn-default " onclick="window.location.href='/kanban/managementAccount/changepassword'">
                            <span>Change Password</span></button>
                    </center>
                    <br>
                </div>
            </div>
        </div>


    </section>
</div>

</body>

@include('layouts.script')

</html>
