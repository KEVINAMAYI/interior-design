@extends('layouts.mail')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="col-lg-5">
                <div class="card mt-3">
                    <div class="card-body py-5 px-lg-5">
                        <div class="avatar avatar-xl position-relative">
                            <img  src="https://i.postimg.cc/fb2nFwJ9/gsm-logo-transparent.png"
                                 alt="logo"
                                 class="signature-logo border-radius-lg shadow-sm">
                        </div>
                        <p class="mt-3 mb-1">
                            Hi GSM,
                            <br>
                            <br>
                            {{ $data['message'] }}
                        </p>


                        <h4 style="" class="fw-normal text-dark mt-4">
                            Client/Prospect Details
                        </h4>
                        <p class="mt-2 mb-1">
                            <strong>Name : {{ $data['name'] }}</strong>
                        </p>
                        <p class="mb-1">
                            <strong>Email : {{ $data['email'] }}</strong>
                        </p>

                    </div>
                </div>
                <div class="signature">
                    <img src="https://i.postimg.cc/fb2nFwJ9/gsm-logo-transparent.png" alt="logo" class="signature-logo">
                    <div class="signature-info">
                        <p>GSM Interiors</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
