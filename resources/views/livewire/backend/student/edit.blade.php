<section>
    <div class="glass-card rounded-2xl p-6 mb-6">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-bold text-text-black dark:text-text-white">{{ __('Admin Edit') }}</h2>
            <div class="flex items-center gap-2">
                <div class="flex items-center gap-2">
                    <x-ui.button href="{{ route('admin.index') }}" class="w-auto! py-2!">
                        <flux:icon name="arrow-left"
                            class="w-4 h-4 stroke-text-btn-primary group-hover:stroke-text-btn-secondary" />
                        {{ __('Back') }}
                    </x-ui.button>
                </div>
            </div>
        </div>
    </div>
    <div class="glass-card rounded-2xl p-6 mb-6">
        <form wire:submit="save">
            <div>
                <x-ui.file-input wire:model="form.image" label="Profile Picture" accept="image/*" :error="$errors->first('form.image')"
                    hint="Upload a profile picture " :existingFiles="$existingFile" removeModel="form.remove_file" />
            </div>

            <!-- Add other form fields here -->
             <div class="mt-6 space-y-4 grid grid-cols-2 gap-5">
                <div class="w-full col-span-2">
                    <x-ui.label value="{{ __('Name') }}" class="mb-1" />
                    <x-ui.input type="text" placeholder="{{ __('Full Name') }}" wire:model="form.name" />
                    <x-ui.input-error :messages="$errors->get('form.name')" />
                </div>
                <div class="w-full">
                    <x-ui.label value="{{ __('Phone') }}" class="mb-1" />
                    <x-ui.input type="text" placeholder="Enter phone number" wire:model="form.phone" />
                    <x-ui.input-error :messages="$errors->get('form.phone')" />
                </div>
                <div class="w-full">
                    <x-ui.label value="{{ __('Passport ID') }}" class="mb-1" />
                    <x-ui.input type="text" placeholder="Enter passport id" wire:model="form.passport_id" />
                    <x-ui.input-error :messages="$errors->get('form.passport_id')" />
                </div>
                <div class="w-full">
                    <x-ui.label value="{{ __('Reference By') }}" class="mb-1" />
                    <x-ui.input type="text" placeholder="Enter referer name" wire:model="form.reference_by" />
                    <x-ui.input-error :messages="$errors->get('form.reference_by')" />
                </div>
                <div class="w-full">
                    <x-ui.label value="{{ __('Reference Contact') }}" class="mb-1" />
                    <x-ui.input type="text" placeholder="Enter referer contact" wire:model="form.reference_contact" />
                    <x-ui.input-error :messages="$errors->get('form.reference_contact')" />
                </div>
                <div class="w-full">
                    <x-ui.label value="{{ __('Payment') }}" class="mb-1" />
                    <x-ui.input type="text" placeholder="Enter payment" wire:model="form.payment" />
                    <x-ui.input-error :messages="$errors->get('form.payment')" />
                </div>
                <div class="w-full">
                    <x-ui.label value="{{ __('Nominee Name') }}" class="mb-1" />
                    <x-ui.input type="text" placeholder="Enter nominee name" wire:model="form.nominee_name" />
                    <x-ui.input-error :messages="$errors->get('form.nominee_name')" />
                </div>
                <div class="w-full">
                    <x-ui.label value="{{ __('Nominee Number') }}" class="mb-1" />
                    <x-ui.input type="text" placeholder="Enter nominee number" wire:model="form.nominee_number" />
                    <x-ui.input-error :messages="$errors->get('form.nominee_number')" />
                </div>
                <div class="w-full">
                    <x-ui.label value="{{ __('Select Status') }}" class="mb-1" />
                    <x-ui.select wire:model="form.status">
                        @foreach ($statuses as $status)
                            <option value="{{ $status['value'] }}">{{ $status['label'] }}</option>
                        @endforeach
                    </x-ui.select>
                    <x-ui.input-error :messages="$errors->get('form.status')" />
                </div>
                <div class="w-full col-span-2">
                    <x-ui.label value="{{ __('Address') }}" class="mb-1" />
                    <x-ui.textarea placeholder="Enter address" wire:model="form.address" />
                    <x-ui.input-error :messages="$errors->get('form.address')" />
                </div>

            </div>
            <!-- Form Actions -->
            <div class="flex items-center justify-end gap-4 mt-6">
                <x-ui.button wire:click="resetForm" variant="tertiary" class="w-auto! py-2!">
                    <flux:icon name="x-circle"
                        class="w-4 h-4 stroke-text-btn-primary group-hover:stroke-text-btn-tertiary" />
                    <span wire:loading.remove wire:target="resetForm"
                        class="text-text-btn-primary group-hover:text-text-btn-secondary">{{ __('Reset') }}</span>
                    <span wire:loading wire:target="resetForm"
                        class="text-text-btn-primary group-hover:text-text-btn-secondary">{{ __('Reseting...') }}</span>
                </x-ui.button>

                <x-ui.button type="submit" class="w-auto! py-2!">
                    <span wire:loading.remove wire:target="save" class="text-white">{{ __('Update') }}</span>
                    <span wire:loading wire:target="save" class="text-white">{{ __('Updating...') }}</span>
                </x-ui.button>
            </div>
        </form>
    </div>
</section>
