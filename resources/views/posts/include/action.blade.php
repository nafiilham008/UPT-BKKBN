<td>
    <a href="{{ route('posts.show', $item->id) }}" class="btn btn-outline-success btn-sm">
        <i class="fa fa-eye"></i>
    </a>

    @can('content edit')
        <a href="{{ route('posts.edit', $item->id) }}" class="btn btn-outline-primary btn-sm">
            <i class="fa fa-pencil-alt"></i>
        </a>
    @endcan

    @can('content delete')
        <form action="{{ route('posts.destroy', $item->id) }}" method="post"
            class="d-inline {{ $item->highlight == 1 ? 'd-none' : '' }}"
            onsubmit="return confirm('Are you sure to delete this record?')">
            @csrf
            @method('delete')

            <button class="btn btn-outline-danger btn-sm">
                <i class="ace-icon fa fa-trash-alt"></i>
            </button>
        </form>
    @endcan
</td>
