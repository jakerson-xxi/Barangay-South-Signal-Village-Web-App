@include('admin/adminHeader')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.3.0/css/dataTables.dateTime.min.css">
<style>
    input[type=number]::-webkit-outer-spin-button,
    input[type=number]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>
<style>
    .my-container {
        margin: 2em 4em 2em 4em;
    }

    .details-container {
        margin-top: 2em;
        border-top: 4px solid #AA0F0A;
        box-shadow: 0px 8px 8px 8px rgba(0, 0, 0, 0.2);
        border-radius: 7px;
    }

    .col-4 {
        padding: 2em 5em 0em 5em;
    }

    #payment-number {
        padding-top: 10px;
    }

    .hr-container {
        text-align: center;
    }

    .centered-hr {
        width: 100%;
        /* Set the desired width for the horizontal rule */
        margin: auto;
        padding-bottom: 2em;
        /* Center the horizontal rule */
    }

    .page-title {
        padding: 15px;
    }

    .container-bottom {
        text-align: center;
        padding-top: 3em;

    }

    .page-title {
        padding: 15px;
    }

    .modal-header {
        background-color: #AA0F0A;
        color: white;
    }

    .btn-close {
        background-color: white;
    }

    #confirm-payment {
        font-size: 110%;
        background-color: #AA0F0A;
        border: #AA0F0A;
    }

    #confirm-payment:hover {
        background-color: white;
        color: black;
        border: 2px solid #AA0F0A;
    }


    .tooltip-inner {
        font-size: 50px;
        /* Adjust the font size as needed */
    }

    #close-button {
        background-color: white;
        color: #AA0F0A;
        border: 2px solid #AA0F0A;
    }

    #close-button:hover {
        background-color: #AA0F0A;
        border: 2px solid white;
        color: white;
    }

    #proceed-button {
        background-color: #AA0F0A;
        color: white;
        border: 2px solid white;
    }

    #proceed-button:hover {
        background-color: white;
        border: 2px solid #AA0F0A;
        color: #AA0F0A;
    }
</style>
<div class="content my-3">


    <nav aria-label="breadcrumb">
        <ol class="breadcrumb fs-6">
            <li class="breadcrumb-item"><a href="{{url('listOnlinePayment')}}">All Payments</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$payment->payment_ref}}</li>
        </ol>
    </nav>
    <h2 id="payment-number">{{$payment->payment_ref}}
        <a href="{{url('paymongo_details')}}/{{$payment->payment_ref}}" target="_blank" type="submit"> <i class="bi bi-box-arrow-up-right h6"></i></a>
    </h2>
    <div class="container-fluid details-container">
        <div class="row">
            <div class="col-4">
                <h4 class="text-uppercase">Payment Details</h4>
                <div class="row pt-3 ">
                    <table class="table  table-borderless ms-2">
                        <tbody>
                            <tr>
                                <td>Gross Amount:</td>
                                <td>
                                    <p class="text-end">
                                        ₱ {{number_format($payment->request_price, 2, '.', '')}}
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>Fees <i class="bi bi-info-circle-fill" data-toggle="tooltip" title="Paymongo Service Charge" sty></i>
                                    : </td>
                                <td>
                                    <p class="text-end ">
                                        ₱ {{number_format($payment->service_charge, 2, '.', '')}}
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <hr style="width:100%">
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle">
                                    <p class="fw-semibold fs-5 ">Total Amount: </p>
                                </td>
                                <td class="align-middle">
                                    <p id="total-amount" class="fw-semibold fs-5 text-end">

                                        ₱ {{number_format($payment->service_charge + $payment->request_price, 2, '.', '')}}
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <div class="row mb-2">
                        @if($payment->payment_method == "gcash")
                        <!-- <h4 id="payment-method" class="pb-2">GCASH</h4> -->
                        <img src="https://assets-global.website-files.com/60c6db70dedd88514dfdf8e9/6149e904ea884776b634fd9d_GCash_Horizontal%20-%20Full%20Blue%20(Transparent).png" class="img-thumbnail" alt="...">

                        @elseif($payment->payment_method == "paymaya")
                        <!-- <h4 id="payment-method" class="pb-2">MAYA</h4> -->
                        <img src="https://assets-global.website-files.com/60c6db70dedd88514dfdf8e9/62ff6cd412d11d5bb2b55342_maya-logo.png" class="img-thumbnail" alt="...">
                        @else
                        <!-- <h4 id="payment-method" class="pb-2">GRAB PAY</h4> -->
                        <img src="https://assets-global.website-files.com/60c6db70dedd88514dfdf8e9/6149e904ea8847973534fda6_GCash_Horizontal---Full-Blue-(Transparent).png" class="img-thumbnail" alt="...">
                        @endif

                        <p class=" fst-italic mt-3" style="font-size: 12px;">Paid on: {{date("F j, Y g:i:s A", strtotime($payment->payment_date))}}</p>
                        <!-- <div class="col-2 pt-2">
                            <p>Paid on:</p>
                        </div>
                        <div class="col-10  pt-2" style="text-align: end;">
                            <p id="payment-date">

                            {{date("F j, Y g:i:s A", strtotime($payment->payment_date))}}
                       
                            </p>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="col-5 " style="border-right: 4px solid #AA0F0A;">
                <h4 class="text-uppercase mt-4">Request Details</h4>
                <div class="row pt-3 pe-5" style="padding-top: 10px;">
                    <table class="table table-borderless  ms-2 me-3">
                        <tbody>
                            <tr>
                                <td><strong>Reference Key:</strong></td>
                                <td class="text-end">{{$payment->reference_key}}</td>
                            </tr>
                            <tr>
                                <td><strong>Resident Name: </strong></td>
                                <td class="text-end">{{$payment->first_name . " " .$payment->middle_name . " " . $payment->last_name}}</td>
                            </tr>
                            <tr>
                                <td><strong>Type of application: </strong></td>
                                <td class="text-end">{{$payment->request_type_name}} <br>({{$payment->request_description}})</td>
                            </tr>
                            <tr>
                                <td><strong>Date of Request: </strong></td>
                                <td class="text-end">{{date("F j, Y g:i:s A", strtotime($payment->request_date))}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="hr-container">
                        <hr class="">
                    </div>


                </div>
            </div>
            <div class="col-3" style="background-color: rgb(238, 238, 238);">

                <div class="ms-3">
                    <h4 class="mt-4  text-uppercase">Billing Details</h4>
                    <h5 id="resident-name" class="mt-4">{{($billing['name'])}}</h5>
                </div>
                <div class="contact-details mt-4 ms-3">
                    <i class="bi bi-envelope-at-fill" id="customer-email"> {{($billing['email'])}}</i>
                    <br>
                    <br>
                    <i class="bi bi-telephone-fill" id="contact-num"> {{($billing['phone'])}}</i>
                </div>

            </div>
        </div>
    </div>
    <div class="container-fluid container-bottom">
        <!-- <a id="confirm-payment" href="{{url('confirmPayment')}}/{{$payment->request_id}}" type="btn" class="btn btn-primary">Confirm</a> -->
        <button type="button" id="proceed-button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Proceed</button>
    </div>

</div>
<form class="needs-validation" novalidate method="post" enctype="multipart/form-data" action="{{url('confirmPayment')}}">
    @csrf
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Payment Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-5">
                    <div class="alert alert-success">
                        <i class="bi bi-exclamation-circle-fill"></i> Please fill out the form completely and accurately.
                    </div>
                    <input type="hidden" value='{{$payment->request_id}}' name="reference">
                    <label for="exampleFormControlTextarea1" class="form-label">Ref. No: <span class="text-danger">*</span></label>
                    <input name="ref" class="w-100 form-control mb-2" type="number" required style="-webkit-appearance: none; margin: 0;" />
                    <label for="exampleFormControlTextarea1" class="form-label">OR. No: <span class="text-danger">*</span></label>
                    <input name="official_receipt" class="w-100 form-control mb-2" type="number" required style="-webkit-appearance: none; margin: 0;" />
                    <label for="exampleFormControlTextarea1" class="form-label">CTC. No: <span class="text-danger">*</span></label>
                    <input name="ctc" class="w-100 form-control mb-2" type="number" required style="-webkit-appearance: none; margin: 0;" />
                    <!-- <div class="row">
                        <div class="col-6">
                            <label class="fs-5 fw-semibold" for="official-receipt">Official Receipt: </label>
                        </div>
                        <div class="col-6" style="text-align: start;">
                            <input class="form-control" type="text" id="official-receipt" name="official_receipt" placeholder="ABC1234" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <label class="fs-5 fw-semibold text-start" for="official-receipt">CTC: </label>
                        </div>
                        <div class="col-6" style="text-align: start;">
                            <input class="form-control" type="text" id="ctc" name="ctc" placeholder="ABC1234" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <label class="fs-5 fw-semibold text-start" for="official-receipt">Reference #: </label>
                        </div>
                        <div class="col-6" style="text-align: start;">
                            <input class="form-control" type="text" id="ref" name="ref" placeholder="ABC1234" required>
                        </div>
                    </div> -->

                    <label for="payment-descrip" class="fs-5 fw-semibold mt-3">Description:</label>
                    <textarea class="form-control mt-2" name="payment_descrip" id="payment-descrip" rows="3" placeholder="Input text here"></textarea>

                </div>
                <div class="modal-footer">
                    <button id="close-button" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="proceed-button" type="submit" class="btn btn-primary">Confirm</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.3.0/js/dataTables.dateTime.min.js"></script>
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>

</html>