@extends('layouts.layouts')
@section('content')

    <section class="au-breadcrumb m-t-75">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">

                        <a class="btn btn-primary mb-1" href="{{ url('admin/guests/add/new') }}">
                            <i class="zmdi zmdi-plus"></i> Добавить
                        </a>
                        <button type="button" class="btn btn-success mb-1" data-toggle="modal" data-target="#filterSearch">
                            <i class="zmdi zmdi-search"></i> Фильтр поиск
                        </button>

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
                    <div class="col-md-12">
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
                                <th>Check In</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($guests->count() > 0)
                                @foreach($guests as $item)
                                    <tr>
                                        <td><a href="{{ url('admin/guests/edit',$item->id) }}">
                                                {{ $item->name }}
                                            </a>
                                            @if($item->expired($item->guestTime['entry']))
                                                <h4><span class="badge badge-danger">Истёк</span></h4>
                                            @endif
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
                                        <td><a href="{{ url('admin/pdf',$item->id) }}" target="__blank">Открыть</a></td>
                                        <td>
                                            <div class="table-data-feature">

                                                <a href="#" data-toggle="modal" data-target="#checkIn" class="item passingID" data-id="{{ $item->id }}">
                                                    <i class="zmdi zmdi-check-circle " style="color:blue;"></i>
                                                </a>

                                            </div>
                                        </td>
                                        <td>
                                            <div class="table-data-feature">
                                                <a href="{{ url('admin/guests/edit',$item->id) }}" class="item" data-toggle="tooltip" data-placement="top" title="Редактировать">
                                                    <i class="zmdi zmdi-edit " style="color:green;"></i>
                                                </a>
                                                @if(\Illuminate\Support\Facades\Auth::user()->super == 1)
                                                    <a href="{{ url('admin/guests/remove',$item->id) }}" class="item" data-toggle="tooltip" data-placement="top" title="Удалить">
                                                        <i class="zmdi zmdi-delete " style="color:red;"></i>
                                                    </a>
                                                @endif
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
    <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mediumModalLabel">Добавить</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('postGuest') }}" method="POST">
                    <div class="modal-body">

                        @csrf
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name" class="form-control-label">ФИО</label>

                                    <input id="name" type="text" class="form-control" name="name" value="" placeholder="Введите ФИО" >

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="user_id">Компания</label>
                                    <select class="js-example-basic-single" name="user_id">
                                        @foreach($companies as $item)
                                            <option value="{{ $item->id }}"> {{ $item->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label >Локация</label>
                                    <select class="form-control" name="location" required>
                                        <option value="">Не выбрано</option>
                                        <option value="bpark" >Жангырхан 72Б 1-БЛОК</option>
                                        <option value="bpark-2" >Жангырхан 72Б 2-БЛОК</option>
                                        <option value="apec">Apec Petrotechnic</option>

                                    </select>
                                </div>

                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="passport" class="form-control-label">ИИН</label>

                                    <input id="passport" type="number" class="form-control" name="passport" value="" placeholder="Введите ИИН" >

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="phone" class="form-control-label">Номер телефона</label>

                                    <input id="phone" type="text" class="form-control" name="phone" value="" placeholder="Введите номер телефона" >

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="room" class="form-control-label">Комната</label>

                                    <input id="room" type="text" class="form-control" name="room" value="" placeholder="Номер комнаты" >

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="room_type">Тип комнаты</label>
                                    <select id="room_type" class="form-control" name="room_type">

                                        <option value="Общежитие" >Общежитие</option>
                                        <option value="Гостиница стандарт">Гостиница стандарт </option>
                                        <option value="Гостиница полулюкс">Гостиница полулюкс</option>
                                        <option value="Гостиница люкс">Гостиница люкс</option>
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
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="toggle-switch" data-ts-color="success">
                                            <label for="breakfast" class="ts-label">Завтрак</label>
                                            <input id="breakfast" type="checkbox" hidden="hidden" name="breakfast" value="Завтрак">
                                            <label for="breakfast" class="ts-helper"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="toggle-switch" data-ts-color="success">
                                            <label for="lunch" class="ts-label">Обед</label>
                                            <input id="lunch" type="checkbox" hidden="hidden" name="lunch" value="Обед">
                                            <label for="lunch" class="ts-helper"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="toggle-switch" data-ts-color="success">
                                            <label for="supper" class="ts-label">Ужин</label>
                                            <input id="supper" type="checkbox" hidden="hidden" name="supper" value="Ужин">
                                            <label for="supper" class="ts-helper"></label>
                                        </div>
                                    </div>
                                </div>
                                <hr>
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

    <div class="modal fade" id="filterSearch" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mediumModalLabel">Поиск по фильтрам</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('searchGuest') }}" method="post">
                    <div class="modal-body">

                        @csrf
                        <div class="row">

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
                                    <label for="room_type">Тип комнаты</label>
                                    <select id="room_type" class="form-control" name="room_type">
                                        <option value="" >Не выбрано</option>
                                        <option value="Общежитие" >Общежитие</option>
                                        <option value="Гостиница стандарт">Гостиница стандарт </option>
                                        <option value="Гостиница полулюкс">Гостиница полулюкс</option>
                                        <option value="Гостиница люкс">Гостиница люкс</option>
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- END PAGE CONTAINER-->

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
                            <input type="hidden" name="search_s" value="2">
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
    </div>

    </div>
    <!-- Modal -->
    <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reportModalLabel">Скачать репорт</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('stlngReport') }}" method="POST">
                <div class="modal-body">

                        @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="entry" class="form-control-label">От </label>

                            <input id="entry" type="date" class="form-control{{ $errors->has('entry_to') ? ' is-invalid' : '' }}" name="entry_to" >

                            @if ($errors->has('entry_to'))
                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('entry_to') }}</strong>
                                                </span>
                            @endif


                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="entry" class="form-control-label">До </label>

                            <input id="entry" type="date" class="form-control{{ $errors->has('entry_from') ? ' is-invalid' : '' }}" name="entry_from" >

                            @if ($errors->has('entry_from'))
                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('entry_from') }}</strong>
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


    <!-- Modal -->
    <div class="modal fade" id="checkIn" tabindex="-1" role="dialog" aria-labelledby="checkInLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Указать комнату</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('checkInGuest') }}" method="post">
                        @csrf

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="room" class="form-control-label">Номер комнаты </label>
                            <input type="hidden" class="form-control" name="idkl" id="idkl" value="">

                            <input id="room" type="text" required class="form-control{{ $errors->has('room') ? ' is-invalid' : '' }}" name="room" >

                            @if ($errors->has('room'))
                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('room') }}</strong>
                                                </span>
                            @endif


                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn-sm btn-primary">Сохранить</button>
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

        $(".passingID").click(function () {
            var ids = $(this).attr('data-id');

            $("#idkl").val( ids );
            $('#myModal').modal('show');
        });
    </script>
@endpush
