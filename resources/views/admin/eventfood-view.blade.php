@extends('layouts.layouts')
@section('content')

    <section class="au-breadcrumb m-t-75">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Питание #{{ $event->title }}</h4>
                        <label>Фильтр по локациям</label> <select name="forma" onchange="location = this.value;">
                            <option value="{{ url('admin/event/view/'.$event->id) }}">Общий</option>
                            <option value="{{ url('admin/event/view/'.$event->id.'/?location=bpark') }}" @if(request()->location == 'bpark') selected @endif>Бизнес ПАРК 1БЛОК</option>
                            <option value="{{ url('admin/event/view/'.$event->id.'/?location=bpark-2') }}" @if(request()->location == 'bpark-2') selected @endif>Бизнес ПАРК 2БЛОК</option>
                            <option value="{{ url('admin/event/view/'.$event->id.'/?location=apec') }}" @if(request()->location == 'apec') selected @endif>Apec Petrotechnic</option>
                        </select>
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
                                <th>Компания</th>
                                <th>Завтрак</th>
                                <th>Обед</th>
                                <th>Ужин</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($guests->count() > 0)
                                @foreach($guests as $item)
                            <tr>
                                <td><a href="{{ url('admin/guests/edit',$item->id) }}">
                                        {{ $item->name }}
                                    </a></td>

                                <td>{{ $item->company['name'] }}</td>




                                <td>
                                    <?php
                                    $date = date('H');?>
                                    @if ($event->eventTime($item->id,$event->id,'Завтрак'))
                                        @if($date < '11')
                                            <a href="{{ url('/admin/event/food/?q=Завтрак&user='.$item->id.'&event='.$event->id) }}" class="btn btn btn-success"  onclick="return false;">
                                                <i class="zmdi zmdi-check"></i>
                                            </a>
                                        @endif


                                    @else
                                            @if($date < '11')
                                                <a href="{{ url('/admin/event/food/?q=Завтрак&user='.$item->id.'&event='.$event->id) }}" class="btn btn btn-primary"  >+</a>
                                            @endif
                                    @endif
                                </td>
                                <td>
                                    @if ($event->eventTime($item->id,$event->id,'Обед'))
                                        @if($date >= '11' && $date < '15')
                                        <a href="{{ url('/admin/event/food/?q=Обед&user='.$item->id.'&event='.$event->id) }}" class="btn btn btn-success"  onclick="return false;">
                                            <i class="zmdi zmdi-check"></i>
                                        </a>
                                        @endif


                                    @else
                                        @if($date >= '11' && $date < '16')
                                        <a href="{{ url('/admin/event/food/?q=Обед&user='.$item->id.'&event='.$event->id) }}" class="btn btn btn-primary"  >+</a>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    @if ($event->eventTime($item->id,$event->id,'Ужин'))
                                        @if($date >= '16' && $date < '20')
                                        <a href="{{ url('/admin/event/food/?q=Ужин&user='.$item->id.'&event='.$event->id) }}" class="btn btn btn-success"  onclick="return false;">
                                            <i class="zmdi zmdi-check"></i>
                                        </a>
                                        @endif


                                    @else
                                        @if($date >= '16' && $date < '20')
                                        <a href="{{ url('/admin/event/food/?q=Ужин&user='.$item->id.'&event='.$event->id) }}" class="btn btn btn-primary"  >+</a>
                                        @endif
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


    <!-- END PAGE CONTAINER-->
    </div>

    </div>
@endsection
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
