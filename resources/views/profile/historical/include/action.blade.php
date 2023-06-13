<td>
    <a href="{{ route('dashboard.historicals.show', $item->id) }}" class="btn btn-outline-success btn-sm">
        <i class="fa fa-eye"></i>
    </a>

    @can('historical edit')
        <a href="{{ route('dashboard.historicals.edit', $item->id) }}" class="btn btn-outline-primary btn-sm">
            <i class="fa fa-pencil-alt"></i>
        </a>
    @endcan

    @can('historical delete')
        <form action="{{ route('dashboard.historicals.destroy', $item->id) }}" method="post"
            class="d-inline {{ !empty($history) ? 'd-none' : '' }}"
            onsubmit="return confirm('Are you sure to delete this record?')">
            @csrf
            @method('delete')

            <button class="btn btn-outline-danger btn-sm">
                <i class="ace-icon fa fa-trash-alt"></i>
            </button>
        </form>
    @endcan
</td>
