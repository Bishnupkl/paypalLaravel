@extends('backend.main')
@section('styles'){{--inorder to add extra css--}}

@endsection
@section('main-content')
    @if(Auth::user()->is_admin)
        <div class="row">
            <div class="col-sm-6 col-xs-12">
                <div class="dashboard-stat blue">
                    <font color="#fffaf0"><h3><b>&nbsp;Total vendors </b></h3>
                        <h4>&nbsp<b>{{$employee}}</b>&nbsp;&nbsp;&nbsp;</h4>
                        &nbsp;&nbsp;<button class="btn btn-primary" style="visibility:hidden;">Hidden</button>
                    </font>
                </div>
            </div>
           <!--  -->

           
            <div class="col-sm-6 col-xs-12">
                <div class="dashboard-stat green">
                    <font color="#fffaf0">
                        <h3><b>&nbsp;Total Customers </b></h3>
                        <h4>&nbsp<b>{{$verified_employee}}</b>&nbsp;&nbsp;&nbsp;</h4>
                        &nbsp;&nbsp;<button class="btn btn-primary" style="visibility:hidden;">Hidden</button>
                    </font>
                </div>
            </div>
        </div>
    @endif
    @if(Auth::user()->is_employee)
        
      

    @endif

    @if(auth()->user()->is_kitchen_staff)
        <div class="row">
            <div class="col-sm-6 col-xs-12">
                <div class="dashboard-stat blue">
                    <font color="#fffaf0"><h3><b>&nbsp;Total Food Items</b></h3>
                        <h4>&nbsp<b>{{$total_food_items}}</b>&nbsp;&nbsp;&nbsp;Food items</h4>
                        &nbsp;&nbsp;<button class="btn btn-primary" style="visibility:hidden;">Hidden</button>
                    </font>
                </div>
            </div>
            <div class="col-sm-6 col-xs-12">
                <div class="dashboard-stat red">
                    <font color="#fffaf0">
                        <h3><b>&nbsp;Total Food Caategory</b></h3>
                        <h4>&nbsp<b>{{$total_category}}</b>&nbsp;&nbsp;&nbsp;category</h4>
                        &nbsp;&nbsp;<button class="btn btn-primary" style="visibility:hidden;">Hidden</button>
                    </font>
                </div>
            </div>
    @endif

@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $('.order-item').click(function (e) {
               let id = $(this).data('foodid');
                var csrf = "{{csrf_token()}}";
                let that = $(this);

                $.ajax({
                    method:'POST',
                    data:{id,_token:csrf},
                    success:function (data) {
                        if (data == 'ordered') {
                            that.text('Cancel Order');
                        }else {
                            that.text('Order');
                        }
                    }

                });

            });
        });
    </script>
@endsection
