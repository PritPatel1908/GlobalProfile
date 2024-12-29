@extends('layout')

@section('extra_css')
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }

        /* Card Container Styles */
        .card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px auto;
            max-width: auto;
        }

        /* Card Header Styles */
        .card-header {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }

        /* Form Group Styles */
        .form-group {
            margin-bottom: 15px;
        }

        /* Input and Textarea Styles */
        .form-control {
            0 border: 1px solid #ced4da;
            border-radius: 4px;
            /* padding: 10px; */
            font-size: 14px;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
        }

        /* Button Styles */
        .btn {
            padding: 10px 15px;
            font-size: 14px;
            border-radius: 4px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .btn-info {
            background-color: #17a2b8;
            color: white;
            border: none;
        }

        .btn-info:hover {
            background-color: #138496;
            transform: scale(1.05);
        }

        /* Select Styles */
        select.form-control {
            appearance: none;
            background: url('data:image/png;base64,...') no-repeat right 10px center;
            /* Add a custom arrow */
            background-size: 12px;
        }

        /* Textarea Styles */
        textarea.form-control {
            resize: vertical;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .card {
                padding: 15px;
            }
        }

        /* Centered Button Styles */
        .text-center {
            text-align: center;
        }

        /* Error Message Styles */
        span.error {
            color: red;
            font-size: 12px;
        }

        .camera-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px 0;
            display: flex;
            align-items: center;
            flex-direction: column;
        }

        .button-container {
            display: flex;
            justify-content: center;
            /* margin-bottom: 15px; */
        }

        .camera-card {
            background-color: #fefefe; /* Light background */
            border: 1px solid #e0e0e0; /* Subtle border */
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" /> --}}
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Edit Employee (EmpId : {{ $employee->emp_id }})</h2>
                    </div>
                    <div class="pull-right">
                         <a class="btn btn-primary" href="{{ route('employee.index') }}"> Back</a>
                    </div>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        </div>
        <form action="{{ route('employee.update',$employee->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                {{-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="form-group">
                    <strong>Employee Image <span style="color: red;">*</span></strong>
                    <input type="file" name="emp_image" class="form-control" placeholder="Employee Image" required>
                </div>
            </div> --}}
                <input type="hidden" name="emp_image" class="image-tag">
                <input type="hidden" id="emp_image" value="{{ $employee->emp_image }}">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <strong>Employee Name <span style="color: red;">*</span></strong>
                                <input type="text" name="emp_name" class="form-control" placeholder="Employee Name"
                                    required value="{{ $employee->emp_name }}">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <strong>Email <span style="color: red;">*</span></strong>
                                <input type="email" name="email" class="form-control" placeholder="Email" required value="{{ $employee->email }}">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <strong>Current Employer Name <span style="color: red;">*</span></strong>
                                <input type="text" name="employee_name" class="form-control"
                                    placeholder="Current Employer Name" required value="{{ $employee->employee_name }}">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <strong>Employee Code <span style="color: red;">*</span></strong>
                                <input type="text" name="employee_code" class="form-control" placeholder="Employee Code"
                                    required value="{{ $employee->employee_code }}">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <strong>Contact Number <span style="color: red;">*</span></strong>
                                <input type="number" name="contact_number" class="form-control"
                                    placeholder="Contact Number" required oninput="checkMaxLength(this, 10)" value="{{ $employee->contact_number }}">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <strong>Family Contact Number <span style="color: red;">*</span></strong>
                                <input type="number" name="family_contact_number" class="form-control"
                                    placeholder="Family Contact Number" required oninput="checkMaxLength(this, 10)" value="{{ $employee->family_contact_number }}">
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="camera-card">
                            <div class="button-container">
                                <input type="button" class="btn btn-sm btn-primary" id="open_camera" value="Open Camera">
                                <input type="button" style="display: none;" class="btn btn-sm btn-primary" id="close_camera" value="Close Camera" onClick="resetWebcam()">
                            </div>
                            <div id="my_camera" class="d-none" style="none"></div>
                            <div class="button-container">
                                <input type="button" id="take_snap" value="Take Snapshot" onClick="take_snapshot()" class="btn btn-info btn-sm" style="display: none">
                                <input type="hidden" name="image" class="image-tag">
                            </div>
                            <div id="results"></div>
                            <img class="temp_img" style="margin-top: 5px;" src="{{ asset('storage/uploads/images/' . $employee->emp_image) }}"/>
                        </div>
                    </div>
                </div>

                <!-- New Fields for Company Name and Company Employee Code -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div id="company-fields">
                        @for ($i = 0; $i < count($company_names); $i++)
                            <div class="company-entry">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <strong>Company Name <span style="color: red;">*</span></strong>
                                        <input type="text" name="company_name[]" class="form-control" placeholder="Company Name" required value="{{ $company_names[$i] }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <strong>Company Employee Code <span style="color: red;">*</span></strong>
                                        <input type="text" name="company_employee_code[]" class="form-control" placeholder="Company Employee Code" required value="{{ $company_employee_codes[$i] }}">
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center" style="">
                        <div class="form-group">
                            <button type="button" id="add-company">Add Another Company</button>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <strong>Gender <span style="color: red;">*</span></strong>
                        <select name="gender" id="gender" required class="form-control">
                            <option value="">--- Select ---</option>
                            <option @if ($employee->gender == 'Male') selected @endif value="Male">Male</option>
                            <option @if ($employee->gender == 'Female') selected @endif value="Female">Female</option>
                            <option @if ($employee->gender == 'Other') selected @endif value="Other">Other</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <strong>Date of Birth <span style="color: red;">*</span></strong>
                        <input type="text" id="dob" name="dob"
                            class="form-control datepicker txt_datepicker" placeholder="Date of Birth" required
                            autocomplete="off" value="{{ $employee->dob }}">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <strong>Nationality <span style="color: red;">*</span></strong>
                        <input type="text" name="nationality" class="form-control" placeholder="Nationality"
                            required value="{{ $employee->nationality }}">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <strong>Address <span style="color: red;">*</span></strong>
                        <textarea name="address" id="address" cols="30" rows="5" required class="form-control">{{ $employee->address}}</textarea>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <strong>Date of Issue (Card) <span style="color: red;">*</span></strong>
                        <input type="text" name="card_date_of_issue" id="card_date_of_issue"
                            class="form-control txt_datepicker" placeholder="Date of Issue (Card)" required
                            autocomplete="off" value="{{ $employee->card_date_of_issue }}">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <strong>Valid Till (Card) <span style="color: red;">*</span></strong>
                        <input type="text" name="card_valid_till" id="card_valid_till"
                            class="form-control txt_datepicker" placeholder="Valid Till (Card)" required
                            autocomplete="off" value="{{ $employee->card_valid_till }}">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>

        </form>
    </div>
@endsection

@section('extra_js')
    <script language="JavaScript">
        $("#open_camera").click(function() {
            $("#my_camera").show();
            $("#take_snap").show();
            $("#close_camera").show();
            $("#open_camera").hide();

            Webcam.set({
                width: 250,
                height: 190,
                image_format: 'png',
                png_quality: 90
            });
            Webcam.attach('#my_camera');
        });

        function take_snapshot() {
            $("#my_camera").hide();
            $("#take_snap").hide();
            $(".temp_img").hide();
            Webcam.snap(function(data_uri) {
                $(".image-tag").val(data_uri);
                document.getElementById('results').innerHTML = '<img style="margin-top: 5px;" src="' + data_uri + '"/>';
            });
            resetWebcam();
        }

        function resetWebcam() {
            $("#my_camera").hide();
            $("#take_snap").hide();
            $("#close_camera").hide();
            $("#open_camera").show();
            Webcam.reset();
        }
    </script>
    
    <script>
        var companyFields = document.getElementById('company-fields');
        if (companyFields.children.length == 5) {
            var addBtn = document.getElementById('add-company');
            addBtn.style.display = 'none';
        }
        
        document.getElementById('add-company').addEventListener('click', function() {
            var companyFields = document.getElementById('company-fields');
            if (companyFields.children.length == 4) {
                var addBtn = document.getElementById('add-company');
                addBtn.style.display = 'none';
            }

            if (companyFields.children.length < 5) {
                var newEntry = document.createElement('div');
                newEntry.className = 'company-entry';
                newEntry.innerHTML = `
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <strong>Company Name <span style="color: red;">*</span></strong>
                            <input type="text" name="company_name[]" class="form-control" placeholder="Company Name" required>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <strong>Company Employee Code <span style="color: red;">*</span></strong>
                            <input type="text" name="company_employee_code[]" class="form-control" placeholder="Company Employee Code" required>
                        </div>
                    </div>
                `;
                companyFields.appendChild(newEntry);
            } 
            // else {
            //     var addBtn = document.getElementById('add-company');
            //     addBtn.style.display = 'none';
            //     // alert("You can only add up to 5 companies.");
            // }
        });
    </script>
@endsection
