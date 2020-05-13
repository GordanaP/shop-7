<div id="ratingModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-lg font-medium"></h5>

                <button type="button" class="close" data-dismiss="modal"
                aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <p class="mb-1">Update your rating:</p>
                @for ($i = 0; $i < 5 ; $i++)
                    <x-misc.radio-input name="rating-btn" value="{{ $i+1 }}" />
                @endfor
                <p class="rating invalid-feedback text-error mt-1"></p>
            </div>

            <div class="modal-footer bg-gray-100">
                <button type="button" id="updateRatingBtn"
                class="btn bg-red-dark hover:bg-red-dark-h text-white">
                    Save
                </button>
                <button type="button" class="btn btn-secondary"
                data-dismiss="modal">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>