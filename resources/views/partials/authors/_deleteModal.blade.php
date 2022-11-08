
<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>You are about to <b class ="text-danger">DELETE</b> this author. This action <b class ="text-danger">cannot be undone</b>.</p>
            </div>
            <div class="modal-footer">
                <form method="post" action="{{route('authors.destroy', $author->slug)}}">
                    @method('DELETE')
                    @csrf
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" value="Delete" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>
