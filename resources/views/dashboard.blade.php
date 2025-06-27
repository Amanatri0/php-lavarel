@extends('layouts.main')

@section('title')
    {{ __('dashboard') }}
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('dashboard') }}</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                    <a href="{{ url('featured_sections') }}" class="text-dark">
                        <div class="info-box ">
                            <span class="info-box-icon bg-blue-new ">
                                <i class="fas fa-layer-group text-blue-new"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">{{ __('featured_section') }}</span>
                                <span class="info-box-number counter">{{ $countFeatredSection }}</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <a href="{{ url('category') }}" class="text-dark">
                        <div class="info-box ">
                            <span class="info-box-icon bg-red-new bg-red-border">
                                <i class=" fas fa-cube text-red-new"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">{{ __('category') }}</span>
                                <span class="info-box-number counter">{{ $countCategory }}</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <a href="{{ url('news') }}" class="text-dark">
                        <div class="info-box ">
                            <span class="info-box-icon bg-green-new">
                                <i class="fas fa-newspaper text-green-new"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">{{ __('news') }}</span>
                                <span class="info-box-number counter">{{ $countNews }}</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <a href="{{ url('breaking_news') }}" class="text-dark">
                        <div class="info-box ">
                            <span class="info-box-icon bg-orange-new">
                                <i class="fas fa-newspaper text-orange-new"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">{{ __('breaking_news') }}</span>
                                <span class="info-box-number counter">{{ $countBreakingNews }}</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <a href="{{ url('app_users') }}" class="text-dark">
                        <div class="info-box ">
                            <span class="info-box-icon bg-sky-new">
                                <i class="fas fa-user text-sky-new"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">{{ __('user') }}</span>
                                <span class="info-box-number counter">{{ $countUsers }}</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <a href="{{ url('language') }}" class="text-dark">
                        <div class="info-box ">
                            <span class="info-box-icon bg-blue-new">
                                <i class="fas fa-language text-blue-new"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">{{ __('language') }}</span>
                                <span class="info-box-number counter">{{ $enbled_language }}</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <a href="{{ url('pages') }}" class="text-dark">
                        <div class="info-box ">
                            <span class="info-box-icon bg-purple-new">
                                <i class="fas fa-file text-purple-new"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">{{ __('pages') }}</span>
                                <span class="info-box-number counter">{{ $countPages }}</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <a href="{{ url('ad_spaces') }}" class="text-dark">
                        <div class="info-box ">
                            <span class="info-box-icon bg-pink-new">
                                <i class="fas fa-ad text-pink-new"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">{{ __('ad_spaces') }}</span>
                                <span class="info-box-number counter">{{ $countAdSpace }}</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-5 col-sm-12">
                    <div class="card h-100">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('category_wise_news') }}</h3>
                        </div>
                        <div id="category_chart">
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-sm-12">
                    <div class="card h-100">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('language_wise_news') }}</h3>
                        </div>
                        <div id="news_language_chart">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-8 col-sm-12">
                    <div class="card h-100">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('latest_category') }}</h3>
                        </div>
                        @if (count($recent_categories) == 0)
                            <div class=" px-4">
                                <div class="row">
                                    <div class="col-md-12  d-flex justify-content-center">
                                        <div class="empty-state" data-height="400" style="height: 400px;">
                                            <div class="empty-state-icon bg-primary">
                                                <i class="fas fa-question text-white "></i>
                                            </div>
                                            <h2>{{ __('could_not_find_data') }}</h2>
                                            <p class="lead">{{ __('make_alteast_entry') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="card-body mt-3">
                                <div class="row">
                                    @foreach ($recent_categories as $row)
                                        <div class="col-md-3 col-sm-6 col-6 mb-3 text-center">
                                            @if ($row->image)
                                                <img src="{{ $row->image }}" alt="category" style="height: 100px;width:100px;border-radius:5px;">
                                            @endif
                                            <a class="users-list-name mt-2">{{ $row->category_name }}</a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="card-footer text-center" style="border-top: 0.5px solid rgba(0, 0, 0, 0.125);">
                                <a href="{{ url('category') }}" class="text-dark">{{ __('view_all') . ' ' . __('category') }}</a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div id="RNews-main" class="h-100">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('most_viewed_news') }}</h3>
                        </div>
                        @if (count($news_view) == 0)
                            <div class=" px-4">
                                <div class="row">

                                    <div class="col-md-12 d-flex justify-content-center">
                                        <div class="empty-state" data-height="400" style="height: 400px;">
                                            <div class="empty-state-icon bg-primary">
                                                <i class="fas fa-question text-white "></i>
                                            </div>
                                            <h2>{{ __('could_not_find_data') }}</h2>
                                            <p class="lead">{{ __('make_alteast_entry') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            @foreach ($news_view as $item)
                                <div id="RNews-card" class="card">
                                    @if ($item->image)
                                        <img id="RNews-image" src="{{ $item->image }}" class="card-img-top" alt="...">
                                    @endif
                                    <div id="RNews-card-body" class="RNews-card-body">
                                        <button id="btnRNewsCatagory" class="btn btn-sm" type="button">
                                            <i class="fas fa-eye mr-1"></i>{{ $item->viewcount }}
                                        </button>
                                        <h6 id="RNews-card-text" class="card-text">{{ $item->title }}
                                        </h6>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6 col-sm-12">
                    <div class="card h-100">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('language_wise_survey') }}</h3>
                        </div>
                        <div id="chart">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="card h-100">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('latest_comment') }}</h3>
                        </div>
                        @if (count($recent_comments) == 0)
                            <div class=" px-4">
                                <div class="row">

                                    <div class="col-md-12 d-flex justify-content-center">
                                        <div class="empty-state" data-height="400" style="height: 400px;">
                                            <div class="empty-state-icon bg-primary">
                                                <i class="fas fa-question text-white "></i>
                                            </div>
                                            <h2>{{ __('could_not_find_data') }}</h2>
                                            <p class="lead">{{ __('make_alteast_entry') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="card-body">
                                <div class=" card-comments">
                                    @foreach ($recent_comments as $row)
                                        <div class="card-comment">
                                            @if ($row->user->profile)
                                                <img class="img-circle img-sm" src="{{ $row->user->profile }}" alt="User Image">
                                            @endif
                                            <div class="comment-text">
                                                <span class="username">
                                                    {{ $row->user->name }}
                                                    <span class="text-muted float-right">{{ $row->date }}</span>
                                                </span>
                                                {{ $row->message }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('css')
@endsection

@section('js')
    <!-- ChartJS -->
    <script src="{{ url('assets/plugins/chart.js/Chart.min.js') }}"></script>

    <!-- jQuery Knob Chart -->
    <script src="{{ url('assets/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
@endsection

@section('script')
    <script type="text/javascript">
        $(".counter").each(function() {
            $(this).prop("Counter", 0).animate({
                Counter: $(this).text(),
            }, {
                duration: 1600,
                easing: "swing",
                step: function(now) {
                    $(this).text(Math.ceil(now));
                },
            });
        });

        // Extracting data from PHP to JavaScript
        var newsData = [];
        @foreach ($news_per_category as $row)
            newsData.push({
                category: '{{ $row['category'] }}',
                newsCount: {{ $row['news'] }}
            });
        @endforeach
        var customColors = [ // this array contains different color code for each data
            "#B52046",
            "#34A853",
            "#FFA53E",
            "#00B9FF",
            "#A779F6",
            "#FF546D",
        ];
        // ApexCharts data format
        var apexChartData = {
            chart: {
                width: 550,
                type: 'donut',
            },

            responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 300,
                            height: 400
                        }
                    }
                },
                {
                    breakpoint: 1340,
                    options: {
                        chart: {
                            width: 400,
                            height: 1500
                        }
                    }
                },
                {
                    breakpoint: 1520,
                    options: {
                        chart: {
                            width: 450,
                            height: 1500
                        }
                    }
                }

            ],
            dataLabels: {
                enabled: false
            },
            series: newsData.map(item => item.newsCount),
            labels: newsData.map(item => item.category),
            plotOptions: {
                distributed: true, // this line is mandatory
                pie: {
                    expandOnClick: true,

                }
            },
            legend: {
                show: true,
                showForSingleSeries: false,
                showForNullSeries: true,
                showForZeroSeries: true,
                position: 'right',
                horizontalAlign: 'center',
                fontSize: '10px',
                // fontFamily: 'Helvetica, Arial',
                fontWeight: 200,
                itemMargin: {
                    horizontal: 15,
                    vertical: 5
                }
            },
            colors: customColors // Specify custom colors here
        };
        // Create an ApexCharts instance
        var chart = new ApexCharts(document.getElementById('category_chart'), apexChartData);
        // Render the chart
        chart.render();
        var options = {

            series: [{
                name: 'News Count',
                data: [
                    @foreach ($news_per_language as $row)
                        {{ $row['news'] }},
                    @endforeach
                ]
            }],
            chart: {
                height: 350,
                type: 'bar',

            },
            responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 400,
                            height: 400
                        }
                    }
                },
                {
                    breakpoint: 720,
                    options: {
                        chart: {
                            width: 450,
                            height: 300
                        }
                    }
                }
            ],
            grid: {
                show: true,
            },
            plotOptions: {
                bar: {
                    borderRadius: 10,
                    distributed: true, // this line is mandatory
                    dataLabels: {
                        position: 'top',
                    },
                },
            },
            dataLabels: {
                enabled: true,
                formatter: function(val) {
                    return val + "%";
                },
                offsetY: -20,
                style: {
                    fontSize: '12px',
                    colors: ["#304758"]
                }
            },
            xaxis: {
                categories: [
                    @foreach ($news_per_language as $row)
                        '{{ $row['language'] }}',
                    @endforeach
                ],
                position: 'top',
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                tooltip: {
                    enabled: false,
                },
            },
            yaxis: {
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false,
                },
                labels: {
                    show: false,
                    formatter: function(val) {
                        return val + "%";
                    }
                },
            },
            colors: [ // this array contains different color code for each data
                "#B52046",
                "#34A853",
                "#FFA53E",
                "#00B9FF",
                "#A779F6",
                "#FF546D",
            ],
        };
        var chart = new ApexCharts(document.querySelector("#news_language_chart"), options);
        chart.render();
        var customColors = [
            '#1B2D51', '#DC3545', '#54627d', '#DC3545', '#e56874'
        ];
        var surveysData = [
            @foreach ($surveys_per_language as $row)
                {
                    language: '{{ $row['language'] }}',
                    surveys: {{ $row['surveys'] }}
                },
            @endforeach
        ];
        var seriesData = surveysData.map(function(item) {
            return item.surveys;
        });
        var categoriesData = surveysData.map(function(item) {
            return item.language;
        });
        var options = {
            series: [{
                data: seriesData,
            }],
            chart: {
                type: 'bar',
                height: 400
            },
            grid: {
                show: false,
            },
            plotOptions: {
                bar: {
                    distributed: true,
                    borderRadius: 4,
                    horizontal: true,
                }
            },
            dataLabels: {
                enabled: false,
                textAnchor: 'start',
                style: {
                    colors: ['#fff']
                },
                formatter: function(val, opt) {
                    return opt.w.globals.labels[opt.dataPointIndex] + ":  " + val
                },
                offsetX: 0,
                dropShadow: {
                    enabled: true
                }
            },
            xaxis: {
                categories: categoriesData,
            },
            colors: [
                "#A779F6",
                "#00B9FF",
                "#B52046",
                "#34A853",
                "#FFA53E",
                "#FF546D",
            ],
        };
        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>
@endsection
