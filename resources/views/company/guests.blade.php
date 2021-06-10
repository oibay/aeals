@extends('layouts.layouts')
@section('content')

    <section class="au-breadcrumb m-t-75">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">

                        <a  class="btn btn-primary mb-1" href="{{ url('company/guests/add/new') }}">
                            <i class="zmdi zmdi-plus"></i> Добавить
                        </a>

                        <button type="button" class="btn btn-success mb-1" data-toggle="modal" data-target="#filterSearch">
                            <i class="zmdi zmdi-import-export"></i> Импорт
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
                                <th>ФИО</th>
                                <th>ИИН</th>
                                <th>Компания</th>
                                <th>Номер телефона</th>
                                <th>Локация</th>
                                <th>Комната</th>
                                <th>Тип комнаты</th>
                                <th>Въезд</th>
                                <th>Отъезд</th>

                            </tr>
                            </thead>
                            <tbody>
                            @if($guests->count() > 0)
                                @foreach($guests as $item)
                            <tr>
                                <td>
                                        {{ $item->name }}
                                    </td>
                                <td>{{ $item->passport }}</td>
                                <td>{{ $item->company['name'] }}</td>
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
