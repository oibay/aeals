<!DOCTYPE html>
<html>
<head>

</head>
<body>
<table border="3">
    <tr>

        <th>#</th>
        <th>Тотал</th>
        <th>Продукт</th>
        <th>Статус</th>
        <th>Дата</th>
    </tr>
    @if($data->count() > 0)
        @foreach($data as $item)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $item->total }}</td>
                <td>
                    @foreach($item->log as $log)
                        <ul>
                            <li> {{ $log->menu['title'] }} ( <strong>{{ $log->total }}</strong>) шт</li>
                        </ul>
                    @endforeach
                </td>
                <td>
                    <h4><span class="badge badge-success">Оплачено</span></h4>
                </td>
                <td>{{ $item->created_at }}</td>
            </tr>
        @endforeach
    @endif

</table>
</body>
</html>
