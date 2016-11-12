@include("layouts.header")
@include("layouts.aside")


<div class="content-wrapper">

    <section class="content">

        <div class="col-md-12 col-sm-4">
            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="page-header">
                        <h2><i class="fa  fa-user"></i> Member
                            <small>( {{$Board->name}} )</small>
                        </h2>



                    </div>
                    <div class="box-body">

                    @if( Auth::user()->id == $Board->manager_id) <!--    if  Add member -->
                        <div class="col-xs-5">

                            <form class="form-horizontal" method="post" action="/kanban/addMember/{{$id}}">

                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                @if(session()->has('error'))
                                <label for="user" style="color: red"><i class="fa fa-times-circle-o"></i> {{session()->get('error')}}</label>
                                @endif

                                <div class="input-group ">

                                    <input type="text" class="form-control" name="user" id="autocomplete" required/>
                                    <input type="hidden" id="index" name="idUser"/>
                    <span class="input-group-btn">
                      <button class="btn btn-primary btn-flat" type="submit">add</button>
                    </span>

                                </div><!-- /input-group -->
                            </form>
                        </div>
                        <br>

                        @endif

                        <br>
                        <br>
                        <br>

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>E-mail</th>
                                <th>Position</th>
                                @if( Auth::user()->id == $Board->manager_id)
                                    <th style="width: 10px"></th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($members as $member)

                                <tr>
                                    <td> {{$member->member}}</td>
                                    <td> {{$member->email}}</td>
                                    @if($member->User_id == $Board->manager_id)
                                    <td>Project manager</td>
                                    @else
                                      <td>Member</td>
                                    @endif


                                    @if( Auth::user()->id == $Board->manager_id) <!--    if  remove member -->
                                    <td>
                                        @if($member->Level_id != 1  &&  $member->User_id != $Board->manager_id)

                                            @if($member->active == 1 )
                                                <form class="form-horizontal" method="post"
                                                      action="/kanban/getBackMember/{{$id}}">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="memberID" value="{{$member->MM}}">
                                                    <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Are You sure to active?')">
                                                        <i class="glyphicon glyphicon glyphicon-plus"></i>
                                                    </button>
                                                </form>
                                            @endif

                                            @if($member->active == 0 )
                                                <form class="form-horizontal" method="post" action="/kanban/delMember/{{$id}}">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="memberID" value="{{$member->MM}}">
                                                    <button type="submit" class="btn btn-info"
                                                            onclick="return confirm('Are You sure to inactive?')">
                                                        <i class="glyphicon glyphicon-minus"></i>
                                                    </button>
                                                </form>
                                            @endif

                                        @endif
                                    </td>
                                    @endif
                                </tr>


                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>E-mail</th>
                                <th>Position</th>
                                @if(Auth::user()->Level_id == 1)
                                    <th style="width: 10px"></th>
                                @endif

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
