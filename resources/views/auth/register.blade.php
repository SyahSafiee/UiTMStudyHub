<div class="mt-4">
    <label class="block font-bold text-uitm-blue text-sm mb-2">UiTM Student Email</label>
    <input type="email" name="email" value="{{ old('email') }}" 
           class="w-full border-gray-300 rounded-xl focus:ring-uitm-violet focus:border-uitm-violet shadow-sm">
    
    @error('email')
        <p class="text-red-500 text-xs mt-2 font-bold italic">
            {{ $message }}
        </p>
    @enderror
</div>