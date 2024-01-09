@extends('backend.layout.app')
@section('title','Tags')

@section('content')
<div class="row">
    <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-sm-0 font-size-18">Basic Tags</h4>
  
        <div class="page-title-right">
          <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Tags</a></li>
            <li class="breadcrumb-item active">Basic Tags</li>
          </ol>
        </div>
  
      </div>
    </div>
  </div>

    <form action="{{route('tags.store')}}" method="POST">
        @csrf
        <div class="mb-3">
            <input type="text" name="tags" id="tagInput" class="form-control" placeholder="Add tags (comma-separated)" autocomplete="off">
        </div>
        <div id="tagContainer" class="mb-3"></div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection
@push('script')
<script>
  $(document).ready(function() {
    let tags = [];

    function renderTags() {
        $('#tagContainer').empty();
        tags.forEach(t => {
            $('#tagContainer').append(`
                <span class="badge bg-secondary me-1 mb-1">${t}<span class="badge-close" data-tag="${t}">×</span></span>
            `);
        });
    }

    function addTag(tag) {
        tags.push(tag);
        renderTags();
    }

    function removeTag(tagToRemove) {
        tags = tags.filter(t => t !== tagToRemove);
        renderTags();
    }

    $(document).on('click', '.badge-close', function() {
        const tagToRemove = $(this).data('tag');
        removeTag(tagToRemove);
    });

    $('#tagInput').keydown(function(e) {
        if (e.key === 'Enter' || e.key === ',') {
            e.preventDefault();
            const tag = $(this).val().trim();
            if (tag !== '') {
                addTag(tag);
                $(this).val('');
            }
        }
    });

    $('form').submit(function() {
        const tagsAsString = tags.join(',');
        $('#tagInput').val(tagsAsString);
    });

    renderTags();
});

</script>
@endpush