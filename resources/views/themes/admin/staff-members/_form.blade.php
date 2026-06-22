@php
    $selectedType = old('member_type', $member->member_type ?? 'leader');
    $activeValue = old('is_active', isset($member) ? $member->is_active : true);
@endphp

<div class="card-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name">Name *</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $member->name ?? '') }}" placeholder="Enter name">
                @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="position">Position / Title</label>
                <input type="text" class="form-control @error('position') is-invalid @enderror" id="position" name="position" value="{{ old('position', $member->position ?? '') }}" placeholder="Enter position">
                @error('position')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="member_type">Member Type *</label>
                <select class="form-control @error('member_type') is-invalid @enderror" id="member_type" name="member_type">
                    <option value="leader" {{ $selectedType === 'leader' ? 'selected' : '' }}>Leader</option>
                    <option value="librarian" {{ $selectedType === 'librarian' ? 'selected' : '' }}>Librarian</option>
                </select>
                @error('member_type')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="sort_order">Sort Order</label>
                <input type="number" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" min="0" value="{{ old('sort_order', $member->sort_order ?? 0) }}">
                @error('sort_order')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="is_active">Visibility</label>
                <div class="form-check mt-2">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ $activeValue ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Show on about page</label>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" placeholder="Enter a short bio">{{ old('description', $member->description ?? '') }}</textarea>
        @error('description')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="facebook_url">Facebook URL</label>
                <input type="url" class="form-control @error('facebook_url') is-invalid @enderror" id="facebook_url" name="facebook_url" value="{{ old('facebook_url', $member->facebook_url ?? '') }}" placeholder="https://facebook.com/...">
                @error('facebook_url')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="twitter_url">Twitter URL</label>
                <input type="url" class="form-control @error('twitter_url') is-invalid @enderror" id="twitter_url" name="twitter_url" value="{{ old('twitter_url', $member->twitter_url ?? '') }}" placeholder="https://twitter.com/...">
                @error('twitter_url')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="linkedin_url">LinkedIn URL</label>
                <input type="url" class="form-control @error('linkedin_url') is-invalid @enderror" id="linkedin_url" name="linkedin_url" value="{{ old('linkedin_url', $member->linkedin_url ?? '') }}" placeholder="https://linkedin.com/...">
                @error('linkedin_url')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="image">Profile Image</label>
        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
        @error('image')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
        @if(!empty($member->image))
            <div class="mt-3">
                <img src="{{ $member->image_url }}" alt="{{ $member->name }}" style="width:120px;height:120px;object-fit:cover;border-radius:12px;">
            </div>
        @endif
    </div>
</div>

<div class="card-footer">
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save"></i> Save
    </button>
    <a href="{{ admin_url('staff-members') }}" class="btn btn-secondary">
        <i class="fas fa-times"></i> Cancel
    </a>
</div>
