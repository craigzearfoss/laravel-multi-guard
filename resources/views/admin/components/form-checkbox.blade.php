<div class="mb-3">
    <input type="hidden" name="{{ $name ?? 'name' }}" value="{{ $unchecked_value ?? '0' }}">
    <input
        type="checkbox"
        name="active"
        id="input{{ !empty($name) ? ucfirst($name) : 'Name' }}"
        class="form-check-input"
        {{ $readonly ? 'disabled' : '' }}
        value="1"
        {{ boolval($checked ?? false) ? 'checked' : '' }}
    >
    <label for="input{{ !empty($name) ? ucfirst($name) : 'Name' }}" class="form-check-label mb-1 font-semibold">{{ $label ?? $name ?? '#label#' }}</label>
    @error($name ?? 'name')
        <div class="form-text text-danger">{{ $message }}</div>
    @enderror
</div>
