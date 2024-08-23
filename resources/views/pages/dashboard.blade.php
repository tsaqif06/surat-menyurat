@extends('layout.main')

@push('style')
    <link rel="stylesheet" href="{{ asset('sneat/vendor/libs/apex-charts/apex-charts.css') }}" />
@endpush

@push('script')
    <script src="{{ asset('sneat/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script>
        // Data
        const months = @json($months); // Array of months
        const incomingAcceptedData = months.map(month => ({
            x: month,
            y: @json($incomingAccepted)[month] || 0
        }));
        const incomingRejectedData = months.map(month => ({
            x: month,
            y: @json($incomingRejected)[month] || 0
        }));
        const outgoingAcceptedData = months.map(month => ({
            x: month,
            y: @json($outgoingAccepted)[month] || 0
        }));
        const outgoingRejectedData = months.map(month => ({
            x: month,
            y: @json($outgoingRejected)[month] || 0
        }));

        const options = {
            chart: {
                type: 'line',
                height: '100%'
            },
            series: [{
                    name: 'Incoming Accepted',
                    data: incomingAcceptedData
                },
                {
                    name: 'Incoming Rejected',
                    data: incomingRejectedData
                },
                {
                    name: 'Outgoing Accepted',
                    data: outgoingAcceptedData
                },
                {
                    name: 'Outgoing Rejected',
                    data: outgoingRejectedData
                }
            ],
            xaxis: {
                categories: months,
                labels: {
                    formatter: function(value) {
                        const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct",
                            "Nov", "Dec"
                        ];
                        return monthNames[value - 1]; // Map month number to month name
                    }
                }
            },
            yaxis: {
                title: {
                    text: 'Count'
                }
            }
        };

        const chart = new ApexCharts(document.querySelector("#today-graphic"), options);
        chart.render();
    </script>
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card mb-4">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h4 class="card-title text-primary">Welcome</h4>
                            <p class="mb-4">
                                {{ now()->format('l, d F Y') }}
                            </p>
                            <p style="font-size: smaller" class="text-gray">*) This is the report for the current year.</p>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="{{ asset('sneat/img/man-with-laptop-light.png') }}" height="140"
                                alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                data-app-light-img="illustrations/man-with-laptop-light.png">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between flex-sm-row flex-column gap-3"
                            style="position: relative;">
                            <div id="profileReportChart" style="min-height: 500px; width: 100%;">
                                <div id="today-graphic"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
