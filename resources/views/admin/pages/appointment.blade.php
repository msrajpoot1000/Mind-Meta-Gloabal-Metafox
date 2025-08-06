@extends('admin.layouts.app')

@section('title', 'dashboard | Add Product')

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const viewButtons = document.querySelectorAll('.viewBtn');

            viewButtons.forEach(button => {
                button.addEventListener('click', function() {
                    document.getElementById('modalName').innerText = this.getAttribute('data-name');
                    document.getElementById('modalEmail').innerText = this.getAttribute(
                        'data-email');
                    document.getElementById('modalCountryCode').innerText = this.getAttribute(
                        'data-country_code');
                    document.getElementById('modalPhone').innerText = this.getAttribute(
                        'data-phone');
                    document.getElementById('modalDateTime').innerText = this.getAttribute(
                        'data-date_time');
                    document.getElementById('modalTimezone').innerText = this.getAttribute(
                        'data-timezone');
                    document.getElementById('modalMessage').innerText = this.getAttribute(
                        'data-message');
                });
            });
        });
    </script>

@endsection

@section('content')


    <form action="{{ route('book-appointment.export') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-6">
            </div>
            <div class="col-lg-6 d-flex justify-content-end  gap-2">
                <input type="date" name="export_date" placeholder="Enter Date" class="form-control w-auto">
                <button type="submit" class="btn btn-success">Export Contacts</button>
            </div>

        </div>
    </form>




    <div class="row mt-5">

        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">All product Data</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>SN.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Code</th>
                                    <th>Phone</th>
                                    <th>Client (Date & Time)</th>
                                    <th>Admin (Date & Time)</th>
                                    <th>Timezone</th>
                                    <th>Message</th>
                                    <th>Created At
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($appointment as $ittem)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $ittem->name }}</td>
                                        <td>{{ $ittem->email }}</td>
                                        <td>{{ $ittem->country_code }}</td>
                                        <td>{{ $ittem->phone }}</td>
                                        <td>{{ \Carbon\Carbon::parse($ittem->user_date_time)->format('d-m-Y h:i A') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($ittem->admin_date_time)->format('d-m-Y h:i A') }}</td>
                                        <td>{{ $ittem->timezone }}</td>
                                        <td>{{ Str::limit($ittem->message, 100) }}</td>
                                        <td>{{ $ittem->created_at }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm viewBtn"
                                                data-name="{{ $ittem->name }}" data-email="{{ $ittem->email }}"
                                                data-country_code="{{ $ittem->country_code }}"
                                                data-phone="{{ $ittem->phone }}"
                                                data-date_time="{{ \Carbon\Carbon::parse($ittem->date_time)->format('d-m-Y h:i A') }}"
                                                data-timezone="{{ $ittem->timezone }}"
                                                data-message="{{ $ittem->message }}" data-bs-toggle="modal"
                                                data-bs-target="#viewModal">
                                                View
                                            </button>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- model to show detail  --}}
    <!-- Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Appointment Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Name:</strong> <span id="modalName"></span></p>
                    <p><strong>Email:</strong> <span id="modalEmail"></span></p>
                    <p><strong>Country Code:</strong> <span id="modalCountryCode"></span></p>
                    <p><strong>Phone:</strong> <span id="modalPhone"></span></p>
                    <p><strong>Date & Time:</strong> <span id="modalDateTime"></span></p>
                    <p><strong>Timezone:</strong> <span id="modalTimezone"></span></p>
                    <p><strong>Message:</strong> <span id="modalMessage"></span></p>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('scripts')
    <script src="{{ URL::asset('assets/admin/libs/eva-icons/eva.min.js') }}"></script>

@endsection
