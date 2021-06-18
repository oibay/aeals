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
        <th>Entry</th>
        <th>Departure</th>
        <th>Hours</th>
        <th>Nights</th>
        <th>Room rate</th>
        <th>Total amount</th>

    </tr>
    @foreach($db as $item)
        <?php
        $hour = abs(strtotime($item->entry) - strtotime($item->departure))/(60*60);
        ?>
        <tr>
            <td> {{ $loop->index + 1}}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->company }}</td>
            <td>{{ $item->room_type}}</td>
            <td>
                {{ $item->entry }}

            </td>
            <td>
                {{ $item->departure}}
            </td>
            <td>
               {{ $hour }}
            </td>

            <td>
                @if(round($hour) <= 24)
                    1
                @else
                        {{ round($hour / 24)  }}
                @endif
            </td>

            <td>
                {{ $item->companyprice }}
            </td>

            <td>
                <?php
                $countHoursToday = round($hour) <= 24 ? 1 : round($hour / 24);

                ?>
                {{ ($item->companyprice * $countHoursToday) }}
            </td>



        </tr>
    @endforeach

</table>
</body>
</html>
