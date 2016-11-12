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

    @foreach($allBoards as $Board) <!-- loop Board-->
        @foreach($Board->members as $memManager => $mem) <!-- loop member-->
            @if(($mem->id == Auth::user()->id || Auth::user()->Level_id == 1 )
              && Auth::user()->id != $Board->manager['id']
            &&  $Board->membersManager[$memManager]->active == 0
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


                    </td>
                </tr>

                @break
            @endif
        @endforeach
    @endforeach


    </tbody>
</table>
