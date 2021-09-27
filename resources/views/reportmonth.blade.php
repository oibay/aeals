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
        <th>Room</th>
        <th>Room Type</th>
        <th>Location</th>
        <th>Entry</th>
        <th>Departure</th>

        <!---<th>Hours</th>
        <th>Nights</th>--->

        <?php
       /** for($i=1;$i<32;$i++) {
            echo "<th>".$i."</th>";
        }*/
        ?>

    </tr>
    @foreach($db as $item)
        <?php
        $hour = abs(strtotime($item->entry) - strtotime($item->departure))/(60*60);
        ?>
        <tr>
            <td> {{ $loop->index + 1}}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->company }}</td>
            <td>{{ $item->room }}</td>
            <td>{{ $item->room_type}}</td>
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
            <td>
                {{ $item->entry }}

            </td>
            <td>
                {{ $item->departure}}
            </td>
            <!---<td>
               <?php //$hour;?>
            </td>--->




            <?php
           /** $x = date('d',strtotime($item->entry));
            $y = date('d',strtotime($item->departure));
            $count = 1;

            for($i=1;$i<32;$i++) {
                echo "<td>";
                if($i >= $x && $i <= $y) {

                    if (round($hour) <= 24) {
                        echo 1;
                        break;
                    }
                    if (round($hour) > 24) {
                        echo 1;
                    }

                }
                echo "</td>";
            }*/

            ?>

        </tr>
    @endforeach

</table>
</body>
</html>
