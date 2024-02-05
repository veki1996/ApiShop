@push('head-css')
    <link rel="stylesheet" href="{{ env('APP_URL') }}/css/components/tmpl_12/advantage.css">
@endpush

<div class="advantage-section">
   @include('subtemplates.tmpl_12.advantage-box.advantage-title')
   <div class="advantage-boxes">
      @include('subtemplates.tmpl_12.advantage-box.advantage-part-1')
      @include('subtemplates.tmpl_12.advantage-box.advantage-part-2')
      @include('subtemplates.tmpl_12.advantage-box.advantage-part-3')
   </div>

</div>