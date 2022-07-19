<div class="container bg-white shadow-sm rounded border-0 mt-2" style="height: max-content;">
    <div class="content p-4 px-2">
        <div class="header-title text-start">
            <span class="fw-bold fs-6 text-secondary">INPUT PRODUK</span>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-4">
                <div class="form-content mt-0">
                    <form method="POST" id="formproduct">
                        <div class="form-group">
                            <label class="fw-semibold text-secondary" for="selectpro">Choose Product</label>
                            <select class="form-control form-control-sm" name="prod" id="prod">
                                <option value="0">Select Product</option>
                                <option value="1">ABC</option>
                                <option value="2">DEF</option>
                                <option value="2">GHI</option>
                                <option value="2">JKL</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="fw-semibold text-secondary" for="partnum">Part Number</label>
                            <input type="text" class="form-control form-control-sm" name="partnum" id="partnum" placeholder="Part Number">
                        </div>
                        <div class="form-group">
                            <label class="fw-semibold text-secondary" for="serialnum">Serial Number</label>
                            <input type="text" class="form-control form-control-sm" name="serialnum" id="serialnum" placeholder="Serial Number">
                        </div>
                        <div class="form-group d-flex justify-content-end">
                            <button type="button" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="table-content mt-2">
                    <table class="table table-responsive table-hover table-striped table-bordered" id="tbl_prod">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Part Number</th>
                                <th>Serial Number</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>asdas</td>
                                <td>1123123</td>
                                <td>
                                    <button class="btn btn-sm btn-warning"><i class="fas fa-pencil fs-7set"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash fs-7set"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>1123123</td>
                                <td>1123123</td>
                                <td>
                                    <button class="btn btn-sm btn-warning"><i class="fas fa-pencil fs-7set"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash fs-7set"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>1123123</td>
                                <td>1123123</td>
                                <td>
                                    <button class="btn btn-sm btn-warning"><i class="fas fa-pencil fs-7set"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash fs-7set"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script>
            $('#tbl_prod').DataTable({})
        </script>
    </div>
</div>