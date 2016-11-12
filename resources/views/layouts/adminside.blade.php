@section("adminside")
        <!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <p>.</p>
            </div>
            <div class="pull-left info">
                <p> {{Auth::user()->name}} </p>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>

 @if(Auth::user()->Level_id != 1)
            <li>
                <a href="/kanban/home">
                    <i class="glyphicon glyphicon-blackboard"></i> <span>List of Boards </span>
                    <small class="label pull-right bg-red"></small>
                </a>
            </li>
  @endif
  @if(Auth::user()->Level_id == 1)
           <li>
               <a href="/kanban/permissions">
                   <i class="fa  fa-user"></i><span>Permissions</span>
                   <small class="label pull-right bg-red"></small>
               </a>
           </li>
  @endif
            <li>
                <a href="/kanban/managementAccount">
                    <i class="glyphicon glyphicon-wrench"></i><span>Management account</span>
                    <small class="label pull-right bg-red"></small>
                </a>
            </li>
            <li>
                <a href="/kanban/help">
                    <i class="glyphicon glyphicon-info-sign"></i> <span>Help</span>
                    <small class="label pull-right bg-red"></small>
                </a>
            </li>
            <li>
                <a href="/kanban/contact">
                    <i class="glyphicon glyphicon-phone-alt"></i> <span>Contact</span>
                    <small class="label pull-right bg-red"></small>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
</div><!-- ./wrapper -->
@show
