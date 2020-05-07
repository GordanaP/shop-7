<tr>
    <td>
        <img src="{{ $item->pdfImage() }}" width="90%">
    </td>
    <td>
        <p class="w-80 mt-0 font-12 uppercase text-semibold tracking-wide">
            {{ $item->title }}
        </p>
        <p class="font-14 w-80">
            {{ $item->subtitle }}
        </p>
    </td>
    <td>
        {{ Present::price($item->ordered->price_in_cents) }}
    </td>
    <td class="text-center">{{ $item->ordered->quantity }}</td>
    <td class="text-right">
         {{ Present::price($item->ordered->price_in_cents * $item->ordered->quantity) }}
    </td>
</tr>