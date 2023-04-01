<div class="col-md-4 mb-3" style="cursor: pointer;" onclick="location.href='{{ route('notes.edit', [$note]) }}'">
    <div class="card card-body">
        <h5 class="text-truncate">
            <div class="row justify-content-between">
                <div class="col-auto">
                    {{ $note->title }}
                </div>
            </div>
        </h5>
        <p class="text-muted">{{ $note->updated_at->diffForHumans() }}</p>
        <div>
            <p class="text-muted">{{ $note->getPreviewContent() }}</p>
        </div>
        <div class="row justify-content-between">
            <div class="col-auto">
                <p class="mb-0">
                    @if($note->is_public) 
                        <i class="fas fa-lock-open"></i> Public
                    @else 
                        <i class="fas fa-lock"></i> Private
                    @endif
                </p>
            </div>
            @if($note->trashed())
                <div class="col-auto">
                    <form id="restore-form" method="POST" action="{{ route('notes.restore', [$note]) }}">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                    
                        <div class="form-group">
                            <button type="submit" class="btn btn-secondary" title="Restore">
                                <i class="fas fa-trash-can-undo"></i>
                            </button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>