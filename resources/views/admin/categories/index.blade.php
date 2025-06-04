@extends('admin.layouts.app')
@section('title', 'Admin - Categories')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="mb-2 row">
                    <div class="col-sm-6">
                        <h1>Categories</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Categories</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <a href="{{ route('admin.category.create') }}" class="btn btn-primary mb-3">+ Add Category</a>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Category List</h3>
                    </div>
                    <div class="card-body">
                        @livewire('admin.category-table')
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
