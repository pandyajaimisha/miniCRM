<div class="btn-group btn-group-sm" role="group">
<a href="{{ route('employees.show', $q->id) }}" class="btn btn-secondary">Show</a>
    <a href="{{ route('employees.edit', $q->id) }}" class="btn btn-secondary">Edit</a>
    <a class="btn btn-secondary" href="{{ route('employees.destroy', $q->id) }}"
        onclick="event.preventDefault();
                        confirm('Are you sure?') ? document.getElementById('delete-form-{{ $q->id }}').submit() : event.preventDefault();">
        {{ __('Delete') }}
    </a>
</div>
<form id="delete-form-{{ $q->id }}" action="{{ route('employees.destroy', $q->id) }}" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>