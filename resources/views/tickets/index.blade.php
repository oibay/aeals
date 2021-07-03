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
                    @include('message')
                        <table id="table_id" class="display">
                            <thead>
                            <tr>

                                <th>Дата</th>
                                <th>Отдел</th>
                                <th>Описание</th>
                                <th>Статус</th>
                                <th>Время</th>
                                <th></th>

                            </tr>
                            </thead>
                            <tbody>
                            @if($ticket->count() > 0)
                                @foreach($ticket as $item)
                            <tr>

                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->dep['title'] }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>
                                            @if($item->status == 0)
                                                <h3><span class="badge bg-danger" style="color:White;border-radius: 100px;">Ожидает</span></h3>
                                            @elseif($item->status == 1)
                                                <h3><span class="badge bg-success" style="color:White;border-radius: 100px;">Закрыт</span></h3>
                                            @endif
                                        </td>
                                        <td>
                                            Прошло: <h4><span class="badge bg-warning" style="color:White;border-radius: 100px;">
                                                            {{ round(abs(time() - strtotime($item->created_at)) / 60). " минут" }}
                                                        </span></h4>
                                        </td>
                                        <td>
                                            @if($item->status == 0)
                                                <a href="{{ url('tickets/approve',$item->id) }}" class="btn btn-primary"> Подтвердить <i class="zmdi zmdi-check-circle" style="font-size: 20px"></i></a>
                                            @endif
                                        </td>

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
                <form action="{{ route('postAddRequestToForm') }}" method="post">
                <div class="modal-body">

                        @csrf
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name" class="form-control-label">Отдел </label>

                                    <select name="dep_id" id="" class="form-control">
                                        @foreach($department as $dep)
                                            <option value="{{ $dep->id }}"> {{ $dep->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Описание</label>
                                    <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                            </div>




                        </div>

                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-success">Создать</button>
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
