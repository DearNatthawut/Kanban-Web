@include("layouts.header")
@include("layouts.adminside")


<div class="content-wrapper">

    <section class="content">

        <div class="col-md-12 col-sm-4">
            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="page-header">
                        <h2>Create Project</h2>
                        <br>
                    </div>
                    <div>
                        <!-- form start -->
                        <form class="form-horizontal" method="post" action="/kanban/createBoard">

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="box-body">
                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                                               required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="detail" class="col-sm-2 control-label">Detail</label>
                                    <div class="col-sm-10">
                                        <textarea id="detail" name="detail" class="form-control" rows="5"
                                                  placeholder="Detail"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="worklimit" class="col-sm-2 control-label">Work limit</label>
                                    <div class="col-sm-10">
                                        <input type="number" id="worklimit" name="worklimit" value="5" class="form-control"
                                               min="0" max="10" placeholder="Work limit"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="reservation" class="col-sm-2 control-label">Estimate Date</label>
                                    <div class="col-sm-10 ">
                                        <input type="text" name="date" class="form-control " id="reservation"
                                               placeholder="Estimate Date" required>
                                    </div>
                                    <!-- /.input group -->

                                </div>
                              

                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <a href="/kanban/home">
                                    <button type="button" class="btn btn-default pull-right">Cancel</button>
                                </a>

                                <button type="submit" class="btn btn-primary pull-right">Submit</button>

                            </div><!-- /.box-footer -->
                        </form>
                    </div><!-- /.box -->
                </div>

            </div>

        </div>

    </section>


</div>

</body>
@include('layouts.script')
</html>
