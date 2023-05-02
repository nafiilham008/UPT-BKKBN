<div class="modal fade" id="modalEmployeeHistory" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <form id="form-employee-history" method="POST" enctype="multipart/form-data" data-parsley-validate>
            @csrf
            @method('POST')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Employee History</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mandatory">
                                <label for="company_name" class="form-label">{{ __('Company Name') }}</label>
                                <input type="text" name="company_name" id="company_name"
                                    class="form-control @error('company_name') is-invalid @enderror"
                                    placeholder="{{ __('e.g. PT XYZ') }}" data-parsley-required="true"
                                    data-parsley-required-message="The company name field is required!" autofocus>
                                @error('company_name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mandatory">
                                <label for="start_year" class="form-label">{{ __('Start Year') }}</label>
                                <input type="number" name="start_year" id="start_year"
                                    class="form-control @error('start_year') is-invalid @enderror"
                                    placeholder="{{ __('e.g. 2010') }}" required
                                    data-parsley-required-message="The start year field is required!" min="1960"
                                    max="{{ date('Y') }}" step="1" value="{{ old('start_year') }}" autofocus>
                                @error('start_year')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="end_year" class="form-label">{{ __('End Year') }}</label>
                                <input type="number" name="end_year" id="end_year"
                                    class="form-control @error('end_year') is-invalid @enderror"
                                    placeholder="{{ __('e.g. 2015') }}" min="1960" max="{{ date('Y') }}"
                                    step="1" value="{{ old('end_year') }}" data-parsley-gt="#start_year"
                                    data-parsley-gt-message="The end year must be greater than start year."
                                    data-parsley-trigger="blur">
                                @error('end_year')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>



                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="position" class="form-label">{{ __('Position') }}</label>
                                <input type="text" name="position" id="position"
                                    class="form-control @error('position') is-invalid @enderror"
                                    placeholder="{{ __('e.g. Manager') }}" value="{{ old('position') }}">
                                @error('position')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="job_desc" class="form-label">{{ __('Job Description') }}</label>
                                <textarea name="job_desc" id="job_desc" class="form-control @error('job_desc') is-invalid @enderror"
                                    placeholder="{{ __('e.g. Responsible for managing a team of sales representatives') }}">{{ old('job_desc') }}</textarea>
                                @error('job_desc')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="button" id="save-employee-history" data-id="{{ $employee->id }}"
                        class="btn btn-primary ml-1" data-bs-dismiss="modal">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Save</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
