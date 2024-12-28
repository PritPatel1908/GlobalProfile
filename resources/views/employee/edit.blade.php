@extends('layout')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Employee</h2>
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

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<form action="{{ route('employee.update',$employee->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group">
                <strong>Employee Image <span style="color: red;">*</span></strong>
                <input type="file" name="emp_image" class="form-control" placeholder="Employee Image">
                <img style="width: 75px;height: 55px;margin-top: 10px;" src="{{ asset('uploads/images/'.$employee->emp_image) }}">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
                <strong>Employee Name <span style="color: red;">*</span></strong>
                <input type="text" name="emp_name" class="form-control" placeholder="Employee Name" required value="<?php echo $employee->emp_name; ?>">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
                <strong>Email <span style="color: red;">*</span></strong>
                <input type="email" name="email" class="form-control" placeholder="Email" required value="<?php echo $employee->email; ?>">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
                <strong>Current Employer Name <span style="color: red;">*</span></strong>
                <input type="text" name="employee_name" class="form-control" placeholder="Current Employer Name" required value="<?php echo $employee->employee_name; ?>">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
                <strong>Employee Code <span style="color: red;">*</span></strong>
                <input type="text" name="employee_code" class="form-control" placeholder="Employee Code" required value="<?php echo $employee->employee_code; ?>">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
                <strong>Contact Number <span style="color: red;">*</span></strong>
                <input type="number" name="contact_number" class="form-control" placeholder="Contact Number" required value="<?php echo $employee->contact_number; ?>" oninput="checkMaxLength(this, 10)">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
                <strong>Family Contact Number <span style="color: red;">*</span></strong>
                <input type="number" name="family_contact_number" class="form-control" placeholder="Family Contact Number" required value="<?php echo $employee->family_contact_number; ?>" oninput="checkMaxLength(this, 10)">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="form-group">
                <strong>Gender <span style="color: red;">*</span></strong>
                <select name="gender" id="gender" required class="form-control">
                    <option value="">--- Select ---</option>
                    <option <?php echo $employee->gender == "Male" ? "selected" : ""; ?> value="Male">Male</option>
                    <option <?php echo $employee->gender == "Female" ? "selected" : ""; ?> value="Female">Female</option>
                    <option <?php echo $employee->gender == "Other" ? "selected" : ""; ?> value="Other">Other</option>
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="form-group">
                <strong>Date of Birth <span style="color: red;">*</span></strong>
                <input type="text" id="dob" name="dob" class="form-control datepicker txt_datepicker" placeholder="Date of Birth" required autocomplete="off" value="<?php echo $employee->dob; ?>">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="form-group">
                <strong>Nationality <span style="color: red;">*</span></strong>
                <input type="text" name="nationality" class="form-control" placeholder="Nationality" required value="<?php echo $employee->nationality; ?>">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group">
                <strong>Address <span style="color: red;">*</span></strong>
                <textarea name="address" id="address" cols="30" rows="5" required class="form-control"><?php echo $employee->address; ?></textarea>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
                <strong>Date of Issue (Card) <span style="color: red;">*</span></strong>
                <input type="text" name="card_date_of_issue" id="card_date_of_issue" class="form-control txt_datepicker" placeholder="Date of Issue (Card)" required autocomplete="off" value="<?php echo $employee->card_date_of_issue; ?>">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
                <strong>Valid Till (Card) <span style="color: red;">*</span></strong>
                <input type="text" name="card_valid_till" id="card_valid_till" class="form-control txt_datepicker" placeholder="Valid Till (Card)" required autocomplete="off" value="<?php echo $employee->card_valid_till; ?>">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>

</form>
@endsection
