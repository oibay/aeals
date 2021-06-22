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
                                      <a href="{{ url('company/guests/edit',$item->id) }}">
                                        {{ $item->name }}
                                    	</a>
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

<div class="modal fade" id="filterSearch" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mediumModalLabel">Импорт</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                        @csrf
                        <div class="row">


                            <div class="col-md-12">

                                <div class="card">
                                    <div class="card-header bg-light">
                                        Импорт гостей
                                        <a href="{{ url('/public/example.xlsx') }}" class="btn btn-secondary float-right">
                                            <i class="fa fa-download"></i> &nbsp; Скачать образец
                                        </a>
                                    </div>
                                    <div class="alert alert-info pl-5">
                                        <h4>
                                            <i class="icon icon-info"></i> Внимание
                                        </h4>
                                        <ul>
                                            <li>
                                                Первая колонна должна содержать <b>ФИО</b> гостей a первая запись равна <b>fullname</b>
                                            </li>
                                            <li>
                                                Вторая колонна должна содержать <b>ИИН</b> гостей a первая запись равна <b>passport</b>
                                            </li>

                                            <li>
                                                Третья колонна должна содержать <b>Номер телефона</b> гостей a первая запись равна <b>phone</b>
                                            </li>
                                        </ul>
                                        <p>Во избежание ошибок скачайте образец</p>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('importGuest') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="file" class="form-control-label">Excel файл</label>

                                                        <input id="file" type="file" class="form-control{{ $errors->has('file') ? ' is-invalid' : '' }}" name="file" value="{{ old('file') }}" placeholder="Введите ФИО" >

                                                        @if ($errors->has('file'))
                                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('file') }}</strong>
                                                </span>
                                                        @endif
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
                                                        @if ($errors->has('location'))
                                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('location') }}</strong>
                                                </span>
                                                        @endif
                                                    </div>

                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="entry" class="form-control-label">Въезд</label>

                                                        <input id="entry" type="datetime-local" class="form-control{{ $errors->has('entry') ? ' is-invalid' : '' }}" name="entry" value="{{ old('entry') }}" >

                                                        @if ($errors->has('entry'))
                                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('entry') }}</strong>
                                                </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="departure" class="form-control-label">Отъезд</label>

                                                        <input id="departure" type="datetime-local" class="form-control{{ $errors->has('departure') ? ' is-invalid' : '' }}" name="departure" value="{{ old('departure') }}" >

                                                        @if ($errors->has('departure'))
                                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('departure') }}</strong>
                                                </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="room_type">Тип комнаты</label>
                                                        <select id="room_type" class="form-control" name="room_type" onchange="changeFunc(value);">
                                                            <option value="">Не выбрано</option>
                                                            <option value="Гостиница стандарт">Гостиница стандарт </option>
                                                            <option value="Гостиница полулюкс">Гостиница полулюкс </option>
                                                            <option value="Гостиница люкс">Гостиница люкс </option>

                                                        </select>
                                                        @if ($errors->has('room_type'))
                                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('room_type') }}</strong>
                                                </span>
                                                        @endif
                                                    </div>

                                                </div>
                                                <div class="col-md-12">
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="toggle-switch" data-ts-color="success">
                                                                <label for="breakfast1" class="ts-label">Завтрак</label>
                                                                <input id="breakfast1" type="checkbox" hidden="hidden" name="breakfast" value="Завтрак">
                                                                <label for="breakfast1" class="ts-helper"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="toggle-switch" data-ts-color="success">
                                                                <label for="lunch1" class="ts-label">Обед</label>
                                                                <input id="lunch1" type="checkbox" hidden="hidden" name="lunch" value="Обед">
                                                                <label for="lunch1" class="ts-helper"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="toggle-switch" data-ts-color="success">
                                                                <label for="supper1" class="ts-label">Ужин</label>
                                                                <input id="supper1" type="checkbox" hidden="hidden" name="supper" value="Ужин">
                                                                <label for="supper1" class="ts-helper"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary">Отправить</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>





                        </div>

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
