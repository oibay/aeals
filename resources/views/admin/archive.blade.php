@extends('layouts.layouts')
@section('content')

    <section class="au-breadcrumb m-t-75">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        Архивы


                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#reportModal">
                            <i class="zmdi zmdi-download"></i> Скачать репорт
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
                                <th>ФИО</th>
                                <th>ИИН</th>
                                <th>Компания</th>
                                <th>Номер телефона</th>
                                <th>Локация</th>
                                <th>Комната</th>
                                <th>Тип комнаты</th>
                                <th>Въезд</th>
                                <th>Отъезд</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($guests->count() > 0)
                                @foreach($guests as $item)
                                    <tr>
                                        <td><a href="{{ url('admin/guests/edit',$item->id) }}">
                                                {{ $item->name }}
                                            </a></td>
                                        <td>{{ $item->passport }}</td>
                                        <td>{{ $item->company['name'] ?? '' }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>

                                            @if($item->location == 'apec')
                                                Apec Petrotechnic
                                            @elseif($item->location == 'bpark')
                                                Жангырхан 72Б 1 БЛОК
                                            @elseif($item->location == 'bpark-2')
                                                Жангырхан 72Б 2 БЛОК
                                            @endif
                                        </td>
                                        <td>

                                            @if($item->room)
                                                {{ $item->room }}
                                            @else
                                                <span class='badge badge-danger'>Не Указано</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->room_type }}</td>
                                        <td>{{ $item->guestTime['entry'] }}</td>
                                        <td>{{ $item->guestTime['departure'] }}</td>
                                        <td>
                                            <div class="table-data-feature">
                                                <a href="{{ url('admin/guests/edit',$item->id) }}" class="item" data-toggle="tooltip" data-placement="top" title="Редактировать">
                                                    <i class="zmdi zmdi-edit " style="color:green;"></i>
                                                </a>
                                            </div>
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


    <!-- END PAGE CONTAINER-->
    </div>

    </div>
    <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reportModalLabel">Скачать репорт</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('archiveReport') }}" method="POST">
                    <div class="modal-body">

                        @csrf
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="entry" class="form-control-label">Дата въезда </label>

                                <input id="entry" type="date" class="form-control{{ $errors->has('entry') ? ' is-invalid' : '' }}" name="entry" >

                                @if ($errors->has('entry'))
                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('entry') }}</strong>
                                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="entry" class="form-control-label">Дата отъезда </label>

                                <input id="entry" type="date" class="form-control{{ $errors->has('departure') ? ' is-invalid' : '' }}" name="departure" >

                                @if ($errors->has('departure'))
                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('departure') }}</strong>
                                                </span>
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-primary">Скачать</button>
                    </div>
                </form>
            </div>
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
