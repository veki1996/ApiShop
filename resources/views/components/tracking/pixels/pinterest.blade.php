<!-- Pinterest Tag -->
<script>
    !function (e) {
        if (!window.pintrk) {
            window.pintrk = function () {
                window.pintrk.queue.push(Array.prototype.slice.call(arguments))
            }
            var t = window.pintrk
            t.queue = [], t.version = '3.0'
            var r = document.createElement('script')
            r.async = !0, r.src = e
            var n = document.getElementsByTagName('script')[0]
            n.parentNode.insertBefore(r, n)
        }
    }('https://s.pinimg.com/ct/core.js'), pintrk('load', "{{$trackingCodes->pinterest}}"), pintrk('page')
</script>
<noscript>
    <img height="1" width="1" style="display:none;" alt=""
         src="https://ct.pinterest.com/v3/?event=init&tid={{$trackingCodes->pinterest}}&noscript=1"/>
</noscript>
<!-- end Pinterest Tag -->


