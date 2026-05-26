<div class="space-y-4">

    {{-- TENANT --}}
    <div>
        <label>Tenant</label>

        <select name="tenant_id" class="w-full border rounded">
            @foreach($tenants as $tenant)
                <option value="{{ $tenant->id }}">
                    {{ $tenant->first_name }} {{ $tenant->last_name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- PROPERTY --}}
    <div>
        <label>Property</label>

        <select name="property_id" class="w-full border rounded">
            <option value="">Select Property</option>

            @foreach($properties as $property)
                <option value="{{ $property->id }}"
                    {{ old('property_id', $lease->property_id ?? '') == $property->id ? 'selected' : '' }}>
                    {{ $property->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- START DATE --}}
    <div>
        <label>Start Date</label>

        <input type="date"
            name="start_date"
            value="{{ old('start_date', $lease->start_date ?? '') }}"
            class="w-full border rounded">
    </div>

    {{-- END DATE --}}
    <div>
        <label>End Date</label>

        <input type="date"
            name="end_date"
            value="{{ old('end_date', $lease->end_date ?? '') }}"
            class="w-full border rounded">
    </div>

    <div>
        <label>Monthly Rent</label>
        <input type="number" name="monthly_rent" class="w-full border rounded" required>
    </div>

</div>