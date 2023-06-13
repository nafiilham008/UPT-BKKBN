<td>
    <a href="{{ route('dashboard.announcements.show', $item->id) }}" class="btn btn-outline-success btn-sm">
        <i class="fa fa-eye"></i>
    </a>

    @can('announcement edit')
        <a href="{{ route('dashboard.announcements.edit', $item->id) }}" class="btn btn-outline-primary btn-sm">
            <i class="fa fa-pencil-alt"></i>
        </a>
    @endcan

    @can('announcement delete')
        <form action="{{ route('dashboard.announcements.destroy', $item->id) }}" method="post"
            class="d-inline"
            onsubmit="return confirm('Are you sure to delete this record?')">
            @csrf
            @method('delete')

            <button class="btn btn-outline-danger btn-sm">
                <i class="ace-icon fa fa-trash-alt"></i>
            </button>
        </form>
    @endcan
</td>
