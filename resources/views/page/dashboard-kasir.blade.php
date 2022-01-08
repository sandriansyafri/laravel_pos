@extends('layouts.backend.main')

@section('title')
    Dashboard
@endsection

@section('content')
<div class="row mt-2 mb-2">
      <div class="col">
            <p class="h3">Tanggal : {{ format_tanggal_indo(now()->format('Y-m-d')) }}</p>
      </div>
</div>
    <div class="row">
          <div class="col">
                  <div class="card">
                        <div class="card-body text-center p-5">
                              <h1 class="display-2">Hello, {{ auth()->user()->username }}</h1>
                              <h1 class="display-5 font-weight-light">Have a nice day </h1>
                        </div>
                  </div>
          </div>
    </div>
@endsection