@php use App\Helpers\ContentHelper; @endphp

{{-- <div class="loadMoreHolder">
    <a href="javascript:void(0);" id="load-products-button" class="loadMore bg-color-primary">
        {{ContentHelper::staticText('loadProducts')}} <span class="loadMoreArrow">»</span>
    </a>
</div> --}}

@push('body-js')
    <script>
        let limit = 30
        let offset = 20

        $('#load-products-button').on('click', function () {
            const button = $(this)

            button.addClass('loading')

            const params = new URLSearchParams(window.location.search)

            $.ajax({
                url: '{{route('data.products')}}',
                type: 'GET',
                data: { limit, offset, render: true, category: params.get('category') },
                success (apiResponse) {
                    button.removeClass('loading')

                    if (!apiResponse.success || !apiResponse.hasOwnProperty('data') || !apiResponse.data) {
                        $('#load-products-button').disable()
                        return
                    }

                    offset += limit
                    $('{{$productsContainer}}').append(apiResponse.data)
                },
            })
        })
    </script>
@endpush
