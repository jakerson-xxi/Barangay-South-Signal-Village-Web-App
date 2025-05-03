@include('admin/adminHeader')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.bootstrap5.min.css"> -->
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.3.0/css/dataTables.dateTime.min.css">

<div class="content my-3">

    <p class="display-6"><i class="bi bi-people-fill"></i> <strong>Process Concern</strong></p>
    <hr style="color: black;">
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <i class="bi bi-info-circle"></i> This pagethis page is intended for processing the submitted concerns. This may include reviewing, approving, or rejecting the concerns, as well as any other actions required to fulfill the request.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <div class="my-3">
        <a class="" style="text-decoration: none;color: inherit;" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            <i class="bi bi-funnel-fill"></i>Show filter
        </a>
        <div class="collapse mt-3" id="collapseExample">
            <div class="container text-center">
                <div class="row">
                    <div class="col-6">
                        <div class="form-check">
                            <label class="form-label">Concern Status:</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input filter-checkbox" type="checkbox" value="PENDING">
                                <label class="form-check-label" for="inlineCheckbox1">
                                    <p class="badge bg-warning text-wrap status-class" style="width: 6rem;">PENDING</p>
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input filter-checkbox" type="checkbox" value="PROCESSING">
                                <label class="form-check-label" for="inlineCheckbox2">
                                    <p class="badge bg-info text-wrap status-class" style="width: 6rem;background-color:#0d6efd">PROCESSING</p>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="exampleInputEmail1" class="form-label ">Type of concern</label>
                        <div class="md-flex mb-3 col">
                            <select id="docTypeDrop" class="form-select form-select-sm md-flex mx-auto w-50" aria-label="Default select example">
                                <option value='' selected>All</option>
                                <option value="Infrastructure">Infrastructure (Infrastraktura) (e.g electricity, water, street lights, etc.)</option>
                                <option value="Transportation">Transportation (Transportasyon)</option>
                                <option value="Environmental">Environmental (Pangkalikasan) </option>
                                <option value="Health & Sanitation">Health & Sanitation (Pangkalusugan)</option>
                                <option value="Safety & Security">Safety & Security (Pangkaligtasan)</option>
                                <option value="Social Welfare">Social Welfare (barangay assistance)</option>
                                <option value="Resident Account">Resident Account</option>
                                <option value="Others">Others (at iba pa)</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 text-center">
                        <table borders="0" cellspacing="5" cellpadding="5">
                            <tbody>
                                <tr>
                                    <td>Minimum date:</td>
                                    <td><input class="form-control" type="text" id="min" name="min"></td>
                                </tr>
                                <tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-6 text-center">
                        <table borders="0" cellspacing="5" cellpadding="5">
                            <tbody>
                                <tr>
                                    <td>Maximum date:</td>
                                    <td><input class="form-control" type="text" id="max" name="max"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <table id="resident" class="table table-bordered table-hover mt-3" style="width:100%">
        <thead class="table-dark">

            <tr>
                <th class="text-center">Reference Key</th>
                <th class="text-center">Concern Type </th>
                <th class="text-center">Concern Description</th>
                <th class="text-center">Resident</th>
                <th class="text-center">Date</th>
                <th class="text-center">Status</th>
                <th class="text-center">Processed by:</th>
                <th class="text-center">Action:</th>

            </tr>
        </thead>
        <tbody>
            @foreach($admin_info as $admin)
            @foreach($request as $request)
            @if($request->concern_status == 'PENDING' || ($request->concern_status == 'READY FOR PAYMENT' && $request->concern_processed_by == $admin->first_name." " .$admin->last_name ) || ($request->concern_status == 'PROCESSING' && $request->concern_processed_by == $admin->first_name." " .$admin->last_name ))
            <tr>
                <td style="text-transform: uppercase;">{{$request->reference_key}}</td>
                <td style="text-transform: uppercase;">{{$request->concern_type}}</td>
                <td style="text-transform: uppercase; "><span class="d-inline-block " style="max-width: 170px;">
                        {{$request->concern_title}}
                    </span></td>
                <td style="text-transform: uppercase;">{{$request->first_name." ".$request->last_name}}</td>
                <td style="text-transform: uppercase;">{{date('Y-m-d', strtotime($request->concern_created_at))}}</td>
                <td style="text-transform: uppercase;">

                    @if($request->concern_status == 'PENDING')
                    <p class="badge bg-warning text-wrap status-class" style="width: 6rem;">PENDING</p>
                    @endif
                    @if($request->concern_status == 'DENIED')
                    <p class="badge bg-danger text-wrap status-class" style="width: 6rem;">DENIED</p>
                    @endif
                    @if($request->concern_status == 'READY FOR PAYMENT')
                    <p class="badge bg-success text-wrap status-class" style="width: 6rem; background-color:#198754">READY FOR PAYMENT</p>
                    @endif
                    @if($request->concern_status == 'DONE')
                    <p class="badge bg-primary text-wrap status-class" style="width: 6rem;background-color:#0d6efd">DONE</p>
                    @endif
                    @if($request->concern_status == 'PROCESSING')
                    <p class="badge bg-info text-wrap status-class" style="width: 6rem;background-color:#0d6efd">PROCESSING</p>
                    @endif
                </td>
                @if($request->concern_processed_by == '')
                <td>Unassigned</td>
                @else
                <td style="text-transform: uppercase;">{{$request->concern_processed_by }}</td>
                @endif
                <td class="text-center">

                    <a href="process-concern-pending/{{$request->concern_id }}" type="submit" class="btn btn-dark btn-sm"><i class="bi bi-arrow-clockwise"></i> Process</a>

                </td>
            </tr>
            @endif
            @endforeach
            @endforeach
        </tbody>
    </table>
    <hr style="color: black;">
</div>


@foreach($admin_info as $admin)

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

@endforeach
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.colVis.min.js"></script>
<style>
    .hide-column {
        display: none;
    }
</style>
<script>
    var minDate, maxDate;

    // Custom filtering function which will search data in column four between two values
    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
            var min = minDate.val();
            var max = maxDate.val();
            var date = new Date(data[4]);

            if (
                (min === null && max === null) ||
                (min === null && date <= max) ||
                (min <= date && max === null) ||
                (min <= date && date <= max)
            ) {
                return true;
            }
            return false;
        }
    );
    $(document).ready(function() {
        minDate = new DateTime($('#min'), {
            format: 'MMMM Do YYYY'
        });
        maxDate = new DateTime($('#max'), {
            format: 'MMMM Do YYYY'
        });
        var table = $('#resident').DataTable({
            "search": {
                regex: true
            },
            responsive: true,
            order: [
                [5, 'asc'],
                [4, 'asc']
            ],
            responsive: true,
            buttons: [{
                extend: 'excel',
                className: 'btn btn-warning mt-3 me-1 border border-secondary',
                text: '<i class="bi bi-download"></i> Download as Excel',
                filename: 'BARANGAY SOUTH SIGNAL VILLAGE REQUEST LIST',
                title: 'BARANGAY SOUTH SIGNAL VILLAGE REQUEST LIST',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
            }, {
                extend: 'pdf',
                className: 'btn btn-warning mt-3 border border-secondary',
                text: '<i class="bi bi-download"></i> Download as PDF',
                filename: 'BARANGAY SOUTH SIGNAL VILLAGE REQUEST LIST',
                title: 'BARANGAY SOUTH SIGNAL VILLAGE REQUEST LIST',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6]
                }
            }]
        });

        $('#min, #max').on('change', function() {
            table.draw();
        });
        table.buttons().container()
            .appendTo('#resident_wrapper .col-md-6:eq(0)');
        $('.filter-checkbox').on('change', function() {
            filterDataTable();
        });
        $('#docTypeDrop').on('change', function() {
            if (this.value == "") {
                table.columns(1).search('').draw();
            } else {
                table.columns(1).search("^" + this.value + "$", true, false, true).draw();
            }
        });

        function filterDataTable() {
            var values = [];
            $('.filter-checkbox:checked').each(function() {
                values.push($(this).val());
            });
            table.column(5).search(values.join('|'), true, false).draw();
        }

    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.3.0/js/dataTables.dateTime.min.js"></script>

</html>