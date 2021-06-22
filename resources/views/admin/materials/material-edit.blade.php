@extends('layouts.layouts')
@section('content')

    <section class="au-breadcrumb m-t-75">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        Редактировать : <strong>{{ $material->title }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="m-t-10">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-6">
                        @include('message')
                        <form action="{{ route('postEditMaterial',$material->id) }}" method="post">
                            <div class="modal-body">

                                @csrf
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name" class="form-control-label">Название </label>

                                            <input id="name" type="text" class="form-control" name="title" value="{{ $material->title }}" placeholder="Введите название" >

                                        </div>
                                    </div>




                                </div>

                            </div>
                            <div class="modal-footer">

                                <button type="submit" class="btn btn-primary">Редактировать</button>
                            </div>
                        </form>
                    </div>

                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- END PAGE CONTAINER-->
    </div>

    </div>
@endsection
@push('js')
    <script>
        $(document).ready( function () {
            $('#table_id').DataTable();
        } );
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
@endpush
