@extends('layouts.layouts')
@section('content')

    <section class="au-breadcrumb m-t-75">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @if($eventArchive == 1)
                            Питание Архив
                        @else

                            <button type="button" class="btn btn-primary mb-1"  @if($eventNowExists) disabled @else @endif data-toggle="modal" data-target="#mediumModal">
                                <i class="zmdi zmdi-plus"></i> Добавить
                            </button>
                        @endif
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
                        <table id="table_id" class="display">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Название</th>
                                <th>Статус</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($event->count() > 0)
                                @foreach($event as $item)
                            <tr>

                                        <td>{{ $loop->index + 1 }}</td>
                                        <td style="font-size: 18px;">Питание #{{ $item->title }}</td>
                                        <td><h2><span class="badge badge-success">Активен</span></h2></td>
                                        <td><a href="{{ url('admin/event/view',$item->id) }}" style="font-size: 18px;">Открыть</a></td>


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
                <form action="{{ route('postEvent') }}" method="post">
                <div class="modal-body">

                        @csrf
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name" class="form-control-label">Название </label>

                                    <input id="name" type="text" class="form-control" name="title" value="{{ date('Y-m-d') }}"  disabled>

                                </div>
                            </div>

                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary">Отправить</button>
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
