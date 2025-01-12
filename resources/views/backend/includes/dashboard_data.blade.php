<script>
    var user = {!! json_encode($users) !!};
</script>

@php

$usersLength = 0;
foreach($users as $user){
    $usersLength += 1;
}

@endphp


<div class="row">
    <!-- /.col-->

    <!-- /.col-->
    <div class="col-8 col-lg-4">
        <div class="card mb-4">
            <div class="card-body p-3 d-flex align-items-center">
                <div class="bg-danger text-white p-3 me-3">
                    <i class="fa-regular fa-user"></i>
                </div>
                <div>
                    <div class="fs-6 fw-semibold text-danger">{{$usersLength}}</div>
                    <div class="text-medium-emphasis text-uppercase fw-semibold small">@lang("Users")</div>
                </div>
            </div>
            <div class="card-footer px-3 py-2">
                <a class="btn-block text-medium-emphasis d-flex justify-content-between align-items-center" href="{{ route('backend.users.index') }}"><span class="small fw-semibold">View More</span>
                    <i class="fa-solid fa-circle-chevron-right"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- /.col-->
</div>
<!-- /.row-->


<div class="row">
    
    <!-- /.col-->
    <div class="col-sm-8 col-lg-4">
        <div class="card mb-4 text-white bg-info">
            <div class="card-body">
                <div class="fs-4 fw-semibold">{{$usersLength}}</div>
                <div>@lang("Users")</div>
                <div class="progress progress-white progress-thin my-2">
                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div><small class="text-medium-emphasis-inverse">Users helper text</small>
            </div>
        </div>
    </div>
    <!-- /.col-->
</div>
<!-- /.row-->


<div class="row">
    
    <!-- /.col-->
    <div class="col-sm-8 col-lg-4">
        <div class="card mb-4">
            <div class="card-body">
                <div class="fs-4 fw-semibold">{{$usersLength}}</div>
                <div>@lang("Users")</div>
                <div class="progress progress-thin my-2">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div><small class="text-medium-emphasis">Users helper text</small>
            </div>
        </div>
    </div>
    <!-- /.col-->
</div>
<!-- /.row-->