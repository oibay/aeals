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
            <td> Apec Petrotechnic</td>
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
