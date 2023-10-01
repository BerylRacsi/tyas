<div class="card-header">
    <div class="row">
        <div class="col-6">
            <h5 id="form-title" class="text-bold text-black"></h5>
        </div>
        <div class="col-6">
            <div class="btn-group float-right" role="group">
                <button type="button" class="btn btn-outline-secondary btn-sm" data-toggle="tooltip"
                    data-placement="bottom" title="Back to Table" id="btn-back">
                    <i class="fas fa-arrow-left"></i> <strong>Back</strong>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="card-body">
    <form id="main-form">
        @csrf
        <input type="hidden" id="id" name="id">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name" class="form-label font-weight-bold">Name <span
                        class="text-danger">*</span></label>
                <input type="text" name="name" id="name" class="form-control form-control-sm">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email" class="form-label font-weight-bold">Email <span
                        class="text-danger">*</span></label>
                <input type="email" name="email" id="email" class="form-control form-control-sm">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="password" class="form-label font-weight-bold">Password <span
                        class="text-danger">*</span></label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-eye"></i>
                        </div>
                        <div class="input-group-text">
                            <input type="checkbox" onclick="showPassword()">
                        </div>
                    </div>
                    <input type="password" name="password" id="password" class="form-control form-control-sm">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="department" class="form-label font-weight-bold">Department <span
                        class="text-danger">*</span></label>
                <select name="department" id="department" class="form-control form-control-sm">
                    <option value="" disabled hidden selected>Please Select</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="position" class="form-label font-weight-bold">Position <span
                        class="text-danger">*</span></label>
                <input type="text" name="position" id="position" class="form-control form-control-sm">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="role" class="form-label font-weight-bold">Role <span
                        class="text-danger">*</span></label>
                <select name="role[]" id="role" class="form-control form-control-sm" multiple="multiple">
                    @foreach ($roles as $role)
                        <option class="text-black" value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>
</div>
<div class="card-footer d-flex justify-content-center">
    <button type="submit" class="btn btn-sm btn-primary text-bold" id="btn-request-submit">
        <span class="spinner-border spinner-border-sm loading-overlay-process" role="status" hidden="true"></span>
        Submit
    </button>
</div>
