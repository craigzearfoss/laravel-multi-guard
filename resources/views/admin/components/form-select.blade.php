<div class="mb-3">
    <label for="input{{ !empty($name) ? ucfirst($name) : 'Name' }}" class="form-label mb-1">{{ $label ?? $name ?? '#label#' }}</label>
    <select
        name="{{ $name ?? 'name' }}"
        id="input{{ !empty($name) ? ucfirst($name) : 'Name' }}"
        class="form-select"
        {{ $readonly ? 'disabled' : '' }}
        required
    >
        @foreach($list ?? [] as $listValue=>$listName)
            <option
                value="{{ $listValue }}"
                {{ $listValue == $value ?? '' ? 'selected' : '' }}
            >{{ $listName }}</option>
        @endforeach
    </select>
    @error($name ?? 'name')
        <div class="form-text text-danger">{{ $message }}</div>
    @enderror
</div>
