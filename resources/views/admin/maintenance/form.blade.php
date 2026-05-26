<div class="space-y-4">

    <div>
        <label>Tenant</label>

        <select name="tenant_id"
            class="w-full border rounded">

            @foreach($tenants as $tenant)
                <option value="{{ $tenant->id }}">
                    {{ $tenant->name }}
                </option>
            @endforeach

        </select>
    </div>

    <div>
        <label>Issue</label>

        <textarea
            name="issue"
            class="w-full border rounded"></textarea>
    </div>

    <div>
        <label>Status</label>

        <select
            name="status"
            class="w-full border rounded">

            <option>Pending</option>
            <option>In Progress</option>
            <option>Completed</option>

        </select>
    </div>

</div>