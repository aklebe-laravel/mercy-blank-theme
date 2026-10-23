<div
        class="modal fade"
        data-bs-backdrop="static"
        aria-hidden="true"
        :class="{'show d-block':messageBox.isOpen}"
        role="dialog"
        tabindex="-1"
        {{--        x-show="messageBox.isOpen"--}}
        {{--        x-on:click.away="messageBox.isOpen = false"--}}
        x-cloak
        x-transition
>
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-message-box">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" x-text="messageBox.title"></h5>
                <button type="button" class="btn-close" x-on:click="messageBox.isOpen = false" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div x-html="messageBox.content"></div>
            </div>
            <div class="modal-footer">
                <template x-for="value in messageBox.actions">
                    <span x-html="value"></span>
                </template>
            </div>
        </div>
    </div>
</div>

