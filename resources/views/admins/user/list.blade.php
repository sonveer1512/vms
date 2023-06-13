@extends('admins/layout')
@section('content')

<div class="content">
    <h2 class="text-bold text-1100 mb-5">All Registered Data</h2>
    <div id="members" data-list='{"valueNames":["customer","email","mobile_number","start_date","end_date","joined"],"page":100,"pagination":true}'>
        <div class="row align-items-center justify-content-between g-3 mb-3">
            <div class="col col-auto">
                <div class="search-box">
                    <form class="position-relative" data-bs-toggle="search" data-bs-display="static"><input class="form-control search-input search" type="search" placeholder="Search" aria-label="Search" />
                        <span class="fas fa-search search-box-icon"></span>
                    </form>
                </div>
            </div>
            <div class="col col-auto ">
                <div class="d-flex align-items-center">
                    <div class="form-floating">
                        <input type="date" name="start_date" id="start_date" class="form-control" onchange="filter()">
                        <label for="start_date">Start Date</label>
                    </div>
                </div>
            </div>
            <div class="col col-auto ">
                <div class="d-flex align-items-center">
                    <div class="form-floating">
                        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ date('Y-m-d') }}" onchange="filter()">
                        <label for="end_date">End Date</label>
                    </div>
                </div>
            </div>
            <div class="col col-auto ">
                <div class="d-flex align-items-center">
                    <div class="form-floating">
                        <select class="form-control" id="active_inactive" onchange="filter()">
                            <option value selected disabled>Select &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
                            <option value="0">Active &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
                            <option value="1">Inactive</option>
                        </select>
                        <label for="name">Active / Inactive</label>
                    </div>
                </div>
            </div>

            <div class="col-auto">
                <div class="d-flex align-items-center">
                    <button class="btn btn-primary" onclick="exportfilterdata1();"><span class="fas fa-download me-2"></span>Download</button>
                </div>
            </div>
        </div>
        <div class="bg-white border-y border-300 mt-2 position-relative top-1">
            <div class="table-responsive scrollbar ms-n1 ps-1">
                <table class="table table-sm fs--1 mb-0" id="Datatable1">
                    <thead>
                        <tr>
                            <th>S. No.</th>
                            <th class="sort align-middle" scope="col" data-sort="customer">Image</th>
                            <th class="sort align-middle" scope="col" data-sort="customer">Name</th>
                            <th class="sort align-middle pe-0" scope="col" data-sort="joined">Email</th>
                            <th class="sort align-middle pe-0" scope="col" data-sort="joined">Contact</th>
                            <th class="sort align-middle pe-0" scope="col" data-sort="joined">Address</th>
                            <th class="sort align-middle pe-0" scope="col" data-sort="joined">Company Nature</th>
                            <th class="sort align-middle pe-0" scope="col" data-sort="joined">Area of Intrest</th>
                            <th class="sort align-middle pe-0" scope="col" data-sort="joined">Event Info</th>
                            <th class="sort align-middle pe-0" scope="col" data-sort="joined">Vaccination Status</th>
                            <th class="sort align-middle pe-0" scope="col" data-sort="joined">Date</th>
                            <th class="sort align-middle text-end pe-0" scope="col">ACTION</th>
                        </tr>
                    </thead>
                    <tbody class="list" id="table-latest-review-body">
                        @if(!empty($list))
                        @foreach($list as $key => $value)
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td>{{ $key+1}}</td>
                            <td class="customer align-middle">
                                <label for="accred_{{$key+1}}">
                                    @if(!empty($value->upload_image))
                                    <img data-src="{{asset('uploads/uploaded_image/'.$value->upload_image)}}" style="width: 100px; height: 100px; object-fit: cover" onerror="this.src='{{ asset('admins/img/noimage.jpg') }}'">
                                    @else
                                    <img data-src="{{asset('uploads/captured_image/'.$value->camera_image)}}" style="width: 100px; height: 100px; object-fit: cover" onerror="this.src='{{ asset('admins/img/noimage.jpg') }}'">
                                    @endif
                                </label>
                            </td>
                            <td class="customer align-middle"><b>{{ $value->name ?? '' }}</b></td>
                            <td class="customer align-middle"><b>{{ $value->email ?? '' }}</b></td>
                            <td class="customer align-middle"><b>{{ $value->contact ?? '' }}</b></td>
                            <td class="customer align-middle"><b>{{ $value->city_1->name ?? '' }},{{ $value->state_1->name ?? '' }},{{ $value->country_1->name ?? '' }}</b></td>
                            <td class="customer align-middle"><b>{{ $value->company_nature ?? '' }}</b></td>
                            <td class="customer align-middle"><b>{{ $value->area_intrest ?? '' }}</b></td>
                            <td class="customer align-middle"><b>{{ $value->event_info ?? '' }}</b></td>
                            @if($value->vaccination_status == 1)
                            <td class="customer align-middle"><b>
                                    <div class="badge badge-phoenix fs--2 badge-phoenix-success"><span class="fw-bold">Yes</span></div>
                                </b>
                            </td>
                            @else
                            <td>
                                <div class="badge badge-phoenix fs--2 badge-phoenix-warning"><span class="fw-bold">No</span></div>
                            </td>
                            @endif
                            <td class="align-middle white-space-nowrap text-700">
                                @php
                                $date = date_create($value->created_at);
                                echo date_format($date,"j M, Y");
                                @endphp
                            </td>
                            <td class="customer align-middle">
                                <!-- <button type="button" class="btn btn-sm btn-info" data-bs-target="#editmodal" data-bs-toggle="modal" onclick="showeditmodulediv('{{ $value->id }}')"><span data-feather="edit-3"></span></button> -->

                                @if ($value->flag == 1)
                                <button class="btn btn-sm btn-success" data-bs-target="#deletepopup" data-bs-toggle="modal" onclick="deletepopup('{{ $value->id }}','registration_data','activate')"><span data-feather="check"></span></button>
                                @else
                                <button class="btn btn-sm btn-warning" data-bs-target="#deletepopup" data-bs-toggle="modal" onclick="deletepopup('{{ $value->id }}','registration_data','deactivate')"><span data-feather="alert-triangle"></span></button>
                                @endif

                                <button class="btn btn-sm btn-danger" data-bs-target="#deletepopup" data-bs-toggle="modal" onclick="deletepopup('{{ $value->id }}','registration_data','delete')"><span data-feather="trash-2"></span></button>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="row align-items-center justify-content-between py-2 pe-0 fs--1">
                <div class="col-auto d-flex">
                    <p class="mb-0 d-none d-sm-block me-3 fw-semi-bold text-900" data-list-info="data-list-info"></p>
                    <a class="fw-semi-bold" href="#!" data-list-view="*">View all<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
                    <a class="fw-semi-bold d-none" href="#!" data-list-view="less">View Less<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
                </div>
                <div class="col-auto d-flex"><button class="page-link" data-list-pagination="prev"><span class="fas fa-chevron-left"></span></button>
                    <ul class="mb-0 pagination"></ul>
                    <button class="page-link pe-0" data-list-pagination="next"><span class="fas fa-chevron-right"></span></button>
                </div>
            </div>
        </div>

    </div>

</div>
</div>

@include('admins/deactivate')

<!-- <div class="modal fade" id="addmodal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" id="addition">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="staticBackdropLabel">New Role</h5>
                    <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--1 text-white"></span></button>
                </div>
                <div class="modal-body">
                    @csrf()
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-floating">
                                <input class="form-control" id="role" type="text" name="role" required />
                                <label for="role">Role</label>
                                <span id="role_error" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-sm-12 col-md-12">
                            <table class="table table-sm fs--1 mb-0">
                                <thead>
                                    <tr>
                                        <th>Sidebar</th>
                                        <th>Read</th>
                                        <th>Write</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @if(!empty($sidebar))
                                    @foreach($sidebar as $key => $values)
                                    <tr>
                                        <input type="hidden" name="sidebar[]" value="{{ $values->sidebar_id}}">
                                        <td class="customer align-middle">{{ $values->sidebar_name }}</td>
                                        <td class="customer align-middle"><input type="checkbox" name="read_{{ $values->sidebar_id}}" value="1"></td>
                                        <td class="customer align-middle"><input type="checkbox" name="write_{{ $values->sidebar_id}}" value="1"></td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="justify-content-center submitbtn" style="display: grid;">
                        <button type="submit" class="btn w-sm btn-primary">Submit</button>
                        <span class="succ_resp text-success"></span>
                        <span class="err_resp text-danger"></span>
                    </div>
                    <div class="spinner-border text-primary" role="status" style="display: none;">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div> -->


<!-- <div class="modal fade" id="editmodal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" id="editing">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="staticBackdropLabel">Edit Role</h5>
                    <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--1 text-white"></span></button>
                </div>
                <div class="modal-body">
                    @csrf()
                    <div class="editstaffdiv">

                    </div>
                </div>
                <div class="modal-footer">
                    <div class="justify-content-center mt-2 mb-2 submitbtn" style="display: grid;">
                        <button type="submit" class="btn w-sm btn-primary">Update</button>
                        <span class="succ_resp2 text-success"></span>
                        <span class="err_resp2 text-danger"></span>
                    </div>
                    <div class="spinner-border text-primary" role="status" style="display: none;">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div> -->

<meta name="csrf-token" content="{{ csrf_token() }}" />
<script>
    function exportfilterdata1() {
        $("#Datatable1").table2excel({
            filename: "Table.xls"
        });
    }

    function filter()
    {
        var base_url = window.location.origin + "/";
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        var active_inactive = $('#active_inactive').val();
        var url = 'admin/filter';
        $.ajax({
        url: base_url + url,
        type: "post",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            start_date: start_date,
            end_date: end_date,
            active_inactive: active_inactive
        },
        success: function(response) {

            $("#table-latest-review-body").html(response);
        }
    })
    }
</script>
@endsection()