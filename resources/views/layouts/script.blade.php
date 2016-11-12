<?php
/**
 * Created by PhpStorm.
 * User: DNOJ
 * Date: 3/29/2016
 * Time: 9:41 PM
 */ ?>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- djQueryUI -->
<script src="/kanban/packages/jQueryUI/jquery-ui.min.js"></script>
<!-- bootstrap -->
<script src="/kanban/packages/bootstrap/js/bootstrap.min.js"></script>
<!-- moment -->
<script src="/kanban/packages/moment/moment.min.js"></script>

<!-- daterangepicker -->
<script src="/kanban/packages/daterangepicker/daterangepicker.js"></script>

<!-- datepicker -->
<script src="/kanban/packages/datepicker/bootstrap-datepicker.js"></script>

<!-- Bootstrap WYSIHTML5 -->
<script src="/kanban/packages/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<!-- Slimscroll -->
<script src="/kanban/packages/slimScroll/jquery.slimscroll.min.js"></script>

<!-- FastClick -->
<script src="/kanban/packages/fastclick/fastclick.min.js"></script>

<!-- iCheck -->
<script src="/kanban/packages/iCheck/icheck.min.js"></script>

<!-- AdminLTE App -->
<script src="/kanban/packages/bootstrapLTE/dist/js/app.min.js"></script>
<script src="/kanban/packages/bootstrapLTE/dist/js/pages/dashboard.js"></script>

<!-- DataTables -->
<script src="/kanban/packages/datatables/jquery.dataTables.min.js"></script>
<script src="/kanban/packages/datatables/dataTables.bootstrap.min.js"></script>

<!--  Autocomplete -->
<script src="/kanban/packages/EasyAutocomplete-1.3.5/jquery.easy-autocomplete.min.js"></script>


<script>
    $(document).ready(function () {

        //Date range picker
        $('#reservation').daterangepicker({format: 'YYYY/MM/DD'});


        //Date picker
        $('#datepicker').datepicker({
            autoclose: true
        });

        $("#example1").DataTable();

    });
</script>


<!--  Autocomplete -->
<script>
    $(document).ready(function () {

        var options = {
            url: "/kanban/autocomplete/member",

            getValue: "email",
            placeholder: "Email",

            template: {
                type: "description",
                fields: {
                    description: "name"
                }
            },

            list: {
                match: {
                    enabled: true
                },onSelectItemEvent: function() {
                    var index = $("#autocomplete").getSelectedItemData().id;

                    $("#index").val(index).trigger("change");
                },
                maxNumberOfElements: 10,

                showAnimation: {
                    type: "slide",
                    time: 300
                },
                hideAnimation: {
                    type: "slide",
                    time: 300
                }
            }

        };

        $("#autocomplete").easyAutocomplete(options);


    });
</script>
