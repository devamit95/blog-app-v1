@csrf
<div class="mb-3">
    <label class="form-label">Title</label>
    <input type="text" name="title" value="{{ old('title', $post->title ?? '') }}" class="form-control" required>
</div>
<div class="mb-3">
    <label class="form-label">Content</label>
    <textarea name="content" rows="8" class="form-control" required>{{ old('content', $post->content ?? '') }}</textarea>
</div>
<button class="btn btn-primary">{{ $buttonText }}</button>
