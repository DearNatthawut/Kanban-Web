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

    @foreach($allBoards as $Board)

            @if($Board->manager['id'] == Auth::user()->id
            && $Board->status_complete == 0 && $Board->board_hide == 0)

                <tr>
                    <td >
                        <span>Name board : {{$Board->name}} </span>
                        <br>
                        <span>Detail : {{$Board->detail}} </span>
                        <br>
                        <span>Manager : {{$Board->manager['name']}} </span>
                        <br>
                        <span>Member : {{count($Board->members)}}</span>
                    </td>
                    <td >
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

                        <button type="button" class="btn btn-danger" onclick="deleteBoard(<?php echo(json_encode($Board->id)); ?>)">
                            <span class="glyphicon glyphicon-trash"></span>  Delete
                        </button>



                        <script>
                            function deleteBoard(id) {

                                if (confirm("Confirm move this board to bin!") == true) {

                                    document.location.href = "/kanban/deleteBoard/" + id;
                                }
                            }
                        </script>
                    </td>
                </tr>


            @endif

    @endforeach


    </tbody>
</table>
