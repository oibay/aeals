@extends('layouts.layouts')
@section('content')

    <section class="au-breadcrumb m-t-75">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        {{ $guest->name }}

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
                        <form action="{{ route('postEditGuest',$guest->id) }}" method="post">
                            @csrf
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name" class="form-control-label">ФИО</label>

                                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $guest->name }}" placeholder="Введите ФИО" >

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
                                        <select id="user_id" class="form-control{{ $errors->has('user_id') ? ' is-invalid' : '' }}" name="user_id" value="{{ $guest->user_id }}" >
                                            @if ($companies)
                                                @foreach ($companies as $company)
                                                    <option value="{{ $company->id }}" {{ ($guest->user_id === $company->id) ? 'selected' : ''}}>
                                                        {{ $company->name }}</option>
                                                @endforeach
                                            @endif
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

                                        <option value="bpark" @if($guest->location == 'bpark') selected @endif>Жангырхан 72Б 1-БЛОК</option>
                                        <option value="bpark-2" @if($guest->location == 'bpark-2') selected @endif>Жангырхан 72Б 2-БЛОК</option>
                                        <option value="apec" @if($guest->location == 'apec') selected @endif>Apec Petrotechnic</option>

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

                                    <input id="passport" type="number" class="form-control{{ $errors->has('passport') ? ' is-invalid' : '' }}" name="passport" value="{{ $guest->passport }}" placeholder="Введите ИИН" >

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

                                    <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ $guest->phone }}" placeholder="Введите номер телефона" >

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

                                    <input id="room" type="text" class="form-control{{ $errors->has('room') ? ' is-invalid' : '' }}" name="room" value="{{ $guest->room }}" placeholder="Номер комнаты" >

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
                                    <select id="room_type" class="form-control{{ $errors->has('room_type') ? ' is-invalid' : '' }}" name="room_type" value="{{ old('room_type') }}" >
                                        <option value="">Не выбрано</option>
                                        <option value="Общежитие" {{ ($guest->room_type === 'Общежитие') ? 'selected' : ''}}>Общежитие</option>
                                        <option value="Гостиница стандарт" {{ ($guest->room_type === 'Гостиница стандарт') ? 'selected' : ''}}>Гостиница стандарт </option>
                                        <option value="Гостиница полулюкс" {{ ($guest->room_type === 'Гостиница полулюкс') ? 'selected' : ''}}>Гостиница полулюкс</option>
                                        <option value="Гостиница люкс" {{ ($guest->room_type === 'Гостиница люкс') ? 'selected' : ''}}>Гостиница люкс</option>
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

                                    <input id="entry" type="datetime-local" class="form-control{{ $errors->has('entry') ? ' is-invalid' : '' }}" name="entry" value="{{ date('Y-m-d\TH:i', strtotime($guest->guestTime['entry'])) }}" >

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

                                    <input id="departure" type="datetime-local" class="form-control{{ $errors->has('departure') ? ' is-invalid' : '' }}" name="departure" value="{{ date('Y-m-d\TH:i', strtotime($guest->guestTime['departure'])) }}" >

                                    @if ($errors->has('departure'))
                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('departure') }}</strong>
                                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="status">Статус</label>
                                    <select id="status" class="form-control" name="status" value="{{ $guest->status }}" >
                                        <option value="1" {{ ($guest->status == 1) ? 'selected' : ''}}> Проживает </option>
                                        <option value="0" {{ ($guest->status == 0) ? 'selected' : ''}}> Выселен </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="toggle-switch" data-ts-color="success">
                                            <label for="breakfast" class="ts-label">Завтрак</label>
                                            <input id="breakfast" name="breakfast" type="checkbox" value="Завтрак" hidden="hidden"{{ (strpos($guest->vouchers, 'Завтрак') !== false) ? 'checked' : ''}} >
                                            <label for="breakfast" class="ts-helper"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="toggle-switch" data-ts-color="success">
                                            <label for="lunch" class="ts-label">Обед</label>
                                            <input id="lunch" name="lunch" type="checkbox" value="Обед" hidden="hidden"{{ (strpos($guest->vouchers, 'Обед') !== false) ? 'checked' : ''}} >
                                            <label for="lunch" class="ts-helper"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="toggle-switch" data-ts-color="success">
                                            <label for="supper" class="ts-label">Ужин</label>
                                            <input id="supper" name="supper" type="checkbox" value="Ужин" hidden="hidden"{{ (strpos($guest->vouchers, 'Ужин') !== false) ? 'checked' : ''}} >
                                            <label for="supper" class="ts-helper"></label>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Сохранить</button>
                                    </div>
                                </div>
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
