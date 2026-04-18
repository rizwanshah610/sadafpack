@extends('layouts.admin')
@section('title', 'Staff')
@section('content')

<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0">Staff Management</h1>
    </div>
</div>

<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h3 class="card-title mb-0">
                <i class="fas fa-users mr-2"></i> All Staff
            </h3>
            <div class="card-tools ml-auto d-flex align-items-center">
                <input type="text" id="searchInput"
                       class="form-control form-control-sm mr-2"
                       placeholder="Search..." style="width: 200px;">
                @role('super_admin')
                <a href="{{ route('staff.create') }}" class="btn btn-sm btn-success">
                    <i class="fas fa-plus mr-1"></i> Add Staff
                </a>
                @endrole
            </div>
        </div>

        <div class="card-body p-0">

            @if(session('success'))
                <div class="alert alert-success m-3">
                    <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
                </div>
            @endif

            <table class="table table-striped table-hover mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Created</th>
                        @role('super_admin')
                        <th>Actions</th>
                        @endrole
                    </tr>
                </thead>
                <tbody>
                    @forelse($staff as $member)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->email }}</td>
                        <td>
                            @if($member->hasRole('admin'))
                                <span class="badge badge-primary">Admin</span>
                            @else
                                <span class="badge badge-secondary">Staff</span>
                            @endif
                        </td>
                        <td>{{ $member->created_at->format('d M Y') }}</td>
                        @role('super_admin')
                        <td>
                            <a href="{{ route('staff.edit', $member->id) }}" class="btn btn-xs btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('staff.destroy', $member->id) }}"
                                  method="POST" style="display:inline;"
                                  onsubmit="return confirm('Are you sure you want to delete this staff member?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-xs btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                        @endrole
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-3">
                            <i class="fas fa-inbox mr-1"></i> No staff members found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.getElementById('searchInput').addEventListener('keyup', function () {
    let value = this.value.toLowerCase();
    let rows = document.querySelectorAll('tbody tr');
    rows.forEach(function(row) {
        let text = row.innerText.toLowerCase();
        row.style.display = text.includes(value) ? '' : 'none';
    });
});
</script>
@endsection