<?php
/**
 * Created by PhpStorm.
 * User: DNOJ
 * Date: 4/16/2016
 * Time: 2:36 AM
 */

?>

    <table class="table table-striped table-hover">
        <tbody>

            @foreach($allBoards as $Board) @if($Board->manager['id'] == Auth::user()->id && $Board->status_complete == 0 && $Board->board_hide == 0)

            <tr>
                <td>
                    <span>Name board : {{$Board->name}} </span>
                    <br>
                    <span>Detail : {{$Board->detail}} </span>
                    <br>
                    <span>Manager : {{$Board->manager['name']}} </span>
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


                    <a href="/kanban/editBoard/{{$Board->id}}">
                        <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-edit"></span> Edit</button>
                    </a>

                    <button type="button" class="delBoardModal btn btn-danger" data-id="<?php echo(json_encode($Board->id)); ?>" data-toggle="modal" data-target="#delBoardModal">
                        <span class="glyphicon glyphicon-trash"></span> Delete
                    </button>


                    <!-- Start deleteBoard Model -->
                    <div id="delBoardModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Confirm move this board to bin ?</h4>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-danger pull-right" data-dismiss="modal">Cancel</button>
                                    <button class="btn btn-primary" id="delOnClick">Submit</button>
                                </div>
                            </div>

                        </div>
                    </div>

                    <script>
                        $(document).ready(function() {

                            $(".delBoardModal").click(function() {
                                var delBoardID = $(this).data('id');
                                $("#delOnClick").attr({
                                    "onclick": "deleteBoard(" + delBoardID + ")"
                                });
                            });
                        });

                        function deleteBoard(id) {
                            document.location.href = "/kanban/deleteBoard/" + id;
                        }
                    </script>
                </td>
            </tr>


            @endif @endforeach


        </tbody>
    </table>
