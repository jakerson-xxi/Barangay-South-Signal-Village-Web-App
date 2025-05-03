<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resident Dashboard</title>
    <link rel="icon" href="{{asset('assets/imgs/southsignalLogoLeft.png')}}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
    <title>User Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link href="{{asset('css/request.css')}}" rel="stylesheet">
    <style>
        img[src=""] {
            display: none;
        }

        .img-container {
            height: 350px;
            /* Set the fixed height for the image container */
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .img-container img {
            object-fit: cover;
            /* Maintain aspect ratio and cover the container */
            width: 100%;
            height: 100%;
        }
    </style>
</head>

<body style="background-color: rgba(163, 157, 157, 0.37);">
    @include('sweetalert::alert')
    <header>
        <nav class="main-header navbar navbar-expand " style="background-color: #AA0F0A;">
            <div class="container-fluid flex-sm-row">
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <a href="{{URL('userDashboard')}}" class="nav-link text-white font-weight-bold"><i class="bi bi-arrow-left-circle-fill"></i> BACK</a>
                    </li>
                </ul>
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <nobr class="nav-link text-white font-weight-bold"><span>ONLINE REQUEST FOR BARANGAY CLEARANCE</span></nobr>
                    </li>
                </ul>
                <ul class="navbar-nav ">
                    <li class="nav-item">
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <body>
        @foreach($user_info as $user)
        <form id="yourForm" method="post" enctype="multipart/form-data" action="{{url('submit-request')}}" class="needs-validation" novalidate>
            @csrf
            <input type="hidden" name="resident_id" value="{{$user->id}}">
            <input type="hidden" name="request_type_id" value="3">
            <input type="hidden" name="request_type_name" value="BRGY-CLR">
            <div class="container overflow-hidden mt-3">
                <div class="shadow p-3 mb-3 bg-body rounded ">
                    <p class="fs-4 fw-semibold text-center">PERSONAL INFORMATION</p>
                    <hr>
                    <div class="row my-3 text-center">
                        <div class="col-md-3 mb-2">
                            <p class="fs-6  mb-0">First Name: </p><strong>{{$user->first_name}}</strong>
                        </div>
                        <div class="col-md-3 mb-2">
                            <p class="fs-6  mb-0">Middle Name: </p><strong>{{$user->middle_name}}</strong>
                        </div>
                        <div class="col-md-3 mb-2">
                            <p class="fs-6  mb-0">Last Name: </p><strong>{{$user->last_name}}</strong>
                        </div>
                        @if($user->suffix == '')
                        <div class="col-md-3 mb-2">
                            <p class="fs-6  mb-0">Suffix: </p><strong>NONE</strong>
                        </div>
                        @else
                        <div class="col-md-3 mb-2">
                            <p class="fs-6  mb-0">Suffix: </p><strong>{{$user->suffix}}</strong>
                        </div>
                        @endif
                    </div>
                    <div class="row my-3 text-center">
                        <div class="col-md-3 mb-2">
                            <p class="fs-6  mb-0">Gender: </p><strong>{{strtoupper($user->gender)}}</strong>
                        </div>
                        <div class="col-md-3 mb-2">
                            <p class="fs-6  mb-0">Date of Birth: </p><strong>{{date('F j, Y', strtotime($user->birthdate))}}</strong>
                        </div>
                        <div class="col-md-3 mb-2">
                            <p class="fs-6  mb-0">Place of Birth: </p><strong>{{strtoupper($user->place_birth)}}</strong>
                        </div>
                        <div class="col-md-3 mb-2">
                            <p class="fs-6  mb-0">Civil Status: </p><strong>{{strtoupper($user->marital_status)}}</strong>
                        </div>
                    </div>
                    <div class="row my-3 text-center">
                        <div class="col-md-3 mb-2">
                            <p class="fs-6  mb-0">Room/Flr/Unit No. & Bldg: </p><strong>{{strtoupper($user->address_unitNo)}}</strong>
                        </div>
                        <div class="col-md-3 mb-2">
                            <p class="fs-6  mb-0">House/Lot & Block No.: </p><strong>{{strtoupper($user->address_houseNo)}}</strong>
                        </div>
                        <div class="col-md-3 mb-2">
                            <p class="fs-6  mb-0">Street: </p><strong>{{strtoupper($user->address_street)}}</strong>
                        </div>
                        <div class="col-md-3 mb-2">
                            <p class="fs-6  mb-0">Subd./ Phase/ Purok: </p><strong>{{strtoupper($user->address_purok)}}</strong>
                        </div>
                    </div>
                    <div class="row my-3 text-center">
                        <div class="col-md-3 mb-2">
                            <p class="fs-6  mb-0">Email: </p><strong>{{$user->email}}</strong>
                        </div>
                        <div class="col-md-3 mb-2">
                            <p class="fs-6  mb-0">Mobile Number: </p><strong>+63 {{strtoupper($user->mobile_num)}}</strong>
                        </div>

                        <div class="col-md-3 mb-2">
                            <p class="fs-6  mb-0">Valid ID (attached online): </p><strong>{{$user->valiID_type}}</strong>
                        </div>
                        <div class="col-md-3 mb-2">
                            <p class="fs-6  mb-0">Valid ID Number: </p><strong>{{strtoupper($user->validID_num)}}</strong>
                        </div>
                    </div>

                </div>
                <div class="shadow p-3 mb-3 bg-body rounded">
                    <p class="fs-4 fw-semibold text-center">ID INFORMATION</p>
                    <hr>
                    <div class="row my-3 text-center">
                        <div class="col-md-4 mb-2 img-container">
                            <img src="{{url('residentID/'.$user->validID_front)}}" class="img-fluid" alt="Front ID">
                        </div>
                        <div class="col-md-4 mb-2 img-container">
                            <img src="{{url('residentID/'.$user->validID_back)}}" class="img-fluid" alt="Back ID">
                        </div>
                        <div class="col-md-4 mb-2 img-container">
                            <img src="{{url('residentID/'.$user->face)}}" class="img-fluid" alt="Face Photo">
                        </div>
                    </div>
                </div>
                <div class="shadow p-3 mb-3 bg-body rounded ">
                    <p class="fs-4 fw-semibold text-center">OTHER INFORMATION</p>
                    <hr>
                    <div class="row my-3 ">
                        <div class="col-md-6 mb-2 text-center">
                            <p class="fs-6  mb-2 ">Living with Relatives? <br>(<em>Nakatira kasama ang mga Kamag-anak ?</em>)<span class="text-danger">*</span></p>
                            <select name="live_relatives" class="form-select form-control w-50 mx-auto d-block" aria-label="Default select example" required>
                                <option value="">Select...</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-2 text-center">
                            <p class="fs-6  mb-2 ">Type of Residency: <br>(<em>Uri ng Residensiya</em>)<span class="text-danger">*</span></p>
                            <select name="residency_type" class="form-select form-control w-50 mx-auto d-block" aria-label="Default select example" required>
                                <option value="">Select...</option>
                                <option value="House Owner">House Owner</option>
                                <option value="Renter">Renter</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="shadow p-4 mb-3 bg-body rounded ">
                    <p class="fs-4 fw-semibold text-center">REQUEST INFORMATION</p>
                    <hr>
                    <div class="row my-3 ">
                        <div class="col-md-4 mb-2">
                            <label class="text-start mb-2" for="">Type of Application (<em>Uri ng Aplikasyon</em>)<span class="text-danger">*</span> </label>
                            <select onchange="price_change()" name="request_description" id="applicationType" class="form-select form-control" aria-label="Default select example" required>
                                <option value="">Select...</option>
                                <option value="LOCAL EMPLOYMENT">LOCAL EMPLOYMENT</option>
                                <option value="TRAVEL/ EMPLOYMENT ABROAD">TRAVEL/ EMPLOYMENT ABROAD</option>
                                <option value="REFERENCE for AVON, Personal Coll. Collection, Boardwalk, Tupperware Mem.">REFERENCE for AVON, Personal Coll. Collection, Boardwalk, Tupperware Mem.</option>
                                <option value="REFERENCE for RENTER, Postal ID, School Requirement, PVAO and others">REFERENCE for RENTER, Postal ID, School Requirement, PVAO and others</option>
                                <option value="Fencing">Fencing</option>
                                <option value="LOAN Purpose">LOAN Purpose</option>
                                <option value="Renewal of (TRU) Franchise">Renewal of (TRU) Franchise</option>
                                <option value="4Ps Employment">4Ps Employment</option>
                                <option value="MERALCO Connection">MERALCO Connection</option>
                                <option value="MANILA WATER Connection">MANILA WATER Connection</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="text-start mb-2" for="">Purpose (<em>Layunin ng pag-aaplay</em>)<span class="text-danger">*</span> </label>
                            <textarea name="request_purpose" class="form-control" id="myTextarea" rows="1" required></textarea>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="text-start mb-2" for="">Price (<em>Halaga</em>)</label>
                            <input id="price_view" class="form-control" value="" type="text" readonly />
                            <input id="price" type="hidden" value="" name="price" />

                        </div>
                    </div>
                    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="myModalLabel">MGA KAILANGANG DALHIN:</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <ol>
                                        <li>Any Valid ID</li>
                                        <li>Other documents that may be required, such as:
                                            <ol type="a">
                                                <li>NBI or Police Clearance</li>
                                                <li>CFA from Lupon Office</li>
                                                <li>Apidabit</li>
                                                <li>List of items to be moved, time, plate number</li>
                                                <li>Medical Abstract or Drugs Prescription</li>
                                                <li>Death Certificate</li>
                                                <li>Tax Declaration</li>
                                                <li>TCT or Land Title</li>
                                                <li>Extra Judicial Settlement</li>
                                                <li>Waiver of Rights</li>
                                                <li>Deed of Sale</li>
                                                <li>Subdivision Plan</li>
                                                <li>Request Letter</li>
                                            </ol>
                                        </li>
                                    </ol>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="" id="upload_id" style="display: none;">
                        <label class="text-start mb-2" for="">Upload necessary requirement (<em>I-upload ang kinakailangang dokumento</em>)<span class="text-danger">*</span> </label>
                        <a href="" data-bs-toggle="modal" data-bs-target="#myModal">
                            here
                        </a>
                        <div class="mb-2 me-2">
                            <label for="Image" class="form-label"></label>
                            <input class="form-control me-3 MB-3" type="file" id="formFile" name="file" onchange="preview()">
                            <p class="fw-bolder fs-6 fst-italic  text-danger"><i class="bi bi-exclamation-circle"></i> Maximum allowed file size 20MB</p>
                            <div class="invalid-feedback m-3">
                                Please attach your ID.
                            </div>
                            <div class="d-flex align-items-center" id="hid">
                                <img id="frame" src="" class="img-fluid mx-auto" />
                            </div>
                            <div class="text-center">
                                <div class="text-center">
                                    <button onclick="clearImage()" class="btn mt-3" style="background-color:#AA0F0A; color: white;">Clear</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="shadow p-4 mb-3 bg-body rounded text-center">
                    <div class="form-group mb-2">
                        <nobr> <input onchange="isCheck(this)" type="checkbox" id="agree">&nbsp; <label for="" id="agreeText" style="cursor: pointer;"> I have read,</nobr> <strong>understood</strong>, and <strong>accepted</strong> the
                        <a href="/policy" target="_blank">Privacy Policy</a> and <a href="/terms" target="_blank">Terms & Conditions.</a></label>
                        <br>
                        <nobr><em>
                                &nbsp; <label for="" id="agreeText" style="cursor: pointer;"> Nabasa ko,</nobr> <strong>nauunawaan</strong>, at <strong>at tinanggap ko ang</strong> the
                        <a href="/policy" target="_blank">Patakaran sa Pagkapribado</a> at <a href="/terms" target="_blank">mga Tuntunin at Kondisyon.</a></label>
                        </em>
                    </div>
                    <div class="text-center">
                        <div class="d-flex justify-content-center mb-3"> <!-- Center the reCAPTCHA elements -->
                            {!! NoCaptcha::renderJs() !!}
                            {!! NoCaptcha::display() !!}
                        </div>
                    </div>
                    <button id="btn" type="submit" style="background-color:#AA0F0A; color: white;" class="btn d-block mx-auto " disabled>Request</button>

                </div>
            </div>
            </div>
            @endforeach
        </form>
        <!-- Modal -->
        <div class="modal fade" id="loadingModal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content ">
                    <div class="modal-body text-center my-3">
                        <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                        </div>
                        <p class="mt-3">Please wait...</p>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- <script src="{{asset('js/barangay_clearance.js')}}"></script> -->
    <script>
        var tooltipTriggerList = [].slice.call(
            document.querySelectorAll('[data-bs-toggle="tooltip"]')
        );
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        function price_change() {
            priceView = document.getElementById("price_view");
            price = document.getElementById("price");
            select = document.getElementById("applicationType").value;
            if (select == "") {
                priceView.value = "";
                price.value = "";
            }
            if (select == "LOCAL EMPLOYMENT") {
                priceView.value = "Php. 50.00";
                price.value = 50;
            } else if (select == "TRAVEL/ EMPLOYMENT ABROAD") {
                priceView.value = "Php. 100.00";
                price.value = 100;
            }
            if (
                select ==
                "REFERENCE for AVON, Personal Coll. Collection, Boardwalk, Tupperware Mem."
            ) {
                priceView.value = "Php. 50.00";
                price.value = 50;
            } else if (
                select ==
                "REFERENCE for RENTER, Postal ID, School Requirement, PVAO and others"
            ) {
                priceView.value = "Php. 100.00";
                price.value = 100;
            }
            if (select == "Fencing") {
                priceView.value = "Php. 200.00";
                price.value = 200;
            } else if (select == "LOAN Purpose") {
                priceView.value = "Php. 200.00";
                price.value = 200;
            }
            if (select == "Renewal of (TRU) Franchise") {
                priceView.value = "Php. 200.00";
                price.value = 200;
            } else if (select == "4Ps Employment") {
                priceView.value = "FREE";
                price.value = 0;
            }
            if (select == "MERALCO Connection") {
                priceView.value = "Php. 100.00";
                price.value = 100;
            } else if (select == "MANILA WATER Connection") {
                priceView.value = "Php. 100.00";
                price.value = 100;
            }
        }
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (() => {
            "use strict";

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll(".needs-validation");

            // Loop over them and prevent submission
            Array.from(forms).forEach((form) => {
                form.addEventListener(
                    "submit",
                    (event) => {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add("was-validated");
                    },
                    false
                );
            });
        })();

        function isCheck() {
            var checkbox = document.getElementById("agree").checked;
            if (checkbox) {
                document.getElementById("btn").disabled = false;
            } else {
                document.getElementById("btn").disabled = true;
            }
        }
        var select = document.getElementById("applicationType");
        select.addEventListener("change", showDiv);

        function showDiv() {
            var value = this.value;
            var div = document.getElementById("upload_id");
            if (value != "") {
                div.style.display = "block";
                document.getElementById("formFile").required = true;
            } else {
                div.style.display = "none";
                document.getElementById("formFile").required = false;
            }
        }

        function preview() {
            frame.src = URL.createObjectURL(event.target.files[0]);

            frame.width = "400";
            frame.height = "200";
        }

        function clearImage() {
            document.getElementById("formFile").value = null;
            frame.src = "";
            frame.width = "";
            frame.height = "";
        }
        var textarea = document.getElementById("myTextarea");
        textarea.addEventListener("input", resizeTextarea);

        function resizeTextarea() {
            this.style.height = "auto";
            this.style.height = this.scrollHeight + "px";
        }

        const fileInput = document.querySelector("#formFile");

        fileInput.addEventListener("change", function() {
            const file = fileInput.files[0];
            const acceptedImageTypes = ["image/jpeg", "image/png"];
            const maxFileSize = 20 * 1024 * 1024; // 20MB in bytes

            if (!file) {
                return; // No file selected
            }

            if (!acceptedImageTypes.includes(file.type)) {
                Swal.fire({
                    title: "Invalid file type",
                    text: "Please select an image file (JPEG, PNG).",
                    icon: "error",
                    confirmButtonColor: "#d33",
                });
                fileInput.value = "";
                frame.src = "";
                return;
            }

            if (file.size > maxFileSize) {
                Swal.fire({
                    title: "File too large",
                    text: "Please select a file that is 20MB or smaller.",
                    icon: "error",
                    confirmButtonColor: "#d33",
                });
                fileInput.value = "";
                frame.src = "";
            }
        });

        // Get the form element
        const form = document.getElementById("yourForm");

        // Listen for the submit event
        form.addEventListener("submit", function(event) {
            if (!form.checkValidity()) {
                // If the form is not valid, show the validation errors

                event.preventDefault();
                return;
            }
            event.preventDefault(); // Prevent the form from being submitted normally

            // Show the modal
            $("#loadingModal").modal("show");

            // Get the form data
            const formData = new FormData(form);

            // Make the AJAX request
            $.ajax({
                type: "POST",
                url: form.action,
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Hide the modal
                    $("#loadingModal").modal("hide");
                    if (response.success) {
                        Swal.fire({
                            title: "<h4>YOUR REQUEST IS SUCCESSFULLY SUBMITTED</h4>",
                            icon: "success",
                            html: response.message,
                            showCloseButton: false,
                            showCancelButton: false,
                            confirmButtonColor: "#AA0F0A",
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = "userDashboard";
                            }
                        });
                    } else {
                        Swal.fire({
                            title: "<h4>CAPTCHA ERROR</h4>",
                            icon: "error",
                            html: response.message,
                            showCloseButton: false,
                            showCancelButton: false,
                            confirmButtonColor: "#AA0F0A",
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = "userDashboard";
                            }
                        });
                    }
                },
                error: function(error) {
                    // Hide the modal
                    $("#loadingModal").modal("hide");

                    // Handle the error (e.g. show an error message)
                },
            });
        });
    </script>

</html>