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