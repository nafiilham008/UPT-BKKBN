<td>
    <a href="{{ route('collaborations.show', $item->id) }}" class="btn btn-outline-success btn-sm">
        <i class="fa fa-eye"></i>
    </a>

    @can('collaboration edit')
        <a href="{{ route('collaborations.edit', $item->id) }}" class="btn btn-outline-primary btn-sm">
            <i class="fa fa-pencil-alt"></i>
        </a>
    @endcan

    @can('collaboration delete')
        <form action="{{ route('collaborations.destroy', $item->id) }}" method="post" class="d-inline"
            onsubmit="return confirm('Are you sure to delete this record?')">
            @csrf
            @method('delete')

            <button class="btn btn-outline-danger btn-sm">
                <i class="ace-icon fa fa-trash-alt"></i>
            </button>            
        </form>
    @endcan
</td>
