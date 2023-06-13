<td>
    <a href="{{ route('dashboard.users.show', $model->id) }}" class="btn btn-outline-success btn-sm">
        <i class="fa fa-eye"></i>
        <span>Show</span>
    </a>

    @can('user edit')
        <a href="{{ route('dashboard.users.edit', $model->id) }}" class="btn btn-outline-primary btn-sm">
            <i class="fa fa-pencil-alt"></i>
            <span>Edit</span>

        </a>
    @endcan

    @can('user delete')
        <form action="{{ route('dashboard.users.destroy', $model->id) }}" method="post" class="d-inline"
            onsubmit="return confirm('Are you sure to delete this record?')">
            @csrf
            @method('delete')

            <button class="btn btn-outline-danger btn-sm">
                <i class="ace-icon fa fa-trash-alt"></i>
                <span>Delete</span>

            </button>
        </form>
    @endcan
</td>
