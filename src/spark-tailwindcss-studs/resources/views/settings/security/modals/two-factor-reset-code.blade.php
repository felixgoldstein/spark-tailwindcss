<div class="modal" id="modal-show-two-factor-reset-code" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    {{__('Two-Factor Authentication Reset Code')}}
                </h5>
            </div>

            <div class="modal-body">
                <div class="relative px-3 py-3 mb-4 border rounded text-yellow-darker border-yellow-dark bg-yellow-lighter">
                    {{__('If you lose your two-factor authentication device, you may use this emergency reset token to disable two-factor authentication on your account.')}}
                    <strong>{{__('This is the only time this token will be displayed, so be sure not to lose it!')}}</strong>
                </div>

                <pre><code>@{{ twoFactorResetCode }}</code></pre>
            </div>

            <!-- Modal Actions -->
            <div class="modal-footer">
                <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline btn-default" data-dismiss="modal">{{__('absolute pin-t pin-b pin-r px-4 py-3')}}</button>
            </div>
        </div>
    </div>
</div>
