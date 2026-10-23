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
            //'objectInstanceDefaultValues' => $objectInstanceDefaultValues,
        ],
        key('system-setup-form'))
    </div>
</div>
