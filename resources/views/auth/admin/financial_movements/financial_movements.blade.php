@extends('auth.admin.include.master')
@section('title', $title)
@section('content')
<style type="text/css">
    .select2-container--open .select2-dropdown{
        right: -794px;
    }

    @media only screen and (max-width: 600px) {
  .select2-container--open .select2-dropdown{
        right: -305px;
    }
}
</style>
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            
            <!--begin::Basic info-->
            <div class="card mb-5 mb-xl-10">
                <!--begin::Card header-->
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                    <!--begin::Card title-->
                   <!--  <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{ $title }}</h3>
                    </div> -->
                    <!--end::Card title-->
                </div>
                <!--begin::Card header-->
                <!--begin::Content-->
                <div id="kt_account_profile_details" class="collapse show">
                    <!--begin::Form-->
                    @if($objAdmin->position_id != 2)
                     <form class="form" action="#" id="kt_modal_add_form" data-kt-redirect="{{ url('admin/total_secondary_registration') }}"method="get">
                       

                        <!--begin::Card body-->
                        <div class="card-body border-top p-9">
 
  

                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="required col-lg-4 col-form-label fw-bold fs-6">{{ __('messages.scout_group') }}</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                     <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="{{ __('messages.Select') }} {{ __('messages.scout_group') }}" data-allow-clear="true" data-kt-branch-table-filter="active" data-dropdown-parent="#kt_account_profile_details" id="admin_id" name="admin_id" required>
                                        <option value="">{{ __('messages.Select') }}</option >
                                                @foreach($leaders as $leader)
                                                    <option {{$leader->id == $admin_id ? 'selected' : ''}} value="{{$leader->id}}">{{ $leader->group_name }}</option>
                                                @endforeach
                                    </select>
                                
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->



                        </div>
                        <!--end::Card body-->
                        <!--begin::Actions-->
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                             
                            <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">{{ __('messages.search') }}</button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                    @endif

                     <div class="card-body pt-0 table-responsive">
                    <div class="fw-bolder me-5">
                            <span class="me-2" data-kt-docs-table-select="selected_count"></span>{{ __('messages.Total_activity_permit_fees') }}</div>
                    
                    <!--begin::Datatable-->
                    <table id="kt_datatable_table" class="table align-middle table-row-dashed fs-6 gy-5 ">
                        <thead>
                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                           
                            <th>#</th>
                            <th>{{ __('messages.scout_group') }}</th>
                            {{-- <th>{{ __('messages.activity_name') }}</th> --}}
                            <th>{{ __('messages.nature_activity') }}</th>
                            
                            <th>{{ __('messages.permit_number') }}</th>
                            <th>{{ __('messages.price') }}</th>
                            <th>{{ __('messages.activity_history') }}</th>
                            <th style="visibility: hidden;" class="text-end min-w-100px">{{ __('messages.Actions') }}</th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-bold">
                            @foreach($allPermit as $key=> $objPermit)
                            <tr>
                                
                                <td>{{$key+1}}</td>
                                <td>{{@$objPermit->Admin->group_name}}</td>
                                {{-- <td>{{@$objPermit->activity_name}}</td> --}}
                                <td>{{@$objPermit->TypeActivity->name_ar}}</td>
                                <td>{{@$objPermit->permit_number}}</td>
                                <td>{{@$objPermit->TypeActivity->price}}</td>
                                <td>{{Date('Y-m-d',strtotime($objPermit->activity_history))}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr style="font-size: 20px">
                                <td colspan="3">{{ __('messages.total_value') }}</td>
                                
                                {{-- <td></td> --}}
                                <td></td>
                                <td></td>
                                <td >{{$sum}}</td>
                            </tr>
                        </tfoot>
                    </table>
                    <!--end::Datatable-->
                </div>
                <hr>

                <div class="card-body pt-0 table-responsive">
                      <div class="fw-bolder me-5">
                            <span class="me-2" data-kt-docs-table-select="selected_count"></span>{{ __('messages.total_secondary_registration') }}</div>
                    <!--begin::Datatable-->
                    <table id="kt_datatable_table" class="table align-middle table-row-dashed fs-6 gy-5 ">
                        <thead>
                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th>{{ __('messages.scout_group') }}</th>
                            <th>{{$objAdmin_group->group_name}}</th> 
                        </tr>
                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th>{{ __('messages.dead_line') }}</th> 
                            <th>{{@$Setup->dead_line}}</th>
                        </tr>

                        <tr>
                            <th>الوحدات</th> 
                            <th>العدد</th> 
                            <th>الرسوم</th> 
                            <th>رسوم الافراد</th> 
                            <th>رسوم  علي الوحده</th> 
                            <th>المجموع الفرعي </th> 
                        </tr>
                        </thead>

                        
                        <tbody class="text-gray-600 fw-bold">
                            <tr>
                                <td>القادة/القائدات</td>
                                <td>{{$count_leaders}}</td>
                                <td>{{$alrusum}}</td>
                                <td>{{$count_leaders * $alrusum}}</td>
                                <td>{{$alrusum_wehda_leaders}}</td>
                                <td>{{$total_alrusum_wehda_leaders}}</td>
                            </tr>


                            <tr>
                                <td>الاشبال/الزهرات</td>
                                <td>{{$count_aliashbalu}}</td>
                                <td>{{$alrusum}}</td>
                                <td>{{$count_aliashbalu * $alrusum}}</td>
                                <td>{{$alrusum_wehda_aliashbalu}}</td>
                                <td>{{$total_alrusum_wehda_aliashbalu}}</td>
                            </tr>

                            <tr>
                                <td>الكشاف/المرشدات</td>
                                <td>{{$count_alkashaaf}}</td>
                                <td>{{$alrusum}}</td>
                                <td>{{$count_alkashaaf * $alrusum}}</td>
                                <td>{{$alrusum_wehda_alkashaaf}}</td>
                                <td>{{$total_alrusum_wehda_alkashaaf}}</td>
                            </tr>

                            <tr>
                                <td>المتقدم/المتقدمات</td>
                                <td>{{$count_almutaqadima}}</td>
                                <td>{{$alrusum}}</td>
                                <td>{{$count_almutaqadima * $alrusum}}</td>
                                <td>{{$alrusum_wehda_almutaqadima}}</td>
                                <td>{{$total_alrusum_wehda_almutaqadima}}</td>
                            </tr>

                            <tr>
                                <td>الجواله/الدليلات</td>
                                <td>{{$count_aljawaluh}}</td>
                                <td>{{$alrusum}}</td>
                                <td>{{$count_aljawaluh * $alrusum}}</td>
                                <td>{{$alrusum_wehda_aljawaluh}}</td>
                                <td>{{$total_alrusum_wehda_aljawaluh}}</td>
                            </tr>

                           {{--  <tr>
                                <td>عدد الوحدات</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr> --}}

                            <tr>
                                <td>غرامات التاخير</td>
                                <td>{{$count_late_students}}</td>
                                <td>{{$total_alrusum_late}}</td>
                                <td>{{$count_late_students * $total_alrusum_late}}</td>
                                <td></td>
                                <td></td>
                            </tr>
                            
                            
                        </tbody>
                       
                        <tfoot>

                            <tr style="font-size: 20px">
                                <td colspan="5">{{ __('messages.total_required_alrusum') }}</td>
                                <td>{{$final_total_alrusum}}</td>
                                
                            </tr>
                        </tfoot>
                    </table>
                    <!--end::Datatable-->
                </div>
                <hr>
                <!--end::Card body-->
                <div class="card-body pt-0 table-responsive">
                    <!--begin::Datatable-->
                    <table id="kt_datatable_table" class="table align-middle table-row-dashed fs-6 gy-5 ">
                        <thead>
                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th>{{ __('messages.scout_group') }}</th>
                            <th>{{$objAdmin_group->group_name}}</th> 
                        </tr>
                      

                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th style="color:green;">دفعات</th>
                            <th style="color:green;">{{$total_debit}}</th> 
                        </tr>


                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th style="color:red;">رسوم تصاريح  الأنشطة </th>
                            <th style="color:red;">{{$total_permits}} </th> 
                        </tr>


                         <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th style="color:red;">رسوم التسجيل السنوي</th>
                            <th style="color:red;">{{$final_total_alrusum}} </th> 
                        </tr>



                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            
                            @if($remain > 0 )
                            <th style="color:green;">الباقي</th>
                            <th style="color:green;">{{$remain}}</th> 
                            @elseif($remain < 0)
                            <th style="color:red;">الباقي</th>
                            <th style="color:red;">{{$remain}}</th> 
                            @else
                            <th>الباقي</th>
                            <th>{{$remain}}</th> 
                            @endif
                        </tr>
                        </thead>

                        
                        <tbody class="text-gray-600 fw-bold">
                      
                        </tbody>
                       
                        
                    </table>
                    <!--end::Datatable-->

                    @if($objAdmin->position_id == 2)
                     <a href="{{url('admin/financial_claims')}}" class="btn btn-primary" target="_blank">
                        {{ __('messages.Financial_claims') }}
                    </a>

                    @endif
                </div>
                </div>
                <!--end::Content-->
            </div>
            <!--end::Basic info-->
 


            <!--end::Modals-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->

@endsection

   

