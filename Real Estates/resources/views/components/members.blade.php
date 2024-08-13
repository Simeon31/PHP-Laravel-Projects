<div class="team-member">
    <div class="team-member-inner">
        <div class="team-member-image {{ $member->image_url ? '' : 'no-image' }}">
            @if ($member->image_url && file_exists(public_path('storage/' . $member->image_url)))
            <img src="/storage/{{ $member->image_url }}" alt="{{ $member->first_name }} {{ $member->last_name }}">
            @else
            <span style="border: 1px; border-radius: 20px; background-color: black; color: white; padding: 7vh;">{{__('No Image')}}</span>
            @endif
        </div>
        <h3>{{ $member->first_name }} {{ $member->last_name }} – {{ $member->staffRole->role }}</h3>
        <div class="team-member-info">
            <p><strong>{{__('Role')}}:</strong> {{ $member->staffRole->description ?  : __('No description') }}</p>
            <p><strong>{{__('Experience')}}:</strong> {{ $member->years_of_experience }} {{__('years')}}</p>
            <p><strong>{{__('Category')}}:</strong>
                <span class="category-list">
                    @foreach ($member->staffCategories as $category)
                    {{ $category->category }}@if (!$loop->last), @endif
                    @endforeach
                </span>
            </p>
            <p><strong>{{__('Contact')}}:</strong> {{ $member->email }}</p>
        </div>
    </div>
</div>