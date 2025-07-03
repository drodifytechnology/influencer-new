@foreach ($expenses as $expense)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ formatted_date($expense->created_at) }}</td>
    <td>{{ $expense->expense_category->name }}</td>
    <td>{{ currency_format($expense->amount) }}</td>
    <td>{{ $expense->payment_type->value['name'] ?? '' }}</td>
    <td>{{ $expense->user->name }}</td>
</tr>

@endforeach

