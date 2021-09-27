@extends('layouts.layouts')
@section('content')

    <section class="au-breadcrumb m-t-75">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Компания <select name="forma" onchange="location = this.value;">
                                <option value="{{ url('shop/mainmenu') }}">Выбрать</option>
                                @foreach($listClient as $item)
                                <option value="{{ url('shop/mainmenu?com_id='.$item->id) }}"
                                @if(request()->com_id == $item->id)
                                    selected
                                    @endif>{{ $item->title }}</option>

                                @endforeach
                            </select></h3>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="m-t-10" >
        <div class="section__content section__content--p30" style="background: white">
            <div class="container-fluid" >
                <div class="row" >

                    <div class="col-xl-12" >
                        @if($canteenGuests->count() > 0)
                        @include('message')
                        <table class="table table-bordered" >
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ФИО</th>
                                <th scope="col">ИИН</th>
                                <th scope="col">Компания</th>

                            </tr>
                            </thead>
                            <tbody>


                                            @foreach($canteenGuests as $item)
                                                <tr>
                                                    <td>{{ $loop->index + 1}}</td>
                                                    <td>
                                                        <a href="{{url('/shop/user/'.$item->id)}}">{{ $item->name }}</a>
                                                        </td>
                                                    <td>{{ $item->passport }}</td>
                                                    <td>{{ $item->company['title'] }}</td>
                                                </tr>
                                            @endforeach


                            </tbody>

                        </table>

                        @endif
                    </div>

                </div>
            </div>
        </div>
        </div>
    </section>

@endsection
@push('css')

@endpush
@push('js')

@endpush
