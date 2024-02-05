@php use App\Helpers\ContentHelper; @endphp

<div class="flex ju-center ws-frilla-wrapper-full">
    <div class="category-scroll-container">
        <div class="chip selected" data-category-id="allProducts">{{ContentHelper::staticText('allProducts') }}</div>
        @php $displayedCategories = []; @endphp
        @foreach($products as $product)
            @foreach($product->categories as $categoryId => $categoryName)
                @if(!in_array($categoryId, $displayedCategories))
                    <div class="chip" data-category-id="{{$categoryId}}">{{$categoryName}}</div>
                    @php $displayedCategories[] = $categoryId @endphp
                @endif
            @endforeach
        @endforeach
    </div>
</div>

<style>
    .category-scroll-container {
        padding: 0 10px;
        overflow-x: auto;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch; /* for smoother scrolling on iOS devices */
        width:100%;
        margin-left:auto;
        margin-right: auto;
        display: flex;
        justify-content: space-between;
    }
    .chip {
        display: inline-block;
        margin-right: 8px;
        margin-bottom: 8px;
        padding: 4px 8px;
        background-color: #c21225;
        color: #FEFEFE;
        font-size: 15px;
        font-weight: 600;
        line-height: 1.5;
        cursor: pointer;
        box-shadow: 0px 0px 10px rgba(14, 14, 33, 0.06), 0px 6px 16px rgba(14, 14, 33, 0.04), 0px 4px 6px rgba(14, 14, 33, 0.04), 0px 2px 2px rgba(14, 14, 33, 0.04);
        transition: all 0.3s;
        flex-grow: 1;
        text-align: center;
    }
    .chip:hover {
        background-color: #960e1d;
    }
    .chip.selected {
        background-color: #FEFEFE;
        color: #c21225;
    }
    .hidden {
        display: none;
    }
</style>

<script>
    $(document).ready(function() {
        const products = Object.values(@json($products));

        $('.chip').click(function() {
            const categoryId = $(this).data('category-id');

            // check if "allProducts" chip is clicked and display all products
            if (categoryId === 'allProducts') {
                $('.productBox').fadeIn('fast');
            } else {
                $('.productBox').fadeOut('fast', function() {
                    const filteredProducts = products.filter(product => Object.keys(product.categories).includes(categoryId.toString()));
                    filteredProducts.forEach(product => {
                        $('.productBox[data-sku="' + product.longSku + '"]').fadeIn('fast');
                    });
                });
            }

            // add "selected" class to clicked chip element
            $('.chip').removeClass('selected');
            $(this).addClass('selected');
        });
    });
</script>
