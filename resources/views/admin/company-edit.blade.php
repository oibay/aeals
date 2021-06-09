@extends('layouts.layouts')
@section('content')

    <section class="au-breadcrumb m-t-75">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        {{ $user->name }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="m-t-10">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        @include('message')
                        <form action="{{ route('postEditCompany',$user->id) }}" method="post">
                            <div class="modal-body">

                                @csrf
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name" class="form-control-label">Название </label>

                                            <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" placeholder="Введите название" >

                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name" class="form-control-label">Email </label>

                                            <input id="name" type="text" class="form-control" name="email" value="{{ $user->email }}" placeholder="Введите email" >

                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name" class="form-control-label">Пароль </label>

                                            <input id="name" type="password" class="form-control" name="password" value=""  >

                                        </div>
                                    </div>



                                </div>

                            </div>
                            <div class="modal-footer">

                                <button type="submit" class="btn btn-primary">Сохранить</button>
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
