class Form {
    constructor(createOrderUrl, updateKlarnaOrderUrl) {
        this.createOrderUrl = createOrderUrl;
        this.formElement = $("#order-form");
        this.fields = this.formElement.find("input, select");
        this.failedFields = [];
        this.omgId = null;
        self.hash = null;
    }

    getFormData() {
        let formData = {};

        // Adds up all quantities of products
        formData.quantity = cart.products
            .map((product) => product.quantity)
            .reduce((prev, next) => prev + next);

        // Merges products and bonuses into a single array
        formData.formBonus = JSON.stringify([
            ...cart.products,
            ...cart.bonuses,
        ]);

        // TODO: Implement proper bundling
        formData.bundleSku = "null";

        if ($(".book-checkbox img").css("display") === "block") {
            formData.skipBook = 0;
        } else {
            formData.skipBook = 1;
        }

        if (Object.keys(cart.coupon).length > 0) {
            formData.coupon = cart.coupon.name;
            formData.couponType = cart.coupon.type;
            formData.couponValue = cart.coupon.discount;
            formData.couponCalculatedPrices = {
                coupon: cart.coupon.value,
                totalCart: cart.coupon.prices.total,
            };
        }

        // Form values
        formData.name = $("#ime").val();
        formData.surname = $("#surname").val();
        formData.telephone = $("#phone").val();
        formData.address = $.trim($("#address").val());
        formData.houseno = $.trim($("#number").val());
        formData.postcode = $("#postal").val();
        formData.city = $("#city").val();
        formData.email = $("#email").val();
        formData.comment = $("#komentar").val();
        formData.region = $('#province').val();
        formData.price = cart.totalPrice;
     
        if ($("#province").length) {
            formData.region = $("#province").val();
        }

        // Environment values
        // formData.postage = user.getPostage();
        formData.postage = 0; // hardcoded postage 0 because we add it to order_items
        // TODO: Separate bonus to proper class
        formData.bonus = cart.bonuses.length > 0 ? "on" : "off";
        // TODO: Separate epay to proper class
        formData.epay = null;
        formData.paymentmethod = cart.paymentMethod.toUpperCase();
        formData.system = cart.paymentSystem;
        formData.state = shop.countryCode;
        formData.shop_id = shop.shopID;
        formData._fbp = user.cookie("_fbp");
        formData._fbc = user.cookie("_fbc");
        formData.pageFlow = "cart";
        formData.profile = shop.profileID;
        formData.lidms = shop.mailstormID;

        // TODO: Replace this with a brand.isClearance call (Brand class)
        if (["9", "15", "22"].includes(shop.brandID)) {
            formData.sellout = 1;
        }

        return formData;
    }

    isValid() {
        this.validateFields();
        return this.failedFields.length === 0;
    }

    validateField(field) {
        let isMandatory = field.attr("data-mandatory") === "true";

        if (!isMandatory)
            return;

        // This variable is needed for those cases
        // where the placeholder is actually set
        // as the value of the input, if this doesn't
        // happen anywhere, this check can be removed
        let placeholder = field.attr("placeholder");

        let value = field.val();

         // Custom validation for field with ID "ime"
         if (field.attr("id") === "ime") {
            // Split the value into words
            let words = value.trim().split(" ");

            // Check if there are at least two words
            if (words.length < 2) {
            this.failedFields.push(field.attr("name"));
              field.addClass("invalid_field");
              field.siblings(".mandatory_field").addClass("appear");
              return false;
            }

            // Check if each word has at least two characters
            let isValid = words.every(word => word.length >= 2);
            if (!isValid) {
              field.addClass("invalid_field");
              field.siblings(".mandatory_field").addClass("appear");
              return false;
            }
          }

        // Field fails validation
        if (isMandatory && (!value || value === placeholder)) {
          field.addClass("invalid_field");

          // Why do this when you can just do .show()/.hide() ?
          field.siblings(".mandatory_field").addClass("appear");

          // In case select2 inputs are used. This will currently never get
          // triggered Decided to include block for backwards compatibility
          if (field.attr("data-special")) {
            field
              .next()
              .find(".select2-selection--single")
              .addClass("ease-out invalid_select");
          }

          // Add field name to array of field names that failed validation
          if (!this.failedFields.includes(field.attr("name"))) {
            this.failedFields.push(field.attr("name"));
          }

          // TODO: Refactor
          //insightCheck(field);

          return false;
        }

        // Field passed validation

        // In case select2 inputs are used. This will currently never get
        // triggered Decided to include block for backwards compatibility
        if (field.attr("data-special")) {
          field
            .next()
            .find(".select2-selection--single")
            .removeClass("ease-out invalid_select");
        }

        // Remove field name from failed field names array
        // Since the field has now passed validation
        if (this.failedFields.includes(field.attr("name"))) {
          this.failedFields = this.failedFields.filter(
            (name) => name !== field.attr("name")
          );
        }

        return true;
      }


    validateFields() {
        let form = this;

        this.fields.each(function () {
            form.validateField($(this));
        });
    }

    displayErrors() {
        $("html, body").animate(
            {
                scrollTop: $(`[name="${form.failedFields[0]}"]`)
                    .get(0)
                    .scrollIntoView({ behavior: "smooth", block: "center" }),
            },
            "slow"
        );
    }

    createOrder (additionalData = {}, callback) {
        var self = this;
        $.ajax({
            url: this.createOrderUrl,
            type: "POST",
            data: { ...form.getFormData(), ...additionalData },
            success(localResponse) {
                if (
                    localResponse &&
                    localResponse.response &&
                    localResponse.response.rand
                ) {
                    self.omgId = localResponse.response.rand;
                    self.hash = localResponse.response.hashString;
                    cart.coupon.name ? cart.applyCoupon(cart.coupon.name) : '';
                }

                if (typeof gtag === 'function') {
                    gtag(
                        'event',
                        'conversion',
                        {
                            'send_to': awCode,
                            'value': cart.totalEurPrice,
                            'currency': 'EUR',
                        },
                    )
                }

                if (typeof fbq === 'function') {
                    fbq(
                        'track',
                        'Purchase',
                        {
                            content_ids: cart.products.map(product => product.sku),
                            num_items: cart.products.length,
                            content_type: 'product',
                            currency: 'EUR',
                            value: cart.totalEurPrice,
                        },
                        {
                            eventID: form.omgId,
                        },
                    )
                }
                callback();
                cart.reset();
            },
            error(xhr) {
                console.log(xhr.responseText);
            },
        });
    }
}
