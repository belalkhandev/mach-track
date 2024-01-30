<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Machine reports</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 14px;
        }
        h1, h2, h3,
        ul {
            margin: 0;
            padding: 0;
        }

        ul {
            list-style: none;
            margin-top:20px;
        }

        ul li {
            float: left;
            margin-right: 30px;
        }

        header {
            text-align: center;
        }

        .table {
            width: 100%;
            margin-top: 30px;
            border-collapse: collapse;
        }
        .table th {
            border: 1px solid #000;
            padding: 5px 10px;
        }
        .table td {
            border: 1px solid #000;
            font-size: 13px;
            padding: 3px 10px;
        }
    </style>
</head>
<body>
    <header>
        <h3>Machine reports</h3>
    </header>

    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Brand</th>
            <th>Machine Number</th>
            <th>Model</th>
            <th>Floor</th>
            <th>Status</th>
            <th>Rented</th>
        </tr>
        </thead>
        <tbody>
        @foreach($machines as $key => $machine)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>
                    {{ $machine->category->name }}
                </td>
                <td>
                    @if($machine->brand)
                       {{ $machine->brand->name }}
                    @endif
                </td>
                <td>
                    {{ $machine->machine_number }}
                    @if($machine->local_number)
                        L/N: {{ $machine->local_number ?: '' }}
                    @endif
                </td>
                <td>
                    {!!  $machine->machineModel ? $machine->machineModel->name. '<br>' : '-' !!}
                    {{ $machine->transmission_type }}
                </td>
                <td>
                    @if($machine->floor)
                        {{ $machine->floor->name }} - {{ $machine->floor->building->name }}
                    @endif
                </td>
                <td>
                    {{ $machine->status }}
                </td>
                <td>
                    {{ $machine->is_rented ? 'Yes' : 'No' }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>
