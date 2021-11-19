
@extends('backend.main')
@section('main-content')
   <a href="{{route('service.create')}}"><button class="btn btn-primary">नयाँ सेवा थप्नुहोस् -- Add Service </button></a>
    <br><br>
    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissable">
            {{Session('message')}}
        </div>
    @endif

    <div class="portlet light ">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-social-dribbble font-green"></i>
                <span class="caption-subject font-green bold uppercase">सेवाहरु </span>
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-scrollable">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th align="center"> क्र.स  </th>
                        <th> सेवाको प्रकार  </th>
                        <th> प्रक्रिया र चरण </th>
                        <th>लाग्ने शुल्क </th>
                        <th>लाग्ने समय </th>
                        <th align="center" >जिम्मेवारी</th>
                        <th>गुनासो सुन्ने अधिकारी</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($employees as $employee)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$employee->name }}</td>
                            <td>{{$employee->steps }}</td>
                            <td>{{$employee->payment}}</td>
                            <td>{{$employee->times}}</td>
                            <td>{{$employee->responsibility}}</td>
                            <td>{{$employee->authority  }}</td>
                           
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(document).on('click','.activationButton',function (event) {
            event.preventDefault();
            var activationEmployeeId = $(this).data('employeeid');
            var csrf = '{{csrf_token()}}';
            $.ajax({
                method:'GET',
                url:'employee/activation/'+activationEmployeeId,
                data:{'_token':csrf},
                success:function (data) {
                    console.log(data);
                    if(data === "activated"){
                        swal({
                            title: "Activated",
                            text: "Now, Status of this Employee is activated !",
                            icon: "success",
                            // buttons: true,
                            dangerMode: true,
                        }).then(function(){
                            window.location.href = "{{route('service.index')}}";
                        })
                    }
                    else{
                        swal({
                            title: "Deactivated",
                            text: "Now, Status of this Employee is deactivated !",
                            icon: "success",
                            // buttons: true,
                            dangerMode: true,
                        }).then(function(){
                            window.location.href = "{{route('service.index')}}";
                        })
                    }
                },
                error:function (xhr,error,status,) {
                    console.log(xhr.status,error);

                }
            })
        });

    </script>

{{--    <script>--}}

{{--        $(document).on('click','#deletekitchenStaff',function(event){--}}
{{--            event.preventDefault();--}}
{{--            var idToDelete = $(this).data('id');--}}
{{--            var csrf = '{{csrf_token()}}';--}}
{{--            swal({--}}
{{--                title: "Are you sure?",--}}
{{--                text: "Once deleted, you will not be able to recover this data!",--}}
{{--                icon: "warning",--}}
{{--                buttons: true,--}}
{{--                dangerMode: true,--}}
{{--            })--}}
{{--                .then((willDelete) => {--}}
{{--                    if (willDelete) {--}}
{{--                        $.ajax({--}}
{{--                            method:'DELETE',--}}
{{--                            url:'kitchen_staff/'+idToDelete,--}}
{{--                            data:{'_token':csrf},--}}
{{--                            success:function (data){--}}
{{--                                console.log(data);--}}
{{--                                if(data === 'true'){--}}
{{--                                    window.location.href = "{{route('kitchen_staff.index')}}";--}}
{{--                                }--}}
{{--                            }--}}
{{--                        });--}}
{{--                    }--}}
{{--                })--}}
{{--        });--}}

{{--    </script>--}}

@endsection
