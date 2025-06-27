@foreach ($reviews as $review)
<tr>
    <td class="w-60 checkbox">
        <label class="table-custom-checkbox">
            <input type="checkbox" name="ids[]" class="table-hidden-checkbox checkbox-item"
               value="{{ $review->id}}"  data-url="{{ route('admin.orders.deleteAll') }}">
            <span class="table-custom-checkmark custom-checkmark td"></span>
        </label>
    </td>
    <td>{{ $loop->iteration}}</td>
    <td>{{ formatted_date($review->created_at) }}</td>
    <td>{{ $review->service->title }}</td>
    <td>{{ $review->rating }}</td>
    <td>{{ Str::limit($review->description, 25, '...') }}</td>

</tr>

@endforeach
