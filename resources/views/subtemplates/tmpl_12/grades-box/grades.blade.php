@include('subtemplates.tmpl_12.grades-box.grades-title')
@include('subtemplates.tmpl_12.grades-box.grades-grades')

@push('head-css')
    <link rel="stylesheet" href="{{ env('APP_URL') }}/css/components/tmpl_12/grades.css">
@endpush