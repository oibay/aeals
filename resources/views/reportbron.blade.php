<!DOCTYPE html>
<html>
<head>

</head>
<body>
<table border="3">
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Company</th>
        <th>Room Type</th>
        <th>Location</th>
        <th>Entry</th>
        <th>Departure</th>

    </tr>
    @foreach($db as $item)
        <tr>
            <td> {{ $loop->index + 1}}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->company }}</td>
            <td>{{ $item->room_type}}</td>
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
                {{ $item->entry }}

            </td>
            <td>
                {{ $item->departure}}
            </td>


        </tr>
    @endforeach

</table>
</body>
</html>
