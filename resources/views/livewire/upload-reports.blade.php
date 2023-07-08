<form wire:submit.prevent="submit">
    <input type="file" wire:model="report">

    @error('report') <span class="error">{{ $message }}</span> @enderror

    <div wire:loading wire:target="report">Tafadhali Subiri...</div>

    <button type="submit">Upload Report</button>
</form>
