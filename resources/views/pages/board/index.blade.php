@include("layouts.header")
@include("layouts.adminside")

<div class="content-wrapper">

    <section class="content">


        <div class="col-md-12 col-sm-4">
            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="page-header">
                        <h2>
                            <i class="glyphicon glyphicon-blackboard"></i> List of Boards
                        </h2>

                        @if(Auth::user()->Level_id == 3)
                            <a href="/kanban/createBoard">
                                <button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-plus">
                                        Create
                                        Board</i></button>
                            </a>
                        @endif

                    </div>


                    <ul class="nav nav-tabs ">


                      <li role="presentation" class="active">
                          <a href="#board-mygen" data-toggle="tab"><span class="glyphicon glyphicon-list-alt"></span>
                            Your Boards Doing</a>
                       </li>
                       <li role="presentation" >
                           <a href="#board-gen" data-toggle="tab"><span class="glyphicon glyphicon-list-alt"></span>
                               Boards Doing</a>
                       </li>

                        <li role="presentation">
                            <a href="#board-done" data-toggle="tab"><span class="glyphicon glyphicon-ok"></span>
                                Done</a>
                        </li>
                        @if(Auth::user()->Level_id == 3)
                            <li role="presentation">
                                <a href="#board-bin" data-toggle="tab"><span class="glyphicon glyphicon-trash"></span>
                                    Bin</a>
                            </li>
                        @endif
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">

                      <div class="tab-pane fade in active" id="board-mygen">
                          @include("pages.board.myBoard")
                      </div>
                      <div class="tab-pane fade" id="board-gen">
                          @include("pages.board.mainBoard")
                      </div>
                        <div class="tab-pane fade" id="board-done">
                            @include("pages.board.boardDone")
                        </div>
                        @if(Auth::user()->Level_id == 3)
                            <div class="tab-pane fade" id="board-bin">
                                @include("pages.board.boardBin")
                            </div>
                        @endif

                    </div>


                    <hr>
                </div>

            </div>

        </div>


    </section>


</div>

</body>
@include('layouts.script')
</html>
