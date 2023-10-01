<div class="card-header">
    <div class="row">
        <div class="col-6">
            <h5 class="text-bold text-black">Department</h5>
        </div>
        <div class="col-6">
            <div class="btn-group float-right" role="group">
                <button type="button" class="btn btn-outline-secondary btn-sm" data-toggle="tooltip"
                    data-placement="bottom" title="Add" id="btn-add">
                    <i class="fas fa-plus"></i>
                </button>
                <button type="button" class="btn btn-outline-secondary btn-sm" data-toggle="tooltip"
                    data-placement="bottom" title="Edit" id="btn-edit">
                    <i class=" fas fa-pencil-alt"></i>
                </button>
                <button type="button" class="btn btn-outline-secondary btn-sm" data-toggle="tooltip"
                    data-placement="bottom" title="Delete" id="btn-delete">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="card-body">
    <div id="main-spinner" class="mb-3">
        <div class="d-flex justify-content-center">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>
    <table class="table table-hover table-bordered" id="main-table">
        <thead class="thead-dark">
            <tr>
                <th>Department Name</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
