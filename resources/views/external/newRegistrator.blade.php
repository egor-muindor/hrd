@extends('layouts.app')
@section('content')
    <apps debug="false" csrf="{{ csrf_token() }}" route="{{ route('registration.store') }}"></apps>
@endsection

<style media="screen">

    body {
        background-color: #F8FAFC;
    }

    label {
        display: block;
        margin-bottom: 0;
    }

    section {
        margin-top: 40px;
    }

    select {
        padding: 5px;
        font-size: 16px;
        border: 1px solid #ccc;
        height: 34px;
    }

    p {
        margin-bottom: 0;
    }

    h2 {
        text-align: center;
        margin-bottom: 30px;
    }


    .col {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .page {
        min-width: 320px;
    }

    .main-header {
        text-align: center;

        min-height: 80px;
        padding-bottom: 20px;
    }

    .logotype {
        width: 300px;
        height: auto;
    }

    .input {
        width: 100%;
        min-width: 150px;
        padding-left: 10px;
        padding-right: 10px;

        margin-top: 20px;
    }

    .btn-form {
        display: block;

        margin: 0 auto;
        margin-top: 20px;
    }

    .label-birth-place {
        white-space: nowrap;
        border: none;
    }

    .input-birth-place {
        min-width: 300px;
    }

    .col {
        padding-bottom: 10px;
    }

    .page {
        margin: 0 auto;
        display: block;
    }

    .table {
        border-radius: 10px;
    }

    .table {
        text-align: center;

        border-collapse: collapse;
        border: 1px solid #ced4da;
        border-radius: 10px;
    }

    .table thead th {
        vertical-align: middle;
    }

    .table tr {
        border: none;
    }

    .table thead th {
        border-top: none;
        border-bottom: none;
    }

    .table select {
        margin-top: 25px;
    }

    .government-award__table td:last-child,
    .stay-abroad__table td:last-child {
        width: 100%;
    }


    .success {
        color: #28a745;
    }

    .fail {
        color: #dc3545;
    }

    .education__description {
        text-align: center;
    }

    .textarea {
        width: 100%;
        min-width: 200px;
        resize: none;
    }

    .autobiography__textarea {
        min-height: 200px;
        resize: vertical;
        padding-left: 10px;
        padding-top: 10px;
    }

    .skills {
        margin-top: 20px;
    }

    .sex {
        width: 100%;
    }

    .container {
        margin-top: 10px;
        margin-bottom: 20px;
        padding-top: 20px;
        padding-bottom: 20px;
        padding-left: 20px;
        padding-right: 20px;

        background-color: #fff;
        box-shadow: 0 20px 20px 20px rgba(0, 0, 0, 0.04);
    }

    /* Crop */

    .crop {
        text-align: center;
    }

    .btn-crop {
        display: block;
        margin: 0 auto;
    }

    .status-crop {
        display: inline-block;
        width: auto;
        padding-left: 10px;
        padding-right: 10px;
    }

    .croppa-container {
        border: 2px solid grey;
        border-radius: 8px;
        margin-top: 10px;

        background-color: #E6E6E6;
    }

    .croppa-container:hover{
        opacity: 1;
        background-color: #F0F0F0;
    }

    .icon-remove {
        top: -11.75px;
        right: -10.75px;
    }

    /* Оформление */

    .label-box {
        position: relative;
    }

    .label-box::before,
    .label-box::after {
        position: absolute;
        bottom: 1px;
        width: 0;
        height: 2px;
        background-color: #757575;
        content: "";
        transition-duration: 0.2s;
        transition-property: width;
    }

    .label-box::before {
        left: 50%;
    }

    .label-box::after {
        right: 50%;
    }

    input:focus + .label-box::before,
    input:focus + .label-box::after {
        width: 50%;
    }

    input {
        box-sizing: border-box;
        border: none;
        border-bottom: 1px solid #757575;
        font-size: 18px;

        margin-top: 20px;
        padding-bottom: 10px;

        outline: none;
    }

    label {
        position: absolute;
        top: -38px;
        left: 10px;
        color: #000;
        font-size: 14px;
        transition-duration: 0.2s;
        pointer-events: none;
    }

    input + .label-box label {
        transform: translateY(-22px);
    }

    .birth-date {
        padding-left: 10px;
    }

    .sex {
        min-height: 39px;
        margin-top: 20px;
        border: none;
        border-bottom: 1px solid #757575;
    }

    .label-sex {
        font-size: 14px;
        transform: translateY(-20px);
    }

    .label-birth-date {
        font-size: 14px;
        transform: translateY(-22px);
    }

    .input-birth-place {
        margin-top: 20px;
    }

    .form-study {
        margin-top: 15px;
    }

    .work-activity__description {
        text-align: center;
        font-size: 18px;
        margin-bottom: 20px;
    }

    .work-activity__note {
        margin-top: 20px;
        margin-left: 20px;
        margin-right: 20px;
    }

    .note-star {
        font-size: 30px;
        color: #dc3545;
    }


    .family-status__description {
        text-align: center;
        margin-bottom: 15px;
    }

</style>
