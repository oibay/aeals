@extends('layouts.layouts')
@section('content')

    <section class="au-breadcrumb m-t-75">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">

                        <button type="button" class="btn btn-primary mb-1" data-toggle="modal" data-target="#mediumModal">
                            <i class="zmdi zmdi-plus"></i> Добавить
                        </button>
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
                        <table id="table_id" class="display">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Название</th>
                                <th>E-mail</th>
                                <th>Роль</th>
                                <th>Дата создана</th>

                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($companies->count() > 0)
                                @foreach($companies as $item)
                            <tr>

                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->role == 'company' ? 'Компания':'' }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td></td>

                            </tr>
                                @endforeach
                            @endif

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </section>
    <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mediumModalLabel">Добавить</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('postCompany') }}" method="post">
                <div class="modal-body">

                        @csrf
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name" class="form-control-label">Название </label>

                                    <input id="name" type="text" class="form-control" name="name" value="" placeholder="Введите название" >

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name" class="form-control-label">Email </label>

                                    <input id="name" type="text" class="form-control" name="email" value="" placeholder="Введите email" >

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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
                </form>
            </div>
        </div>
    </div>



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
