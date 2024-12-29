<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Payment Method') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden p-10 shadow-sm sm:rounded-lg">

                <form method="POST" action="{{ route('admin.package_banks.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Opsi untuk memilih metode pembayaran (Bank atau Midtrans) -->
                    <div class="mb-4">
                        <x-input-label for="payment_method" :value="__('Payment Method')" />
                        <div class="flex gap-4">
                            <label>
                                <input type="radio" name="payment_method" value="bank" checked>
                                Bank Transfer
                            </label>
                            <label>
                                <input type="radio" name="payment_method" value="midtrans">
                                Midtrans
                            </label>
                        </div>
                    </div>

                    <!-- Bagian detail bank (muncul hanya jika opsi bank dipilih) -->
                    <div id="bank-details">
                        <div class="mt-4">
                            <x-input-label for="bank_name" :value="__('Bank Name')" />
                            <x-text-input id="bank_name" class="block mt-1 w-full" type="text" name="bank_name" :value="old('bank_name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('bank_name')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="bank_account_name" :value="__('Bank Account Name')" />
                            <x-text-input id="bank_account_name" class="block mt-1 w-full" type="text" name="bank_account_name" :value="old('bank_account_name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('bank_account_name')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="bank_account_number" :value="__('Bank Account Number')" />
                            <x-text-input id="bank_account_number" class="block mt-1 w-full" type="number" name="bank_account_number" :value="old('bank_account_number')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('bank_account_number')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="logo" :value="__('Logo')" />
                            <x-text-input id="logo" class="block mt-1 w-full" type="file" name="logo" required autofocus autocomplete="logo" />
                            <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Add Payment Method
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.querySelectorAll('input[name="payment_method"]').forEach((elem) => {
        elem.addEventListener('change', function() {
            if (this.value === 'midtrans') {
                document.getElementById('bank-details').style.display = 'none';
            } else {
                document.getElementById('bank-details').style.display = 'block';
            }
        });
    });
</script>
