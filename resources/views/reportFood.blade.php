<!DOCTYPE html>
<html>
<head>

</head>
<body>
<table border="3">
    <tr>
        <th>#</th>
        <th>ФИО</th>

        <th>Компания</th>
        <th>Локация</th>
        @if($food_type == 'Завтрак')
            <th>Завтрак</th>
        @elseif($food_type == 'Обед')
            <th>Обед</th>
        @elseif($food_type == 'Ужин')
            <th>Ужин</th>
        @else
            <th>Завтрак</th>
            <th>Обед</th>
            <th>Ужин</th>
        @endif

        <th>Дата</th>


    </tr>
    @foreach($food as $item)

        <tr>
            <td> {{ $loop->index + 1}}</td>
            <td>{{ $item->guest_name }}</td>
            <td>{{ $item->company }}</td>
            <td>
                @if($item->location == 'apec')
                    Apec Petrotechnic
                @elseif($item->location == 'bpark')
                    Жангырхан 72Б 1 БЛОК
                @elseif($item->location == 'bpark-2')
                    Жангырхан 72Б 2 БЛОК
                @elseif($item->location == 'bpark-3')
                    Жангырхан 72Б 3 БЛОК

                @elseif($item->location == 'nomad')
                    Nomad
                @elseif($item->location == 'goldenrose')
                    Golden Rose
                @endif
            </td>
            @if($food_type == 'Завтрак')
                <th> @if($item->vouchers) 1 @endif</th>
            @elseif($food_type == 'Обед')

                <th>@if($item->lunch) 1 @endif</th>

            @elseif($food_type == 'Ужин')

                <th>@if($item->dinner) 1 @endif</th>

            @else
                <th>@if($item->vouchers) 1  @endif</th>
                <th>@if($item->lunch) 1  @endif</th>
                <th>@if($item->dinner) 1  @endif</th>
            @endif
            <td>
                {{ $item->updated_at }}
            </td>


        </tr>
    @endforeach

</table>
</body>
</html>
