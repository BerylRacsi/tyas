<div class="card-header">
    <div class="row">
        <div class="col-6">
            <h5 id="form-title" class="text-bold text-black"></h5>
        </div>
        <div class="col-6">
            <div class="btn-group float-right" role="group">
                <button type="button" class="btn btn-outline-secondary btn-sm"
                    data-toggle="tooltip" data-placement="bottom" title="Back to Table" id="btn-back">
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
                <label for="department" class="form-label font-weight-bold">Department Name <span class="text-danger">*</span></label>
                <input type="text" name="department" id="department" class="form-control form-control-sm">
            </div>
        </div>
    </form>
</div>
<div class="card-footer d-flex justify-content-center">
    <button type="submit" class="btn btn-sm btn-primary text-bold" id="btn-request-submit">
        <span class="spinner-border spinner-border-sm loading-overlay-process" role="status"
            hidden="true"></span>
        Submit
    </button>
</div>