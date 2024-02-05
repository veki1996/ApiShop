<script>
    function initializeCod() {
        $('.checkout-loader').hide();
        $('.complete-order').show()

        cart.paymentMethod = 'cod';
        cart.paymentSystem = 'cod';
    }
</script>
