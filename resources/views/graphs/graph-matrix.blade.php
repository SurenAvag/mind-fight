<div class="graph-matrix">
    <h4 class="graph-title">Matrix</h4>
    <div class="matrix">
        @foreach($matrix as $array)
            <div class="row">
                @foreach($array as $item)
                    <span class="row-item">
                        {{$item}}
                    </span>
                @endforeach
            </div>
        @endforeach
    </div>
</div>