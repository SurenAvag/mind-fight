@extends('layouts.app')

@section('content')
    <div class="graph-container">
        <h3>{{\Illuminate\Support\Facades\Auth::user()->first_name}} graph</h3>
        @if($display_type == \App\Graphs\Graph::DISPLAY_TYPES['matrix'])
            @include('graphs.graph-matrix', ['matrix' => $graph->asMatrix()])
        @else
            @include('graphs.graph-graphical')
        @endif
    </div>
@endsection