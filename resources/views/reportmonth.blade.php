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
        <?php
        for($i=1;$i<32;$i++) {
            echo "<th>".$i."</th>";
        }
        ?>
        <th>Entry</th>
        <th>Departure</th>
    </tr>
    @foreach($db as $item)
        <tr>
            <td> {{ $loop->index + 1}}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->company }}</td>
            <td>{{ $item->room_type}}</td>

            <?php
            $x = date('d',strtotime($item->entry));
            $y = date('d',strtotime($item->departure));
            $hour = abs($y-$x)/(60*60);
            for($i=1;$i<32;$i++) {
                echo "<td>";
                if($i >= $x && $i <= $y) {

                    echo 1;
                }
                echo "</td>";
            }

            ?>
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
