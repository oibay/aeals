@extends('layouts.layouts')
@section('content')

    <section class="au-breadcrumb m-t-75">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Питание #{{ $event->title }}</h4>
                        <label>Фильтр по локациям</label>
                        <select name="forma" onchange="location = this.value;">
                            <option value="{{ url('admin/event/view/'.$event->id) }}">Общий</option>
                            <option value="{{ url('admin/event/view/'.$event->id.'/?location=bpark') }}" @if(request()->location == 'bpark') selected @endif>Бизнес ПАРК 1БЛОК</option>
                            <option value="{{ url('admin/event/view/'.$event->id.'/?location=bpark-2') }}" @if(request()->location == 'bpark-2') selected @endif>Бизнес ПАРК 2БЛОК</option>
                            <option value="{{ url('admin/event/view/'.$event->id.'/?location=apec') }}" @if(request()->location == 'apec') selected @endif>Apec Petrotechnic</option>
                        </select>
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
                        @include('message')
                        <div class="alert alert-info alert-block" id="pleaseWait" style="display: none;">

                            <strong>Пожалуйста подождите ...</strong>
                        </div>
                        <table id="table_id" class="display">
                            <thead>
                            <tr>
                                <th>ФИО</th>
                                <th>Компания</th>
                                <th>Завтрак</th>
                                <th>Обед</th>
                                <th>Ужин</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($event->evTime()->count() > 0)
                                @foreach($event->evTime as $item)
                                    @if($item->guest['location'] == request()->location)
                            <tr>
                                <td><a href="{{ url('admin/guests/edit',$item->user_id) }}">
                                        {{ $item->guest['name'] }}
                                    </a></td>

                                <td>{{ $event->company($item->guest['user_id'])['name'] }}</td>




                                <td>
                                    <?php
                                    $date = date('H');?>
                                    @if ($event->eventTime($item->user_id,$event->id,'Завтрак'))
                                        @if($date < '11')
                                            <a href="{{ url('/admin/event/food/?q=Завтрак&user='.$item->user_id.'&event='.$event->id) }}" class="btn btn btn-success"  onclick="return false;">
                                                <i class="zmdi zmdi-check"></i>
                                            </a>
                                        @endif


                                    @else
                                            @if($date < '11')
                                                <a href="{{ url('/admin/event/food/?q=Завтрак&user='.$item->user_id.'&event='.$event->id) }}" class="btn btn btn-primary"  onClick="$('#pleaseWait').css('display', 'block')">+</a>
                                            @endif
                                    @endif
                                </td>
                                <td>
                                    @if ($event->eventTime($item->user_id,$event->id,'Обед'))
                                        @if($date >= '11' && $date < '15')
                                        <a href="{{ url('/admin/event/food/?q=Обед&user='.$item->user_id.'&event='.$event->id) }}" class="btn btn btn-success"  onclick="return false;">
                                            <i class="zmdi zmdi-check"></i>
                                        </a>
                                        @endif


                                    @else
                                        @if($date >= '11' && $date < '16')
                                        <a href="{{ url('/admin/event/food/?q=Обед&user='.$item->user_id.'&event='.$event->id) }}" class="btn btn btn-primary"  >+</a>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    @if ($event->eventTime($item->user_id,$event->id,'Ужин'))
                                        @if($date >= '16' && $date < '20')
                                        <a href="{{ url('/admin/event/food/?q=Ужин&user='.$item->user_id.'&event='.$event->id) }}" class="btn btn btn-success"  onclick="return false;">
                                            <i class="zmdi zmdi-check"></i>
                                        </a>
                                        @endif


                                    @else
                                        @if($date >= '16' && $date < '20')
                                        <a href="{{ url('/admin/event/food/?q=Ужин&user='.$item->user_id.'&event='.$event->id) }}" class="btn btn btn-primary"  >+</a>
                                        @endif
                                    @endif
                                </td>


                            </tr>
                            @endif
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
                <form action="{{ route('foodReport') }}" method="POST">
                    <div class="modal-body">

                        @csrf
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="entry" class="form-control-label">Выберите </label>
                                <input type="hidden" name="event_id" value="{{ request()->id }}">
                                <select name="food" class="form-control">
                                    <option value="Завтрак">Завтрак</option>
                                    <option value="Обед">Обед</option>
                                    <option value="Ужин">Ужин</option>
                                    <option value="Все">Все</option>
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
                                @if ($errors->has('location'))
                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('location') }}</strong>
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
@push('css')
@endpush
@push('js')
    <script>
        $(document).ready( function () {
            $('#table_id').DataTable({
                'iDisplayLength': 100
            });
        } );
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });

    </script>
@endpush
