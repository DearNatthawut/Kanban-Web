<?php
/**
 * Created by PhpStorm.
 * User: DNOJ
 * Date: 4/19/2016
 * Time: 11:22 PM
 */ ?>

@include("layouts.header")
@include("layouts.adminside")


<div class="content-wrapper">
<!------------------------------------------------------------------Main-------------------------------------------------------->
    <section class="content">
        <div class="col-md-12 col-sm-4">
            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="page-header">
                        <h2>
                            <i class="glyphicon glyphicon-info-sign"></i>  HELP
                        </h2>
                    </div>
                    <table class="table table-bordered">
                        <tbody >
                        <tr>
                            <td>
                                <i class="glyphicon glyphicon-blackboard"></i> <span>List of Boards </span>
                            </td>
                            <td><label>รายชื่อของโครงการทั้งหมด</label></td>
                        </tr>
                        <tr>
                            <td>
                                <i class="glyphicon glyphicon-blackboard"></i> <span> Boards </span>
                            </td>
                            <td><label>หน้าแสดงการจัดการโครงการหรือบอร์ด</label></td>
                        </tr>
                        <tr>
                            <td>
                                <i class="fa  fa-user"></i> <span>Member</span>
                            </td>
                            <td><label>รายชื่อสมาชิกที่ใช้ระบบ</label></td>
                        </tr>
                        <tr>
                            <td>
                                <i class="fa  fa-bar-chart"></i> <span>Gantt</span>
                            </td>
                            <td><label>ส่วนการแสดง Gantt Chart</label></td>
                        </tr>
                        <tr>
                            <td>
                                <i class="fa fa-cogs"></i> <span>Edit</span>
                            </td>
                            <td><label>การตั้งค่าและแก้ไขโครงการหรือบอร์ด</label></td>
                        </tr>
                        <tr>
                            <td>
                                <i class="glyphicon glyphicon-info-sign"></i> <span>Help</span>
                            </td>
                            <td><label>การช่วยเหลือเกี่ยวกับการใช้งานระบบ</label></td>
                        </tr>
                        <tr>
                            <td>
                                <i class="glyphicon glyphicon-wrench"></i> <span>Forgotten account</span>
                            </td>
                            <td><label>เปลี่ยน ชื่อ อีเมล์ รหัสผ่าน</label></td>
                        </tr>
                        <tr>
                            <td>
                                <i class="glyphicon glyphicon-phone-alt"></i> <span>Contact</span>
                            </td>
                            <td><label>ติดต่อผู้ดูแลระบบ</label></td>
                        </tr>
                        <tr>
                            <td>
                                <span class="glyphicon glyphicon-log-out">Singout</span>
                            </td>
                            <td><label>ออกจากระบบ</label></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-------------------------------------------------------------------------------------------------------->
        <div class="col-md-12 col-sm-4">
            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="page-header">
                        <h2>
                            Board
                        </h2>
                    </div>
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <td>
                                <label class="default"> <i class="glyphicon glyphicon-plus">Create Board</i></label>
                            </td>
                            <td><label>สร้างโครงการหรือบอร์ด</label></td>
                        </tr>
                        <tr>
                            <td>
                                <label class="default"> <span class="glyphicon glyphicon-eye-open"></span> View </label>
                            </td>
                            <td><label>เข้าสู่หน้าจัดการโครงการ</label></td>
                        </tr>
                        <tr>
                            <td>
                                <label class="default"> <span class="glyphicon glyphicon-user"></span> Member </label>
                            </td>
                            <td><label>สมาชิกภายในโครงการ</label></td>
                        </tr>
                        <tr>
                            <td>
                                <label class="default"><i class="fa  fa-bar-chart"> Gantt Chart</i></label>
                            </td>
                            <td><label>แสดงการทำงานที่วางแผนไว้กับเวลาที่ทำงานจริง</label></td>
                        </tr>
                        <tr>
                            <td>
                                <label class="default"><span class="glyphicon glyphicon-trash"></span>  Delete</label>
                            </td>
                            <td><label>ลบโครงการหรือบอร์ด</label></td>
                        </tr>
                        <tr>
                            <td>
                                <label class="default"> Restore</label>
                            </td>
                            <td><label>นำโครงการกลับมาใหม่</label></td>
                        </tr>
                        <tr>
                            <td>
                                <label class="default"> Project Complete ?</label>
                            </td>
                            <td><label>เมื่อกิจกรรมการทำงานหรือการ์ดถูกย้ายไปที่ Done หมดแล้ว ปุ่ม Project Complete ? จะปรากฏขึ้นมา</label></td>
                        </tr>
                        <tr>
                            <td>
                               <label class="default"> Project Incomplete ?</label>
                            </td>
                            <td><label>เมื่อกิจกรรมการทำงานหรือการ์ดถูกย้ายไปที่ Done หมดแล้ว กดปุ่ม Project Complete ? ไปแล้ว และจำนำโครงการกลับมาทำใหม่ ปุ่ม Project Incomplete ? จะปรากฏขึ้นมา</label></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
<!----------------------------------------------Card-------------------------------------------------------------->
        <div class="col-md-12 col-sm-4">
            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="page-header">
                        <h2>
                            Card
                        </h2>
                    </div>
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <td>
                                <center><label class="default"><i class="glyphicon glyphicon-plus"> Create Card </i>
                                    </label></center>
                            </td>
                            <td><label>ลำดับความสำคัญของงาน</label></td>
                        </tr>
                        <tr>
                            <td>
                                <center><span class="glyphicon glyphicon-star" style="color: gold;"></span></center>
                            </td>
                            <td><label>ลำดับความสำคัญของงาน</label></td>
                        </tr>
                        <tr>
                            <td>
                                <center><span class="glyphicon glyphicon-edit"></span></center>
                            </td>
                            <td><label>แก้ไขการ์ดการทำงานที่ต้องการย้อนกลับไปในขั้นตอนการทำงานก่อนหน้า</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <center><span class="glyphicon  glyphicon-cog"></span></center>
                            </td>
                            <td><label>การตั้งค่าเกี่ยวกับกิจกรรมหรือการ์ดใบนั้น</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <center><span class="glyphicon glyphicon-remove"></span></center>
                            </td>
                            <td><label>ลบกิจกรรมหรือการ์ดใบนั้น</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <center><span class="label label-danger"> <span class="glyphicon glyphicon-time"></span> Over time  </span>
                                </center>
                            </td>
                            <td><label>กิจกรรมหรือการ์ดนั้นเกินเวลาที่กำหนด</label>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!----------------------------------------------Gantt---------------------------------------------!-->
        <div class="col-md-12 col-sm-4">
            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="page-header">
                        <h2>
                            Gantt
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
                        <tr>
                            <td>
                                <center><span>Work activities</span></center>
                            </td>
                            <td><label> กิจกรรมหรือการ์ดของโครงการทั้งหมด</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <center><span>Owner</span></center>
                            </td>
                            <td><label>ผู้รับผิดชอบกิจกรรมหรือการ์ด</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <center><span>Plan Start-End</span></center>
                            </td>
                            <td><label>เวลาที่เริ่มวางแผนการทำงานและเวลาสิ้นสุดการทำงาน</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <center><span>Actual Start-End</span></center>
                            </td>
                            <td><label>เวลาที่ผู้รับผิดชอบงานได้เริ่มทำงานจริงและเวลาสิ้นสุดการทำงานจริง</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <center><span>Times editor</span></center>
                            </td>
                            <td><label>จำนวนการย้ายกิจกรรมหรือการ์ด เป็นรอบการทำงาน</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <center><span>Complete Status</span></center>
                            </td>
                            <td><label>กิจกรรมหรือการ์ดเสร็จสิ้นหรือไม่</label>
                            </td>
                        </tr>
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </section>
</div>

</body>

@include('layouts.script')

</html>
