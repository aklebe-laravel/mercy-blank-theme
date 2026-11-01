@php
    /**
     * @var string $formObjectId
     * @var string $livewireForm
     */
@endphp
<div>
    <div>
        @livewire($livewireForm, [
            'formObjectId' => $formObjectId,
            'isFormOpen' => !!($formObjectId),
        ],
        key('user-profile-form'))
    </div>
</div>
