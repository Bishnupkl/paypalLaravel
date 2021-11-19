@extends('backend.main')
@section('main-content')
    <form action="{{route('service.store')}}" method="post"  enctype="multipart/form-data" class="portlet light">

        <!-- One "tab" for each step in the form: -->
        {{csrf_field()}}
        @if(Session::has('message'))
            <div class="alert alert-success alert-dismissable">
                {{Session('message')}}
            </div>
        @endif
        <div class="row">
            <div class="col-sm-12">
                <div class="portlet-title">
                    <div class="caption font-green">
                        <i class="icon-plus font-green"></i>
                        <span class="caption-subject bold uppercase">नयाँ सेवा थप्नुहोस् -- Add Service </span>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>सेवाको प्रकार :  </label>
                    <input type="text" placeholder="सेवाको प्रकार ..."   onkeyup="clearerror('nameError')" name="name" value="{{ old('name')}}" class="form-control">
                    @if ($errors->has('name'))
                        <span class="help-block" id="nameError">
                                                <strong class="text-danger">{{ $errors->first('name') }}</strong>
                                            </span>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label> गुनासो सुन्ने अधिकारी:</label>
                    <input type="text" placeholder="गुनासो सुन्ने अधिकारी...."  onkeyup="clearerror('authorityError')" name="authority" value="{{ old('authority')}}" class="form-control">
                    @if ($errors->has('authority'))
                        <span class="help-block" id="authorityError">
                                                <strong class="text-danger">{{ $errors->first('authority') }}</strong>
                                            </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label> प्रक्रिया र चरण:</label>
                    <input type="text" placeholder="प्रक्रिया र चरण..."  onkeyup="clearerror('cityError')" name="steps" value="{{ old('steps')}}" class="form-control">
                    @if ($errors->has('steps'))
                        <span class="help-block" id="cityError">
                                <strong class="text-danger">{{ $errors->first('steps') }}</strong>
                            </span>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label> लाग्ने शुल्क:</label>
                    <input type="text" placeholder="लाग्ने शुल्क..."  onkeyup="clearerror('contactError')" name="payment" value="{{ old('payment')}}" class="form-control">
                    @if ($errors->has('payment'))
                        <span class="help-block" id="contactError">
                                                <strong class="text-danger">{{ $errors->first('payment') }}</strong>
                                            </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>लाग्ने समय : </small></label>
                    <input name="times" type="text"  onkeyup="clearerror('timesError')" class="form-control" id="psw"  placeholder="लाग्ने समय :" >
                   
                    @if ($errors->has('times'))
                        <span class="help-block" id="timesError">
                                <strong class="text-danger">{{ $errors->first('times') }}</strong>
                            </span>
                    @endif
                    <label  class="col-md-12 invalids" id="formerror_times"></label>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>जिम्मेवारी:</label>
                    <input name="responsibility" onkeyup="clearerror('confirmError')" type="text" class="form-control" placeholder="जिम्मेवारी......">
                   

                    @if ($errors->has('responsibility'))
                        <span class="help-block" id="confirmError">
                                <strong class="text-danger">{{ $errors->first('responsibility') }}</strong>
                            </span>
                    @endif
                    <label  class="col-md-12 invalids" id="formerror_confirmedpassword"></label>

                </div>
            </div>
        </div>

            <div class="row">
                <div class="col-md-6">
                     <div class="form-group">
                        <label>आवश्यक पर्ने कागजात :</label>
                        <div class="field_wrapper">
                            <div>
                            
                            <input type="text" class="form-control" name="docs[]"  value="" required="" placeholder="कागजात...." 
                                  />
                            <a href="javascript:void(0);" class="add_button" style="float:left;" title="Add field">
                                Add</a>
                            </div>
                        </div>
                    </div>
                </div>
        </div>


        <div style="overflow:auto;">
            <div style="float:right;">
                <button class="btn btn-primary ">Add</button>
            </div>
        </div>

    </form>

@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script type="text/javascript">

        //Products Attributes

        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div style="margin-top:5px;"> <input type="text" class="form-control" name="docs[]"  value="" required="" placeholder="कागजात...." /><a href="javascript:void(0);" class="remove_button"> &nbsp;Remove</a></div>'; //New input field html
        var x = 1; //Initial field counter is 1

        //Once add button is clicked
        $(addButton).click(function () {
            //Check maximum number of input fields
            if (x < maxField) {
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });

        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function (e) {
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });


        //Update Attribute Status
        //Update Attribute Status



    </script>
@endsection
