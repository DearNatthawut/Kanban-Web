@include("layouts.header")
@include("layouts.aside")

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

            <h3>
            @if(Auth::user()->id == $Board->manager_id) <!-- button add project  -->
                <a href="/kanban/createCard/{{$Board->id}}">
                    <button type="button" class="btn btn-primary "><i class="glyphicon glyphicon-plus"> Create Card</i>
                    </button>
                </a>

                @endif
               {{$Board->name}} {{--show name of board--}}
            </h3>

    </section>

    <section class="content">
        <div ng-view></div>
        </nav>

    </section>

</div>

</body>
@include('layouts.script')
</html>
