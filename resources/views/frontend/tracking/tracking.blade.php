@extends('frontend.main_master')
@section('content')
    <div class="contact_form">
        <div class="container">
            <div class="row">
                <div class="col-5 offset-lg-1">
                    <div class="contact_form_title">
                        <h4>Your Order Status</h4>
                    </div>
                    <div class="progress">
                        @if ($track->status == 0)
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 15%" aria-valuenow="15"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        @elseif ($track->status == 1)
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 15%" aria-valuenow="15"
                                aria-valuemin="0" aria-valuemax="100"></div>
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 30%" aria-valuenow="30"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        @elseif ($track->status == 2)
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 15%" aria-valuenow="15"
                                aria-valuemin="0" aria-valuemax="100"></div>
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 30%" aria-valuenow="30"
                                aria-valuemin="0" aria-valuemax="100"></div>
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 20%" aria-valuenow="20"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        @elseif ($track->status == 3)
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 15%" aria-valuenow="15"
                                aria-valuemin="0" aria-valuemax="100"></div>
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 30%" aria-valuenow="30"
                                aria-valuemin="0" aria-valuemax="100"></div>
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 20%" aria-valuenow="20"
                                aria-valuemin="0" aria-valuemax="100"></div>
                            <div class="progress-bar bg-success" role="progressbar" style="width: 35%" aria-valuenow="20"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        @else
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="15"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        @endif
                    </div>

                    @if ($track->status == 0)
                        <h5 class="text-danger mt-2">Note: Your Order Are Under Review</h5>
                    @elseif ($track->status == 1)
                        <h5 class="text-primary mt-2">Note: Paymet Accept Under Process</h5>
                    @elseif ($track->status == 2)
                        <h5 class="text-warning mt-2">Note: Packing Done Handover Process</h5>
                    @elseif ($track->status == 3)
                        <h5 class="text-success mt-2">Note: Order Complete</h5>
                    @else
                        <h5 class="text-danger mt-2">Note: Order Cancel</h5>
                    @endif
                </div>
                <div class="col-5 offset-lg-1">
                    <div class="contact_form_title">
                        <h4>Your Order Detail</h4>
                    </div>
                    <ul class="list-group col-lg-12">
                        <li class="list-group-item  list-group-item-action active">
                            <b>Paymet Type: </b> <span style="float: right;">{{ $track->payment_type }}</span>
                        </li>
                        <li class="list-group-item  list-group-item-action">
                            <b>Transaction Id: </b> <span style="float: right;">{{ $track->payment_id }}</span>
                        </li>
                        <li class="list-group-item  list-group-item-action">
                            <b>Banlance ID: </b> <span style="float: right;">{{ $track->blnc_transection }}</span>
                        </li>
                        <li class="list-group-item  list-group-item-action">
                            <b> Subtotal: </b> <span style="float: right;">$ {{ $track->subtotal }}</span>
                        </li>
                        <li class="list-group-item  list-group-item-action">
                            <b>Shipping: </b> <span style="float: right;">$ {{ $track->shipping }}</span>
                        </li>
                        <li class="list-group-item  list-group-item-action">
                            <b>Vat: </b> <span style="float: right;">$ {{ $track->vat }}</span>
                        </li>
                        <li class="list-group-item  list-group-item-action">
                            <b>Total: </b> <span style="float: right;">$ {{ $track->total }}</span>
                        </li>
                        <li class="list-group-item  list-group-item-action">
                            <b>Month: </b> <span style="float: right;">{{ $track->month }}</span>
                        </li>
                        <li class="list-group-item  list-group-item-action">
                            <b>Date: </b> <span style="float: right;">{{ $track->date }}</span>
                        </li>
                        <li class="list-group-item  list-group-item-action">
                            <b>Year: </b> <span style="float: right;">{{ $track->year }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
