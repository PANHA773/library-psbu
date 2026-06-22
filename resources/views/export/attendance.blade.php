<table>
    <thead>
        <tr style="background-color: blue">
            <th>Code</th>
            <th>Student ID</th>
            <th>Checkin at</th>
            <th>Created by</th>
            <th>Create at</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($invoices as $invoice)
            <tr>
                <td bgcolor="red">{{ $invoice->code }}</td>
                <td>{{ $invoice->student_id }}</td>
                <td>{{ $invoice->checkin_at }}</td>
                <td>{{ $invoice->created_by }}</td>
                <td>{{ $invoice->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
