<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}}</title>
    <style>
        table
        {
            width     : 100%; 
            font-size : 12px; 
        }

        table thead
        {
            border-bottom : 2px solid gray;
        }

        table th 
        {
            font-weight: bold;
            letter-spacing: 1px; 
        }


        table td, 
        table th 
        {
            padding   : 9px 6px; 
        }

        table td.uppercase 
        {
            text-transform: uppercase;
        }

        h1 
        {
            letter-spacing : 5px; 
            color : #444;
        }
    </style>
</head>
<body>
    <h1>
        Customer Masterfile
    </h1>
    <table>
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Contact Person</th>
                <th>Contact No.</th>
                <th>Address</th>
                <th>Email Address</th>
                <th>TIN</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="uppercase" colspan="5">
                    walk-in
                </td>
            </tr>
            @foreach($items as $item)
                <tr>
                    <td class="uppercase"> 
                        {{$item->name}} 
                    </td>
                    <td class="uppercase">
                        {{$item->contact_person}}
                    </td>
                    <td>
                        {{$item->contact_number}}
                    </td>
                    <td class="uppercase">
                        {{$item->address}}
                    </td>
                    <td> 
                        {{$item->email}}
                    </td>
                    <td>
                        {{$item->tin_number}}
                    </td>
                </tr>
            @endforeach 
        </tbody>
    </table>
</body>
</html>