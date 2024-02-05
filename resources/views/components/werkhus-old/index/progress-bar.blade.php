<div class="ws_breadcrumbs flex row">
    @foreach($steps as $index => $step)
        <div class="ws_circle flex col ju-center al-center @if(in_array($index, $completedSteps)) active @endif">
        </div>

        @if(isset($steps[$index + 1]))
            <div class="ws_crumb-line @if(in_array($index + 1, $completedSteps)) complete @endif"></div>
        @endif
    @endforeach
</div>

<style>
    .ws_breadcrumbs {
    width: 100%;
    margin: 0 auto;
    max-width: 612px;
    justify-content: space-between;
    padding-bottom: 16px;
    margin-top:8px;
}

.ws_breadcrumbs .ws_circle {
    background-color: #979797;
    color: #fff;
    font-weight: 500;
    width: 12px;
    height: 12px;
    border-radius: 50%;
}

.ws_circle.active {
    background-color: #070707;
}
.ws_crumb-line {
    height: 1px;
    width: 163px;
    background-color: #979797;

    flex: 1;
    width: 100%;
}
.ws_crumb-line.complete {
    height: 3px;
    background-color: #070707;
}
</style>