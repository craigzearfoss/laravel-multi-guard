<div class="mb-3">
    <label for="input{{ !empty($name) ? ucfirst($name) : 'Name' }}" class="form-label mb-1">{{ $label ?? $name ?? '#label#' }}</label>
    <textarea
        name="{{ $name ?? 'name' }}"
        class="form-control"
        id="input{{ !empty($name) ? ucfirst($name) : 'Name' }}"
        rows="{{ $rows ?? '3' }}"
        {{ $readonly ? 'disabled' : '' }}
        placeholder=""
    >{{ $value ?? '' }}</textarea>
    @error($name ?? 'name')
        <div class="form-text text-danger">{{ $message }}</div>
    @enderror
</div>
