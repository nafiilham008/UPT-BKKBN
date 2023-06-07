<td>
    <a href="{{ route('courses.show', $item->id) }}" class="btn btn-outline-success btn-sm">
        <i class="fa fa-eye"></i>
    </a>

    @can('course edit')
        <a href="{{ route('courses.edit', $item->id) }}" class="btn btn-outline-primary btn-sm">
            <i class="fa fa-pencil-alt"></i>
        </a>
    @endcan

    @can('course delete')
        <form action="{{ route('courses.destroy', $item->id) }}" method="post"
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
