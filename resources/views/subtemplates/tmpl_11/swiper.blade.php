<div class="bg-lightblue">
    <div class="swiper">
        <div class="text">
        <h2>
            {{$allContainers['s_text_var_12']->text}}
        </h2>
        </div>
        <!-- Additional required wrapper -->
        <div class="ws_carousel">
            <div class="ws_slick-carousel">
                <!-- Slides -->
                <div class="slick-carousel-cell slick-single">
                    <div class="t11-advantage-item v-center parent column">
                        <div class="t11-advantage-image parent h-center flex-1">
                            <img class="mrg-bottom-small" src="{{$allContainers['s_img_var_5']->text}}" alt="">
                        </div>
                        <div class="t11-advantage-text parent column v-center center flex-1">
                            <div class="">
                            <h5>
                                {!!$allContainers['s_text_var_14']->text!!}
                            </h5>
                            <p>
                                {!!$allContainers['s_text_var_15']->text!!}
                            </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slick-carousel-cell slick-single">
                    <div class="t11-advantage-item v-center parent column">
                        <div class="t11-advantage-image parent h-center flex-1">
                            <img class="mrg-bottom-small"src="{{$allContainers['s_img_var_6']->text}}" alt="">
                        </div>
                        <div class="t11-advantage-text parent column v-center center flex-1">
                            <div class="">
                            <h5 class="mrg-small">
                                {!!$allContainers['s_text_var_16']->text!!}
                            </h5>
                            <p>
                                {!!$allContainers['s_text_var_17']->text!!}
                            </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slick-carousel-cell slick-single">
                    <div class="t11-advantage-item v-center parent column">
                        <div class="t11-advantage-image parent h-center flex-1">
                            <img class="mrg-bottom-small gif" src="{{$allContainers['s_img_var_7']->text}}" alt="">
                        </div>
                        <div class="t11-advantage-text parent column v-center center flex-1">
                            <div class="">
                            <h5 class="mrg-small">
                                {!!$allContainers['s_text_var_18']->text!!}
                            </h5>
                            <p>
                                {!!$allContainers['s_text_var_19']->text!!}
                            </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="slick-prev"></button>
        <button type="button" class="slick-next"></button>
    </div>
</div>

<style>
    .swiper button.slick-prev,
    .swiper button.slick-prev:hover,
    .swiper button.slick-next,
    .swiper button.slick-next:hover {
        display: initial !important;
    }

    .bg-lightblue {
        background: #E4E4E4;
    }

    @font-face{font-family:swiper-icons;src:url('data:application/font-woff;charset=utf-8;base64, d09GRgABAAAAAAZgABAAAAAADAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABGRlRNAAAGRAAAABoAAAAci6qHkUdERUYAAAWgAAAAIwAAACQAYABXR1BPUwAABhQAAAAuAAAANuAY7+xHU1VCAAAFxAAAAFAAAABm2fPczU9TLzIAAAHcAAAASgAAAGBP9V5RY21hcAAAAkQAAACIAAABYt6F0cBjdnQgAAACzAAAAAQAAAAEABEBRGdhc3AAAAWYAAAACAAAAAj//wADZ2x5ZgAAAywAAADMAAAD2MHtryVoZWFkAAABbAAAADAAAAA2E2+eoWhoZWEAAAGcAAAAHwAAACQC9gDzaG10eAAAAigAAAAZAAAArgJkABFsb2NhAAAC0AAAAFoAAABaFQAUGG1heHAAAAG8AAAAHwAAACAAcABAbmFtZQAAA/gAAAE5AAACXvFdBwlwb3N0AAAFNAAAAGIAAACE5s74hXjaY2BkYGAAYpf5Hu/j+W2+MnAzMYDAzaX6QjD6/4//Bxj5GA8AuRwMYGkAPywL13jaY2BkYGA88P8Agx4j+/8fQDYfA1AEBWgDAIB2BOoAeNpjYGRgYNBh4GdgYgABEMnIABJzYNADCQAACWgAsQB42mNgYfzCOIGBlYGB0YcxjYGBwR1Kf2WQZGhhYGBiYGVmgAFGBiQQkOaawtDAoMBQxXjg/wEGPcYDDA4wNUA2CCgwsAAAO4EL6gAAeNpj2M0gyAACqxgGNWBkZ2D4/wMA+xkDdgAAAHjaY2BgYGaAYBkGRgYQiAHyGMF8FgYHIM3DwMHABGQrMOgyWDLEM1T9/w8UBfEMgLzE////P/5//f/V/xv+r4eaAAeMbAxwIUYmIMHEgKYAYjUcsDAwsLKxc3BycfPw8jEQA/gZBASFhEVExcQlJKWkZWTl5BUUlZRVVNXUNTQZBgMAAMR+E+gAEQFEAAAAKgAqACoANAA+AEgAUgBcAGYAcAB6AIQAjgCYAKIArAC2AMAAygDUAN4A6ADyAPwBBgEQARoBJAEuATgBQgFMAVYBYAFqAXQBfgGIAZIBnAGmAbIBzgHsAAB42u2NMQ6CUAyGW568x9AneYYgm4MJbhKFaExIOAVX8ApewSt4Bic4AfeAid3VOBixDxfPYEza5O+Xfi04YADggiUIULCuEJK8VhO4bSvpdnktHI5QCYtdi2sl8ZnXaHlqUrNKzdKcT8cjlq+rwZSvIVczNiezsfnP/uznmfPFBNODM2K7MTQ45YEAZqGP81AmGGcF3iPqOop0r1SPTaTbVkfUe4HXj97wYE+yNwWYxwWu4v1ugWHgo3S1XdZEVqWM7ET0cfnLGxWfkgR42o2PvWrDMBSFj/IHLaF0zKjRgdiVMwScNRAoWUoH78Y2icB/yIY09An6AH2Bdu/UB+yxopYshQiEvnvu0dURgDt8QeC8PDw7Fpji3fEA4z/PEJ6YOB5hKh4dj3EvXhxPqH/SKUY3rJ7srZ4FZnh1PMAtPhwP6fl2PMJMPDgeQ4rY8YT6Gzao0eAEA409DuggmTnFnOcSCiEiLMgxCiTI6Cq5DZUd3Qmp10vO0LaLTd2cjN4fOumlc7lUYbSQcZFkutRG7g6JKZKy0RmdLY680CDnEJ+UMkpFFe1RN7nxdVpXrC4aTtnaurOnYercZg2YVmLN/d/gczfEimrE/fs/bOuq29Zmn8tloORaXgZgGa78yO9/cnXm2BpaGvq25Dv9S4E9+5SIc9PqupJKhYFSSl47+Qcr1mYNAAAAeNptw0cKwkAAAMDZJA8Q7OUJvkLsPfZ6zFVERPy8qHh2YER+3i/BP83vIBLLySsoKimrqKqpa2hp6+jq6RsYGhmbmJqZSy0sraxtbO3sHRydnEMU4uR6yx7JJXveP7WrDycAAAAAAAH//wACeNpjYGRgYOABYhkgZgJCZgZNBkYGLQZtIJsFLMYAAAw3ALgAeNolizEKgDAQBCchRbC2sFER0YD6qVQiBCv/H9ezGI6Z5XBAw8CBK/m5iQQVauVbXLnOrMZv2oLdKFa8Pjuru2hJzGabmOSLzNMzvutpB3N42mNgZGBg4GKQYzBhYMxJLMlj4GBgAYow/P/PAJJhLM6sSoWKfWCAAwDAjgbRAAB42mNgYGBkAIIbCZo5IPrmUn0hGA0AO8EFTQAA');font-weight:400;font-style:normal}:root{--swiper-theme-color:#007aff}

    .swiper {
        margin-left: auto;
        margin-right: auto;
        position: relative;
        overflow: hidden;
        list-style: none;
        z-index: 1;

        padding: 32px 0 64px;
        max-width: 500px;
    }

    .swiper .text h2 {
        margin: 0 0 26px;

        font-weight: 600;
        font-size: 24px;
        line-height: 32px;
        /* or 133% */

        text-align: center;

        color: #070707;
    }

    .t11-advantage-image .gif {
        width: 300px;
    }

    .t11-advantage-text {
        width: 100%;
    }

    .t11-advantage-text > div {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 0px;
        gap: 8px;
    }

    .t11-advantage-text h5 {
        margin: 26px 0 0;

        font-weight: 600;
        font-size: 22px;
        line-height: 26px;
        /* identical to box height */

        text-align: center;

        color: #070707;
    }

    .t11-advantage-text p {
        margin: 0;

        font-weight: 400;
        font-size: 16px;
        line-height: 26px;
        /* or 162% */

        text-align: center;

        color: #070707;
    }

    @media screen and (max-width:768px) {
        .bg-lightblue {
            padding: 0 16px;
        }

        .t11-advantage-text {
            order: 2 !important
        }

    }
</style>

@push('head-js')
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
@endpush

<script>
    $('.ws_slick-carousel').slick({ prevArrow: $('.slick-prev'), nextArrow: $('.slick-next'), speed: 1000 });
</script>
