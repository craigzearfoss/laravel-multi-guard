<div class="mb-3">
    <label for="input{{ !empty($name) ? ucfirst($name) : 'Name' }}" class="form-label mb-1">{{ $label ?? $name ?? '#label#' }}</label>
    <input
        type="{{ $type ?? 'text' }}"
        name="{{ $name ?? 'name' }}"
        id="input{{ !empty($name) ? ucfirst($name) : 'Name' }}"
        class="form-control @error('role') is-invalid @enderror"
        {{ $readonly ? 'disabled' : '' }}
        value="{{ $value ?? '' }}"
        placeholder="{{ $placeholder ?? '' }}"
        required
    >
    @error($name ?? 'name')
        <div class="form-text text-danger">{{ $message }}</div>
    @enderror
</div>
