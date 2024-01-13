<main class="main-content">
  <div class="container-fluid py-4">
      {{-- Tables --}}
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
             
            </div>
            <div class="card-body pt-0 pb-2">
              <form method="post" action="{{ route('saveQuiz') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                  <label for="quizName">Name</label>
                  <input type="text" name="name" class="form-control" id="quizName" aria-describedby="Name" placeholder="Name" required>
                </div>
                <div class="form-check">
                  <input  name="status" type="checkbox" class="form-check-input" id="quizStatus">
                  <label class="form-check-label" for="quizStatus">Enabled</label>
                </div>
                <div class="form-group">
                  <label for="quizChapter">Chapter</label>
                  <select name="chapter_id" id="quizChapter" class="form-control" required>
                    @foreach ($chapters as $chapter)
                      <option value="{{ $chapter->id }}">{{ $chapter->name }}</option>
                    @endforeach
                  </select>
                </div>  
                <div class="form-group">
                  <label for="quizDescription">Description</label>
                  <textarea  name="description" class="form-control quizDescription" id="quizDescription" placeholder="Description"></textarea>
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
      $('#quizChapter').select2({width:'100%'});
    })
  </script>
</main>
