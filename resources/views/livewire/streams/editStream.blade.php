<main class="main-content">
  <div class="container-fluid py-4">
      {{-- Tables --}}
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
             
            </div>
            <div class="card-body pt-0 pb-2">
              <form method="post" action="{{ route('updateStream') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                  <label for="streamName">Name</label>
                  <input value="{{ $stream->id }}" type="hidden" name="id" />
                  <input type="text" name="name" value="{{ $stream->name }}" class="form-control" id="streamName" aria-describedby="Name" placeholder="Name" required>
                </div>
                <div class="form-check">
                  <input  name="status" type="checkbox" class="form-check-input"  {{ $stream->status == 1 ? 'checked' : '' }} id="streamStatus">
                  <label class="form-check-label" for="streamStatus">Enabled</label>
                </div>  
                <div class="form-group">
                  <label for="streamDescription">Description</label>
                  <textarea  name="description" class="form-control streamDescription" id="streamDescription" placeholder="Description" required>{{ $stream->description }}</textarea>
                </div>
                <div class="form-group">
                  <label for="streamIcon">Icon</label>
                  <input name="icon" type="file" class="form-control" id="streamIcon" placeholder="Icon">
                  <img style="width: 20%;margin: 12px 0;" class="img-responsive img-thumbnail" src="{{ $stream->icon }}" />
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
      tinymce.init({
        selector: '.streamDescription',
      });
    })
  </script>
</main>
