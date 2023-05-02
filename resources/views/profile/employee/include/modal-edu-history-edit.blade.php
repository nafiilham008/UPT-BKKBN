<div class="modal fade" id="exampleModalScrollableEdit{{ $id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <form id="form-education-history-edit{{ $id }}" data-id="{{ $id }}"
            data-employee-id="{{ $employeeId }}" method="POST" enctype="multipart/form-data" data-parsley-validate>
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Education History</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <input type="hidden" name="id" id="id">
                        <div class="col-md-12">
                            <div class="form-group mandatory">
                                <label for="institution_name" class="form-label">{{ __('Institution Name') }}</label>
                                <input type="text" name="institution_name" id="institution_name"
                                    class="form-control @error('institution_name') is-invalid @enderror"
                                    placeholder="{{ __('Insert Institution Name') }}" data-parsley-required="true"
                                    data-parsley-required-message="Kolom Nama Instituti harus diisi!" autofocus>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group mandatory">
                                <label for="degree" class="form-label">{{ __('Degree') }}</label>
                                <input type="text" name="degree" id="degree"
                                    class="form-control @error('degree') is-invalid @enderror"
                                    placeholder="{{ __('Insert Degree') }}" data-parsley-required="true"
                                    data-parsley-required-message="Kolom Lulusan harus diisi!">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mandatory">
                                <label for="graduation_year" class="form-label">{{ __('Graduation Year') }}</label>
                                <input type="number" name="graduation_year" id="graduation_year"
                                    class="form-control @error('graduation_year') is-invalid @enderror"
                                    placeholder="{{ __('Insert Graduation Year') }}" data-parsley-required="true"
                                    data-parsley-required-message="Kolom Tahun Lulus harus diisi!" min="1960"
                                    max="{{ date('Y') }}">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="major" class="form-label">{{ __('Major Study') }}</label>
                                <input type="text" name="major" id="major"
                                    class="form-control @error('major') is-invalid @enderror"
                                    placeholder="{{ __('Insert Major') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="gpa" class="form-label">{{ __('GPA') }}</label>
                                <input type="number" name="gpa" id="gpa" step="0.01"
                                    class="form-control @error('gpa') is-invalid @enderror"
                                    placeholder="{{ __('Insert GPA') }}" max="4.00">
                                @error('gpa')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mandatory">
                                <label for="description" class="form-label">{{ __('Description') }}</label>
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                    placeholder="{{ __('Insert description') }}">{!! $education->description !!}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="button" id="update-education{{ $id }}" class="btn btn-primary ml-1"
                        data-id="{{ $id }}" data-employee-id="{{ $employeeId }}"
                        data-bs-dismiss="modal">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Update</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
