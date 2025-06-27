@extends('layouts.main')

@section('title')
    {{ __('general_setting') }}
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item text-dark">
                            <a href="{{ route('home') }}" class="text-dark"><i
                                    class="fas fa-home mr-1"></i>{{ __('dashboard') }}</a>
                        </li>
                        <li class="breadcrumb-item text-dark">
                            <a href="{{ url('system-settings') }}" class="text-dark"><i
                                    class="nav-icon fas fa-cogs mr-1"></i>{{ __('system_setting') }}</a>
                        </li>
                        <li class="breadcrumb-item  active"><i class="fas fas fa-cogs mr-1"></i>{{ __('general_setting') }}
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="card card-secondary h-100">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('general_setting') }}
                                <small class="text-bold">{{ __('directly_reflect_changes_in_all') }} </small>
                            </h3>
                        </div>
                        <form action="{{ route('general-settings') }}" role="form" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label>{{ __('android_app_link') }}</label>
                                        <input
                                            value="{{ isset($setting['android_app_link']) ? $setting['android_app_link'] : '' }}"
                                            name="android_app_link" type="url" class="form-control">
                                    </div>
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label>{{ __('ios_app_link') }}</label>
                                        <input
                                            value="{{ isset($setting['ios_app_link']) ? $setting['ios_app_link'] : '' }}"
                                            name="ios_app_link" type="url" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label>{{ __('category') }}</label>
                                        <div>
                                            <input type="checkbox" id="is_category" name="is_category" class="status-switch"
                                                @if ($setting['category_mode'] == '1') checked @endif>
                                            <input type="hidden" id="category_mode" name="category_mode"
                                                value="{{ $setting['category_mode'] ?? 0 }}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>{{ __('subcategory') }}</label>
                                        <div>
                                            <input type="checkbox" id="is_subcategory" name="is_subcategory"
                                                class="status-switch" @if ($setting['subcategory_mode'] == '1') checked @endif>
                                            <input type="hidden" id="subcategory_mode" class="status-switch"
                                                name="subcategory_mode" value="{{ $setting['subcategory_mode'] ?? 0 }}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>{{ __('breaking_news') }}</label>
                                        <div>
                                            <input type="checkbox" id="breaking_news" name="breaking_news"
                                                class="status-switch" @if ($setting['breaking_news_mode'] == '1') checked @endif>
                                            <input type="hidden" id="breaking_news_mode" class="status-switch"
                                                name="breaking_news_mode"
                                                value="{{ $setting['breaking_news_mode'] ?? 0 }}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>{{ __('live_streaming') }}</label>
                                        <div>
                                            <input type="checkbox" id="is_live_streaming" name="is_live_streaming"
                                                class="status-switch" @if ($setting['live_streaming_mode'] == '1') checked @endif>
                                            <input type="hidden" id="live_streaming_mode" class="status-switch"
                                                name="live_streaming_mode"
                                                value="{{ $setting['live_streaming_mode'] ?? 0 }}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>{{ __('rss_fees') }}</label>
                                        <div>
                                            <input type="checkbox" id="is_rss_feed" name="is_rss_feed" class="status-switch"
                                                @if ($setting['rss_feed_mode'] == '1') checked @endif>
                                            <input type="hidden" id="rss_feed_mode" class="status-switch"
                                                name="rss_feed_mode" value="{{ $setting['rss_feed_mode'] ?? 0 }}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>{{ __('comment') }}</label>
                                        <div>
                                            <input type="checkbox" id="is_comments" name="is_comments" class="status-switch"
                                                @if ($setting['comments_mode'] == '1') checked @endif>
                                            <input type="hidden" id="comments_mode" class="status-switch"
                                                name="comments_mode" value="{{ $setting['comments_mode'] ?? 0 }}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>{{ __('weather') }}</label>
                                        <div>
                                            <input type="checkbox" id="is_weather" name="is_weather"
                                                class="status-switch" @if (isset($setting['weather_mode']) && $setting['weather_mode'] == '1') checked @endif>
                                            <input type="hidden" id="weather_mode" class="status-switch"
                                                name="weather_mode" value="{{ isset($setting['weather_mode']) ?? 0 }}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>
                                            {{ __('enable_location_in_news') }}</label>
                                        <div>
                                            <input type="checkbox" id="location_news" name="location_news"
                                                class="status-switch" @if ($setting['location_news_mode'] == '1') checked @endif>
                                            <input type="hidden" id="location_news_mode" class="status-switch"
                                                name="location_news_mode"
                                                value="{{ $setting['location_news_mode'] ?? 0 }}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 col-sm-12 nearestLocationMeasureHide">
                                        <label>{{ __('nearest_location_measure_in_km') }}</label>
                                        <input min="1000" type="number" name="nearest_location_measure"
                                            value="{{ $setting['nearest_location_measure'] ?? 0 }}" class="form-control"
                                            required />
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>{{ __('maintenance_mode') }}</label>
                                        <div>
                                            <input type="checkbox" id="is_maintenance" name="is_maintenance"
                                                class="status-switch" @if (isset($setting['maintenance_mode']) && $setting['maintenance_mode'] == '1') checked @endif>
                                            <input type="hidden" id="maintenance_mode" class="status-switch"
                                                name="maintenance_mode" value="{{ $setting['maintenance_mode'] ?? 0 }}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>
                                            {{ __('mobile_login') }}</label>
                                        <div>
                                            <input type="checkbox" id="mobile_login" name="mobile_login"
                                                class="status-switch" @if ($setting['mobile_login_mode'] == '1') checked @endif>
                                            <input type="hidden" id="mobile_login_mode" class="status-switch"
                                                name="mobile_login_mode"
                                                value="{{ $setting['mobile_login_mode'] ?? 0 }}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2 countryCodeHide">
                                        <label>{{ __('country_code') }}</label>
                                        <input type="text" class="form-control" name="country_code"
                                            value="{{ $setting['country_code'] ?? 0 }}">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <label>{{ __('association_file') }}</label>
                                        <input name="association_file" type="file" class="form-control">
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label>{{ __('assetlinks_file') }}</label>
                                        <input name="assetlinks_file" type="file" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit"
                                            class="btn btn-primary float-right">{{ __('submit') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function(e) {
            var elems = Array.prototype.slice.call(
                document.querySelectorAll(".status-switch")
            );
            elems.forEach(function(elem) {
                var switchery = new Switchery(elem, {
                    size: "small",
                    color: "#47C363",
                    secondaryColor: "#EB4141",
                    jackColor: "#ffff",
                    jackSecondaryColor: "#ffff",
                });
            });
            @if ($setting['location_news_mode'] == 0)
                $('.nearestLocationMeasureHide').hide();
            @else
                $('.nearestLocationMeasureHide').show();
            @endif

            @if ($setting['mobile_login_mode'] == 0)
                $('.countryCodeHide').hide();
            @else
                $('.countryCodeHide').show();
            @endif

            var is_category = document.querySelector('#is_category');
            is_category.onchange = function() {
                if (is_category.checked) {
                    $('#category_mode').val(1);
                } else {
                    $('#category_mode').val(0);
                    $('#subcategory_mode').val(0);
                }
            };
            /* on change of category mode btn - switchery js */
            var is_subcategory = document.querySelector('#is_subcategory');
            is_subcategory.onchange = function() {
                if (is_subcategory.checked) {
                    if ($('#category_mode').val() == '1') {
                        $('#subcategory_mode').val(1);
                    } else if ($('#category_mode').val() == '0') {
                        alert('Please enable category');
                        $("#is_subcategory").prop("checked", true).trigger("click");
                    }
                } else {
                    $('#subcategory_mode').val(0);
                }
            };
            /* on change of breaking_news mode btn - switchery js */
            var breaking_news = document.querySelector('#breaking_news');
            breaking_news.onchange = function() {
                if (breaking_news.checked)
                    $('#breaking_news_mode').val(1);
                else
                    $('#breaking_news_mode').val(0);
            };

            /* on change of live streaming mode btn - switchery js */
            var is_live_streaming = document.querySelector('#is_live_streaming');
            is_live_streaming.onchange = function() {
                if (is_live_streaming.checked)
                    $('#live_streaming_mode').val(1);
                else
                    $('#live_streaming_mode').val(0);
            };

            /* on change of live streaming mode btn - switchery js */
            var is_rss_feed = document.querySelector('#is_rss_feed');
            is_rss_feed.onchange = function() {
                if (is_rss_feed.checked)
                    $('#rss_feed_mode').val(1);
                else
                    $('#rss_feed_mode').val(0);
            };

            /* on change of comments mode btn - switchery js */
            var is_comments = document.querySelector('#is_comments');
            is_comments.onchange = function() {
                if (is_comments.checked)
                    $('#comments_mode').val(1);
                else
                    $('#comments_mode').val(0);
            };
            /* on change of weather mode btn - switchery js */
            var is_weather = document.querySelector('#is_weather');
            is_weather.onchange = function() {
                if (is_weather.checked)
                    $('#weather_mode').val(1);
                else
                    $('#weather_mode').val(0);
            };
            /* on change of mobile login mode btn - switchery js */
            var mobile_login = document.querySelector('#mobile_login');
            mobile_login.onchange = function() {
                if (mobile_login.checked) {
                    $('#mobile_login_mode').val(1);
                    $('.countryCodeHide').show();
                } else {
                    $('#mobile_login_mode').val(0);
                    $('.countryCodeHide').hide();
                }
            };

            /* on change of maintenance mode btn - switchery js */
            var is_maintenance = document.querySelector('#is_maintenance');
            is_maintenance.onchange = function() {
                if (is_maintenance.checked)
                    $('#maintenance_mode').val(1);
                else
                    $('#maintenance_mode').val(0);
            };

            /* on change of Location wise news mode btn - switchery js */
            var location_news = document.querySelector('#location_news');
            location_news.onchange = function() {
                if (location_news.checked) {
                    $('#location_news_mode').val(1);
                    $('.nearestLocationMeasureHide').show();
                } else {
                    $('#location_news_mode').val(0);
                    $('.nearestLocationMeasureHide').hide();
                }
            };

        });
    </script>
@endsection
