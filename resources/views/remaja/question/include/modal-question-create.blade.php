<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <form id="form-question-create" method="POST" enctype="multipart/form-data" data-parsley-validate>
            @csrf
            @method('POST')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Question</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mandatory">
                                <label for="question" class="form-label">{{ __('Question') }}</label>
                                <input type="text" name="question" id="question"
                                    class="form-control @error('question') is-invalid @enderror"
                                    placeholder="{{ __('Insert question question') }}" data-parsley-required="true"
                                    data-parsley-required-message="Question must be fill!" autofocus>
                                @error('question')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="image" class="form-label">{{ __('Image') }}</label>
                                <input class="form-control @error('image') is-invalid @enderror" type="file"
                                    id="image" name="image" accept="image/png, image/jpeg" required
                                    data-parsley-trigger="change" data-parsley-filemaxmegabytes="2"
                                    data-parsley-required-message="{{ __('Please select a image') }}"
                                    data-parsley-error-message="{{ __('Please upload an image file (JPEG, PNG) with a maximum size of 2MB') }}">
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description" class="form-label">{{ __('Description') }}</label>
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                    placeholder="{{ __('Insert description') }}" data-parsley-trigger="change">{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{ __('Options') }}</label>
                                <div id="options-container">

                                    <div class="options-input">
                                        <div class="input-group mb-2">
                                            <input name="options[]" type="text"
                                                class="form-control" placeholder="Insert option">
                                            <div class="form-check ms-2 me-2 mt-2">
                                                <input type="hidden" name="correct_answers[]"
                                                    value="0">
                                                <input name="correct_answers[]" type="checkbox"
                                                    class="form-check-input" value="1">
                                                <label class="form-check-label">Correct</label>
                                            </div>
                                            <button type="button" class="btn btn-danger remove-option">Remove</button>

                                        </div>
                                    </div>
                                </div>
                                <button type="button" id="add-option" class="btn btn-success btn-sm mt-2">Add
                                    Option</button>
                            </div>
                        </div>




                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="button" id="save-question" class="btn btn-primary ml-1" >
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Save</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
