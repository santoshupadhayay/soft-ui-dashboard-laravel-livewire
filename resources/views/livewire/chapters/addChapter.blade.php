<main class="main-content">
  <div class="container-fluid py-4">
      {{-- Tables --}}
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
             
            </div>
            <div class="card-body pt-0 pb-2">
              <form method="post" action="{{ route('saveChapter') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                  <label for="chapterName">Name</label>
                  <input type="text" name="name" class="form-control" id="chapterName" aria-describedby="Name" placeholder="Name" required>
                </div>
                <div class="form-check">
                  <input  name="status" type="checkbox" class="form-check-input" id="chapterStatus">
                  <label class="form-check-label" for="chapterStatus">Enabled</label>
                </div>
                <div class="form-group">
                  <label for="chapterStream">Stream</label>
                  <select name="stream_id" id="chapterStream" class="form-control" required>
                    @foreach ($streams as $stream)
                      <option value="{{ $stream->id }}">{{ $stream->name }}</option>
                    @endforeach
                  </select>
                </div>  
                <div class="form-group">
                  <label for="chapterDescription">Description</label>
                  <textarea  name="description" class="form-control chapterDescription" id="chapterDescription" placeholder="Description" required></textarea>
                </div>
                <div class="form-group">
                  <label for="chapterFile">File</label>
                  <input name="file" type="file" class="form-control" id="chapterFile" placeholder="Icon" required>
                </div>
                <div class="form-check">
                  <input  name="has_quiz" type="checkbox" class="form-check-input" id="streamQuiz">
                  <label class="form-check-label" for="streamQuiz">Has Quiz.</label>
                </div>  
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
  </div>
  <script>
    $(document).ready(function(){
      // tinymce.init({
      //   selector: '#chapterDescription',
      // });
      $('#chapterStream').select2({width:'100%'});
    })
  </script>
</main>
