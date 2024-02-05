<div class="form-icons">
    <div class="form-icons-wrapper parent row">
        @foreach($icons as $icon)
            <div class="item flex-1">
                <img src="{{$icon['image']}}">
                <p>{{$icon['text']}}</p>
            </div>
        @endforeach
    </div>
</div>
