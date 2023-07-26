<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <form id="form-category-create" method="POST" enctype="multipart/form-data" data-parsley-validate>
            @csrf
            @method('POST')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Category</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mandatory">
                                <label for="title" class="form-label">{{ __('Title') }}</label>
                                <input type="text" name="title" id="title"
                                    class="form-control @error('title') is-invalid @enderror"
                                    placeholder="{{ __('Insert Title Category') }}" data-parsley-required="true"
                                    data-parsley-required-message="Category must be fill!" autofocus>
                                @error('title')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="col-md-12">
                            <div class="form-group">
                                <label for="thumbnail" class="form-label">{{ __('thumbnail') }}</label>
                                <input class="form-control" type="file" id="thumbnail" name="thumbnail"
                                    accept="image/png, image/jpeg" data-parsley-filemaxmegabytes="2"
                                    data-parsley-trigger="change"
                                    data-parsley-filemimetypes="image/jpeg,image/png"
                                    data-parsley-error-message="Please upload an image file (JPEG, PNG) with a maximum size of 2MB">
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="button" id="save-category" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Save</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
