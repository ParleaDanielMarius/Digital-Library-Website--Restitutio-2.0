
<!-- Modal -->
<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusModalLabel">Change Status?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>You are about to change this item's status to <b class="text-primary"> @if($item->status == app\models\Item::STATUS_ACTIVE)Inactive. @else Active. @endif </b>Proceed?</p>
            </div>
            <div class="modal-footer">
                <form method="post" action="{{route('items.status', $item->slug)}}">
                    @method('put')
                    @csrf
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" value="Proceed" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>
