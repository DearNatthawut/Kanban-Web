<?php
/**
 * Created by PhpStorm.
 * User: DNOJ
 * Date: 4/16/2016
 * Time: 2:36 AM
 */?>
    <table class="table table-striped table-hover">
        <tbody>
            @foreach($allBoards as $Board) @foreach($Board->members as $mem) @if(($mem->id == Auth::user()->id || Auth::user()->Level_id == 1) && $Board->status_complete == 1 && $Board->board_hide == 0)
            <tr>
                <td>
                    <span>Name board : {{$Board->name}} </span>
                    <br>
                    <span>Detail : {{$Board->detail}} </span>
                    <br>
                    <span>Manager :{{$Board->manager['name']}} </span>
                    <br>
                    <span>Member : {{count($Board->members)}}</span>
                </td>
                <td>
                    <a href="/kanban/board/{{$Board->id}}">
                        <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-eye-open"></span> View</button>
                    </a>
                    <a href="/kanban/member/{{$Board->id}}">
                        <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-user"></span> Member</button>
                    </a>
                    <a href="/kanban/showGantt/{{$Board->id}}">
                        <button type="button" class="btn btn-default"> <i class="fa  fa-bar-chart"> Gantt Chart</i></button>
                    </a>

                    @if(Auth::user()->id == $Board->manager['id'])
                    <!--            เงื่อนไข แก้ไข และ ลบ -->

                    <a href="/kanban/editBoard/{{$Board->id}}">
                        <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-edit"></span> Edit</button>
                    </a>

                    <button type="button" class="inBoardModal btn btn-info" data-id="<?php echo(json_encode($Board->id)); ?>" data-toggle="modal" data-target="#inBoardModal">
                        InComplete
                    </button>


                    <button type="button" class="delFromDoneBoardModal btn btn-danger" data-id="<?php echo(json_encode($Board->id)); ?>" data-toggle="modal" data-target="#delFromDoneBoardModal">
                        <span class="glyphicon glyphicon-trash"></span> Delete
                    </button>

                    @endif

                    <!-- Start InComplete Board Model -->
                    <div id="inBoardModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Confirm Change Status  Board To InComplete ?</h4>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-danger pull-right" data-dismiss="modal">Cancel</button>
                                    <button class="btn btn-primary" id="inOnClick">Submit</button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Start deleteBoard Model -->
                    <div id="delFromDoneBoardModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Confirm move this board to bin ?</h4>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-danger pull-right" data-dismiss="modal">Cancel</button>
                                    <button class="btn btn-primary" id="delFromDoneOnClick">Submit</button>
                                </div>
                            </div>

                        </div>
                    </div>

                    <script>
                        $(document).ready(function() {

                            $(".delFromDoneBoardModal").click(function() {
                                var delBoardID = $(this).data('id');
                                $("#delFromDoneOnClick").attr({
                                    "onclick": "deleteBoard(" + delBoardID + ")"
                                });
                            });

                            $(".inBoardModal").click(function() {
                                var inBoardID = $(this).data('id');
                                $("#inOnClick").attr({
                                    "onclick": "inCompleteBoard(" + inBoardID + ")"
                                });
                            });
                        });

                        function deleteBoard(id) {
                            document.location.href = "/kanban/deleteBoard/" + id;
                        }

                        function inCompleteBoard(id) {
                            document.location.href = "/kanban/boardInComplete/" + id;;
                        }
                    </script>
                </td>
            </tr>

            @break @endif @endforeach @endforeach


        </tbody>
    </table>
