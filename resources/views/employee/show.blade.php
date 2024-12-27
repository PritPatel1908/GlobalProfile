@extends('layout')

@section('content')

<style>
    body {
        background: #F1F3FA;
    }

    .profile {
        margin: 20px 0;
    }

    .profile-sidebar {
        padding: 20px 0 20px 0;
        background: #fff;
        border-bottom: 1px solid #e5e5e5;
    }

    .profile-userpic img {
        width: 50%;
    }

    .profile-content {
        padding: 20px;
        background: #fff;
    }

    .profile-user-info {
        display: table;
        width: 98%;
        width: calc(100% - 24px);
        margin: 0 auto
    }

    .profile-info-row {
        display: table-row
    }

    .profile-info-name,
    .profile-info-value {
        display: table-cell;
        border-top: 1px dotted #D5E4F1
    }

    .profile-info-name {
        text-align: right;
        padding: 6px 10px 6px 4px;
        font-weight: 400;
        color: #667E99;
        background-color: transparent;
        width: 155px;
        vertical-align: middle
    }

    .profile-info-value {
        padding: 6px 4px 6px 6px
    }

    .profile-info-value>span+span:before {
        display: inline;
        content: ",";
        margin-left: 1px;
        margin-right: 3px;
        color: #666;
        border-bottom: 1px solid #FFF
    }

    .profile-info-value>span+span.editable-container:before {
        display: none
    }

    .profile-info-row:first-child .profile-info-name,
    .profile-info-row:first-child .profile-info-value {
        border-top: none
    }
</style>

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h3>Employee Details</h3>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('employee.index') }}"> Back</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="profile-sidebar">
            <div class="profile-userpic text-center">
                <img src="{{ asset('uploads/images/'.$employee->emp_image) }}">
            </div>
        </div>

        <div class="profile-sidebar">
            <div class="profile-userpic text-center">
                <?php
                $EMP_QR_UPLOAD_PATH = config('constants.EMP_QR_UPLOAD_PATH');
                $qrcode = asset($EMP_QR_UPLOAD_PATH . $employee->qr_code_path);
                ?>
                <img src="<?php echo $qrcode; ?>">                
            </div>
        </div>      

    </div>

    <div class="col-md-9">
        <div class="profile-content">

            <div class="row">

                <div class="profile-user-info">
                    <div class="profile-info-row">
                        <div class="profile-info-name"> Employee ID </div>

                        <div class="profile-info-value">
                            <span>{{ $employee->emp_id }}</span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> Name </div>

                        <div class="profile-info-value">
                            <span> {{ $employee->emp_name }}</span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> Email </div>

                        <div class="profile-info-value">
                            <span> {{ $employee->email }}</span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> Employer Name </div>

                        <div class="profile-info-value">
                            <span> {{ $employee->employer_name }}</span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> Employee Code </div>

                        <div class="profile-info-value">
                            <span> {{ $employee->employee_code }}</span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> Contact Number </div>

                        <div class="profile-info-value">
                            <span> {{ $employee->contact_number }}</span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> Family Contact Number </div>

                        <div class="profile-info-value">
                            <span> {{ $employee->family_contact_number }}</span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> Gender </div>

                        <div class="profile-info-value">
                            <span> {{ $employee->gender }}</span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> Date of Birth </div>

                        <div class="profile-info-value">
                            <span> {{ $employee->dob }}</span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> Nationality </div>

                        <div class="profile-info-value">
                            <span> {{ $employee->nationality }}</span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> Address </div>

                        <div class="profile-info-value">
                            <span> {{ $employee->address }}</span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> Date of Issue (Card) </div>

                        <div class="profile-info-value">
                            <span> {{ $employee->card_date_of_issue }}</span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> Valid Till (Card) </div>

                        <div class="profile-info-value">
                            <span> {{ $employee->card_valid_till }}</span>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
</div>

@endsection