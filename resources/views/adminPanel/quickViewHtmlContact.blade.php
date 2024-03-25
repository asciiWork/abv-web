<table>
    <tr class="border-0">
        <td>Name :</td>
        <td>{{ $conData->firstname }} {{$conData->lastname}}</td>
    </tr>
    <tr class="border-0">
        <td>Phone : </td>
        <td>{{ $conData->phone_number }}
    </tr>
    <tr class="border-0">
        <td>Email :</td>
        <td>{{ $conData->email }}</td>
    </tr>
    <tr class="border-0">
        <td>Message:</td>
        <td>{{ $conData->message }}</td>
    </tr>
</table>