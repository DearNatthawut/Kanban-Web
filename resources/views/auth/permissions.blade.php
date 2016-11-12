@include("layouts.header")
@include("layouts.adminside")



<div class="content-wrapper">

    <section class="content">

        <div class="col-md-12 col-sm-4">
            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="page-header">
                        <h2><i class="fa  fa-user"></i> Permissions
                            <small></small>
                        </h2>



                    </div>
                    <div class="box-body">

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>E-mail</th>
                                <th>Position</th>
                                <th style="width: 10px">Manager</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($members as $member)

                                <tr>
                                    <td> {{$member->name}}</td>
                                    <td> {{$member->email}}</td>
                                  <td>{{$member->levelUser['name']}}</td>
                                    <td>
                                            @if($member->levelUser['id'] == 2 )
                                                <form class="form-horizontal" method="post"
                                                      action="/kanban/addManager">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="memberID" value="{{$member->id}}">
                                                    <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Are You sure to change this user as manager?')">
                                                        <i class="glyphicon glyphicon glyphicon-plus"></i>
                                                    </button>
                                                </form>
                                            @endif

                                            @if($member->levelUser['id'] == 3 )
                                                <form class="form-horizontal" method="post" action="/kanban/delManager">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="memberID" value="{{$member->id}}">
                                                    <button type="submit" class="btn btn-info"
                                                            onclick="return confirm('Are You sure to change this manager as user?')">
                                                        <i class="glyphicon glyphicon-minus"></i>
                                                    </button>
                                                </form>
                                            @endif
                                    </td>
                                </tr>


                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>E-mail</th>
                                <th>Position</th>
                                <th style="width: 10px">Manager</th>

                            </tr>
                            </tfoot>
                        </table>
                    </div><!-- /.box-body -->


                </div>

            </div>
        </div>

    </section>


</div>

</body>
@include('layouts.script')
</html>
