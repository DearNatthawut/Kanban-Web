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

                <div class="panel-body">
                    <div class="page-header">
                        <h2>
                            Change Password
                        </h2>

                    </div>

                    <form method="post" action="/kanban/managementAccount/changePassword/{{Auth::user()->id}}">
                        {!! csrf_field() !!}
                        @if (count($errors) > 0)
                            <div class="alert alert-danger alert-dismissible">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div>
                            <h3>New Password</h3>
                            <input type="password" placeholder="Password" class="form-control"
                                   name="password" value="" pattern="[A-Za-z0-9]{4,}"
                                   title="Use password at least  letter 4" required>
                        </div>
                        <div>
                            <h3>Confirm Password</h3>
                            <input type="password" class="form-control" name="password_confirmation"
                                   placeholder="Confirm Password"
                                   id="Confirm Password" pattern="[A-Za-z0-9]{4,}"
                                   title="Use password at least  letter 4 " required>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-success pull-right"
                                onclick="return confirm('Confirm save new password')"><span
                                    class="glyphicon glyphicon-floppy-save"></span> Save
                        </button>
                    </form>

                </div>

            </div>
        </div>
    </section>
</div>

</body>

@include('layouts.script')

</html>
