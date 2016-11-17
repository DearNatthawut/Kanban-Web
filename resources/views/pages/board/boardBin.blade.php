<?php
/**
 * Created by PhpStorm.
 * User: DNOJ
 * Date: 4/16/2016
 * Time: 2:36 AM
 */?>

    <table class="table table-striped table-hover">
        <tbody>

            @foreach($allBoards as $Board) @if($Board->manager['id'] == Auth::user()->id && $Board->board_hide == 1)

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
                        <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-eye-open"></span>View
                        </button>
                    </a>
                    <a href="/kanban/member/{{$Board->id}}">
                        <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-user"></span>Member
                        </button>
                    </a>
                    <a href="/kanban/showGantt/{{$Board->id}}">
                        <button type="button" class="btn btn-default"><i class="fa  fa-bar-chart"></i>Gantt Chart
                        </button>
                    </a>

                    <a href="/kanban/editBoard/{{$Board->id}}">
                        <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-edit"></span>Edit
                        </button>
                    </a>

                    <button type="button" class="reBoardModal btn btn-info" data-id="<?php echo(json_encode($Board->id)); ?>" data-toggle="modal" data-target="#reBoardModal">Restore
                    </button>

                    <button type="button" class="hardDelModal btn btn-danger" data-id="<?php echo(json_encode($Board->id)); ?>" data-toggle="modal" data-target="#hardDelModal">
                        <span class="glyphicon glyphicon-remove-circle"></span> Delete
                    </button>

                    @endif @endforeach
        </tbody>
    </table>

    <!-- Start restoreBoard Model -->
    <div id="reBoardModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Confirm Restore this board ?</h4>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger pull-right" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" id="reOnClick">Submit</button>
                </div>
            </div>

        </div>
    </div>

    <!-- Start hardDel Board Model -->
    <div id="hardDelModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Confirm Delete this Board !!</h4>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger pull-right" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" id="hardDelOnClick">Submit</button>
                </div>
            </div>

        </div>
    </div>

    <script>
        $(document).ready(function() {

            $(".reBoardModal").click(function() {
                var reBoardID = $(this).data('id');
                $("#reOnClick").attr({
                    "onclick": "restoreBoard(" + reBoardID + ")"
                });
            });

            $(".hardDelModal").click(function() {
                var hardDelBoardID = $(this).data('id');
                $("#hardDelOnClick").attr({
                    "onclick": "hardDeleteBoard(" + hardDelBoardID + ")"
                });
            });
        });

        function restoreBoard(id) {
            document.location.href = "/kanban/restoreBoard/" + id;
        }

        function hardDeleteBoard(id) {
            document.location.href = "/kanban/hardDeleteBoard/" + id;
        }
    </script>
    </td>
    </tr>
