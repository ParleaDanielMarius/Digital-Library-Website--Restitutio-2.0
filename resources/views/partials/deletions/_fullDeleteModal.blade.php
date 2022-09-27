
<!-- Modal -->
<div class="modal fade" id="fullDeleteModal" tabindex="-1" role="dialog" aria-labelledby="fullDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fullDeleteModalLabel">Delete?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>You are about to <b class ="text-danger">FULLY DELETE</b> this item. The PDF and Cover will <b class ="text-danger">NOT</b> remain in storage. <b class ="text-danger">This action cannot be undone!</b></p>
            </div>
            <div class="modal-footer">
                <form method="post" action="{{route('deletions.fullDestroy', $deletion)}}">
                    @method('DELETE')
                    @csrf
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" value="Delete" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>
