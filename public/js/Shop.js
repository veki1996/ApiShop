class Shop {
    constructor(countryCode, brandID, currencyCode, fullDomain, shopID, profileID, mailstormID, exRate) {
        this.countryCode = countryCode;
        this.brandID = brandID;
        this.currencyCode = currencyCode;
        this.fullDomain = fullDomain;
        this.eurExchangeRate = exRate ?? currencies['eur']['rate'] / currencies[this.currencyCode]['rate'];
        this.shopID = shopID;
        this.profileID = profileID;
        this.mailstormID = mailstormID;

        // TODO: Define these values properly
        this.id = 0;
        this.hasCheckout = 1;
    }
}
