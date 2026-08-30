@extends('layouts.admin')

@section('title', 'Edit News')
@section('page-title', 'Edit Announcement')
@section('page-sub', 'Update news article details')

@section('content')

<div class="card">
    <div class="card-header">
        <h2><i class="fa-solid fa-pen-to-square"></i> Edit Announcement</h2>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.news.update', $news) }}">
            @csrf
            @method('PUT')

            {{-- Title Field --}}
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: var(--text); font-size: .95rem;">
                    Title <span style="color: var(--danger);">*</span>
                </label>
                <input type="text" 
                       name="title"
                       placeholder="Enter announcement title"
                       value="{{ old('title', $news->title) }}"
                       style="width: 100%; padding: 10px 13px; border: 1.5px solid {{ $errors->has('title') ? 'var(--danger)' : 'var(--border)' }}; border-radius: 7px; font-size: .95rem; outline: none; transition: border-color .2s;" 
                       onfocus="this.style.borderColor='var(--primary)'" 
                       onblur="this.style.borderColor='{{ $errors->has('title') ? 'var(--danger)' : 'var(--border)' }}'">
                @error('title')
                    <div style="color: var(--danger); font-size: .8rem; margin-top: 4px;"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                @enderror
            </div>

            {{-- Content Field --}}
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: var(--text); font-size: .95rem;">
                    Content <span style="color: var(--danger);">*</span>
                </label>
                <textarea name="content" 
                          placeholder="Write your announcement content here..."
                          rows="10"
                          style="width: 100%; padding: 10px 13px; border: 1.5px solid {{ $errors->has('content') ? 'var(--danger)' : 'var(--border)' }}; border-radius: 7px; font-size: .95rem; font-family: inherit; outline: none; transition: border-color .2s; resize: vertical;"
                          onfocus="this.style.borderColor='var(--primary)'" 
                          onblur="this.style.borderColor='{{ $errors->has('content') ? 'var(--danger)' : 'var(--border)' }}'">{{ old('content', $news->content) }}</textarea>
                @error('content')
                    <div style="color: var(--danger); font-size: .8rem; margin-top: 4px;"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                @enderror
                <small style="color: var(--text-muted); display: block; margin-top: 6px;">
                    Status: <strong>{{ $news->is_published ? 'Published' : 'Draft' }}</strong>
                    {{ $news->published_at ? '(Published on ' . $news->published_at->format('M d, Y H:i') . ')' : '' }}
                </small>
            </div>

            {{-- Form Actions --}}
            <div style="display: flex; gap: 12px; align-items: center;">
                <button type="submit" class="btn btn-primary" style="display: flex; align-items: center; gap: 6px;">
                    <i class="fa-solid fa-floppy-disk"></i> Save Changes
                </button>
                <a href="{{ route('admin.news.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection
