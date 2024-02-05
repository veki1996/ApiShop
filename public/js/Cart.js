class Cart {
    country;
    currency;
    eurExchangeRate;

    products = [];
    bonuses = [];
    coupon = {};
    productsPrice = 0;
    bonusesPrice = 0;
    totalPrice = 0;
    productsEurPrice = 0;
    bonusesEurPrice = 0;
    totalEurPrice = 0
    selectedCombinations = [];
    paymentMethod = null;
    paymentSystem = null;
    couponAdded = false;
    deliveryDay = '';

    constructor(country, currency, eurExchangeRate, brandID) {
        this.country = country;
        this.currency = currency;
        this.eurExchangeRate = eurExchangeRate;
        this.brandID = brandID;
    }

    addProduct(product) {
       
            this.products.push(product);
            this.update();

            $('.addedToCartPopp').addClass('showPopup');
            $('.overlay').removeClass('hidden');

    }

    getProduct(sku) {
        let index = this.products.findIndex((p) => p.sku === sku);
      
        if (index === -1) {
            return null;
        }

        return this.products[index];
    }

    updateProduct(sku, data) {
        let index = this.products.findIndex((p) => p.sku === sku);
        if (index === -1) {
            return;
        }

        let updatedProduct = this.products[index];

        for (const [property, newValue] of Object.entries(data)) {
            updatedProduct[property] = newValue;
        }

        this.products[index] = updatedProduct;
        this.update();
    }

    removeProduct(sku) {
        this.products = this.products.filter((p) => p.sku !== sku);
        this.removeCoupon();
        this.update();
    }

    addBonus(bonus) {
        const existingBonus = this.getBonus(bonus.sku);
        if (existingBonus) {
            this.updateBonus(bonus.sku, {
                quantity: bonus.quantity,
                price: bonus.price
            });
        } else {
            this.bonuses.push(bonus);
            this.update();
        }
    }

    updateBonus(sku, data) {
        let index = this.bonuses.findIndex((bonus) => bonus.sku === sku);
        if (index === -1) {
            return;
        }

        let updatedBonus = this.bonuses[index];

        for (const [property, newValue] of Object.entries(data)) {
            updatedBonus[property] = newValue;
        }

        this.bonuses[index] = updatedBonus;
        this.update();
    }

    removeBonus(sku) {
        this.bonuses = this.bonuses.filter((b) => b.sku !== sku);
        this.update();
    }

    hasBonus(sku) {
        return this.bonuses.filter((bonus) => bonus.sku === sku).length > 0;
    }

    getBonus(sku) {
        let index = this.bonuses.findIndex((p) => p.sku === sku);
        if (index === -1) {
            return null;
        }

        return this.bonuses[index];
    }

    update() {
        this.updatePrices();
        this.cache();
    }

    updatePrices() {
        let _productsPrice = 0;
        let _bonusesPrice = 0;

        this.products.forEach((p) => {
            _productsPrice += Number(p.price);
        });
        this.bonuses.forEach((b) => {
            _bonusesPrice = Number(_bonusesPrice) + Number(b.price);
        });

        this.productsPrice = this.roundPrice(_productsPrice);
        this.bonusesPrice = this.roundPrice(_bonusesPrice);
        this.totalPrice = this.roundPrice(_productsPrice + _bonusesPrice);
        this.productsEurPrice = this.roundPrice(_productsPrice, "eur");
        this.bonusesEurPrice = this.roundPrice(_bonusesPrice, "eur");
        this.totalEurPrice = this.roundPrice(
            this.productsEurPrice + this.bonusesEurPrice,
            "eur"
        ) / this.eurExchangeRate;
    }

    roundPrice(price, currency = this.currency) {
        if (["mkd", "rsd"].includes(currency)) {
            return Math.ceil(price.toFixed(0) / 100) * 100;
        }
        if (["czk", "huf"].includes(currency)) {
            return +price.toFixed(0);
        }
        return +price.toFixed(2);
    }

    toEur(localPrice) {
        return localPrice * this.eurExchangeRate;
    }

    cache() {
        const country = this.country;
        const brandID = this.brandID;
        const cartKey = `cart-${brandID}-${country}`;

        localStorage.setItem(cartKey, JSON.stringify(this));
    }
    removeFromCache() {
        const country = this.country;
        const brandID = this.brandID;
        localStorage.removeItem(`cart-${brandID}-${country}`);
    }

    reset() {
        this.products = [];
        this.bonuses = [];
        this.coupon = {};
        this.productsPrice = 0;
        this.bonusesPrice = 0;
        this.totalPrice = 0;
        this.productsEurPrice = 0;
        this.bonusesEurPrice = 0;
        this.totalEurPrice = 0;

        this.removeFromCache();
    }

    addCoupon(data) {
        this.coupon = {
            name: data.name,
            type: data.type,
            value: data.value,
            discount: data.discount,
            prices: data.discountedPrices,
        };
        this.update();
    }

    removeCoupon() {
        this.coupon = {};
        this.update();
    }

    updateDelivery() {

        const productDeliveryDate = this.products[0].deliveryDay;
        const currentYear = new Date().getFullYear();
        const [day, month] = productDeliveryDate.toString().split(".");
        const dateObject = new Date(currentYear, parseInt(month) - 1, parseInt(day));

        function addDays(date, days) {
            const newDate = new Date(date);
            newDate.setDate(date.getDate() + days);
            return newDate;
        }

        let date = dateObject;

        let datePlusOne = addDays(date, 1);
        let datePlusThree = addDays(date, 3);

        const timeDelivery = document.querySelector(".shippTime");
        if (timeDelivery) timeDelivery.innerHTML = datePlusOne.getDate() + "." + (datePlusOne.getMonth() + 1) + "." + ` - ` + datePlusThree.getDate() + "." + (datePlusThree.getMonth() + 1) + ".";

        const timeDeliveryFast = document.querySelector(".shippTimeFast");
        if (timeDeliveryFast) timeDeliveryFast.innerHTML = dateObject.getDate() + `.` + (dateObject.getMonth() + 1) + `.` + ` - ` + datePlusOne.getDate() + `.` + (datePlusOne.getMonth() + 1) + `.`;

    }

    checkCoupon() {
        let couponInput = $('.coupon-name').val();
        let price = this.totalPrice;
        let self = this;
        let data = {
            code: couponInput,
            cartValues: [price],
            phoneNumber: ''
        };

        $.post(`${app_url}/coupons/validate`, data, function (response) {

            if (!response.success) {
                $("#coupon-response").text(wrongCoupon);
            } else if (Object.keys(self.coupon).length === 0) {
                const discountedValues = response.discountedPrices[0];
                $("#old-value").text(() => $(".total-price").text());
                $("#old-value").css('text-decoration', 'line-through');
                self.products[0].price = Math.round(self.products[0].price - response.value);
                $("#coupon-response").text(couponActivated);
                self.addCoupon(response);
                updateCheckoutOrder();
            } else {
                $("#coupon-response").text(usedCoupon);
            }

            self.update();
        }).fail(function () {
            console.log("Coupon check failed!");
            $("#coupon-response").text(wrongCoupon);
        });

    }

    applyCoupon(code) {
        const data = {
            code: code
        }

        $.post("coupons/apply", data, function (response) {
            console.log(response);
        }).fail(function () {
            console.log("Coupon apply failed!");
        });

    }

    addSelectedCombinations(sku)
    {
        this.selectedCombinations.push(sku);
    }

    setSelectedCombinations()
    {
        const country = this.country;
        const brandID = this.brandID;
        const scKey = `sc-${brandID}-${country}`;

        localStorage.setItem(scKey, JSON.stringify(this.selectedCombinations));
    }
}
