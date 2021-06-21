@extends('layouts.layouts')
@section('content')

    <section class="au-breadcrumb m-t-75">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">

                        <a  class="btn btn-primary mb-1" href="{{ url('admin/guests/add/new') }}">
                            <i class="zmdi zmdi-plus"></i> Добавить
                        </a>

                        <button type="button" class="btn btn-success mb-1" data-toggle="modal" data-target="#filterSearch">
                            <i class="zmdi zmdi-search"></i> Фильтр поиск
                        </button>

                        <a  class="btn btn-warning mb-1" href="{{ url('admin/report/guests') }}">
                            <i class="zmdi zmdi-download"></i> Скачать репорт
                        </a>
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
                                <th>Регистрационный лист</th>
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
                                <td><a href="{{ url('admin/pdf',$item->id) }}" target="__blank">Открыть</a></td>
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

    <div class="modal fade" id="filterSearch" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mediumModalLabel">Фильтр поиск</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('searchGuest') }}" method="post">
                <div class="modal-body">

                        @csrf
                        <div class="row">
                            <input type="hidden" name="search_s" value="1">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="user_id">Компания</label>
                                    <select class="js-example-basic-single" name="company">
                                        <option value="">Не выбрано</option>
                                        @foreach($companies as $item)
                                            <option value="{{ $item->id }}"> {{ $item->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label >Локация</label>
                                    <select class="form-control" name="location" >
                                        <option value="">Не выбрано</option>
                                        <option value="bpark" >Жангырхан 72Б 1-БЛОК</option>
                                        <option value="bpark-2" >Жангырхан 72Б 2-БЛОК</option>
                                        <option value="apec">Apec Petrotechnic</option>

                                    </select>
                                </div>

                            </div>




                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="entry" class="form-control-label">Въезд</label>

                                    <input id="entry" type="datetime-local" class="form-control" name="entry" value="" >

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="departure" class="form-control-label">Отъезд</label>

                                    <input id="departure" type="datetime-local" class="form-control" name="departure" value="" >

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="room_type">Питание</label>
                                    <select id="room_type" class="form-control" name="vouchers">
                                        <option value="" >Не выбрано</option>
                                        <option value="1" >Есть</option>


                                    </select>
                                </div>

                            </div>


                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary">Поиск</button>
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
