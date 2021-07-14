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
        @if($food_type == 'Завтрак')
            <th>Завтрак</th>
        @elseif($food_type == 'Обед')
            <th>Обед</th>
        @elseif($food_type == 'Ужин')
            <th>Ужин </th>
        @else
            <th>Завтрак</th>
            <th>Обед</th>
            <th>Ужин </th>
        @endif

        <th>Дата</th>


    </tr>
    @foreach($food as $item)

        <tr>
            <td> {{ $loop->index + 1}}</td>
            <td>{{ $item->guest_name }}</td>
            <td>{{ $item->company }}</td>
            @if($item->vouchers)
                <th>+</th>
            @elseif($item->lunch)
                <th>+</th>
            @elseif($item->dinner)
                <th>+</th>
            @else
                <th>@if($item->vouchers) + @else - @endif</th>
                <th>@if($item->lunch) + @else - @endif</th>
                <th>@if($item->dinner) + @else - @endif</th>
            @endif
            <td>

            </td>





        </tr>
    @endforeach

</table>
</body>
</html>
