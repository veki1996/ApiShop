// -- Create Base64 Object
var Base64={_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9+/=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/rn/g,"n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}}
var frCrExRs = {"usd":{"name":"U.S. Dollar","rate":"1","left":"$","decimals":"2"},"eur":{"name":"Euro","rate":"0.90789812420508","left":"\u20ac","decimals":"2"},"gbp":{"name":"U.K. Pound Sterling","rate":"0.81563467922005","left":"\u00a3","decimals":"2"},"aud":{"name":"Australian Dollar","rate":"1.6415384049518","left":"A$ ","decimals":"2"},"cad":{"name":"Canadian Dollar","rate":"1.4077293040038","left":"C$ ","decimals":"2"},"jpy":{"name":"Japanese Yen","rate":"108.56190303811","left":"\u00a5","decimals":"0"},"chf":{"name":"Swiss Franc","rate":"0.96218461276697","left":"CHF ","decimals":"2"},"kmf":{"name":"\tComoro franc","rate":"431.50771167767","decimals":"0"},"afn":{"name":"Afghan afghani","rate":"74.318292704962","decimals":"2"},"all":{"name":"Albanian lek","rate":"111.67015123951","decimals":"2"},"dzd":{"name":"Algerian Dinar","rate":"130.43404810936","decimals":"2"},"aoa":{"name":"Angolan kwanza","rate":"501.54878048782","decimals":"2"},"ars":{"name":"Argentine Peso","rate":"63.18012817684","left":"$","decimals":"2"},"amd":{"name":"Armenia Dram","rate":"538.36995738998"},"awg":{"name":"Aruban florin","rate":"1.7617048618548","decimals":"2"},"azn":{"name":"Azerbaijan Manat","rate":"1.6896282697056"},"bsd":{"name":"Bahamian Dollar","rate":"0.97411179535765","decimals":"2"},"bhd":{"name":"Bahrain Dinar","rate":"0.37210073681477","left":"BD ","decimals":"3","point":"."},"bdt":{"name":"Bangladeshi taka","rate":"95.094807719004","decimals":"2"},"bbd":{"name":"Barbadian Dollar","rate":"1.9968503731765","left":"Bds$ ","decimals":"2","point":"."},"byn":{"name":"Belarussian Ruble","rate":"2.5756994613828"},"bzd":{"name":"Belize dollar","rate":"1.9620724202089","decimals":"2"},"bob":{"name":"Bolivian Boliviano","rate":"6.7758346892286","left":"Bs. ","decimals":"2","point":"."},"bam":{"name":"Bosnia and Herzegovina convertible mark","rate":"1.7736329135759","decimals":"2"},"bwp":{"name":"Botswana Pula","rate":"11.743062216733","decimals":"2"},"brl":{"name":"Brazilian Real","rate":"5.103382769215","left":"R$","decimals":"2"},"bnd":{"name":"Brunei Dollar","rate":"1.4252739402233","decimals":"2"},"bgn":{"name":"Bulgarian Lev","rate":"1.7806955286805","decimals":"2"},"bif":{"name":"Burundian franc","rate":"1838.4890478319","decimals":"0"},"khr":{"name":"Cambodian riel","rate":"3965.9594985534","decimals":"2"},"cve":{"name":"Cape Verde escudo","rate":"100.55501222494","decimals":"0"},"xaf":{"name":"Central African CFA Franc","rate":"607.04701946288","decimals":"2"},"xpf":{"name":"CFP Franc","rate":"107.48784694997","decimals":"2"},"clp":{"name":"Chilean Peso","rate":"835.29761772012","decimals":"2"},"cny":{"name":"Chinese Yuan","rate":"7.0893313206781","decimals":"2"},"cop":{"name":"Colombian Peso","rate":"3995.6127522396","decimals":"2"},"cdf":{"name":"Congolese franc","rate":"1663.713592233","decimals":"2"},"crc":{"name":"Costa Rican Col\u00f3n","rate":"568.2126922557","left":"\u20a1","decimals":"2","point":"."},"hrk":{"name":"Croatian Kuna","rate":"6.9377613292584","decimals":"2"},"cup":{"name":"Cuban peso","rate":"0.97411179535765","decimals":"2"},"czk":{"name":"Czech Koruna","rate":"24.871140239041","right":" K\u010d","decimals":"2","point":"."},"dkk":{"name":"Danish Krone","rate":"6.7946507877266","left":"kr ","decimals":"2"},"djf":{"name":"Djiboutian franc","rate":"173.29035520162","decimals":"0"},"dop":{"name":"Dominican Peso","rate":"52.391082802548","left":"RD$ ","decimals":"2","point":"."},"xcd":{"name":"East Caribbean Dollar","rate":"2.6366841902808","decimals":"2"},"egp":{"name":"Egyptian Pound","rate":"15.721050731229","left":"E\u00a3","decimals":"2","point":"."},"ern":{"name":"Eritrean nakfa","rate":"14.672493756689","decimals":"2"},"etb":{"name":"Ethiopian birr","rate":"31.856700232377","decimals":"2"},"fjd":{"name":"Fiji Dollar","rate":"2.2657007492287","decimals":"2"},"gmd":{"name":"Gambian dalasi","rate":"49.911407766989","decimals":"2"},"gel":{"name":"Georgian lari","rate":"3.182161065366","decimals":"2"},"ghs":{"name":"Ghanaian Cedi","rate":"6.2619913795315","decimals":"2"},"gip":{"name":"Gibraltar pound","rate":"0.81362269525995","decimals":"2"},"gtq":{"name":"Guatemalan Quetzal","rate":"7.6515348837209","decimals":"2"},"gnf":{"name":"Guinean franc","rate":"9283.7471783293","decimals":"0"},"gyd":{"name":"Guyanese dollar","rate":"203.36745290016","decimals":"2"},"htg":{"name":"Haitian gourde","rate":"92.006711409395","decimals":"2"},"hnl":{"name":"Honduran Lempira","rate":"24.064950263311","decimals":"2"},"hkd":{"name":"Hong Kong Dollar","rate":"7.7520654571684","left":"HK$ ","decimals":"2"},"huf":{"name":"Hungarian Forint","rate":"323.81828414065","decimals":"2"},"isk":{"name":"Icelandic Krona","rate":"140.26629307623","decimals":"2"},"inr":{"name":"Indian Rupee","rate":"75.052059536775","decimals":"2"},"idr":{"name":"Indonesian Rupiah","rate":"16136.954055963","decimals":"2"},"irr":{"name":"Iranian rial","rate":"47462.319908973","decimals":"2"},"iqd":{"name":"Iraqi dinar","rate":"1345.5275686928","decimals":"3"},"ils":{"name":"Israeli New Sheqel","rate":"3.5911175303841","left":"\u20aa","decimals":"2"},"jmd":{"name":"Jamaican Dollar","rate":"132.66774193548","decimals":"2"},"jod":{"name":"Jordanian Dinar","rate":"0.69959735517464","left":"JD","decimals":"3","point":"."},"kzt":{"name":"Kazakhstani Tenge","rate":"444.87927052679","decimals":"2"},"kes":{"name":"Kenyan shilling","rate":"103.62055933484","decimals":"2"},"kwd":{"name":"Kuwaiti Dinar","rate":"0.30920833687111","decimals":"2"},"kgs":{"name":"Kyrgyzstan Som","rate":"79.285087481874"},"lak":{"name":"Lao kip","rate":"8694.9260042283","decimals":"2"},"lbp":{"name":"Lebanese Pound","rate":"1688.4337342808","decimals":"2"},"lsl":{"name":"Lesotho loti","rate":"16.889938398357","decimals":"2"},"lrd":{"name":"Liberian dollar","rate":"193.99528301887","decimals":"2"},"lyd":{"name":"Libyan Dinar","rate":"1.5977314797899","decimals":"2"},"mop":{"name":"Macanese pataca","rate":"7.775950085082","decimals":"2"},"mkd":{"name":"Macedonian denar","rate":"55.452633282097","decimals":"2"},"mga":{"name":"Malagasy ariary","rate":"3665.5080213903","decimals":"2"},"mwk":{"name":"Malawian kwacha","rate":"716.99790794977","decimals":"2"},"myr":{"name":"Malaysian Ringgit","rate":"4.4186120306007","decimals":"2"},"mvr":{"name":"Maldivian rufiyaa","rate":"15.048298572996","decimals":"2"},"mru":{"name":"Mauritanian ouguiya","rate":"36.622439893143","decimals":"2"},"mur":{"name":"Mauritian Rupee","rate":"39.289703527815","decimals":"2"},"mxn":{"name":"Mexican Peso","rate":"23.46246118502","left":"Mex$ ","decimals":"2"},"mdl":{"name":"Moldova Lei","rate":"18.002646145116"},"mnt":{"name":"Mongolian togrog","rate":"2705.7236842105","decimals":"2"},"mad":{"name":"Moroccan Dirham","rate":"10.902755053524","decimals":"2"},"mzn":{"name":"Mozambican metical","rate":"64.971563981043","decimals":"2"},"mmk":{"name":"Myanma Kyat","rate":"1349.311023622","decimals":"2"},"nad":{"name":"Namibian dollar","rate":"16.889938398357","decimals":"2"},"npr":{"name":"Nepalese Rupee","rate":"118.18443058708","decimals":"2"},"ang":{"name":"Neth. Antillean Guilder","rate":"1.7423741738688","decimals":"2"},"twd":{"name":"New Taiwan Dollar ","rate":"31.572437761443","decimals":"2"},"tmt":{"name":"New Turkmenistan Manat","rate":"3.9174563787209"},"nzd":{"name":"New Zealand Dollar","rate":"1.6799772678688","left":"NZ$ ","decimals":"2"},"nio":{"name":"Nicaraguan C\u00f3rdoba","rate":"33.462870766773","left":"C$ ","decimals":"2","point":"."},"ngn":{"name":"Nigerian Naira","rate":"355.58680081855","left":"\u20a6"},"nok":{"name":"Norwegian Krone","rate":"10.602882142931","left":"kr ","decimals":"2"},"omr":{"name":"Omani Rial","rate":"0.37482911357795","decimals":"2"},"pkr":{"name":"Pakistani Rupee","rate":"160.14164554585","left":"\u20a8 ","decimals":"2"},"pab":{"name":"Panamanian Balboa","rate":"0.97411179535765","decimals":"2"},"pgk":{"name":"Papua New Guinean kina","rate":"3.4203256062644","left":"K","decimals":"2"},"pyg":{"name":"Paraguayan Guaran\u00ed","rate":"6474.7009880394","right":"\u20b2","decimals":"0","point":"."},"pen":{"name":"Peruvian Nuevo Sol","rate":"3.4200296805156","decimals":"2"},"php":{"name":"Philippine Peso","rate":"54.302688858583","decimals":"2"},"pln":{"name":"Polish Zloty","rate":"4.1216014793023","decimals":"2"},"qar":{"name":"Qatari Rial","rate":"3.6088978588978","decimals":"2"},"ron":{"name":"Romanian New Leu","rate":"4.4063401829522","decimals":"2"},"rub":{"name":"Russian Rouble","rate":"78.689849065531","decimals":"2"},"rwf":{"name":"Rwandan franc","rate":"926.91007437456","decimals":"0"},"svc":{"name":"Salvadoran colon","rate":"8.521964359718","decimals":"2"},"wst":{"name":"Samoan tala","rate":"2.7535484734868","decimals":"2"},"stn":{"name":"S\u00e3o Tom\u00e9 and Pr\u00edncipe Dobra","rate":"22.194819212088","decimals":"2"},"sar":{"name":"Saudi Riyal","rate":"3.7526707286019","decimals":"2"},"rsd":{"name":"Serbian Dinar","rate":"120.00380002288","decimals":"2"},"scr":{"name":"Seychelles rupee","rate":"12.876330619912","decimals":"2"},"sll":{"name":"Sierra Leonean leone","rate":"9476.2672811059","decimals":"2"},"sgd":{"name":"Singapore Dollar","rate":"1.431451681839","left":"S$ ","decimals":"2"},"sbd":{"name":"Solomon Islands dollar","rate":"8.081548437807","decimals":"2"},"sos":{"name":"Somali shilling","rate":"563.07502738223","decimals":"2"},"zar":{"name":"South African Rand","rate":"17.153853392013","left":"R ","decimals":"2"},"krw":{"name":"South Korean Won","rate":"1219.303998557","left":"\u20a9","decimals":"2"},"ssp":{"name":"South Sudanese pound","rate":"155.56606271513","decimals":"2"},"lkr":{"name":"Sri Lanka Rupee","rate":"182.07455285992","decimals":"2"},"sdg":{"name":"Sudanese pound","rate":"53.690600522191","decimals":"2"},"srd":{"name":"Surinamese dollar","rate":"7.2765392781317","decimals":"2"},"szl":{"name":"Swazi lilangeni","rate":"16.889938398357","decimals":"2"},"sek":{"name":"Swedish Krona","rate":"10.001166995419","left":"kr ","decimals":"2"},"syp":{"name":"Syrian pound","rate":"423.98969072162","decimals":"2"},"tjs":{"name":"Tajikistan Ruble","rate":"10.921722107455"},"tzs":{"name":"Tanzanian shilling","rate":"2246.1496450027","decimals":"2"},"thb":{"name":"Thai Baht","rate":"33.31600489828","left":"\u0e3f","decimals":"2"},"top":{"name":"Tongan pa\u02bbanga","rate":"2.2459043250327","decimals":"2"},"ttd":{"name":"Trinidad Tobago Dollar","rate":"6.5771629617781","decimals":"2"},"tnd":{"name":"Tunisian Dinar","rate":"3.2329652567845","decimals":"2"},"try":{"name":"Turkish Lira","rate":"6.4549110279185","decimals":"2"},"aed":{"name":"U.A.E Dirham","rate":"3.8323927267458","decimals":"2"},"ugx":{"name":"Ugandan shilling","rate":"3797.5069252077","decimals":"0"},"uah":{"name":"Ukrainian Hryvnia","rate":"28.171395287959"},"uyu":{"name":"Uruguayan Peso","rate":"43.79364820404","left":"U$ ","decimals":"2","point":"."},"uzs":{"name":"Uzbekistan Sum","rate":"10666.488994276"},"vuv":{"name":"Vanuatu vatu","rate":"121.40095049739","decimals":"2"},"ves":{"name":"Venezuelan Bolivar","rate":"72383.61111111","decimals":"2","point":"."},"vnd":{"name":"Vietnamese Dong","rate":"25026.955705424","right":"\u20ab","decimals":"0"},"xof":{"name":"West African CFA Franc","rate":"606.82766142397","decimals":"2"},"yer":{"name":"Yemeni rial","rate":"243.39823637331","decimals":"2"},"zmw":{"name":"Zambian kwacha","rate":"17.179197994987","decimals":"2"}};


// -- User location
var user_path = window.location.pathname.split('/');
var current_page = user_path[user_path.length-1];

// -- Get utm params
var page_query = window.location.search;
var resId = "";
var sHref = "";
var pack = "";
var sp1 = "";
var sp2 = "";
var sp3 = "";
var resRandom = "";
var pdt = ""; //product name
var spr = ""; //sales price
var cCode = ""; //country code
var usrn = ""; //User name
var cty = ""; //City
var brl = ""; //Dynamic price
var pstl = ""; //Postal code
var dynPix = ""; // Dynamic pixel
var addr = "";

//data needed for SendBlue
var ueml = ""; //email
var usurn = ""; //surname
var skulog = ""; //ordered full sku

//Advanced matching
var phne = "";

// BRL
if(window.location.href.indexOf("?brl=") > -1 || window.location.href.indexOf("&brl=") > -1){
    var dynPrc = decodeURIComponent(window.location.search.match(/(\?|&)brl\=([^&]*)/)[2]);
    brl="&brl="+dynPrc;
}

// Dynamic Pixel
if(window.location.href.indexOf("?utm_pix=") > -1 || window.location.href.indexOf("&utm_pix=") > -1){
    var url_string = window.location.href;
    var url = new URL(url_string);
    var pix = url.searchParams.get("utm_pix");

    dynPix = "&utm_pix=" + pix;
}




function getExchangeRate(){
    var baseCurrency,targetCurrency;

    // -- BASE currency (always conver to eur in this case)
    baseCurrency = 'eur';

    // -- All countries currencies provided in converter.js
    if(getCountry == 'HR'){
        targetCurrency = 'hrk';
    }else if (getCountry == 'RS'){
        targetCurrency = 'rsd';
    }else if (getCountry == 'CZ'){
        targetCurrency = 'czk';
    }else if (getCountry == 'HU'){
        targetCurrency = 'huf';
    }else if (getCountry == 'MK'){
        targetCurrency = 'mkd';
    }else if (getCountry == 'PL'){
        targetCurrency = 'pln';
    }else if (getCountry == 'BG'){
        targetCurrency = 'bgn';
    }else if (getCountry == 'RO'){
        targetCurrency = 'ron';
    }else if (getCountry == 'BA'){
        targetCurrency = 'bam';
    }else if (getCountry == 'AL'){
        targetCurrency = 'all';
    }else if (getCountry == 'VN'){
        targetCurrency = 'vnd';
    }else if (getCountry == 'NG'){
        targetCurrency = 'ngn';
    }else if (getCountry == 'DK') {
        targetCurrency = 'dkk';
    }else if (getCountry == 'GB') {
        targetCurrency = 'gbp';
    }else if (getCountry == 'SE') {
        targetCurrency = 'sek';
    }else if (getCountry == 'SI' || getCountry == 'SK' || getCountry == 'IT' || getCountry == 'GR' || getCountry == 'LV' || getCountry == 'LT' || getCountry == 'EE' || getCountry == 'ES' || getCountry == 'PT' || getCountry == 'FR' || getCountry == 'NL' || getCountry == 'BE' || getCountry == 'DE' || getCountry == 'AT' || getCountry == 'FI'  || getCountry == 'IE' || getCountry == 'EN'){
        targetCurrency = 'eur';
    }


    //return exchange rate
    return frCrExRs[targetCurrency]['rate'] / frCrExRs[baseCurrency]['rate'];


}


function checkEmailValidity(mailToCheck, callback){

    console.log('mail', mailToCheck);
    $.ajax({
        url: "https://validatemy.email/validate.php?s=xnMvus2zxvPgSG2YRQmwa3sK&e="+mailToCheck,
        dataType: 'JSON',
        success: function(result){
            console.log(result);
            var vMail = result.email;
            var vProvider = result.provider;

            if (vMail == "valid" && vProvider == "valid") {
                callback(true);
                return;
            }

            callback(false);
            return;
        }
    });
}

function findUrlParam(param){
    var url_string = window.location.href;
    var url = new URL(url_string);
    return url.searchParams.get(param);
}


// -- Redirect user by order package
function getOrderRedirect(res, method = false){

// -- Sendinblue user data
    var fullName = $('#ime').val();
    var firstName = fullName.substr(0,fullName.indexOf(' '));
    var lastName = fullName.substr(fullName.indexOf(' ')+1);
    // -- Sendinblue API

    // var urlToSend = window.location.href;
    var currentUrl = window.location.href;

    urlWithoutParametres = currentUrl.substr(0, currentUrl.lastIndexOf("/"));

    if( specialActive === "1" && upStatus === true && method !== false && method == 'cod' ) {
        urlToSend = urlWithoutParametres + '/special.php?resId='+res.rand+'&sHref='+res.hashString+'&sHash='+res.submitHash+'&cCode='+Base64.encode(cCode)+'&pdt='+Base64.encode(res.product || '0')+'&usrn='+Base64.encode(usrn)+'&cty='+Base64.encode(cty)+'&spr='+Base64.encode(spr)+'&addr='+Base64.encode(addr)+'&pstl='+Base64.encode(pstl)+'&ueml='+Base64.encode(ueml)+'&phne='+Base64.encode(phne)+'&usurn='+Base64.encode(usurn)+'&cod='+method_status+'&getSku='+Base64.encode(skulog)+brl+dynPix+'&SIBListId='+Base64.encode(SIBListId)+'&coupon='+Base64.encode(couponUrlString)+'&phno='+Base64.encode(res.phno || '0')+'&phtype='+Base64.encode(res.phtype || '0');
    }else{
        urlToSend = urlWithoutParametres + '/thanks.php?resId='+res.rand+'&sHref='+res.hashString+'&sHash='+res.submitHash+'&cCode='+Base64.encode(cCode)+'&pdt='+Base64.encode(res.product || '0')+'&usrn='+Base64.encode(usrn)+'&cty='+Base64.encode(cty)+'&spr='+Base64.encode(spr)+'&addr='+Base64.encode(addr)+'&pstl='+Base64.encode(pstl)+'&ueml='+Base64.encode(ueml)+'&phne='+Base64.encode(phne)+'&usurn='+Base64.encode(usurn)+'&cod='+method_status+'&getSku='+Base64.encode(skulog)+brl+dynPix+'&SIBListId='+Base64.encode(SIBListId)+'&coupon='+Base64.encode(couponUrlString)+'&phno='+Base64.encode(res.phno || '0')+'&phtype='+Base64.encode(res.phtype || '0');
    }


    $.ajax({
        type: 'POST',
        url: "https://api.tinyurl.com/create",
        data: `{ "domain": "gobuy.li", "url": "` + urlToSend + `" } `,
        contentType: "application/json",
        dataType: "json",
        headers: {
            'Authorization': 'Bearer on2kUriOfWwlXSNN5iACPlZtGHVNrkptWJtyd9B4yxd2hV5iuRb1qBKaLORx',
        },
        success: function(result){
            $.ajax({
                type: "POST",
                url: 'https://gfxcdn.com/sendblue/sendblueapi.php',
                data : {
                    email: ueml,
                    firstname: firstName,
                    lastname:lastName,
                    page :window.location.href,
                    country: getCountry,
                    product: product, //to do
                    sku: skuLong, //to do
                    skubase64: Base64.encode(skuLong),
                    url:urlToSend,
                    shorted: result.data.tiny_url,
                    shref: res.hashString,
                    sHash: res.submitHash,
                    cod: method_status,
                    listId: SIBListId,
                    phne: phne,
                    phno: res.phno || '0',
                    phtype: res.phtype || '0',
                },
                crossDomain: true,

                success: function(data){
                    console.log('sb data sent', data);
                },
                error: function () {
                    console.log('something went wrong')
                },
            });

        },
        error: function (e) {
            console.log('something went wrong', e)
        },
    });
    // -- END Sendinblue API

    // -- Get base price
    var basePrice = $("#product option").eq(0).val();
    basePrice = basePrice.replace(/,/g, '.');
    basePrice = basePrice.match(/[+\-]?\d+(,\d+)?(\.\d+)?/)[0];

    if(basePrice == '' || basePrice == 1){
        basePrice = productPrice;
    }


    // -- Set current date
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    var currentDate = dd + '-' + mm + '-' + yyyy;

    var method_status = method == 'cod' ? true : false;
    var pageType      = hasCheckout  == 1 ? 'shop' : 'single';


    // -- Send order data to Infobip
    var activeInfobipCountries = ['HR', 'HU', 'IT', 'RO', 'PL', 'SK', 'BG', 'GR', 'CZ'];

    if(activeInfobipCountries.includes(cCode) && brandID == 2){
        $.ajax({
            type: "POST",
            url: 'https://dokicdn.net/infobip/api/create-person.php',
            data : {
                email: ueml,
                phone: phne,
                firstname: firstName,
                lastname:lastName,
                country: getCountry,
                sku: skuLong,
                product: product,
                page :window.location.href,
                cod: method_status,
                date: currentDate,
                category: categoryEng,
                shop: brandName,
                price: basePrice,
                pageType: pageType
            },

            success: function(data){
            },
            error: function () {
                console.log('something went wrong')
            },
        });
    }
    // -- END Send order data to Infobip


    if(typeof gtag == 'function' && gtag != 'undefined'){
        gtag('event', 'OrderSucessfull-'+res.rand, {'event_category': 'Order','event_label': window.location.search.substr(1)});
    }

    // -- TRIGERS SP GOALS END

    //after order purchase
    //specialActive - checks for existance of special.php file
    //upStatus - checks is upsell activated on this domain
    if( specialActive === "1" && upStatus === true && method !== false && method == 'cod' ) {



        //Wait for email to be checked then continue
        var emailRedirect = function(mailStatus){

            //Users with valid email
            if(mailStatus === true){
                console.log('email valid - redirecting to panel defined type');

                //Redirect users
                setTimeout(function(){

                    window.location.replace('special.php?resId='+res.rand+'&sHref='+res.hashString+'&sHash='+res.submitHash+'&cCode='+Base64.encode(cCode)+'&pdt='+Base64.encode(res.product || '0')+'&usrn='+Base64.encode(usrn)+'&cty='+Base64.encode(cty)+'&spr='+Base64.encode(spr)+'&addr='+Base64.encode(addr)+'&pstl='+Base64.encode(pstl)+'&ueml='+Base64.encode(ueml)+'&phne='+Base64.encode(phne)+'&usurn='+Base64.encode(usurn)+'&cod='+method_status+'&getSku='+Base64.encode(skulog)+brl+dynPix+'&SIBListId='+Base64.encode(SIBListId)+'&coupon='+Base64.encode(couponUrlString)+'&phno='+Base64.encode(res.phno || '0')+'&phtype='+Base64.encode(res.phtype || '0') );

                },2000);
                return;

            }else{
                //Users without email
                //Change type to similar product


                console.log('email invalid - fallback');
                //Redirect users
                setTimeout(function(){

                    window.location.replace('special.php?resId='+res.rand+'&sHref='+res.hashString+'&sHash='+res.submitHash+'&cCode='+Base64.encode(cCode)+'&pdt='+Base64.encode(res.product || '0')+'&usrn='+Base64.encode(usrn)+'&cty='+Base64.encode(cty)+'&spr='+Base64.encode(spr)+'&addr='+Base64.encode(addr)+'&pstl='+Base64.encode(pstl)+'&ueml='+Base64.encode(ueml)+'&phne='+Base64.encode(phne)+'&usurn='+Base64.encode(usurn)+'&cod='+method_status+'&getSku='+Base64.encode(skulog)+brl+dynPix+'&SIBListId='+Base64.encode(SIBListId)+'&coupon='+Base64.encode(couponUrlString)+'&phno='+Base64.encode(res.phno || '0')+'&phtype='+Base64.encode(res.phtype || '0') );

                },2000);

                return;

            }


        }


        //Params (email{string}, callback function);
        checkEmailValidity(ueml, emailRedirect);





        //special file doesn't exist or upStatus is false (upsell not activated in panel)
    }else{
        console.log('special file doesnt exist or upStatus is false (upsell not activated in panel)');
        setTimeout(function(){ window.location.replace('thanks.php?resId='+res.rand+'&sHref='+res.hashString+'&sHash='+res.submitHash+'&cCode='+Base64.encode(cCode)+'&pdt='+Base64.encode(res.product || '0')+'&usrn='+Base64.encode(usrn)+'&cty='+Base64.encode(cty)+'&spr='+Base64.encode(spr)+'&addr='+Base64.encode(addr)+'&pstl='+Base64.encode(pstl)+'&ueml='+Base64.encode(ueml)+'&phne='+Base64.encode(phne)+'&usurn='+Base64.encode(usurn)+'&cod='+method_status+'&getSku='+Base64.encode(skulog)+brl+dynPix+'&SIBListId='+Base64.encode(SIBListId)+'&coupon='+Base64.encode(couponUrlString)+'&phno='+Base64.encode(res.phno || '0')+'&phtype='+Base64.encode(res.phtype || '0') ); },2000);
    }

// apply the coupon, reduce coupon usage counter
    if( typeof(couponUrlString) != 'undefined' && couponUrlString != '' ){

        $.ajax({
            type: "POST",
            url: 'z.deamon.php',
            data : {
                coupon: couponUrlString,
                action: 'applyCoupon',
            },

            success: function(data){

                console.log('coupon applied');

                var couponUsage = JSON.parse(localStorage.getItem('couponUsage')) || {};
                var time = new Date().getTime();


                var couponData = {
                    'coupon' : couponUrlString,
                    'phone'  : phne,
                    'time'	 : time
                }

                if(phne){
                    couponUsage[phne] = couponData;
                }


                localStorage.setItem('couponUsage', JSON.stringify(couponUsage));

            },

            error: function () {},
        });

    }
}
