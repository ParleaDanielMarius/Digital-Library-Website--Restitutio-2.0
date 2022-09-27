
<!-- Modal -->
<div class="modal fade" id="restoreModal" tabindex="-1" role="dialog" aria-labelledby="restoreModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="restoreModalLabel">Restore Item?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>You are about to <b class="text-primary">Restore</b> this item. The system will attempt to restore all relationships this item had. <b class="text-primary">Make sure to check that everything was restored properly!</b></p>
            </div>
            <div class="modal-footer">
                <form method="post" action="{{route('deletions.restore', $deletion)}}">
                    @csrf
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" value="Proceed" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>
