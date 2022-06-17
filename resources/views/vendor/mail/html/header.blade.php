<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                    <img src="{{asset(get_setting('logo'))}}" alt="Logo" class="logo">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
