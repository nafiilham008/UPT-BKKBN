<td>
    <a href="{{ route('dashboard.jobandfuncs.show', $item->id) }}" class="btn btn-outline-success btn-sm">
        <i class="fa fa-eye"></i>
    </a>

    @can('jobandfunc edit')
        <a href="{{ route('dashboard.jobandfuncs.edit', $item->id) }}" class="btn btn-outline-primary btn-sm">
            <i class="fa fa-pencil-alt"></i>
        </a>
    @endcan

    @can('jobandfunc delete')
        <form action="{{ route('dashboard.jobandfuncs.destroy', $item->id) }}" method="post"
            class="d-inline {{ !empty($jobandfunc) ? 'd-none' : '' }}"
            onsubmit="return confirm('Are you sure to delete this record?')">
            @csrf
            @method('delete')

            <button class="btn btn-outline-danger btn-sm">
                <i class="ace-icon fa fa-trash-alt"></i>
            </button>
        </form>
    @endcan
</td>
