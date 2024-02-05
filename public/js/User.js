class User {
    urlParams = new Map()
    cookies = new Map()
    postageCost

    constructor (postageCost) {
        this.postageCost = postageCost

        let user = this

        // Populate map of GET parameters
        new URLSearchParams(window.location.search).forEach((value, key) => {
            user.urlParams.set(key, value)
        })

        // Populate map of cookies
        document.cookie.split(';').forEach((value) => {
            value = decodeURIComponent(value)
            user.cookies.set(value.split('=')[0], value.split('=')[1])
        })
    }

    param (key) {
        return this.urlParams.get(key)
    }

    cookie (key) {
        return this.cookies.get(key)
    }

    getPostage () {
        return this.param('pstprm') === 'y' ? this.postageCost : 0
    }
}
