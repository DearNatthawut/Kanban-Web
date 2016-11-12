@include("layouts.header")
@include("layouts.aside")

<div class="content-wrapper">

    <section class="content">

        <div class="col-md-12 col-sm-4">
            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="page-header">
                        <h2><i class="fa fa-cogs"></i> Edit
                            <small>( {{$Board->name}} )</small>
                        </h2>
                        <br>


                    </div>
                    <div>
                        <!-- form start -->
                        <form class="form-horizontal" method="post" action="/kanban/editBoard">

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" value="{{$Board->id}}">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Name"
                                               value="{{$Board->name}}" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="detail" class="col-sm-2 control-label">Detail</label>
                                    <div class="col-sm-10">
                                        <textarea id="detail" name="detail" class="form-control" rows="5"
                                                  placeholder="Detail">{{$Board->detail}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="worklimit" class="col-sm-2 control-label">Work limit</label>
                                    <div class="col-sm-10">
                                        <input type="number" id="worklimit" name="worklimit" class="form-control"
                                               min="0" max="10" placeholder="Work limit" value="{{$Board->worklimit}}"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="reservation" class="col-sm-2 control-label">Estimate Date</label>
                                    <div class="col-sm-10 ">
                                        <input type="text" name="date" class="form-control " id="reservation"
                                               placeholder="Estimate Date" value="{{$dateStart}} - {{$dateEnd}}"
                                               required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Actual" class="col-sm-2 control-label">Actual Date</label>
                                    <div class="col-sm-10 ">
                                        <input type="text" name="dateAC" class="form-control " id="Actual"
                                               placeholder="Actual Date" value="{{$dateStartAC}} - {{$dateEndAC}}"
                                               disabled>
                                    </div>
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
