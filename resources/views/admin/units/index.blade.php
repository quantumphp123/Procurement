@extends('admin.layouts.app')
@section('title', 'Admin - Units')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="mb-2 row">
                    <div class="col-sm-6">
                        <h1>Units</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Units</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <a href="{{ route('admin.units.create') }}" class="btn btn-primary mb-3">+ Add Unit</a>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Unit List</h3>
                    </div>
                    <div class="card-body">
                        @livewire('admin.unit-table')
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
