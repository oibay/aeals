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
            @if($food_type == 'Завтрак')
                <th> @if($item->vouchers) + @endif</th>
            @elseif($food_type == 'Обед')

                <th>@if($item->lunch)+@endif</th>

            @elseif($food_type == 'Ужин')

                <th>@if($item->dinner)+@endif</th>

            @else
                <th>@if($item->vouchers) +  @endif</th>
                <th>@if($item->lunch) +  @endif</th>
                <th>@if($item->dinner) +  @endif</th>
            @endif
            <td>
                {{ $item->updated_at }}
            </td>


        </tr>
    @endforeach

</table>
</body>
</html>
