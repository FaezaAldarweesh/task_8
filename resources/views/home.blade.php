@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>{{ __('Dashboard') }}</h5>
                    <!-- Add some icons for user experience -->
                    <a href="{{ route('home') }}" class="btn btn-link">
                        <i class="bi bi-house-door"></i>
                    </a>
                </div>

                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <!-- Tasks Button -->
                        <a href="{{ route('task.index') }}" class="btn btn-primary me-2">
                            <i class="bi bi-list-task me-1"></i> Tasks
                        </a>

                        <!-- Trashed Tasks Button -->
                        <a href="{{ route('all_trashed_task') }}" class="btn btn-danger">
                            <i class="bi bi-trash me-1"></i> Trashed Tasks
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
