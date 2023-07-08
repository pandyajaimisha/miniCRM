<div class="btn-group btn-group-sm" role="group">
<a href="{{ route('companies.show', $q->id) }}" class="btn btn-secondary">Show</a>
    <a href="{{ route('companies.edit', $q->id) }}" class="btn btn-secondary">Edit</a>
    <a class="btn btn-secondary" href="{{ route('companies.destroy', $q->id) }}"
        onclick="event.preventDefault();
                        confirm('Are you sure?') ? document.getElementById('delete-form-{{ $q->id }}').submit() : event.preventDefault();">
        {{ __('Delete') }}
    </a>
</div>
<form id="delete-form-{{ $q->id }}" action="{{ route('companies.destroy', $q->id) }}" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>