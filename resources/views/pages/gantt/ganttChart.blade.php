<?php
/**
 * Created by PhpStorm.
 * User: DNOJ
 * Date: 4/19/2016
 * Time: 11:22 PM
 */ ?>

@include("layouts.header")
@include("layouts.aside")


<div class="content-wrapper">

    <section class="content">
        <div class="col-md-12 col-sm-4">
            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="page-header">
                        <h2>
                            <i class="fa  fa-bar-chart"></i> Gantt
                        </h2>
                    </div>
                    <table class="table table-bordered">
                        <tbody>

                        <tr>
                            <td>
                                <center><span class="badge" style="background-color:#2196F3">Activities</span></center>
                            </td>
                            <td><label>เวลากิจกรรมหรือการ์ดที่ได้วางแผนไว้</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <center><span class="badge" style="background-color:#008000">Activities</span></center>
                            </td>
                            <td><label>กิจกรรมหรือการ์ดนั้นเสร็จในเวลาที่กำหนด</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <center><span class="badge" style="background-color:#FFA500">Activities</span></center>
                            </td>
                            <td><label> กิจกรรมหรือการ์ดนั้นเสร็จแล้วแต่เกินเวลาที่กำหนด</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <center><span class="badge" style="background-color:#FF0000">Activities</span></center>
                            </td>
                            <td><label> กิจกรรมหรือการ์ดนั้นยังไม่เสร็จและเกินเวลาที่กำหนด</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <center><span class="badge" style="background-color:#00CCFF">Activities</span></center>
                            </td>
                            <td><label> กิจกรรมหรือการ์ดนั้นยังไม่เสร็จแล้วยังทำต่อภายในเวลาที่กำหนด</label>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!---ตารางบอกสีแก้น-------------------------->
        <div class="col-md-12 col-sm-4">
            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="page-header">
                        <h2>Gantt Chart
                            <small>( {{$Board->name}} )</small>
                        </h2>

                        <h2>Plan</h2>

                    </div>
                    <div ng-controller="GanttCtrlEstimate as vmEstimate" >
                        <div gantt data=vmEstimate.dataEstimate column-width="40"  current-date="column" current-date-value="vmEstimate.newDate">

                            <gantt-table></gantt-table>
                            {{--<gantt-movable></gantt-movable>
                            <gantt-tooltips></gantt-tooltips>--}}
                        </div>

                    </div>

                </div>
            </div>

        </div>
        <div class="col-md-12 col-sm-4">
            <div class="panel panel-default">

                <div class="panel-body">
                    <h2>Actual</h2>
                    <div ng-controller="GanttCtrlActual as vmActual">
                        <div gantt data=vmActual.dataActual  column-width="40" current-date="column" >
                            <gantt-table></gantt-table>
                            {{--<gantt-movable></gantt-movable>
                            <gantt-tooltips></gantt-tooltips>--}}
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-12 col-sm-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="box-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <center>
                                    <th>Work activities</th>
                                </center>
                                <center>
                                    <th>Owner</th>
                                </center>
                                <center>
                                    <th>Plan Start-End</th>
                                </center>
                                <center>
                                    <th>Actual Start-End</th>
                                </center>
                                <center>
                                    <th>Times editor</th>
                                </center>
                                <center>
                                    <th>Complete Status</th>
                                </center>
                                <center>
                                    <th>Time</th>
                                </center>
                            </tr>
                            </thead>

                            <tbody>

                            @foreach($Card as $Card) {{--time of edit card--}}
                            <?php $count = 0; ?>
                            @foreach($Card['comments'] as $Comments)
                                @if($Comments->edit_status == 1)
                                    <?php $count++; ?>
                                @endif
                            @endforeach

                            <tr>
                                <td> {{$Card->name}}</td>

                                <td>{{$Card['memberCard']['member']->name}}</td>

                                <td> {{$Card->estimate_start}}---{{$Card->estimate_end}}</td>

                                <td> {{$Card->date_start}}---{{$Card->date_end}}</td>

                                <td>
                                    <center>{{$count}}</center>
                                </td>

                                @if($Card->status_complete == 1)
                                    <td>
                                        <center><span class="glyphicon glyphicon-ok"></span></center>
                                    </td>
                                @else
                                    <td>
                                        <center><span class="glyphicon glyphicon-remove"></span></center>
                                    </td>
                                @endif
                                <td>
                                    @if($Card->status_complete == 1)

                                        @if($Card->date_end <= $Card->estimate_end)
                                            <center>On Time</center>
                                        @else
                                            <center>Over Time</center>
                                        @endif

                                    @elseif($Card->status_complete == 0)

                                        @if( date('Y-m-d') <= $Card->estimate_end)
                                            <center>On Time</center>
                                        @else
                                            <center>Over Time</center>
                                        @endif


                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>


</div>

</body>

@include('layouts.script')

<style>
    .gantt-green {
        color: white;
    }
</style>

<script type="text/javascript">
    // dataEstimate
    var myApp = angular.module('kanban');
    myApp.controller('GanttCtrlEstimate', ['$scope', '$http', function ($scope, $http) {
        var self = this;

        self.newDate = Date.now();

        $http({
            method: 'GET',
            url: '/kanban/current-board/cards'
        }).success(function (r) {

            { // dataEstimate
                var row = [];
                for (i = 0; i < r.length; i++) {
                    var rownew = [];
                    rownew.name = r[i].name;
                    if (r[i].estimate_start != null) {           //-----plan start
                        r[i].from = r[i].estimate_start;
                        r[i].color = '#2196F3'
                    }
                    if (r[i].estimate_end != null) {
                        r[i].to = r[i].estimate_end;             //-----plan end
                        r[i].color = '#2196F3'
                    }
                    rownew.tasks = [r[i]];

                    row.push(rownew)
                }

                self.dataEstimate = row;
            }


        })

    }]);
    //dataActual
    myApp.controller('GanttCtrlActual', ['$scope', '$http', function ($scope, $http) {
        var self = this;
        self.newDate = Date.now();
        $http({
            method: 'GET',
            url: '/kanban/current-board/cards'
        }).success(function (r) {
            //console.log(r);

            { // data actual
                var row = [];
                for (i = 0; i < r.length; i++) {

                    var rownewA = [];
                    rownewA.name = r[i].name;

                    if (r[i].date_start != null) { //---- งานเริ่มไปแล้ว ?
                        r[i].from = r[i].date_start
                    }

                    if (r[i].date_end != null && r[i].status_complete == 1) { //------ งานเสร็จแล้ว?

                        r[i].to = r[i].date_end;

                        if (r[i].date_end > r[i].estimate_end) { //date_end เกิน estimate_end
                            r[i].color = '#FFA500';       // เสร็จแล้วแต่เวลาเกิน  //--สีเป็นสีส้ม
                        } else  {
                            r[i].color = '#008000';
                            r[i].classes= 'gantt-green';
                        }    //เสร็จตามเวลาที่กำหนด //--เป็นสีเขียว

                    } else {

                        r[i].to = Date.now();

                        if (Date.now() > r[i].estimate_end) { // -------------งานที่ยังไม่เสร็จและเวลาเกิน

                            r[i].color = '#FF0000'; //งานยังไม่เสร็จและเกินเวลา สีแดง

                        } else  r[i].color = '#00CCFF'; //งานยังไม่เสร็จและเวลาเกินกำหนดแต่ยังทำต่อ สีนาวี่


                    }
                    rownewA.tasks = [r[i]];
                    row.push(rownewA)
                }
                self.dataActual = row;
            }
        })

    }]);

</script>


</div>

</body>
@include('layouts.script')
</html>
