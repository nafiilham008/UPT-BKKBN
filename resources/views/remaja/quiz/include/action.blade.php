<td>
    <div class="btn-group dropstart mb-1">
        <button type="button" class="btn btn-primary dropdown-toggle btn-sm" data-bs-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            Choose Action
        </button>
        <div class="dropdown-menu" style="">
            <h6 class="dropdown-header">Action</h6>
            {{-- <a class="dropdown-item" href="{{ route('dashboard.quizzes.show', $item->id) }}">Show</a> --}}
            <div class="ms-2">
                <a href="{{ route('dashboard.quizzes.show', $item->id) }}" class="btn btn-outline-success btn-sm">
                    <i class="fa fa-eye"></i> Show
                </a>
                @can('quiz edit')
                    {{-- <a class="dropdown-item" href="{{ route('dashboard.quizzes.edit', $item->id) }}">Edit</a> --}}
                    <a href="{{ route('dashboard.quizzes.edit', $item->id) }}" class="btn btn-outline-primary btn-sm">
                        <i class="fa fa-pencil-alt"></i> Edit
                    </a>
                @endcan
                @can('quiz delete')
                    {{-- <a class="dropdown-item" href="#">Delete</a> --}}
                    <form action="{{ route('dashboard.quizzes.destroy', $item->id) }}" method="post"
                        class="d-inline {{ $item->highlight == 1 ? 'd-none' : '' }}"
                        onsubmit="return confirm('Are you sure to delete this record?')">
                        @csrf
                        @method('delete')

                        <button class="btn btn-outline-danger btn-sm">
                            <i class="fa fa-trash-alt"></i> Delete
                        </button>
                    </form>
                @endcan
            </div>
            <div class="ms-2 mt-2">
                @can('question view')
                    <a href="{{ route('dashboard.questions', $item->id) }}" class="btn btn-outline-info btn-sm">
                        <i class="fa fa-plus"></i> Add Question
                    </a>
                @endcan
            </div>
        </div>
    </div>
</td>
