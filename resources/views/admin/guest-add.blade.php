@extends('layouts.layouts')
@section('content')

    <section class="au-breadcrumb m-t-75">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                       Добавить

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
                        <form action="{{ route('postGuest') }}" method="POST">
                            <div class="modal-body">

                                @csrf
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name" class="form-control-label">ФИО</label>

                                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Введите ФИО" >

                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
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
                                            @if ($errors->has('user_id'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('user_id') }}</strong>
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
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="passport" class="form-control-label">ИИН</label>

                                            <input id="passport" type="number" class="form-control{{ $errors->has('passport') ? ' is-invalid' : '' }}" name="passport" value="{{ old('passport') }}" placeholder="Введите ИИН" >

                                            @if ($errors->has('passport'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('passport') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="phone" class="form-control-label">Номер телефона</label>

                                            <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" placeholder="Введите номер телефона" >

                                            @if ($errors->has('phone'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="room" class="form-control-label">Комната</label>

                                            <input id="room" type="text" class="form-control{{ $errors->has('room') ? ' is-invalid' : '' }}" name="room" value="{{ old('room') }}" placeholder="Номер комнаты" >

                                            @if ($errors->has('room'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('room') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="room_type">Тип комнаты</label>
                                            <select id="room_type" class="form-control" name="room_type">


                                                <option value="Гостиница стандарт">Гостиница стандарт </option>
                                                <option value="Гостиница полулюкс">Гостиница полулюкс</option>
                                                <option value="Гостиница люкс">Гостиница люкс</option>
                                            </select>
                                            @if ($errors->has('room_type'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('room_type') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                    </div>

                                    <div class="col-md-12">
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

                                    <div class="col-md-12">
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

                                <button type="submit" class="btn btn-primary">Отправить</button>
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
