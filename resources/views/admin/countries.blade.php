@extends('layout.main')
@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('main')

    <div class="container">

        <div id="wrapper">
            @include('admin.sidebar_menu')

            <div id="page-wrapper">
                @if( ! empty($title))
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header"> {{ $title }}  </h1>
                        </div> <!-- /.col-lg-12 -->
                    </div> <!-- /.row -->
                @endif
                @include('admin.flash_msg')


                <div class="row">
                    <div class="col-md-10 col-xs-12">

                        <form action="{{route('save_settings')}}" class="form-horizontal" enctype="multipart/form-data" method="post"> @csrf

                            <div class="form-group {{ $errors->has('countries_usage')? 'has-error':'' }}">
                                <label for="email_address" class="col-sm-4 control-label">@lang('app.countries_usage')</label>
                                <div class="col-sm-8">
                                    <fieldset>
                                        <label><input type="radio" value="all_countries" name="countries_usage" {{ get_option('countries_usage') == 'all_countries'? 'checked':'' }}> @lang('app.all_countries') </label> <br />
                                        <label><input type="radio" value="single_country" name="countries_usage" {{ get_option('countries_usage') == 'single_country'? 'checked':'' }}> @lang('app.single_country') </label> <br />
                                    </fieldset>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="usage_single_country_id" class="col-sm-4 control-label">
                                    @lang('app.select_specific_country')
                                </label>
                                <div class="col-sm-8 {{ $errors->has('usage_single_country_id')? 'has-error':'' }}">
                                    <select class="form-control select2" name="usage_single_country_id" id="usage_single_country_id">
                                        @php $saved_single_country_id = get_option('usage_single_country_id'); @endphp
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}" {{ $saved_single_country_id == $country->id? 'selected':'' }}>{{ $country->country_name }}</option>
                                        @endforeach

                                    </select>

                                    <p class="text-info">@lang('app.usage_single_country_id_help_text')</p>
                                </div>
                            </div>


                            <hr />
                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8">
                                    <button type="submit" id="settings_save_btn" class="btn btn-primary">@lang('app.save_settings')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <hr />

                <div class="row">
                    <div class="col-xs-12">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>@lang('app.country_name')</th>
                                <th>@lang('app.country_code')</th>
                            </tr>

                            @foreach($countries as $country)
                                <tr>
                                    <td>@lang('countries.'.$country->country_name)</td>
                                    <td>{{$country->country_code}}</td>
                                </tr>
                                @endforeach

                            </thead>
                        </table>

                    </div>
                </div>
            </div>   <!-- /#page-wrapper -->

        </div>   <!-- /#wrapper -->


    </div> <!-- /#container -->
@endsection

@section('page-js')
    <script>
        $(document).ready(function(){

            $('input[type="checkbox"], input[type="radio"]').click(function(){
                var input_name = $(this).attr('name');
                var input_value = 0;
                if ($(this).prop('checked')){
                    input_value = $(this).val();
                }
                $.ajax({
                    url : '{{ route('save_settings') }}',
                    type: "POST",
                    data: { [input_name]: input_value, '_token': '{{ csrf_token() }}' },
                });
            });

            /**
             * Send settings option value to server
             */
            $('#settings_save_btn').click(function(e){
                e.preventDefault();

                var this_btn = $(this);
                this_btn.attr('disabled', 'disabled');

                var form_data = this_btn.closest('form').serialize();
                $.ajax({
                    url : '{{ route('save_settings') }}',
                    type: "POST",
                    data: form_data,
                    success : function (data) {
                        if (data.success == 1){
                            this_btn.removeAttr('disabled');
                            toastr.success(data.msg, '@lang('app.success')', toastr_options);
                        }
                    }
                });
            });

        });
    </script>


@endsection