@extends('admin.layouts.app')

@section('title', 'dashboard | company information')

@section('content')


    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Company Information</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('edit.companyinfo') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="companyname" class="form-label">Company Name</label>
                            <input type="text" class="form-control" placeholder="Enter Company Name"
                                value="{{ $companyinfos->companyname }}" name="companyname" required>
                        </div>

                        <div class="mb-3">
                            <label for="logo" class="form-label">Company Logo</label>
                            <input type="file" class="form-control" value="{{ $companyinfos->logo }}" name="logo">
                        </div>


                        <div class="mb-3">
                            <label for="logo" class="form-label">Company Favicon Icon (png/svg/ico)</label>
                            <input type="file" class="form-control" name="favicon" accept=".png,.svg,.ico">
                        </div>


                        <div class="row">

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Enter Email</label>
                                    <input type="email" class="form-control" placeholder="Enter Email"
                                        value="{{ $companyinfos->email }}" name="email" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone No.</label>
                                    <input type="text" class="form-control" placeholder="Enter Phone No."
                                        value="{{ $companyinfos->phone }}" name="phone"maxlength="10" required
                                        pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone2" class="form-label">2 Phone No.</label>
                                    <input type="text" class="form-control" placeholder="Enter Phone No."
                                        value="{{ $companyinfos->phone2 }}" name="phone2"maxlength="10" pattern="[0-9]*"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone3" class="form-label">3 Phone No.</label>
                                    <input type="text" class="form-control" placeholder="Enter Phone No."
                                        value="{{ $companyinfos->phone3 }}" name="phone3"maxlength="10" pattern="[0-9]*"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" placeholder="Enter address"
                                        value="{{ $companyinfos->address }}" name="address" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="facebook" class="form-label">Facebook</label>
                                    <input type="url" class="form-control" placeholder="Enter Facebook link"
                                        value="{{ $companyinfos->facebook }}" name="facebook">
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="instagram" class="form-label">Instagram</label>
                                    <input type="url" class="form-control" placeholder="Enter Instagram link"
                                        value="{{ $companyinfos->instagram }}" name="instagram">
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="linkedin" class="form-label">LinkedIn</label>
                                    <input type="url" class="form-control" placeholder="Enter Linkedin link"
                                        value="{{ $companyinfos->linkedin }}" name="linkedin">
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="pinterest" class="form-label">Pinterest</label>
                                    <input type="url" class="form-control" placeholder="Enter Pinterest link"
                                        value="{{ $companyinfos->pinterest }}" name="pinterest">
                                </div>
                            </div>

                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary w-md">Submit</button>

                            <!-- Back Button -->
                            <a href="{{ route('dashboard') }}" class="btn btn-secondary w-md">Back</a>
                        </div>
                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
        <!-- end col -->
    </div>
    <!-- end row -->

@endsection


<script>
    function validateForm() {
        const phone = document.getElementById("phone").value;
        const phoneRegex = /^[0-9]+$/;

        if (!phoneRegex.test(phone)) {
            alert("Phone number must contain only digits (0-9).");
            return false;
        }

        return true;
    }
</script>
