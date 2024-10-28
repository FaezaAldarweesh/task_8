@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white">{{ __('Dashboard') }}</div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong> <!-- يمكنك إضافة رمز لزيادة الجاذبية -->
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card-body">
                    <h2 class="mb-4 text-center text-secondary">Task List</h2>

                    <div class="d-flex justify-content-between mb-3">
                        <a href="{{ route('task.create') }}" class="btn btn-success text-white">
                            <i class="bi bi-plus-circle"></i> Create New Task
                        </a>
                        <a href="{{ route('home') }}" class="btn btn-secondary">Back</a>
                    </div>

                    <table class="table table-hover table-bordered">
                        <thead class="table-primary text-center">
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Due Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tasks as $task)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ Str::limit($task->description, 50) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($task->due_date)->format('d-m-Y') }}</td>
                                    <td>
                                        <span class="badge 
                                            {{ $task->status == 'Completed' ? 'bg-success' : 'bg-warning text-dark' }}">
                                            {{ ucfirst($task->status) }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('task.edit', $task->id) }}" class="btn btn-warning btn-sm text-white">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>

                                        <form action="{{ route('task.destroy', $task->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this task?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>

                                        <a href="{{ route('task.show', $task->id) }}" class="btn btn-info btn-sm">
                                            <i class="bi bi-eye"></i> View
                                        </a>

                                        <form action="{{ route('update_status', $task->id) }}" method="POST" class="d-inline-block mt-2">
                                            @csrf
                                            @method('PATCH')
                                            <div class="d-flex align-items-center">
                                                <select class="form-select form-select-sm @error('status') is-invalid @enderror" name="status">
                                                    <option value="">Select Status</option>
                                                    <option value="Pending" {{ $task->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="Completed" {{ $task->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                                </select>
                                                <button type="submit" class="btn btn-primary btn-sm ms-2">Update</button>
                                            </div>
                                            @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </form>
                                        </td>
                                </tr>  
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">No tasks available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
