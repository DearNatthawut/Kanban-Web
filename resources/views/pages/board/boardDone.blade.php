<?php
/**
 * Created by PhpStorm.
 * User: DNOJ
 * Date: 4/16/2016
 * Time: 2:36 AM
 */?>

<table class="table table-striped table-hover">
    <tbody>

    @foreach($allBoards as $Board)
        @foreach($Board->members as $mem)
            @if(($mem->id == Auth::user()->id || Auth::user()->Level_id == 1) && $Board->status_complete == 1 && $Board->board_hide == 0)

                <tr>
                    <td >
                        <span>Name board : {{$Board->name}} </span>
                        <br>
                        <span>Detail : {{$Board->detail}} </span>
                        <br>
                        <span>Manager :{{$Board->manager['name']}} </span>
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

                        @if(Auth::user()->id == $Board->manager['id']) <!--            เงื่อนไข แก้ไข และ ลบ -->

                            <a href="/kanban/editBoard/{{$Board->id}}">
                                <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-edit"></span> Edit</button>
                            </a>

                            <button type="button" class="btn btn-info" onclick="inCompleteBoard()">
                                InComplete
                            </button>

                            <button type="button" class="btn btn-danger" onclick="deleteBoard()">
                                <span class="glyphicon glyphicon-trash"></span>  Delete
                            </button>

                        @endif

                        <script>
                            function deleteBoard() {

                                if (confirm("Confirm Delete this Board!") == true) {
                                    document.location.href = "/kanban/deleteBoard/{{$Board->id}}";
                                }
                            }
                            function inCompleteBoard() {

                                if (confirm("Confirm Change Status  Board To InComplete ?") == true) {
                                    document.location.href = "/kanban/boardInComplete/{{$Board->id}}";
                                }
                            }
                        </script>
                    </td>
                </tr>

                @break
            @endif
        @endforeach
    @endforeach


    </tbody>
</table>
