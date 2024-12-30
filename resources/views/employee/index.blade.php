@extends('layout')
@section('extra_css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.1/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('plugins/datatables/css/buttons.dataTables.css') }}">
    <!-- Datatable Responsive -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables/css/responsive.dataTables.css') }}">
    <style>
        img {
            width: 75px;
        }

        td {
            text-align: center;
        }
    </style>
@endsection

@section('content')
    <div class="pull-left">
        <a class="btn btn-primary" href="{{ route('logout.index') }}"> Logout</a>
    </div>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Global Profile</h2>
            </div>

            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('employee.create') }}"> Create New Employee</a>
            </div>

            <button type="button" class="btn btn-primary pull-right" style="margin-right: 10px;" data-toggle="modal"
                data-target="#exampleModal">
                Import Employees
            </button>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="file">Choose Excel File</label>
                            <input type="file" name="file" id="file" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-striped table-bordered dt-responsive nowrap" id="tbl_employee" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Action</th>
                <th>Image</th>
                <!-- <th>QR Code</th> -->
                <th>Employee ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Employer Name</th>
                <th>Employee Code</th>
                <th>Contact Number</th>
                <th>Company Name</th>
                <th>Company Employee Code</th>
                <th>Family Contact Number</th>
                <th>Gender</th>
                <th>DOB</th>
                <th>Nationality</th>
                <th>Address</th>
                <th>Card Date of Issue</th>
                <th>Card Valid Till</th>
                <th>Created At</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $EMP_QR_UPLOAD_PATH = config('constants.EMP_QR_UPLOAD_PATH');
            $i = 0;
            ?>
            @foreach ($employees as $employee)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>
                        <form action="{{ route('employee.destroy', $employee->id) }}" method="POST">
                            <!-- <a class="btn btn-info" href="{{ route('employee.show', $employee->id) }}" title="View"><i class="fa fa-eye"></i></a> -->
                            <a class="btn btn-info" href="{{ URL::to('/employee/view/' . $employee->emp_id) }}"
                                title="View">
                                <i class="fa fa-eye"></i>
                            </a>

                            <a class="btn btn-primary" href="{{ route('employee.edit', $employee->id) }}" title="Edit">
                                <i class="fa fa-edit"></i>
                            </a>

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger" title="Remove"
                                onclick="return remove('<?php echo $employee->id; ?>');">
                                <i class="fa fa-remove"></i>
                            </button>
                        </form>
                    </td>

                    <td>
                        <img src="{{ asset('storage/uploads/images/' . $employee->emp_image) }}">
                    </td>

                    <!-- TODO: Remove comment after add qucode -->
                    <!-- <td>
                                                                <?php
                                                                //$qrcode = asset($EMP_QR_UPLOAD_PATH . $employee->qr_code_path);
                                                                ?>
                                                                <img src="<?php //echo $qrcode;
                                                                ?>">
                                                            </td> -->

                    <td>{{ $employee->emp_id }}</td>

                    <td>{{ $employee->emp_name }}</td>

                    <td>{{ $employee->email }}</td>

                    <td>{{ $employee->employee_name }}</td>

                    <td>{{ $employee->employee_code }}</td>

                    <td>{{ $employee->contact_number }}</td>

                    {{-- @if ($employee->company_name !== null && count($employee->company_name) > 1) --}}
                    <td>
                        {{ implode(', ', $employee->company_name) }}
                    </td>
                    {{-- @else
                        <td>{{ $employee->company_name }}</td>
                    @endif --}}

                    {{-- @if ($employee->company_employee_code !== null && count($employee->company_employee_code) > 1) --}}
                    <td>
                        {{ implode(', ', $employee->company_employee_code) }}
                    </td>
                    {{-- @else
                        <td>{{ $employee->company_employee_code }}</td>
                    @endif --}}

                    <td>{{ $employee->family_contact_number }}</td>

                    <td>{{ $employee->gender }}</td>

                    <td>{{ $employee->dob }}</td>

                    <td>{{ $employee->nationality }}</td>

                    <td>{{ $employee->address }}</td>

                    <td>{{ $employee->card_date_of_issue }}</td>

                    <td>{{ $employee->card_valid_till }}</td>

                    <td>{{ $employee->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('extra_js')
    <!-- DataTables -->
    <script src="{{ asset('plugins/datatables/js/dataTables.js') }}"></script>
    <!-- Datatable Export Button -->
    <script src="{{ asset('plugins/datatables/js/dataTables.buttons.js') }}"></script>
    <script src="{{ asset('plugins/datatables/js/buttons.html5.min.js') }}"></script>
    <!-- Datatable Responsive -->
    <script src="{{ asset('plugins/datatables/js/dataTables.responsive.js') }}"></script>
    <script src="{{ asset('plugins/datatables/js/responsive.dataTables.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#tbl_employee").DataTable({
                responsive: true
            });
        });
    </script>

    <script>
        function remove(id) {
            var r = confirm("Are you sure you want to delete this record?");
            if (r == true) {
                return true;
            } else {
                return false;
            }
        }
    </script>
@endsection
